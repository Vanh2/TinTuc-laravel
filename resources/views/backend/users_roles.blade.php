@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading alert alert-primary" style="color: #fff">THÊM VAI TRÒ USER</div>
        <div class="panel-body">
            <div class="panel-heading alert alert-success" style="color: #fff;">Cấp vai trò cho : {{$user->name }}</div>
            <form method="post" action="{{ url('users/roles',[$user->id]) }}">
                @csrf
                @foreach($role as $key => $r)
                <div class="row" style="margin-top:5px;">
                    @if(isset($rolesnow))
                    <div class="from-check from-check-inline">
                        <input class="from-check-input" {{$r->id == $rolesnow->id ? 'checked' : '' }} type="radio"
                            name="role" id="{{ $r->id }}" value="{{ $r->name }}">

                        <label class="from-check-label" for="{{ $r->id }}">{{ $r->name }}</label>
                    </div>
                    @else
                    <div class="from-check from-check-inline">
                        <input class="from-check-input" type="radio" name="role" id="{{ $r->id }}"
                            value="{{ $r->name }}">
                        <label class="from-check-label" for="{{ $r->id }}">{{ $r->name }}</label>
                    </div>
                    @endif
                </div>
                @endforeach

                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input type="submit" value="Cấp vai trò cho user" class="btn btn-primary">
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
            <form method="post" action="{{ url('users/roles') }}">
                @csrf
                <div class="form-check">
                    <label class="" for="">Tên vai trò</label>
                    <input class="form-control" type="text" name="roles" value="" placeholder="Tên vai trò cần thêm">
                </div>
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input type="submit" value="Tạo thêm vai trò" class="btn btn-primary">
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