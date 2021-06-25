<?php
// require helper
require __DIR__ . '/../tools/helper.php';

// register controller
$controllers = [
    __DIR__ . '/Controllers/RockyBiblio.php',
    __DIR__ . '/Controllers/RockyImage.php',
    __DIR__ . '/Controllers/RockyUi.php'
];

tarsiusLoad($controllers, 'require');

// get new book
$router->map('GET', '/newbook', 'RockyBiblio@getLatest');
$router->map('GET', '/popularbook', 'RockyBiblio@getPopular');
$router->map('GET', '/opac/common/[a:type]', 'RockyUi@common');

// get book image
$router->map('GET', '/cover/book/[i:w]/[i:h]/[*:filename]', 'RockyImage@stream');