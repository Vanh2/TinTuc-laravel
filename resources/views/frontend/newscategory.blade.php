@extends ("frontend.layout2")
@section("show-data")
<?php

use Carbon\Carbon;
?>
<?php
// lấy tiêu đề danh mục
$tag = DB::table("categories")->where("id", $category_id)->select("name")->first();
// lấy danh sách các bài tin có phân trang
$news = DB::table("news")->where("category_id", $category_id)->paginate(20);
?>
<div class="col-lg-8">
    <div class="col-12">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">{{ $tag->name }}</h4>
        </div>
    </div>
    @foreach($news as $rows)
    <div class="col-lg-12">
        <div class="d-flex align-items-center bg-white mb-3" style="height: 280px;">
            <img class="img-fluid" src="{{ asset('upload/news/'.$rows->photo) }}"
                style="height: 100%;width:calc(100%/2)" alt="">
            <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                <div class="mb-2">
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2"
                        href="">{{ $tag->name }}</a>
                    <a class="text-body" href="">
                        <small>
                            <?php
                            $now = Carbon::now('Asia/Ho_Chi_Minh');
                            $date = $rows->create_at;
                            $readtime = $now->diffInMinutes($date);

                            if ($readtime > 1440) {
                                echo floor($readtime / 1440) . " " . "ngày trước";
                            } else if ($readtime > 60) {
                                echo floor($readtime / 60) . " " . "giờ trước";
                            } else {
                                echo $readtime . " " . "phút trước";
                            }
                            ?>
                        </small>
                    </a>
                </div>
                <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" style=""
                    href="{{ url('news/detail/'.$rows->id) }}">{{ $rows->name }}</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection