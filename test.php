<?php
$login = 'ordirekt';
$method = 'GetCampaignsList';
$params = array();

# ============================================================

# перекодировка строковых данных в UTF-8
function utf8($struct) {
    foreach ($struct as $key => $value) {
        if (is_array($value)) {
            $struct[$key] = utf8($value);
        }
        elseif (is_string($value)) {
            $struct[$key] = utf8_encode($value);
        }
    }
    return $struct;
}

# формирование запроса    
$request = array(
    'token'=> '34ae8cf3995842be878b8e7ec8af83a7',
    'method'=> $method,
    'param'=> utf8($params),
    'locale'=> 'ru',
);


# преобразование в JSON-формат
$request = json_encode($request);


# параметры запроса
$opts = array(
    'http'=>array(
        'method'=>"POST",
        'content'=>$request,
    )
);


# создание контекста потока
$context = stream_context_create($opts);


# отправляем запрос и получаем ответ от сервера
$result = file_get_contents('https://api-sandbox.direct.yandex.ru/v4/json/', 0, $context);


# вывод результата
//print_r($result);
$result = json_decode($result);
echo "<pre>";
print_r($result);
foreach ($result->data as $campaign) {
    echo $campaign->Name ."(".$campaign->CampaignID.")<br>";
}

?>