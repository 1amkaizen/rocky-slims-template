<?php
// require helper
require __DIR__ . '/../tools/helper.php';

// register controller
$controllers = [
    __DIR__ . '/Controllers/RockyBiblio',
    __DIR__ . '/Controllers/RockyImage',
    __DIR__ . '/Controllers/RockyUi'
];

tarsiusLoad($controllers, 'require');

// get new book
$router->map('GET', '/newbook', 'RockyBiblio@getLatest');
$router->map('GET', '/popularbook', 'RockyBiblio@getPopular');

// Ui
$router->map('GET', '/opac/common/[a:type]', 'RockyUi@common');

// Member area
$router->map('GET', '/opac/memberarea/getbasket', 'RockyUi@basket');

// get book image
$router->map('GET', '/cover/book/[i:w]/[i:h]/[*:filename]', 'RockyImage@stream');