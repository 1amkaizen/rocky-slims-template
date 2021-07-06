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

    public static function getBasket()
    {
        // make instance
        $instance = DB::getInstance();
        // prepare query
        $query = 'select biblio_id AS \'ID\', title AS \'Title\' from biblio ';

        $criteria = 'biblio_id = 0';
        if (count($_SESSION['m_mark_biblio']) > 0) {
            $ids = '';
            foreach ($_SESSION['m_mark_biblio'] as $biblio) {
                $ids .= (integer)$biblio . ',';
            }
            $ids = substr_replace($ids, '', -1);
            $criteria = "biblio_id IN ($ids)";
        }
    
        $query .= ' where ' . $criteria . ' order by last_update desc';
    
        // run query
        $runQuery = $instance->query($query);
    
        return fetchData($runQuery);
    }
}