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

// set jsMap
$jsMap = [
    ["src" => tarsiusUrl("assets/js/vue.js"), "type" => "text/javascript"],
    ["src" => tarsiusUrl(versioning("assets/js/app.js")), "type" => "module"]
];

// Javascript
tarsiusJS($jsMap);
?>