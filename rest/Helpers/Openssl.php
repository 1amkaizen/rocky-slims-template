<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-07-16 12:03:26
 * @modify date 2021-07-16 12:03:26
 * @desc [description]
 */

// Took from https://www.php.net/manual/en/function.openssl-encrypt.php

class Openssl
{
    public static function crypt($plaintext, $key)
    {
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );

        return $ciphertext;
    }

    public static function decrypt($ciphertext, $key, $callBack = '')
    {
        $c = base64_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);

        if (hash_equals($hmac, $calcmac))// timing attack safe comparison
        {
            if (!empty($callBack))
            {
                $formatedData = $callBack($original_plaintext);
                return $formatedData;
            }
            return $original_plaintext;
        }

        return null;
    }

    public static function isLoaded()
    {
        return extension_loaded('openssl');
    }
}