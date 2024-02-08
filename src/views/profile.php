<html lang="en">
<link rel="stylesheet" href="/css/profile.css">

<head>

    <style>
        * {
            font-family: 'Roboto', sans-serif;
            box-sizing: border-box;
        }

        #editForm {
            display: none;
        }

        .container {
            width: 100%;
            height: 30vh;
            background: #464450;
            color: whitesmoke;
            border-radius: 1rem;
            padding: 2rem;
            display: flex;
            flex-flow: column;
            align-content: space-between;
        }

        button {
            background: #28a745;
            height: 3rem;
            padding: 1rem;
            border-radius: 0.5rem;
            color: whitesmoke;
            border: none;
        }

        input {
            height: 3rem;
            padding: 0.5rem;
            border-radius: 0.25rem;
        }

        div h2 {
            color: lightgrey;
        }
    </style>
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

    <div class="container">
        <div>
            <h1>Your Profile</h1>
            <h2>User Name : <?= $_SESSION["user"]->name ?></h2>
            <h2>User Email : <?= $_SESSION["user"]->email ?></h2>
        </div>
        <div>
            <form action="/user/edit" method="post" id="editForm" target="">
                <label for="userName">User Name
                    <input type="text" name="userName" id="userName" value="<?= $_SESSION["user"]->name ?>">
                </label>
                <label for="email">Email
                    <input type="email" name="email" id="email" value="<?= $_SESSION["user"]->email ?>">
                </label>
                <button type="submit">
                    Save
                </button>
            </form>
            <button onclick="edit()">
                Edit
            </button>

        </div>
        <div id="orders">
            <button onclick="getOrders()">
                See orders
            </button>

        </div>
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
