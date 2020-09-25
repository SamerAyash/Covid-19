<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
</head>
<body class="text-center d-flex align-items-center">

    {!!  \QrCode::size(400)
            ->encoding('UTF-8')
            ->format('png')
            ->gradient(250, 0, 180, 100,50, 150, 'vertical')
            ->generate('100000000'.$id.','.$place) !!}

</body>
</html>
