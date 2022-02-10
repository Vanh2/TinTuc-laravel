<!-- load file layout.blade.php vào đây -->
@extends("backend.layout")
<!-- đổ dữ liệu bên dưới vào file layout.blade.php, đổ vào tag do-du-lieu -->
@section("do-du-lieu")
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Danh sách tin tức</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center table-bordered mb-0">
                        <thead>
                            <tr>
                                <th style="width:100px"
                                    class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Photo
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Name</th>
                                <th style="width:100px"
                                    class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Category
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Hot</th>
                                <th class="text-secondary opacity-7">
                                    <a href="{{ url('/news/create') }}" class="btn btn-primary">Thêm tin
                                        tức</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $rows)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        @if (file_exists("upload/news/".$rows->photo))
                                        <img src="{{ asset('upload/news/'.$rows->photo) }}" style="max-width:150px">
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class=" mb-0 text-sm">{{ $rows->name }}</h6>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    $category = DB::table("categories")->where("id", "=", $rows->category_id)->first();
                                    echo isset($category->name) ? $category->name : "";
                                    ?>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">
                                        @if($rows->hot == 1)
                                        Hot
                                        @endif
                                    </span>
                                </td>

                                <td class="align-middle">
                                    <a href="{{ url('/news/update/'.$rows->id) }}"
                                        class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                        data-original-title="" style="padding-right:30px">
                                        Edit
                                    </a>
                                    <a href="{{ url('/news/delete/'.$rows->id) }}"
                                        class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                        data-original-title="" onclick="return window.confirm('Are you sure?')">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- javascript:;  -->
                </div>
                <style type="text/css">
                .pagination {
                    padding: 0px;
                    margin: 0px;
                }
                </style>
                <hr style="margin-top:30px">
                <!-- laravel hỗ trợ phân trang như sau -->
                {{ $data->render() }}
            </div>
        </div>
    </div>
</div>
@endsection