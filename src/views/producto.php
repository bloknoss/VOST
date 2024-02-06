<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VOST</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="stylesheet" href="/css/productos.css" />
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
  <div class="productos">
    <div class="carta">
      <img src="/public/assets/images/avida.webp" />
    </div>
    <div class="informacion">
      <div class="nombre">
        Avida Dollars
        <p class="category">C.Tangana</p>
      </div>
      <br />
      <div class="price">30€</div>
      <br />
      <div class="comprar">
        <input type="number" placeholder="1" value="1" min="1" class="input-quantity" />
        <button class="añadir">Añadir al carrito</button>
      </div>

      <br />
      <div class="descripcion">
        <h3>Descripción:</h3>
        <p>
          En 2018 C. Tangana cambiaba una vez más las reglas del juego con
          Avida Dollars, la mixtape que marcó todo un hito en la carrera del
          artista madrileño.
        </p>
        <p>
          Escoltado por los mejores productores nacionales -Alizzz, Steve
          Lean, Enry-K o Lost Twin- e internacionales -The Rudeboyz y Sky-
          moldeaba un sonido cohesionado y rico en matices donde la diversidad
          temática y el factor sorpresa marcaban la pauta de Still Rapping,
          Llorando en la Limo o Cavernet Sauvignon.
        </p>
      </div>
      <br />
      <div class="canciones">
        <p>
          <b>Canciones:</b>
        </p>
        <p>- Still Rapping</p>
        <p>- Baile de la Lluvia</p>
        <p>- Cuando Me Miras</p>
        <p>- Na de Na</p>
        <p>- Huele a Nuevo</p>
        <p>- Sangre</p>
        <p>- Llorando en la Limo</p>
        <p>- Cabernet Sauvignon</p>
        <p>- Pussy Call</p>
        <p>- Siempre Quise Todo</p>
        <p>- Estrecho / Alvarado</p>
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