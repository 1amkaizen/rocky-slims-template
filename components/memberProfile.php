<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-07-08 13:33:37
 * @modify date 2021-07-08 13:33:37
 * @desc [description]
 */

isDirect();

// set section
$section = isset($_GET['sec']) ? trim($_GET['sec']) : 'my_account';

$tabs_menus = [
    'my_account' => [
        'text' => __('My Account'),
        'link' => 'index.php?p=member'
    ],
    'current_loan' => [
        'text' => __('Current Loan'),
        'link' => 'index.php?p=member&sec=current_loan'
    ],
    'title_basket' => [
        'text' => __('Title Basket'),
        'link' => 'index.php?p=member&sec=title_basket'
    ],
    'loan_history' => [
        'text' => __('Loan History'),
        'link' => 'index.php?p=member&sec=loan_history'
    ]
];

?>
<div class="grid grid-cols-1 gap-0">
    <div class="banner h-20 mt-16 in-zi">
        <span class="block text-center text-gray-100 mt-4"><?= __('Member Area') ?></span>
    </div>
    <div class="grid grid-cols-1 gap-0">
        <img class="w-28 h-28 rounded-full mt-10 mx-auto block" src="<?= getMemberPhotoProfileSrc() ?>"/>
        <h5 class="text-center mt-3"><?= $_SESSION['m_name'] ?></h5>
    </div>
    <div class="tab-result w-8/12 mt-5 mx-auto block">
        <!-- Button tabs -->
        <?php foreach($tabs_menus as $key => $menu): ?>
            <a href="<?= $menu['link'] ?>" class="<?= ($section === $key) ? 'active bg-blue-600 text-white' : 'bg-gray-200 text-gray-600' ?> rounded-md mb-3 py-2 px-3 no-underline"><?= $menu['text'] ?></a>
        <?php endforeach; ?>
        <!-- Logout -->
        <a href="?p=member&logout=1" class="bg-red-600 text-white px-3 py-2 mb-3 no-underline rounded-md float-right"><?= __('Logout') ?></a>
        <?php if (isset($_SESSION['info']) && !$sysconf['reserve_direct_database']): ?>
            <!-- Alert -->
            <div class="alert alert-<?= $_SESSION['info']['status'] ?>" role="alert">
                <?= $_SESSION['info']['data'] ?>
            </div>
        <?php endif; ?>
        <!-- set content -->
        <?php
            switch ($section) {
                case 'current_loan':
                    echo '<div class="memberProfile mt-8 w-full">';
                    echo showLoanList();
                    echo '</div>';
                    break;
                case 'title_basket':
                    echo '<div class="memberProfile mt-8 w-full">';
                    echo '<Basketlist reserve-type="' .$sysconf['reserve_direct_database']. '" num-label="' . __('title(s) on basket') . '" btn-reserve-label="' . __('Reserve title(s) on Basket') . '" btn-reserve-clear="' . __('Clear Basket') . '" btn-reserve-remove="' . __('Remove selected title(s) from Basket') . '"><Basketlist/>';
                    echo '</div>';
                    break;
                case 'loan_history':
                    echo '<div class="memberProfile mt-8 w-full">';
                    echo showLoanHist();
                    echo '</div>';
                    break;
                case 'my_account':
                    echo '<div class="memberProfile mt-8 w-full">';
                    echo showMemberDetail();
                    echo '</div>';
                    // change password only form NATIVE authentication, not for others such as LDAP
                    if ($sysconf['auth']['member']['method'] == 'native') {
                        echo '<div class="tagline">';
                        echo '<div class="memberInfoHead mt-8">' . __('Change Password') . '</div>' . "\n";
                        echo '</div>';
                        echo changePassword();
                    }
                    break;
            }
        ?>
    </div>
</div>