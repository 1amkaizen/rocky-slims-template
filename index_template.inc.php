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

// set custom rest
registerRest();

// check direct
isDirect();

?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php tarsiusLoad(__DIR__ . '/components/meta.php'); ?>   
    </head>
    
    <body class="bg-gray-100">
        <?php
        // navbar
        tarsiusLoad(__DIR__ . '/components/navbar.php');
        ?>

        <div>
            <?php
            // set content
            if (!isset($_GET['p']) && !isset($_GET['search'])) {
                // load first content
                tarsiusLoad(__DIR__ . '/components/landingPage.php');
            } 
            else
            {
                tarsiusLoad(__DIR__ . '/components/content.php');
            }
            ?>
        </div>

        <?php
        // JS
        tarsiusLoad(__DIR__.'/components/js.php');
        ?>
    </body>
</html>