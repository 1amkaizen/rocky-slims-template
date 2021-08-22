<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-08-02 16:07:04
 * @modify date 2021-08-02 16:07:04
 * @desc [description]
 */


spl_autoload_register(function($class) {
    $class = str_replace('Rocky\\', 'Rest\\', $class);
    $paths = explode('\\', $class);
    $fixPath = [];
    foreach ($paths as $index => $path) {
        if ($index === 0)
        {
            $fixPath[] = strtolower($path);
        }
        else
        {
            $fixPath[] = $path;
        }
    }
    
    include __DIR__ . DS . '../' . implode(DS, $fixPath) . '.php';
});