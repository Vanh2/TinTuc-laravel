<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Comment extends Model
{
    protected $table = 'comment';
    protected $primaryKey = 'com_id';
    protected $guarded = [];
    public function modelCreated()
    {
        $created_at = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table("comment")->insert(["created_at" => $created_at]);
    }
}