<?php

class Model{

    private static $_instance;
    private $db;

    public static function getInstance() {
        if(!(self::$_instance instanceof self))
            self::$_instance = new static();
        return self::$_instance;
    }
    private function __construct(){
        $this->db = DB::getInstance();
    }

    static function utf8($struct) {
        foreach ($struct as $key => $value) {
            if (is_array($value)) {
                $struct[$key] = self::utf8($value);
            }
            elseif (is_string($value)) {
                $struct[$key] = utf8_encode($value);
            }
        }
        return $struct;
    }

    public function getCampaignsIds(){
        $ids = $this->db->Select("Select id from campaign");
        $arrayIds = [];
        foreach ($ids as $id) {
            array_push($arrayIds, (int)$id['id']);
        }
        return $arrayIds;
    }

    public function getCampaignsClicks(){
        $ids = $this->db->Select("Select id, click_per_week from campaign");
        $arrayClicks = [];
        foreach ($ids as $id) {
            $arrayClicks[(int)$id['id']] = (int)$id['click_per_week'];
        }
        return $arrayClicks;
    }

    public static function getFinanceToken($method) {
        $master_token = FrontController::$config['master-token'];
        $operation_num = time();
        $used_method = $method;
        $login = FrontController::$config['login'];
        return $finance_token = hash("sha256", $master_token . $operation_num . $used_method . $login);
    }

}