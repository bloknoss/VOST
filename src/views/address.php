<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VOST</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/css/activacion.css" />
    <link rel="shortcut icon" href="/public/assets/images/logo.png" type="image/x-icon" />
</head>


<header class="header">
    <div class="logo">
        <!---->
        <img src="/public/assets/images/logo.png" alt="Logo de la marca" />
    </div>
    <nav>
        <ul class="nav-links">
            <li><a href="/shop">Inicio</a></li>
            <li><a href="/shop">Tienda</a></li>
            <li><a href="/user/cart">Carrito</a></li>
        </ul>
    </nav>
    <a class="btn" href=""><button>Inicia Sesión</button></a><a href="/user/register"><button>Registrate</button></a>

    <a onclick="openNav()" class="menu" href="#"><button>Menu</button></a>

    <div id="mobile-menu" class="overlay">
        <a onclick="closeNav()" href="" class="close">&times;</a>

        <div class="overlay-content">
            <a href="/shop">Inicio</a>

            <a href="/shop">Tienda</a>

            <a href="/user/cart">Carrito</a>

            <a href="#">Cuenta</a>
        </div>
    </div>
</header>

<body>
    <h1>Tus direcciones</h1>
    <?php for ($i = 0; $i < count($addresses); $i++) : ?>
        <h2>Direccion : <?= $i + 1 ?></h2>
        <ul>
            <li>Postal code : <?= $addresses[$i]->postal_code ?></li>
            <li>Postal city : <?= $addresses[$i]->city ?></li>
            <li>Postal street : <?= $addresses[$i]->street ?></li>
            <li>Postal number : <?= $addresses[$i]->number ?></li>
            <button onclick="deleteAddress(<?= $addresses[$i]->id_address ?>)">Delete</button>
        </ul>
    <?php endfor; ?>
    <h1>Nueva dirección</h1>
    <form action="/user/address" method="post" id="addAddress">
        <label for="postal">Codigo postal
            <input type="number" max="99999" min="10000" name="postal_code" id="postal">
        </label>
        <label for="city">Ciudad
            <input type="text" name="city" id="city">
        </label>
        <label for="street">Calle
            <input type="text" name="street" id="street">
        </label>
        <label for="number">Numero
            <input type="text" name="number" id="number">
        </label>
        <button type="submit">
            Crear
        </button>
    </form>
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
                <a href="#"><img src="/public/assets/images/fb.png" alt="Logo de la marca" height="40px" /></a>
                <a href="#"><img src="/public/assets/images/tw.png" alt="Logo de la marca" height="40px" /></a>
                <a href="#"><img src="/public/assets/images/ig.png" alt="Logo de la marca" height="40px" /></a>
            </div>
        </div>
    </div>
    <div class="content-fooo">
        <h2 class="titulo-final">&copy; VOST</h2>
        <img src="/public/assets/images/metpago.png" alt="metpago" height="40px" />
    </div>
</footer>

</html>
<?php
