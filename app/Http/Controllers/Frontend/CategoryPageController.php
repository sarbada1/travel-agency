<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Item\Item;
use Illuminate\Http\Request;
use App\Models\Item\ItemMedia;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class CategoryPageController extends Controller
{
    /**
     * Display a listing of items by category
     */
    public function index($mainSlug, Request $request)
    {
        // Find the main category by slug
        $mainCategory = Category::where('slug', $mainSlug)
            ->where('is_main', true)
            ->firstOrFail();
            
        // Get the page type
        $pageType = $mainCategory->getEffectivePageType();
        
        // Handle filter by subcategory if provided
        $subcategorySlug = $request->get('subcategory');
        $subcategory = null;
        
        if ($subcategorySlug) {
            $subcategory = Category::where('slug', $subcategorySlug)
                ->where('parent_id', $mainCategory->id)
                ->first();
        }
        
        // Get all subcategories for filtering
        $subcategories = Category::where('parent_id', $mainCategory->id)
            ->orderBy('name')
            ->get();
            
        // Build query to get items
        $query = Item::where('status', 'published')
            ->where(function($query) use ($mainCategory, $subcategory) {
                // Include items directly in main category
                $query->where('category_id', $mainCategory->id)->orWhere('listing_type',$mainCategory->name);
                
                // Include items in subcategories
                $subcategoryIds = Category::where('parent_id', $mainCategory->id)->pluck('id');
                $query->orWhereIn('category_id', $subcategoryIds);
                
                // Filter by specific subcategory if selected
                if ($subcategory) {
                    $query->where('category_id', $subcategory->id);
                }
            });
        
        // Apply any additional filters from the request
        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        
        if ($request->has('price_max') && $request->price_max > 0) {
            $query->where('price', '<=', $request->price_max);
        }
        
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }
        
        // Get paginated items
        $items = $query->paginate(12)->withQueryString();
        
        // Determine which template to use based on page type
        $template = 'frontend.pages.' . $pageType . '.listing';
        
        // Fallback to default if template doesn't exist
        if (!view()->exists($template)) {
            $template = 'frontend.pages.default.listing';
        }
        
        return view($template, compact(
            'mainCategory', 
            'subcategories', 
            'subcategory', 
            'items'
        ));
    }
    
    /**
     * Display a specific item detail
     */
    public function show($itemSlug, $mainSlug = null)
    {
        // Find the item by slug
        $item = Item::where('slug', $itemSlug)
            ->where('status', 'published')
            ->firstOrFail();
        
        // Get the category
        $category = Category::findOrFail($item->category_id);
        
        // Get the main category (parent)
        if ($mainSlug) {
            $mainCategory = Category::where('slug', $mainSlug)->firstOrFail();
        } else {
            $mainCategory = $category->parent_id 
                ? Category::findOrFail($category->parent_id) 
                : $category;
        }
        
        // Get related items
        $relatedItems = Item::where('category_id', $item->category_id)
            ->where('id', '!=', $item->id)
            ->where('status', 'published')
            ->take(4)
            ->get();
        
        // Get the item media
        $gallery = ItemMedia::where('item_id', $item->id)
            ->where('purpose', 'gallery')
            ->orderBy('display_order')
            ->get();
        
        // Add debug output
        \Log::info('Item Detail Page Data:', [
            'item_id' => $item->id,
            'title' => $item->title,
            'category' => $category->name,
            'main_category' => $mainCategory->name,
            'related_count' => $relatedItems->count(),
            'gallery_count' => $gallery->count()
        ]);
        
        return view('frontend.pages.default.detail', compact(
            'item', 
            'category',
            'mainCategory', 
            'relatedItems',
            'gallery'
        ));
    }


/**
 * Show booking form based on item category
 */
public function showBookingForm($id, Request $request)
{
    $item = Item::with('category')->findOrFail($id);
    $type = $request->query('type', 'hotel');
    
    // Choose view based on type parameter
    switch ($type) {
        case 'vehicle':
            return view('frontend.pages.booking.vehicle-rental-form', [
                'property' => $item,
                'item' => $item
            ]);
        case 'appointment':
            return view('frontend.pages.booking.appointment-form', [
                'property' => $item,
                'item' => $item
            ]);
        case 'hotel':
        default:
            return view('frontend.pages.booking.form', [
                'property' => $item,
                'item' => $item
            ]);
    }
}

/**
 * Process booking based on item type
 */
