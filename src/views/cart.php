<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/carrito.css">
    <title>Carrito</title>
    <style>


        .vinyl {
            align-items: center;
            padding: 1rem;
            background: #464450;
            color: whitesmoke;
            display: flex;
            flex-flow: column wrap;
            width: 30vw;
            border-radius: 1rem;
            gap: 0.5rem;
        }

        .vinyl>div {
            display: flex;
            gap: 0.2rem;
            background: #464450;
        }

        input {
            width: 40px;
        }
        center{
            margin-bottom: 15px;
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
    <form action="/user/orders" method="post">
        <?php for ($i = 0; $i < count($cart); $i++) : ?>
            <div class="vinyl">

                <input type="checkbox" name="id_vinyls[]" id="id_vinyl<?= $i ?>" value="<?= $cart[$i]->vinyl->id_vinyl ?>">
                <h2>Nomnbre: <?= $cart[$i]->vinyl->name ?></h2>
                <h2>Precio: <?= $cart[$i]->vinyl->price ?>€</h2>
                <h2>Stock: <?= $cart[$i]->vinyl->stock ?></h2>
                <h2>Stock: <?= $cart[$i]->vinyl->duration ?></h2>
                <h2>Cantidad: <?= $cart[$i]->quantity ?></h2>
                <div>
                    <button onclick="deleteItem(<?= $cart[$i]->vinyl->id_vinyl ?>)">Eliminar</button>
                    <button><a href="/vinyl/<?= $cart[$i]->vinyl->id_vinyl ?>">Ver mas</a></button>
                    <label for="quantity">Cantidad</label>
                    <input type="number" name="quantity[<?= $cart[$i]->vinyl->id_vinyl ?>]" value="<?= $cart[$i]->quantity ?>" id="quantity<?= $i ?>" max="<?= $cart[$i]->vinyl->stock ?>" min="0">
                    <button onclick="updateQuantity(<?= $i ?>,<?= $cart[$i]->vinyl->id_vinyl ?>)">
                        Guardar
                    </button>
                </div>

            </div>
        <?php endfor ?>
        <?php
        $j = 0;

        ?>
        <?php foreach ($addresses as $address) : ?>
            <label style="color: black;" for="address<?= $j ?>">
                <h2>Calle: <?= $address->city ?></h2>
                <h2>Ciudad: <?= $address->postal_code ?></h2>
                <h2>Numero: <?= $address->street ?></h2>
                <h2>Codigo Postal: <?= $address->number ?></h2>
            </label>
            <input type="radio" name="id_address" id="address<?= $j++ ?>" value="<?= $address->id_address ?>">
        <?php endforeach; ?>
        <button type="submit">Comprar</button>
    </form>

   <center> <button onclick="deleteItems()">
        borrar todo
    </button></center>
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
