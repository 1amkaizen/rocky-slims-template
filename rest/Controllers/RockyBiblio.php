<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-23 08:07:09
 * @modify date 2021-06-23 08:07:09
 * @desc [description]
 */

use SLiMS\DB;

class RockyBiblio
{
    private $sysconf;

    public function __construct($sysconf)
    {
        $this->sysconf = $sysconf;
    }

    public function getLatest()
    {
        // create instance
        $instance = DB::getInstance();
        
        // set limit
        $limit = $this->sysconf['template']['rocky_carousell_limit'];

        // set query
        $query = "select biblio_id, title, image 
                    from biblio
                    order by last_update desc
                    limit {$limit}";

        // run query
        $run = $instance->query($query);

        // get data
        $result = [];

        while ($data = $run->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $data;
        }

        // set response
        jsonResponse($result);
    }
}