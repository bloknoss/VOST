<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VOST</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/css/carrito.css" />
    <link rel="shortcut icon" href="/public/assets/images/logo.png" type="image/x-icon" />
</head>

<body>
    <header class="header">
        <div class="logo">
            <!---->
            <img src="/public/assets/images/logo.png" alt="Logo de la marca" />
        </div>
        <nav>
            <ul class="nav-links">
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li><a href="#">Carrito</a></li>
            </ul>
        </nav>
        <a class="btn" href="#"><button>Inicia Sesión</button><button>Registrate</button></a>

        <a onclick="openNav()" class="menu" href="#"><button>Menu</button></a>

        <div id="mobile-menu" class="overlay">
            <a onclick="closeNav()" href="" class="close">&times;</a>

            <div class="overlay-content">
            <a href="#">Inicio</a>

            <a href="#">Tienda</a>

            <a href="#">Carrito</a>

            <a href="#">Cuenta</a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="main">
           <!-- <div class="productos-disponibles">
                <h2>Productos Disponibles</h2>
                <div class="producto" data-id="1" data-precio="100">
                    <span class="nombre-producto">Producto 1</span>
                    <span class="precio-producto">$100</span>
                    <button class="agregar-producto">Agregar al carrito</button>
                </div>
                <div class="producto" data-id="2" data-precio="200">
                    <span class="nombre-producto">Producto 2</span>
                    <span class="precio-producto">$200</span>
                    <button class="agregar-producto">Agregar al carrito</button>
                </div>

            </div> -->
            <div class="carrito">
                <h2>Tu Carrito de Compras</h2>
                <div class="productos-en-carrito">

                </div>
                <div class="total">
                    <span>Total:</span>
                    <span class="precio-total">$0</span>
                </div>
            </div>
        </div>
    </div>
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
    <script type="text/javascript" src="/js/nav.js"></script>
    <script type="text/javascript" src="/js/carrito.js"></script>
</body>

</html>