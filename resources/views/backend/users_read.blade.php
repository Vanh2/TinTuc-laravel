<!-- load file layout.blade.php vào đây -->
@extends("backend.layout")
<!-- đổ dữ liệu bên dưới vào file layout.blade.php, đổ vào tag do-du-lieu -->
@section("do-du-lieu")
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Bảng quản trị viên</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <form method="post" enctype="multipart/form-data" action="">
                    @csrf
                    <div class="table-responsive ">
                        <table class="table align-items-center ">
                            <thead>
                                <tr>
                                    <th class="">
                                        Quản trị viên</th>
                                    <th class="" style="">
                                        Role</th>
                                    <th class="">
                                        Permissions
                                    </th>

                                    <th class="">
                                        <a href="{{url('users/create')}}" class="btn btn-primary">Add
                                            user</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key => $value)
                                <tr>
                                    <th>
                                        <div class="d-flex px-2 py-1">

                                            <div>
                                                <img src="" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                            </div>

                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $value->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $value->email }}</p>
                                            </div>
                                        </div>
                                    </th>

                                    @foreach ($value->roles as $key => $role)
                                    <th class="">
                                        <span class="btn btn-success">{{ $role->name }}</span>
                                    </th>
                                    @endforeach

                                    @foreach($role->permissions as $key => $permission)
                                    <th class="">
                                        <span class="btn btn-info">{{ $permission->name }}</span>
                                    </th>
                                    @endforeach

                                    <th class="">
                                        <a href="{{ url('/users/update/'.$value->id) }}" class="btn btn-warning">
                                            Edit
                                        </a>
                                        <a href="{{ url('/users/delete/'.$value->id) }}" class="btn btn-danger"
                                            onclick="return window.confirm('Are you sure?')">
                                            Delete
                                        </a>
                                        <a href="{{ url('users/roles/'.$value->id) }}" class="btn btn-success">Phân
                                            vai trò</a>
                                        <a href="{{ url('users/permission/'.$value->id) }}" class="btn btn-info">Phân
                                            quyền</a>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- javascript:;  -->
                    </div>
                </form>
                <style type="text/css">
                .pagination {
                    padding: 0px;
                    margin: 0px;
                }
                </style>
                <hr style="margin-top:30px">
                <!-- laravel hỗ trợ phân trang như sau -->

            </div>
        </div>
    </div>
</div>
@endsection