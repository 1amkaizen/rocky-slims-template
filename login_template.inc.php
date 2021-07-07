<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-25 19:35:58
 * @modify date 2021-06-25 19:35:58
 * @desc [description]
 */

// require helper
require_once __DIR__ . '/tools/helper.php';
require_once __DIR__ . '/tools/translate.php';

isDirect();

?>
<!DOCTYPE html>
<html lang="<?= $sysconf['default_lang'] ?>">
    <head>
        <?php tarsiusLoad(__DIR__ . '/components/meta'); ?>   
    </head>
    <body>
        <section class="flex flex-wrap">
            <div class="w-1/2 h-screen">
                <div class="w-6/12 mx-auto block">
                    <form method="post" action="?p=login">
                        <div class="w-full">
                        <?php if (!is_null(getLogo())): ?>
                            <img src="<?= getLogo() ?>" class="block mx-auto mt-24 mb-8 h-16 w-16"/>
                        <?php else: ?>
                            <svg class="fill-current text-gray-500 mx-auto mt-24 mb-8 block h-16 w-16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 118.4 135" style="enable-background:new 0 0 118.4 135;" xml:space="preserve">
                                        <path d="M118.3,98.3l0-62.3l0-0.2c-0.1-1.6-1-3-2.3-3.9c-0.1,0-0.1-0.1-0.2-0.1L61.9,0.8c-1.7-1-3.9-1-5.4-0.1l-54,31.1
                                        l-0.4,0.2C0.9,33,0.1,34.4,0,36c0,0.1,0,0.2,0,0.3l0,62.4l0,0.3c0.1,1.6,1,3,2.3,3.9c0.1,0.1,0.2,0.1,0.2,0.2l53.9,31.1l0.3,0.2
                                        c0.8,0.4,1.6,0.6,2.4,0.6c0.8,0,1.5-0.2,2.2-0.5l53.9-31.1c0.3-0.1,0.6-0.3,0.9-0.5c1.2-0.9,2-2.3,2.1-3.7c0-0.1,0-0.3,0-0.4
                                        C118.4,98.6,118.3,98.5,118.3,98.3z M114.4,98.8c0,0.3-0.2,0.7-0.5,0.9c-0.1,0.1-0.2,0.1-0.2,0.1l-20.6,11.9L59.2,92.1l-33.9,19.6
                                        L4.6,99.7l0,0l0,0C4.2,99.5,4,99.2,4,98.8l0-62.5l0,0l0-0.1c0-0.4,0.2-0.7,0.5-0.9l20.8-12l33.9,19.6l33.9-19.6l20.6,11.9l0.1,0
                                        c0.3,0.2,0.5,0.5,0.6,0.9l0,62.3L114.4,98.8L114.4,98.8z M95.3,68.6v39.4L23.1,66.4V26.9L95.3,68.6z"></path>
                            </svg>
                        <?php endif; ?>
                        </div>
                        <!-- Csrf Token -->
                        <?= \Volnix\CSRF\CSRF::getHiddenInputString() ?>
                        <!-- Username -->
                        <div class="w-full">
                            <label class="block my-2"><?= t('Username') ?></label>
                            <input type="text" class="w-full p-2 focus:bg-gray-200 bg-gray-300" name="userName" required>
                        </div>
                        <!-- Password -->
                        <div class="w-full">
                            <label class="block my-2"><?= t('Password') ?></label>
                            <input type="password" class="w-full p-2 focus:bg-gray-200 bg-gray-300" name="passWord" required>
                        </div>
                        <!-- Remember Me -->
                        <div class="w-full">
                            <input type="checkbox" class="p-5 focus:bg-gray-200 bg-gray-300" name="remember">
                            <label class="inline-block my-2"><?= t('Remember me') ?></label>
                        </div>
                        <?php if ($sysconf['captcha']['smc']['enable']): ?>
                        <div class="w-full">
                            <?php if ($sysconf['captcha']['smc']['type'] == "recaptcha"): ?>
                                <div class="captchaAdmin">
                                <?php
                                    require_once LIB.$sysconf['captcha']['smc']['folder'].'/'.$sysconf['captcha']['smc']['incfile'];
                                    $publickey = $sysconf['captcha']['smc']['publickey'];
                                    echo recaptcha_get_html($publickey);
                                ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <div class="w-full">
                            <input type="submit" name="logMeIn" value="<?= t('Login') ?>" class="loginButton my-1 float-right btn btn-primary">
                            <a href="index.php?p=forgot" class="block p-2 no-underline text-gray-500 hover:text-blue-500"><?= t('Forgot my password') ?></a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-1/2 h-screen login-screen">
                <a target="_blank" class="fixed right-0 bottom-0 text-white no-underline mb-6 mr-6" href="https://unsplash.com/photos/1WQ5RZuH9xo">Photo by Pascal Debrunner</a>
            </div>
        </section>
    </body>
</html>