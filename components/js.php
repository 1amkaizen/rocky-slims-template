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

$vue = (ENVIRONMENT === 'development') ? 'vue' : 'vue.min';

// set jsMap
$jsMap = [
    ["src" => tarsiusUrl("assets/js/$vue.js"), "type" => "text/javascript"],
    ["src" => tarsiusUrl("assets/js/vuex.js"), "type" => "text/javascript"],
    ["src" => tarsiusUrl("assets/js/vue-toastr-2.min.js"), "type" => "text/javascript"],
    ["src" => tarsiusUrl("assets/js/lib/splide/js/splide.min.js"), "type" => "text/javascript"],
    ["src" => tarsiusUrl(versioning("assets/js/app.js")), "type" => "module"]
];

// Javascript
tarsiusJS($jsMap);
?>