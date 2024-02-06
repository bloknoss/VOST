<?php $i = 0 ?>
<?php foreach ($vinyls as $vinyl):?>
<h2><?= $vinyl->name?></h2>
<h2><?= $vinyl->stock?></h2>
<h2><?= $vinyl->price?></h2>
<h2><?= $vinyl->duration?></h2>
<div id="songs<?= $i++?>">
    <button onclick="seeSongs(<?= $vinyl->id_vinyl?>, <?= $i?>)">See songs</button>
</div>
<?php endforeach; ?>

