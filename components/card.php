<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-06 08:04:38
 * @modify date 2021-06-12 07:01:53
 * @desc [description]
 */

// Check direct access
isDirect();

$inputKeywords = '';
if (isset($_GET['keywords']) && !empty($_GET['keywords']))
{
    $inputKeywords = keywordRegex($_GET['keywords']);
}

ob_start();
?>
<div class="p-10 lg:h-rem-28 bg-white border border-5 border-red-500 rounded-lg shadow-md">
    <!-- Doc -->
    <div class="doc">
        <!-- Item Available -->
        <div class="absolute text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 16 16">
                <path  d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/>
            </svg>
            <span title="Tersedia <?= $availability ?> buku" class="in-zi relative text-white text-sm font-bold" style="top: -40px; left: <?= (strlen($availability) < 2)?17:12?>px">
                <?= $availability ?>
            </span>
            <span class="text-sm -ml-<?= (strlen($availability) < 2)?5:7?>">Tersedia</span>
        </div>
        <img class="block mx-auto rounded-lg mt-2 h-48 w-32 mb-4 hover:shadow-2xl cursor-pointer" src="<?= $thumb_url ?>"/>
        <!-- Title -->
        <Titlehighlight title="<?= $title ?>" keywords="<?= $inputKeywords ?>"></Titlehighlight>
        <!-- Authors -->
        <span class="block text-author text-center font-semibold italic text-sm"><?= $_authors_string ?></span>
        <!-- Notes -->
        <p class="text-sm font-light text-justify block h-auto p-2">
            <?= substr($notes, 0,100) ?>
        </p>
        <!-- Button Twice -->
        <Buttontwice detailurl="<?= $detail_url ?>" modal-title="<?= __('Citation') ?>" modal-src="index.php?p=cite&id=<?= $biblio_id  ?>"></Buttontwice>
        <?php if (utility::isMemberLogin()): ?>
        <!-- Basket -->
        <Buttonbasket button-label="<?= __('Add to basket') ?>" availibility-item="<?= $availability ?>" biblio-id="<?= $biblio_id  ?>"></Buttonbasket>
        <?php endif; ?>
    </div>
    <!-- Button Twice -->
    
</div>
<?php
$card = ob_get_clean();
?>