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
<?php for ($i = 0; $i < count($cart); $i++): ?>
    <div class="vinyl">
        <h2>Nomnbre: <?= $cart[$i]->vinyl->name ?></h2>
        <h2>Precio: <?= $cart[$i]->vinyl->price ?>€</h2>
        <h2>Stock: <?= $cart[$i]->vinyl->stock ?></h2>
        <h2>Stock: <?= $cart[$i]->vinyl->duration ?></h2>
        <h2>Quantity: <?= $cart[$i]->quantity ?></h2>
        <div>
            <button onclick="deleteItem(<?= $cart[$i]->vinyl->id_vinyl ?>)">Eliminar</button>
            <button><a href="/vinyl/<?= $cart[$i]->vinyl->id_vinyl ?>">Ver mas</a></button>

            <input type="text" id="id_vinyl<?= $i ?>" name="id_vinyl" style="display: none;">
            <label for="quantity">Cantidad</label>
            <input type="number" name="quantity" value="<?= $cart[$i]->quantity ?>" id="quantity<?= $i ?>"
                   max="<?= $cart[$i]->vinyl->stock ?>" min="0">
            <button onclick="updateQuantity(<?= $i ?>,<?= $cart[$i]->vinyl->id_vinyl ?>)">
                Save
            </button>

        </div>

    </div>
<?php endfor ?>
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
            .then(res => console.log(res))
    }

    function deleteItem(id) {
        console.log(id)
        throw fetch(`http://localhost:80/user/cart/${id}`, {
            method: 'DELETE'
        }).then(res => {
            return res.text();
        }).then(res => console.log(res))
    }
</script>
</body>
</html>

<?php
