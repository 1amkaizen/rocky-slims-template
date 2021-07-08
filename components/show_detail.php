<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-07-08 13:35:55
 * @modify date 2021-07-08 13:35:55
 * @desc [description]
 */

isDirect();

?>
<div class="flex flex-wrap h-screen">
    <aside class="in-zi w-2-5/12 bg-blue-500">
        <div class="in-zi mutationImage fixed top-20 w-2-5/12 px-4 py-2 text-white">
            <figure ref="mutationImage">
            </figure>
        </div>
    </aside>
    <div class="w-9-5/12">
        <div class="grid grid-cols-1 gap-0">
            <div class="banner h-20 mt-16 in-zi">
                <span class="block text-center text-gray-100 mt-4 ml-10 uppercase">Detail</span>
            </div>
            <div class="mt-0 p-4">
                <?php
                    echo $main_content;
                ?>
            </div>
        </div>
        <!-- Footer -->
        <?php tarsiusComponents('footer') ?>
    </div>
</div>