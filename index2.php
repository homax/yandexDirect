<?php
//Подключение конфигурации

try {
    $dbh = new PDO($params['db']['connect']);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
 