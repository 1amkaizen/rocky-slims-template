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
<nav class="w-full flex items-center justify-between flex-wrap py-2 px-4 fixed top-0 rocky-head">
  <!-- Right -->
  <div class="flex flex-shrink-0 items-center text-white mr-6">
    <div class="w-8">
      <svg class="fill-current text-gray-200 inline-block h-8 w-8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 118.4 135" style="enable-background:new 0 0 118.4 135;" xml:space="preserve">
                  <path d="M118.3,98.3l0-62.3l0-0.2c-0.1-1.6-1-3-2.3-3.9c-0.1,0-0.1-0.1-0.2-0.1L61.9,0.8c-1.7-1-3.9-1-5.4-0.1l-54,31.1
                  l-0.4,0.2C0.9,33,0.1,34.4,0,36c0,0.1,0,0.2,0,0.3l0,62.4l0,0.3c0.1,1.6,1,3,2.3,3.9c0.1,0.1,0.2,0.1,0.2,0.2l53.9,31.1l0.3,0.2
                  c0.8,0.4,1.6,0.6,2.4,0.6c0.8,0,1.5-0.2,2.2-0.5l53.9-31.1c0.3-0.1,0.6-0.3,0.9-0.5c1.2-0.9,2-2.3,2.1-3.7c0-0.1,0-0.3,0-0.4
                  C118.4,98.6,118.3,98.5,118.3,98.3z M114.4,98.8c0,0.3-0.2,0.7-0.5,0.9c-0.1,0.1-0.2,0.1-0.2,0.1l-20.6,11.9L59.2,92.1l-33.9,19.6
                  L4.6,99.7l0,0l0,0C4.2,99.5,4,99.2,4,98.8l0-62.5l0,0l0-0.1c0-0.4,0.2-0.7,0.5-0.9l20.8-12l33.9,19.6l33.9-19.6l20.6,11.9l0.1,0
                  c0.3,0.2,0.5,0.5,0.6,0.9l0,62.3L114.4,98.8L114.4,98.8z M95.3,68.6v39.4L23.1,66.4V26.9L95.3,68.6z"></path>
      </svg>
    </div>
    <div class="w-library-submenu">
      <span class="ml-2 block font-semibold text-gray-200 text-xl tracking-tight brand uppercase" style="line-height: 0.8">
          <?= $sysconf['library_name'] ?>
      </span>
      <small class="ml-2 block text-xs"><?= $sysconf['library_subname'] ?></small>
    </div>
  </div>
  <!-- Search Box -->
  <div class="flex items-center flex-shrink-0 text-white ml-10">
    <div class="search-box rounded-full bg-gray-700">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ml-3 inline-block" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg>
      <input type="text" name="keywords" class="ml-1 inline-block bg-transparent w-11/12" placeholder="search"/>
    </div>
  </div>
  <!-- Left -->
  <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
    <div class="text-sm font-semibold lg:flex-grow text-right">
      <a href="#responsive-header" class="border-b-2 border-gray-500 hover:text-white no-underline block lg:inline-block text-gray-200 lg:mt-0 lg:mr-4">
        <?= __('Home') ?>
      </a>
      <a href="#responsive-header" class="text-gray-200 hover:text-white no-underline block lg:inline-block lg:mt-0 lg:mr-4">
        <?= __('Member Area') ?>
      </a>
    </div>
  </div>
</nav>