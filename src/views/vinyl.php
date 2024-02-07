<?php $i = 0;
if (!is_array($vinyls)) $vinyls = [$vinyls];
?>
<?php foreach ($vinyls as $vinyl):?>
<h2><?= $vinyl->name?></h2>
<h2><?= $vinyl->stock?></h2>
<h2><?= $vinyl->price?></h2>
<h2><?= $vinyl->duration?></h2>
<div id="songs<?= $i++?>">
    <button onclick="seeSongs(<?= $vinyl->id_vinyl?>, <?= $i?>)">See songs</button>
</div>
    <form id="form<?= $i ?>" action="/user/cart/<?= $vinyl->id_vinyl ?>" method="post" target="_blank">
        <input style="display: none" type="number" name="quantity" value="<?= $vinyl->id_vinyl ?>">
        <button id="addButton<?= $i ?>" type="submit">Añadir al carrito</button>
    </form>
    <a href="/vinyl/<?= $vinyl->id_vinyl ?>">Ver mas</a>
<?php endforeach; ?>

