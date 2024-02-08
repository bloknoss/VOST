<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
background-color: #9ec3d8;

    }
    .container{
        background-color: #41788d;
        width:  30%;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        
    }
    .container>div{
        display: flex;
align-items: center;
    }
    .container a{
        font-size: 30px;
        margin-bottom: 10px;
    }
</style>
<body>
    <div class="container">
<h1>BIENVENIDO A VOST</h1>

<a href="/user/login">Iniciar Sesión</a>
<a href="/user">Ver cuenta</a>
<a href="/user/logout">Cerrar Sesión</a>
<a href="/user/register">Registrarse</a>
<div id="user">

</div>
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
