document.addEventListener("DOMContentLoaded", () => {
  const agregarBotones = document.querySelectorAll(".agregar-producto");
  agregarBotones.forEach((button) => {
    button.addEventListener("click", agregarProductoAlCarrito);
  });

  function agregarProductoAlCarrito(event) {
    const boton = event.target;
    const producto = boton.closest(".producto");
    const idProducto = producto.dataset.id;
    const nombreProducto = producto.querySelector(".nombre-producto").textContent;
    const precioProducto = producto.dataset.precio;

    const nuevoProducto = document.createElement("div");
    nuevoProducto.classList.add("producto-en-carrito");
    nuevoProducto.innerHTML = `
            <span class="nombre-producto">${nombreProducto}</span>
            <span class="precio-producto">$${precioProducto}</span>
            <input class="cantidad-producto" type="number" value="1" data-precio="${precioProducto}">
            <button class="eliminar-producto">Eliminar</button>
        `;
    document.querySelector(".productos-en-carrito").appendChild(nuevoProducto);

    nuevoProducto.querySelector(".eliminar-producto").addEventListener("click", eliminarProducto);
    nuevoProducto.querySelector(".cantidad-producto").addEventListener("change", actualizarTotal);

    actualizarTotal();
  }

  function eliminarProducto(event) {
    const producto = event.target.closest(".producto-en-carrito");
    producto.remove();
    actualizarTotal();
  }

  function actualizarTotal() {
    let total = 0;
    const productos = document.querySelectorAll(".cantidad-producto");
    productos.forEach((producto) => {
      const precio = parseFloat(producto.dataset.precio);
      const cantidad = parseInt(producto.value);
      total += precio * cantidad;
    });
    document.querySelector(".precio-total").textContent = $$;
    {
      total.toFixed(2);
    }
  }
});
