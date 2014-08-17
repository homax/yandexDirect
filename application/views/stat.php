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
    "Sum" =>  "",
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
echo "<table>";
echo "<thead>";
foreach ($result as $val) {
    foreach ($val as $key => $value) {
        if(array_key_exists($key, $arr) and (!empty($arr[$key])))
            echo "<th><small>$arr[$key]</small></th>";
        else
            echo "<th>$key</th>";
    }
    break;
}
echo "</thead>";
foreach ($result as $row) {
    echo "<tr>";
    foreach ($row as $field) {
        echo "<td>";
        echo $field;
        echo "</td>";
    }
    echo "</tr>";
}
echo "</table>";