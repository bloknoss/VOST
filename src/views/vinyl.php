<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $vinyl->name?></title>
</head>
<body>
<h2><?= $vinyl->name?></h2>
<h2><?= $vinyl->stock?></h2>
<h2><?= $vinyl->price?></h2>
<h2><?= $vinyl->duration?></h2>
<div>
<ul>
    <?php for ($i = 0; $i < count($songs); $i++): ?>
    <li><?= $songs[$i]['name']?></li>
    <?php endfor;?>
</ul>
</div>
</body>
</html>
<?php
