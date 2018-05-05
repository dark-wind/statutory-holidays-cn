# statutory-holidays-cn
statutory holidays for china 中国法定节假日

默认只有18年的
   
## 安装
```
composer require darkwind/statutory-holidays-cn
```

## 栗子
```php
use Holiday\Holiday;

//判断是否为假期
Holiday::isHoliday('20180501');
    [
         "result" => "yes",
         "info" => [
           "day" => "20180501",
           "holiday" => "劳动节",
           "holiday_remark" => "4月29日至5月1日放假调休，共3天。4月28日（星期六）上班",
           "begin" => "",
           "end" => "",
         ],
    ]

Holiday::isHoliday('20180502');
    [
         "result" => "no",
         "info" => [
           "day" => "20180502",
           "holiday" => "",
           "holiday_remark" => "",
           "begin" => "",
           "end" => "",
         ],
    ]


//判断是否为工作日
Holiday::isWorkday('20180501');
Holiday::isWorkday('20180502');
Holiday::isWorkday('20180505');

//2个日期间有多少个假日
Holiday::holidays('20180301', '20180601');
Holiday::holidays('20180421', '20180502');
[
     "date" => [
       [
         "day" => "20180421",
         "holiday" => "",
         "holiday_remark" => "",
         "begin" => "",
         "end" => "",
       ],
       [
         "day" => "20180422",
         "holiday" => "",
         "holiday_remark" => "",
         "begin" => "",
         "end" => "",
       ],
       [
         "day" => "20180429",
         "holiday" => "劳动节",
         "holiday_remark" => "4月29日至5月1日放假调休，共3天。4月28日（星期六）上班",
         "begin" => "",
         "end" => "",
       ],
       [
         "day" => "20180430",
         "holiday" => "劳动节",
         "holiday_remark" => "4月29日至5月1日放假调休，共3天。4月28日（星期六）上班",
         "begin" => "",
         "end" => "",
       ],
       [
         "day" => "20180501",
         "holiday" => "劳动节",
         "holiday_remark" => "4月29日至5月1日放假调休，共3天。4月28日（星期六）上班",
         "begin" => "",
         "end" => "",
       ],
     ],
     "count" => 5,
]

//追加星期信息
Holiday::isHolidayWithAppend('20180501');
[
     "result" => "no",
     "info" => [
       "day" => "20180502",
       "holiday" => "",
       "holiday_remark" => "",
       "begin" => "",
       "end" => "",
       "weekDay" => "6",
       "cn" => "周六",
       "en" => "Saturday",
     ],
]
```

## 扩展
```
暂时只支持返回数组，需要其他格式请继承并重载 src/Response.php
自定义节假日或增加其他年份假期，请自行修改config/custom.php
```

## 测试
```bash
cd tests
php test.php
```

