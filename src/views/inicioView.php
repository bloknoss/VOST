<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VOST</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/css/inicioview.css" />
    <link rel="shortcut icon" href="/public/assets/images/logo.png" type="image/x-icon" />
</head>
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

<body>
    <div class="bestsellers"><b>Mas Vendidos</b></div>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="icons">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    <img src="/public/assets/images/logo.png" alt="" />
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div class="product-content">
                    <div class="product-txt">
                        <span>80€</span>
                        <h3>Vinilo "El círculo"</h3>
                        <p></p>
                    </div>
                    <div class="product-img">
                        <img src="/public/assets/images/kaseo.jpg" alt="" />
                    </div>
                </div>
                <a href="#" class="btn-1">Comprar</a>
            </div>
            <div class="swiper-slide">
                <div class="icons">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    <img src="/public/assets/images/logo.png" alt="" />
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div class="product-content">
                    <div class="product-txt">
                        <span>80€</span>
                        <h3>Vinilo "El círculo"</h3>
                        <p></p>
                    </div>
                    <div class="product-img">
                        <img src="/public/assets/images/kaseo.jpg" alt="" />
                    </div>
                </div>
                <a href="#" class="btn-1">Comprar</a>
            </div>
            <div class="swiper-slide">
                <div class="icons">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    <img src="/public/assets/images/logo.png" alt="" />
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div class="product-content">
                    <div class="product-txt">
                        <span>80€</span>
                        <h3>Vinilo "El círculo"</h3>
                        <p></p>
                    </div>
                    <div class="product-img">
                        <img src="/public/assets/images/kaseo.jpg" alt="" />
                    </div>
                </div>
                <a href="#" class="btn-1">Comprar</a>
            </div>
            <div class="swiper-slide">
                <div class="icons">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    <img src="/public/assets/images/logo.png" alt="" />
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div class="product-content">
                    <div class="product-txt">
                        <span>80€</span>
                        <h3>Vinilo "El círculo"</h3>
                        <p></p>
                    </div>
                    <div class="product-img">
                        <img src="/public/assets/images/kaseo.jpg" alt="" />
                    </div>
                </div>
                <a href="#" class="btn-1">Comprar</a>
            </div>
            <div class="swiper-slide">
                <div class="icons">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    <img src="/public/assets/images/logo.png" alt="" />
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div class="product-content">
                    <div class="product-txt">
                        <span>80€</span>
                        <h3>Vinilo "El círculo"</h3>
                        <p></p>
                    </div>
                    <div class="product-img">
                        <img src="/public/assets/images/kaseo.jpg" alt="" />
                    </div>
                </div>
                <a href="#" class="btn-1">Comprar</a>
            </div>
            <div class="swiper-slide">
                <div class="icons">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    <img src="/public/assets/images/logo.png" alt="" />
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div class="product-content">
                    <div class="product-txt">
                        <span>80€</span>
                        <h3>Vinilo "El círculo"</h3>
                        <p></p>
                    </div>
                    <div class="product-img">
                        <img src="/public/assets/images/kaseo.jpg" alt="" />
                    </div>
                </div>
                <a href="#" class="btn-1">Comprar</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            loop: true,
            coverflowEffect: {
                depth: 500,
                modifer: 1,
                slidesShadows: true,
                rotate: 0,
                strecth: 0,
            },
        });
    </script>

    <section class="container-related-products">
        <div class="news"><b>Novedades</b></div>
        <div class="card-list-products">
            <div class="card">
                <div class="card-img">
                    <img src="/public/assets/images/sfdk.png" alt="producto-1" />
                </div>
                <div class="info-card">
                    <div class="text-product">
                        <h3>Inkebrantable</h3>
                        <p class="category">SFDK</p>
                    </div>
                    <div class="price"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-img">
                    <img src="/public/assets/images/sfdk.jpg" alt="producto-2" />
                </div>
                <div class="info-card">
                    <div class="text-product">
                        <h3>Inkebrantable</h3>
                        <p class="category">SFDK</p>
                    </div>
                    <div class="price"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-img">
                    <img src="/public/assets/images/sfdk.jpg" alt="producto-3" />
                </div>
                <div class="info-card">
                    <div class="text-product">
                        <h3>Inkebrantable</h3>
                        <p class="category">SFDK</p>
                    </div>
                    <div class="price"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-img">
                    <img src="/public/assets/images/sfdk.jpg" alt="producto-4" />
                </div>
                <div class="info-card">
                    <div class="text-product">
                        <h3>Inkebrantable</h3>
                        <p class="category">SFDK</p>
                    </div>
                    <div class="price"></div>
                </div>
            </div>
        </div>
    </section>
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