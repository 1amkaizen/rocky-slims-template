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

// set page title
$pageTitle = __('OPAC');
// set class
$class =  (!isset($_GET['p'])) ? 'class="flex flex-wrap h-screen"' : null;
?>

<!-- App detail -->
<div id="appDetail" <?= $class ?>>
<?php if (!isset($_GET['p'])): ?>
    <aside class="in-zi w-2-5/12 bg-blue-500">
        <div class="in-zi fixed top-20 w-2-5/12 px-4 py-2 text-white">
            <h3 class="mb-3"><?= __('Search Result') ?></h3>
            <?= $search_result_info; ?>
        </div>
    </aside>
    <div class="w-9-5/12">
        <div class="grid grid-cols-1 gap-0">
            <div class="banner h-20 mt-16 in-zi">
                <span class="block text-center text-gray-100 mt-4 ml-10 uppercase"><?= $pageTitle ?></span>
            </div>
            <div class="mt-0 p-4">
                <?php
                    if (strlen($main_content) !== 7):
                        echo $main_content;
                    else:
                        echo '<h3 class="text-red-500">' . __('No Result') . '</h3>';
                        echo '<p class="text-red-500">' . __('Please try again') . '</p>';
                    endif;
                ?>
            </div>
        </div>
        <!-- Footer -->
        <?php tarsiusComponents('footer') ?>
    </div>
<?php 
else: 
    conditionComponent(__DIR__, ['member','show_detail','visitor']);
endif;
?>
    <!-- Modal -->
    <Modal v-if="showModal" :modal-attribute="modalAttribute"></Modal>
</div>