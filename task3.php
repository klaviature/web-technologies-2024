<?php

function transliterate($string) {
    $alphabet = [
        'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d',
        'е'=>'e', 'ё'=>'yo', 'ж'=>'zh', 'з'=>'z', 'и'=>'i',
        'й'=>'y', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n',
        'о'=>'o', 'п'=>'p', 'р'=>'r', 'с'=>'s', 'т'=>'t',
        'у'=>'u', 'ф'=>'f', 'х'=>'h', 'ц'=>'ts', 'ч'=>'ch',
        'ш'=>'sh', 'щ'=>'sch', 'ъ'=>'', 'ы'=>'y', 'ь'=>'',
        'э'=>'e', 'ю'=>'yu', 'я'=>'ya'
    ];

    $string = mb_strtolower($string);

    return strtr($string, $alphabet);
}

echo "Привет, мир!<br>";
echo transliterate("Привет, мир!");