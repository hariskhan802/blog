<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    PostController,
    CategoryController,
    UserController,
    LoginAndRegisterController,
    CommentController,
};
use App\Http\Controllers\Front\{
    HomeController,

};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Route::get('/', function () {
    \App\User::create([
                'name' => 'haris',
                'email' => 'haris@gmail.com',
                'password' => bcrypt('haris'),
                'image' => '',
            ]);
    die('ttttttttttt');
    return view('welcome');
});*/

Route::group([ 'middleware' => 'throttle:60,1'], function() {
    Route::match(['get', 'post'], 'login', [LoginAndRegisterController::class, 'login']);
    Route::match(['get', 'post'], 'register', [LoginAndRegisterController::class, 'register']);
    Route::get('logout', [LoginAndRegisterController::class, 'logout']);
});
Route::get('/', [HomeController::class, 'index']);
Route::get('post/{id}', [HomeController::class, 'post']);

Route::group(['prefix' => 'admin', 'middleware' => ['AdminCheck']], function() {
    Route::resource('users', 'UserController');
    Route::match(['get', 'post'], 'post/create', [PostController::class, 'create']);
    Route::get('/posts', [PostController::class, 'index']);
    Route::match(['get', 'post'], 'post/edit/{id}', [PostController::class, 'edit']);
    Route::match(['get', 'post'], 'post/delete/{id?}', [PostController::class, 'delete']);

    Route::match(['get', 'post'], 'category/create', [CategoryController::class, 'create']);
    Route::get('categories', [CategoryController::class, 'index']);
    Route::match(['get', 'post'], 'category/edit/{id}', [CategoryController::class, 'edit']);
    Route::match(['get', 'post'], 'category/delete/{id?}', [CategoryController::class, 'delete']);
    
    Route::resource('comments', \Admin\CommentController::class);
    Route::match(['get', 'post'], 'post-comment', [CommentController::class, 'post_comment']);
});
Route::get('user/verify/{token}', [LoginAndRegisterController::class, 'VerifyUser']);
// https://www.youtube.com/watch?v=mPWqz-bQpjs&list=PLGsHwf2MeBOja0l8Fk9EjZp3G9uzlsoJr&index=12
Route::get('mail', function(){
    $user/*['user']*/ = ['name' => 'haris', 'email' => 'hk3968833@gmail.com', 'url' => url('/user/verify/1234')];
    // \App\Events\MyE::dispatch($user);    
    // echo 'Email sent';
    $user = \App\User::find(6);
    $user->notify(new \App\Notifications\NewUserRegistered);
});

