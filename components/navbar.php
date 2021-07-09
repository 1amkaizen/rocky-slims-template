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

// default Lang
$defaultLang = (isset($_COOKIE['select_lang'])) ? $_COOKIE['select_lang'] : $sysconf['default_lang'];

// set json lang
$jsonLang = str_replace('"', '\'', json_encode(setLangFlagList($defaultLang, $available_languages)));

?>
<nav id="navbar" class="w-full flex items-center justify-between flex-wrap py-2 px-4 fixed top-0 rocky-head" style="z-index: 3">
  <?php //imagickCheck(); ?>
  <!-- Right -->
  <div onclick="location.href = './'" class="flex flex-shrink-0 items-center text-white cursor-pointer">
    <div class="w-8">
      <?php if (!is_null(getLogo())): ?>
        <img src="<?= getLogo() ?>" class="inline-block h-8 w-8"/>
      <?php else: ?>
        <svg class="fill-current text-gray-200 inline-block h-8 w-8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 118.4 135" style="enable-background:new 0 0 118.4 135;" xml:space="preserve">
                    <path d="M118.3,98.3l0-62.3l0-0.2c-0.1-1.6-1-3-2.3-3.9c-0.1,0-0.1-0.1-0.2-0.1L61.9,0.8c-1.7-1-3.9-1-5.4-0.1l-54,31.1
                    l-0.4,0.2C0.9,33,0.1,34.4,0,36c0,0.1,0,0.2,0,0.3l0,62.4l0,0.3c0.1,1.6,1,3,2.3,3.9c0.1,0.1,0.2,0.1,0.2,0.2l53.9,31.1l0.3,0.2
                    c0.8,0.4,1.6,0.6,2.4,0.6c0.8,0,1.5-0.2,2.2-0.5l53.9-31.1c0.3-0.1,0.6-0.3,0.9-0.5c1.2-0.9,2-2.3,2.1-3.7c0-0.1,0-0.3,0-0.4
                    C118.4,98.6,118.3,98.5,118.3,98.3z M114.4,98.8c0,0.3-0.2,0.7-0.5,0.9c-0.1,0.1-0.2,0.1-0.2,0.1l-20.6,11.9L59.2,92.1l-33.9,19.6
                    L4.6,99.7l0,0l0,0C4.2,99.5,4,99.2,4,98.8l0-62.5l0,0l0-0.1c0-0.4,0.2-0.7,0.5-0.9l20.8-12l33.9,19.6l33.9-19.6l20.6,11.9l0.1,0
                    c0.3,0.2,0.5,0.5,0.6,0.9l0,62.3L114.4,98.8L114.4,98.8z M95.3,68.6v39.4L23.1,66.4V26.9L95.3,68.6z"></path>
        </svg>
      <?php endif; ?>
    </div>
    <div class="w-library-submenu">
      <span class="ml-2 block font-semibold text-gray-200 text-xl tracking-tight brand uppercase" style="line-height: 0.8">
          <?= $sysconf['library_name'] ?>
      </span>
      <?php if ($sysconf['template']['rocky_library_subname']): ?>
      <small class="ml-2 block text-xs"><?= $sysconf['library_subname'] ?></small>
      <?php endif; ?>
    </div>
  </div>
  <!-- Search Box -->
  <Searchbox></Searchbox>
  <!-- Left -->
  <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
    <div class="text-sm font-semibold lg:flex-grow text-right">
      <a href="?p=member" title="Login" class="text-gray-200 hover:text-white no-underline block lg:inline-block lg:mt-0 lg:mr-<?= (utility::isMemberLogin()) ? '1' : '10' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="inline-block text-gray-200" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg>
        <?php if (utility::isMemberLogin()): ?>
          <span class="inline-block mx-1"><?= shortCutWord($_SESSION['m_name'], 1) ?></span>
        <?php endif; ?>
      </a>
      <!-- Basket -->
      <?php if (utility::isMemberLogin()): ?>
        <Basket></Basket>
      <?php endif; ?>
      <Lang default-flag="<?= strtolower(substr($defaultLang, 3,2)) ?>" list-other-lang="'<?= $jsonLang ?>'"></Lang>
    </div>
  </div>
</nav>
<section id="advanceSearch">
  <Advancesearch></Advancesearch>
</section>