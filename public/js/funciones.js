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
