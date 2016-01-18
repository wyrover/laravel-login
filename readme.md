# laravel-login

laravel 5 的注册/登录实践

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
    mix.sass('app.scss')
        .copy(jqueryPath + 'dist/jquery.min.js', 'public/assets/js')
        .copy(bpath + '/fonts', 'public/assets/fonts')
        .copy(bpath + '/javascripts/bootstrap.min.js', 'public/assets/js');
});


```

## 5. 修改 \resources\assets\sass\app.scss

```
// @import "resources/assets/vendor/bootstrap-sass/assets/stylesheets/bootstrap";
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