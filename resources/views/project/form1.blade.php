<form method="post" action="">
    <!-- phải có hàm sau thì laravel mới bắt dữ liệu được sau khi ấn nút submit -->
    @csrf
    <fieldset style="width:300px;margin:20px auto;">
        <legend>Form</legend>
        <input type="text" name="dulieu" required>
        <input type="submit" value="submit">
    </fieldset>
    <h1>Lấy dữ liệu trực tiếp từ view: {{ Request::get("dulieu") }}</h1>
</form>