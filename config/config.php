<?php

define('BASE_PATH', realpath(__DIR__ . '/..'));
define('TEMPLATES_DIR', BASE_PATH . '/templates/');
define('LAYOUTS_DIR', 'layouts/');

include BASE_PATH . '/engine/bux.php';
include BASE_PATH . '/engine/functions.php';
include BASE_PATH . '/engine/catalog.php';
include BASE_PATH . '/engine/log.php';