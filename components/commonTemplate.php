<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-07-08 12:39:14
 * @modify date 2021-07-08 12:39:14
 * @desc [description]
 */

isDirect();

?>
<div class="w-full">
    <div class="grid grid-cols-1 gap-0">
        <div class="banner h-20 mt-16 in-zi">
            <span class="block text-center text-gray-100 mt-4 ml-10 uppercase"><?= $page_title ?></span>
        </div>
        <div class="mt-0 p-16">
            <?php
                echo $main_content;
            ?>
        </div>
    </div>
    <!-- Footer -->
    <?php tarsiusComponents('footer') ?>
</div>