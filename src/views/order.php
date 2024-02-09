<?php foreach ($orders as $order) : ?>
    <div>
        <h2>id_order: <?= $order->id_order ?></h2>
        <h2>user: <?= $order->id_address ?></h2>
        <h2>unidades: <?= $order->number ?></h2>
        <button onclick="getVinyls(<?= $order->id_order ?>)">?</button>
        <span id="<?= $order->id_order ?>"></span>
    </div>
<?php endforeach; ?>
<script src="/js/funciones.js"></script>