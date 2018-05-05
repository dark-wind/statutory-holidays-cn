<?php
/**
 * Created by PhpStorm.
 * User: darkwind
 * Date: 18-5-4
 * Time: 上午11:46
 */

namespace Holiday;

class Model
{
    /**
     * holiday configs
     *
     * @var array
     */
    private $holidayConfigs;
    protected $response;

    public function __construct(Response $response)
    {
        $this->holidayConfigs = include __DIR__ . '/../config/map.php';
        $this->response = $response;
    }

    public function getHoliday()
    {
        return $this->holidayConfigs['holiday'];
    }

    public function getWorkday()
    {
        return $this->holidayConfigs['workday'];
    }

    public static function parse($date, $format = 'Ymd')
    {
        if ($date = date_create_from_format($format, $date)) {
            return $date;
        } else {
            throw new \Exception("date parse fail, please check format");
        }
    }

    public function isHoliday($date, $format = 'Ymd')
    {
        $parsedDate = self::parse($date, $format);
        $dateTimestamp = $parsedDate->getTimestamp();
        //是否属于调休上班
        if ($workdayInfo = $this->isSpecialWorkday($dateTimestamp)) {
            return $this->response->response('no', $workdayInfo);
        }

        //是否属于特殊节假日
        if ($holidayInfo = $this->isSpecialHoliday($dateTimestamp)) {
            return $this->response->response('yes', $holidayInfo);
        }

        //是否属于周末
        if ($this->isWeekend($dateTimestamp)) {
            return $this->response->response('yes', $this->getNormalDay($dateTimestamp));
        } else {
            return $this->response->response('no', $this->getNormalDay($dateTimestamp));
        }
    }

    public function isWorkDay($date, $format = 'Ymd')
    {
        $parsedDate = self::parse($date, $format);
        $dateTimestamp = $parsedDate->getTimestamp();
        $result = $this->isHoliday($date, $format);
        if ($result['result'] === 'yes') {
            return $this->response->response('no', $result['info']);
        } else {
            return $this->response->response('yes', $this->getNormalDay($dateTimestamp));
        }
    }

    public function isHolidayWithAppend($date, $format = 'Ymd')
    {
        $result = $this->isHoliday($date, $format);
        return $this->response->responseWithAppend($result['result'], $result['info']);
    }

    public function isWorkDayWithAppend($date, $format = 'Ymd')
    {
        $result = $this->isWorkDay($date, $format);
        return $this->response->responseWithAppend($result['result'], $result['info']);
    }

    public function holidays($start, $end, $format = 'Ymd')
    {
        $start = self::parse($start, $format)->getTimestamp();
        $end = self::parse($end, $format)->getTimestamp();
        $holiday = [
            'date' => [],
            'count' => 0
        ];
        while ($start <= $end) {
            $holidayInfo = $this->isHoliday(date('Ymd', $start));
            if ($holidayInfo['result'] == 'yes') {
                $holiday['date'][] = $holidayInfo['info'];
            }
            $start += 86400;
        }
        $holiday['count'] = count($holiday['date']);
        return $holiday;
    }

    public function isSpecialHoliday($dateTimestamp)
    {
        $specialHolidays = $this->getHoliday();
        $dateString = date('Ymd', $dateTimestamp);
        return array_key_exists($dateString, $specialHolidays) ? $specialHolidays[$dateString] : false;
    }

    public function isSpecialWorkday($dateTimestamp)
    {
        $specialWorkdays = $this->getWorkday();
        $dateString = date('Ymd', $dateTimestamp);
        return array_key_exists($dateString, $specialWorkdays) ? $specialWorkdays[$dateString] : false;
    }

    public function isWeekend($dateTimestamp)
    {
        $weekDay = date('w', $dateTimestamp);
        if ($weekDay == 6 || $weekDay == 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getNormalDay($dateTimestamp)
    {
        return [
            'day' => date('Ymd', $dateTimestamp),
            'holiday' => '',
            'holiday_remark' => '',
            'begin' => '',
            'end' => ''
        ];
    }
}