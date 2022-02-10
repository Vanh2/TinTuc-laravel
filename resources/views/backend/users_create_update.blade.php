@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-12">
    <div class="panel panel-primary">
        @if(Request::get("notify") == "emailExists")
        <div class="panel-heading alert alert-danger" style="color: #fff;">Email đã tồn tại, xin mời chọn email khác
        </div>
        @endif
        <div class="panel-heading alert alert-primary" style="color: #fff;">Thêm quản trị viên</div>
        <div class="panel-body">
            <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                @csrf
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Name</div>
                    <div class="col-md-10">
                        <input type="text" name="name" value="<?php echo isset($record->name) ? $record->name : "" ?>"
                            class="form-control" required>
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Email</div>
                    <div class="col-md-10">
                        <input type="email" <?php if (isset($record->email)) : ?> disabled <?php else : ?> required
                            <?php endif; ?> value="<?php echo isset($record->email) ? $record->email : "" ?>"
                            name="email" class="form-control">
                    </div>
                </div>
                <!-- end rows -->



                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Password</div>
                    <div class="col-md-10">
                        <input type="password" name="password" <?php if (isset($record->email)) : ?> <?php else : ?>
                            required <?php endif; ?> class="form-control"
                            placeholder="Không đổi password thì không nhập thông tin vào ô textbox này">
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input type="submit" value="Perform" class="btn btn-primary">
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