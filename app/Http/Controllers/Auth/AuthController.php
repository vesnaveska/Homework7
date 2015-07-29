<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
	
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		
		$rules = array(
            'first_name' => 'required|regex:/^([A-Za-z]+)$/',
            'last_name' => 'required|regex:/^([A-Za-z]+)$/',
            'email' => 'required|email|unique:users',
			'password' => 'required|confirmed|min:5'
        ); 
		
		$validator = Validator::make($data, $rules);
		
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
		
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {		
		$facebook = Socialite::driver('facebook')->user();

		if (empty(User::where('email', $facebook->getEmail())->first())) {	
        $user = User::firstOrCreate([
            'first_name' => $facebook->getName(),
            'email'     => $facebook->getEmail(),
			'password'  => bcrypt('55555')
        ]);
            Auth::login($user, true);
        } else {
            Auth::login(User::where('email', $facebook->getEmail())->first(), true);
        }

        return Redirect::to('/books');
    }
}