@extends("frontend.layout2")
@section("show-data")
<!-- News Detail Start -->
<div class="col-lg-8">
    <div class="position-relative mb-3">
        <?php
        $news = DB::table("news")->where("id", $id)->first();
        ?>
        <img class="img-fluid w-100" src="{{ asset('upload/news/'.$news->photo) }}" style="object-fit: cover;">
        <div class="bg-white border border-top-0 p-4">
            <div class="mb-3">

                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href=""></a>
                <a class="text-body" href=""></a>
            </div>
            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">{{ $news->name }}</h1>
            <p>{!! $news->description !!}</p>
            <p>{!! $news->content !!}</p>

        </div>
        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
            <div class="d-flex align-items-center">
                <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">
                <span>John Doe</span>
            </div>
            <div class="d-flex align-items-center">
                <span class="ml-3"><i class="far fa-eye mr-2"></i>12345</span>
                <span class="ml-3"><i class="far fa-comment mr-2"></i>123</span>
            </div>
        </div>
    </div>
    <!-- News Detail End -->

    <!-- Comment List Start -->

    <?php
    $comment = DB::table("comment")->where("new_id", $id)->get();
    ?>
    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">Bình luận</h4>
        </div>
        @foreach($comment as $rows)
        <div class="bg-white border border-top-0 p-4">
            <div class="media mb-4">
                <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                <div class="media-body">
                    <h6><a class="text-secondary font-weight-bold" href="">{{ $rows->com_name }}</a>
                        <small>
                            <i>{{ ($rows->created_at) }}</i>
                        </small>
                    </h6>
                    <p>{{ $rows->com_content }}</p>
                    <button class="btn btn-sm btn-outline-secondary">Reply</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Comment List End -->

    <!-- Comment Form Start -->
    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">Gửi bình luận</h4>
        </div>

        <div class="bg-white border border-top-0 p-4">
            <form method="post">

                <div class="form-row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="name" name="name" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message">Content *</label>
                    <textarea id="content" name="content" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group mb-0">
                    <input type="submit" value="Gửi bình luận" class="btn btn-primary font-weight-semi-bold py-2 px-3">
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    <!-- Comment Form End -->
</div>
@endsection