<?php
class IndexController extends Controller implements IController {

    private $db, $fc, $config, $model, $yd, $error = false;
    private $fields = [
        'Name',
        'CampaignID',
        'IsActive',
        'Status',
        'StatusShow',
        'StatusArchive',
        'StatDate',
        'StatusModerate',
        'StatusActivating',
        'Shows',
        'ShowsSearch',
        'ShowsContext',
        'Clicks',
        'ClicksSearch',
        'SumSearch',
        'ClicksContext',
        'SumContext',
        'Sum',
        'Rest',
        'StartDate',
    ];

    function __construct() {
        $this->db = DB::getInstance();
        $this->fc = FrontController::getInstance();
        $this->config = FrontController::$config;
        $this->model = Model::getInstance();
        $this->yd = YD::getInstance();
    }

    public function indexAction() {


        $ids = $this->model->getCampaignsIds();
        $login = $this->config['login'];
        $method = 'GetCampaignsList';
        $params = array();

        $request = array(
            'token'=> '34ae8cf3995842be878b8e7ec8af83a7',
            'method'=> $method,
            'param'=> Model::utf8($params),
            'locale'=> 'ru',
        );

        $request = json_encode($request);

        $opts = array(
            'http'=>array(
                'method'=>"POST",
                'content'=>$request,
            )
        );

        $context = stream_context_create($opts);

        $result = file_get_contents($this->config['api'], 0, $context);

        $result = json_decode($result);

        $arrIds = [];
        foreach ($result->data as $campaign) {
            if(in_array($campaign->CampaignID, $ids)) {
                $arrIds[$campaign->CampaignID] = $campaign->Name;
            }
        }

        $active = $this->yd->getCampaignsListFilter();
        $hasNoactive = (count($active->data) > 0) ? true : false;

        $output = $this->Template('index.php', array('ids' => $arrIds, "hasNoActive" => $hasNoactive));
        $output = $this->Template('main.php', array('content' => $output));

        $this->fc->setBody($output);
    }

	public function statAction() {
        $curId = $_POST['id'];
        $curFrom = $_POST['dateFrom'];
        $curTo = $_POST['dateTo'];
        $arrayIds = [];
        if($curId) {
            $arrayIds[] = $curId;
        }else{
            $ids = $this->db->Select("Select id from campaign");

            foreach ($ids as $id) {
                array_push($arrayIds, (int)$id['id']);
            }
        }
        $res = $this->yd->getStat($arrayIds, $curFrom, $curTo, $this->error);
        $campaigns = $this->yd->getCampaignsList();
        if($this->error) {
            $output = $res;
        }else {
            $itog = array();

            foreach($res->data as $val) {
                foreach($val as $k=>$v) {
                    if(in_array($k, $this->fields))
                        $itog[$val->CampaignID][$k] = $v;
                }
            }
            foreach($campaigns->data as $val) {
                if($curId) {
                    if(in_array($val->CampaignID, $arrayIds))
                        foreach($val as $k=>$v) {
                            if(in_array($k, $this->fields))
                                $itog[$val->CampaignID][$k] = $v;
                        }
                }
                else {
                    foreach($val as $k=>$v) {
                        if(in_array($k, $this->fields))
                            $itog[$val->CampaignID][$k] = $v;
                    }
                }
            }
            foreach ($itog as $key=>$item) {
                foreach($this->fields as $field) {
                    if(!array_key_exists($field, $item)) {
                        $itog[$key][$field] = "–";
                    }
                }
                uksort($itog[$key], function($a, $b) {
                    $k1 = array_search($a, $this->fields);
                    $k2 = array_search($b, $this->fields);
                    if($k1>$k2) return 1;
                    if($k1<$k2) return -1;
                    return 0;
                });
            }

            $output = $this->Template('stat.php', array('result' => $itog));
            $output = $this->Template('empty.php', array('content' => $output));
        }
		$this->fc->setBody($output);
	}

    public function analyzeAction() {
        $clicks = $this->model->getCampaignsClicks();
        $campaigns = $this->yd->getCampaignsList();
        $curClicks = [];
        foreach ($campaigns->data as $campaign) {
            $curClicks[$campaign->CampaignID] = $campaign->Clicks;
        }
        foreach($clicks as $key => $value) {
            if($value > $curClicks[$key])
                $this->yd->stopCampaign($key);
        }
        //$this->fc->setBody($output);
    }

    public function startAction() {
        $active = $this->yd->getCampaignsListFilter();
        if(count($active->data) > 0) {
            foreach($active->data as $key => $value) {
                $this->yd->resumeCampaign($value->CampaignID);
                echo "кампания {$value->CampaignID} запущена";
            }
        }
    }

    public function testAction() {
        $result = $this->yd->getCampaignsList($this->error);
        if($this->error) {
            print_r($result);
        }else {
            echo "<pre>";
            print_r($result);
            foreach ($result->data as $campaign) {
                echo $campaign->Name ."(".$campaign->CampaignID.")<br>";
            }
            /*$result2 = $this->yd->getBanners(array(66904));
            var_dump($result2);
            $res2 = $this->yd->moderateBanners(NULL, array(781073));
            print_r($res2);*/
        }
    }

}
