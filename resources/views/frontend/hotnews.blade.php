<?php

use Illuminate\Support\Carbon;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 px-0">
            <div class="owl-carousel main-carousel position-relative">
                <?php
                //offset(0) -> từ bản ghi thứ 0
                //take(3) -> lấy 3 bản ghi
                //get() -> lấy hết kết quả trả về
                $hotnews = DB::table("news")->orderBy("id", "desc")->offset(0)->take(3)->get();
                ?>
                @foreach($hotnews as $rows)
                <div class="position-relative overflow-hidden" style="height: 500px;">
                    <img class="img-fluid h-100" src="{{ asset('upload/news/'.$rows->photo) }}"
                        style="object-fit: cover;">
                    <div class="overlay">
                        <?php
                        $tag = DB::table("categories")->where("id", $rows->category_id)->first();
                        ?>
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                href="">{{ $tag->name }}</a>
                            <a class="text-white" href="">
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
                            </a>
                        </div>
                        <a class="h2 m-0 text-white text-uppercase font-weight-bold"
                            href="{{ url('news/detail/'.$rows->id) }}">{{ $rows->name }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <div class="col-lg-5 px-0">
            <div class="row mx-0">
                <?php
                $hotnews = DB::table("news")->orderBy("id", "desc")->offset(3)->take(4)->get();
                ?>
                @foreach($hotnews as $rows)
                <div class="col-md-6 px-0">
                    <div class="position-relative overflow-hidden" style="height: 250px;">
                        <img class="img-fluid w-100 h-100" src="{{ asset('upload/news/'.$rows->photo) }}"
                            style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <?php
                                $category_id = DB::table("categories")->where("name")->get();
                                $tag = DB::table("categories")->where("id", $rows->category_id)->first();
                                ?>
                                @foreach($category_id as $rows)

                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href="{{ url('news/detail/'.$rows->id) }}">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                            <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold"
                                href="{{ url('news/detail/'.$rows->id) }}">{{ $rows->name }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark py-3 mb-3">
    <div class="container">
        <div class="row align-items-center bg-dark">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">
                        Tin mới nhất</div>
                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                        style="width: calc(100% - 170px); padding-right: 90px;">
                        <?php
                        //offset(0) -> từ bản ghi thứ 0
                        //take(3) -> lấy 3 bản ghi
                        //get() -> lấy hết kết quả trả về
                        $hotnews = DB::table("news")->orderBy("id", "desc")->offset(0)->take(3)->get();
                        $n = 0;
                        ?>
                        @foreach($hotnews as $rows)
                        <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold"
                                href="">{{ $rows->name }}</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>