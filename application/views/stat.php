<?php
$arr =  array(
    "CampaignID" => "ID кампании",
    "StatDate" => "Дата",
    "SumSearch" => "Стоимость кликов на поиске",
    "SumContext" => "Стоимость кликов в РСЯ",
    "ShowsSearch" => "Количество показов на поиске",
    "ShowsContext" => "Количество показов в РСЯ",
    "ClicksSearch" => "Количество кликов на поиске",
    "ClicksContext" => "Количество кликов в РСЯ",
    "SessionDepthSearch" => "Глубина просмотра сайта при переходе с поиска",
    "SessionDepthContext" => "Глубина просмотра сайта при переходе из РСЯ",
    "GoalConversionSearch" => "Достижения цели на поиске",
    "GoalConversionContext" => "Достижения цели в РСЯ",
    "GoalCostSearch" => "Стоимость цели на поиске",
    "GoalCostContext" => "Стоимость цели в РСЯ",
    "CampaignID" =>  "ID",
    "Login" =>  "",
    "Name" =>  "Название",
    "StartDate" =>  "Дата запуска",
    "Sum" =>  "Начальная сумма",
    "Rest" =>  "Остаток",
    "SumAvailableForTransfer" =>  "",
    "Shows" =>  "Показы",
    "Clicks" =>  "Клики",
    "Status" =>  "Статус",
    "StatusShow" =>  "Статус показа",
    "StatusArchive" =>  "Архив",
    "StatusActivating" =>  "Статус активации",
    "StatusModerate" =>  "Статус модерирования",
    "IsActive" =>  "Активность",
    "ManagerName" =>  "",
    "AgencyName" =>  ""
);
echo "<table class='table'>";
echo "<thead>";
foreach ($result as $val) {
    foreach ($val as $key => $value) {
        if(array_key_exists($key, $arr) and (!empty($arr[$key])))
            echo "<th><small>$arr[$key]</small></th>";
        else
            echo "<th><small>$key</small></th>";
    }
    break;
}
echo "</thead>";
foreach ($result as $campId=>$row) {
    echo "<tr class='info'>";
    foreach ($row as $key=>$field) {
        if($key == 'Clicks') {
            $class = ($field >= $clicks[$campId]) ? "warning" : "danger";
            echo "<td class='$class'>";
            echo $field . " (" . $clicks[$campId] . ")";
            echo "</td>";
        }else{
            echo "<td>";
            echo $field;
            echo "</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";