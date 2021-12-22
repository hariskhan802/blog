<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    BlogController,
};
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function(){
    Route::get('/categories', [BlogController::class, 'get_categories']);

    Route::get('/posts-by-category/{id}', [BlogController::class, 'get_posts_by_category']);
    Route::get('/posts-by-user/{id}', [BlogController::class, 'get_posts_by_user']);
    Route::get('/post/search/{search}', [BlogController::class, 'get_post_result']);

    Route::post('/comment/create', [BlogController::class, 'comment_create']);
    Route::get('/get-comment/{id}', [BlogController::class, 'get_comment']);

    Route::post('/comment/update', [BlogController::class, 'update_comment']);
    Route::delete('/comment/delete/{id}', [BlogController::class, 'delete_comment']);
});



Route::post('/register', [BlogController::class, 'register']);
Route::match(['get', 'post'], '/login', [BlogController::class, 'login'])->name('login');
