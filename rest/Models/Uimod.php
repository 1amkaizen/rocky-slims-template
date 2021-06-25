<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-25 07:55:32
 * @modify date 2021-06-25 07:55:32
 * @desc [description]
 */

use SLiMS\DB;

class Uimod
{
    public static function getLocationList()
    {
        // make instance
        $instance = DB::getInstance();
        // prepare query
        $LocationListQuery = $instance->query('select location_name as value, location_name as label from mst_location limit 50');
        // fetch data
        return fetchData($LocationListQuery);
    }

    public static function getGmdList()
    {
        // make instance
        $instance = DB::getInstance();
        // prepare query
        $LocationListQuery = $instance->query('select gmd_name as value, gmd_name as label from mst_gmd limit 50');
        // fetch data
        return fetchData($LocationListQuery);
    }

    public static function getCollTypeList()
    {
        // make instance
        $instance = DB::getInstance();
        // prepare query
        $CollTypeListQuery = $instance->query('select coll_type_name as value, coll_type_name as label from mst_coll_type limit 50');
        // fetch data
        return fetchData($CollTypeListQuery);
    }
}