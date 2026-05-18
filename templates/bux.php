<h2>Список файлов</h2>

<?=$message?><br><br>

<?php foreach ($files as $file): ?>

    <a href="/doc/<?=$file?>"><?=$file?></a><br>

<?php endforeach; ?>