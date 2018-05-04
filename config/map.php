<?php
/**
 * Created by PhpStorm.
 * User: darkwind
 * Date: 18-5-4
 * Time: 上午11:37
 */
$customPath = __DIR__ . '/custom.php';
$dataPath = __DIR__ . '/data.php';
$custom = include $customPath;
$data = include $dataPath;

$workdays = array_merge($data['workday'], $custom['workday']);
$holidays = array_merge($data['holiday'], $custom['holiday']);

$workdayWithKey = [];
$holidayWithKey = [];
foreach ($workdays as $workday) {
    $workdayWithKey[$workday['day']] = $workday;
}
foreach ($holidays as $holiday) {
    $holidayWithKey[$holiday['day']] = $holiday;
}

return [
    'workday' => $workdayWithKey,
    'holiday' => $holidayWithKey,
];