<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-23 08:07:09
 * @modify date 2021-06-25 07:52:52
 * @desc Some modificatioin from BiblioController
 */

require __DIR__ . '/../Models/Uimod.php';

class RockyUi
{
    protected $sysconf;

    public function __construct($sysconf)
    {
        $this->sysconf = $sysconf;
    }

    public function common($type)
    {
        switch ($type) {
            case 'location':
                $list = Uimod::getLocationList();
                break;
            case 'gmd':
                $list = Uimod::getGmdList();
                break;
            case 'colltype':
                $list = Uimod::getCollTypeList();
                break;
            case 'basicinformation':
                $list = [
                    'library_name' => $this->sysconf['library_name'],
                    'library_map' => $this->sysconf['template']['rocky_library_map']
                ];
                break;
        }

        jsonResponse($list);
    }

    public function basket()
    {
        if (isset($_SESSION['m_mark_biblio']))
        {
            jsonResponse(Uimod::getBasket());
        }
        // no session no data
        jsonResponse([]);
    }

    public function searchImage($memberId)
    {
        $dir = scandir(IMGBS . 'persons' . DS);
        $memberId = urldecode($memberId);

        $photoProfile = array_values(array_filter($dir, function($file) use($memberId) {
            if (preg_match('/(member_'.$memberId.')/i', $file))
            {
                return $file;
            }
        }));

        jsonResponse(['status' => (isset($photoProfile[0])) ?? false, 'file' => (isset($photoProfile[0])) ? './images/persons/' . $photoProfile[0] : []]);
    }
}