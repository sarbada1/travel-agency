<?php

namespace App\Http\Controllers\Auth;

use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Repositories\Account\AccountType\AccountTypeInterface;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{


    use RegistersUsers;
    private $accountType;


    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AccountTypeInterface $accountType)
    {
        parent::__construct();
        $this->middleware('guest');
        $this->accountType = $accountType;
    }

    public function showRegistrationForm()
    {
        $accountTypeData = $this->accountType->all();
        return view('auth.register', compact('accountTypeData'));
    }

    public function redirectTo()
    {
        if (auth()->user()->account_type_id == 1) {
            return '/company-backend';
        } elseif (auth()->user()->account_type_id == 3) {
            return '/company-backend';
        } else {
            return '/login';
        }
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'account_type_id' => ['required'],
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'account_type_id' => $data['account_type_id'],
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
    
        event(new Registered($user = $this->create($request->all())));
    
        // $this->guard()->login($user);
    
        return redirect('/login')->with('message', 'Please check your email to verify your account.');
    }
}
