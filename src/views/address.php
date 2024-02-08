<body>
    <h1>Your addresses</h1>
    <?php for ($i = 0; $i < count($addresses); $i++) : ?>
        <h2>Direccion : <?= $i + 1 ?></h2>
        <ul>
            <li>Postal code : <?= $addresses[$i]->postal_code ?></li>
            <li>Postal city : <?= $addresses[$i]->city ?></li>
            <li>Postal street : <?= $addresses[$i]->street ?></li>
            <li>Postal number : <?= $addresses[$i]->number ?></li>
            <button onclick="deleteAddress(<?= $addresses[$i]->id_address ?>)">Delete</button>
        </ul>
    <?php endfor; ?>
    <h1>New address</h1>
    <form action="/user/address" method="post" id="addAddress">
        <label for="postal">Codigo postal
            <input type="number" max="99999" min="10000" name="postal_code" id="postal">
        </label>
        <label for="city">Ciudad
            <input type="text" name="city" id="city">
        </label>
        <label for="street">Calle
            <input type="text" name="street" id="street">
        </label>
        <label for="number">Numero
            <input type="text" name="number" id="number">
        </label>
        <button type="submit">
            Crear
        </button>
    </form>
    <script>
        function deleteAddress(id_address) {
            fetch(`http://localhost:80/user/address/${id_address}`, {
                    method: 'DELETE'
                }).then(res => {
                    console.log(res.status)
                    return res.text()
                })
                .then(res => {
                    console.log(res)
                    location.reload()
                })
        }
        let form = document.getElementById('addAddress')
        form.addEventListener('submit', (ev) => {
            ev.preventDefault();
            let data = new FormData(form)

            fetch('http://localhost:80/user/address', {
                    method: 'POST',
                    body: data
                }).then(res => res.text())
                .then(res => {
                    console.log(res)
                    location.reload()
                })
        })
    </script>
</body>
<?php
