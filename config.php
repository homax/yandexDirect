<?php

set_include_path(get_include_path()
    .PATH_SEPARATOR.'application/controllers'
    .PATH_SEPARATOR.'application/models'
    .PATH_SEPARATOR.'application/views');

define('DOMEN', 'http://direct');
define('BASE_URL', '/');

function __autoload($class){
    require_once($class.'.php');
}

return array(
    'login' => 'ordirekt',
    'api' => 'https://api-sandbox.direct.yandex.ru/v4/json/',
    'master-token' => 'KQLB04DU2engEwdj',
    'db' => array(
        'connect' => 'sqlite:db.s3db',
    ),
);
 