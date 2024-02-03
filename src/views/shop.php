<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VOST</title>
</head>
<body>
<?php for ($i = 0; $i < count($vinyls); $i++): ?>
    <div>
        <h2>Precio: <?= $vinyls[$i]->price ?>€</h2>
        <h2>Stock: <?= $vinyls[$i]->stock ?></h2>
    </div>
<?php endfor ?>
</body>
</html>
<?php
