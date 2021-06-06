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
<section class="h-screen flex flex-wrap py-3 px-4">
    <div class="w-full mb-4">
        <h3 class="text-center mt-56">OPAC</h3>
        <p class="text-center">Welcome to Online Public Access Catalogue</p>
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="mt-5 text-center w-full" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
        </svg>
        <small class="mt-3 text-sm text-center block"><b>edit me at</b> <br> <?= __FILE__ ?></small>
    </div>
</section>

<?php
tarsiusLoad(__DIR__ . '/other_content.php');