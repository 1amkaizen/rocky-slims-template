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
    <div class="w-9-5/12">
        <div class="grid grid-cols-1 gap-0">
            <!-- Banner -->
            <Banner></Banner>
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
            <div class="mt-5 px-12 bg-gray-800 text-white">
                <div class="w-full py-5">
                    <div class="grid grid-cols-1 gap-0">
                        <!-- Logo -->
                        <?php if (!is_null(getLogo())): ?>
                            <img src="<?= getLogo() ?>" class="block h-16 w-16 mx-auto"/>
                        <?php else: ?>
                            <svg class="fill-current text-gray-200 block h-16 w-16 mx-auto" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 118.4 135" style="enable-background:new 0 0 118.4 135;" xml:space="preserve">
                                        <path d="M118.3,98.3l0-62.3l0-0.2c-0.1-1.6-1-3-2.3-3.9c-0.1,0-0.1-0.1-0.2-0.1L61.9,0.8c-1.7-1-3.9-1-5.4-0.1l-54,31.1
                                        l-0.4,0.2C0.9,33,0.1,34.4,0,36c0,0.1,0,0.2,0,0.3l0,62.4l0,0.3c0.1,1.6,1,3,2.3,3.9c0.1,0.1,0.2,0.1,0.2,0.2l53.9,31.1l0.3,0.2
                                        c0.8,0.4,1.6,0.6,2.4,0.6c0.8,0,1.5-0.2,2.2-0.5l53.9-31.1c0.3-0.1,0.6-0.3,0.9-0.5c1.2-0.9,2-2.3,2.1-3.7c0-0.1,0-0.3,0-0.4
                                        C118.4,98.6,118.3,98.5,118.3,98.3z M114.4,98.8c0,0.3-0.2,0.7-0.5,0.9c-0.1,0.1-0.2,0.1-0.2,0.1l-20.6,11.9L59.2,92.1l-33.9,19.6
                                        L4.6,99.7l0,0l0,0C4.2,99.5,4,99.2,4,98.8l0-62.5l0,0l0-0.1c0-0.4,0.2-0.7,0.5-0.9l20.8-12l33.9,19.6l33.9-19.6l20.6,11.9l0.1,0
                                        c0.3,0.2,0.5,0.5,0.6,0.9l0,62.3L114.4,98.8L114.4,98.8z M95.3,68.6v39.4L23.1,66.4V26.9L95.3,68.6z"></path>
                            </svg>
                        <?php endif; ?>
                        <!-- Library Name -->
                        <h5 class="brand uppercase text-center font-bold mt-3"><?= $sysconf['library_name'] ?></h5>
                    </div>
                    <!-- Grid services -->
                    <?php
                    $numService = explode('|', trim($sysconf['template']['rocky_library_services'], '|'));
                    $parseService = explode(',', trim($sysconf['template']['rocky_library_sub_services'], ','));
                    $perService = round((count($parseService) / count($numService)));
                    ?>
                    <div class="mt-4 grid grid-cols-<?= count($numService) ?> gap-5">
                        <?php foreach(array_chunk($parseService, $perService) as $id => $services): ?>
                            <div>
                                <h5><?= $numService[$id] ?></h5>
                                <ul class="pl-0 mb-0">
                                    <?php 
                                        foreach ($services as $service):
                                            $sub = explode('|', $service);
                                    ?>
                                            <li><a class="no-underline text-sm" href="<?= $sub[1] ?>"><?= ucwords($sub[0]) ?></a></li> 
                                    <?php 
                                        endforeach; 
                                    ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>