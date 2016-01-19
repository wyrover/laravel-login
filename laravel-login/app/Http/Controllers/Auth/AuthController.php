<?php

namespace Learnlaravel\Http\Controllers\Auth;

use Learnlaravel\User;
use Validator;
use Learnlaravel\Http\Controllers\Controller;
use Learnlaravel\Http\Requests\Auth\LoginRequest;
use Learnlaravel\Http\Requests\Auth\RegisterRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


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

    protected $user;
    protected $auth;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth, User $user)
    {
        $this->user = $user;
        $this->auth = $auth;
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
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function getLogin()
    {
        return View('users.login');
    }

    protected function postLogin(LoginRequest $request)
    {
        if ($this->auth->attempt($request->only('email', 'password'))) {
            //return "logined";
            return redirect()->route('dashboard');
        }
 
        return redirect('users/login')->withErrors([
            'email' => 'The email or the password is invalid. Please try again.',
        ]);
    }

    protected function getRegister()
    {
        return View('users.register');
    }

    protected function postRegister(RegisterRequest $request)
    {
        $this->user->name = $request->name;
        $this->user->email = $request->email;
        $this->user->password = bcrypt($request->password);
        $this->user->save();
        return redirect('users/login');
    }

    protected function getLogout()
    {
        $this->auth->logout();
        return redirect('users/login');
    }
}
