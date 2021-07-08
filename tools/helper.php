<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-06 08:04:49
 * @modify date 2021-06-06 08:04:49
 * @desc [description]
 */

function tarsiusUrl(string $additionalUrl): string
{
    global $sysconf;
    
    $template = $sysconf['template']['theme'];
    return SWB . 'template/'.$template.'/' .$additionalUrl;
}

function tarsiusDir(string $additionalPath = ''): string
{
    global $sysconf;

    return SB . 'template' . DS . $sysconf['template']['theme'] . DS . $additionalPath;
}

function tarsiusLoad($path, string $type = 'include'): void
{
    global $sysconf,$page_title,$metadata,
           $header_info,$search_result_info,
           $main_content,$image_src,$notes,$subject,
           $available_languages,$message,$msg;
    
    if (!is_array($path))
    {
        $path = [$path];
    }

    foreach ($path as $key => $file) {
        if (file_exists($file. '.php'))
        {
            switch ($type) {
                case 'include':
                    include $file . '.php';
                    break;
        
                case 'include_once':
                    include_once $file . '.php';
                    break;
        
                case 'require':
                    require $file . '.php';
                    break;
                case 'require_once':
                    require_once $file . '.php';
                    break;
            }
        }            
    }
}


function tarsiusComponents($components)
{
    if (is_array($components))
    {
        foreach ($components as $id => $component) {
            $components[$id] = tarsiusDir('components' . DS . $component);
        }
    }
    else
    {
        $components = tarsiusDir('components' . DS . $components);
    }

    tarsiusLoad($components);
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

function keywordsFilter(string $string)
{
    $string = strip_tags($string);
    $string = str_replace('"', '', $string);

    return $string;
}

function keywordRegex(string $string)
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

function jsonResponse($mix)
{
    header('Content-Type: application/json');
    echo json_encode($mix);
    exit;
}   

function conditionComponent(string $dir, array $arrayComponents)
{
    global $main_content;

    $match = false;
    foreach ($arrayComponents as $components) {
        if (isset($_GET['p']) && ($components === $_GET['p']) && file_exists($dir . DS . $components . '.php')) 
        {
            $match = true; 
            tarsiusLoad($dir.DS.$components);
        }
    }

    if (!$match)
    {
        tarsiusLoad($dir . DS . 'commonTemplate');
    }
}

function registerRest()
{
    global $sysconf;

    $routes = SB . 'api/v' . $sysconf['api']['version'] . '/routes.php';
    $getRoutesString = file_get_contents($routes);
    
    // header('Content-Type: text/plain'); // just for debugging
    // echo $getRoutesString;
    // exit;
    if (!preg_match('/(Rocky Routes)/', $getRoutesString))
    {
        // set variable
        $target = '$router->setBasePath(\'api\');';
        $replaceWith = "$target\n\n/*----------  Rocky Routes  ----------*/\nif (file_exists(SB . 'template/rocky/rest/routes.php')) require SB . 'template/rocky/rest/routes.php';";
        // go replace
        $modify = str_replace($target, $replaceWith, $getRoutesString);

        // put contents
        file_put_contents($routes, $modify);
    }
}

function imagickCheck()
{
    if (!class_exists('Imagick'))
    {
        echo <<<HTML
            <!-- Imagick -->
            <div class="w-full block p-2 mb-2 rounded-lg text-white bg-red-500">
                <strong>Ekstensi Imagick belum terinstall, segera install agar template dapat mengelola gambar dengan baik.</strong>
            </div>
        HTML;
    }  
}

function curlCheck()
{
    if (!function_exists('curl_init'))
    {
        echo <<<HTML
            <!-- Imagick -->
            <div class="w-full block p-2 mb-2 rounded-lg text-white bg-red-500">
                <strong>Extension cURL tidak terinstall, install terlebih dahulu ekstensi tersebut agar template dapat berjalan dengan baik.</strong>
            </div>
        HTML;
    }
}

function getLogo()
{
    global $sysconf;

    if (isset($sysconf['logo_image']) && $sysconf['logo_image'] != '' && file_exists('images/default/'.$sysconf['logo_image']))
    {
        return SWB . 'images/default/'.$sysconf['logo_image'];
    }

    return null;
}

function fetchData(object $obj, string $type = PDO::FETCH_ASSOC)
{
    $result = [];

    while ($data = $obj->fetch($type)) {
        $result[] = $data;
    }

    return $result;
}

function setLangFlag(string $lang)
{
    global $sysconf;

    $fixLang = strtolower(substr($lang, 3,2));
    $filePath = SB.'template/default/assets/flags/4x3/' . $fixLang . '.svg';

    if (file_exists($filePath))
    {
        $rawImage = file_get_contents($filePath);

        return str_replace('id="flag-icon-css-us"', 'class="inline-block w-5 h-5"', $rawImage);
    }
}

function setLangFlagList(string $defaultLang, array $available_languages)
{
    global $sysconf;
    
    $Lang = [];

    foreach ($available_languages as $idLang => $lang) {
        if ($lang[0] !== $defaultLang)
        {
            $Lang[] = ['code' => $lang[0], 'icon' => strtolower(substr($lang[0], 3,2)), 'label' => $lang[1]];
        }
    }

    return $Lang;
}

function shortCutWord(string $sentence, int $limitWord = 3)
{
    $modify = explode(' ', $sentence);
    
    $fix = [];

    for ($word=0; $word < $limitWord; $word++) { 
        $fix[] = $modify[$word];
    }

    return implode(' ', $fix);
}

function getMemberPhotoProfileSrc()
{
    if (isset($_SESSION['m_image']) && file_exists(IMGBS.'persons'.DS.basename($_SESSION['m_image'])))
    {
        return SWB . 'images/persons/' . basename($_SESSION['m_image']);
    }
    // set base image
    return SWB . 'images/persons/avatar.jpg';
}

function removeSessionBasket()
{
    if (isset($_SESSION['m_mark_biblio']) && count($_SESSION['m_mark_biblio']) === 0)
    {
        echo '<script>localStorage.removeItem(\'biblioMark\')</script>';
    }
}

function httpRequest(string $url): string
{
    // get from https://reqbin.com/req/php/c-1n4ljxb9/curl-get-request-example
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //for debug only!
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    
    return $resp;
}

function locationMap(string $html): string
{
    // $removeWidthHeight = preg_replace('/(width="+[0-9]+"\s+)|(height="+[0-9]+")/', 'class="h-64 w-64"', $html);
    // $iframeFiltering = strip_tags($removeWidthHeight, '<iframe>');

    return '<iframe src="' . addslashes($html) .'" style="border:0;" class="h-64 w-64" allowfullscreen="" loading="lazy"></iframe>';
}

function dd($mix, $exit = true)
{
    echo '<pre>';
    var_dump($mix);
    echo '</pre>';

    if ($exit) exit();
}