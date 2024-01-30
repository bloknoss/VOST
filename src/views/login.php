<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SaludOnline</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" />
  <link rel="stylesheet" href="/css/login.css" />
  <link rel="shortcut icon" href="/img/logo.png" type="image/x-icon" />
  <style>
    body {
      width: 100%;
      margin: 0;
      padding: 0;
      background: url("/public/assets/images/discos.jpg");
      background-size: cover;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
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
      <li><a href="#">Generos</a></li>
      <li><a href="#">hhhhhhh</a></li>
      <li><a href="#">hhhhhhh</a></li>
    </ul>
  </nav>
  <a class="btn" href="#"><button>Inicia Sesión / Registrate</button></a>

  <a onclick="openNav()" class="menu" href="#"><button>Menu</button></a>

  <div id="mobile-menu" class="overlay">
    <a onclick="closeNav()" href="" class="close">&times;</a>

    <div class="overlay-content">
      <a href="#">Generos</a>

      <a href="#">hhhhhhh</a>

      <a href="#">hhhhhhh</a>

      <a href="#">Contacto</a>
    </div>
  </div>
</header>

<body>
  <div class="container">
    <div class="main">
      <input type="checkbox" id="chk" aria-hidden="true" />

      <div class="login">
        <form class="form" action="/login" method="post">
          <label for="chk" aria-hidden="true">Iniciar sesión</label>
          <input class="input" type="text" name="email" placeholder="Email/Nombre" required />
          <input class="input" type="password" name="pswd" placeholder="Contraseña" required />
          <button>Iniciar Sesión</button>
        </form>
      </div>

      <div class="register" action="/register" method="post">
        <form class="form">
          <label for="chk" aria-hidden="true">Registrate</label>
          <input class="input" type="text" name="user" placeholder="Nombre" required />
          <input class="input" type="email" name="email" placeholder="Email" required />
          <input class="input" type="password" name="pswd" placeholder="Contraseña" required />
          <button>Registrarse</button>
        </form>
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
<script type="text/javascript" src="js/nav.js"></script>

</html>