<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return view('welcome');
});
/*
    - Khi gõ 1 url , laravel sẽ nhận biết url đó thông qua các cấu trúc sau
        - Route::get("duongdanao",function(){}); -> GET
        - Route::post("duongdanao",function(){}); -> POST
        - Route::any("duongdanao",function(){}); -> GET, POST
*/
//url : public/hello
Route::get("hello", function () {
    echo "<h1>Hello words</h1>";
});
/*
    Truyền biến lên url
    Route::get("duongdanao/{bien1}/{bien2}",function($bien1,$bien2){});
*/
//url : public/truyenbien/Xin/Chào
Route::get("dayladuongdanao/{bien1}/{bien2}", function ($bien1, $bien2) {
    echo "<h1>$bien1 $bien2</h1>";
});
/*
    Khi url có tag chung thì có thể nhóm theo tag chung đó
    Route::group(["prefix"=>"tentagchung"],function(){ các đường dẫn ảo khác });
*/
// group theo tag chung có thể là admin
// admin/users , admin/news....
Route::group(["prefix" => "admin"], function () { // có thể điền bất kỳ từ gì vào để thay thế "admin"
    // các đường dẫn ảo khác
    Route::get("users", function () {
        echo "<h1>Trang users</h1>";
    });
    Route::get("news", function () {
        echo "<h1>Trang tin tức</h1>";
    });
});
/*
    Gọi view
    return view("tenthumuc.tenview",truyen_bien_ra_view_neu_co);
*/
//url : public/goiview1
Route::get("goiview1", function () { // có thể điền bất kể gì vào trong "goiview1"
    return view("project.view1");
});
/*
    Truyền biến ra view
    return view("tenthumuc/tenview",bientruyenra);
    Chú ý : bientruyenra phải là một array
*/
//url: public/goiview2
Route::get("goiview2", function () {
    //array("tenkey"=>"tenvalue") <=> ["tenkey"=>"tenvalue"]
    return view("project.view2", ["hoten" => "Nguyễn Văn A", "email" => "nva@gmail.com"]);
});
// Các cấu trúc trong view (blade engine)
// Xuất biến , chuỗi <=> echo trong php

//  {{ "chuoi" }} <=> <?php echo "chuoi"; 
//  {{ $bien }} <=> <?php echo $bien; 
//  {!! "chuoi" !!} <=> <?php echo "chuoi";
//  {!! $bien !!} <=> <?php echo $bien;
/*
    Khối lệnh if
        @if(kết quả so sánh trả về true)
            html + code
        @else if(kết quả so sánh trả về true)
            html + code
        @else
            html + code
        @endif   
    Khối lệnh for
        @for (batdau; ketthuc; lamsaodeketthuc)
            html + code
        @endfor
    Khối lệnh foreach
        @foreach(array as $key=>$value)
            html + code
        @endforeach
*/
// url : public/goiview3
Route::get("goiview3", function () {
    return view("project.view3");
});
/*
    - Form trong laravel
        - Trong thẻ form phải có lệnh sau thì mới bắt đầu dữ liệU được sau khi ấn submit : @csrf
        - Trạng thái bắt đầu của trang là GET -> trong file web.php sẽ thực hiện Route::get
        - Sau khi ấn nút submit thì trạng thái sẽ là POST -> trong file web.php sẽ thực hiện Route::post
        - Đối tượng Request::get("tentheform") sẽ lấy dữ liệU theo kiểu GET , POST
*/
//url : public/goiform1
// trạng thái bắt đầu của trang là GET -> Route::get
Route::get("goiform1", function () {
    return view("project.form1");
});
// sau khi ấn nút submit thì trạng thái của trang sẽ là POST -> Route::post
Route::post("goiform1", function () {
    // lấy dữ liệu
    $dulieu = Request("dulieu");
    return view("project.form1", ["dulieu" => $dulieu]);
});
//url : public/cong2so -> trạng thái đang là GET
Route::get("cong2so", function () {
    return view("project.form2");
});
//url : public/cong2so -> sau khi ấn nút submit
Route::post("cong2so", function () {
    return view("project.form2");
});
//--------------
Route::get("trangchu", function () {
    return view("project.trangchu");
});
Route::get("gioithieu", function () {
    return view("project.gioithieu");
});

