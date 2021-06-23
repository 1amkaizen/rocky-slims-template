<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-12 06:56:46
 * @modify date 2021-06-12 06:56:46
 * @desc [description]
 */

$sysconf['template']['base'] = 'php';
$sysconf['template']['responsive'] = true;

// set rocky template info
$sysconf['template']['rocky_newbook'] = 1;
$sysconf['template']['rocky_carousell_limit'] = 16;
$sysconf['template']['rocky_carousell_type'] = 'loop'; // options slide
$sysconf['template']['rocky_carousell_show'] = 7; // if you use loop type
$sysconf['template']['rocky_carousell_gap'] = '1em'; // if you use loop type
$sysconf['template']['rocky_carousell_autoplay'] = true;


$sysconf['template']['option'][$sysconf['template']['theme']] = [
    'responsive' => [
        'dbfield' => 'responsive',
        'label' => __('Enable this theme for mobile?'),
        'type' => 'dropdown',
        'default' => 0,
        'data' => [
            [1, __('Yes, please!')],
            [0, __('No, I want use lighweight theme')]
        ]
    ],
    'newbook' => [
        'dbfield' => 'rocky_newbook',
        'label' => 'Enable newbook?',
        'type' => 'dropdown',
        'default' => 1,
        'data' => [
            [1, __('Show')],
            [0, __('Hide')]
        ]
    ],
    'carousell-auto' => [
        'dbfield' => 'rocky_carousell_autoplay',
        'label' => 'Enable auto play slider?',
        'type' => 'dropdown',
        'default' => 1,
        'data' => [
            [1, __('Show')],
            [0, __('Hide')]
        ]
    ],
    'carousell-limit' => [
        'dbfield' => 'rocky_newbook_limit',
        'label' => 'Number of book slider to show',
        'type' => 'text',
        'default' => 16
    ],
    'carousell-show' => [
        'dbfield' => 'rocky_newbook_show',
        'label' => 'Number of book slider to show',
        'type' => 'text',
        'default' => 8
    ],
    'carousell-gap' => [
        'dbfield' => 'rocky_carousell_gap',
        'label' => 'Number of gap between each book slider',
        'type' => 'text',
        'default' => '2em'
    ],
    'carousell-type' => [
        'dbfield' => 'rocky_newbook_type',
        'label' => 'Type of slider',
        'type' => 'text',
        'default' => 'loop',
        'data' => [
            ['loop', __('Loop')],
            ['slide', __('Slide')]
        ]
    ]

];
