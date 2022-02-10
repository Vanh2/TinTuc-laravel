@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading alert alert-primary" style="color: #fff">THÊM QUYỀN USER</div>
        <div class="panel-body">
            <div class="panel-heading alert alert-success" style="color: #fff;">Cấp quyền cho : {{$user->name }}</div>
            @if(isset($name_roles))
            <div class="panel-heading alert alert-success" style="color: #fff;">Vai trò hiện tại : {{$name_roles }}
            </div>
            @endif
            <form method="post" action="{{ url('users/permission',[$user->id]) }}">
                @csrf
                @foreach ($permission as $key => $per)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" @foreach ($get_permission_via_role as $key=>$value)
                    @if($value->id == $per->id) checked
                    @endif
                    @endforeach
                    name="permission[]" value="{{ $per->id }}"
                    id="{{ $per->id }}" >
                    <label class="form-check-label" for="{{ $per->id }}">{{$per->name }}</label>
                </div>
                @endforeach
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input type="submit" value="Cấp quyền cho user" class="btn btn-primary">
                    </div>
                </div>
                <!-- end rows -->
                <style type="text/css">
                input.form-control,
                input.form-control:focus {
                    border: 1px solid #ccc;
                }
                </style>
            </form>
            <form method="post" action="{{ url('users/permission') }}">
                @csrf
                <div class="form-check">
                    <label class="" for="">Tên quyền</label>
                    <input class="form-control" type="text" name="permission" value="" placeholder="Tên quyền cần thêm">
                </div>
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input type="submit" name="create_permission" value="Tạo thêm quyền" class="btn btn-primary">
                    </div>
                </div>
                <!-- end rows -->
                <style type="text/css">
                input.form-control,
                input.form-control:focus {
                    border: 1px solid #ccc;
                }
                </style>
            </form>
        </div>
    </div>
</div>
@endsection