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

<body>
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

  <div class="container">
    <div class="main">
      <div class="activation" action="/activation" method="post">
        <form class="form">
          <center>
            <h1>Activación</h1>
          </center>
          <p>
            Te hemos mandado un codigo de activacion al correo, si no lo ves
            puede estar en la carpeta de spam
          </p>
          <form action="/user/activate" method="post">
            <label for="activationCode">Inserta el codigo que recibiras en tu email</label>
            <input type="number" name="activationCode" id="activationCode" />
            <button type="submit">Enviar</button>
          </form>
        </form>
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
  <script type="text/javascript" src="nav.js"></script>
</body>

</html>