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
    </style>
</head>
<body>
<?php for ($i = 0; $i < count($cart); $i++): ?>
    <div class="vinyl">
        <h2>Nomnbre: <?= $cart[$i]->vinyl->name ?></h2>
        <h2>Precio: <?= $cart[$i]->vinyl->price ?>€</h2>
        <h2>Stock: <?= $cart[$i]->vinyl->stock ?></h2>
        <h2>Stock: <?= $cart[$i]->vinyl->duration ?></h2>
        <h2>Quantity: <?=  $cart[$i]->quantity?></h2>
        <div>
            <button onclick="deleteItem(<?=$cart[$i]->vinyl->id_vinyl?>)">Eliminar</button>
            <button>Ver mas</button>
        </div>
    </div>
<?php endfor ?>
<script>
    function deleteItem(id){
        console.log(id)
        throw fetch(`http://localhost:80/user/cart/${id}`, {
            method: 'DELETE'
        }).then(res =>{
            location.reload()
            return res.text();
        }).then(res => console.log(res))
    }
</script>
</body>
</html>

<?php
