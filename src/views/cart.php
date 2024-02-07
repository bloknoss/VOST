<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrito</title>
    <style>
        body {
            display: flex;
            flex-flow: column;
            gap: 3rem;
            align-items: center;

        }

        .vinyl {
            align-items: center;
            padding: 1rem;
            background: #464450;
            color: whitesmoke;
            display: flex;
            flex-flow: column wrap;
            width: 30vw;
            border-radius: 1rem;
            gap: 0.5rem;
        }

        .vinyl > div {
            display: flex;
            gap: 0.2rem;
            background: #464450;
        }

        input {
            width: 40px;
        }
    </style>
</head>
<body>
<form action="/user/orders" method="post">
    <?php for ($i = 0; $i < count($cart); $i++): ?>
        <div class="vinyl">

            <input type="checkbox" name="id_vinyls[]" id="id_vinyl<?= $i ?>" value="<?= $cart[$i]->vinyl->id_vinyl ?>">
            <h2>Nomnbre: <?= $cart[$i]->vinyl->name ?></h2>
            <h2>Precio: <?= $cart[$i]->vinyl->price ?>€</h2>
            <h2>Stock: <?= $cart[$i]->vinyl->stock ?></h2>
            <h2>Stock: <?= $cart[$i]->vinyl->duration ?></h2>
            <h2>Quantity: <?= $cart[$i]->quantity ?></h2>
            <div>
                <button onclick="deleteItem(<?= $cart[$i]->vinyl->id_vinyl ?>)">Eliminar</button>
                <button><a href="/vinyl/<?= $cart[$i]->vinyl->id_vinyl ?>">Ver mas</a></button>
                <label for="quantity">Cantidad</label>
                <input type="number" name="quantity[<?= $cart[$i]->vinyl->id_vinyl ?>]"
                       value="<?= $cart[$i]->quantity ?>" id="quantity<?= $i ?>"
                       max="<?= $cart[$i]->vinyl->stock ?>" min="0">
                <button onclick="updateQuantity(<?= $i ?>,<?= $cart[$i]->vinyl->id_vinyl ?>)">
                    Save
                </button>
            </div>

        </div>
    <?php endfor ?>
    <?php
    $j = 0;
    
    ?>
    <?php foreach ($addresses as $address): ?>
        <label for="address<?= $j ?>">
            <h2>Ciudad: <?= $address->city ?></h2>
            <h2>Postal code: <?= $address->postal_code ?></h2>
            <h2>Calle: <?= $address->street ?></h2>
            <h2>Number: <?= $address->number ?></h2>
        </label>
        <input type="radio" name="id_address" id="address<?= $j++ ?>" value="<?= $address->id_address ?>">
    <?php endforeach; ?>
    <button type="submit">Comprar</button>
</form>

<button onclick="deleteItems()">
    borrar todo
</button>
<script>
    function updateQuantity(index, id_vinyl) {
        fetch(`http://localhost:80/user/cart/${id_vinyl}`, {
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({quantity: document.getElementById(`quantity${index}`).value})

        })
            .then(res => res.text())
            .then(res => {
                console.log(res)
                location.reload();
            })
    }

    function deleteItems(id) {
        fetch(`http://localhost:80/user/cart/${id}`, {
            method: 'DELETE'
        }).then(res => res.text())
            .then(res => {
                console.log(res)
                location.reload()
            })
    }

    function deleteItem(id) {
        console.log(id)
        fetch(`http://localhost:80/user/cart/${id}`, {
            method: 'DELETE'
        }).then(res => res.text())
            .then(res => {
                console.log(res)

            })
    }


</script>
</body>
</html>

<?php
