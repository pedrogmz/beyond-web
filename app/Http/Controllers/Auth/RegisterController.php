<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Rules\MaxRegistrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Bestmomo\LaravelEmailConfirmation\Traits\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username_mt2' => 'required|max:255|unique:account,login',
            'del_code_mt2' => 'required|numeric',
            'tyc_checkbox' => 'required|accepted',
            'password_mt2' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        return User::create([
            'login' => $data['username_mt2'],
            'email' => $data['email_mt2'],
            'social_id' => '1234567',
            'password' => strtoupper("*".sha1(sha1($data['password_mt2'], true))),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function register(Request $request)
    {
        $request->validate([
            'email_mt2' => ['required', 'email', new MaxRegistrations, 'max:255'],
        ]);
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
