<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Felicitaciones, has realizado la compra exitosamente, a continuación están listados los productos de tu compra</h2>
    <ul>
        @foreach ($products as $product)
        <li>{{$product->product->name}}</li>
        @endforeach
    </ul>
</body>
</html>