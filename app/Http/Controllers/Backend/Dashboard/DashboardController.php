<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Models\Item\Item;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\Resume\Resume;
use App\Models\Booking\Booking;
use App\Models\Contact\Contact;
use App\Models\User\AccountType;
use App\Http\Controllers\Backend\Common\BackendController;
use App\Models\Booking\PropertyBooking;
use App\Repositories\Ad\CampaignInterface;


class DashboardController extends BackendController
{
    protected $campaignInterface;

    public function __construct(CampaignInterface $campaignInterface)
    {
        parent::__construct();
        $this->campaignInterface = $campaignInterface;
    }
    public function index()
    {
        $user = auth()->user();
        $accountType = $user->account_type_id;

        // Shared data for all dashboards
        $data = [
            'user' => $user,
            'accountTypes' => AccountType::all(),
        ];

        // Add user-specific data based on account type
        if ($accountType == 1) {
            // Admin data
            $data['totalUsers'] = User::count();

  
        }
        $this->data = array_merge($this->data, $data);
        return view($this->pagePath . 'dashboard.index', $this->data);
    }


    public function contact(Request $request)
    {
        $this->checkAuthorization($request->user(), 'contacts_list');
        $this->data('contactData', Contact::orderBy('id', 'desc')->get());
        return view($this->pagePath . 'contact.index', $this->data);
    }

 

    public function deleteContact(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'contacts_delete');
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->back()->with('success', 'Contact Deleted Successfully');
    }

 
}
