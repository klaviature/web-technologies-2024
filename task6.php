<?php

$regions = [
    "Московская область" => ["Москва", "Клин", "Коломна", "Зеленоград"],
    "Ленинградская область" => ["Кронштадт", "Павловск", "Кингисепп"],
    "Рязанская область" => ["Касимов", "Рязань", "Кораблино"]
];

foreach ($regions as $region => $cities) {
    echo $region . ":<br>";

    $filtered = array_filter($cities, function ($city) {
        return mb_substr($city, 0, 1, "UTF-8") === "К";
    });

    echo implode(", ", $filtered) . ".<br><br>";
}