public function processBooking(Request $request)
{
    // First, validate common fields
    $validatedData = $request->validate([
        'property_id' => 'required|exists:items,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'terms' => 'required|accepted'
    ]);
    
    // Get the item
    $item = Item::findOrFail($request->property_id);
    $categorySlug = $item->category->slug ?? '';
    $mainCategory = $item->category->parent ? $item->category->parent->slug : $categorySlug;
    
    // Create generic booking record
    $booking = new \App\Models\Booking\PropertyBooking();
    $booking->item_id = $item->id;
    $booking->name = $request->name;
    $booking->email = $request->email;
    $booking->phone = $request->phone;
    
    // For vehicle rentals, check if columns exist before setting values
    if ($mainCategory == 'vehicles' && Schema::hasColumn('property_bookings', 'pickup_location')) {
        $booking->pickup_location = $request->pickup_location;
        $booking->return_location = $request->return_location;
        $booking->driver_included = $request->driver_included ?? 0;
    }
    // Associate with logged in user if available
    if (auth()->check()) {
        $booking->user_id = auth()->id();
    }
    
    // Process category-specific fields
    if ($mainCategory == 'hotels' || $categorySlug == 'hotels' || $categorySlug == 'accommodation') {
        // Hotel booking requires dates
        $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests' => 'required|integer|min:1|max:20',
        ]);
        
        // Calculate nights
        $checkInDate = new \DateTime($request->check_in_date);
        $checkOutDate = new \DateTime($request->check_out_date);
        $nights = $checkInDate->diff($checkOutDate)->days;
        
        // Calculate prices
        $basePrice = $item->price * $nights;
        $serviceFee = $basePrice * 0.10; // 10% service fee
        $totalPrice = $basePrice + $serviceFee;
        
        $booking->check_in_date = $request->check_in_date;
        $booking->check_out_date = $request->check_out_date;
        $booking->guests = $request->guests;
        $booking->base_price = $basePrice;
        $booking->service_fee = $serviceFee;
        $booking->total_price = $totalPrice;
        $booking->booking_type = 'hotel';
    } 
    elseif ($mainCategory == 'vehicles' || $categorySlug == 'vehicles') {
        // Vehicle rental booking
        $request->validate([
            'pickup_date' => 'required|date|after_or_equal:today',
            'pickup_time' => 'required',
            'return_date' => 'required|date|after:pickup_date',
            'return_time' => 'required',
            'pickup_location' => 'required|string',
            'return_location' => 'required|string',
        ]);
        
        // Calculate rental days
        $pickupDate = new \DateTime($request->pickup_date);
        $returnDate = new \DateTime($request->return_date);
        $days = $pickupDate->diff($returnDate)->days;
        
        // Calculate prices
        $basePrice = $item->price * $days;
        $driverFee = isset($request->driver_included) && $request->driver_included ? 50 * $days : 0; // $50 per day for driver
        $serviceFee = ($basePrice + $driverFee) * 0.10;
        $totalPrice = $basePrice + $driverFee + $serviceFee;
        
        $booking->check_in_date = $request->pickup_date;
        $booking->check_out_date = $request->return_date;
        $booking->check_in_time = $request->pickup_time;
        $booking->check_out_time = $request->return_time;
        $booking->pickup_location = $request->pickup_location;
        $booking->return_location = $request->return_location;
        $booking->driver_included = $request->driver_included ?? 0;
        $booking->base_price = $basePrice;
        $booking->additional_fees = $driverFee;
        $booking->service_fee = $serviceFee;
        $booking->total_price = $totalPrice;
        $booking->booking_type = 'vehicle';
    }
    elseif ($mainCategory == 'real-estate' || $categorySlug == 'real-estate') {
        // Property viewing scheduling
        $request->validate([
            'viewing_date' => 'required|date|after_or_equal:today',
            'viewing_time' => 'required',
        ]);
        
        $booking->check_in_date = $request->viewing_date;
        $booking->check_in_time = $request->viewing_time;
        $booking->base_price = 0; // Viewing is free
        $booking->service_fee = 0;
        $booking->total_price = 0;
        $booking->booking_type = 'viewing';
    }
    elseif ($mainCategory == 'consultancy' || $categorySlug == 'consultancy') {
        // Appointment booking
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'duration' => 'required|integer',
            'appointment_subject' => 'required|string|max:255',
        ]);
        
        // Calculate appointment price based on duration
        $durationHours = $request->duration / 60; // Convert minutes to hours
        $basePrice = $item->price * $durationHours;
        $serviceFee = $basePrice * 0.10;
        $totalPrice = $basePrice + $serviceFee;
        
        $booking->check_in_date = $request->appointment_date;
        $booking->check_in_time = $request->appointment_time;
        $booking->duration = $request->duration;
        $booking->subject = $request->appointment_subject;
        $booking->meeting_type = $request->meeting_type ?? 'in_person';
        $booking->base_price = $basePrice;
        $booking->service_fee = $serviceFee;
        $booking->total_price = $totalPrice;
        $booking->booking_type = 'appointment';
    }
    else {
        // Generic booking for other categories
        // Set default values
        $booking->base_price = $item->price;
        $booking->service_fee = $item->price * 0.10;
        $booking->total_price = $booking->base_price + $booking->service_fee;
        $booking->booking_type = 'general';
    }
    
    $booking->save();
    
    // Redirect to booking confirmation page
    return redirect()->route('booking.confirmation', $booking->booking_reference)
        ->with('success', 'Your booking request has been submitted successfully!');
}

/**
 * Show booking confirmation page
 */
public function bookingConfirmation($reference)
{
    $booking = \App\Models\Booking\PropertyBooking::where('booking_reference', $reference)->firstOrFail();
    $property = Item::findOrFail($booking->item_id);
    
    return view('frontend.pages.real-estate.booking-confirmation', [
        'booking' => $booking,
        'property' => $property,
        'item' => $property // For template flexibility
    ]);
}

/**
 * Show property viewing form (shortcut for real estate)
 */
public function showViewingForm($id)
{
    $property = Item::findOrFail($id);
    
    return view('frontend.pages.booking.property-viewing-form', [
        'property' => $property
    ]);
}

/**
 * Process property viewing request (shortcut for real estate)
 */
public function scheduleViewing(Request $request)
{
    // Redirect to the generic booking processor with viewing type
    $request->merge(['booking_type' => 'viewing']);
    return $this->processBooking($request);
}
}