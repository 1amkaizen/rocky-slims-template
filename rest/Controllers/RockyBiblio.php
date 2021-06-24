<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-06-23 08:07:09
 * @modify date 2021-06-23 08:07:09
 * @desc Some modificatioin from BiblioController
 */

use SLiMS\DB;

class RockyBiblio
{
    protected $sysconf;

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

    public function getPopular()
    {
        // create instance
        $instance = DB::getInstance();

        // set cache name
        $cache_name = 'biblio_popular';

        // cache check
        if (!is_null($json = Cache::get($cache_name))) exit($json);

        // set limit
        $limit = $this->sysconf['template']['rocky_carousell_limit'];

        // set query with limit
        $sql = "SELECT b.biblio_id, b.title, b.image, COUNT(*) AS total
          FROM loan AS l
          LEFT JOIN item AS i ON l.item_code=i.item_code
          LEFT JOIN biblio AS b ON i.biblio_id=b.biblio_id
          WHERE b.title IS NOT NULL
          GROUP BY b.biblio_id
          ORDER BY total DESC
          LIMIT {$limit}";
        
        // run query
        $query = $instance->query($sql);
        $return = array();

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $return[] = $data;
        }

        if ($query->rowCount() < $limit) {
            $need = $limit - $query->rowCount();
            if ($need < 0) {
                $need = $limit;
            }

            $sql = "SELECT biblio_id, title, image FROM biblio ORDER BY last_update DESC LIMIT {$need}";
            $query = $instance->query($sql);
            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $return[] = $data;
            }
        }

        // set cache
        Cache::set($cache_name, json_encode($return));

        // set response
        jsonResponse($return);
    }
}