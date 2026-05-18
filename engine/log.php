<?php

function logRequest() {

    $logDir = BASE_PATH . '/logs';

    $logFile = $logDir . '/log.txt';

    if (!is_dir($logDir)) {
        mkdir($logDir, 0777, true);
    }

    $entry =
        date('Y-m-d H:i:s') .
        " | " .
        $_SERVER['REQUEST_METHOD'] .
        " " .
        $_SERVER['REQUEST_URI'] .
        PHP_EOL;

    $lines = file_exists($logFile)
        ? count(file($logFile))
        : 0;

    if ($lines >= 10) {

        $i = 1;

        while (file_exists($logDir . "/log$i.txt")) {
            $i++;
        }

        rename(
            $logFile,
            $logDir . "/log$i.txt"
        );
    }

    file_put_contents(
        $logFile,
        $entry,
        FILE_APPEND
    );
}