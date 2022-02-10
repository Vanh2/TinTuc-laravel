<div class="bg-white border border-top-0 p-3">
    <div class="d-flex flex-wrap m-n1">
        <?php
        $tag = DB::select("select * from categories order by id asc");
        ?>
        @foreach($tag as $rows)
        <a href="{{ url('news/category/'.$rows->id) }}"
            class="btn btn-sm btn-outline-secondary m-1">{{ $rows->name }}</a>
        @endforeach
    </div>
</div>