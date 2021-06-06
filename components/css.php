<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-06 08:04:49
 * @modify date 2021-06-06 08:04:49
 * @desc [description]
 */

//  check
isDirect();

$cssMap = [
    '<!-- Fav Icon -->',
    // ['rel' => 'shortcut icon', 'href' => '', 'type' => 'image/x-icon'],
    '<!-- Css Font -->',
    ['href' => 'https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900', 'rel' => 'stylesheet'],
    '<!-- Additional CSS Files -->',
    ['href' => tarsiusUrl('assets/css/tailwind.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'],
    ['href' => tarsiusUrl('assets/css/bootstrap.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'],
    ['href' => tarsiusUrl('assets/css/animate.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'],
    ['href' => tarsiusUrl(versioning('assets/css/app.css')), 'rel' => 'stylesheet', 'type' => 'text/css'],
];

tarsiusStylesheet($cssMap);