<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-06 08:04:24
 * @modify date 2021-06-06 08:04:24
 * @desc [description]
 * 
 * Based Tarsius dummy template for SLiMS OPAC
 * 
 */

// require helper
require_once __DIR__ . '/tools/helper.php';
require_once __DIR__ . '/tools/translate.php';

// set custom rest
registerRest();

// check direct
isDirect();

?>
<!-- 
 ____            _          
|  _ \ ___   ___| | ___   _ 
| |_) / _ \ / __| |/ / | | |
|  _ < (_) | (__|   <| |_| |
|_| \_\___/ \___|_|\_\\__, |
                      |___/ 
                    By Drajat Hasan
 -->
<!DOCTYPE html>
<html lang="<?= $sysconf['default_lang'] ?>">
    <head>
        <?php 
            // load meta
            tarsiusComponents('meta'); 
            // session remove basket
            removeSessionBasket();
        ?> 
    </head>
    
    <body class="bg-gray-100 <?= ($sysconf['template']['rocky_preloader']) ? 'overflow-hidden' : '' ?>">
        <?php
        if (!utility::isMobileBrowser()) 
        {
            // Preloader
            if ($sysconf['template']['rocky_preloader'])
            {
                tarsiusComponents('preloader');
            }

            // navbar
            tarsiusComponents('navbar');
            ?>

            <div>
                <?php
                // set content
                if (!isset($_GET['p']) && !isset($_GET['search'])) {
                    // load first content
                    tarsiusComponents('landingPage');
                } 
                else
                {
                    tarsiusComponents('content');
                }
                ?>
            </div>

        <?php
            // JS
            tarsiusComponents('js');
        }
        else
        {
            tarsiusComponents('notSupport');
        }
        ?>
    </body>
</html>