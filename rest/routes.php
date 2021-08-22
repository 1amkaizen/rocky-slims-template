<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-07-08 13:43:50
 * @modify date 2021-07-08 13:43:50
 * @desc [description]
 */

// require helper
require __DIR__ . '/../tools/helper.php';

// require autoload
require __DIR__ . '/../tools/autoload.php';

// set unique api key
$rocky_unique_key = base64_encode(md5(__DIR__));

// register controller
$controllers = [
    __DIR__ . '/Controllers/RockyBiblio',
    __DIR__ . '/Controllers/RockyImage',
    __DIR__ . '/Controllers/RockyUi',
    __DIR__ . '/Controllers/RockyMember'
];

tarsiusLoad($controllers, 'require');

if (ENVIRONMENT === 'development')
{
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true') ;
    header('Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT');
    header('Access-Control-Allow-Headers: *');
}

// get new book
$router->map('GET', '/newbook', 'RockyBiblio@getLatest');
$router->map('GET', '/popularbook', 'RockyBiblio@getPopular');
$router->map('GET', '/searchbook', 'RockyBiblio@searchBook');

// Book
$router->map('GET', '/booklist/[*:position]', 'RockyBiblio@lazyLoad');
$router->map('GET', '/booksearch', 'RockyBiblio@search');

// Ui
$router->map('GET', '/opac/common/[a:type]', 'RockyUi@common');

// Member area
$router->map('GET', '/opac/memberarea/getbasket', 'RockyUi@basket');

// Visitor image
$router->map('GET', '/visitor/person/profile/[*:memberId]', 'RockyUi@searchImage');

// get book image
$router->map('GET', '/cover/book/[i:w]/[i:h]/[*:filename]', 'RockyImage@stream');

// Member login
$router->map('OPTIONS', '/rockylight/member/login', 'RockyMember@auth');
$router->map('POST', '/rockylight/member/login', 'RockyMember@auth');

// Test
$router->map('GET', '/test', 'Rocky\Controllers\RockyTest@do');