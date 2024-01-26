<?php

include_once (__DIR__.'/../src/controllers/router.php');
$pepe = 'Pepe';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hola</h1>
    <a href="/login">login</a>
    <a href="/user">see User</a>
    <a href="/logout">log out</a>
    <a href="/signin">CreateUser</a>
</body>
</html>