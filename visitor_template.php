<?php

if (!function_exists('isDirect'))
{
    require __DIR__ . DS . 'tools' . DS . 'helper.php';
}

isDirect();

$main_template_path = tarsiusDir('components' . DS . 'visitorTemplate.php');