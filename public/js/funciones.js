function getOrders(id) {
  fetch(`http://localhost:80/user/orders`)
    .then((data) => data.text())
    .then((response) => {
      console.log(response);
      document.getElementById("orders").innerHTML += response;
    });
}
function edit() {
  document.getElementById("editForm").style.display = "flex";
}

function seeSongs(id, index) {
  fetch(`http://localhost:80/user/vinyl/${id}/song`)
    .then((res) => res.text())
    .then((res) => {
      console.log(res);
      document.getElementById("songs" + index).innerHTML = res;
    });
}
function getVinyls(id) {
  fetch(`http://localhost:80/user/orders/${id}`)
    .then((res) => res.text())
    .then((songs) => {
      console.log(songs);
      document.getElementById(id).innerHTML = songs + "";
    });
}

function deleteAddress(id_address) {
  fetch(`http://localhost:80/user/address/${id_address}`, {
    method: "DELETE",
  })
    .then((res) => {
      console.log(res.status);
      return res.text();
    })
    .then((res) => {
      console.log(res);
      location.reload();
    });
}

let form = document.getElementById("addAddress");
form.addEventListener("submit", (ev) => {
  ev.preventDefault();
  let data = new FormData(form);

  fetch("http://localhost:80/user/address", {
    method: "POST",
    body: data,
  })
    .then((res) => res.text())
    .then((res) => {
      console.log(res);
      location.reload();
    });
});

function updateQuantity(index, id_vinyl) {
  fetch(`http://localhost:80/user/cart/${id_vinyl}`, {
    method: "PUT",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      quantity: document.getElementById(`quantity${index}`).value,
    }),
  })
    .then((res) => res.text())
    .then((res) => {
      console.log(res);
      location.reload();
    });
}

function deleteItems(id) {
  fetch(`http://localhost:80/user/cart/${id}`, {
    method: "DELETE",
  })
    .then((res) => res.text())
    .then((res) => {
      console.log(res);
      location.reload();
    });
}

function deleteItem(id) {
  console.log(id);
  fetch(`http://localhost:80/user/cart/${id}`, {
    method: "DELETE",
  })
    .then((res) => res.text())
    .then((res) => {
      console.log(res);
      location.reload();
    });
}
