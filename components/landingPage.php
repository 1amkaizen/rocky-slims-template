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

?>
<!-- First Content -->
<section class="flex flex-wrap h-screen">
    <aside class="w-2-5/12 bg-blue-500">
        <div class="fixed top-20 w-2-5/12">
            <ul class="p-0">
                <li class="antialiased hover:bg-blue-100 hover:text-blue-500 rounded-full text-gray-100 px-3 py-2 mx-1 cursor-pointer"><?= __('Information') ?></li>
                <li class="antialiased hover:bg-blue-100 hover:text-blue-500 rounded-full text-gray-100 px-3 py-2 mx-1 cursor-pointer"><?= __('News') ?></li>
                <li class="antialiased hover:bg-blue-100 hover:text-blue-500 rounded-full text-gray-100 px-3 py-2 mx-1 cursor-pointer"><?= __('Help') ?></li>
                <li class="antialiased hover:bg-blue-100 hover:text-blue-500 rounded-full text-gray-100 px-3 py-2 mx-1 cursor-pointer"><?= __('Librarian') ?></li>
            </ul>
        </div>
    </aside>
    <div class="w-9-5/12 mb-4">
        <div class="grid grid-cols-1 gap-0">
            <div class="banner h-64 mt-16">
                <h1 class="brand font-bold text-center text-gray-100 mt-24 mb-0 shadow-2xl">OPAC</h1>
                <span class="block text-center text-gray-100">"Nothing is pleasanter than exploring a library."</span>
                <small class="block text-gray-100 text-center">- Walter Savage Landor </small>
            </div>
            <div class="h-64 mt-0 p-4">
                <h3 class="border-b-2 border-blue-500 w-fit">New Book</h3>
            </div>
            <div class="h-64 mt-0 p-4">
                <h3 class="border-b-2 border-blue-500 w-fit">New Book</h3>
            </div>
        </div>
    </div>

</section>