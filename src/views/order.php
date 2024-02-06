<?php foreach ($orders as $order): ?>
    <div>
        <h2>id_order: <?= $order->id_order ?></h2>
        <h2>user: <?= $order->id_address ?></h2>
        <button onclick="getVinyls(<?= $order->id_order ?>)">?</button>
        <span id="<?= $order->id_order ?>"></span>
    </div>
<?php endforeach; ?>
<script>
    function seeSongs(id, index){
        fetch(`http://localhost:80/user/vinyl/${id}/song`).then(res=> res.text()).then(res => {
            document.getElementById('songs' + index).innerHTML  = res
        })
    }
    function getVinyls(id) {
        fetch(`http://localhost:80/user/orders/${id}`)
            .then(res => res.text())
            .then(res => {
                console.log(res)
                document.getElementById(id).innerHTML = res
            })
    }
</script>
