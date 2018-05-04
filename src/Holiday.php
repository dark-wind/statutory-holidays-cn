<?php
/**
 * Created by PhpStorm.
 * User: darkwind
 * Date: 18-5-2
 * Time: 上午11:03
 */

namespace Holiday;

class Holiday
{
    public static function isWorkday($date, $format = 'Ymd')
    {
        $model = new Model(new Response());
        return $model->isWorkday($date, $format);
    }

    public static function isHoliday($date, $format = 'Ymd')
    {
        $model = new Model(new Response());
        return $model->isHoliday($date, $format);
    }

    public static function isWorkdayWithAppend($date, $format = 'Ymd')
    {
        $model = new Model(new Response());
        return $model->isWorkDayWithAppend($date, $format);
    }

    public static function isHolidayWithAppend($date, $format = 'Ymd')
    {
        $model = new Model(new Response());
        return $model->isHolidayWithAppend($date, $format);
    }


    public static function holidays($start, $end, $format = 'Ymd')
    {
        $model = new Model(new Response());
        return $model->holidays($start, $end, $format);
    }


}