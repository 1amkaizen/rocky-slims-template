<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-06 08:04:38
 * @modify date 2021-06-12 07:14:22
 * @desc [description]
 */

// Check direct access
isDirect();

?>
<!-- App detail -->
<div id="appDetail" class="h-auto flex flex-wrap lg:w-10/12 mx-auto block">
    <?php if (!isset($_GET['p'])): ?>
        <div class="w-full lg:w-3/12 p-3 mt-3">
            <h3 class="mb-3"><?= __('Search Result') ?></h3>
            <?= $search_result_info; ?>
        </div>
        <div class="w-full lg:w-9/12 mb-5 p-8">
            <?php
                if (strlen($main_content) !== 7):
                    echo $main_content;
                else:
                    echo '<h3 class="text-red-500">' . __('No Result') . '</h3>';
                    echo '<p class="text-red-500">' . __('Please try again') . '</p>';
                endif;
            ?>
        </div>
    <?php endif; ?>
</div>