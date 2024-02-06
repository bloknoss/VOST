<?php foreach ($songs as $song): ?>
<ul>
    <li><?= $song->name?></li>
    <li><?= $song->artist?></li>
    <li><?= $song->compositor?></li>
    <li><?= $song->genre?></li>
    <li><?= $song->duration?></li>
</ul>
<?php endforeach; ?>