/*
    - Tìm hiểU middleware
        - Các file middleware nằm tại đường dẫn : app\http\Middleware\các file
        - Tạo middleware bằng câu lệnh : php artisan make:middleware Hello
        - Chú ý : các câu lệnh cmd dùng để tạo controller , view, middleware... thì cmd đó phải có đường dẫn nằm trong thư mục project_laravel
        - Sau khi tạo file Hello.php xong thì phải đăng ký middleware này vào hệ thống thì mới sử dụng được
*/
// Gọi middleware
Route::get("project/hello", function () {
    echo "<h1>Gọi middleware Hello vừa tạo</h1>";
})->Middleware("dattengicungduoc");
//Tìm hiểu controller
//Muốn sử dụng controller thì phải tạo, khai báo nó
//Tạo controller : php artisan make:controller tenController
//Phải khai báo đường dẫn controller ở đây thì mới có tác động được vào file controller
use App\Http\Controllers\HelloController;
use Illuminate\Support\Facades\Hash;

//Gọi hàm index trong class HelloController
Route::get("goicontroller1", [HelloController::class, "index"]); // Khai báo array : $bien = array() hoặc $bien=[]
// Nếu sử dụng trong file web.php thì không cần khai báo đối tượng : DB, Request, Hash...
// Nếu sử dụng file TenController.php thì phải khai báo các đối tượng trên
// DB : đối tượng thao tác csdl
// Request: lấy giá trị của thẻ form theo phương thức GET , POST
// Hash : mã hoá chuỗi ra định dạng md5
/*
    - Truyền biến từ url vào controller
    Vd : public/goicontroller2/Hello/2021 -> gọi hàm , truyền vào 2 tham số
*/
Route::get("goicontroller2/{bien1}/{bien2}", [HelloController::class, "hello"]);
/*
    - Thao tác csdl
        - Kết nối csdl : open file .env , thay đổi thông số kết nối ở dòng 12 , 13 , 14
        - Laravel có câu lệnh để tự động tạo 1 số bảng. Trong cmd chạy lệnh : php artisan migrate
*/
/*
    - Một số cách truy vấn csdl
        - Sử dụng query builder : đối tượng DB::....
        - Tác động vào bảng : DB::table("tenbang")->where()->orderBy()->...
        - Lấy nhiều bản ghi
            DB::table("tenbang")->where("tenbang","sosanh","tencot")->get();
        - Lấy 1 bản ghi
            DB::table("tenbang")->where("tenbang","sosanh","tencot")->first();
        - Phân trang
            DB::table("tenbang")->where("tenbang","sosanh","tencot")->paginate(số bản ghi trên 1 trang);
        - Order by
            DB::table("tenbang")->where("tenbang","sosanh","tencot")->orderBy("tencot","asc/desc");
        ...
    - Sử dụng Model
*/
Route::get("pwd", function () {
    echo Hash::make("123");
});
//url : public/csdl1
Route::get("csdl1", function () {
    //truy vấn lấy tất cả các bản ghi trong table users
    $users = DB::table("users")->orderBy("email", "asc")->get();
    foreach ($users as $rows) {
        echo "<div>$rows->id - $rows->name - $rows->email</div>";
    }
});
/*
    - Tạo controller : php artisan make:controller TenController.php
    - Tạo model : php artisan make:model Ten.php
    - Tạo view : php artisan make:view ten
    - Tạo middleware : php artisan make:middleware Ten
    - Restore một số bảng csdl lên database (trước khi thực hiện phải khai báo thông tin kết nối csdl ở file .env dòng 12,13,14): php artisan:migrate
*/
/*
    Tạo các controller
    php artisan make:controller UsersController
    php artisan make:controller CategoriesController
    php artisan make:controller NewsController
    php artisan make:middleware CheckLogin
*/