<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Hola</h1>
<button onclick="seeUser()">
    see User
</button>
<a href="/user/login">login</a>
<a href="/user">see User</a>
<a href="/user/logout">log out</a>
<a href="/user/register">CreateUser</a>
<div id="user">

</div>
<script>
    function seeUser(){
        fetch('http://localhost:80/user').then(el => el.text())
            .then(data => document.getElementById('user').innerHTML = data)
    }
</script>
</body>
</html>
<?php
