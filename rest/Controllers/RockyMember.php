<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-07-16 10:45:26
 * @modify date 2021-07-16 10:45:26
 * @desc [description]
 */

// load heloer
require __DIR__ . '/../Helpers/Http.php';
require __DIR__ . '/../Helpers/Openssl.php';

// load login library
require LIB . 'member_logon.inc.php';

class RockyMember extends member_logon
{
    private $dbs;
    protected $sysconf;
    protected $post;

    public function __construct($sysconf, $dbs)
    {
        $this->post = Http::getRawPost();
        $this->dbs = $dbs;
        $this->sysconf = $sysconf;
        if (isset($this->post['auth']))
        {
            parent::__construct($this->post['username'], $this->post['password']);
        }
    }

    public function auth()
    {
        global $rocky_unique_key;

        if (!Openssl::isLoaded())
        {
            Http::responseJson(['status' => false, 'message' => 'Ekstensi Openssl pada PHP belum diinstall, hubungi petugas untuk mengaktifkan. Terimakasih']);
        }

        if ($this->valid($this->dbs))
        {
            unset($this->user_info['mpasswd']);
            $token = Openssl::crypt(json_encode(['username' => $this->post['username'], 'expired' => strtotime(date('Y-m-d H:i:s', strtotime('+2 Hours')))]), $rocky_unique_key);
            Http::responseJson(['status' => true, 'data' => $this->user_info, 'token' => $token]);
        }

        Http::responseJson(['status' => false, 'message' => $this->errors]);
    }

    private function tokenLifeCheck($token)
    {
        global $rocky_unique_key;

        $decryptingToken = Openssl::decrypt($token, $rocky_unique_key, function($afterDecrypt) {
            return json_decode($afterDecrypt, true);
        });

        if (isset($decryptingToken['expired']))
        {
            return (strtotime(date('Y-m-d H:i:s')) > $decryptingToken['expired']) ? 'expired' : 'continue';
        }

        return 'notvalid';
    }
}