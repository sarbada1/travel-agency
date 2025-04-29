@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="p-3 card-body">
                    <div class="row">
                        <div class="mt-3 mb-4 col-md-12">
                            <h2>
                                <i class="bi bi-eye-fill"></i> 
                                @if(auth()->user()->account_type_id == 1)
                                    Admin Dashboard
                                @elseif(auth()->user()->account_type_id == 2)
                                    Buyer Dashboard
                                @elseif(auth()->user()->account_type_id == 3)
                                    Seller Dashboard
                                @endif
                            </h2>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
                    </div>

                    {{-- Admin Dashboard Content --}}
                    @if(auth()->user()->account_type_id == 1)
                        <div class="row">
                            @foreach($accountTypes as $account)
                                <div class="col-md-3">
                                    <div class="card info-card customers-card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ucfirst($account->name)}}</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-people"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{$account->user->count()}}</h6>
                                                    <span class="pt-1 text-danger small fw-bold">Total</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    {{-- Buyer Dashboard Content --}}
                    @elseif(auth()->user()->account_type_id == 2)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Recent Bookings</h5>
                                        @if($myBookings->count() > 0)
                                            <div class="list-group">
                                                @foreach($myBookings as $booking)
                                                    <a href="{{ route('buyer.booking.show', $booking->id) }}" class="list-group-item list-group-item-action">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h6>{{ $booking->item->title }}</h6>
                                                            <small>{{ $booking->created_at->diffForHumans() }}</small>
                                                        </div>
                                                        <p class="mb-1">Status: {{ ucfirst($booking->status) }}</p>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted">No bookings yet.</p>
                                        @endif
                                        <div class="mt-3 text-center">
                                            <a href="{{ route('buyer.bookings') }}" class="btn btn-primary btn-sm">View All Bookings</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Saved Items</h5>
                                        @if($savedItems->count() > 0)
                                            <div class="list-group">
                                                @foreach($savedItems as $item)
                                                    <a href="" class="list-group-item list-group-item-action">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h6>{{ $item->title }}</h6>
                                                            <small>${{ number_format($item->price, 2) }}</small>
                                                        </div>
                                                        <p class="mb-1">{{ $item->category->name }}</p>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted">No saved items yet.</p>
                                        @endif
                                        <div class="mt-3 text-center">
                                            <a href="{{ route('buyer.wishlist') }}" class="btn btn-primary btn-sm">View Wishlist</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    {{-- Seller Dashboard Content --}}
                    @elseif(auth()->user()->account_type_id == 3)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h5 class="card-title">My Listings</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cart"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $myItems->count() }}</h6>
                                                <span class="pt-1 text-success small fw-bold">Total Items</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Pending Approvals</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-clock"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $pendingItems }}</h6>
                                                <span class="pt-1 text-warning small fw-bold">Pending Items</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">New Bookings</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $myBookings->count() }}</h6>
                                                <span class="pt-1 text-danger small fw-bold">Recent Bookings</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 card">
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <h5 class="m-0 card-title">My Listings</h5>
                                    <a href="{{ route('seller.create') }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i> Add New Listing
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($myItems as $item)
                                                <tr>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ $item->category->name }}</td>
                                                    <td>${{ number_format($item->price, 2) }}</td>
                                                    <td>
                                                        @if($item->status == 'active')
                                                            <span class="badge bg-success">Active</span>
                                                        @elseif($item->status == 'pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('seller.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                      
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No listings yet</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection