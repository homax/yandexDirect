<?php


class YD {
    private static $_instance;
    private $config;

    public static function getInstance() {
        if(!(self::$_instance instanceof self))
            self::$_instance = new static();
        return self::$_instance;
    }
    private function __construct(){
        $this->config = FrontController::$config;
    }

    public function getStat($arrayIds, $curFrom, $curTo, &$error = Null) {
        $method = 'GetSummaryStat';
        $params = array(
            'CampaignIDS' => $arrayIds,
            'StartDate' => ($curFrom) ? $curFrom : date('Y-m-d'),
            'EndDate' => ($curTo) ? $curTo : date('Y-m-d'),
        );
        return $this->requestApi($method, $params, $error);
    }

    public function getCampaignsList(&$error = Null){
        $method = 'GetCampaignsList';
        $params = array();
        return $this->requestApi($method, $params, $error);
    }

    public function getCampaignsListFilter(&$error = Null){
        $method = 'GetCampaignsListFilter';
        $params = array(
            'Filter' => array(
                'IsActive' => array('No')
            )
        );
        return $this->requestApi($method, $params, $error);
    }

    public function createInvoice(&$error = Null){
        $method = 'CreateInvoice';
        $params = array(
            'Payments' => array(
                array('CampaignID' => 66904, 'Sum' => 2000.0),
                array('CampaignID' => 66905, 'Sum' => 3000.0)
            )
        );
        return $this->requestFinApi($method, $params, $error);
    }

    public function transferMoney(&$error = Null){
        $method = 'TransferMoney';
        $params = array(
            'FromCampaigns' => array(
                array('CampaignID' => 66903, 'Sum' => 500)
            ),
            'ToCampaigns' => array(
                array('CampaignID' => 66904, 'Sum' => 300),
                array('CampaignID' => 66905, 'Sum' => 200)
            )
        );
        return $this->requestFinApi($method, $params, $error);
    }

    public function resumeCampaign($id) {
        $method = 'ResumeCampaign';
        $params = array(
            'CampaignID' => $id
        );
        $this->requestApi($method, $params);
    }

    public function stopCampaign($id) {
        $method = 'StopCampaign';
        $params = array(
            'CampaignID' => $id
        );
        $this->requestApi($method, $params);
    }

    public function moderateBanners($id, $ids = array()) {
        $method = 'ModerateBanners';
        $params = array(
            /*'CampaignID' => $id,*/
            'BannerIDS' => array(781072)
        );
        return $this->requestApi($method, $params);
    }

    public function getBanners($id, $ids = array()) {
        $method = 'GetBanners';
        $params = array(
            'CampaignIDS' => $id,
        );
        return $this->requestApi($method, $params);
    }

    public function ArchiveCampaign($id) {
        $method = 'ArchiveCampaign';
        $params = array(
            'CampaignID' => $id,
        );
        $this->requestApi($method, $params);
    }

    public function UnArchiveCampaign($id) {
        $method = 'UnArchiveCampaign';
        $params = array(
            'CampaignID' => $id,
        );
        $this->requestApi($method, $params);
    }

    private function requestApi($method, $params, &$error = Null) {
        //формирование запроса
        $request = array(
            'token'=> '34ae8cf3995842be878b8e7ec8af83a7',
            'method'=> $method,
            'param'=> Model::utf8($params),
            'locale'=> 'ru',
        );

        //преобразование в JSON-формат
        $request = json_encode($request);

        //параметры запроса
        $opts = array(
            'http'=>array(
                'method'=>"POST",
                'content'=>$request,
            )
        );

        //создание контекста потока
        $context = stream_context_create($opts);

        //отправляем запрос и получаем ответ от сервера
        $result = file_get_contents($this->config['api'], 0, $context);

        //вывод результата
        $result = json_decode($result);
        if($result->error_str != "") {
            $error = true;
            return $result->error_str;
        }
        return $result;
    }

    private function requestFinApi($method, $params, &$error = Null) {
        //формирование запроса
        $request = array(
            'token'=> '34ae8cf3995842be878b8e7ec8af83a7',
            'method'=> $method,
            "finance_token" => Model::getFinanceToken($method),
            "operation_num" => time(),
            'param'=> Model::utf8($params),
            'locale'=> 'ru',
        );

        //преобразование в JSON-формат
        $request = json_encode($request);

        //параметры запроса
        $opts = array(
            'http'=>array(
                'method'=>"POST",
                'content'=>$request,
            )
        );

        //создание контекста потока
        $context = stream_context_create($opts);

        //отправляем запрос и получаем ответ от сервера
        $result = file_get_contents($this->config['api'], 0, $context);

        //вывод результата
        $result = json_decode($result);
        if($result->error_str != "") {
            $error = true;
            return $result->error_str;
        }
        return $result;
    }
} 