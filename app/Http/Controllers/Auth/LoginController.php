<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    protected $redirectTo = '/company-backend';


    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }


    protected function authenticated(Request $request, $user)
    {
        if ($request->session()->has('last_product_page_id')) {
            $redirectUrl = $request->session()->get('last_product_page_id');
            $request->session()->forget('last_product_page_id');
            return redirect()->to($redirectUrl);
        }
        if ($user->account_type_id == 1) {
            // Admin
            return redirect('/company-backend');
        } elseif ($user->account_type_id == 3) {
            // Seller
            return redirect('/company-backend');
        } else {
            // Buyer or other account types
            return redirect('/');
        }    }
}
