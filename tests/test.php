<?php
/**
 * Created by PhpStorm.
 * User: darkwindcc
 * Date: 17-10-19
 * Time: 下午4:57
 */

require '../vendor/autoload.php';

$holidayDate = [
    '20180429',
    '20180430',
    '20180501',
];

$workDate = [
    '20180428',
    '20180502',
    '20180503',
];

$holidayRoundDate = [
    '20180531' => 'no',
    '20180601' => 'no',
    '20180617' => 'yes',

];

foreach ($holidayDate as $holiday) {
    $rs = \Holiday\Holiday::isHoliday($holiday);
    if ($rs['result'] == 'yes') {
        echo $holiday, expectTrue(true, 'holiday check right'), PHP_EOL;
    } else {
        echo $holiday, expectTrue(false, 'holiday check fail'), PHP_EOL;
    }
}

foreach ($workDate as $workday) {
    $rs = \Holiday\Holiday::isWorkday($workday);
    if ($rs['result'] == 'yes') {
        echo $workday, expectTrue(true, 'workday check right'), PHP_EOL;
    } else {
        echo $workday, expectTrue(false, 'workday check fail'), PHP_EOL;
    }
}

foreach ($holidayDate as $holiday) {
    $rs = \Holiday\Holiday::isWorkday($holiday);
    if ($rs['result'] == 'no') {
        echo $holiday, expectTrue(true, 'holiday check right'), PHP_EOL;
    } else {
        echo $holiday, expectTrue(false, 'holiday check fail'), PHP_EOL;
    }
}

foreach ($holidayRoundDate as $date => $assert) {
    $rs = \Holiday\Holiday::isHoliday($date);
    if ($rs['result'] == $assert) {
        echo $date, expectTrue(true, 'round test right'), PHP_EOL;
    } else {
        echo $date, expectTrue(false, 'round test fail'), PHP_EOL;
    }
}

function expectTrue($flag, $name)
{
    return ' ' . ($flag ? '√' : '×') . ' ' . $name;
}
