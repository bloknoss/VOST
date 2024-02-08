<html lang="en">
<link rel="stylesheet" href="/css/profile.css">

<head>

    <style>
        body{
            background: url("/public/assets/images/discos.jpg");
            background-size: cover;
        }
        * {
            font-family: 'Roboto', sans-serif;
            box-sizing: border-box;

        }

        #editForm {
            display: none;
        }

        .container {
            width: 700px;
            height: 40vh;
            background: #464450;
            color: whitesmoke;
            border-radius: 1rem;
            padding: 2rem;
            display: flex;
            flex-flow: column;
            margin-left:700px;
            margin-top: 100px;
            margin-bottom: 100px;
        }

        button {
            background: #41788d;
            height: 3rem;
            padding: 1rem;
            margin-top: 10px;
            
            border-radius: 0.5rem;
            color: whitesmoke;
            border: none;
        }
        .bot2 {
            background: #41788d;
            height: 3rem;
            padding: 1rem;
            margin-left: 7px;
            margin-top: 10px;
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
        <a href="/"> <img src="/public/assets/images/logo.png" alt="Logo de la marca" /></a>

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

<body>

    <div class="container">
        <div>
            <h1>Tu perfil</h1>
            <h2>Nombre : <?= $_SESSION["user"]->name ?></h2>
            <h2>Email : <?= $_SESSION["user"]->email ?></h2>
        </div>
        <div>
            <form action="/user/edit" method="post" id="editForm" target="">
                <label for="userName">Nombre
                    <input type="text" name="userName" id="userName" value="<?= $_SESSION["user"]->name ?>">
                </label>
                <label for="email">Email
                    <input type="email" name="email" id="email" value="<?= $_SESSION["user"]->email ?>">
                </label>
                <button class="bot2" type="submit">
                    Guardar
                </button>
            </form>
            <button onclick="edit()">
                Editar
            </button>

        </div>
        <div id="orders">
            <button onclick="getOrders()">
                Ver pedidos
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
