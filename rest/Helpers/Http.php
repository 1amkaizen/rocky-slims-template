<?php
/**
 * 
 */
class Http
{
    public static function getRawPost($key = '')
    {
        $_POST = json_decode(file_get_contents('php://input'), TRUE);

        return (!empty($key) && isset($_POST[$key])) ? $_POST[$key] : $_POST;
    }    

    public static function responseJson($mix)
    {
        jsonResponse($mix);
    }
}
