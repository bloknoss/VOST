<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VOST</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/css/tienda.css" />
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
    <div class="container">
        <div class="lineas"></div>
        <h1>TIENDA</h1>
        <div class="lineas"></div>
    </div>

    <div class="productos">
        <?php
        $j = 0;

        use VOST\models\tables\Vinyl;

        foreach ($vinyls as $vinyl) : ?>
            <div class="carta">
                <div class="card-img"><img src="/public/assets/images/avida.webp" alt="" /></div>
                <div class="info-card">
                    <div class="text-product">
                        <h3><?= $vinyl->name ?></h3>
                    </div>
                    <div class="price">
                        <h3><?= $vinyl->price ?> €</h3>
                    </div>
                </div>
                <div class="comprar">
                    <button><a href="/vinyl/<?= $vinyl->id_vinyl ?>">Ver mas</a></button>
                </div>
                <div>
                    <input style="display: none;" type="number" value="<?= $vinyl->id_vinyl ?>" id="id_vinyl<?= $j ?>" name="id_vinyl">
                    <form action="" id="form<?= $j ?>" method="post">
                        <input style="display: none;" type="number" value="1" name="quantity">
                        <button type="submit" id="addButton<?= $j ?>">
                            Añadir al carrito
                        </button>
                    </form>
                </div>
            </div>
            <?php $j++ ?>
        <?php endforeach ?>

    </div>
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

<!---->
<script type="text/javascript" src="nav.js"></script>

<script>
    for (let i = 0; i < <?= count($vinyls) ?>; i++) {
        let form = document.getElementById(`form${i}`);
        form.addEventListener('submit', async (ev) => {
            ev.preventDefault()
            let data = new FormData(form);
            let id_vinyl = document.getElementById('id_vinyl' + i).value
            let button = document.getElementById(`addButton${i}`)
            console.log(id_vinyl);
            fetch(`http://localhost:80/user/cart/${id_vinyl}`, {
                    method: 'POST',
                    body: data
                })
                .then(response => {
                    if (response.status === 200)
                        button.innerHTML = 'Añadido'
                    if (response.status === 400)
                        button.innerHTML = 'Bad request'
                    return response.text()
                })
                .then(res => console.log())
        })
    }
</script>
</body>

</html>
<?php
