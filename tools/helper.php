<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-06 08:04:49
 * @modify date 2021-06-06 08:04:49
 * @desc [description]
 */

function tarsiusUrl(string $additionalUrl, string $template = 'tarsius'): string
{
    return SWB . 'template/'.$template.'/' .$additionalUrl;
}

function tarsiusLoad(string $path, string $type = 'include'): void
{
    global $sysconf,$page_title,$metadata,
           $header_info,$search_result_info,
           $main_content,$image_src,$notes,$subject;

    switch ($type) {
        case 'include':
            include $path;
            break;

        case 'include_once':
            include_once $path;
            break;

        case 'require':
            require $path;
            break;
        case 'require_once':
            require_once $path;
            break;
        
        default:
            # code...
            break;
    }
}

function tarsiusMeta(array $metas):void
{
    global $sysconf,$page_title,$metadata;

    foreach ($metas as $meta) {
        if (is_array($meta))
        {
            echo '<meta ';
            foreach ($meta as $prop => $value) {
                echo $prop. '="' .strip_tags(str_replace(['\'', '"'], '', $value)). '" ';
            }
            echo '/>'."\n";
        }
        else if (!empty($meta))
        {
            echo $meta;
        }
    }
}

function tarsiusStylesheet(array $stylesheets):void
{
    global $sysconf,$page_title,$metadata;

    foreach ($stylesheets as $stylesheet) {
        if (is_array($stylesheet))
        {
            echo '<link ';
            foreach ($stylesheet as $prop => $value) {
                echo $prop. '="' .strip_tags(str_replace(['\'', '"'], '', $value)). '" ';
            }
            echo '/>';
        }
        else if (!empty($stylesheet))
        {
            echo $stylesheet;
        }
    }
}

function tarsiusJS(array $javascripts):void
{
    global $sysconf,$page_title,$metadata;

    echo '<!-- JS -->'."\n";
    foreach ($javascripts as $javascript) {
        if (is_array($javascript))
        {
            echo '<script ';
            foreach ($javascript as $prop => $value) {
                echo $prop. '="' .strip_tags(str_replace(['\'', '"'], '', $value)). '" ';
            }
            echo '></script>';
        }
        else if (!empty($javascript))
        {
            echo $javascript;
        }
    }
}

function versioning(string $path):string
{
    $version = substr(SENAYAN_VERSION_TAG, 1);
    if (ENVIRONMENT === 'development')
    {
        $version = date('YmdHis');
    }

    return $path . '?v=' .$version;
}

function makeDropDown(string $label, array $options = []):string
{
    $dd  = '<div class="dropdown show">';
    $dd .= '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
    $dd .= strip_tags($label);
    $dd .= '</a>';
    $dd .= '<div class="dropdown-menu overflow-y-auto h-48 md:h-auto lg:h-auto w-full md:w-auto lg:w-auto " aria-labelledby="dropdownMenuLink">';
    if (count($options) > 0)
    {
        foreach ($options as $href => $optionLabel) {
            $dd .= '<a class="dropdown-item ml-10 md:ml-auto lg:ml-auto" href="' .strip_tags($href). '">' .strip_tags($optionLabel). '</a>';
        }
    }
    $dd .= '</div>';
    $dd .= '</div>';

    return $dd;
}

function isDirect():void
{
    if (!defined('INDEX_AUTH'))
    {
        die('No direct access!');
    }
}

function keywordsFilter($string)
{
    $string = strip_tags($string);
    $string = str_replace('"', '', $string);

    return $string;
}

function keywordRegex($string)
{
    $filterKeywords = keywordsFilter($string);
    $chunkKeywords = explode(' ', $filterKeywords);

    $fixWords = [];
    foreach ($chunkKeywords as $words) {
        $fixWords[] = $words;
    }

    return '('.implode(')|(', $fixWords).')';
}

function jsonOneQuotes($mixData)
{
    return str_replace('"', '\'', json_encode($mixData));
}

function conditionComponent($dir, $arrayComponents)
{
    foreach ($arrayComponents as $components) {
        if (isset($_GET['p']) && ($components === $_GET['p']) && file_exists($dir.'/'.$components.'.php')) tarsiusLoad($dir.'/'.$components.'.php');
    }
}