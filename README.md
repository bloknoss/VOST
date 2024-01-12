# <p align="center">VOST - Vinyls Original Soundtrack</p>
VOST es un proyecto de clase para la asignatura "Desarrollo web en Entorno Servidor", hemos buscado algo que compartimos todos el grupo en común que es la música, a los tres integrantes de este equipo nos apasiona la música y con este proyecto hemos pensado en un producto que nos guste tanto a nosotros, como también a un posible nicho de mercado, para aquellos apasionados a los videojuegos y cine, tanto a la banda sonora que estos tienen.  

De esta idea proviene nuestro proyecto, VOST, es una página que se encarga de la grabación de vinilos personalizados, con un embalaje personalizado con un toque de atención especial para los clientes y con un enfoque dado a las bandas sonoras de distintos videojuegos y cines/series.  

## Integrantes del equipo
Este equipo esta formado por los siguientes integrantes:  
- [Alvaro Carabante Rodríguez](https://github.com/bloknoss) - Responsable del proyecto y encargado del apartado del modelo
- [Gonzalo Sanchez de Toros López](https://github.com/gonzalostl) - Encargado del apartado de la vista
- [Jose Ramón Gallardo Azcárate](https://github.com/Ramon253) - Encargo del apartado del controlador
  
Cada miembro se encargara de realizar debidamente su apartado y de documentar y realizar todas las tareas necesarias, todos los miembros están de acuerdo con la responsabilidad que ha sido encargada y no existen más problemas al respecto.  

## Estructura del proyecto
El proyecto será realizado en PHP puro, una base de datos MySQL y el frontend desarrollado en HTML, CSS y JS, usando Sass y Bootstrap para el diseño de la vista de la página.

Los archivos públicos tales como index.php y sus requeridas dependencias, estarán en la carpeta public, el core del proyecto residirá en la carpeta src/ donde estará la estructura MVC

```bash
.  
├── README.md
├── public  
│   ├── assets  
│   │   └── images
│   ├── css
│   ├── index.php
│   └── js
├── .gitignore
└── src
    ├── controllers
    ├── models
    └── views
```

## Base de Datos  
En nuestra base de datos recopilaremos información de las siguientes entidades  

- Datos del Usuario
- Vinilo
- Canción
- Dirección
- Pedido

Estas entidades tendran distintos atributos que serán almacenadas en sus respectivas tablas.  
> **_NOTA_:** Un diagrama Entidad/Relación será presentado para mostrar las cardinalidades y grados entre estas entidades.

## Correciones  
En caso de correciones, se podría enviar un comentario a la tarea del classroom, o alternativamente mediante una issue de GitHub o un correo electrónico al responsable del proyecto.  
E-mail de contacto: windpourwow@gmail.com (Responsable del proyecto)

## Conclusión  
Este proyecto es bastante útil para aprender las bases para desarrollar una página web de la forma correcta y aprender las tecnologías y metodologías utilizadas para el desarrolo de aplicaciones web desde un punto de vista del backend.  

README redactado por Álvaro Carabante Rodríguez con ayuda de Jose Ramón y Gonzalo