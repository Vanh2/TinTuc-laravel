<!-- Xuất chuỗi lên màn hình -->
{{ "<h1>Chao xìn 1</h1>" }}
{!! "<h1>Chao xìn 2</h1>" !!}
<?php
$n = 6;
?>
@if($n % 2 == 0)
{!! "<h1>$n là số chẵn</h1>" !!}
@else
{!! "<h1>$n là số lẻ</h1>" !!}
@endif
<table cellpadding="5" border="1" style="width:300px; border-collapse: collapse;">
    @for($i = 1; $i <= 5; $i++) <tr>
        <td @if($i % 2==0) style="background: green;" @endif>
            <?php echo $i; ?></td>
        </tr>
        @endfor
</table>