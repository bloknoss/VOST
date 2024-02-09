<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/carrito.css">
    <title>VOST</title>
    <style>


        .vinyl {

            padding: 1rem;
            background: #464450;
            color: whitesmoke;
            display: flex;
            flex-direction: column;
            text-align: center;

            width: 20vw;
            border-radius: 1rem;
            gap: 0.5rem;
            margin-top: 75px;
            margin-bottom: 75px;
            margin-left: 750px;
        }

        .vinyl > div {
            display: flex;
            align-items: center;
            gap: 0.2rem;

        }

        .vinyl h2 {
            margin-top: 40px;
            margin-bottom: -10px;
        }
    </style>
</head>

<body>
<header class="header">
    <div class="logo">
        <!---->
        <a href="/"> <img src="/public/assets/images/logo.png" alt="Logo de la marca"/></a>

    </div>
    <nav>
        <ul class="nav-links">
            <li><a href="/shop">Tienda</a></li>
            <li><a href="/user">Cuenta</a></li>
            <li><a href="/user/cart">Carrito</a></li>
            <li><a href="/user/address">Direcciones</a></li>
        </ul>
    </nav>


</header>
<div class="vinyl">
    <?php
    $i = 0;
    if (!is_array($vinyls)) $vinyls = [$vinyls];
    ?>
    <?php foreach ($vinyls as $vinyl) : ?>
        <h2>Nombre: <?= $vinyl->name ?></h2>
        <h2>Stock: <?= $vinyl->stock ?></h2>
        <h2>Precio: <?= $vinyl->price ?></h2>
        <h2>Duracion: <?= $vinyl->duration ?> min</h2>
        <form id="form<?= $i ?>" action="/user/cart/<?= $vinyl->id_vinyl ?>" method="post" target="_blank">
            <input style="display: none" type="number" name="quantity" value="<?= $vinyl->id_vinyl ?>">
        </form>
        <div id="song<?= $i ?>">
            <button onclick="seeSongs(<?= $vinyl->id_vinyl ?>, <?= $i ?>)">Ver canciones</button>
        </div>
        <?php $i++ ?>
    <?php endforeach; ?>

</div>
<script src="/js/funciones.js"></script>
</body>
<footer>
    <div class="contenedor-footer">
        <div class="content-foo">
            <h4>Atención al cliente</h4>
            <ul>
                <li><a href="#">Q&A</a></li>
                <li><a href="#">Envíos y pagos</a></li>
                <li><a href="#">Cambios y devoluciones</a></li>
                <li><a href="#">vostMusic@gmail.com</a></li>
            </ul>
        </div>
        <div class="content-foo">
            <h4>Empresa</h4>
            <ul>
                <li><a href="#">Sobre nosotros</a></li>
                <li><a href="#">Política de privacidad</a></li>
                <li><a href="#">Política de cookies</a></li>
                <li><a href="#">Condiciones generales</a></li>
            </ul>
        </div>
        <div class="content-foo">
            <h4>Redes sociales</h4>
            <div class="social-links">
                <a href="#"><img src="/public/assets/images/fb.png" alt="Logo de la marca" height="40px"/></a>
                <a href="#"><img src="/public/assets/images/tw.png" alt="Logo de la marca" height="40px"/></a>
                <a href="#"><img src="/public/assets/images/ig.png" alt="Logo de la marca" height="40px"/></a>
            </div>
        </div>
    </div>
    <div class="content-fooo">
        <h2 class="titulo-final">&copy; VOST</h2>
        <img src="/public/assets/images/metpago.png" alt="metpago" height="40px"/>
    </div>
</footer>
</html>

<?php


