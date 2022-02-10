<?php

use GuzzleHttp\Middleware;
use Illuminate\Routing\RouteGroupl;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
//url : public/login
Route::get("login", function () {
    return view("backend.login");
});
// sau khi ấn nút submit login
Route::post("login", function () {
    $email = request("email");
    $password = request("password");
    //Auth::Attempt-> trả về true nếu email, password khớp với bảng users
    if (Auth::Attempt(["email" => $email, "password" => $password]))
        return redirect(url("/news"));
    else
        return redirect("/login");
});
//url: public/logout
Route::get("logout", function () {
    Auth::logout(); //Auth là đối tượng có sẵn của laravel
    return redirect(url("login")); // di chuyển đến 1 url khác
});

// Khai báo các class controller ở đây
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\NewsController;
use App\Models\User;

Route::group(["middleware" => "checklogin", ['role:admin']], function () {
    // chức năng users - CRUD
    //read
    Route::get("users", [UsersController::class, "read"]);
    //update - get
    Route::get("users/update/{id}", [UsersController::class, "update"]);
    //update - post
    Route::post("users/update/{id}", [UsersController::class, "updatePost"]);
    //create - get
    Route::get("users/create", [UsersController::class, "create"]);
    //create - post
    Route::post("users/create", [UsersController::class, "createPost"]);
    //delete
    Route::get("users/delete/{id}", [UsersController::class, "delete"]);

    //phân vai trò
    Route::get('users/roles/{id}', [UsersController::class, "role"]);
    Route::post('users/roles/{id}', [UsersController::class, 'insert_roles']);
    // tạo thêm vai trò
    Route::post('users/roles', [UsersController::class, 'create_roles']);

    //phân quyền
    Route::get('users/permission/{id}', [UsersController::class, "permission"]);
    Route::post('users/permission/{id}', [UsersController::class, 'insert_permission']);
    // tạo thêm quyền
    Route::post('users/permission', [UsersController::class, 'create_permission']);
});
Route::group(["middleware" => "checklogin", ['role:admin|editor']], function () {
    // chức năng news - CRUD
    //read
    Route::get("news", [NewsController::class, "read"]);
    //update - get
    Route::get("news/update/{id}", [NewsController::class, "update"]);
    //update - post
    Route::post("news/update/{id}", [NewsController::class, "updatePost"]);
    //create - get
    Route::get("news/create", [NewsController::class, "create"]);
    //create - post
    Route::post("news/create", [NewsController::class, "createPost"]);
    //delete
    Route::get("news/delete/{id}", [NewsController::class, "delete"]);
});

//Comment
Route::post('news/detail/{id}', 'App\Http\Controllers\NewsController@postComment');

//frontend
// trang chủ
Route::get('/', function () {
    return view('frontend.home');
});
//Trang danh mục
Route::get("news/category/{category_id}", function ($category_id) {
    return view("frontend.newscategory", ["category_id" => $category_id]);
});
//Trang chi tiết
Route::get("news/detail/{id}", function ($id) {
    return view("frontend.newsdetail", ["id" => $id]);
});