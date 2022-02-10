<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\News;
use Carbon\Carbon;
use App\Models\Comment;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:add new|update new|delete new|read new', ['only' => ['read']]);
        $this->middleware('permission:add new', ['only' => ['create']]);
        $this->middleware('permission:update new', ['only' => ['update']]);
        $this->middleware('permission:delete new', ['only' => ['destroy']]);
    }

    public function read(Request $request)
    {
        $data = DB::table("news")->orderBy('id', 'desc')->paginate(10);
        return view('backend.news_read', ["data" => $data]);
    }

    // public function read()
    // {
    //     $data = $this->model->modelRead();
    //     return view("backend.news_read", ["data" => $data]);
    // }
    public function update($id)
    {
        $action = url("admin/news/update/$id");
        $record = $this->model->modelGetRecord($id);
        return view("backend.news_create_update", ["record" => $record, "action" => $action]);
    }
    public function updatePost($id)
    {
        $this->model->modelUpdate($id);
        return redirect(url("admin/news"));
    }
    public function create(Request $request)
    {
        //tao mot action de dua vao thuoc tinh action cua the form
        $action = url("admin/news/create");
        return view("backend.news_create_update", ["action" => $action]);
    }
    //create post
    public function createPost(Request $request)
    {
        $this->model->modelCreate();
        return redirect(url('admin/news'));
    }
    //delete
    public function delete(Request $request, $id)
    {
        $this->model->modelDelete($id);
        return redirect(url('admin/news'));
    }

    public function postComment(Request $request, $id)
    {
        $comment = new Comment;
        $comment->com_name = $request->name;
        $comment->com_email = $request->email;
        $comment->com_content = $request->content;
        $comment->new_id = $id;
        $comment->save();
        return back();
    }
}