<?php

function getFiles() {

    $files = scandir(BASE_PATH . '/public/doc');

    return array_values(array_diff($files, ['.', '..']));
}