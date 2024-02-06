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
            <li><a href="/src/views/inicioView.php">Inicio</a></li>
            <li><a href="/src/views/tienda.php">Tienda</a></li>
            <li><a href="/src/views/carrito.php">Carrito</a></li>
        </ul>
    </nav>
    <a class="btn" href="/src/views/registro.php"><button>Inicia Sesión</button><button>Registrate</button></a>

    <a onclick="openNav()" class="menu" href="#"><button>Menu</button></a>

    <div id="mobile-menu" class="overlay">
        <a onclick="closeNav()" href="" class="close">&times;</a>

        <div class="overlay-content">
            <a href="/src/views/inicioView.php">Inicio</a>

            <a href="/src/views/tienda.php">Tienda</a>

            <a href="/src/views/carrito.php">Carrito</a>

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
        <div class="carta">
            <div class="card-img"><img src="/public/assets/images/avida.webp" alt="" /></div>
            <div class="info-card">
                <div class="text-product">
                    <h3>Avida Dollars</h3>
                    <p class="category">C.Tangana</p>
                </div>
                <div class="price">
                    <h3>30€</h3>
                </div>
            </div>
            <div class="comprar">
                <button>Ver más</button>
            </div>
        </div>
        <div class="carta">
            <div class="card-img"><img src="/public/assets/images/sfdk.png" alt="" /></div>
            <div class="info-card">
                <div class="text-product">
                    <h3>Inkebrantable</h3>
                    <p class="category">SFDK</p>
                </div>
                <div class="price">
                    <h3>30€</h3>
                </div>
            </div>
            <div class="comprar">
                <button>Ver más</button>
            </div>
        </div>
        <div class="carta">
            <div class="card-img"><img src="/public/assets/images/kaseo.jpg" height="400px" /></div>
            <div class="info-card">
                <div class="text-product">
                    <h3>El Círculo</h3>
                    <p class="category">Kase.O</p>
                </div>
                <div class="price">
                    <h3>30€</h3>
                </div>
            </div>
            <div class="comprar">
                <button>Ver más</button>
            </div>
        </div>
        <div class="carta">
            <div class="card-img"><img src="/public/assets/images/mj.webp" height="400px" /></div>
            <div class="info-card">
                <div class="text-product">
                    <h3>Thriller</h3>
                    <p class="category">Michael Jackson</p>
                </div>
                <div class="price">
                    <h3>25€</h3>
                </div>
            </div>
            <div class="comprar">
                <button>Ver más</button>
            </div>
        </div>
        <div class="carta">
            <div class="card-img"><img src="/public/assets/images/divide.jpg" height="400px" /></div>
            <div class="info-card">
                <div class="text-product">
                    <h3>Divide</h3>
                    <p class="category">Ed Sheran</p>
                </div>
                <div class="price">
                    <h3>35€</h3>
                </div>
            </div>
            <div class="comprar">
                <button>Ver más</button>
            </div>
        </div>
        <div class="carta">
            <div class="card-img"><img src="/public/assets/images/br.jpg" alt="" /></div>
            <div class="info-card">
                <div class="text-product">
                    <h3>Bohemian Rhapsody</h3>
                    <p class="category">Queen</p>
                </div>
                <div class="price">
                    <h3>30€</h3>
                </div>
            </div>
            <div class="comprar">
                <button>Ver más</button>
            </div>
        </div>
        <div class="carta">
            <div class="card-img"><img src="/public/assets/images/adele.jpg" alt="" /></div>
            <div class="info-card">
                <div class="text-product">
                    <h3>Someone like you</h3>
                    <p class="category">Adele</p>
                </div>
                <div class="price">
                    <h3>30€</h3>
                </div>
            </div>
            <div class="comprar">
                <button>Ver más</button>
            </div>
        </div>
        <div class="carta">
            <div class="card-img"><img src="/public/assets/images/mmcd.webp" height="400px"alt="" /></div>
            <div class="info-card">
                <div class="text-product">
                    <h3>Me Muevo Con Dios</h3>
                    <p class="category">Cruz Cafuné</p>
                </div>
                <div class="price">
                    <h3>30€</h3>
                </div>
            </div>
            <div class="comprar">
                <button>Ver más</button>
            </div>
        </div>
        <div class="carta">
            <div class="card-img"><img src="/public/assets/images/foyone.png"  /></div>
            <div class="info-card">
                <div class="text-product">
                    <h3>Presidente</h3>
                    <p class="category">Foyone</p>
                </div>
                <div class="price">
                    <h3>20€</h3>
                </div>
            </div>
            <div class="comprar">
                <button>Ver más</button>
            </div>
        </div>

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

</html>