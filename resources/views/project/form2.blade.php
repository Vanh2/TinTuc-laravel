<?php
$so1 = Request::get("so1") != "" ? Request::get("so1") : 0;
$so2 = Request::get("so2") != "" ? Request::get("so2") : 0;
$ketqua = $so1 + $so2;
?>

<form method="post" action="">
    <!-- phải có hàm sau thì laravel mới bắt dữ liệu được sau khi ấn nút submit -->
    @csrf
    <fieldset style="width:300px;margin:20px auto;">
        <legend>Form</legend>
        <table cellpadding="5">
            <tr>
                <td>Só 1</td>
                <td><input type="number" name="so1" required></td>
            </tr>
            <tr>
                <td>Só 2</td>
                <td><input type="number" name="so2" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Thực hiện"></td>
            </tr>
        </table>
        <h1>{{ "$so1 +  $so2 = $ketqua" }}</h1>
    </fieldset>
</form>