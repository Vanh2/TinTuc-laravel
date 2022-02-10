<!-- load file layout.blade.php vào đây -->
@extends("frontend.layout")
@section("do-du-lieu")
<?php

use Carbon\Carbon;
?>
<div class="col-lg-8">
    <?php
    $tag = DB::select("select * from categories order by id asc");
    ?>
    @foreach($tag as $rows)
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                <h4 class="m-0 text-uppercase font-weight-bold">{{ $rows->name }}</h4>
                <a class="text-secondary font-weight-medium text-decoration-none"
                    href="{{ url('news/category'.$rows->id) }}">View All</a>
            </div>
        </div>
        <?php
        $news1 = DB::table("news")->where("category_id", "=", $rows->id)->orderBy("id", "desc")->offset(0)->take(2)->get();
        ?>
        @foreach($news1 as $rowsSub)
        <div class="col-lg-6">
            <div class="position-relative mb-3">
                <img class="img-fluid w-100" style="height:227px" src="{{ asset('upload/news/'.$rowsSub->photo) }}"
                    style="object-fit: cover;">
                <div class="bg-white border border-top-0 p-4" style="width:364px;height:142px">
                    <div class="mb-2">
                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                            href="">{{ $rows->name }}</a>
                        <a class="text-body" href="">
                            <small>
                                <?php
                                $now = Carbon::now('Asia/Ho_Chi_Minh');
                                $date = $rowsSub->create_at;
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
                    <a class="h4 d-block mb-0 text-secondary text-uppercase font-weight-bold" style="font-size: 16px;"
                        href="">{{$rowsSub->name}}</a>
                </div>
                <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">
                        <small>John Doe</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <small class="ml-3"><i class="far fa-eye mr-2"></i>12345</small>
                        <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <?php
        $news2 = DB::table("news")->where("category_id", "=", $rows->id)->orderBy("id", "desc")->offset(2)->take(2)->get();
        ?>
        <div class="col-lg-12">
            @foreach($news2 as $rowsSub)
            <div class="d-flex align-items-center bg-white mb-3" style="height: 200px;">
                <img class="img-fluid" src="{{ asset('upload/news/'.$rowsSub->photo) }}" style="height: 100%;" alt="">
                <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                    <div class="mb-2">
                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2"
                            href="">{{ $rows->name }}</a>
                        <a class="text-body" href="">
                            <small>
                                <?php
                                $now = Carbon::now('Asia/Ho_Chi_Minh');
                                $date = $rowsSub->create_at;
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
                        href="">{{ $rowsSub->name }}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection