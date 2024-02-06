<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VOST</title>
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
<?php for ($i = 0; $i < count($vinyls); $i++): ?>
    <div class="vinyl">
        <h2>Nomnbre: <?= $vinyls[$i]->name ?></h2>
        <h2>Precio: <?= $vinyls[$i]->price ?>€</h2>
        <h2>Stock: <?= $vinyls[$i]->stock ?></h2>
        <h2>Stock: <?= $vinyls[$i]->duration ?></h2>
        <div>
            <span style="display: none" id="id_vinyl<?= $i?>"><?= $vinyls[$i]->id_vinyl ?></span>
            <form id="form<?= $i?>" action="/user/cart" method="post" target="_blank">
                <input style="display: none" type="number" name="quantity" value="<?= $vinyls[$i]->id_vinyl ?>">
                <button id="addButton<?= $i?>" type="submit">Añadir al carrito</button>
            </form>
            <button><a href="/vinyl/<?=$vinyls[$i]->id_vinyl?>">Ver mas</a></button>
        </div>
    </div>
<?php endfor ?>
<script>

    for (let i = 0; i < <?=count($vinyls)?>; i++) {
        let form = document.getElementById(`form${i}`);
        form.addEventListener('submit', async (ev) => {
            ev.preventDefault()
            let data = new FormData(form);
            let id_vinyl = document.getElementById('id_vinyl' + i).innerText
            let button = document.getElementById(`addButton${i}`)
            fetch(`http://localhost:80/user/cart/${id_vinyl}`, {method: 'POST', body: data })
                .then(response => {
                    if (response.status === 200)
                        button.innerHTML = 'Añadido'
                    if (response.status === 400)
                        button.innerHTML = 'Bad request'
                    return response.text()
                })
                .then(res => console.log(res))
        })
    }

</script>
</body>

</html>
<?php
