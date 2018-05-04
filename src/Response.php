<?php
/**
 * Created by PhpStorm.
 * User: darkwind
 * Date: 18-5-4
 * Time: 下午3:23
 */

namespace Holiday;


class Response
{
    /**
     * The day constants.
     */
    const SUNDAY = 0;
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;

    /**
     * Names of days of the week.
     *
     * @var array
     */
    protected static $days = array(
        self::SUNDAY => 'Sunday',
        self::MONDAY => 'Monday',
        self::TUESDAY => 'Tuesday',
        self::WEDNESDAY => 'Wednesday',
        self::THURSDAY => 'Thursday',
        self::FRIDAY => 'Friday',
        self::SATURDAY => 'Saturday',
    );

    /**
     * Names of days of the week.
     *
     * @var array
     */
    protected static $daysCN = array(
        self::SUNDAY => '周日',
        self::MONDAY => '周一',
        self::TUESDAY => '周二',
        self::WEDNESDAY => '周三',
        self::THURSDAY => '周四',
        self::FRIDAY => '周五',
        self::SATURDAY => '周六',
    );

    public function response($result, $info)
    {
        return [
            'result' => $result,
            'info' => $info,
        ];
    }


    public function responseWithAppend($result, $info)
    {
        return [
            'result' => $result,
            'info' => $this->appendInfo($info)
        ];
    }

    public function appendInfo($info)
    {
        $date = $info['day'];
        $weekDay = date('w', $date);
        $info['weekDay'] = $weekDay;
        $info['cn'] = self::$daysCN[$weekDay];
        $info['en'] = self::$days[$weekDay];
        return $info;
    }
}
