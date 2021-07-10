<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-12 06:56:46
 * @modify date 2021-06-12 06:56:46
 * @desc [description]
 */

$sysconf['template']['base'] = 'php';
$sysconf['template']['responsive'] = false;

// set rocky template info
$sysconf['template']['rocky_newbook'] = 1;
$sysconf['template']['rocky_library_subname'] = 1;
$sysconf['template']['rocky_library_map'] = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63301.06337836403!2d109.19940401108268!3d-7.430189416028237!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655c3136423d1d%3A0x4027a76e352e4a0!2sPurwokerto%2C%20Kabupaten%20Banyumas%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1625549655851!5m2!1sid!2sid';
$sysconf['template']['rocky_library_map_info'] = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.";
$sysconf['template']['rocky_library_services'] = 'Service 1|Service 2|Service 3';
$sysconf['template']['rocky_library_sub_services'] = 'sub service 1|http://localhost-sub service 2|http://localhost-sub service 3|http://localhost';
$sysconf['template']['rocky_ig'] = 'http://localhost';
$sysconf['template']['rocky_fb'] = 'http://localhost';
$sysconf['template']['rocky_tw'] = 'http://localhost';
$sysconf['template']['rocky_yt'] = 'http://localhost';
$sysconf['template']['rocky_carousell_limit'] = 16;
$sysconf['template']['rocky_carousell_height_class'] = 'h-40';
$sysconf['template']['rocky_carousell_type'] = 'loop'; // options slide
$sysconf['template']['rocky_carousell_show'] = 8; // if you use loop type
$sysconf['template']['rocky_carousell_gap'] = '1em'; // if you use loop type
$sysconf['template']['rocky_carousell_autoplay'] = true;
$sysconf['template']['rocky_quotes_od'] = 0;
$sysconf['template']['rocky_font_src'] = 'online';
$sysconf['template']['rocky_preloader'] = 1;
$sysconf['template']['rocky_visitor_log_voice'] = 1;


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
    'library_subname' => [
        'dbfield' => 'rocky_library_subname',
        'label' => 'Active library subname?',
        'type' => 'dropdown',
        'default' => 1,
        'data' => [
            [1, __('Show')],
            [0, __('Hide')]
        ]
    ],
    'library_map' => [
        'dbfield' => 'rocky_library_map',
        'label' => 'Library Map',
        'type' => 'longtext',
        'class' => 'ckeditor',
        'width' => 100,
        'max' => strlen($sysconf['template']['rocky_library_map']),
        'default' => $sysconf['template']['rocky_library_map'],
    ],
    'library_map_info' => [
        'dbfield' => 'rocky_library_map_info',
        'label' => 'Library Map Info',
        'type' => 'longtext',
        'class' => 'ckeditor',
        'width' => 100,
        'max' => strlen($sysconf['template']['rocky_library_map_info']),
        'default' => $sysconf['template']['rocky_library_map_info'],
    ],
    'library_services' => [
        'dbfield' => 'rocky_library_services',
        'label' => 'How many services?',
        'type' => 'longtext',
        'class' => 'ckeditor',
        'width' => 100,
        'max' => 1000,
        'default' => $sysconf['template']['rocky_library_services']
    ],
    'library_services' => [
        'dbfield' => 'rocky_library_sub_services',
        'label' => 'How many services?',
        'type' => 'longtext',
        'class' => 'ckeditor',
        'width' => 500,
        'max' => 1000,
        'default' => $sysconf['template']['rocky_library_sub_services']
    ],
    'library_ig' => [
        'dbfield' => 'rocky_fb',
        'label' => 'Facebook Page',
        'type' => 'text',
        'width' => 100,
        'default' => $sysconf['template']['rocky_fb']
    ],
    'library_ig' => [
        'dbfield' => 'rocky_tw',
        'label' => 'Twitter Profile',
        'type' => 'text',
        'width' => 100,
        'default' => $sysconf['template']['rocky_tw']
    ],
    'library_yt' => [
        'dbfield' => 'rocky_ig',
        'label' => 'Youtube Channel',
        'type' => 'text',
        'width' => 100,
        'default' => $sysconf['template']['rocky_yt']
    ],
    'library_ig' => [
        'dbfield' => 'rocky_ig',
        'label' => 'Instagram Profile',
        'type' => 'text',
        'width' => 100,
        'default' => $sysconf['template']['rocky_ig']
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
            [1, __('Yes')],
            [0, __('No')]
        ]
    ],
    'carousell-height' => [
        'dbfield' => 'rocky_carousell_height_class',
        'label' => 'CSS class to define height cover (https://tailwindcss.com/docs/height)',
        'type' => 'text',
        'default' => 'h-40'
    ],
    'carousell-limit' => [
        'dbfield' => 'rocky_carousell_limit',
        'label' => 'Number of book slider to show',
        'type' => 'text',
        'default' => 16
    ],
    'carousell-show' => [
        'dbfield' => 'rocky_carousell_show',
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
        'dbfield' => 'rocky_carousell_type',
        'label' => 'Type of slider',
        'type' => 'dropdown',
        'default' => 'loop',
        'data' => [
            ['loop', __('Loop')],
            ['slide', __('Slide')]
        ]
    ],
    'preloader' => [
        'dbfield' => 'rocky_preloader',
        'label' => 'Active Preloader',
        'type' => 'dropdown',
        'default' => 1,
        'data' => [
            [1, __('Enable')],
            [0, __('Disable')]
        ]
    ],
    'visitor-log' => [
        'dbfield' => 'rocky_visitor_log_voice',
        'label' => 'Visitor voice active?',
        'type' => 'dropdown',
        'default' => 1,
        'data' => [
            [1, __('Enable')],
            [0, __('Disable')]
        ]
    ],
    'quotes-od' => [
        'dbfield' => 'rocky_quotes_od',
        'label' => 'Active Quotes?',
        'type' => 'dropdown',
        'default' => 0,
        'data' => [
            [1, __('Enable')],
            [0, __('Disable')]
        ]
    ],
    'online-font' => [
        'dbfield' => 'rocky_font_src',
        'label' => 'Font Source?',
        'type' => 'dropdown',
        'default' => 'offline',
        'data' => [
            ['offline', __('Offline')],
            ['online', __('Online')]
        ]
    ]
];
