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

    public function lazyLoad($position = 'all')
    {
        $db = SLiMS\DB::getInstance();

        // get max id
        $maxId = (!is_numeric($position)) ? 
                        $db->query('select max(biblio_id) from search_biblio')->fetch(PDO::FETCH_NUM)[0]
                        :
                        $position;

        // Grab data
        $data = $db->prepare('select biblio_id,title,image,notes from search_biblio where biblio_id <= :maxId order by biblio_id desc limit 5');
        $data->execute(['maxId' => $maxId]);
        // set cache
        $cache = [];
        $cache['status'] = true;
        $cache['data'] = [];

        // set row count
        if ($data->rowCount() > 0)
        {
            $cache['nextMax'] = $maxId  - 5;
            while($result = $data->fetch(PDO::FETCH_ASSOC))
            {
                $result['notes'] = (!empty($result['notes'])) ? substr($result['notes'], 0,50) . '...' : 'No Description Available';
                $cache['data'][] = $result;
            }
        }
        else
        {
            $cache['status'] = false;
        }

        jsonResponse($cache);
    }

    public function searchBook()
    {
        // Set DB
        $db = SLiMS\DB::getInstance();

        $Keywords = '';
        foreach (isset($_GET['keywords']) ? explode(' ', $_GET['keywords']) : [] as $index => $value) {
            $Keywords .= '+' . $value .' ';
        }
        $Keywords = substr_replace($Keywords, '', -1);

        // Set up query
        $Data = $db->prepare('select biblio_id,title,image,notes from search_biblio where match(title) against(:keywords)');
        $Data->execute(['keywords' => "$Keywords IN BOOLEAN MODE"]);

        $Result = [];
        while ($Loop = $Data->fetch(PDO::FETCH_ASSOC)) {
            $Result[] = $Loop;
        }

        jsonResponse(['status' => (bool)count($Result), 'msg' => 'ok', 'data' => $Result]);
    }
}