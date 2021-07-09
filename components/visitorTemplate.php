<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-07-08 12:39:14
 * @modify date 2021-07-08 12:39:14
 * @desc [description]
 */

isDirect();

$lang = $sysconf['default_lang'];
// set default language
if (isset($_GET['select_lang'])) {
    $select_lang = trim(strip_tags($_GET['select_lang']));
    // delete previous language cookie
    if (isset($_COOKIE['select_lang'])) {
        @setcookie('select_lang', $select_lang, time()-14400, SWB);
    }
    // create language cookie
    @setcookie('select_lang', $select_lang, time()+14400, SWB);
    $lang = $select_lang;
} else if (isset($_COOKIE['select_lang'])) {
    $lang = trim(strip_tags($_COOKIE['select_lang']));
}

$lang = str_replace('_', '-', $lang);

$label = [
    __('Welcome to ').$sysconf['library_name'],
    __('Please fill your member ID or name.'),
    __('Member ID'),
    __('Enter your member ID'),
    __('Institution'),
    __('Enter your institution'),
    __('Enough fill your member ID if you are member of ').$sysconf['library_name'],
    __('Check In')
];

$isVoiceEnable = (int)$sysconf['template']['rocky_visitor_log_voice']

?>
<!DOCTYPE Html>
<html>
    <head>
        <title><?= $page_title ?></title>
        <!-- Meta -->
        <?php tarsiusComponents('meta') ?>
    </head>
    <body class="overflow-hidden">
        <div id="visitorCounter" class="w-full bg-gray-200 h-screen fixed">
            <Visitorform default-lang="<?= $lang ?>" voice-status="<?= $isVoiceEnable ?>" form-label="<?= jsonOneQuotes($label) ?>"></Visitorform>
        </div>
        <!-- JS -->
        <?php
        // JS
        tarsiusComponents('js');
        ?>
    </body>
</html>