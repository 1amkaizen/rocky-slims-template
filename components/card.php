<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-06 08:04:38
 * @modify date 2021-06-12 07:01:53
 * @desc [description]
 */

// Check direct access
isDirect();

ob_start();
?>

<?php
$card = ob_get_clean();