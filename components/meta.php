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

?>
<!-- Title -->
<title><?= $page_title; ?></title>
<?php
// clean request uri from xss
$request_uri = urlencode(strip_tags(urldecode($_SERVER['REQUEST_URI'])));

$metaMap = [
    '<!-- Meta -->',
    ['charset' => 'utf-8'],
    ['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no'],
    ['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'],
    ['http-equiv' => 'Content-Type', 'content' => 'text/html; charset=utf-8'],
    ['http-equiv' => 'Pragma', 'content' => 'no-cache'],
    ['http-equiv' => 'Cache-Control', 'content' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0'],
    ['http-equiv' => 'Pragma', 'content' => 'no-cache'],
    ['name' => 'viewport', 'content' => 'width=device-width, height=device-height, initial-scale=1'],
    $metadata,
    ['name' => 'generator', 'content' => SENAYAN_VERSION],
    ['name' => 'theme-color', 'content' => '#000'],
    ['name' => 'url', 'content' => SWB]

];

// Description area
if (isset($_GET['p']) && ($_GET['p'] == 'show_detail')):
    $description = [
        '<!-- Description -->',
        ['name' => 'description', 'content' => substr($notes, 0, 152) . '...'],
        ['name' => 'keywords', 'content' => $subject]
    ];
else:
    $description = [
        '<!-- Description -->',
        ['name' => 'description', 'content' => $page_title],
        ['name' => 'keywords', 'content' => $sysconf['library_subname']]
    ];
endif;

// OpenGraph
$og = [
    '<!-- OpenGraph -->',
    ['property' => 'og:locale', 'content' => str_replace('-', '_', $sysconf['default_lang'])],
    ['property' => 'og:title', 'content' => $page_title],
    ['property' => 'og:type', 'content' => 'book'],
    ['property' => 'og:url', 'content' => '//' . $_SERVER["SERVER_NAME"] . $request_uri],
    ['property' => 'og:site_name', 'content' => $sysconf['library_name']]
];

if (isset($_GET['p']) && ($_GET['p'] == 'show_detail')):
    $ogCondition = [
        ['property' => 'og:description', 'content' => substr($notes, 0, 152) . '...'],
        ['property' => 'og:image', 'content' => '//'. $_SERVER["SERVER_NAME"] . SWB . $image_src],
    ];
else:
    $ogCondition = [
        ['property' => 'og:description', 'content' => $sysconf['library_subname']],
        ['property' => 'og:image', 'content' => '//'. $_SERVER["SERVER_NAME"] . SWB . $sysconf['template']['dir'] . '/default/img/logo.png']
    ];
endif;
$og = array_merge($og, $ogCondition);

// Twitter Card
$twitter = [
    '<!-- Twitter Card -->',
    ['name' => 'twitter:card', 'content' => 'summary'],
    ['name' => 'twitter:title', 'content' => $page_title],
    ['name' => 'twitter:url', 'content' => '//' . $_SERVER["SERVER_NAME"] . $request_uri],
];

if (isset($_GET['p']) && ($_GET['p'] == 'show_detail')):
    $twitterCondition = [
        ['property' => 'twitter:image', 'content' => '//'. $_SERVER["SERVER_NAME"] . SWB . $image_src],
    ];
else:
    $twitterCondition = [
        ['property' => 'twitter:image', 'content' => '//'. $_SERVER["SERVER_NAME"] . SWB . $sysconf['template']['dir'] . '/default/img/logo.png'],
    ];
endif;
$twitter = array_merge($twitter, $twitterCondition);

// is Development
$metaEnv = [];
if (ENVIRONMENT === 'development')
{
    // Met environemtn
    $metaEnv = [
        '<!-- Meta Environment -->',
        ['name' => 'env', 'content' => ENVIRONMENT]
    ];
}

// meta
tarsiusMeta(array_merge($metaMap, $metaEnv, $description, $og, $twitter));

// css
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
?>