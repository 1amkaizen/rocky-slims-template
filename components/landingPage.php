<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-06 08:04:38
 * @modify date 2021-06-06 08:04:38
 * @desc [description]
 */

// Check direct access
isDirect();

$sidebar = [
    [SWB.'?p=libinfo', __('Information')],
    [SWB.'?p=news', __('News')],
    [SWB.'?p=help', __('Help')],
    [SWB.'?p=librarian', __('Librarian')]
];

?>
<!-- First Content -->
<section id="landingPage" class="flex flex-wrap h-screen">
    <aside class="in-zi w-2-5/12 bg-blue-500">
        <div class="in-zi fixed top-20 w-2-5/12">
            <ul class="p-0">
                <?php foreach($sidebar as $menu): ?>
                <li>
                    <a class="antialiased hover:bg-blue-100 hover:text-blue-500 block rounded-full text-gray-100 px-3 py-2 mx-1 cursor-pointer no-underline" href="<?= $menu[0] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block bi bi-list" viewBox="0 0 16 16">
                            <path d="M4 2v2H2V2h2zm1 12v-2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm0-5V7a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm0-5V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm5 10v-2a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm0-5V7a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm0-5V2a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zM9 2v2H7V2h2zm5 0v2h-2V2h2zM4 7v2H2V7h2zm5 0v2H7V7h2zm5 0h-2v2h2V7zM4 12v2H2v-2h2zm5 0v2H7v-2h2zm5 0v2h-2v-2h2zM12 1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7zm1 4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1h-2z"/>
                        </svg>
                        <?= $menu[1] ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </aside>
    <div class="w-9-5/12">
        <div class="grid grid-cols-1 gap-0">
            <!-- Banner -->
            <Banner quotes-active="<?= $sysconf['template']['rocky_quotes_od'] ?>"></Banner>
            <!-- Newbook -->
            <div class="mt-0 px-12 pt-8">
                <h5 class="border-b-2 border-blue-500 mb-10 w-fit -zi-3"><?= t('New Book') ?></h5>
                <!-- New -->
                <Newbook :cover-height="'<?= $sysconf['template']['rocky_carousell_height_class'] ?>'" :per-show="<?= $sysconf['template']['rocky_carousell_show'] ?>" :auto-play="<?= !$sysconf['template']['rocky_carousell_autoplay'] ? 'false' : 'true' ?>" :slider-type="'<?= $sysconf['template']['rocky_carousell_type'] ?>'" :slider-gap="'<?= $sysconf['template']['rocky_carousell_gap'] ?>'"></Newbook>
            </div>
            <div class="mt-0 px-12">
                <h5 class="border-b-2 border-blue-500 mb-10 w-fit"><?= t('Popular Book') ?></h5>
                <!-- Popular -->
                <Popular :cover-height="'<?= $sysconf['template']['rocky_carousell_height_class'] ?>'" :per-show="<?= $sysconf['template']['rocky_carousell_show'] ?>" :auto-play="<?= !$sysconf['template']['rocky_carousell_autoplay'] ? 'false' : 'true' ?>" :slider-type="'<?= $sysconf['template']['rocky_carousell_type'] ?>'" :slider-gap="'<?= $sysconf['template']['rocky_carousell_gap'] ?>'"></Popular>
            </div>
            <div class="mt-0 px-12">
                <h5 class="border-b-2 border-blue-500 mb-10 w-fit"><?= t('Location') ?></h5>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3><?= $sysconf['library_name'] ?></h3>
                        <p class="text-justify"><?= $sysconf['template']['rocky_library_map_info'] ?></p>
                    </div>
                    <div class="locationMap">
                        <?= locationMap($sysconf['template']['rocky_library_map']) ?>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php tarsiusComponents('footer') ?>
        </div>
    </div>

</section>