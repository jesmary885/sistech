<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Generate Barcode in Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
@for ($i = 0; $i < $cantidad; $i++)

<div class="barcodeCode">
    <div>{!! DNS1D::getBarcodeHTML($cod_barra, 'C128') !!}</div>
</div>
<div>
    {{$cod_barra}}
</div>
<br>
    
@endfor
    

</body>
</html>