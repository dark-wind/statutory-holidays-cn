<?php
/**
 * Created by PhpStorm.
 * User: darkwind
 * Date: 18-5-4
 * Time: 下午4:56
 */
require_once __DIR__ . '/vendor/autoload.php';

use Holiday\Holiday;

//判断是否为假期
//var_dump(Holiday::isHoliday('20180501'));
//var_dump(Holiday::isHoliday('20180502'));
//
////判断是否为工作日
//var_dump(Holiday::isWorkday('20180501'));
//var_dump(Holiday::isWorkday('20180502'));
//var_dump(Holiday::isWorkday('20180505'));
//
////2个日期间有多少个假日
//var_dump(Holiday::holidays('20180301', '20180601'));
//var_dump(Holiday::holidays('20180421', '20180502'));

//追加星期信息
//var_dump(Holiday::isHolidayWithAppend('20180501'));

echo json_encode(Holiday::isHolidayWithAppend('20180502'));