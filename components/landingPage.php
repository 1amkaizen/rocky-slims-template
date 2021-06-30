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
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        <?= $menu[1] ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </aside>
    <div class="w-9-5/12 mb-4">
        <div class="grid grid-cols-1 gap-0">
            <div class="banner h-64 mt-16 in-zi">
                <h1 class="brand font-bold text-center text-gray-100 mt-20 mb-0 shadow-2xl">OPAC</h1>
                <span class="block text-center text-gray-100">"Nothing is pleasanter than exploring a library."</span>
                <small class="block text-gray-100 text-center">- Walter Savage Landor </small>
            </div>
            <div class="h-64 mt-0 p-4">
                <h5 class="border-b-2 border-blue-500 w-fit -zi-3"><?= t('New Book') ?></h5>
                <!-- New -->
                <Newbook :cover-height="'<?= $sysconf['template']['rocky_carousell_height_class'] ?>'" :per-show="<?= $sysconf['template']['rocky_carousell_show'] ?>" :auto-play="<?= !$sysconf['template']['rocky_carousell_autoplay'] ? 'false' : 'true' ?>" :slider-type="'<?= $sysconf['template']['rocky_carousell_type'] ?>'" :slider-gap="'<?= $sysconf['template']['rocky_carousell_gap'] ?>'"></Newbook>
            </div>
            <div class="h-64 mt-5 p-4">
                <h5 class="border-b-2 border-blue-500 w-fit"><?= t('Popular Book') ?></h5>
                <!-- Popular -->
                <Popular :cover-height="'<?= $sysconf['template']['rocky_carousell_height_class'] ?>'" :per-show="<?= $sysconf['template']['rocky_carousell_show'] ?>" :auto-play="<?= !$sysconf['template']['rocky_carousell_autoplay'] ? 'false' : 'true' ?>" :slider-type="'<?= $sysconf['template']['rocky_carousell_type'] ?>'" :slider-gap="'<?= $sysconf['template']['rocky_carousell_gap'] ?>'"></Popular>
            </div>
        </div>
    </div>

</section>