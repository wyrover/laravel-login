# laravel-login

laravel 5 的注册/登录实践

本例子使用 laravel 5.2

## 1. 创建 laravel 工程

```
composer create-project laravel/laravel laravel-login
```


## 2. 修改工程命名空间

```
php artisan app:name Learnlaravel
```


## 3. 更新前端库

```
type nul> .bowerrc
```

编辑 `.bowerrc` 文件
``` 
{
    "directory": "resources/assets/vendor"
}
```

```
type nul> bower.json

```

编辑 `bower.json` 文件

```
{
    "name": "AppName",
    "dependencies": {
      "bootstrap-sass": "~3.3.5"
    }
}
```

```
bower install bootstrap-sass --save
```

删除 package.json 里的 bootstrap-sass 引用，然后执行 

```
npm install
```

## 4. 修改 gulpfile.js

``` javascript
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    var bpath = 'resources/assets/vendor/bootstrap-sass/assets';
    var jqueryPath = 'resources/assets/vendor/jquery';
    mix.sass('app.scss', 'public/assets/css')
        .copy(jqueryPath + '/dist/jquery.min.js', 'public/assets/js')
        .copy(bpath + '/fonts', 'public/assets/fonts')
        .copy(bpath + '/javascripts/bootstrap.min.js', 'public/assets/js');
});



```

## 5. 修改 \resources\assets\sass\app.scss

```
@import "resources/assets/vendor/bootstrap-sass/assets/stylesheets/bootstrap";
```


## 6. 执行 gulp



## 7. 定义路由


``` php
<?php
/* User Authentication */
Route::get('users/login', 'Auth\AuthController@getLogin');
Route::post('users/login', 'Auth\AuthController@postLogin');
Route::get('users/logout', 'Auth\AuthController@getLogout');

Route::get('users/register', 'Auth\AuthController@getRegister');
Route::post('users/register', 'Auth\AuthController@postRegister');

/* Authenticated users */
Route::group(['middleware' => 'auth'], function()
{
    Route::get('users/dashboard', array('as'=>'dashboard', function()
    {
        return View('users.dashboard');
    }));
});
```


## 8. 定义 controller

AuthController.php
``` php
<?php

// namespace ....

// use ...

/* IMPORTANT! 
   change namespace "Learnlaravel" in below statements to whatever you have set. 
   If not set then change it to "App" otherwise it will give an error 
   stating LoginRequest not found. */

use Illuminate\Contracts\Auth\Guard;
use Learnlaravel\Http\Requests\Auth\LoginRequest; 
use Learnlaravel\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{

    /**
     * User model instance
     * @var User
     */
    protected $user; 
    
    /**
     * For Guard
     *
     * @var Authenticator
     */
    protected $auth;

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

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

    /* Login get post methods */
    protected function getLogin() {
        return View('users.login');
    }

    protected function postLogin(LoginRequest $request) {
        if ($this->auth->attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }
 
        return redirect('users/login')->withErrors([
            'email' => 'The email or the password is invalid. Please try again.',
        ]);
    }

    /* Register get post methods */
    protected function getRegister() {
        return View('users.register');
    }

    protected function postRegister(RegisterRequest $request) {
        $this->user->name = $request->name;
        $this->user->email = $request->email;
        $this->user->password = bcrypt($request->password);
        $this->user->save();
        return redirect('users/login');
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    protected function getLogout()
    {
        $this->auth->logout();
        return redirect('users/login');
    }
}
```


## other

-  https://bhavyanshu.me/tutorials/easy-user-registration-and-authentication-in-laravel-5/09/24/2015/
-  http://laravelacademy.org/post/1258.html
-  https://phphub.org/topics/804
-  https://mattstauffer.co/blog/login-throttling-in-laravel-5.1
-  https://github.com/lstables/infinety
-  https://github.com/lstables/laravel-shop
-  https://github.com/lstables/laravel-bootstrapper
-  https://github.com/lstables/laravel-api-generator   
-  [Laravel Repository 模式](http://www.tuicool.com/articles/Mbimyy)
-  https://github.com/BootstrapCMS/CMS
-  http://laravelacademy.org/post/1359.html
-  https://phphub.org/topics/519