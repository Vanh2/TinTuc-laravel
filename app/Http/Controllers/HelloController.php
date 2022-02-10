<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// chú ý : trong controller muốn sử dụng đối tượng nào thì phải khai báo đối tượng đó với từ khoá use
use DB; // đối tượng thao tác csdl
use Hash; // đối tượng để mã hoá csdl

class HelloController extends Controller
{
    //tạo 1 action trong controller <=> tạo 1 hàm trong 1 lớp
    public function index()
    {
        echo "<h1>Hàm index trong file web.php là hàm nằm trong HelloController</h1>";
    }
    // truyền biến từ url vào action
    public function hello($bien1, $bien2)
    {
        echo "<h1>$bien1 $bien2</h1>";
    }
}