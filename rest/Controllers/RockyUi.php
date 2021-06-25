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
        }

        jsonResponse($list);
    }
}