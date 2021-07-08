<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-07-08 13:33:23
 * @modify date 2021-07-08 13:33:23
 * @desc [description]
 */

isDirect();

?>
<div class="w-full h-screen mb-4 bg-gray-100">
    <?php if (!utility::isMemberLogin()): ?>
        <div class="grid grid-cols-1 gap-0">
            <div class="banner h-20 mt-16 in-zi">
                <span class="block text-center text-gray-100 mt-4 uppercase"><?= __('Member Area') ?></span>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-0">
            <div class="w-3/12 mt-14 mx-auto bg-white block h-auto shadow-2xl p-5">
                <form class="memberForm" action="?p=member" method="POST">
                    <!-- Field -->
                    <?= \Volnix\CSRF\CSRF::getHiddenInputString() ?>
                    <?= isset($msg) ? $msg : null ?> 
                    <label class="block"><?= __('Username') ?></label>
                    <input type="text" name="memberID" class="w-full block bg-gray-300 cursor-pointer mt-2 px-3 py-2 focus:bg-gray-200 rounded-full"/>
                    <label class="block mt-2"><?= __('Password') ?></label>
                    <input type="password" name="memberPassWord" class="w-full block bg-gray-300 cursor-pointer mt-2 px-3 py-2 focus:bg-gray-200 rounded-full"/>
                    <!-- Captcha -->
                    <?php if ($sysconf['captcha']['member']['enable']) { ?>
                        <?php if ($sysconf['captcha']['member']['type'] == "recaptcha") { ?>
                            <div class="captchaMember">
                                <?php
                                require_once LIB . $sysconf['captcha']['member']['folder'] . '/' . $sysconf['captcha']['member']['incfile'];
                                $publickey = $sysconf['captcha']['member']['publickey'];
                                echo recaptcha_get_html($publickey);
                                ?>
                            </div>
                            <!-- <div><input type="text" name="captcha_code" id="captcha-form" style="width: 80%;" /></div> -->
                            <?php
                        } elseif ($sysconf['captcha']['member']['type'] == "others") {
                            #code here
                        }
                        #debugging
                        #echo SWB.'lib/'.$sysconf['captcha']['folder'].'/'.$sysconf['captcha']['webfile'];
                    } ?>
                    <!-- Button -->
                    <input type="submit" name="logMeIn" class="w-full block rounded-full bg-blue-600 hover:bg-blue-500 mt-3 py-2 px-3 text-white" value="<?= __('Login') ?>"/>
                </form>
            </div>
        </div>
    <?php else: tarsiusComponents('memberProfile'); endif; ?>
</div>