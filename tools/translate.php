<?php

isDirect();

// load lang
$lang = $sysconf['default_lang'];
include __DIR__ . '/../lang/' . $lang . '/' . $lang .'.php';

/**
 * Rocky Translate
 *
 * @param string $word
 * @return string
 */
function t(string $word)
{
    global $map;

    // set system translate
    $translateWord = __($word);

    if ($translateWord !== $word)
    {
        return $translateWord;
    }
    else
    {
        // local translate
        $localTranslate = (isset($map[$word]) && !empty($map[$word])) ? $map[$word] : $word;
        return $localTranslate;
    }
}