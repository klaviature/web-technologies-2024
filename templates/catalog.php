<h2>Каталог</h2>

<?php foreach ($catalog as $item): ?>

    <div>

        <?=$item['name']?><br>

        <img
            src="/img/<?=$item['image']?>"
            width="150"
        ><br>

        Цена: <?=$item['price']?><br>

        <hr>

    </div>

<?php endforeach; ?>