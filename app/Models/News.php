<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;
use Carbon\Carbon;


class News extends Model
{
    use HasFactory;
    public function modelRead()
    {
        $data = DB::table("news")->orderBy("id", "desc")->paginate(10);
        return $data;
    }
    public function modelGetRecord($id)
    {
        $record = DB::table("news")->where("id", "=", $id)->first();
        return $record;
    }
    public function modelUpdate($id)
    {
        $name = request("name");
        $category_id = request("category_id");
        $description = request("mota");
        $content = request("noidung");
        $create_at = Carbon::now('Asia/Ho_Chi_Minh');
        $hot = request("hot") != "" ? 1 : 0;
        DB::table("news")->where("id", "=", $id)->update(["name" => $name, "create_at" => $create_at, "category_id" => $category_id, "description" => $description, "content" => $content, "hot" => $hot]);

        if (Request::hasFile("photo")) {

            $oldPhoto = DB::table("news")->where("id", "=", $id)->select("photo")->first();
            if (isset($oldPhoto->photo) && file_exists('upload/news/' . $oldPhoto->photo) && $oldPhoto != "") unlink('upload/news/' . $oldPhoto->photo);
            //---
            $photo = time() . "_" . Request::file("photo")->getClientOriginalName();
            //thuc hien upload anh
            Request::file("photo")->move("upload/news", $photo);
            //update ban ghi
            DB::table("news")->where("id", "=", $id)->update(["photo" => $photo]);
        }
    }
    public function modelCreate()
    {
        $name = Request::get("name");
        $category_id = Request::get("category_id");
        $description = Request::get("mota");
        $content = Request::get("noidung");
        $create_at = Carbon::now('Asia/Ho_Chi_Minh');
        $hot = Request::get("hot") != "" ? 1 : 0;
        $photo = "";
        //neu co anh thi upload anh
        if (Request::hasFile("photo")) {
            $photo = time() . "_" . Request::file("photo")->getClientOriginalName();
            //thuc hien upload anh
            Request::file("photo")->move("upload/news", $photo);
        }
        //update ban ghi
        DB::table("news")->insert(["name" => $name, "category_id" => $category_id, "create_at" => $create_at, "description" => $description, "content" => $content, "hot" => $hot, "photo" => $photo]);
    }
    public function modelDelete($id)
    {
        //---
        //lay anh cu de xoa
        $oldPhoto = DB::table("news")->where("id", "=", $id)->select("photo")->first();
        if (isset($oldPhoto->photo) && file_exists('upload/news/' . $oldPhoto->photo) && $oldPhoto->photo != "")
            unlink('upload/news/' . $oldPhoto->photo);
        //---
        DB::table("news")->where("id", "=", $id)->delete();
    }
}