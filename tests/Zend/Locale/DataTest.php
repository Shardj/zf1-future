<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Locale
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_Locale_Data
 */
require_once 'Zend/Locale/Data.php';


/**
 * @category   Zend
 * @package    Zend_Locale
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Locale
 */
class Zend_Locale_DataTest extends PHPUnit_Framework_TestCase
{

    private $_cache = null;

    public function setUp()
    {
        require_once 'Zend/Cache.php';
        $this->_cache = Zend_Cache::factory('Core', 'File',
                 ['lifetime' => 1, 'automatic_serialization' => true],
                 ['cache_dir' => dirname(__FILE__) . '/../_files/']);
        Zend_Locale_Data::setCache($this->_cache);
    }


    public function tearDown()
    {
        $this->_cache->clean(Zend_Cache::CLEANING_MODE_ALL);
    }

    /**
     * test for reading the scriptlist from a locale that is an alias
     */
    public function testAliases()
    {
        $data = Zend_Locale_Data::getList('zh_CN', 'script');
        $this->assertEquals('阿拉伯文', $data['Arab']);
    }

    /**
     * test for reading with standard locale
     * expected array
     */
    public function testNoLocale()
    {
        $this->assertTrue(is_array(Zend_Locale_Data::getList(null, 'language')));

        try {
            $value = Zend_Locale_Data::getList('nolocale','language');
            $this->fail('locale should throw exception');
        } catch (Zend_Locale_Exception $e) {
            // success
        }

        $locale = new Zend_Locale('de');
        $this->assertTrue(is_array(Zend_Locale_Data::getList($locale, 'language')));
    }


    /**
     * test for reading without type
     * expected empty array
     */
    public function testNoType()
    {
        try {
            $value = Zend_Locale_Data::getContent('de','');
            $this->fail('content should throw an exception');
        } catch (Zend_Locale_Exception $e) {
            // success
        }

        try {
            $value = Zend_Locale_Data::getContent('de','xxxxxxx');
            $this->fail('content should throw an exception');
        } catch (Zend_Locale_Exception $e) {
            // success
        }
    }


    /**
     * test for reading the languagelist from locale
     * expected array
     */
    public function testLanguage()
    {
        $data = Zend_Locale_Data::getList('de','language');
        $this->assertEquals('Deutsch',  $data['de']);
        $this->assertEquals('Englisch', $data['en']);

        $value = Zend_Locale_Data::getContent('de', 'language', 'de');
        $this->assertEquals('Deutsch', $value);
    }

    /**
     * test for reading the scriptlist from locale
     * expected array
     */
    public function testScript()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'script');
        $this->assertEquals('Arabisch',   $data['Arab']);
        $this->assertEquals('Lateinisch', $data['Latn']);

        $value = Zend_Locale_Data::getContent('de_AT', 'script', 'Arab');
        $this->assertEquals('Arabisch', $value);
    }

    /**
     * test for reading the territorylist from locale
     * expected array
     */
    public function testTerritory()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'territory');
        $this->assertEquals('Österreich', $data['AT']);
        $this->assertEquals('Martinique', $data['MQ']);

        $value = Zend_Locale_Data::getContent('de_AT', 'territory', 'AT');
        $this->assertEquals('Österreich', $value);
    }

    /**
     * test for reading the variantlist from locale
     * expected array
     */
    public function testVariant()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'variant');
        $this->assertEquals('Boontling', $data['BOONT']);
        $this->assertEquals('Saho',      $data['SAAHO']);

        $value = Zend_Locale_Data::getContent('de_AT', 'variant', 'POSIX');
        $this->assertEquals('Posix', $value);
    }

    /**
     * test for reading the keylist from locale
     * expected array
     */
    public function testKey()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'key');
        $this->assertEquals('Kalender',   $data['calendar']);
        $this->assertEquals('Sortierung', $data['collation']);

        $value = Zend_Locale_Data::getContent('de_AT', 'key', 'collation');
        $this->assertEquals('Sortierung', $value);
    }

    /**
     * test for reading the typelist from locale
     * expected array
     */
    public function testType()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'type');
        $this->assertEquals('Chinesischer Kalender', $data['chinese']);
        $this->assertEquals('Strichfolge',           $data['stroke']);

        $data = Zend_Locale_Data::getList('de_AT', 'type', 'calendar');
        $this->assertEquals('Chinesischer Kalender', $data['chinese']);
        $this->assertEquals('Japanischer Kalender',  $data['japanese']);

        $value = Zend_Locale_Data::getList('de_AT', 'type', 'chinese');
        $this->assertEquals('Chinesischer Kalender', $value['chinese']);
    }

    /**
     * test for reading layout from locale
     * expected array
     */
    public function testLayout()
    {
        $layout = Zend_Locale_Data::getList('ar', 'layout');
        $this->assertEquals("right-to-left", $layout['characterOrder']);
        $this->assertEquals("top-to-bottom", $layout['lineOrder']);
    }

    /**
     * test for reading contexttransforms from locale
     * expect array
     */
    public function testContextTransform()
    {
        $contexttransform = Zend_Locale_Data::getList('uk', 'contexttransform', 'uiListOrMenu');
        $result = [
            'languages' => 'titlecase-firstword',
            'day-format-except-narrow' => 'titlecase-firstword',
            'day-standalone-except-narrow' => 'titlecase-firstword',
            'month-format-except-narrow' => 'titlecase-firstword',
            'month-standalone-except-narrow' => 'titlecase-firstword',
        ];
        $this->assertEquals($result, $contexttransform);
    }

    /**
     * test for reading characters from locale
     * expected array
     */
    public function testCharacters()
    {
        $char = Zend_Locale_Data::getList('de', 'characters');
        $this->assertEquals("[a ä b c d e f g h i j k l m n o ö p q r s ß t u ü v w x y z]", $char['characters']);
        $this->assertEquals("[á à ă â å ã ā æ ç é è ĕ ê ë ē ğ í ì ĭ î ï İ ī ı ñ ó ò ŏ ô ø ō œ ş ú ù ŭ û ū ÿ]", $char['auxiliary']);
        // $this->assertEquals("[a-z]", $char['currencySymbol']);
    }

    /**
     * test for reading delimiters from locale
     * expected array
     */
    public function testDelimiters()
    {
        $quote = Zend_Locale_Data::getList('de', 'delimiters');
        $this->assertEquals("„", $quote['quoteStart']);
        $this->assertEquals("“", $quote['quoteEnd']);
        $this->assertEquals("‚", $quote['quoteStartAlt']);
        $this->assertEquals("‘", $quote['quoteEndAlt']);
    }

    /**
     * test for reading measurement from locale
     * expected array
     */
    public function testMeasurement()
    {
        $measure = Zend_Locale_Data::getList('de', 'measurement');
        $this->assertEquals("001", $measure['metric']);
        $this->assertEquals("LR MM US",  $measure['US']);
        $this->assertEquals("001", $measure['A4']);
        $this->assertEquals("BZ CA CL CO CR GT MX NI PA PH PR SV US VE",  $measure['US-Letter']);
    }

    /**
     * test for reading defaultcalendar from locale
     * expected array
     */
    public function testDefaultCalendar()
    {
        $date = Zend_Locale_Data::getContent('th_TH', 'defaultcalendar');
        $this->assertEquals("buddhist", $date);

        $date = Zend_Locale_Data::getContent('de_AT', 'defaultcalendar');
        $this->assertEquals("gregorian", $date);
    }

    /**
     * test for reading defaultmonthcontext from locale
     * expected array
     */
    public function testDefaultMonthContext()
    {
        $date = Zend_Locale_Data::getContent('de_AT', 'monthcontext');
        $this->assertEquals("format", $date);

        $date = Zend_Locale_Data::getContent('de_AT', 'monthcontext', 'islamic');
        $this->assertEquals("format", $date);
    }

    /**
     * test for reading defaultmonth from locale
     * expected array
     */
    public function testDefaultMonth()
    {
        $date = Zend_Locale_Data::getContent('de_AT', 'defaultmonth');
        $this->assertEquals("wide", $date);

        $date = Zend_Locale_Data::getContent('de_AT', 'defaultmonth', 'islamic');
        $this->assertEquals("wide", $date);
    }

    /**
     * test for reading month from locale
     * expected array
     */
    public function testMonth()
    {
        $date   = Zend_Locale_Data::getList('de_AT', 'months');
        $result = [
            'context'     => 'format',
            'default'     => 'wide',
            'format'      =>
                [
                    'abbreviated' =>
                        [
                            1  => 'Jän.',
                            2  => 'Feb.',
                            3  => 'März',
                            4  => 'Apr.',
                            5  => 'Mai',
                            6  => 'Juni',
                            7  => 'Juli',
                            8  => 'Aug.',
                            9  => 'Sep.',
                            10 => 'Okt.',
                            11 => 'Nov.',
                            12 => 'Dez.',
                        ],
                    'narrow'      =>
                        [
                            1  => 'J',
                            2  => 'F',
                            3  => 'M',
                            4  => 'A',
                            5  => 'M',
                            6  => 'J',
                            7  => 'J',
                            8  => 'A',
                            9  => 'S',
                            10 => 'O',
                            11 => 'N',
                            12 => 'D',
                        ],
                    'wide'        =>
                        [
                            1  => 'Jänner',
                            2  => 'Februar',
                            3  => 'März',
                            4  => 'April',
                            5  => 'Mai',
                            6  => 'Juni',
                            7  => 'Juli',
                            8  => 'August',
                            9  => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Dezember',
                        ],
                ],
            'stand-alone' =>
                [
                    'abbreviated' =>
                        [
                            1  => 'Jän',
                            2  => 'Feb',
                            3  => 'Mär',
                            4  => 'Apr',
                            5  => 'Mai',
                            6  => 'Jun',
                            7  => 'Jul',
                            8  => 'Aug',
                            9  => 'Sep',
                            10 => 'Okt',
                            11 => 'Nov',
                            12 => 'Dez',
                        ],
                    'narrow'      =>
                        [
                            1  => 'J',
                            2  => 'F',
                            3  => 'M',
                            4  => 'A',
                            5  => 'M',
                            6  => 'J',
                            7  => 'J',
                            8  => 'A',
                            9  => 'S',
                            10 => 'O',
                            11 => 'N',
                            12 => 'D',
                        ],
                    'wide'        =>
                        [
                            1  => 'Jänner',
                            2  => 'Februar',
                            3  => 'März',
                            4  => 'April',
                            5  => 'Mai',
                            6  => 'Juni',
                            7  => 'Juli',
                            8  => 'August',
                            9  => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Dezember',
                        ],
                ],
        ];
        $this->assertEquals($result, $date, var_export($date, 1));

        $date   = Zend_Locale_Data::getList('de_AT', 'months', 'islamic');
        $result = [
            "context"     => "format",
            "default"     => "wide",
            "format"      =>
                [
                    "abbreviated" => [
                        1  => "Muh.",
                        2  => "Saf.",
                        3  => "Rab. I",
                        4  => "Rab. II",
                        5  => "Jum. I",
                        6  => "Jum. II",
                        7  => "Raj.",
                        8  => "Sha.",
                        9  => "Ram.",
                        10 => "Shaw.",
                        11 => "Dhuʻl-Q.",
                        12 => "Dhuʻl-H."
                    ],
                    "narrow"      => [
                        1  => '1',
                        2  => '2',
                        3  => '3',
                        4  => '4',
                        5  => '5',
                        6  => '6',
                        7  => '7',
                        8  => '8',
                        9  => '9',
                        10 => '10',
                        11 => '11',
                        12 => '12'
                    ],
                    "wide"        => [
                        1  => "Muharram",
                        2  => "Safar",
                        3  => "Rabiʻ I",
                        4  => "Rabiʻ II",
                        5  => "Jumada I",
                        6  => "Jumada II",
                        7  => "Rajab",
                        8  => "Shaʻban",
                        9  => "Ramadan",
                        10 => "Shawwal",
                        11 => "Dhuʻl-Qiʻdah",
                        12 => "Dhuʻl-Hijjah"
                    ]
                ],
            "stand-alone" => [
                "abbreviated" => [
                    1  => "Muh.",
                    2  => "Saf.",
                    3  => "Rab. I",
                    4  => "Rab. II",
                    5  => "Jum. I",
                    6  => "Jum. II",
                    7  => "Raj.",
                    8  => "Sha.",
                    9  => "Ram.",
                    10 => "Shaw.",
                    11 => "Dhuʻl-Q.",
                    12 => "Dhuʻl-H."
                ],
                "narrow"      => [
                    1  => '1',
                    2  => '2',
                    3  => '3',
                    4  => '4',
                    5  => '5',
                    6  => '6',
                    7  => '7',
                    8  => '8',
                    9  => '9',
                    10 => '10',
                    11 => '11',
                    12 => '12'
                ],
                "wide"        => [
                    1  => "Muharram",
                    2  => "Safar",
                    3  => "Rabiʻ I",
                    4  => "Rabiʻ II",
                    5  => "Jumada I",
                    6  => "Jumada II",
                    7  => "Rajab",
                    8  => "Shaʻban",
                    9  => "Ramadan",
                    10 => "Shawwal",
                    11 => "Dhuʻl-Qiʻdah",
                    12 => "Dhuʻl-Hijjah"
                ]
            ]
        ];
        $this->assertEquals($result, $date);

        $date = Zend_Locale_Data::getList('de_AT', 'month');
        $this->assertEquals(
            [
                1  => "Jänner",
                2  => "Februar",
                3  => "März",
                4  => "April",
                5  => "Mai",
                6  => "Juni",
                7  => "Juli",
                8  => "August",
                9  => "September",
                10 => "Oktober",
                11 => "November",
                12 => "Dezember"
            ],
            $date
        );

        $date = Zend_Locale_Data::getList('de_AT', 'month', ['gregorian', 'format', 'wide']);
        $this->assertEquals(
            [
                1  => "Jänner",
                2  => "Februar",
                3  => "März",
                4  => "April",
                5  => "Mai",
                6  => "Juni",
                7  => "Juli",
                8  => "August",
                9  => "September",
                10 => "Oktober",
                11 => "November",
                12 => "Dezember"
            ],
            $date
        );

        $value = Zend_Locale_Data::getContent('de_AT', 'month', 12);
        $this->assertEquals('Dezember', $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'month', ['gregorian', 'format', 'wide', 12]);
        $this->assertEquals('Dezember', $value);

        $value = Zend_Locale_Data::getContent('ar', 'month', ['islamic', 'format', 'wide', 1]);
        $this->assertEquals("محرم", $value);
    }

    /**
     * test for reading defaultdaycontext from locale
     * expected array
     */
    public function testDefaultDayContext()
    {
        $date = Zend_Locale_Data::getContent('de_AT', 'daycontext');
        $this->assertEquals("format", $date);

        $date = Zend_Locale_Data::getContent('de_AT', 'daycontext', 'islamic');
        $this->assertEquals("format", $date);
    }

    /**
     * test for reading defaultday from locale
     * expected array
     */
    public function testDefaultDay()
    {
        $date = Zend_Locale_Data::getContent('de_AT', 'defaultday');
        $this->assertEquals("wide", $date);

        $date = Zend_Locale_Data::getContent('de_AT', 'defaultday', 'islamic');
        $this->assertEquals("wide", $date);
    }

    /**
     * test for reading day from locale
     * expected array
     */
    public function testDay()
    {
        $date = Zend_Locale_Data::getList('de_AT', 'days');
        $result = ["context" => "format", "default" => "wide", "format" =>
            ["abbreviated" => ["sun" => "So.", "mon" => "Mo.", "tue" => "Di.", "wed" => "Mi.",
                      "thu" => "Do.", "fri" => "Fr.", "sat" => "Sa."],
                  "narrow" => ["sun" => "S", "mon" => "M", "tue" => "D", "wed" => "M",
                      "thu" => "D", "fri" => "F", "sat" => "S"],
                  "wide" => ["sun" => "Sonntag", "mon" => "Montag", "tue" => "Dienstag",
                      "wed" => "Mittwoch", "thu" => "Donnerstag", "fri" => "Freitag", "sat" => "Samstag"]
            ],
            "stand-alone" => ["abbreviated" => ["sun" => "So", "mon" => "Mo", "tue" => "Di", "wed" => "Mi",
                      "thu" => "Do", "fri" => "Fr", "sat" => "Sa"],
                  "narrow" => ["sun" => "S", "mon" => "M", "tue" => "D", "wed" => "M",
                      "thu" => "D", "fri" => "F", "sat" => "S"],
                  "wide" => ["sun" => "Sonntag", "mon" => "Montag", "tue" => "Dienstag", "wed" => "Mittwoch",
                      "thu" => "Donnerstag", "fri" => "Freitag", "sat" => "Samstag"]
            ]];
        $this->assertEquals($result, $date);

        $date = Zend_Locale_Data::getList('de_AT', 'days', 'islamic');
        $result = ["context" => "format", "default" => "wide", "format" =>
            ["abbreviated" => ["sun" => "Sun", "mon" => "Mon", "tue" => "Tue", "wed" => "Wed",
                      "thu" => "Thu", "fri" => "Fri", "sat" => "Sat"],
                  "narrow" => ["sun" => "S", "mon" => "M", "tue" => "T", "wed" => "W",
                      "thu" => "T", "fri" => "F", "sat" => "S"],
                  "wide" => ["sun" => "Sun", "mon" => "Mon", "tue" => "Tue", "wed" => "Wed",
                      "thu" => "Thu", "fri" => "Fri", "sat" => "Sat"]
            ],
            "stand-alone" => ["abbreviated" => ["sun" => "Sun", "mon" => "Mon", "tue" => "Tue", "wed" => "Wed",
                      "thu" => "Thu", "fri" => "Fri", "sat" => "Sat"],
                  "narrow" => ["sun" => "S", "mon" => "M", "tue" => "T", "wed" => "W",
                      "thu" => "T", "fri" => "F", "sat" => "S"],
                  "wide" => ["sun" => "Sun", "mon" => "Mon", "tue" => "Tue", "wed" => "Wed",
                      "thu" => "Thu", "fri" => "Fri", "sat" => "Sat"]
            ]];
        $this->assertEquals($result, $date);

        $date = Zend_Locale_Data::getList('de_AT', 'day');
        $this->assertEquals(["sun" => "Sonntag", "mon" => "Montag", "tue" => "Dienstag",
                      "wed" => "Mittwoch", "thu" => "Donnerstag", "fri" => "Freitag", "sat" => "Samstag"], $date);

        $date = Zend_Locale_Data::getList('de_AT', 'day', ['gregorian', 'format', 'wide']);
        $this->assertEquals(["sun" => "Sonntag", "mon" => "Montag", "tue" => "Dienstag",
                      "wed" => "Mittwoch", "thu" => "Donnerstag", "fri" => "Freitag", "sat" => "Samstag"], $date);

        $value = Zend_Locale_Data::getContent('de_AT', 'day', 'mon');
        $this->assertEquals('Montag', $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'day', ['gregorian', 'format', 'wide', 'mon']);
        $this->assertEquals('Montag', $value);

        $value = Zend_Locale_Data::getContent('ar', 'day', ['islamic', 'format', 'wide', 'mon']);
        $this->assertEquals("Mon", $value);
    }

    /**
     * test for reading quarter from locale
     * expected array
     */
    public function testQuarter()
    {
        $date = Zend_Locale_Data::getList('de_AT', 'quarters');
        $result = ["format" =>
            ["abbreviated" => ["1" => "Q1", "2" => "Q2", "3" => "Q3", "4" => "Q4"],
                  "narrow" => ["1" => "1", "2" => "2", "3" => "3", "4" => "4"],
                  "wide" => ["1" => "1. Quartal", "2" => "2. Quartal", "3" => "3. Quartal",
                      "4" => "4. Quartal"]
            ],
            "stand-alone" => ["abbreviated" => ["1" => "Q1", "2" => "Q2", "3" => "Q3", "4" => "Q4"],
                  "narrow" => ["1" => "1", "2" => "2", "3" => "3", "4" => "4"],
                  "wide" => ["1" => "1. Quartal", "2" => "2. Quartal", "3" => "3. Quartal", "4" => "4. Quartal"]
            ]];
        $this->assertEquals($result, $date);

        $date = Zend_Locale_Data::getList('de_AT', 'quarters', 'islamic');
        $result = ["format" =>
            ["abbreviated" => ["1" => "Q1", "2" => "Q2", "3" => "Q3", "4" => "Q4"],
                  "narrow" => ["1" => "1", "2" => "2", "3" => "3", "4" => "4"],
                  "wide" => ["1" => "Q1", "2" => "Q2", "3" => "Q3",
                      "4" => "Q4"]
            ],
            "stand-alone" => ["abbreviated" => ["1" => "Q1", "2" => "Q2", "3" => "Q3", "4" => "Q4"],
                  "narrow" => ["1" => "1", "2" => "2", "3" => "3", "4" => "4"],
                  "wide" => ["1" => "Q1", "2" => "Q2", "3" => "Q3", "4" => "Q4"]
            ]];
        $this->assertEquals($result, $date);

        $date = Zend_Locale_Data::getList('de_AT', 'quarter');
        $this->assertEquals(["1" => "1. Quartal", "2" => "2. Quartal", "3" => "3. Quartal",
                      "4" => "4. Quartal"], $date);

        $date = Zend_Locale_Data::getList('de_AT', 'quarter', ['gregorian', 'format', 'wide']);
        $this->assertEquals(["1" => "1. Quartal", "2" => "2. Quartal", "3" => "3. Quartal",
                      "4" => "4. Quartal"], $date);

        $value = Zend_Locale_Data::getContent('de_AT', 'quarter', '1');
        $this->assertEquals('1. Quartal', $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'quarter', ['gregorian', 'format', 'wide', '1']);
        $this->assertEquals('1. Quartal', $value);

        $value = Zend_Locale_Data::getContent('ar', 'quarter', ['islamic', 'format', 'wide', '1']);
        $this->assertEquals("Q1", $value);
    }

    /**
     * test for reading week from locale
     * expected array
     */
    public function testWeek()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'week');
        $this->assertEquals(['minDays' => 4, 'firstDay' => 'mon', 'weekendStart' => 'sat',
                                  'weekendEnd' => 'sun'], $value);

        $value = Zend_Locale_Data::getList('en_US', 'week');
        $this->assertEquals(['minDays' => '1', 'firstDay' => 'sun', 'weekendStart' => 'sat',
                                  'weekendEnd' => 'sun'], $value);
    }

    /**
     * test for reading am from locale
     * expected array
     */
    public function testAm()
    {
        $date = Zend_Locale_Data::getContent('de_AT', 'am');
        $this->assertEquals("vorm.", $date);

        $date = Zend_Locale_Data::getContent('de_AT', 'am', 'islamic');
        $this->assertEquals("AM", $date);
    }

    /**
     * test for reading pm from locale
     * expected array
     */
    public function testPm()
    {
        $date = Zend_Locale_Data::getContent('de_AT', 'pm');
        $this->assertEquals("nachm.", $date);

        $date = Zend_Locale_Data::getContent('de_AT', 'pm', 'islamic');
        $this->assertEquals("PM", $date);
    }

    /**
     * test for reading era from locale
     * expected array
     */
    public function testEra()
    {
        $date = Zend_Locale_Data::getList('de_AT', 'eras');
        $result = [
            'names'       =>
                [
                    0 => 'v. Chr.',
                    1 => 'n. Chr.',
                ],
            'abbreviated' =>
                [
                    0 => 'v. Chr.',
                    1 => 'n. Chr.',
                ],
            'narrow'      =>
                [
                    0 => 'v. Chr.',
                    1 => 'n. Chr.',
                ],
        ];
        $this->assertEquals($result, $date, var_export($date, 1));

        $date = Zend_Locale_Data::getList('de_AT', 'eras', 'islamic');
        $result = ["abbreviated" => ["0" => "AH"], "narrow" => ["0" => "AH"], "names" => ["0" => "AH"]];
        $this->assertEquals($result, $date);

        $date = Zend_Locale_Data::getList('de_AT', 'era');
        $this->assertEquals(["0" => "v. Chr.", "1" => "n. Chr."], $date);

        $date = Zend_Locale_Data::getList('de_AT', 'era', ['gregorian', 'Abbr']);
        $this->assertEquals(["0" => "v. Chr.", "1" => "n. Chr."], $date);

        $value = Zend_Locale_Data::getContent('de_AT', 'era', '1');
        $this->assertEquals('n. Chr.', $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'era', ['gregorian', 'Names', '1']);
        $this->assertEquals('n. Chr.', $value);

        $value = Zend_Locale_Data::getContent('ar', 'era', ['islamic', 'Abbr', '0']);
        $this->assertEquals('هـ', $value);
    }

    /**
     * test for reading defaultdate from locale
     * expected array
     */
    public function testDefaultDate()
    {
        $value = Zend_Locale_Data::getContent('de_AT', 'defaultdate');
        $this->assertEquals("medium", $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'defaultdate', 'gregorian');
        $this->assertEquals("medium", $value);
    }

    /**
     * test for reading era from locale
     * expected array
     */
    public function testDate()
    {
        $date = Zend_Locale_Data::getList('de_AT', 'date');
        $result = ["full" => "EEEE, dd. MMMM y", "long" => "dd. MMMM y",
                        "medium" => "dd.MM.y", "short" => "dd.MM.yy"];
        $this->assertEquals($result, $date);

        $date = Zend_Locale_Data::getList('de_AT', 'date', 'islamic');
        $result = ["full" => "G y MMMM d, EEEE", "long" => "G y MMMM d",
                        "medium" => "G y MMM d", "short" => "GGGGG y-MM-dd"];
        $this->assertEquals($result, $date);

        $value = Zend_Locale_Data::getContent('de_AT', 'date');
        $this->assertEquals("dd.MM.y", $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'date', 'long');
        $this->assertEquals("dd. MMMM y", $value);

        $value = Zend_Locale_Data::getContent('ar', 'date', ['islamic', 'long']);
        $this->assertEquals("d MMMM، y G", $value);
    }

    /**
     * test for reading defaulttime from locale
     * expected array
     */
    public function testDefaultTime()
    {
        $value = Zend_Locale_Data::getContent('de_AT', 'defaulttime');
        $this->assertEquals("medium", $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'defaulttime', 'gregorian');
        $this->assertEquals("medium", $value);
    }

    /**
     * test for reading time from locale
     * expected array
     */
    public function testTime()
    {
        $date = Zend_Locale_Data::getList('de_AT', 'time');
        $result = ["full" => "HH:mm:ss zzzz", "long" => "HH:mm:ss z",
                        "medium" => "HH:mm:ss", "short" => "HH:mm"];
        $this->assertEquals($result, $date);

        $date = Zend_Locale_Data::getList('de_AT', 'time', 'islamic');
        $result = ["full" => "HH:mm:ss zzzz", "long" => "HH:mm:ss z",
                        "medium" => "HH:mm:ss", "short" => "HH:mm"];
        $this->assertEquals($result, $date);

        $value = Zend_Locale_Data::getContent('de_AT', 'time');
        $this->assertEquals("HH:mm:ss", $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'time', 'long');
        $this->assertEquals("HH:mm:ss z", $value);

        $value = Zend_Locale_Data::getContent('ar', 'time', ['islamic', 'long']);
        $this->assertEquals("HH:mm:ss z", $value);
    }

    /**
     * test for reading datetime from locale
     * expected array
     */
    public function testDateTime()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'datetime');
        $result = [
            'full' => 'EEEE, dd. MMMM y HH:mm:ss zzzz',
            'long' => 'dd. MMMM y HH:mm:ss z',
            'medium' => 'dd.MM.y HH:mm:ss',
            'short' => 'dd.MM.yy HH:mm'
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getList('de_AT', 'datetime', 'gregorian');
        $result = [
            'full' => 'EEEE, dd. MMMM y HH:mm:ss zzzz',
            'long' => 'dd. MMMM y HH:mm:ss z',
            'medium' => 'dd.MM.y HH:mm:ss',
            'short' => 'dd.MM.yy HH:mm'
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'datetime', 'full');
        $this->assertEquals("EEEE, dd. MMMM y HH:mm:ss zzzz", $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'datetime', ['gregorian', 'long']);
        $this->assertEquals("dd. MMMM y HH:mm:ss z", $value);
    }

    /**
     * test for reading field from locale
     * expected array
     */
    public function testField()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'field');
        $this->assertEquals(
            [
                'era'       => 'Epoche',
                'year'      => 'Jahr',
                'month'     => 'Monat',
                'week'      => 'Woche',
                'day'       => 'Tag',
                'weekday'   => 'Wochentag',
                'dayperiod' => 'Tageshälfte',
                'hour'      => 'Stunde',
                'minute'    => 'Minute',
                'second'    => 'Sekunde',
                'zone'      => 'Zeitzone',
            ],
            $value,
            var_export($value, 1)
        );

        $value = Zend_Locale_Data::getList('de_AT', 'field', 'gregorian');
        $this->assertEquals(
            [
                'era'       => 'Epoche',
                'year'      => 'Jahr',
                'month'     => 'Monat',
                'week'      => 'Woche',
                'day'       => 'Tag',
                'weekday'   => 'Wochentag',
                'dayperiod' => 'Tageshälfte',
                'hour'      => 'Stunde',
                'minute'    => 'Minute',
                'second'    => 'Sekunde',
                'zone'      => 'Zeitzone',
            ],
            $value,
            var_export($value, 1)
        );

        $value = Zend_Locale_Data::getContent('de_AT', 'field', 'week');
        $this->assertEquals("Woche", $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'field', ['gregorian', 'week']);
        $this->assertEquals("Woche", $value);
    }

    /**
     * test for reading relative from locale
     * expected array
     */
    public function testRelative()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'relative');
        $this->assertEquals(["0" => "Heute", "1" => "Morgen", "2" => "Übermorgen",
            "-1" => "Gestern", "-2" => "Vorgestern"], $value);

        $value = Zend_Locale_Data::getList('de_AT', 'relative', 'day');
        $this->assertEquals(["0" => "Heute", "1" => "Morgen", "2" => "Übermorgen",
            "-1" => "Gestern", "-2" => "Vorgestern"], $value);

        $value = Zend_Locale_Data::getList('de_AT', 'relative', 'week');
        $this->assertEquals(["0" => "Diese Woche", "1" => "Nächste Woche",
            "-1" => "Letzte Woche"], $value);

        $value = Zend_Locale_Data::getList('de_AT', 'relative', 'month');
        $this->assertEquals(["0" => "Dieser Monat", "1" => "Nächster Monat",
            "-1" => "Letzter Monat"], $value);

        $value = Zend_Locale_Data::getList('de_AT', 'relative', 'year');
        $this->assertEquals(["0" => "Dieses Jahr", "1" => "Nächstes Jahr",
            "-1" => "Letztes Jahr"], $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'relative', '-1');
        $this->assertEquals("Gestern", $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'relative', ['gregorian', '-1']);
        $this->assertEquals("Gestern", $value);
    }

    /**
     * test for reading symbols from locale
     * expected array
     */
    public function testSymbols()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'symbols');
        $result = [    "decimal"  => ",", "group" => ".", "list"  => ";", "percent"  => "%",
            // "zero"  => "0", "pattern"  => "#",
            "plus"  => "+", "minus" => "-", "exponent" => "E",
            "mille" => "‰", "infinity" => "∞", "nan"   => "NaN"];
        $this->assertEquals($result, $value);
    }

    /**
     * test for reading decimalnumber from locale
     * expected array
     */
    public function testDecimalNumber()
    {
        $value = Zend_Locale_Data::getContent('de_AT', 'decimalnumber');
        $this->assertEquals("#,##0.###", $value);
    }

    /**
     * test for reading defaultNumberingSystem from locale data
     * @group ZF-10728
     */
    public function testDefaultNumberingSystem()
    {
        $value = Zend_Locale_Data::getContent('de_AT', 'defaultnumberingsystem');
        $this->assertEquals('latn', $value);
    }

    /**
     * test for reading scientificnumber from locale
     * expected array
     */
    public function testScientificNumber()
    {
        $value = Zend_Locale_Data::getContent('de_AT', 'scientificnumber');
        $this->assertEquals("#E0", $value);
    }

    /**
     * test for reading percentnumber from locale
     * expected array
     */
    public function testPercentNumber()
    {
        $value = Zend_Locale_Data::getContent('de_AT', 'percentnumber');
        $this->assertEquals("#,##0 %", $value);
    }

    /**
     * test for reading currencynumber from locale
     * expected array
     */
    public function testCurrencyNumber()
    {
        $value = Zend_Locale_Data::getContent('de_AT', 'currencynumber');
        $this->assertEquals("¤ #,##0.00", $value);
    }

    /**
     * test for reading nametocurrency from locale
     * expected array
     */
    public function testNameToCurrency()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'nametocurrency');
        $result = [
            'ADP' => 'Andorranische Pesete',
            'AED' => 'VAE-Dirham',
            'AFA' => 'Afghanische Afghani (1927–2002)',
            'AFN' => 'Afghanischer Afghani',
            'ALL' => 'Albanischer Lek',
            'AMD' => 'Armenischer Dram',
            'ANG' => 'Niederländische-Antillen-Gulden',
            'AOA' => 'Angolanischer Kwanza',
            'AOK' => 'Angolanischer Kwanza (1977–1990)',
            'AON' => 'Angolanischer Neuer Kwanza (1990–2000)',
            'AOR' => 'Angolanischer Kwanza Reajustado (1995–1999)',
            'ARA' => 'Argentinischer Austral',
            'ARP' => 'Argentinischer Peso (1983–1985)',
            'ARS' => 'Argentinischer Peso',
            'ATS' => 'Österreichischer Schilling',
            'AUD' => 'Australischer Dollar',
            'AWG' => 'Aruba-Florin',
            'AZM' => 'Aserbaidschan-Manat (1993–2006)',
            'AZN' => 'Aserbaidschan-Manat',
            'BAD' => 'Bosnien und Herzegowina Dinar (1992–1994)',
            'BAM' => 'Bosnien und Herzegowina Konvertierbare Mark',
            'BBD' => 'Barbados-Dollar',
            'BDT' => 'Bangladesch-Taka',
            'BEC' => 'Belgischer Franc (konvertibel)',
            'BEF' => 'Belgischer Franc',
            'BEL' => 'Belgischer Finanz-Franc',
            'BGL' => 'Bulgarische Lew (1962–1999)',
            'BGN' => 'Bulgarischer Lew',
            'BHD' => 'Bahrain-Dinar',
            'BIF' => 'Burundi-Franc',
            'BMD' => 'Bermuda-Dollar',
            'BND' => 'Brunei-Dollar',
            'BOB' => 'Bolivanischer Boliviano',
            'BOP' => 'Bolivianischer Peso',
            'BOV' => 'Boliviansiche Mvdol',
            'BRB' => 'Brasilianischer Cruzeiro Novo (1967–1986)',
            'BRC' => 'Brasilianischer Cruzado (1986–1989)',
            'BRE' => 'Brasilianischer Cruzeiro (1990–1993)',
            'BRL' => 'Brasilianischer Real',
            'BRN' => 'Brasilianischer Cruzado Novo (1989–1990)',
            'BRR' => 'Brasilianischer Cruzeiro (1993–1994)',
            'BRZ' => 'Brasilianischer Cruzeiro (1942–1967)',
            'BSD' => 'Bahama-Dollar',
            'BTN' => 'Bhutan-Ngultrum',
            'BUK' => 'Birmanischer Kyat',
            'BWP' => 'Botswanischer Pula',
            'BYB' => 'Belarus-Rubel (1994–1999)',
            'BYR' => 'Belarus-Rubel',
            'BZD' => 'Belize-Dollar',
            'CAD' => 'Kanadischer Dollar',
            'CDF' => 'Kongo-Franc',
            'CHE' => 'WIR-Euro',
            'CHF' => 'Schweizer Franken',
            'CHW' => 'WIR Franken',
            'CLF' => 'Chilenische Unidades de Fomento',
            'CLP' => 'Chilenischer Peso',
            'CNY' => 'Renminbi Yuan',
            'COP' => 'Kolumbianischer Peso',
            'CRC' => 'Costa-Rica-Colón',
            'CSD' => 'Serbischer Dinar (2002–2006)',
            'CSK' => 'Tschechoslowakische Krone',
            'CUC' => 'Kubanischer Peso (konvertibel)',
            'CUP' => 'Kubanischer Peso',
            'CVE' => 'Kap-Verde-Escudo',
            'CYP' => 'Zypern-Pfund',
            'CZK' => 'Tschechische Krone',
            'DDM' => 'Mark der DDR',
            'DEM' => 'Deutsche Mark',
            'DJF' => 'Dschibuti-Franc',
            'DKK' => 'Dänische Krone',
            'DOP' => 'Dominikanischer Peso',
            'DZD' => 'Algerischer Dinar',
            'ECS' => 'Ecuadorianischer Sucre',
            'ECV' => 'Verrechnungseinheit für Ecuador',
            'EEK' => 'Estnische Krone',
            'EGP' => 'Ägyptisches Pfund',
            'ERN' => 'Eritreischer Nakfa',
            'ESA' => 'Spanische Peseta (A–Konten)',
            'ESB' => 'Spanische Peseta (konvertibel)',
            'ESP' => 'Spanische Peseta',
            'ETB' => 'Äthiopischer Birr',
            'EUR' => 'Euro',
            'FIM' => 'Finnische Mark',
            'FJD' => 'Fidschi-Dollar',
            'FKP' => 'Falkland-Pfund',
            'FRF' => 'Französischer Franc',
            'GBP' => 'Britisches Pfund Sterling',
            'GEK' => 'Georgischer Kupon Larit',
            'GEL' => 'Georgischer Lari',
            'GHC' => 'Ghanaischer Cedi (1979–2007)',
            'GHS' => 'Ghanaischer Cedi',
            'GIP' => 'Gibraltar-Pfund',
            'GMD' => 'Gambia-Dalasi',
            'GNF' => 'Guinea-Franc',
            'GNS' => 'Guineischer Syli',
            'GQE' => 'Äquatorialguinea-Ekwele',
            'GRD' => 'Griechische Drachme',
            'GTQ' => 'Guatemaltekischer Quetzal',
            'GWE' => 'Portugiesisch Guinea Escudo',
            'GWP' => 'Guinea-Bissau Peso',
            'GYD' => 'Guyana-Dollar',
            'HKD' => 'Hongkong-Dollar',
            'HNL' => 'Honduras-Lempira',
            'HRD' => 'Kroatischer Dinar',
            'HRK' => 'Kroatischer Kuna',
            'HTG' => 'Haitianische Gourde',
            'HUF' => 'Ungarischer Forint',
            'IDR' => 'Indonesische Rupiah',
            'IEP' => 'Irisches Pfund',
            'ILP' => 'Israelisches Pfund',
            'ILS' => 'Israelischer Neuer Schekel',
            'INR' => 'Indische Rupie',
            'IQD' => 'Irakischer Dinar',
            'IRR' => 'Iranischer Rial',
            'ISK' => 'Isländische Krone',
            'ITL' => 'Italienische Lira',
            'JMD' => 'Jamaika-Dollar',
            'JOD' => 'Jordanischer Dinar',
            'JPY' => 'Japanischer Yen',
            'KES' => 'Kenia-Schilling',
            'KGS' => 'Kirgisischer Som',
            'KHR' => 'Kambodschanischer Riel',
            'KMF' => 'Komoren-Franc',
            'KPW' => 'Nordkoreanischer Won',
            'KRW' => 'Südkoreanischer Won',
            'KWD' => 'Kuwait-Dinar',
            'KYD' => 'Kaiman-Dollar',
            'KZT' => 'Kasachischer Tenge',
            'LAK' => 'Laotischer Kip',
            'LBP' => 'Libanesisches Pfund',
            'LKR' => 'Sri-Lanka-Rupie',
            'LRD' => 'Liberianischer Dollar',
            'LSL' => 'Loti',
            'LTL' => 'Litauischer Litas',
            'LTT' => 'Litauischer Talonas',
            'LUC' => 'Luxemburgischer Franc (konvertibel)',
            'LUF' => 'Luxemburgischer Franc',
            'LUL' => 'Luxemburgischer Finanz-Franc',
            'LVL' => 'Lettischer Lats',
            'LVR' => 'Lettischer Rubel',
            'LYD' => 'Libyscher Dinar',
            'MAD' => 'Marokkanischer Dirham',
            'MAF' => 'Marokkanischer Franc',
            'MDL' => 'Moldau-Leu',
            'MGA' => 'Madagaskar-Ariary',
            'MGF' => 'Madagaskar-Franc',
            'MKD' => 'Mazedonischer Denar',
            'MLF' => 'Malischer Franc',
            'MMK' => 'Myanmarischer Kyat',
            'MNT' => 'Mongolischer Tögrög',
            'MOP' => 'Macao-Pataca',
            'MRO' => 'Mauretanischer Ouguiya',
            'MTL' => 'Maltesische Lira',
            'MTP' => 'Maltesisches Pfund',
            'MUR' => 'Mauritius-Rupie',
            'MVR' => 'Malediven-Rupie',
            'MWK' => 'Malawi-Kwacha',
            'MXN' => 'Mexikanischer Peso',
            'MXP' => 'Mexikanischer Silber-Peso (1861–1992)',
            'MXV' => 'Mexicanischer Unidad de Inversion (UDI)',
            'MYR' => 'Malaysischer Ringgit',
            'MZE' => 'Mosambikanischer Escudo',
            'MZM' => 'Mosambikanischer Metical (1980–2006)',
            'MZN' => 'Mosambikanischer Metical',
            'NAD' => 'Namibia-Dollar',
            'NGN' => 'Nigerianischer Naira',
            'NIC' => 'Nicaraguanischer Córdoba (1988–1991)',
            'NIO' => 'Nicaragua-Cordoba',
            'NLG' => 'Niederländischer Gulden',
            'NOK' => 'Norwegische Krone',
            'NPR' => 'Nepalesische Rupie',
            'NZD' => 'Neuseeland-Dollar',
            'OMR' => 'Omanischer Rial',
            'PAB' => 'Panamaischer Balboa',
            'PEI' => 'Peruanischer Inti',
            'PEN' => 'Peruanischer Neuer Sol',
            'PES' => 'Peruanischer Sol (1863–1965)',
            'PGK' => 'Papua-Neuguineischer Kina',
            'PHP' => 'Philippinischer Peso',
            'PKR' => 'Pakistanische Rupie',
            'PLN' => 'Polnischer Złoty',
            'PLZ' => 'Polnischer Zloty (1950–1995)',
            'PTE' => 'Portugiesischer Escudo',
            'PYG' => 'Paraguayischer Guaraní',
            'QAR' => 'Katar-Riyal',
            'RHD' => 'Rhodesischer Dollar',
            'ROL' => 'Rumänischer Leu (1952–2006)',
            'RON' => 'Rumänischer Leu',
            'RSD' => 'Serbischer Dinar',
            'RUB' => 'Russischer Rubel',
            'RUR' => 'Russischer Rubel (1991–1998)',
            'RWF' => 'Ruanda-Franc',
            'SAR' => 'Saudi-Rial',
            'SBD' => 'Salomonen-Dollar',
            'SCR' => 'Seychellen-Rupie',
            'SDD' => 'Sudanesischer Dinar (1992–2007)',
            'SDG' => 'Sudanesisches Pfund',
            'SDP' => 'Sudanesisches Pfund (1957–1998)',
            'SEK' => 'Schwedische Krone',
            'SGD' => 'Singapur-Dollar',
            'SHP' => 'St. Helena-Pfund',
            'SIT' => 'Slowenischer Tolar',
            'SKK' => 'Slowakische Krone',
            'SLL' => 'Sierra-leonischer Leone',
            'SOS' => 'Somalia-Schilling',
            'SRD' => 'Suriname-Dollar',
            'SRG' => 'Suriname Gulden',
            'SSP' => 'Südsudanesisches Pfund',
            'STD' => 'São-toméischer Dobra',
            'SUR' => 'Sowjetischer Rubel',
            'SVC' => 'El Salvador Colon',
            'SYP' => 'Syrisches Pfund',
            'SZL' => 'Swasiländischer Lilangeni',
            'THB' => 'Thailändischer Baht',
            'TJR' => 'Tadschikistan Rubel',
            'TJS' => 'Tadschikistan-Somoni',
            'TMM' => 'Turkmenistan-Manat (1993–2009)',
            'TMT' => 'Turkmenistan-Manat',
            'TND' => 'Tunesischer Dinar',
            'TOP' => 'Tongaischer Paʻanga',
            'TPE' => 'Timor-Escudo',
            'TRL' => 'Türkische Lira (1922–2005)',
            'TRY' => 'Türkische Lira',
            'TTD' => 'Trinidad und Tobago-Dollar',
            'TWD' => 'Neuer Taiwan-Dollar',
            'TZS' => 'Tansania-Schilling',
            'UAH' => 'Ukrainische Hrywnja',
            'UAK' => 'Ukrainischer Karbovanetz',
            'UGS' => 'Uganda-Schilling (1966–1987)',
            'UGX' => 'Uganda-Schilling',
            'USD' => 'US-Dollar',
            'USN' => 'US Dollar (Nächster Tag)',
            'USS' => 'US Dollar (Gleicher Tag)',
            'UYP' => 'Uruguayischer Peso (1975–1993)',
            'UYU' => 'Uruguayischer Peso',
            'UZS' => 'Usbekistan-Sum',
            'VEB' => 'Venezolanischer Bolívar (1871–2008)',
            'VEF' => 'Venezolanischer Bolívar',
            'VND' => 'Vietnamesischer Dong',
            'VUV' => 'Vanuatu-Vatu',
            'WST' => 'Samoanischer Tala',
            'XAF' => 'CFA-Franc (BEAC)',
            'XAG' => 'Unze Silber',
            'XAU' => 'Unze Gold',
            'XBA' => 'Europäische Rechnungseinheit',
            'XBB' => 'Europäische Währungseinheit (XBB)',
            'XBC' => 'Europäische Rechnungseinheit (XBC)',
            'XBD' => 'Europäische Rechnungseinheit (XBD)',
            'XCD' => 'Ostkaribischer Dollar',
            'XDR' => 'Sonderziehungsrechte',
            'XEU' => 'Europäische Währungseinheit (XEU)',
            'XFO' => 'Französischer Gold-Franc',
            'XFU' => 'Französischer UIC-Franc',
            'XOF' => 'CFA-Franc (BCEAO)',
            'XPD' => 'Unze Palladium',
            'XPF' => 'CFP-Franc',
            'XPT' => 'Unze Platin',
            'XRE' => 'RINET Funds',
            'XTS' => 'Testwährung',
            'XXX' => 'Unbekannte Währung',
            'YDD' => 'Jemen-Dinar',
            'YER' => 'Jemen-Rial',
            'YUD' => 'Jugoslawischer Dinar (1966–1990)',
            'YUM' => 'Jugoslawischer Neuer Dinar (1994–2002)',
            'YUN' => 'Jugoslawischer Dinar (konvertibel)',
            'ZAL' => 'Südafrikanischer Rand (Finanz)',
            'ZAR' => 'Südafrikanischer Rand',
            'ZMK' => 'Kwacha (1968–2012)',
            'ZMW' => 'Kwacha',
            'ZRN' => 'Zaire-Neuer Zaïre (1993–1998)',
            'ZRZ' => 'Zaire-Zaïre (1971–1993)',
            'ZWD' => 'Simbabwe-Dollar (1980–2008)',
            'ZWL' => 'Simbabwe-Dollar (2009)',
            'ZWR' => 'Simbabwe-Dollar (2008)',
        ];
        $this->assertEquals($result, $value, var_export($value, 1));

        $value = Zend_Locale_Data::getContent('de_AT', 'nametocurrency', 'USD');
        $this->assertEquals("US-Dollar", $value);
    }

    /**
     * test for reading currencytoname from locale
     * expected array
     */
    public function testCurrencyToName()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'currencytoname');
        $result = [
            'Andorranische Pesete'                        => 'ADP',
            'VAE-Dirham'                                  => 'AED',
            'Afghanische Afghani (1927–2002)'             => 'AFA',
            'Afghanischer Afghani'                        => 'AFN',
            'Albanischer Lek'                             => 'ALL',
            'Armenischer Dram'                            => 'AMD',
            'Niederländische-Antillen-Gulden'             => 'ANG',
            'Angolanischer Kwanza'                        => 'AOA',
            'Angolanischer Kwanza (1977–1990)'            => 'AOK',
            'Angolanischer Neuer Kwanza (1990–2000)'      => 'AON',
            'Angolanischer Kwanza Reajustado (1995–1999)' => 'AOR',
            'Argentinischer Austral'                      => 'ARA',
            'Argentinischer Peso (1983–1985)'             => 'ARP',
            'Argentinischer Peso'                         => 'ARS',
            'Österreichischer Schilling'                  => 'ATS',
            'Australischer Dollar'                        => 'AUD',
            'Aruba-Florin'                                => 'AWG',
            'Aserbaidschan-Manat (1993–2006)'             => 'AZM',
            'Aserbaidschan-Manat'                         => 'AZN',
            'Bosnien und Herzegowina Dinar (1992–1994)'   => 'BAD',
            'Bosnien und Herzegowina Konvertierbare Mark' => 'BAM',
            'Barbados-Dollar'                             => 'BBD',
            'Bangladesch-Taka'                            => 'BDT',
            'Belgischer Franc (konvertibel)'              => 'BEC',
            'Belgischer Franc'                            => 'BEF',
            'Belgischer Finanz-Franc'                     => 'BEL',
            'Bulgarische Lew (1962–1999)'                 => 'BGL',
            'Bulgarischer Lew'                            => 'BGN',
            'Bahrain-Dinar'                               => 'BHD',
            'Burundi-Franc'                               => 'BIF',
            'Bermuda-Dollar'                              => 'BMD',
            'Brunei-Dollar'                               => 'BND',
            'Bolivanischer Boliviano'                     => 'BOB',
            'Bolivianischer Peso'                         => 'BOP',
            'Boliviansiche Mvdol'                         => 'BOV',
            'Brasilianischer Cruzeiro Novo (1967–1986)'   => 'BRB',
            'Brasilianischer Cruzado (1986–1989)'         => 'BRC',
            'Brasilianischer Cruzeiro (1990–1993)'        => 'BRE',
            'Brasilianischer Real'                        => 'BRL',
            'Brasilianischer Cruzado Novo (1989–1990)'    => 'BRN',
            'Brasilianischer Cruzeiro (1993–1994)'        => 'BRR',
            'Brasilianischer Cruzeiro (1942–1967)'        => 'BRZ',
            'Bahama-Dollar'                               => 'BSD',
            'Bhutan-Ngultrum'                             => 'BTN',
            'Birmanischer Kyat'                           => 'BUK',
            'Botswanischer Pula'                          => 'BWP',
            'Belarus-Rubel (1994–1999)'                   => 'BYB',
            'Belarus-Rubel'                               => 'BYR',
            'Belize-Dollar'                               => 'BZD',
            'Kanadischer Dollar'                          => 'CAD',
            'Kongo-Franc'                                 => 'CDF',
            'WIR-Euro'                                    => 'CHE',
            'Schweizer Franken'                           => 'CHF',
            'WIR Franken'                                 => 'CHW',
            'Chilenische Unidades de Fomento'             => 'CLF',
            'Chilenischer Peso'                           => 'CLP',
            'Renminbi Yuan'                               => 'CNY',
            'Kolumbianischer Peso'                        => 'COP',
            'Costa-Rica-Colón'                            => 'CRC',
            'Serbischer Dinar (2002–2006)'                => 'CSD',
            'Tschechoslowakische Krone'                   => 'CSK',
            'Kubanischer Peso (konvertibel)'              => 'CUC',
            'Kubanischer Peso'                            => 'CUP',
            'Kap-Verde-Escudo'                            => 'CVE',
            'Zypern-Pfund'                                => 'CYP',
            'Tschechische Krone'                          => 'CZK',
            'Mark der DDR'                                => 'DDM',
            'Deutsche Mark'                               => 'DEM',
            'Dschibuti-Franc'                             => 'DJF',
            'Dänische Krone'                              => 'DKK',
            'Dominikanischer Peso'                        => 'DOP',
            'Algerischer Dinar'                           => 'DZD',
            'Ecuadorianischer Sucre'                      => 'ECS',
            'Verrechnungseinheit für Ecuador'             => 'ECV',
            'Estnische Krone'                             => 'EEK',
            'Ägyptisches Pfund'                           => 'EGP',
            'Eritreischer Nakfa'                          => 'ERN',
            'Spanische Peseta (A–Konten)'                 => 'ESA',
            'Spanische Peseta (konvertibel)'              => 'ESB',
            'Spanische Peseta'                            => 'ESP',
            'Äthiopischer Birr'                           => 'ETB',
            'Euro'                                        => 'EUR',
            'Finnische Mark'                              => 'FIM',
            'Fidschi-Dollar'                              => 'FJD',
            'Falkland-Pfund'                              => 'FKP',
            'Französischer Franc'                         => 'FRF',
            'Britisches Pfund Sterling'                   => 'GBP',
            'Georgischer Kupon Larit'                     => 'GEK',
            'Georgischer Lari'                            => 'GEL',
            'Ghanaischer Cedi (1979–2007)'                => 'GHC',
            'Ghanaischer Cedi'                            => 'GHS',
            'Gibraltar-Pfund'                             => 'GIP',
            'Gambia-Dalasi'                               => 'GMD',
            'Guinea-Franc'                                => 'GNF',
            'Guineischer Syli'                            => 'GNS',
            'Äquatorialguinea-Ekwele'                     => 'GQE',
            'Griechische Drachme'                         => 'GRD',
            'Guatemaltekischer Quetzal'                   => 'GTQ',
            'Portugiesisch Guinea Escudo'                 => 'GWE',
            'Guinea-Bissau Peso'                          => 'GWP',
            'Guyana-Dollar'                               => 'GYD',
            'Hongkong-Dollar'                             => 'HKD',
            'Honduras-Lempira'                            => 'HNL',
            'Kroatischer Dinar'                           => 'HRD',
            'Kroatischer Kuna'                            => 'HRK',
            'Haitianische Gourde'                         => 'HTG',
            'Ungarischer Forint'                          => 'HUF',
            'Indonesische Rupiah'                         => 'IDR',
            'Irisches Pfund'                              => 'IEP',
            'Israelisches Pfund'                          => 'ILP',
            'Israelischer Neuer Schekel'                  => 'ILS',
            'Indische Rupie'                              => 'INR',
            'Irakischer Dinar'                            => 'IQD',
            'Iranischer Rial'                             => 'IRR',
            'Isländische Krone'                           => 'ISK',
            'Italienische Lira'                           => 'ITL',
            'Jamaika-Dollar'                              => 'JMD',
            'Jordanischer Dinar'                          => 'JOD',
            'Japanischer Yen'                             => 'JPY',
            'Kenia-Schilling'                             => 'KES',
            'Kirgisischer Som'                            => 'KGS',
            'Kambodschanischer Riel'                      => 'KHR',
            'Komoren-Franc'                               => 'KMF',
            'Nordkoreanischer Won'                        => 'KPW',
            'Südkoreanischer Won'                         => 'KRW',
            'Kuwait-Dinar'                                => 'KWD',
            'Kaiman-Dollar'                               => 'KYD',
            'Kasachischer Tenge'                          => 'KZT',
            'Laotischer Kip'                              => 'LAK',
            'Libanesisches Pfund'                         => 'LBP',
            'Sri-Lanka-Rupie'                             => 'LKR',
            'Liberianischer Dollar'                       => 'LRD',
            'Loti'                                        => 'LSL',
            'Litauischer Litas'                           => 'LTL',
            'Litauischer Talonas'                         => 'LTT',
            'Luxemburgischer Franc (konvertibel)'         => 'LUC',
            'Luxemburgischer Franc'                       => 'LUF',
            'Luxemburgischer Finanz-Franc'                => 'LUL',
            'Lettischer Lats'                             => 'LVL',
            'Lettischer Rubel'                            => 'LVR',
            'Libyscher Dinar'                             => 'LYD',
            'Marokkanischer Dirham'                       => 'MAD',
            'Marokkanischer Franc'                        => 'MAF',
            'Moldau-Leu'                                  => 'MDL',
            'Madagaskar-Ariary'                           => 'MGA',
            'Madagaskar-Franc'                            => 'MGF',
            'Mazedonischer Denar'                         => 'MKD',
            'Malischer Franc'                             => 'MLF',
            'Myanmarischer Kyat'                          => 'MMK',
            'Mongolischer Tögrög'                         => 'MNT',
            'Macao-Pataca'                                => 'MOP',
            'Mauretanischer Ouguiya'                      => 'MRO',
            'Maltesische Lira'                            => 'MTL',
            'Maltesisches Pfund'                          => 'MTP',
            'Mauritius-Rupie'                             => 'MUR',
            'Malediven-Rupie'                             => 'MVR',
            'Malawi-Kwacha'                               => 'MWK',
            'Mexikanischer Peso'                          => 'MXN',
            'Mexikanischer Silber-Peso (1861–1992)'       => 'MXP',
            'Mexicanischer Unidad de Inversion (UDI)'     => 'MXV',
            'Malaysischer Ringgit'                        => 'MYR',
            'Mosambikanischer Escudo'                     => 'MZE',
            'Mosambikanischer Metical (1980–2006)'        => 'MZM',
            'Mosambikanischer Metical'                    => 'MZN',
            'Namibia-Dollar'                              => 'NAD',
            'Nigerianischer Naira'                        => 'NGN',
            'Nicaraguanischer Córdoba (1988–1991)'        => 'NIC',
            'Nicaragua-Cordoba'                           => 'NIO',
            'Niederländischer Gulden'                     => 'NLG',
            'Norwegische Krone'                           => 'NOK',
            'Nepalesische Rupie'                          => 'NPR',
            'Neuseeland-Dollar'                           => 'NZD',
            'Omanischer Rial'                             => 'OMR',
            'Panamaischer Balboa'                         => 'PAB',
            'Peruanischer Inti'                           => 'PEI',
            'Peruanischer Neuer Sol'                      => 'PEN',
            'Peruanischer Sol (1863–1965)'                => 'PES',
            'Papua-Neuguineischer Kina'                   => 'PGK',
            'Philippinischer Peso'                        => 'PHP',
            'Pakistanische Rupie'                         => 'PKR',
            'Polnischer Złoty'                            => 'PLN',
            'Polnischer Zloty (1950–1995)'                => 'PLZ',
            'Portugiesischer Escudo'                      => 'PTE',
            'Paraguayischer Guaraní'                      => 'PYG',
            'Katar-Riyal'                                 => 'QAR',
            'Rhodesischer Dollar'                         => 'RHD',
            'Rumänischer Leu (1952–2006)'                 => 'ROL',
            'Rumänischer Leu'                             => 'RON',
            'Serbischer Dinar'                            => 'RSD',
            'Russischer Rubel'                            => 'RUB',
            'Russischer Rubel (1991–1998)'                => 'RUR',
            'Ruanda-Franc'                                => 'RWF',
            'Saudi-Rial'                                  => 'SAR',
            'Salomonen-Dollar'                            => 'SBD',
            'Seychellen-Rupie'                            => 'SCR',
            'Sudanesischer Dinar (1992–2007)'             => 'SDD',
            'Sudanesisches Pfund'                         => 'SDG',
            'Sudanesisches Pfund (1957–1998)'             => 'SDP',
            'Schwedische Krone'                           => 'SEK',
            'Singapur-Dollar'                             => 'SGD',
            'St. Helena-Pfund'                            => 'SHP',
            'Slowenischer Tolar'                          => 'SIT',
            'Slowakische Krone'                           => 'SKK',
            'Sierra-leonischer Leone'                     => 'SLL',
            'Somalia-Schilling'                           => 'SOS',
            'Suriname-Dollar'                             => 'SRD',
            'Suriname Gulden'                             => 'SRG',
            'Südsudanesisches Pfund'                      => 'SSP',
            'São-toméischer Dobra'                        => 'STD',
            'Sowjetischer Rubel'                          => 'SUR',
            'El Salvador Colon'                           => 'SVC',
            'Syrisches Pfund'                             => 'SYP',
            'Swasiländischer Lilangeni'                   => 'SZL',
            'Thailändischer Baht'                         => 'THB',
            'Tadschikistan Rubel'                         => 'TJR',
            'Tadschikistan-Somoni'                        => 'TJS',
            'Turkmenistan-Manat (1993–2009)'              => 'TMM',
            'Turkmenistan-Manat'                          => 'TMT',
            'Tunesischer Dinar'                           => 'TND',
            'Tongaischer Paʻanga'                         => 'TOP',
            'Timor-Escudo'                                => 'TPE',
            'Türkische Lira (1922–2005)'                  => 'TRL',
            'Türkische Lira'                              => 'TRY',
            'Trinidad und Tobago-Dollar'                  => 'TTD',
            'Neuer Taiwan-Dollar'                         => 'TWD',
            'Tansania-Schilling'                          => 'TZS',
            'Ukrainische Hrywnja'                         => 'UAH',
            'Ukrainischer Karbovanetz'                    => 'UAK',
            'Uganda-Schilling (1966–1987)'                => 'UGS',
            'Uganda-Schilling'                            => 'UGX',
            'US-Dollar'                                   => 'USD',
            'US Dollar (Nächster Tag)'                    => 'USN',
            'US Dollar (Gleicher Tag)'                    => 'USS',
            'Uruguayischer Peso (1975–1993)'              => 'UYP',
            'Uruguayischer Peso'                          => 'UYU',
            'Usbekistan-Sum'                              => 'UZS',
            'Venezolanischer Bolívar (1871–2008)'         => 'VEB',
            'Venezolanischer Bolívar'                     => 'VEF',
            'Vietnamesischer Dong'                        => 'VND',
            'Vanuatu-Vatu'                                => 'VUV',
            'Samoanischer Tala'                           => 'WST',
            'CFA-Franc (BEAC)'                            => 'XAF',
            'Unze Silber'                                 => 'XAG',
            'Unze Gold'                                   => 'XAU',
            'Europäische Rechnungseinheit'                => 'XBA',
            'Europäische Währungseinheit (XBB)'           => 'XBB',
            'Europäische Rechnungseinheit (XBC)'          => 'XBC',
            'Europäische Rechnungseinheit (XBD)'          => 'XBD',
            'Ostkaribischer Dollar'                       => 'XCD',
            'Sonderziehungsrechte'                        => 'XDR',
            'Europäische Währungseinheit (XEU)'           => 'XEU',
            'Französischer Gold-Franc'                    => 'XFO',
            'Französischer UIC-Franc'                     => 'XFU',
            'CFA-Franc (BCEAO)'                           => 'XOF',
            'Unze Palladium'                              => 'XPD',
            'CFP-Franc'                                   => 'XPF',
            'Unze Platin'                                 => 'XPT',
            'RINET Funds'                                 => 'XRE',
            'Testwährung'                                 => 'XTS',
            'Unbekannte Währung'                          => 'XXX',
            'Jemen-Dinar'                                 => 'YDD',
            'Jemen-Rial'                                  => 'YER',
            'Jugoslawischer Dinar (1966–1990)'            => 'YUD',
            'Jugoslawischer Neuer Dinar (1994–2002)'      => 'YUM',
            'Jugoslawischer Dinar (konvertibel)'          => 'YUN',
            'Südafrikanischer Rand (Finanz)'              => 'ZAL',
            'Südafrikanischer Rand'                       => 'ZAR',
            'Kwacha (1968–2012)'                          => 'ZMK',
            'Kwacha'                                      => 'ZMW',
            'Zaire-Neuer Zaïre (1993–1998)'               => 'ZRN',
            'Zaire-Zaïre (1971–1993)'                     => 'ZRZ',
            'Simbabwe-Dollar (1980–2008)'                 => 'ZWD',
            'Simbabwe-Dollar (2009)'                      => 'ZWL',
            'Simbabwe-Dollar (2008)'                      => 'ZWR',
        ];
        $this->assertEquals($result, $value, var_export($value, 1));

        $value = Zend_Locale_Data::getContent('de_AT', 'currencytoname', 'Unze Platin');
        $this->assertEquals("XPT", $value);
    }

    /**
     * test for reading currencysymbol from locale
     * expected array
     */
    public function testCurrencySymbol()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'currencysymbol');
        $result = [
            'ARS' => '$',
            'ATS' => 'öS',
            'AUD' => 'AU$',
            'BBD' => '$',
            'BDT' => '৳',
            'BMD' => '$',
            'BND' => '$',
            'BRL' => 'R$',
            'BSD' => '$',
            'BYR' => 'р.',
            'BZD' => '$',
            'CAD' => 'CA$',
            'CLP' => '$',
            'CNY' => 'CN¥',
            'COP' => '$',
            'CRC' => '₡',
            'CUP' => '$',
            'DOP' => '$',
            'ESP' => '₧',
            'EUR' => '€',
            'FJD' => '$',
            'GBP' => '£',
            'GHS' => '₵',
            'GIP' => '£',
            'GYD' => '$',
            'HKD' => 'HK$',
            'ILS' => '₪',
            'INR' => '₹',
            'JMD' => '$',
            'JPY' => '¥',
            'KHR' => '៛',
            'KRW' => '₩',
            'KYD' => '$',
            'KZT' => '₸',
            'LAK' => '₭',
            'LRD' => '$',
            'MNT' => '₮',
            'MXN' => 'MX$',
            'NAD' => '$',
            'NGN' => '₦',
            'NZD' => 'NZ$',
            'PHP' => '₱',
            'PYG' => '₲',
            'RUR' => 'р.',
            'SBD' => '$',
            'SGD' => '$',
            'SRD' => '$',
            'SSP' => '£',
            'THB' => '฿',
            'TRY' => '₺',
            'TTD' => '$',
            'TWD' => 'NT$',
            'UAH' => '₴',
            'USD' => '$',
            'UYU' => '$',
            'VND' => '₫',
            'XAF' => 'FCFA',
            'XCD' => 'EC$',
            'XOF' => 'CFA',
            'XPF' => 'CFPF',
        ];
        $this->assertEquals($result, $value, var_export($value, 1));

        $value = Zend_Locale_Data::getContent('de_AT', 'currencysymbol', 'USD');
        $this->assertEquals("$", $value);
    }

    /**
     * test for reading question from locale
     * expected array
     */
    public function testQuestion()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'question');
        $this->assertEquals(["yes" => "ja:j", "no" => "nein:n"], $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'question', 'yes');
        $this->assertEquals("ja:j", $value);
    }

    /**
     * test for reading currencyfraction from locale
     * expected array
     */
    public function testCurrencyFraction()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'currencyfraction');
        $this->assertEquals(
            [
                'ADP'     => '0',
                'AFN'     => '0',
                'ALL'     => '0',
                'AMD'     => '0',
                'BHD'     => '3',
                'BIF'     => '0',
                'BYR'     => '0',
                'CAD'     => '2',
                'CHF'     => '2',
                'CLF'     => '0',
                'CLP'     => '0',
                'COP'     => '0',
                'CRC'     => '0',
                'CZK'     => '2',
                'DEFAULT' => '2',
                'DJF'     => '0',
                'ESP'     => '0',
                'GNF'     => '0',
                'GYD'     => '0',
                'HUF'     => '0',
                'IDR'     => '0',
                'IQD'     => '0',
                'IRR'     => '0',
                'ISK'     => '0',
                'ITL'     => '0',
                'JOD'     => '3',
                'JPY'     => '0',
                'KMF'     => '0',
                'KPW'     => '0',
                'KRW'     => '0',
                'KWD'     => '3',
                'LAK'     => '0',
                'LBP'     => '0',
                'LUF'     => '0',
                'LYD'     => '3',
                'MGA'     => '0',
                'MGF'     => '0',
                'MMK'     => '0',
                'MNT'     => '0',
                'MRO'     => '0',
                'MUR'     => '0',
                'OMR'     => '3',
                'PKR'     => '0',
                'PYG'     => '0',
                'RSD'     => '0',
                'RWF'     => '0',
                'SLL'     => '0',
                'SOS'     => '0',
                'STD'     => '0',
                'SYP'     => '0',
                'TMM'     => '0',
                'TND'     => '3',
                'TRL'     => '0',
                'TZS'     => '0',
                'TWD'     => '2',
                'UGX'     => '0',
                'UZS'     => '0',
                'UYI'     => '0',
                'VND'     => '0',
                'VUV'     => '0',
                'XAF'     => '0',
                'XOF'     => '0',
                'XPF'     => '0',
                'YER'     => '0',
                'ZMK'     => '0',
                'ZWD'     => '0',
            ], $value
        );

        $value = Zend_Locale_Data::getContent('de_AT', 'currencyfraction');
        $this->assertEquals("2", $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'currencyfraction', 'BHD');
        $this->assertEquals("3", $value);
    }

    /**
     * test for reading currencyrounding from locale
     * expected array
     */
    public function testCurrencyRounding()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'currencyrounding');
        $this->assertEquals(
            [
                'ADP'     => '0',
                'AFN'     => '0',
                'ALL'     => '0',
                'AMD'     => '0',
                'BHD'     => '0',
                'BIF'     => '0',
                'BYR'     => '0',
                'CAD'     => '0',
                'CHF'     => '0',
                'CLF'     => '0',
                'CLP'     => '0',
                'COP'     => '0',
                'CRC'     => '0',
                'CZK'     => '0',
                'DEFAULT' => '0',
                'DJF'     => '0',
                'ESP'     => '0',
                'GNF'     => '0',
                'GYD'     => '0',
                'HUF'     => '0',
                'IDR'     => '0',
                'IQD'     => '0',
                'IRR'     => '0',
                'ISK'     => '0',
                'ITL'     => '0',
                'JOD'     => '0',
                'JPY'     => '0',
                'KMF'     => '0',
                'KPW'     => '0',
                'KRW'     => '0',
                'KWD'     => '0',
                'LAK'     => '0',
                'LBP'     => '0',
                'LUF'     => '0',
                'LYD'     => '0',
                'MGA'     => '0',
                'MGF'     => '0',
                'MMK'     => '0',
                'MNT'     => '0',
                'MRO'     => '0',
                'MUR'     => '0',
                'OMR'     => '0',
                'PKR'     => '0',
                'PYG'     => '0',
                'RSD'     => '0',
                'RWF'     => '0',
                'SLL'     => '0',
                'SOS'     => '0',
                'STD'     => '0',
                'SYP'     => '0',
                'TMM'     => '0',
                'TND'     => '0',
                'TRL'     => '0',
                'TZS'     => '0',
                'TWD'     => '0',
                'UGX'     => '0',
                'UZS'     => '0',
                'UYI'     => '0',
                'VND'     => '0',
                'VUV'     => '0',
                'XAF'     => '0',
                'XOF'     => '0',
                'XPF'     => '0',
                'YER'     => '0',
                'ZMK'     => '0',
                'ZWD'     => '0',
            ], $value
        );

        $value = Zend_Locale_Data::getContent('de_AT', 'currencyrounding');
        $this->assertEquals("0", $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'currencyrounding', 'BHD');
        $this->assertEquals("0", $value);
    }

    /**
     * test for reading currencytoregion from locale
     * expected array
     */
    public function testCurrencyToRegion()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'currencytoregion');
        $result = [
            150  => 'EUR',
            'AC' => 'SHP',
            'AD' => 'EUR',
            'AE' => 'AED',
            'AF' => 'AFN',
            'AG' => 'XCD',
            'AI' => 'XCD',
            'AL' => 'ALL',
            'AM' => 'AMD',
            'AO' => 'AOA',
            'AQ' => 'XXX',
            'AR' => 'ARS',
            'AS' => 'USD',
            'AT' => 'EUR',
            'AU' => 'AUD',
            'AW' => 'AWG',
            'AX' => 'EUR',
            'AZ' => 'AZN',
            'BA' => 'BAM',
            'BB' => 'BBD',
            'BD' => 'BDT',
            'BE' => 'EUR',
            'BF' => 'XOF',
            'BG' => 'BGN',
            'BH' => 'BHD',
            'BI' => 'BIF',
            'BJ' => 'XOF',
            'BL' => 'EUR',
            'BM' => 'BMD',
            'BN' => 'BND',
            'BO' => 'BOB',
            'BQ' => 'USD',
            'BR' => 'BRL',
            'BS' => 'BSD',
            'BT' => 'BTN',
            'BU' => 'BUK',
            'BV' => 'NOK',
            'BW' => 'BWP',
            'BY' => 'BYR',
            'BZ' => 'BZD',
            'CA' => 'CAD',
            'CC' => 'AUD',
            'CD' => 'CDF',
            'CF' => 'XAF',
            'CG' => 'XAF',
            'CH' => 'CHF',
            'CI' => 'XOF',
            'CK' => 'NZD',
            'CL' => 'CLP',
            'CM' => 'XAF',
            'CN' => 'CNY',
            'CO' => 'COP',
            'CP' => 'XXX',
            'CR' => 'CRC',
            'CS' => 'CSD',
            'CU' => 'CUP',
            'CV' => 'CVE',
            'CW' => 'ANG',
            'CX' => 'AUD',
            'CY' => 'EUR',
            'CZ' => 'CZK',
            'DD' => 'DDM',
            'DE' => 'EUR',
            'DG' => 'USD',
            'DJ' => 'DJF',
            'DK' => 'DKK',
            'DM' => 'XCD',
            'DO' => 'DOP',
            'DZ' => 'DZD',
            'EA' => 'EUR',
            'EC' => 'USD',
            'EE' => 'EUR',
            'EG' => 'EGP',
            'EH' => 'MAD',
            'ER' => 'ERN',
            'ES' => 'EUR',
            'ET' => 'ETB',
            'EU' => 'EUR',
            'FI' => 'EUR',
            'FJ' => 'FJD',
            'FK' => 'FKP',
            'FM' => 'USD',
            'FO' => 'DKK',
            'FR' => 'EUR',
            'GA' => 'XAF',
            'GB' => 'GBP',
            'GD' => 'XCD',
            'GE' => 'GEL',
            'GF' => 'EUR',
            'GG' => 'GBP',
            'GH' => 'GHS',
            'GI' => 'GIP',
            'GL' => 'DKK',
            'GM' => 'GMD',
            'GN' => 'GNF',
            'GP' => 'EUR',
            'GQ' => 'XAF',
            'GR' => 'EUR',
            'GS' => 'GBP',
            'GT' => 'GTQ',
            'GU' => 'USD',
            'GW' => 'XOF',
            'GY' => 'GYD',
            'HK' => 'HKD',
            'HM' => 'AUD',
            'HN' => 'HNL',
            'HR' => 'HRK',
            'HT' => 'HTG',
            'HU' => 'HUF',
            'IC' => 'EUR',
            'ID' => 'IDR',
            'IE' => 'EUR',
            'IL' => 'ILS',
            'IM' => 'GBP',
            'IN' => 'INR',
            'IO' => 'USD',
            'IQ' => 'IQD',
            'IR' => 'IRR',
            'IS' => 'ISK',
            'IT' => 'EUR',
            'JE' => 'GBP',
            'JM' => 'JMD',
            'JO' => 'JOD',
            'JP' => 'JPY',
            'KE' => 'KES',
            'KG' => 'KGS',
            'KH' => 'KHR',
            'KI' => 'AUD',
            'KM' => 'KMF',
            'KN' => 'XCD',
            'KP' => 'KPW',
            'KR' => 'KRW',
            'KW' => 'KWD',
            'KY' => 'KYD',
            'KZ' => 'KZT',
            'LA' => 'LAK',
            'LB' => 'LBP',
            'LC' => 'XCD',
            'LI' => 'CHF',
            'LK' => 'LKR',
            'LR' => 'LRD',
            'LS' => 'ZAR',
            'LT' => 'LTL',
            'LU' => 'EUR',
            'LV' => 'EUR',
            'LY' => 'LYD',
            'MA' => 'MAD',
            'MC' => 'EUR',
            'MD' => 'MDL',
            'ME' => 'EUR',
            'MF' => 'EUR',
            'MG' => 'MGA',
            'MH' => 'USD',
            'MK' => 'MKD',
            'ML' => 'XOF',
            'MM' => 'MMK',
            'MN' => 'MNT',
            'MO' => 'MOP',
            'MP' => 'USD',
            'MQ' => 'EUR',
            'MR' => 'MRO',
            'MS' => 'XCD',
            'MT' => 'EUR',
            'MU' => 'MUR',
            'MV' => 'MVR',
            'MW' => 'MWK',
            'MX' => 'MXN',
            'MY' => 'MYR',
            'MZ' => 'MZN',
            'NA' => 'NAD',
            'NC' => 'XPF',
            'NE' => 'XOF',
            'NF' => 'AUD',
            'NG' => 'NGN',
            'NI' => 'NIO',
            'NL' => 'EUR',
            'NO' => 'NOK',
            'NP' => 'NPR',
            'NR' => 'AUD',
            'NU' => 'NZD',
            'NZ' => 'NZD',
            'OM' => 'OMR',
            'PA' => 'PAB',
            'PE' => 'PEN',
            'PF' => 'XPF',
            'PG' => 'PGK',
            'PH' => 'PHP',
            'PK' => 'PKR',
            'PL' => 'PLN',
            'PM' => 'EUR',
            'PN' => 'NZD',
            'PR' => 'USD',
            'PS' => 'ILS',
            'PT' => 'EUR',
            'PW' => 'USD',
            'PY' => 'PYG',
            'QA' => 'QAR',
            'RE' => 'EUR',
            'RO' => 'RON',
            'RS' => 'RSD',
            'RU' => 'RUB',
            'RW' => 'RWF',
            'SA' => 'SAR',
            'SB' => 'SBD',
            'SC' => 'SCR',
            'SD' => 'SDG',
            'SE' => 'SEK',
            'SG' => 'SGD',
            'SH' => 'SHP',
            'SI' => 'EUR',
            'SJ' => 'NOK',
            'SK' => 'EUR',
            'SL' => 'SLL',
            'SM' => 'EUR',
            'SN' => 'XOF',
            'SO' => 'SOS',
            'SR' => 'SRD',
            'SS' => 'SSP',
            'ST' => 'STD',
            'SU' => 'SUR',
            'SV' => 'USD',
            'SX' => 'ANG',
            'SY' => 'SYP',
            'SZ' => 'SZL',
            'TA' => 'GBP',
            'TC' => 'USD',
            'TD' => 'XAF',
            'TF' => 'EUR',
            'TG' => 'XOF',
            'TH' => 'THB',
            'TJ' => 'TJS',
            'TK' => 'NZD',
            'TL' => 'USD',
            'TM' => 'TMT',
            'TN' => 'TND',
            'TO' => 'TOP',
            'TP' => 'TPE',
            'TR' => 'TRY',
            'TT' => 'TTD',
            'TV' => 'AUD',
            'TW' => 'TWD',
            'TZ' => 'TZS',
            'UA' => 'UAH',
            'UG' => 'UGX',
            'UM' => 'USD',
            'US' => 'USD',
            'UY' => 'UYU',
            'UZ' => 'UZS',
            'VA' => 'EUR',
            'VC' => 'XCD',
            'VE' => 'VEF',
            'VG' => 'USD',
            'VI' => 'USD',
            'VN' => 'VND',
            'VU' => 'VUV',
            'WF' => 'XPF',
            'WS' => 'WST',
            'XK' => 'EUR',
            'YE' => 'YER',
            'YD' => 'YDD',
            'YT' => 'EUR',
            'YU' => 'YUM',
            'ZA' => 'ZAR',
            'ZM' => 'ZMW',
            'ZR' => 'ZRN',
            'ZW' => 'USD',
            'ZZ' => 'XAG',
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'currencytoregion', 'AT');
        $this->assertEquals("EUR", $value);
    }

    /**
     * test for reading regiontocurrency from locale
     * expected array
     */
    public function testRegionToCurrency()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'regiontocurrency');
        $result = [
            'EUR' => '150 AD AT AX BE BL CY DE EA EE ES EU FI FR GF GP GR IC IE IT LU LV MC ME MF MQ MT NL PM PT RE SI SK SM TF VA XK YT',
            'SHP' => 'AC SH',
            'AED' => 'AE',
            'AFN' => 'AF',
            'XCD' => 'AG AI DM GD KN LC MS VC',
            'ALL' => 'AL',
            'AMD' => 'AM',
            'AOA' => 'AO',
            'XXX' => 'AQ CP',
            'ARS' => 'AR',
            'USD' => 'AS BQ DG EC FM GU IO MH MP PR PW SV TC TL UM US VG VI ZW',
            'AUD' => 'AU CC CX HM KI NF NR TV',
            'AWG' => 'AW',
            'AZN' => 'AZ',
            'BAM' => 'BA',
            'BBD' => 'BB',
            'BDT' => 'BD',
            'XOF' => 'BF BJ CI GW ML NE SN TG',
            'BGN' => 'BG',
            'BHD' => 'BH',
            'BIF' => 'BI',
            'BMD' => 'BM',
            'BND' => 'BN',
            'BOB' => 'BO',
            'BRL' => 'BR',
            'BSD' => 'BS',
            'BTN' => 'BT',
            'BUK' => 'BU',
            'NOK' => 'BV NO SJ',
            'BWP' => 'BW',
            'BYR' => 'BY',
            'BZD' => 'BZ',
            'CAD' => 'CA',
            'CDF' => 'CD',
            'XAF' => 'CF CG CM GA GQ TD',
            'CHF' => 'CH LI',
            'NZD' => 'CK NU NZ PN TK',
            'CLP' => 'CL',
            'CNY' => 'CN',
            'COP' => 'CO',
            'CRC' => 'CR',
            'CSD' => 'CS',
            'CUP' => 'CU',
            'CVE' => 'CV',
            'ANG' => 'CW SX',
            'CZK' => 'CZ',
            'DDM' => 'DD',
            'DJF' => 'DJ',
            'DKK' => 'DK FO GL',
            'DOP' => 'DO',
            'DZD' => 'DZ',
            'EGP' => 'EG',
            'MAD' => 'EH MA',
            'ERN' => 'ER',
            'ETB' => 'ET',
            'FJD' => 'FJ',
            'FKP' => 'FK',
            'GBP' => 'GB GG GS IM JE TA',
            'GEL' => 'GE',
            'GHS' => 'GH',
            'GIP' => 'GI',
            'GMD' => 'GM',
            'GNF' => 'GN',
            'GTQ' => 'GT',
            'GYD' => 'GY',
            'HKD' => 'HK',
            'HNL' => 'HN',
            'HRK' => 'HR',
            'HTG' => 'HT',
            'HUF' => 'HU',
            'IDR' => 'ID',
            'ILS' => 'IL PS',
            'INR' => 'IN',
            'IQD' => 'IQ',
            'IRR' => 'IR',
            'ISK' => 'IS',
            'JMD' => 'JM',
            'JOD' => 'JO',
            'JPY' => 'JP',
            'KES' => 'KE',
            'KGS' => 'KG',
            'KHR' => 'KH',
            'KMF' => 'KM',
            'KPW' => 'KP',
            'KRW' => 'KR',
            'KWD' => 'KW',
            'KYD' => 'KY',
            'KZT' => 'KZ',
            'LAK' => 'LA',
            'LBP' => 'LB',
            'LKR' => 'LK',
            'LRD' => 'LR',
            'ZAR' => 'LS ZA',
            'LTL' => 'LT',
            'LYD' => 'LY',
            'MDL' => 'MD',
            'MGA' => 'MG',
            'MKD' => 'MK',
            'MMK' => 'MM',
            'MNT' => 'MN',
            'MOP' => 'MO',
            'MRO' => 'MR',
            'MUR' => 'MU',
            'MVR' => 'MV',
            'MWK' => 'MW',
            'MXN' => 'MX',
            'MYR' => 'MY',
            'MZN' => 'MZ',
            'NAD' => 'NA',
            'XPF' => 'NC PF WF',
            'NGN' => 'NG',
            'NIO' => 'NI',
            'NPR' => 'NP',
            'OMR' => 'OM',
            'PAB' => 'PA',
            'PEN' => 'PE',
            'PGK' => 'PG',
            'PHP' => 'PH',
            'PKR' => 'PK',
            'PLN' => 'PL',
            'PYG' => 'PY',
            'QAR' => 'QA',
            'RON' => 'RO',
            'RSD' => 'RS',
            'RUB' => 'RU',
            'RWF' => 'RW',
            'SAR' => 'SA',
            'SBD' => 'SB',
            'SCR' => 'SC',
            'SDG' => 'SD',
            'SEK' => 'SE',
            'SGD' => 'SG',
            'SLL' => 'SL',
            'SOS' => 'SO',
            'SRD' => 'SR',
            'SSP' => 'SS',
            'STD' => 'ST',
            'SUR' => 'SU',
            'SYP' => 'SY',
            'SZL' => 'SZ',
            'THB' => 'TH',
            'TJS' => 'TJ',
            'TMT' => 'TM',
            'TND' => 'TN',
            'TOP' => 'TO',
            'TPE' => 'TP',
            'TRY' => 'TR',
            'TTD' => 'TT',
            'TWD' => 'TW',
            'TZS' => 'TZ',
            'UAH' => 'UA',
            'UGX' => 'UG',
            'UYU' => 'UY',
            'UZS' => 'UZ',
            'VEF' => 'VE',
            'VND' => 'VN',
            'VUV' => 'VU',
            'WST' => 'WS',
            'YER' => 'YE',
            'YDD' => 'YD',
            'YUM' => 'YU',
            'ZMW' => 'ZM',
            'ZRN' => 'ZR',
            'XAG' => 'ZZ',
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'regiontocurrency', 'EUR');
        $this->assertEquals(
            "150 AD AT AX BE BL CY DE EA EE ES EU FI FR GF GP GR IC IE IT LU LV MC ME MF MQ MT NL PM PT RE SI SK SM TF VA XK YT",
            $value
        );
    }

    /**
     * test for reading regiontoterritory from locale
     * expected array
     */
    public function testRegionToTerritory()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'regiontoterritory');
        $result = ['001' => '019 002 150 142 009',
            '011' => 'BF BJ CI CV GH GM GN GW LR ML MR NE NG SH SL SN TG', '013' => 'BZ CR GT HN MX NI PA SV',
            '014' => 'BI DJ ER ET KE KM MG MU MW MZ RE RW SC SO TZ UG YT ZM ZW',
            '142' => '145 143 030 034 035', '143' => 'TM TJ KG KZ UZ',
            '145' => 'AE AM AZ BH CY GE IL IQ JO KW LB OM PS QA SA SY TR YE',
            '015' => 'DZ EG EH LY MA SD SS TN EA IC', '150' => '154 155 151 039',
            '151' => 'BG BY CZ HU MD PL RO RU SK UA',
            '154' => 'GG IM JE AX DK EE FI FO GB IE IS LT LV NO SE SJ',
            '155' => 'AT BE CH DE FR LI LU MC NL', '017' => 'AO CD CF CG CM GA GQ ST TD',
            '018' => 'BW LS NA SZ ZA',
            '019' => '021 013 029 005', '002' => '015 011 017 014 018', '021' => 'BM CA GL PM US',
            '029' => 'AG AI AW BB BL BQ BS CU CW DM DO GD GP HT JM KN KY LC MF MQ MS PR SX TC TT VC VG VI',
            '003' => '021 013 029', '030' => 'CN HK JP KP KR MN MO TW',
            '035' => 'BN ID KH LA MM MY PH SG TH TL VN',
            '039' => 'AD AL BA ES GI GR HR IT ME MK MT RS PT SI SM VA XK', '419' => '013 029 005',
            '005' => 'AR BO BR CL CO EC FK GF GY PE PY SR UY VE', '053' => 'AU NF NZ',
            '054' => 'FJ NC PG SB VU', '057' => 'FM GU KI MH MP NR PW',
            '061' => 'AS CK NU PF PN TK TO TV WF WS', '034' => 'AF BD BT IN IR LK MV NP PK',
            '009' => '053 054 057 061 QO', 'QO' => 'AQ BV CC CX GS HM IO TF UM AC CP DG TA',
            'EU' => 'AT BE CY CZ DE DK EE ES FI FR GB GR HU IE IT LT LU LV MT NL PL PT SE SI SK BG RO'];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'regiontoterritory', '143');
        $this->assertEquals("TM TJ KG KZ UZ", $value);
    }

    /**
     * test for reading territorytoregion from locale
     * expected array
     */
    public function testTerritoryToRegion()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'territorytoregion');
        $result = [
  '019' => '001',
  '002' => '001',
  150 => '001',
  142 => '001',
  '009' => '001',
  'BF' => '011',
  'BJ' => '011',
  'CI' => '011',
  'CV' => '011',
  'GH' => '011',
  'GM' => '011',
  'GN' => '011',
  'GW' => '011',
  'LR' => '011',
  'ML' => '011',
  'MR' => '011',
  'NE' => '011',
  'NG' => '011',
  'SH' => '011',
  'SL' => '011',
  'SN' => '011',
  'TG' => '011',
  'BZ' => '013',
  'CR' => '013',
  'GT' => '013',
  'HN' => '013',
  'MX' => '013',
  'NI' => '013',
  'PA' => '013',
  'SV' => '013',
  'BI' => '014',
  'DJ' => '014',
  'ER' => '014',
  'ET' => '014',
  'KE' => '014',
  'KM' => '014',
  'MG' => '014',
  'MU' => '014',
  'MW' => '014',
  'MZ' => '014',
  'RE' => '014',
  'RW' => '014',
  'SC' => '014',
  'SO' => '014',
  'TZ' => '014',
  'UG' => '014',
  'YT' => '014',
  'ZM' => '014',
  'ZW' => '014',
  145 => '142',
  143 => '142',
  '030' => '142',
  '034' => '142',
  '035' => '142',
  'TM' => '143',
  'TJ' => '143',
  'KG' => '143',
  'KZ' => '143',
  'UZ' => '143',
  'AE' => '145',
  'AM' => '145',
  'AZ' => '145',
  'BH' => '145',
  'CY' => '145 EU',
  'GE' => '145',
  'IL' => '145',
  'IQ' => '145',
  'JO' => '145',
  'KW' => '145',
  'LB' => '145',
  'OM' => '145',
  'PS' => '145',
  'QA' => '145',
  'SA' => '145',
  'SY' => '145',
  'TR' => '145',
  'YE' => '145',
  'DZ' => '015',
  'EG' => '015',
  'EH' => '015',
  'LY' => '015',
  'MA' => '015',
  'SD' => '015',
  'SS' => '015',
  'TN' => '015',
  'EA' => '015',
  'IC' => '015',
  154 => '150',
  155 => '150',
  151 => '150',
  '039' => '150',
  'BG' => '151 EU',
  'BY' => '151',
  'CZ' => '151 EU',
  'HU' => '151 EU',
  'MD' => '151',
  'PL' => '151 EU',
  'RO' => '151 EU',
  'RU' => '151',
  'SK' => '151 EU',
  'UA' => '151',
  'GG' => '154',
  'IM' => '154',
  'JE' => '154',
  'AX' => '154',
  'DK' => '154 EU',
  'EE' => '154 EU',
  'FI' => '154 EU',
  'FO' => '154',
  'GB' => '154 EU',
  'IE' => '154 EU',
  'IS' => '154',
  'LT' => '154 EU',
  'LV' => '154 EU',
  'NO' => '154',
  'SE' => '154 EU',
  'SJ' => '154',
  'AT' => '155 EU',
  'BE' => '155 EU',
  'CH' => '155',
  'DE' => '155 EU',
  'FR' => '155 EU',
  'LI' => '155',
  'LU' => '155 EU',
  'MC' => '155',
  'NL' => '155 EU',
  'AO' => '017',
  'CD' => '017',
  'CF' => '017',
  'CG' => '017',
  'CM' => '017',
  'GA' => '017',
  'GQ' => '017',
  'ST' => '017',
  'TD' => '017',
  'BW' => '018',
  'LS' => '018',
  'NA' => '018',
  'SZ' => '018',
  'ZA' => '018',
  '021' => '019 003',
  '013' => '019 003 419',
  '029' => '019 003 419',
  '005' => '019 419',
  '015' => '002',
  '011' => '002',
  '017' => '002',
  '014' => '002',
  '018' => '002',
  'BM' => '021',
  'CA' => '021',
  'GL' => '021',
  'PM' => '021',
  'US' => '021',
  'AG' => '029',
  'AI' => '029',
  'AW' => '029',
  'BB' => '029',
  'BL' => '029',
  'BQ' => '029',
  'BS' => '029',
  'CU' => '029',
  'CW' => '029',
  'DM' => '029',
  'DO' => '029',
  'GD' => '029',
  'GP' => '029',
  'HT' => '029',
  'JM' => '029',
  'KN' => '029',
  'KY' => '029',
  'LC' => '029',
  'MF' => '029',
  'MQ' => '029',
  'MS' => '029',
  'PR' => '029',
  'SX' => '029',
  'TC' => '029',
  'TT' => '029',
  'VC' => '029',
  'VG' => '029',
  'VI' => '029',
  'CN' => '030',
  'HK' => '030',
  'JP' => '030',
  'KP' => '030',
  'KR' => '030',
  'MN' => '030',
  'MO' => '030',
  'TW' => '030',
  'BN' => '035',
  'ID' => '035',
  'KH' => '035',
  'LA' => '035',
  'MM' => '035',
  'MY' => '035',
  'PH' => '035',
  'SG' => '035',
  'TH' => '035',
  'TL' => '035',
  'VN' => '035',
  'AD' => '039',
  'AL' => '039',
  'BA' => '039',
  'ES' => '039 EU',
  'GI' => '039',
  'GR' => '039 EU',
  'HR' => '039',
  'IT' => '039 EU',
  'ME' => '039',
  'MK' => '039',
  'MT' => '039 EU',
  'RS' => '039',
  'PT' => '039 EU',
  'SI' => '039 EU',
  'SM' => '039',
  'VA' => '039',
  'XK' => '039',
  'AR' => '005',
  'BO' => '005',
  'BR' => '005',
  'CL' => '005',
  'CO' => '005',
  'EC' => '005',
  'FK' => '005',
  'GF' => '005',
  'GY' => '005',
  'PE' => '005',
  'PY' => '005',
  'SR' => '005',
  'UY' => '005',
  'VE' => '005',
  'AU' => '053',
  'NF' => '053',
  'NZ' => '053',
  'FJ' => '054',
  'NC' => '054',
  'PG' => '054',
  'SB' => '054',
  'VU' => '054',
  'FM' => '057',
  'GU' => '057',
  'KI' => '057',
  'MH' => '057',
  'MP' => '057',
  'NR' => '057',
  'PW' => '057',
  'AS' => '061',
  'CK' => '061',
  'NU' => '061',
  'PF' => '061',
  'PN' => '061',
  'TK' => '061',
  'TO' => '061',
  'TV' => '061',
  'WF' => '061',
  'WS' => '061',
  'AF' => '034',
    'BD' => '034',
  'BT' => '034',
  'IN' => '034',
  'IR' => '034',
  'LK' => '034',
  'MV' => '034',
  'NP' => '034',
  'PK' => '034',
  '053' => '009',
  '054' => '009',
  '057' => '009',
  '061' => '009',
  'QO' => '009',
  'AQ' => 'QO',
  'BV' => 'QO',
  'CC' => 'QO',
  'CX' => 'QO',
  'GS' => 'QO',
  'HM' => 'QO',
  'IO' => 'QO',
  'TF' => 'QO',
  'UM' => 'QO',
  'AC' => 'QO',
  'CP' => 'QO',
  'DG' => 'QO',
  'TA' => 'QO'];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'territorytoregion', 'AT');
        $this->assertEquals("155 EU", $value);
    }

    /**
     * test for reading scripttolanguage from locale
     * expected array
     */
    public function testScriptToLanguage()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'scripttolanguage');
        $result = [
            'aa'  => 'Latn',
            'ab'  => 'Cyrl',
            'abq' => 'Cyrl',
            'ace' => 'Latn',
            'ach' => 'Latn',
            'ada' => 'Latn',
            'ady' => 'Cyrl',
            'ae'  => 'Avst',
            'af'  => 'Latn',
            'agq' => 'Latn',
            'aii' => 'Cyrl',
            'ain' => 'Kana Latn',
            'ak'  => 'Latn',
            'akk' => 'Xsux',
            'ale' => 'Latn',
            'alt' => 'Cyrl',
            'am'  => 'Ethi',
            'amo' => 'Latn',
            'an'  => 'Latn',
            'anp' => 'Deva',
            'aoz' => 'Latn',
            'ar'  => 'Arab',
            'arc' => 'Armi',
            'arn' => 'Latn',
            'arp' => 'Latn',
            'arw' => 'Latn',
            'as'  => 'Beng',
            'asa' => 'Latn',
            'ast' => 'Latn',
            'atj' => 'Latn',
            'av'  => 'Cyrl',
            'awa' => 'Deva',
            'ay'  => 'Latn',
            'az'  => 'Arab Cyrl Latn',
            'ba'  => 'Cyrl',
            'bal' => 'Arab',
            'ban' => 'Latn',
            'bap' => 'Deva',
            'bas' => 'Latn',
            'bax' => 'Bamu',
            'bbc' => 'Latn',
            'bbj' => 'Latn',
            'be'  => 'Cyrl',
            'bej' => 'Arab',
            'bem' => 'Latn',
            'bez' => 'Latn',
            'bfd' => 'Latn',
            'bfq' => 'Taml',
            'bft' => 'Arab',
            'bfy' => 'Deva',
            'bg'  => 'Cyrl',
            'bgx' => 'Grek',
            'bhb' => 'Deva',
            'bho' => 'Deva',
            'bi'  => 'Latn',
            'bik' => 'Latn',
            'bin' => 'Latn',
            'bjj' => 'Deva',
            'bkm' => 'Latn',
            'bku' => 'Latn',
            'bla' => 'Latn',
            'blt' => 'Tavt',
            'bm'  => 'Latn',
            'bmq' => 'Latn',
            'bn'  => 'Beng',
            'bo'  => 'Tibt',
            'bqv' => 'Latn',
            'br'  => 'Latn',
            'bra' => 'Deva',
            'brx' => 'Deva',
            'bs'  => 'Cyrl Latn',
            'bss' => 'Latn',
            'bto' => 'Latn',
            'btv' => 'Deva',
            'bua' => 'Cyrl',
            'buc' => 'Latn',
            'bug' => 'Latn',
            'bum' => 'Latn',
            'bvb' => 'Latn',
            'bya' => 'Latn',
            'byn' => 'Ethi',
            'byv' => 'Latn',
            'bze' => 'Latn',
            'bzx' => 'Latn',
            'ca'  => 'Latn',
            'cad' => 'Latn',
            'car' => 'Latn',
            'cay' => 'Latn',
            'cch' => 'Latn',
            'ccp' => 'Beng',
            'ce'  => 'Cyrl',
            'ceb' => 'Latn',
            'cgg' => 'Latn',
            'ch'  => 'Latn',
            'chk' => 'Latn',
            'chm' => 'Cyrl',
            'chn' => 'Latn',
            'cho' => 'Latn',
            'chp' => 'Latn',
            'chr' => 'Cher',
            'chy' => 'Latn',
            'cja' => 'Arab',
            'cjm' => 'Cham',
            'cjs' => 'Cyrl',
            'ckb' => 'Arab',
            'ckt' => 'Cyrl',
            'co'  => 'Latn',
            'cop' => 'Arab Copt Grek',
            'cr'  => 'Cans Latn',
            'crh' => 'Cyrl',
            'crj' => 'Cans',
            'crk' => 'Cans',
            'crl' => 'Cans',
            'crm' => 'Cans',
            'cs'  => 'Latn',
            'csb' => 'Latn',
            'csw' => 'Cans',
            'cu'  => 'Cyrl',
            'cv'  => 'Cyrl',
            'cy'  => 'Latn',
            'da'  => 'Latn',
            'dak' => 'Latn',
            'dar' => 'Cyrl',
            'dav' => 'Latn',
            'de'  => 'Latn',
            'del' => 'Latn',
            'den' => 'Latn',
            'dgr' => 'Latn',
            'din' => 'Latn',
            'dje' => 'Latn',
            'dng' => 'Cyrl',
            'dnj' => 'Latn',
            'doi' => 'Arab',
            'dsb' => 'Latn',
            'dtm' => 'Latn',
            'dua' => 'Latn',
            'dv'  => 'Thaa',
            'dyo' => 'Latn',
            'dyu' => 'Latn',
            'dz'  => 'Tibt',
            'ebu' => 'Latn',
            'ee'  => 'Latn',
            'efi' => 'Latn',
            'egy' => 'Egyp',
            'eka' => 'Latn',
            'eky' => 'Kali',
            'el'  => 'Grek',
            'en'  => 'Latn',
            'eo'  => 'Latn',
            'es'  => 'Latn',
            'et'  => 'Latn',
            'ett' => 'Ital Latn',
            'eu'  => 'Latn',
            'evn' => 'Cyrl',
            'ewo' => 'Latn',
            'fa'  => 'Arab',
            'fan' => 'Latn',
            'ff'  => 'Latn',
            'fi'  => 'Latn',
            'fil' => 'Latn',
            'fit' => 'Latn',
            'fj'  => 'Latn',
            'fo'  => 'Latn',
            'fon' => 'Latn',
            'fr'  => 'Latn',
            'frr' => 'Latn',
            'frs' => 'Latn',
            'fur' => 'Latn',
            'fy'  => 'Latn',
            'ga'  => 'Latn',
            'gaa' => 'Latn',
            'gag' => 'Latn',
            'gay' => 'Latn',
            'gba' => 'Arab',
            'gbm' => 'Deva',
            'gcr' => 'Latn',
            'gd'  => 'Latn',
            'gez' => 'Ethi',
            'ggn' => 'Deva',
            'gil' => 'Latn',
            'gjk' => 'Arab',
            'gju' => 'Arab',
            'gl'  => 'Latn',
            'gld' => 'Cyrl',
            'gn'  => 'Latn',
            'gon' => 'Deva Telu',
            'gor' => 'Latn',
            'gos' => 'Latn',
            'got' => 'Goth',
            'grb' => 'Latn',
            'grc' => 'Cprt Grek Linb',
            'grt' => 'Beng',
            'gsw' => 'Latn',
            'gu'  => 'Gujr',
            'gub' => 'Latn',
            'guz' => 'Latn',
            'gv'  => 'Latn',
            'gvr' => 'Deva',
            'gwi' => 'Latn',
            'ha'  => 'Arab Latn',
            'hai' => 'Latn',
            'haw' => 'Latn',
            'he'  => 'Hebr',
            'hi'  => 'Deva',
            'hil' => 'Latn',
            'hit' => 'Xsux',
            'hmd' => 'Plrd',
            'hmn' => 'Latn',
            'hnd' => 'Arab',
            'hne' => 'Deva',
            'hnn' => 'Latn',
            'ho'  => 'Latn',
            'hoc' => 'Deva',
            'hoj' => 'Deva',
            'hop' => 'Latn',
            'hr'  => 'Latn',
            'hsb' => 'Latn',
            'ht'  => 'Latn',
            'hu'  => 'Latn',
            'hup' => 'Latn',
            'hy'  => 'Armn',
            'hz'  => 'Latn',
            'ia'  => 'Latn',
            'iba' => 'Latn',
            'ibb' => 'Latn',
            'id'  => 'Latn',
            'ig'  => 'Latn',
            'ii'  => 'Yiii',
            'ik'  => 'Latn',
            'ilo' => 'Latn',
            'inh' => 'Cyrl',
            'is'  => 'Latn',
            'it'  => 'Latn',
            'iu'  => 'Cans',
            'ja'  => 'Jpan',
            'jmc' => 'Latn',
            'jml' => 'Deva',
            'jpr' => 'Hebr',
            'jrb' => 'Hebr',
            'jv'  => 'Latn',
            'ka'  => 'Geor',
            'kaa' => 'Cyrl',
            'kab' => 'Latn',
            'kac' => 'Latn',
            'kaj' => 'Latn',
            'kam' => 'Latn',
            'kao' => 'Latn',
            'kbd' => 'Cyrl',
            'kca' => 'Cyrl',
            'kcg' => 'Latn',
            'kck' => 'Latn',
            'kde' => 'Latn',
            'kdt' => 'Thai',
            'kea' => 'Latn',
            'kfo' => 'Latn',
            'kfr' => 'Deva',
            'kg'  => 'Latn',
            'kge' => 'Latn',
            'kgp' => 'Latn',
            'kha' => 'Latn',
            'khb' => 'Talu',
            'khq' => 'Latn',
            'kht' => 'Mymr',
            'khw' => 'Arab',
            'ki'  => 'Latn',
            'kj'  => 'Latn',
            'kjg' => 'Laoo',
            'kjh' => 'Cyrl',
            'kk'  => 'Arab Cyrl',
            'kl'  => 'Latn',
            'kln' => 'Latn',
            'km'  => 'Khmr',
            'kmb' => 'Latn',
            'kn'  => 'Knda',
            'ko'  => 'Kore',
            'koi' => 'Cyrl',
            'kok' => 'Deva',
            'kos' => 'Latn',
            'kpe' => 'Latn',
            'kpy' => 'Cyrl',
            'kr'  => 'Latn',
            'krc' => 'Cyrl',
            'kri' => 'Latn',
            'krl' => 'Latn',
            'kru' => 'Deva',
            'ks'  => 'Arab Deva',
            'ksb' => 'Latn',
            'ksf' => 'Latn',
            'ksh' => 'Latn',
            'ku'  => 'Arab Cyrl Latn',
            'kum' => 'Cyrl',
            'kut' => 'Latn',
            'kv'  => 'Cyrl',
            'kvr' => 'Latn',
            'kvx' => 'Arab',
            'kw'  => 'Latn',
            'kxp' => 'Arab',
            'ky'  => 'Arab Cyrl Latn',
            'kyu' => 'Kali',
            'la'  => 'Latn',
            'lad' => 'Hebr',
            'lag' => 'Latn',
            'lah' => 'Arab',
            'lam' => 'Latn',
            'lb'  => 'Latn',
            'lbe' => 'Cyrl',
            'lbw' => 'Latn',
            'lcp' => 'Thai',
            'lep' => 'Lepc',
            'lez' => 'Cyrl',
            'lg'  => 'Latn',
            'li'  => 'Latn',
            'lif' => 'Deva Limb',
            'lis' => 'Lisu',
            'lki' => 'Arab',
            'lmn' => 'Telu',
            'lmo' => 'Latn',
            'ln'  => 'Latn',
            'lo'  => 'Laoo',
            'lol' => 'Latn',
            'loz' => 'Latn',
            'lt'  => 'Latn',
            'lu'  => 'Latn',
            'lua' => 'Latn',
            'lui' => 'Latn',
            'lun' => 'Latn',
            'luo' => 'Latn',
            'lus' => 'Beng',
            'lut' => 'Latn',
            'luy' => 'Latn',
            'luz' => 'Arab',
            'lv'  => 'Latn',
            'lwl' => 'Thai',
            'lzh' => 'Phag',
            'mad' => 'Latn',
            'maf' => 'Latn',
            'mag' => 'Deva',
            'mai' => 'Deva',
            'mak' => 'Latn',
            'man' => 'Latn Nkoo',
            'mas' => 'Latn',
            'maz' => 'Latn',
            'mdf' => 'Cyrl',
            'mdh' => 'Latn',
            'mdr' => 'Latn',
            'mdt' => 'Latn',
            'men' => 'Latn',
            'mer' => 'Latn',
            'mfe' => 'Latn',
            'mg'  => 'Latn',
            'mgh' => 'Latn',
            'mgp' => 'Deva',
            'mgy' => 'Latn',
            'mh'  => 'Latn',
            'mi'  => 'Latn',
            'mic' => 'Latn',
            'min' => 'Latn',
            'mk'  => 'Cyrl',
            'ml'  => 'Mlym',
            'mn'  => 'Cyrl Mong',
            'mnc' => 'Mong',
            'mni' => 'Beng',
            'mns' => 'Cyrl',
            'mnw' => 'Mymr',
            'moe' => 'Latn',
            'moh' => 'Latn',
            'mos' => 'Latn',
            'mr'  => 'Deva',
            'mrd' => 'Deva',
            'mrj' => 'Cyrl',
            'ms'  => 'Arab Latn',
            'mt'  => 'Latn',
            'mua' => 'Latn',
            'mus' => 'Latn',
            'mvy' => 'Arab',
            'mwk' => 'Latn',
            'mwl' => 'Latn',
            'mwr' => 'Deva',
            'mxc' => 'Latn',
            'my'  => 'Mymr',
            'myv' => 'Cyrl',
            'myz' => 'Mand',
            'na'  => 'Latn',
            'nap' => 'Latn',
            'naq' => 'Latn',
            'nb'  => 'Latn',
            'nch' => 'Latn',
            'nd'  => 'Latn',
            'nds' => 'Latn',
            'ne'  => 'Deva',
            'new' => 'Deva',
            'ng'  => 'Latn',
            'nhe' => 'Latn',
            'nhw' => 'Latn',
            'nia' => 'Latn',
            'nij' => 'Latn',
            'niu' => 'Latn',
            'nl'  => 'Latn',
            'nmg' => 'Latn',
            'nn'  => 'Latn',
            'nod' => 'Lana',
            'nog' => 'Cyrl',
            'non' => 'Runr',
            'nqo' => 'Nkoo',
            'nr'  => 'Latn',
            'nsk' => 'Cans',
            'nso' => 'Latn',
            'nus' => 'Latn',
            'nv'  => 'Latn',
            'nxq' => 'Latn',
            'ny'  => 'Latn',
            'nym' => 'Latn',
            'nyn' => 'Latn',
            'nyo' => 'Latn',
            'nzi' => 'Latn',
            'oc'  => 'Latn',
            'oj'  => 'Cans',
            'om'  => 'Latn',
            'or'  => 'Orya',
            'os'  => 'Cyrl',
            'osa' => 'Latn',
            'osc' => 'Ital Latn',
            'otk' => 'Orkh',
            'pa'  => 'Arab Guru',
            'pag' => 'Latn',
            'pal' => 'Phli',
            'pam' => 'Latn',
            'pap' => 'Latn',
            'pau' => 'Latn',
            'pcm' => 'Latn',
            'peo' => 'Xpeo',
            'phn' => 'Phnx',
            'pi'  => 'Deva Sinh Thai',
            'pko' => 'Latn',
            'pl'  => 'Latn',
            'pon' => 'Latn',
            'prd' => 'Arab',
            'prg' => 'Latn',
            'prs' => 'Arab',
            'ps'  => 'Arab',
            'pt'  => 'Latn',
            'puu' => 'Latn',
            'qu'  => 'Latn',
            'raj' => 'Latn',
            'rap' => 'Latn',
            'rar' => 'Latn',
            'rcf' => 'Latn',
            'rej' => 'Latn',
            'ria' => 'Latn',
            'rjs' => 'Deva',
            'rkt' => 'Beng',
            'rm'  => 'Latn',
            'rmf' => 'Latn',
            'rmo' => 'Latn',
            'rmt' => 'Arab',
            'rmu' => 'Latn',
            'rn'  => 'Latn',
            'rng' => 'Latn',
            'ro'  => 'Latn',
            'rob' => 'Latn',
            'rof' => 'Latn',
            'rom' => 'Cyrl Latn',
            'ru'  => 'Cyrl',
            'rue' => 'Cyrl',
            'rup' => 'Latn',
            'rw'  => 'Latn',
            'rwk' => 'Latn',
            'ryu' => 'Kana',
            'sa'  => 'Deva Shrd Sinh',
            'sad' => 'Latn',
            'saf' => 'Latn',
            'sah' => 'Cyrl',
            'sam' => 'Hebr Samr',
            'saq' => 'Latn',
            'sas' => 'Latn',
            'sat' => 'Latn',
            'saz' => 'Saur',
            'sbp' => 'Latn',
            'sc'  => 'Latn',
            'scn' => 'Latn',
            'sco' => 'Latn',
            'scs' => 'Latn',
            'sd'  => 'Arab Deva',
            'sdh' => 'Arab',
            'se'  => 'Latn',
            'see' => 'Latn',
            'sef' => 'Latn',
            'seh' => 'Latn',
            'sel' => 'Cyrl',
            'ses' => 'Latn',
            'sg'  => 'Latn',
            'sga' => 'Latn Ogam',
            'shi' => 'Arab Latn Tfng',
            'shn' => 'Mymr',
            'si'  => 'Sinh',
            'sid' => 'Latn',
            'sk'  => 'Latn',
            'sl'  => 'Latn',
            'sm'  => 'Latn',
            'sma' => 'Latn',
            'smj' => 'Latn',
            'smn' => 'Latn',
            'smp' => 'Samr',
            'sms' => 'Latn',
            'sn'  => 'Latn',
            'snk' => 'Latn',
            'so'  => 'Latn',
            'sq'  => 'Latn',
            'sr'  => 'Cyrl Latn',
            'srb' => 'Latn',
            'srn' => 'Latn',
            'srr' => 'Latn',
            'srx' => 'Deva',
            'ss'  => 'Latn',
            'ssy' => 'Latn',
            'st'  => 'Latn',
            'su'  => 'Latn',
            'suk' => 'Latn',
            'sus' => 'Latn',
            'sv'  => 'Latn',
            'sw'  => 'Latn',
            'swb' => 'Arab',
            'swc' => 'Latn',
            'sxn' => 'Latn',
            'syi' => 'Latn',
            'syl' => 'Beng',
            'syr' => 'Syrc',
            'ta'  => 'Taml',
            'tab' => 'Cyrl',
            'taj' => 'Deva',
            'tbw' => 'Latn',
            'tcy' => 'Knda',
            'tdd' => 'Tale',
            'tdg' => 'Deva',
            'tdh' => 'Deva',
            'te'  => 'Telu',
            'tem' => 'Latn',
            'teo' => 'Latn',
            'ter' => 'Latn',
            'tet' => 'Latn',
            'tg'  => 'Arab Cyrl Latn',
            'th'  => 'Thai',
            'thl' => 'Deva',
            'thq' => 'Deva',
            'thr' => 'Deva',
            'ti'  => 'Ethi',
            'tig' => 'Ethi',
            'tiv' => 'Latn',
            'tk'  => 'Arab Cyrl Latn',
            'tkl' => 'Latn',
            'tkt' => 'Deva',
            'tli' => 'Latn',
            'tmh' => 'Latn',
            'tn'  => 'Latn',
            'to'  => 'Latn',
            'tog' => 'Latn',
            'tpi' => 'Latn',
            'tr'  => 'Latn',
            'tru' => 'Latn',
            'trv' => 'Latn',
            'ts'  => 'Latn',
            'tsf' => 'Deva',
            'tsg' => 'Latn',
            'tsi' => 'Latn',
            'tsj' => 'Tibt',
            'tt'  => 'Cyrl',
            'ttj' => 'Latn',
            'tts' => 'Thai',
            'tum' => 'Latn',
            'tvl' => 'Latn',
            'twq' => 'Latn',
            'ty'  => 'Latn',
            'tyv' => 'Cyrl',
            'tzm' => 'Latn Tfng',
            'ude' => 'Cyrl',
            'udm' => 'Cyrl',
            'ug'  => 'Arab Cyrl',
            'uga' => 'Ugar',
            'uk'  => 'Cyrl',
            'uli' => 'Latn',
            'umb' => 'Latn',
            'unr' => 'Beng Deva',
            'unx' => 'Beng Deva',
            'ur'  => 'Arab',
            'uz'  => 'Arab Cyrl Latn',
            'vai' => 'Latn Vaii',
            've'  => 'Latn',
            'vi'  => 'Latn',
            'vic' => 'Latn',
            'vo'  => 'Latn',
            'vot' => 'Latn',
            'vun' => 'Latn',
            'wa'  => 'Latn',
            'wae' => 'Latn',
            'wal' => 'Ethi',
            'war' => 'Latn',
            'was' => 'Latn',
            'wo'  => 'Latn',
            'xal' => 'Cyrl',
            'xav' => 'Latn',
            'xcr' => 'Cari',
            'xh'  => 'Latn',
            'xlc' => 'Lyci',
            'xld' => 'Lydi',
            'xmr' => 'Merc',
            'xog' => 'Latn',
            'xpr' => 'Prti',
            'xsa' => 'Sarb',
            'xsr' => 'Deva',
            'xum' => 'Ital Latn',
            'yao' => 'Latn',
            'yap' => 'Latn',
            'yav' => 'Latn',
            'ybb' => 'Latn',
            'yi'  => 'Hebr',
            'yo'  => 'Latn',
            'yrk' => 'Cyrl',
            'yua' => 'Latn',
            'yue' => 'Hans',
            'za'  => 'Latn',
            'zap' => 'Latn',
            'zea' => 'Latn',
            'zen' => 'Tfng',
            'zgh' => 'Tfng',
            'zh'  => 'Hans Hant',
            'zmi' => 'Latn',
            'zu'  => 'Latn',
            'zun' => 'Latn',
            'zza' => 'Arab',
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'scripttolanguage', 'uk');
        $this->assertEquals("Cyrl", $value);
    }

    /**
     * test for reading languagetoscript from locale
     * expected array
     */
    public function testLanguageToScript()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'languagetoscript');
        $result = [
            'Latn' => 'aa ace ach ada af agq ain ak ale amo an aoz arn arp arw asa ast atj ay az ban bas bbc bbj bem bez bfd bi bik bin bkm bku bla bm bmq bqv br bs bss bto buc bug bum bvb bya byv bze bzx ca cad car cay cch ceb cgg ch chk chn cho chp chy co cr cs csb cy da dak dav de del den dgr din dje dnj dsb dtm dua dyo dyu ebu ee efi eka en eo es et ett eu ewo fan ff fi fil fit fj fo fon fr frr frs fur fy ga gaa gag gay gcr gd gil gl gn gor gos grb gsw gub guz gv gwi ha hai haw hil hmn hnn ho hop hr hsb ht hu hup hz ia iba ibb id ig ik ilo is it jmc jv kab kac kaj kam kao kcg kck kde kea kfo kg kge kgp kha khq ki kj kl kln kmb kos kpe kr kri krl ksb ksf ksh ku kut kvr kw ky la lag lam lb lbw lg li lmo ln lol loz lt lu lua lui lun luo lut luy lv mad maf mak man mas maz mdh mdr mdt men mer mfe mg mgh mgy mh mi mic min moe moh mos ms mt mua mus mwk mwl mxc na nap naq nb nch nd nds ng nhe nhw nia nij niu nl nmg nn nr nso nus nv nxq ny nym nyn nyo nzi oc om osa osc pag pam pap pau pcm pko pl pon prg pt puu qu raj rap rar rcf rej ria rm rmf rmo rmu rn rng ro rob rof rom rup rw rwk sad saf saq sas sat sbp sc scn sco scs se see sef seh ses sg sga shi sid sk sl sm sma smj smn sms sn snk so sq sr srb srn srr ss ssy st su suk sus sv sw swc sxn syi tbw tem teo ter tet tg tiv tk tkl tli tmh tn to tog tpi tr tru trv ts tsg tsi ttj tum tvl twq ty tzm uli umb uz vai ve vi vic vo vot vun wa wae war was wo xav xh xog xum yao yap yav ybb yo yua za zap zea zmi zu zun',
            'Cyrl' => 'ab abq ady aii alt av az ba be bg bs bua ce chm cjs ckt crh cu cv dar dng evn gld inh kaa kbd kca kjh kk koi kpy krc ku kum kv ky lbe lez mdf mk mn mns mrj myv nog os rom ru rue sah sel sr tab tg tk tt tyv ude udm ug uk uz xal yrk',
            'Avst' => 'ae',
            'Kana' => 'ain ryu',
            'Xsux' => 'akk hit',
            'Ethi' => 'am byn gez ti tig wal',
            'Deva' => 'anp awa bap bfy bhb bho bjj bra brx btv gbm ggn gon gvr hi hne hoc hoj jml kfr kok kru ks lif mag mai mgp mr mrd mwr ne new pi rjs sa sd srx taj tdg tdh thl thq thr tkt tsf unr unx xsr',
            'Arab' => 'ar az bal bej bft cja ckb cop doi fa gba gjk gju ha hnd khw kk ks ku kvx kxp ky lah lki luz ms mvy pa prd prs ps rmt sd sdh shi swb tg tk ug ur uz zza',
            'Armi' => 'arc',
            'Beng' => 'as bn ccp grt lus mni rkt syl unr unx',
            'Bamu' => 'bax',
            'Taml' => 'bfq ta',
            'Grek' => 'bgx cop el grc',
            'Tavt' => 'blt',
            'Tibt' => 'bo dz tsj',
            'Cher' => 'chr',
            'Cham' => 'cjm',
            'Copt' => 'cop',
            'Cans' => 'cr crj crk crl crm csw iu nsk oj',
            'Thaa' => 'dv',
            'Egyp' => 'egy',
            'Kali' => 'eky kyu',
            'Ital' => 'ett osc xum',
            'Telu' => 'gon lmn te',
            'Goth' => 'got',
            'Cprt' => 'grc',
            'Linb' => 'grc',
            'Gujr' => 'gu',
            'Hebr' => 'he jpr jrb lad sam yi',
            'Plrd' => 'hmd',
            'Armn' => 'hy',
            'Yiii' => 'ii',
            'Jpan' => 'ja',
            'Geor' => 'ka',
            'Thai' => 'kdt lcp lwl pi th tts',
            'Talu' => 'khb',
            'Mymr' => 'kht mnw my shn',
            'Laoo' => 'kjg lo',
            'Khmr' => 'km',
            'Knda' => 'kn tcy',
            'Kore' => 'ko',
            'Lepc' => 'lep',
            'Limb' => 'lif',
            'Lisu' => 'lis',
            'Phag' => 'lzh',
            'Nkoo' => 'man nqo',
            'Mlym' => 'ml',
            'Mong' => 'mn mnc',
            'Mand' => 'myz',
            'Lana' => 'nod',
            'Runr' => 'non',
            'Orya' => 'or',
            'Orkh' => 'otk',
            'Guru' => 'pa',
            'Phli' => 'pal',
            'Xpeo' => 'peo',
            'Phnx' => 'phn',
            'Sinh' => 'pi sa si',
            'Shrd' => 'sa',
            'Samr' => 'sam smp',
            'Saur' => 'saz',
            'Ogam' => 'sga',
            'Tfng' => 'shi tzm zen zgh',
            'Syrc' => 'syr',
            'Tale' => 'tdd',
            'Ugar' => 'uga',
            'Vaii' => 'vai',
            'Cari' => 'xcr',
            'Lyci' => 'xlc',
            'Lydi' => 'xld',
            'Merc' => 'xmr',
            'Prti' => 'xpr',
            'Sarb' => 'xsa',
            'Hans' => 'yue zh',
            'Hant' => 'zh',
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'languagetoscript', 'Kana');
        $this->assertEquals("ain ryu", $value);
    }

    /**
     * test for reading territorytolanguage from locale
     * expected array
     */
    public function testTerritoryToLanguage()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'territorytolanguage');
        $result = [
            'aa'  => 'DJ ET',
            'ab'  => 'GE',
            'abr' => 'GH',
            'ace' => 'ID',
            'ach' => 'UG',
            'ady' => 'RU',
            'af'  => 'NA ZA',
            'ak'  => 'GH',
            'am'  => 'ET',
            'ar'  => 'AE BH DJ DZ EG EH ER IL IQ JO KM KW LB LY MA MR OM PS QA SA SD SO SS SY TD TN YE',
            'as'  => 'IN',
            'ast' => 'ES',
            'av'  => 'RU',
            'awa' => 'IN',
            'ay'  => 'BO',
            'az'  => 'AZ',
            'ba'  => 'RU',
            'bal' => 'AF IR PK',
            'ban' => 'ID',
            'bbc' => 'ID',
            'bci' => 'CI',
            'be'  => 'BY',
            'bem' => 'ZM',
            'bew' => 'ID',
            'bg'  => 'BG',
            'bgc' => 'IN',
            'bhb' => 'IN',
            'bhi' => 'IN',
            'bhk' => 'PH',
            'bho' => 'IN MU NP',
            'bi'  => 'VU',
            'bik' => 'PH',
            'bin' => 'NG',
            'bjj' => 'IN',
            'bjn' => 'ID MY',
            'bm'  => 'ML',
            'bn'  => 'BD',
            'bo'  => 'CN',
            'bqi' => 'IR',
            'brh' => 'PK',
            'brx' => 'IN',
            'bs'  => 'BA',
            'buc' => 'YT',
            'bug' => 'ID',
            'bum' => 'CM',
            'bya' => 'ID',
            'ca'  => 'AD',
            'ce'  => 'RU',
            'ceb' => 'PH',
            'cgg' => 'UG',
            'ch'  => 'GU',
            'chk' => 'FM',
            'ckb' => 'IQ IR',
            'crs' => 'SC',
            'cs'  => 'CZ',
            'csb' => 'PL',
            'cv'  => 'RU',
            'cy'  => 'GB',
            'da'  => 'DK GL',
            'dcc' => 'IN',
            'de'  => 'AT BE CH DE LI LU',
            'dje' => 'NE',
            'doi' => 'IN',
            'dv'  => 'MV',
            'dyu' => 'BF',
            'dz'  => 'BT',
            'ee'  => 'GH TG',
            'efi' => 'NG',
            'el'  => 'CY GR',
            'en'  => 'AG AI AS AU BB BM BS BW BZ CA CC CK CM CX DG DM ER FJ FK FM GB GD GG GH GI GM GU GY HK IE IM IN IO JE JM KE KI KN KY LC LR LS MG MH MP MS MT MU MW NA NF NG NR NU NZ PG PH PK PN PR PW RW SB SC SD SG SH SL SS SX SZ TC TK TO TT TV TZ UG UM US VC VG VI VU WS ZA ZM ZW',
            'es'  => 'AR BO CL CO CR CU DO EA EC ES GQ GT HN IC MX NI PA PE PR PY SV UY VE',
            'et'  => 'EE',
            'eu'  => 'ES',
            'fa'  => 'AF IR',
            'fan' => 'GQ',
            'ff'  => 'GN SN',
            'ffm' => 'ML',
            'fi'  => 'FI',
            'fil' => 'PH',
            'fj'  => 'FJ',
            'fo'  => 'FO',
            'fon' => 'BJ',
            'fr'  => 'BE BF BI BJ BL CA CD CF CG CH CI CM DJ DZ FR GA GF GN GP GQ HT KM LU MA MC MF MG ML MQ MU NC NE PF PM RE RW SC SN SY TD TG TN VU WF YT',
            'fud' => 'WF',
            'fuq' => 'NE',
            'fuv' => 'NG',
            'fy'  => 'NL',
            'ga'  => 'IE',
            'gaa' => 'GH',
            'gbm' => 'IN',
            'gcr' => 'GF',
            'gd'  => 'GB',
            'gil' => 'KI',
            'gl'  => 'ES',
            'glk' => 'IR',
            'gn'  => 'PY',
            'gon' => 'IN',
            'gor' => 'ID',
            'gsw' => 'CH LI',
            'gu'  => 'IN',
            'guz' => 'KE',
            'gv'  => 'IM',
            'ha'  => 'NE NG',
            'haw' => 'US',
            'haz' => 'AF',
            'he'  => 'IL',
            'hi'  => 'IN',
            'hil' => 'PH',
            'hne' => 'IN',
            'hno' => 'PK',
            'ho'  => 'PG',
            'hoc' => 'IN',
            'hoj' => 'IN',
            'hr'  => 'BA HR',
            'ht'  => 'HT',
            'hu'  => 'HU',
            'hy'  => 'AM',
            'ibb' => 'NG',
            'id'  => 'ID',
            'ig'  => 'NG',
            'ii'  => 'CN',
            'ikt' => 'CA',
            'ilo' => 'PH',
            'inh' => 'RU',
            'is'  => 'IS',
            'it'  => 'CH IT SM',
            'iu'  => 'CA',
            'ja'  => 'JP',
            'jv'  => 'ID',
            'ka'  => 'GE',
            'kab' => 'DZ',
            'kam' => 'KE',
            'kbd' => 'RU',
            'kde' => 'TZ',
            'kea' => 'CV',
            'kfy' => 'IN',
            'kg'  => 'CD',
            'kha' => 'IN',
            'khn' => 'IN',
            'ki'  => 'KE',
            'kj'  => 'NA',
            'kk'  => 'KZ',
            'kl'  => 'GL',
            'kln' => 'KE',
            'km'  => 'KH',
            'kmb' => 'AO',
            'kn'  => 'IN',
            'ko'  => 'KP KR',
            'koi' => 'RU',
            'kok' => 'IN',
            'kos' => 'FM',
            'krc' => 'RU',
            'kri' => 'SL',
            'kru' => 'IN',
            'ks'  => 'IN',
            'ku'  => 'SY TR',
            'kum' => 'RU',
            'kv'  => 'RU',
            'kxm' => 'TH',
            'ky'  => 'KG',
            'la'  => 'VA',
            'lah' => 'PK',
            'laj' => 'UG',
            'lb'  => 'LU',
            'lbe' => 'RU',
            'lez' => 'RU',
            'lg'  => 'UG',
            'ljp' => 'ID',
            'lmn' => 'IN',
            'ln'  => 'CG',
            'lo'  => 'LA',
            'lrc' => 'IR',
            'lt'  => 'LT',
            'lu'  => 'CD',
            'lua' => 'CD',
            'luo' => 'KE',
            'luy' => 'KE',
            'lv'  => 'LV',
            'mad' => 'ID',
            'mag' => 'IN',
            'mai' => 'IN NP',
            'mak' => 'ID',
            'man' => 'GM GN',
            'mdf' => 'RU',
            'mdh' => 'PH',
            'men' => 'SL',
            'mer' => 'KE',
            'mfa' => 'TH',
            'mfe' => 'MU',
            'mg'  => 'MG',
            'mgh' => 'MZ',
            'mh'  => 'MH',
            'mi'  => 'NZ',
            'min' => 'ID',
            'mk'  => 'MK',
            'ml'  => 'IN',
            'mn'  => 'MN',
            'mni' => 'IN',
            'mos' => 'BF',
            'mr'  => 'IN',
            'ms'  => 'BN MY SG',
            'mt'  => 'MT',
            'mtr' => 'IN',
            'mwr' => 'IN',
            'my'  => 'MM',
            'myv' => 'RU',
            'myx' => 'UG',
            'na'  => 'NR',
            'nap' => 'IT',
            'nb'  => 'NO SJ',
            'nd'  => 'ZW',
            'ndc' => 'MZ',
            'nds' => 'DE',
            'ne'  => 'NP',
            'new' => 'NP',
            'ng'  => 'NA',
            'ngl' => 'MZ',
            'niu' => 'NU',
            'nl'  => 'AW BE BQ CW NL SR SX',
            'nn'  => 'NO',
            'nod' => 'TH',
            'noe' => 'IN',
            'nr'  => 'ZA',
            'nso' => 'ZA',
            'ny'  => 'MW',
            'nym' => 'TZ',
            'nyn' => 'UG',
            'oc'  => 'FR',
            'om'  => 'ET',
            'or'  => 'IN',
            'os'  => 'GE',
            'pa'  => 'IN PK',
            'pag' => 'PH',
            'pam' => 'PH',
            'pap' => 'AW BQ CW',
            'pau' => 'PW',
            'pcm' => 'NG',
            'pl'  => 'PL',
            'pon' => 'FM',
            'ps'  => 'AF',
            'pt'  => 'AO BR CV GW MO MZ PT ST TL',
            'qu'  => 'BO PE',
            'raj' => 'IN',
            'rcf' => 'RE',
            'rej' => 'ID',
            'rif' => 'MA',
            'rkt' => 'BD IN',
            'rm'  => 'CH',
            'rmt' => 'IR',
            'rn'  => 'BI',
            'ro'  => 'MD RO',
            'ru'  => 'BY KG KZ RU UA',
            'rw'  => 'RW',
            'sa'  => 'IN',
            'sah' => 'RU',
            'sas' => 'ID',
            'sat' => 'IN',
            'sck' => 'IN',
            'scn' => 'IT',
            'sco' => 'GB',
            'sd'  => 'IN PK',
            'sdh' => 'IR',
            'se'  => 'NO',
            'seh' => 'MZ',
            'sg'  => 'CF',
            'shi' => 'MA',
            'shn' => 'MM',
            'si'  => 'LK',
            'sid' => 'ET',
            'sk'  => 'SK',
            'skr' => 'PK',
            'sl'  => 'SI',
            'sm'  => 'AS WS',
            'sn'  => 'ZW',
            'so'  => 'SO',
            'sou' => 'TH',
            'sq'  => 'AL MK XK',
            'sr'  => 'BA ME RS XK',
            'srn' => 'SR',
            'srr' => 'SN',
            'ss'  => 'SZ ZA',
            'st'  => 'LS ZA',
            'su'  => 'ID',
            'suk' => 'TZ',
            'sus' => 'GN',
            'sv'  => 'AX FI SE',
            'sw'  => 'KE TZ UG',
            'swb' => 'YT',
            'swc' => 'CD',
            'swv' => 'IN',
            'syl' => 'BD',
            'ta'  => 'LK SG',
            'tcy' => 'IN',
            'te'  => 'IN',
            'tem' => 'SL',
            'teo' => 'UG',
            'tet' => 'TL',
            'tg'  => 'TJ',
            'th'  => 'TH',
            'ti'  => 'ER',
            'tig' => 'ER',
            'tiv' => 'NG',
            'tk'  => 'TM',
            'tkl' => 'TK',
            'tmh' => 'NE',
            'tn'  => 'BW ZA',
            'to'  => 'TO',
            'tpi' => 'PG',
            'tr'  => 'CY TR',
            'ts'  => 'ZA',
            'tsg' => 'PH',
            'tt'  => 'RU',
            'tts' => 'TH',
            'tum' => 'MW',
            'tvl' => 'TV',
            'ty'  => 'PF',
            'tyv' => 'RU',
            'tzm' => 'MA',
            'udm' => 'RU',
            'ug'  => 'CN',
            'uk'  => 'UA',
            'uli' => 'FM',
            'umb' => 'AO',
            'und' => 'AQ BV CP GS HM',
            'unr' => 'IN',
            'ur'  => 'PK',
            'uz'  => 'UZ',
            've'  => 'ZA',
            'vi'  => 'VN',
            'vmw' => 'MZ',
            'wal' => 'ET',
            'war' => 'PH',
            'wbq' => 'IN',
            'wbr' => 'IN',
            'wls' => 'WF',
            'wo'  => 'SN',
            'wtm' => 'IN',
            'xh'  => 'ZA',
            'xnr' => 'IN',
            'xog' => 'UG',
            'yap' => 'FM',
            'yo'  => 'NG',
            'za'  => 'CN',
            'zdj' => 'KM',
            'zgh' => 'MA',
            'zh'  => 'CN HK MO SG TW',
            'zu'  => 'ZA',
            'zza' => 'TR',
        ];
        $this->assertEquals($result, $value, var_export($value, true));

        $value = Zend_Locale_Data::getContent('de_AT', 'territorytolanguage', 'uk');
        $this->assertEquals("UA", $value);
    }

    /**
     * test for reading languagetoterritory from locale
     * expected array
     */
    public function testLanguageToTerritory()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'languagetoterritory');
        $result = [
            'DJ' => 'aa ar fr',
            'ET' => 'aa am om sid wal',
            'GE' => 'ab ka os',
            'GH' => 'abr ak ee en gaa',
            'ID' => 'ace ban bbc bew bjn bug bya gor id jv ljp mad mak min rej sas su',
            'UG' => 'ach cgg en laj lg myx nyn sw teo xog',
            'RU' => 'ady av ba ce cv inh kbd koi krc kum kv lbe lez mdf myv ru sah tt tyv udm',
            'NA' => 'af en kj ng',
            'ZA' => 'af en nr nso ss st tn ts ve xh zu',
            'AE' => 'ar',
            'BH' => 'ar',
            'DZ' => 'ar fr kab',
            'EG' => 'ar',
            'EH' => 'ar',
            'ER' => 'ar en ti tig',
            'IL' => 'ar he',
            'IQ' => 'ar ckb',
            'JO' => 'ar',
            'KM' => 'ar fr zdj',
            'KW' => 'ar',
            'LB' => 'ar',
            'LY' => 'ar',
            'MA' => 'ar fr rif shi tzm zgh',
            'MR' => 'ar',
            'OM' => 'ar',
            'PS' => 'ar',
            'QA' => 'ar',
            'SA' => 'ar',
            'SD' => 'ar en',
            'SO' => 'ar so',
            'SS' => 'ar en',
            'SY' => 'ar fr ku',
            'TD' => 'ar fr',
            'TN' => 'ar fr',
            'YE' => 'ar',
            'IN' => 'as awa bgc bhb bhi bho bjj brx dcc doi en gbm gon gu hi hne hoc hoj kfy kha khn kn kok kru ks lmn mag mai ml mni mr mtr mwr noe or pa raj rkt sa sat sck sd swv tcy te unr wbq wbr wtm xnr',
            'ES' => 'ast es eu gl',
            'BO' => 'ay es qu',
            'AZ' => 'az',
            'AF' => 'bal fa haz ps',
            'IR' => 'bal bqi ckb fa glk lrc rmt sdh',
            'PK' => 'bal brh en hno lah pa sd skr ur',
            'CI' => 'bci fr',
            'BY' => 'be ru',
            'ZM' => 'bem en',
            'BG' => 'bg',
            'PH' => 'bhk bik ceb en fil hil ilo mdh pag pam tsg war',
            'MU' => 'bho en fr mfe',
            'NP' => 'bho mai ne new',
            'VU' => 'bi en fr',
            'NG' => 'bin efi en fuv ha ibb ig pcm tiv yo',
            'MY' => 'bjn ms',
            'ML' => 'bm ffm fr',
            'BD' => 'bn rkt syl',
            'CN' => 'bo ii ug za zh',
            'BA' => 'bs hr sr',
            'YT' => 'buc fr swb',
            'CM' => 'bum en fr',
            'AD' => 'ca',
            'GU' => 'ch en',
            'FM' => 'chk en kos pon uli yap',
            'SC' => 'crs en fr',
            'CZ' => 'cs',
            'PL' => 'csb pl',
            'GB' => 'cy en gd sco',
            'DK' => 'da',
            'GL' => 'da kl',
            'AT' => 'de',
            'BE' => 'de fr nl',
            'CH' => 'de fr gsw it rm',
            'DE' => 'de nds',
            'LI' => 'de gsw',
            'LU' => 'de fr lb',
            'NE' => 'dje fr fuq ha tmh',
            'MV' => 'dv',
            'BF' => 'dyu fr mos',
            'BT' => 'dz',
            'TG' => 'ee fr',
            'CY' => 'el tr',
            'GR' => 'el',
            'AG' => 'en',
            'AI' => 'en',
            'AS' => 'en sm',
            'AU' => 'en',
            'BB' => 'en',
            'BM' => 'en',
            'BS' => 'en',
            'BW' => 'en tn',
            'BZ' => 'en',
            'CA' => 'en fr ikt iu',
            'CC' => 'en',
            'CK' => 'en',
            'CX' => 'en',
            'DG' => 'en',
            'DM' => 'en',
            'FJ' => 'en fj',
            'FK' => 'en',
            'GD' => 'en',
            'GG' => 'en',
            'GI' => 'en',
            'GM' => 'en man',
            'GY' => 'en',
            'HK' => 'en zh',
            'IE' => 'en ga',
            'IM' => 'en gv',
            'IO' => 'en',
            'JE' => 'en',
            'JM' => 'en',
            'KE' => 'en guz kam ki kln luo luy mer sw',
            'KI' => 'en gil',
            'KN' => 'en',
            'KY' => 'en',
            'LC' => 'en',
            'LR' => 'en',
            'LS' => 'en st',
            'MG' => 'en fr mg',
            'MH' => 'en mh',
            'MP' => 'en',
            'MS' => 'en',
            'MT' => 'en mt',
            'MW' => 'en ny tum',
            'NF' => 'en',
            'NR' => 'en na',
            'NU' => 'en niu',
            'NZ' => 'en mi',
            'PG' => 'en ho tpi',
            'PN' => 'en',
            'PR' => 'en es',
            'PW' => 'en pau',
            'RW' => 'en fr rw',
            'SB' => 'en',
            'SG' => 'en ms ta zh',
            'SH' => 'en',
            'SL' => 'en kri men tem',
            'SX' => 'en nl',
            'SZ' => 'en ss',
            'TC' => 'en',
            'TK' => 'en tkl',
            'TO' => 'en to',
            'TT' => 'en',
            'TV' => 'en tvl',
            'TZ' => 'en kde nym suk sw',
            'UM' => 'en',
            'US' => 'en haw',
            'VC' => 'en',
            'VG' => 'en',
            'VI' => 'en',
            'WS' => 'en sm',
            'ZW' => 'en nd sn',
            'AR' => 'es',
            'CL' => 'es',
            'CO' => 'es',
            'CR' => 'es',
            'CU' => 'es',
            'DO' => 'es',
            'EA' => 'es',
            'EC' => 'es',
            'GQ' => 'es fan fr',
            'GT' => 'es',
            'HN' => 'es',
            'IC' => 'es',
            'MX' => 'es',
            'NI' => 'es',
            'PA' => 'es',
            'PE' => 'es qu',
            'PY' => 'es gn',
            'SV' => 'es',
            'UY' => 'es',
            'VE' => 'es',
            'EE' => 'et',
            'GN' => 'ff fr man sus',
            'SN' => 'ff fr srr wo',
            'FI' => 'fi sv',
            'FO' => 'fo',
            'BJ' => 'fon fr',
            'BI' => 'fr rn',
            'BL' => 'fr',
            'CD' => 'fr kg lu lua swc',
            'CF' => 'fr sg',
            'CG' => 'fr ln',
            'FR' => 'fr oc',
            'GA' => 'fr',
            'GF' => 'fr gcr',
            'GP' => 'fr',
            'HT' => 'fr ht',
            'MC' => 'fr',
            'MF' => 'fr',
            'MQ' => 'fr',
            'NC' => 'fr',
            'PF' => 'fr ty',
            'PM' => 'fr',
            'RE' => 'fr rcf',
            'WF' => 'fr fud wls',
            'NL' => 'fy nl',
            'HR' => 'hr',
            'HU' => 'hu',
            'AM' => 'hy',
            'IS' => 'is',
            'IT' => 'it nap scn',
            'SM' => 'it',
            'JP' => 'ja',
            'CV' => 'kea pt',
            'KZ' => 'kk ru',
            'KH' => 'km',
            'AO' => 'kmb pt umb',
            'KP' => 'ko',
            'KR' => 'ko',
            'TR' => 'ku tr zza',
            'TH' => 'kxm mfa nod sou th tts',
            'KG' => 'ky ru',
            'VA' => 'la',
            'LA' => 'lo',
            'LT' => 'lt',
            'LV' => 'lv',
            'MZ' => 'mgh ndc ngl pt seh vmw',
            'MK' => 'mk sq',
            'MN' => 'mn',
            'BN' => 'ms',
            'MM' => 'my shn',
            'NO' => 'nb nn se',
            'SJ' => 'nb',
            'AW' => 'nl pap',
            'BQ' => 'nl pap',
            'CW' => 'nl pap',
            'SR' => 'nl srn',
            'BR' => 'pt',
            'GW' => 'pt',
            'MO' => 'pt zh',
            'PT' => 'pt',
            'ST' => 'pt',
            'TL' => 'pt tet',
            'MD' => 'ro',
            'RO' => 'ro',
            'UA' => 'ru uk',
            'LK' => 'si ta',
            'SK' => 'sk',
            'SI' => 'sl',
            'AL' => 'sq',
            'XK' => 'sq sr',
            'ME' => 'sr',
            'RS' => 'sr',
            'AX' => 'sv',
            'SE' => 'sv',
            'TJ' => 'tg',
            'TM' => 'tk',
            'AQ' => 'und',
            'BV' => 'und',
            'CP' => 'und',
            'GS' => 'und',
            'HM' => 'und',
            'UZ' => 'uz',
            'VN' => 'vi',
            'TW' => 'zh',
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'languagetoterritory', 'GQ');
        $this->assertEquals("es fan fr", $value);
    }

    /**
     * test for reading timezonetowindows from locale
     * expected array
     */
    public function testTimezoneToWindows()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'timezonetowindows');
        $result = [
            'Dateline Standard Time'          => 'Etc/GMT+12',
            'UTC-11'                          => 'Etc/GMT+11',
            'Hawaiian Standard Time'          => 'Pacific/Honolulu',
            'Alaskan Standard Time'           => 'America/Anchorage',
            'Pacific Standard Time (Mexico)'  => 'America/Santa_Isabel',
            'Pacific Standard Time'           => 'America/Los_Angeles',
            'US Mountain Standard Time'       => 'America/Phoenix',
            'Mountain Standard Time (Mexico)' => 'America/Chihuahua',
            'Mountain Standard Time'          => 'America/Denver',
            'Central America Standard Time'   => 'America/Guatemala',
            'Central Standard Time'           => 'America/Chicago',
            'Central Standard Time (Mexico)'  => 'America/Mexico_City',
            'Canada Central Standard Time'    => 'America/Regina',
            'SA Pacific Standard Time'        => 'America/Bogota',
            'Eastern Standard Time'           => 'America/New_York',
            'US Eastern Standard Time'        => 'America/Indianapolis',
            'Venezuela Standard Time'         => 'America/Caracas',
            'Paraguay Standard Time'          => 'America/Asuncion',
            'Atlantic Standard Time'          => 'America/Halifax',
            'Central Brazilian Standard Time' => 'America/Cuiaba',
            'SA Western Standard Time'        => 'America/La_Paz',
            'Pacific SA Standard Time'        => 'America/Santiago',
            'Newfoundland Standard Time'      => 'America/St_Johns',
            'E. South America Standard Time'  => 'America/Sao_Paulo',
            'Argentina Standard Time'         => 'America/Buenos_Aires',
            'SA Eastern Standard Time'        => 'America/Cayenne',
            'Greenland Standard Time'         => 'America/Godthab',
            'Montevideo Standard Time'        => 'America/Montevideo',
            'Bahia Standard Time'             => 'America/Bahia',
            'UTC-02'                          => 'Etc/GMT+2',
            'Azores Standard Time'            => 'Atlantic/Azores',
            'Cape Verde Standard Time'        => 'Atlantic/Cape_Verde',
            'Morocco Standard Time'           => 'Africa/Casablanca',
            'UTC'                             => 'Etc/GMT',
            'GMT Standard Time'               => 'Europe/London',
            'Greenwich Standard Time'         => 'Atlantic/Reykjavik',
            'W. Europe Standard Time'         => 'Europe/Berlin',
            'Central Europe Standard Time'    => 'Europe/Budapest',
            'Romance Standard Time'           => 'Europe/Paris',
            'Central European Standard Time'  => 'Europe/Warsaw',
            'W. Central Africa Standard Time' => 'Africa/Lagos',
            'Namibia Standard Time'           => 'Africa/Windhoek',
            'GTB Standard Time'               => 'Europe/Bucharest',
            'Middle East Standard Time'       => 'Asia/Beirut',
            'Egypt Standard Time'             => 'Africa/Cairo',
            'Syria Standard Time'             => 'Asia/Damascus',
            'South Africa Standard Time'      => 'Africa/Johannesburg',
            'FLE Standard Time'               => 'Europe/Kiev',
            'Turkey Standard Time'            => 'Europe/Istanbul',
            'Israel Standard Time'            => 'Asia/Jerusalem',
            'Libya Standard Time'             => 'Africa/Tripoli',
            'Jordan Standard Time'            => 'Asia/Amman',
            'Arabic Standard Time'            => 'Asia/Baghdad',
            'Kaliningrad Standard Time'       => 'Europe/Kaliningrad',
            'Arab Standard Time'              => 'Asia/Riyadh',
            'E. Africa Standard Time'         => 'Africa/Nairobi',
            'Iran Standard Time'              => 'Asia/Tehran',
            'Arabian Standard Time'           => 'Asia/Dubai',
            'Azerbaijan Standard Time'        => 'Asia/Baku',
            'Russian Standard Time'           => 'Europe/Moscow',
            'Mauritius Standard Time'         => 'Indian/Mauritius',
            'Georgian Standard Time'          => 'Asia/Tbilisi',
            'Caucasus Standard Time'          => 'Asia/Yerevan',
            'Afghanistan Standard Time'       => 'Asia/Kabul',
            'West Asia Standard Time'         => 'Asia/Tashkent',
            'Pakistan Standard Time'          => 'Asia/Karachi',
            'India Standard Time'             => 'Asia/Calcutta',
            'Sri Lanka Standard Time'         => 'Asia/Colombo',
            'Nepal Standard Time'             => 'Asia/Katmandu',
            'Central Asia Standard Time'      => 'Asia/Almaty',
            'Bangladesh Standard Time'        => 'Asia/Dhaka',
            'Ekaterinburg Standard Time'      => 'Asia/Yekaterinburg',
            'Myanmar Standard Time'           => 'Asia/Rangoon',
            'SE Asia Standard Time'           => 'Asia/Bangkok',
            'N. Central Asia Standard Time'   => 'Asia/Novosibirsk',
            'China Standard Time'             => 'Asia/Shanghai',
            'North Asia Standard Time'        => 'Asia/Krasnoyarsk',
            'Singapore Standard Time'         => 'Asia/Singapore',
            'W. Australia Standard Time'      => 'Australia/Perth',
            'Taipei Standard Time'            => 'Asia/Taipei',
            'Ulaanbaatar Standard Time'       => 'Asia/Ulaanbaatar',
            'North Asia East Standard Time'   => 'Asia/Irkutsk',
            'Tokyo Standard Time'             => 'Asia/Tokyo',
            'Korea Standard Time'             => 'Asia/Seoul',
            'Cen. Australia Standard Time'    => 'Australia/Adelaide',
            'AUS Central Standard Time'       => 'Australia/Darwin',
            'E. Australia Standard Time'      => 'Australia/Brisbane',
            'AUS Eastern Standard Time'       => 'Australia/Sydney',
            'West Pacific Standard Time'      => 'Pacific/Port_Moresby',
            'Tasmania Standard Time'          => 'Australia/Hobart',
            'Yakutsk Standard Time'           => 'Asia/Yakutsk',
            'Central Pacific Standard Time'   => 'Pacific/Guadalcanal',
            'Vladivostok Standard Time'       => 'Asia/Vladivostok',
            'New Zealand Standard Time'       => 'Pacific/Auckland',
            'UTC+12'                          => 'Etc/GMT-12',
            'Fiji Standard Time'              => 'Pacific/Fiji',
            'Magadan Standard Time'           => 'Asia/Magadan',
            'Tonga Standard Time'             => 'Pacific/Tongatapu',
            'Samoa Standard Time'             => 'Pacific/Apia',
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'timezonetowindows', 'Fiji Standard Time');
        $this->assertEquals("Pacific/Fiji", $value);
    }

    /**
     * test for reading windowstotimezone from locale
     * expected array
     */
    public function testWindowsToTimezone()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'windowstotimezone');
        $result = [
            'Etc/GMT+12'                                                                                                                                                                                                                                                                       => 'Dateline Standard Time',
            'Etc/GMT+11'                                                                                                                                                                                                                                                                       => 'UTC-11',
            'Pacific/Pago_Pago'                                                                                                                                                                                                                                                                => 'UTC-11',
            'Pacific/Niue'                                                                                                                                                                                                                                                                     => 'UTC-11',
            'Pacific/Midway'                                                                                                                                                                                                                                                                   => 'UTC-11',
            'Pacific/Honolulu'                                                                                                                                                                                                                                                                 => 'Hawaiian Standard Time',
            'Pacific/Rarotonga'                                                                                                                                                                                                                                                                => 'Hawaiian Standard Time',
            'Pacific/Tahiti'                                                                                                                                                                                                                                                                   => 'Hawaiian Standard Time',
            'Pacific/Johnston'                                                                                                                                                                                                                                                                 => 'Hawaiian Standard Time',
            'Etc/GMT+10'                                                                                                                                                                                                                                                                       => 'Hawaiian Standard Time',
            'America/Anchorage'                                                                                                                                                                                                                                                                => 'Alaskan Standard Time',
            'America/Anchorage America/Juneau America/Nome America/Sitka America/Yakutat'                                                                                                                                                                                                      => 'Alaskan Standard Time',
            'America/Santa_Isabel'                                                                                                                                                                                                                                                             => 'Pacific Standard Time (Mexico)',
            'America/Los_Angeles'                                                                                                                                                                                                                                                              => 'Pacific Standard Time',
            'America/Vancouver America/Dawson America/Whitehorse'                                                                                                                                                                                                                              => 'Pacific Standard Time',
            'America/Tijuana'                                                                                                                                                                                                                                                                  => 'Pacific Standard Time',
            'PST8PDT'                                                                                                                                                                                                                                                                          => 'Pacific Standard Time',
            'America/Phoenix'                                                                                                                                                                                                                                                                  => 'US Mountain Standard Time',
            'America/Dawson_Creek America/Creston'                                                                                                                                                                                                                                             => 'US Mountain Standard Time',
            'America/Hermosillo'                                                                                                                                                                                                                                                               => 'US Mountain Standard Time',
            'Etc/GMT+7'                                                                                                                                                                                                                                                                        => 'US Mountain Standard Time',
            'America/Chihuahua'                                                                                                                                                                                                                                                                => 'Mountain Standard Time (Mexico)',
            'America/Chihuahua America/Mazatlan'                                                                                                                                                                                                                                               => 'Mountain Standard Time (Mexico)',
            'America/Denver'                                                                                                                                                                                                                                                                   => 'Mountain Standard Time',
            'America/Edmonton America/Cambridge_Bay America/Inuvik America/Yellowknife'                                                                                                                                                                                                        => 'Mountain Standard Time',
            'America/Ojinaga'                                                                                                                                                                                                                                                                  => 'Mountain Standard Time',
            'America/Denver America/Boise America/Shiprock'                                                                                                                                                                                                                                    => 'Mountain Standard Time',
            'MST7MDT'                                                                                                                                                                                                                                                                          => 'Mountain Standard Time',
            'America/Guatemala'                                                                                                                                                                                                                                                                => 'Central America Standard Time',
            'America/Belize'                                                                                                                                                                                                                                                                   => 'Central America Standard Time',
            'America/Costa_Rica'                                                                                                                                                                                                                                                               => 'Central America Standard Time',
            'Pacific/Galapagos'                                                                                                                                                                                                                                                                => 'Central America Standard Time',
            'America/Tegucigalpa'                                                                                                                                                                                                                                                              => 'Central America Standard Time',
            'America/Managua'                                                                                                                                                                                                                                                                  => 'Central America Standard Time',
            'America/El_Salvador'                                                                                                                                                                                                                                                              => 'Central America Standard Time',
            'Etc/GMT+6'                                                                                                                                                                                                                                                                        => 'Central America Standard Time',
            'America/Chicago'                                                                                                                                                                                                                                                                  => 'Central Standard Time',
            'America/Winnipeg America/Rainy_River America/Rankin_Inlet America/Resolute'                                                                                                                                                                                                       => 'Central Standard Time',
            'America/Matamoros'                                                                                                                                                                                                                                                                => 'Central Standard Time',
            'America/Chicago America/Indiana/Knox America/Indiana/Tell_City America/Menominee America/North_Dakota/Beulah America/North_Dakota/Center America/North_Dakota/New_Salem'                                                                                                          => 'Central Standard Time',
            'CST6CDT'                                                                                                                                                                                                                                                                          => 'Central Standard Time',
            'America/Mexico_City'                                                                                                                                                                                                                                                              => 'Central Standard Time (Mexico)',
            'America/Mexico_City America/Bahia_Banderas America/Cancun America/Merida America/Monterrey'                                                                                                                                                                                       => 'Central Standard Time (Mexico)',
            'America/Regina'                                                                                                                                                                                                                                                                   => 'Canada Central Standard Time',
            'America/Regina America/Swift_Current'                                                                                                                                                                                                                                             => 'Canada Central Standard Time',
            'America/Bogota'                                                                                                                                                                                                                                                                   => 'SA Pacific Standard Time',
            'America/Rio_Branco America/Eirunepe'                                                                                                                                                                                                                                              => 'SA Pacific Standard Time',
            'America/Coral_Harbour'                                                                                                                                                                                                                                                            => 'SA Pacific Standard Time',
            'America/Guayaquil'                                                                                                                                                                                                                                                                => 'SA Pacific Standard Time',
            'America/Jamaica'                                                                                                                                                                                                                                                                  => 'SA Pacific Standard Time',
            'America/Cayman'                                                                                                                                                                                                                                                                   => 'SA Pacific Standard Time',
            'America/Panama'                                                                                                                                                                                                                                                                   => 'SA Pacific Standard Time',
            'America/Lima'                                                                                                                                                                                                                                                                     => 'SA Pacific Standard Time',
            'Etc/GMT+5'                                                                                                                                                                                                                                                                        => 'SA Pacific Standard Time',
            'America/New_York'                                                                                                                                                                                                                                                                 => 'Eastern Standard Time',
            'America/Nassau'                                                                                                                                                                                                                                                                   => 'Eastern Standard Time',
            'America/Toronto America/Iqaluit America/Montreal America/Nipigon America/Pangnirtung America/Thunder_Bay'                                                                                                                                                                         => 'Eastern Standard Time',
            'America/Havana'                                                                                                                                                                                                                                                                   => 'Eastern Standard Time',
            'America/Port-au-Prince'                                                                                                                                                                                                                                                           => 'Eastern Standard Time',
            'America/Grand_Turk'                                                                                                                                                                                                                                                               => 'Eastern Standard Time',
            'America/New_York America/Detroit America/Indiana/Petersburg America/Indiana/Vincennes America/Indiana/Winamac America/Kentucky/Monticello America/Louisville'                                                                                                                     => 'Eastern Standard Time',
            'EST5EDT'                                                                                                                                                                                                                                                                          => 'Eastern Standard Time',
            'America/Indianapolis'                                                                                                                                                                                                                                                             => 'US Eastern Standard Time',
            'America/Indianapolis America/Indiana/Marengo America/Indiana/Vevay'                                                                                                                                                                                                               => 'US Eastern Standard Time',
            'America/Caracas'                                                                                                                                                                                                                                                                  => 'Venezuela Standard Time',
            'America/Asuncion'                                                                                                                                                                                                                                                                 => 'Paraguay Standard Time',
            'America/Halifax'                                                                                                                                                                                                                                                                  => 'Atlantic Standard Time',
            'Atlantic/Bermuda'                                                                                                                                                                                                                                                                 => 'Atlantic Standard Time',
            'America/Halifax America/Glace_Bay America/Goose_Bay America/Moncton'                                                                                                                                                                                                              => 'Atlantic Standard Time',
            'America/Thule'                                                                                                                                                                                                                                                                    => 'Atlantic Standard Time',
            'America/Cuiaba'                                                                                                                                                                                                                                                                   => 'Central Brazilian Standard Time',
            'America/Cuiaba America/Campo_Grande'                                                                                                                                                                                                                                              => 'Central Brazilian Standard Time',
            'America/La_Paz'                                                                                                                                                                                                                                                                   => 'SA Western Standard Time',
            'America/Antigua'                                                                                                                                                                                                                                                                  => 'SA Western Standard Time',
            'America/Anguilla'                                                                                                                                                                                                                                                                 => 'SA Western Standard Time',
            'America/Aruba'                                                                                                                                                                                                                                                                    => 'SA Western Standard Time',
            'America/Barbados'                                                                                                                                                                                                                                                                 => 'SA Western Standard Time',
            'America/St_Barthelemy'                                                                                                                                                                                                                                                            => 'SA Western Standard Time',
            'America/Kralendijk'                                                                                                                                                                                                                                                               => 'SA Western Standard Time',
            'America/Manaus America/Boa_Vista America/Porto_Velho'                                                                                                                                                                                                                             => 'SA Western Standard Time',
            'America/Blanc-Sablon'                                                                                                                                                                                                                                                             => 'SA Western Standard Time',
            'America/Curacao'                                                                                                                                                                                                                                                                  => 'SA Western Standard Time',
            'America/Dominica'                                                                                                                                                                                                                                                                 => 'SA Western Standard Time',
            'America/Santo_Domingo'                                                                                                                                                                                                                                                            => 'SA Western Standard Time',
            'America/Grenada'                                                                                                                                                                                                                                                                  => 'SA Western Standard Time',
            'America/Guadeloupe'                                                                                                                                                                                                                                                               => 'SA Western Standard Time',
            'America/Guyana'                                                                                                                                                                                                                                                                   => 'SA Western Standard Time',
            'America/St_Kitts'                                                                                                                                                                                                                                                                 => 'SA Western Standard Time',
            'America/St_Lucia'                                                                                                                                                                                                                                                                 => 'SA Western Standard Time',
            'America/Marigot'                                                                                                                                                                                                                                                                  => 'SA Western Standard Time',
            'America/Martinique'                                                                                                                                                                                                                                                               => 'SA Western Standard Time',
            'America/Montserrat'                                                                                                                                                                                                                                                               => 'SA Western Standard Time',
            'America/Puerto_Rico'                                                                                                                                                                                                                                                              => 'SA Western Standard Time',
            'America/Lower_Princes'                                                                                                                                                                                                                                                            => 'SA Western Standard Time',
            'America/Port_of_Spain'                                                                                                                                                                                                                                                            => 'SA Western Standard Time',
            'America/St_Vincent'                                                                                                                                                                                                                                                               => 'SA Western Standard Time',
            'America/Tortola'                                                                                                                                                                                                                                                                  => 'SA Western Standard Time',
            'America/St_Thomas'                                                                                                                                                                                                                                                                => 'SA Western Standard Time',
            'Etc/GMT+4'                                                                                                                                                                                                                                                                        => 'SA Western Standard Time',
            'America/Santiago'                                                                                                                                                                                                                                                                 => 'Pacific SA Standard Time',
            'Antarctica/Palmer'                                                                                                                                                                                                                                                                => 'Pacific SA Standard Time',
            'America/St_Johns'                                                                                                                                                                                                                                                                 => 'Newfoundland Standard Time',
            'America/Sao_Paulo'                                                                                                                                                                                                                                                                => 'E. South America Standard Time',
            'America/Buenos_Aires'                                                                                                                                                                                                                                                             => 'Argentina Standard Time',
            'America/Buenos_Aires America/Argentina/La_Rioja America/Argentina/Rio_Gallegos America/Argentina/Salta America/Argentina/San_Juan America/Argentina/San_Luis America/Argentina/Tucuman America/Argentina/Ushuaia America/Catamarca America/Cordoba America/Jujuy America/Mendoza' => 'Argentina Standard Time',
            'America/Cayenne'                                                                                                                                                                                                                                                                  => 'SA Eastern Standard Time',
            'Antarctica/Rothera'                                                                                                                                                                                                                                                               => 'SA Eastern Standard Time',
            'America/Fortaleza America/Araguaina America/Belem America/Maceio America/Recife America/Santarem'                                                                                                                                                                                 => 'SA Eastern Standard Time',
            'Atlantic/Stanley'                                                                                                                                                                                                                                                                 => 'SA Eastern Standard Time',
            'America/Paramaribo'                                                                                                                                                                                                                                                               => 'SA Eastern Standard Time',
            'Etc/GMT+3'                                                                                                                                                                                                                                                                        => 'SA Eastern Standard Time',
            'America/Godthab'                                                                                                                                                                                                                                                                  => 'Greenland Standard Time',
            'America/Montevideo'                                                                                                                                                                                                                                                               => 'Montevideo Standard Time',
            'America/Bahia'                                                                                                                                                                                                                                                                    => 'Bahia Standard Time',
            'Etc/GMT+2'                                                                                                                                                                                                                                                                        => 'UTC-02',
            'America/Noronha'                                                                                                                                                                                                                                                                  => 'UTC-02',
            'Atlantic/South_Georgia'                                                                                                                                                                                                                                                           => 'UTC-02',
            'Atlantic/Azores'                                                                                                                                                                                                                                                                  => 'Azores Standard Time',
            'America/Scoresbysund'                                                                                                                                                                                                                                                             => 'Azores Standard Time',
            'Atlantic/Cape_Verde'                                                                                                                                                                                                                                                              => 'Cape Verde Standard Time',
            'Etc/GMT+1'                                                                                                                                                                                                                                                                        => 'Cape Verde Standard Time',
            'Africa/Casablanca'                                                                                                                                                                                                                                                                => 'Morocco Standard Time',
            'Africa/El_Aaiun'                                                                                                                                                                                                                                                                  => 'Morocco Standard Time',
            'Etc/GMT'                                                                                                                                                                                                                                                                          => 'UTC',
            'America/Danmarkshavn'                                                                                                                                                                                                                                                             => 'UTC',
            'Europe/London'                                                                                                                                                                                                                                                                    => 'GMT Standard Time',
            'Atlantic/Canary'                                                                                                                                                                                                                                                                  => 'GMT Standard Time',
            'Atlantic/Faeroe'                                                                                                                                                                                                                                                                  => 'GMT Standard Time',
            'Europe/Guernsey'                                                                                                                                                                                                                                                                  => 'GMT Standard Time',
            'Europe/Dublin'                                                                                                                                                                                                                                                                    => 'GMT Standard Time',
            'Europe/Isle_of_Man'                                                                                                                                                                                                                                                               => 'GMT Standard Time',
            'Europe/Jersey'                                                                                                                                                                                                                                                                    => 'GMT Standard Time',
            'Europe/Lisbon Atlantic/Madeira'                                                                                                                                                                                                                                                   => 'GMT Standard Time',
            'Atlantic/Reykjavik'                                                                                                                                                                                                                                                               => 'Greenwich Standard Time',
            'Africa/Ouagadougou'                                                                                                                                                                                                                                                               => 'Greenwich Standard Time',
            'Africa/Abidjan'                                                                                                                                                                                                                                                                   => 'Greenwich Standard Time',
            'Africa/Accra'                                                                                                                                                                                                                                                                     => 'Greenwich Standard Time',
            'Africa/Banjul'                                                                                                                                                                                                                                                                    => 'Greenwich Standard Time',
            'Africa/Conakry'                                                                                                                                                                                                                                                                   => 'Greenwich Standard Time',
            'Africa/Bissau'                                                                                                                                                                                                                                                                    => 'Greenwich Standard Time',
            'Africa/Monrovia'                                                                                                                                                                                                                                                                  => 'Greenwich Standard Time',
            'Africa/Bamako'                                                                                                                                                                                                                                                                    => 'Greenwich Standard Time',
            'Africa/Nouakchott'                                                                                                                                                                                                                                                                => 'Greenwich Standard Time',
            'Atlantic/St_Helena'                                                                                                                                                                                                                                                               => 'Greenwich Standard Time',
            'Africa/Freetown'                                                                                                                                                                                                                                                                  => 'Greenwich Standard Time',
            'Africa/Dakar'                                                                                                                                                                                                                                                                     => 'Greenwich Standard Time',
            'Africa/Sao_Tome'                                                                                                                                                                                                                                                                  => 'Greenwich Standard Time',
            'Africa/Lome'                                                                                                                                                                                                                                                                      => 'Greenwich Standard Time',
            'Europe/Berlin'                                                                                                                                                                                                                                                                    => 'W. Europe Standard Time',
            'Europe/Andorra'                                                                                                                                                                                                                                                                   => 'W. Europe Standard Time',
            'Europe/Vienna'                                                                                                                                                                                                                                                                    => 'W. Europe Standard Time',
            'Europe/Zurich'                                                                                                                                                                                                                                                                    => 'W. Europe Standard Time',
            'Europe/Berlin Europe/Busingen'                                                                                                                                                                                                                                                    => 'W. Europe Standard Time',
            'Europe/Gibraltar'                                                                                                                                                                                                                                                                 => 'W. Europe Standard Time',
            'Europe/Rome'                                                                                                                                                                                                                                                                      => 'W. Europe Standard Time',
            'Europe/Vaduz'                                                                                                                                                                                                                                                                     => 'W. Europe Standard Time',
            'Europe/Luxembourg'                                                                                                                                                                                                                                                                => 'W. Europe Standard Time',
            'Europe/Monaco'                                                                                                                                                                                                                                                                    => 'W. Europe Standard Time',
            'Europe/Malta'                                                                                                                                                                                                                                                                     => 'W. Europe Standard Time',
            'Europe/Amsterdam'                                                                                                                                                                                                                                                                 => 'W. Europe Standard Time',
            'Europe/Oslo'                                                                                                                                                                                                                                                                      => 'W. Europe Standard Time',
            'Europe/Stockholm'                                                                                                                                                                                                                                                                 => 'W. Europe Standard Time',
            'Arctic/Longyearbyen'                                                                                                                                                                                                                                                              => 'W. Europe Standard Time',
            'Europe/San_Marino'                                                                                                                                                                                                                                                                => 'W. Europe Standard Time',
            'Europe/Vatican'                                                                                                                                                                                                                                                                   => 'W. Europe Standard Time',
            'Europe/Budapest'                                                                                                                                                                                                                                                                  => 'Central Europe Standard Time',
            'Europe/Tirane'                                                                                                                                                                                                                                                                    => 'Central Europe Standard Time',
            'Europe/Prague'                                                                                                                                                                                                                                                                    => 'Central Europe Standard Time',
            'Europe/Podgorica'                                                                                                                                                                                                                                                                 => 'Central Europe Standard Time',
            'Europe/Belgrade'                                                                                                                                                                                                                                                                  => 'Central Europe Standard Time',
            'Europe/Ljubljana'                                                                                                                                                                                                                                                                 => 'Central Europe Standard Time',
            'Europe/Bratislava'                                                                                                                                                                                                                                                                => 'Central Europe Standard Time',
            'Europe/Paris'                                                                                                                                                                                                                                                                     => 'Romance Standard Time',
            'Europe/Brussels'                                                                                                                                                                                                                                                                  => 'Romance Standard Time',
            'Europe/Copenhagen'                                                                                                                                                                                                                                                                => 'Romance Standard Time',
            'Europe/Madrid Africa/Ceuta'                                                                                                                                                                                                                                                       => 'Romance Standard Time',
            'Europe/Warsaw'                                                                                                                                                                                                                                                                    => 'Central European Standard Time',
            'Europe/Sarajevo'                                                                                                                                                                                                                                                                  => 'Central European Standard Time',
            'Europe/Zagreb'                                                                                                                                                                                                                                                                    => 'Central European Standard Time',
            'Europe/Skopje'                                                                                                                                                                                                                                                                    => 'Central European Standard Time',
            'Africa/Lagos'                                                                                                                                                                                                                                                                     => 'W. Central Africa Standard Time',
            'Africa/Luanda'                                                                                                                                                                                                                                                                    => 'W. Central Africa Standard Time',
            'Africa/Porto-Novo'                                                                                                                                                                                                                                                                => 'W. Central Africa Standard Time',
            'Africa/Kinshasa'                                                                                                                                                                                                                                                                  => 'W. Central Africa Standard Time',
            'Africa/Bangui'                                                                                                                                                                                                                                                                    => 'W. Central Africa Standard Time',
            'Africa/Brazzaville'                                                                                                                                                                                                                                                               => 'W. Central Africa Standard Time',
            'Africa/Douala'                                                                                                                                                                                                                                                                    => 'W. Central Africa Standard Time',
            'Africa/Algiers'                                                                                                                                                                                                                                                                   => 'W. Central Africa Standard Time',
            'Africa/Libreville'                                                                                                                                                                                                                                                                => 'W. Central Africa Standard Time',
            'Africa/Malabo'                                                                                                                                                                                                                                                                    => 'W. Central Africa Standard Time',
            'Africa/Niamey'                                                                                                                                                                                                                                                                    => 'W. Central Africa Standard Time',
            'Africa/Ndjamena'                                                                                                                                                                                                                                                                  => 'W. Central Africa Standard Time',
            'Africa/Tunis'                                                                                                                                                                                                                                                                     => 'W. Central Africa Standard Time',
            'Etc/GMT-1'                                                                                                                                                                                                                                                                        => 'W. Central Africa Standard Time',
            'Africa/Windhoek'                                                                                                                                                                                                                                                                  => 'Namibia Standard Time',
            'Europe/Bucharest'                                                                                                                                                                                                                                                                 => 'GTB Standard Time',
            'Asia/Nicosia'                                                                                                                                                                                                                                                                     => 'GTB Standard Time',
            'Europe/Athens'                                                                                                                                                                                                                                                                    => 'GTB Standard Time',
            'Europe/Chisinau'                                                                                                                                                                                                                                                                  => 'GTB Standard Time',
            'Asia/Beirut'                                                                                                                                                                                                                                                                      => 'Middle East Standard Time',
            'Africa/Cairo'                                                                                                                                                                                                                                                                     => 'Egypt Standard Time',
            'Asia/Damascus'                                                                                                                                                                                                                                                                    => 'Syria Standard Time',
            'Africa/Johannesburg'                                                                                                                                                                                                                                                              => 'South Africa Standard Time',
            'Africa/Bujumbura'                                                                                                                                                                                                                                                                 => 'South Africa Standard Time',
            'Africa/Gaborone'                                                                                                                                                                                                                                                                  => 'South Africa Standard Time',
            'Africa/Lubumbashi'                                                                                                                                                                                                                                                                => 'South Africa Standard Time',
            'Africa/Maseru'                                                                                                                                                                                                                                                                    => 'South Africa Standard Time',
            'Africa/Blantyre'                                                                                                                                                                                                                                                                  => 'South Africa Standard Time',
            'Africa/Maputo'                                                                                                                                                                                                                                                                    => 'South Africa Standard Time',
            'Africa/Kigali'                                                                                                                                                                                                                                                                    => 'South Africa Standard Time',
            'Africa/Mbabane'                                                                                                                                                                                                                                                                   => 'South Africa Standard Time',
            'Africa/Lusaka'                                                                                                                                                                                                                                                                    => 'South Africa Standard Time',
            'Africa/Harare'                                                                                                                                                                                                                                                                    => 'South Africa Standard Time',
            'Etc/GMT-2'                                                                                                                                                                                                                                                                        => 'South Africa Standard Time',
            'Europe/Kiev'                                                                                                                                                                                                                                                                      => 'FLE Standard Time',
            'Europe/Mariehamn'                                                                                                                                                                                                                                                                 => 'FLE Standard Time',
            'Europe/Sofia'                                                                                                                                                                                                                                                                     => 'FLE Standard Time',
            'Europe/Tallinn'                                                                                                                                                                                                                                                                   => 'FLE Standard Time',
            'Europe/Helsinki'                                                                                                                                                                                                                                                                  => 'FLE Standard Time',
            'Europe/Vilnius'                                                                                                                                                                                                                                                                   => 'FLE Standard Time',
            'Europe/Riga'                                                                                                                                                                                                                                                                      => 'FLE Standard Time',
            'Europe/Kiev Europe/Simferopol Europe/Uzhgorod Europe/Zaporozhye'                                                                                                                                                                                                                  => 'FLE Standard Time',
            'Europe/Istanbul'                                                                                                                                                                                                                                                                  => 'Turkey Standard Time',
            'Asia/Jerusalem'                                                                                                                                                                                                                                                                   => 'Israel Standard Time',
            'Africa/Tripoli'                                                                                                                                                                                                                                                                   => 'Libya Standard Time',
            'Asia/Amman'                                                                                                                                                                                                                                                                       => 'Jordan Standard Time',
            'Asia/Baghdad'                                                                                                                                                                                                                                                                     => 'Arabic Standard Time',
            'Europe/Kaliningrad'                                                                                                                                                                                                                                                               => 'Kaliningrad Standard Time',
            'Europe/Minsk'                                                                                                                                                                                                                                                                     => 'Kaliningrad Standard Time',
            'Asia/Riyadh'                                                                                                                                                                                                                                                                      => 'Arab Standard Time',
            'Asia/Bahrain'                                                                                                                                                                                                                                                                     => 'Arab Standard Time',
            'Asia/Kuwait'                                                                                                                                                                                                                                                                      => 'Arab Standard Time',
            'Asia/Qatar'                                                                                                                                                                                                                                                                       => 'Arab Standard Time',
            'Asia/Aden'                                                                                                                                                                                                                                                                        => 'Arab Standard Time',
            'Africa/Nairobi'                                                                                                                                                                                                                                                                   => 'E. Africa Standard Time',
            'Antarctica/Syowa'                                                                                                                                                                                                                                                                 => 'E. Africa Standard Time',
            'Africa/Djibouti'                                                                                                                                                                                                                                                                  => 'E. Africa Standard Time',
            'Africa/Asmera'                                                                                                                                                                                                                                                                    => 'E. Africa Standard Time',
            'Africa/Addis_Ababa'                                                                                                                                                                                                                                                               => 'E. Africa Standard Time',
            'Indian/Comoro'                                                                                                                                                                                                                                                                    => 'E. Africa Standard Time',
            'Indian/Antananarivo'                                                                                                                                                                                                                                                              => 'E. Africa Standard Time',
            'Africa/Khartoum'                                                                                                                                                                                                                                                                  => 'E. Africa Standard Time',
            'Africa/Mogadishu'                                                                                                                                                                                                                                                                 => 'E. Africa Standard Time',
            'Africa/Juba'                                                                                                                                                                                                                                                                      => 'E. Africa Standard Time',
            'Africa/Dar_es_Salaam'                                                                                                                                                                                                                                                             => 'E. Africa Standard Time',
            'Africa/Kampala'                                                                                                                                                                                                                                                                   => 'E. Africa Standard Time',
            'Indian/Mayotte'                                                                                                                                                                                                                                                                   => 'E. Africa Standard Time',
            'Etc/GMT-3'                                                                                                                                                                                                                                                                        => 'E. Africa Standard Time',
            'Asia/Tehran'                                                                                                                                                                                                                                                                      => 'Iran Standard Time',
            'Asia/Dubai'                                                                                                                                                                                                                                                                       => 'Arabian Standard Time',
            'Asia/Muscat'                                                                                                                                                                                                                                                                      => 'Arabian Standard Time',
            'Etc/GMT-4'                                                                                                                                                                                                                                                                        => 'Arabian Standard Time',
            'Asia/Baku'                                                                                                                                                                                                                                                                        => 'Azerbaijan Standard Time',
            'Europe/Moscow'                                                                                                                                                                                                                                                                    => 'Russian Standard Time',
            'Europe/Moscow Europe/Samara Europe/Volgograd'                                                                                                                                                                                                                                     => 'Russian Standard Time',
            'Indian/Mauritius'                                                                                                                                                                                                                                                                 => 'Mauritius Standard Time',
            'Indian/Reunion'                                                                                                                                                                                                                                                                   => 'Mauritius Standard Time',
            'Indian/Mahe'                                                                                                                                                                                                                                                                      => 'Mauritius Standard Time',
            'Asia/Tbilisi'                                                                                                                                                                                                                                                                     => 'Georgian Standard Time',
            'Asia/Yerevan'                                                                                                                                                                                                                                                                     => 'Caucasus Standard Time',
            'Asia/Kabul'                                                                                                                                                                                                                                                                       => 'Afghanistan Standard Time',
            'Asia/Tashkent'                                                                                                                                                                                                                                                                    => 'West Asia Standard Time',
            'Antarctica/Mawson'                                                                                                                                                                                                                                                                => 'West Asia Standard Time',
            'Asia/Oral Asia/Aqtau Asia/Aqtobe'                                                                                                                                                                                                                                                 => 'West Asia Standard Time',
            'Indian/Maldives'                                                                                                                                                                                                                                                                  => 'West Asia Standard Time',
            'Indian/Kerguelen'                                                                                                                                                                                                                                                                 => 'West Asia Standard Time',
            'Asia/Dushanbe'                                                                                                                                                                                                                                                                    => 'West Asia Standard Time',
            'Asia/Ashgabat'                                                                                                                                                                                                                                                                    => 'West Asia Standard Time',
            'Asia/Tashkent Asia/Samarkand'                                                                                                                                                                                                                                                     => 'West Asia Standard Time',
            'Etc/GMT-5'                                                                                                                                                                                                                                                                        => 'West Asia Standard Time',
            'Asia/Karachi'                                                                                                                                                                                                                                                                     => 'Pakistan Standard Time',
            'Asia/Calcutta'                                                                                                                                                                                                                                                                    => 'India Standard Time',
            'Asia/Colombo'                                                                                                                                                                                                                                                                     => 'Sri Lanka Standard Time',
            'Asia/Katmandu'                                                                                                                                                                                                                                                                    => 'Nepal Standard Time',
            'Asia/Almaty'                                                                                                                                                                                                                                                                      => 'Central Asia Standard Time',
            'Antarctica/Vostok'                                                                                                                                                                                                                                                                => 'Central Asia Standard Time',
            'Indian/Chagos'                                                                                                                                                                                                                                                                    => 'Central Asia Standard Time',
            'Asia/Bishkek'                                                                                                                                                                                                                                                                     => 'Central Asia Standard Time',
            'Asia/Almaty Asia/Qyzylorda'                                                                                                                                                                                                                                                       => 'Central Asia Standard Time',
            'Etc/GMT-6'                                                                                                                                                                                                                                                                        => 'Central Asia Standard Time',
            'Asia/Dhaka'                                                                                                                                                                                                                                                                       => 'Bangladesh Standard Time',
            'Asia/Thimphu'                                                                                                                                                                                                                                                                     => 'Bangladesh Standard Time',
            'Asia/Yekaterinburg'                                                                                                                                                                                                                                                               => 'Ekaterinburg Standard Time',
            'Asia/Rangoon'                                                                                                                                                                                                                                                                     => 'Myanmar Standard Time',
            'Indian/Cocos'                                                                                                                                                                                                                                                                     => 'Myanmar Standard Time',
            'Asia/Bangkok'                                                                                                                                                                                                                                                                     => 'SE Asia Standard Time',
            'Antarctica/Davis'                                                                                                                                                                                                                                                                 => 'SE Asia Standard Time',
            'Indian/Christmas'                                                                                                                                                                                                                                                                 => 'SE Asia Standard Time',
            'Asia/Jakarta Asia/Pontianak'                                                                                                                                                                                                                                                      => 'SE Asia Standard Time',
            'Asia/Phnom_Penh'                                                                                                                                                                                                                                                                  => 'SE Asia Standard Time',
            'Asia/Vientiane'                                                                                                                                                                                                                                                                   => 'SE Asia Standard Time',
            'Asia/Hovd'                                                                                                                                                                                                                                                                        => 'SE Asia Standard Time',
            'Asia/Saigon'                                                                                                                                                                                                                                                                      => 'SE Asia Standard Time',
            'Etc/GMT-7'                                                                                                                                                                                                                                                                        => 'SE Asia Standard Time',
            'Asia/Novosibirsk'                                                                                                                                                                                                                                                                 => 'N. Central Asia Standard Time',
            'Asia/Novosibirsk Asia/Novokuznetsk Asia/Omsk'                                                                                                                                                                                                                                     => 'N. Central Asia Standard Time',
            'Asia/Shanghai'                                                                                                                                                                                                                                                                    => 'China Standard Time',
            'Asia/Shanghai Asia/Chongqing Asia/Harbin Asia/Kashgar Asia/Urumqi'                                                                                                                                                                                                                => 'China Standard Time',
            'Asia/Hong_Kong'                                                                                                                                                                                                                                                                   => 'China Standard Time',
            'Asia/Macau'                                                                                                                                                                                                                                                                       => 'China Standard Time',
            'Asia/Krasnoyarsk'                                                                                                                                                                                                                                                                 => 'North Asia Standard Time',
            'Asia/Singapore'                                                                                                                                                                                                                                                                   => 'Singapore Standard Time',
            'Asia/Brunei'                                                                                                                                                                                                                                                                      => 'Singapore Standard Time',
            'Asia/Makassar'                                                                                                                                                                                                                                                                    => 'Singapore Standard Time',
            'Asia/Kuala_Lumpur Asia/Kuching'                                                                                                                                                                                                                                                   => 'Singapore Standard Time',
            'Asia/Manila'                                                                                                                                                                                                                                                                      => 'Singapore Standard Time',
            'Etc/GMT-8'                                                                                                                                                                                                                                                                        => 'Singapore Standard Time',
            'Australia/Perth'                                                                                                                                                                                                                                                                  => 'W. Australia Standard Time',
            'Antarctica/Casey'                                                                                                                                                                                                                                                                 => 'W. Australia Standard Time',
            'Asia/Taipei'                                                                                                                                                                                                                                                                      => 'Taipei Standard Time',
            'Asia/Ulaanbaatar'                                                                                                                                                                                                                                                                 => 'Ulaanbaatar Standard Time',
            'Asia/Ulaanbaatar Asia/Choibalsan'                                                                                                                                                                                                                                                 => 'Ulaanbaatar Standard Time',
            'Asia/Irkutsk'                                                                                                                                                                                                                                                                     => 'North Asia East Standard Time',
            'Asia/Tokyo'                                                                                                                                                                                                                                                                       => 'Tokyo Standard Time',
            'Asia/Jayapura'                                                                                                                                                                                                                                                                    => 'Tokyo Standard Time',
            'Pacific/Palau'                                                                                                                                                                                                                                                                    => 'Tokyo Standard Time',
            'Asia/Dili'                                                                                                                                                                                                                                                                        => 'Tokyo Standard Time',
            'Etc/GMT-9'                                                                                                                                                                                                                                                                        => 'Tokyo Standard Time',
            'Asia/Seoul'                                                                                                                                                                                                                                                                       => 'Korea Standard Time',
            'Asia/Pyongyang'                                                                                                                                                                                                                                                                   => 'Korea Standard Time',
            'Australia/Adelaide'                                                                                                                                                                                                                                                               => 'Cen. Australia Standard Time',
            'Australia/Adelaide Australia/Broken_Hill'                                                                                                                                                                                                                                         => 'Cen. Australia Standard Time',
            'Australia/Darwin'                                                                                                                                                                                                                                                                 => 'AUS Central Standard Time',
            'Australia/Brisbane'                                                                                                                                                                                                                                                               => 'E. Australia Standard Time',
            'Australia/Brisbane Australia/Lindeman'                                                                                                                                                                                                                                            => 'E. Australia Standard Time',
            'Australia/Sydney'                                                                                                                                                                                                                                                                 => 'AUS Eastern Standard Time',
            'Australia/Sydney Australia/Melbourne'                                                                                                                                                                                                                                             => 'AUS Eastern Standard Time',
            'Pacific/Port_Moresby'                                                                                                                                                                                                                                                             => 'West Pacific Standard Time',
            'Antarctica/DumontDUrville'                                                                                                                                                                                                                                                        => 'West Pacific Standard Time',
            'Pacific/Truk'                                                                                                                                                                                                                                                                     => 'West Pacific Standard Time',
            'Pacific/Guam'                                                                                                                                                                                                                                                                     => 'West Pacific Standard Time',
            'Pacific/Saipan'                                                                                                                                                                                                                                                                   => 'West Pacific Standard Time',
            'Etc/GMT-10'                                                                                                                                                                                                                                                                       => 'West Pacific Standard Time',
            'Australia/Hobart'                                                                                                                                                                                                                                                                 => 'Tasmania Standard Time',
            'Australia/Hobart Australia/Currie'                                                                                                                                                                                                                                                => 'Tasmania Standard Time',
            'Asia/Yakutsk'                                                                                                                                                                                                                                                                     => 'Yakutsk Standard Time',
            'Asia/Yakutsk Asia/Khandyga'                                                                                                                                                                                                                                                       => 'Yakutsk Standard Time',
            'Pacific/Guadalcanal'                                                                                                                                                                                                                                                              => 'Central Pacific Standard Time',
            'Antarctica/Macquarie'                                                                                                                                                                                                                                                             => 'Central Pacific Standard Time',
            'Pacific/Ponape Pacific/Kosrae'                                                                                                                                                                                                                                                    => 'Central Pacific Standard Time',
            'Pacific/Noumea'                                                                                                                                                                                                                                                                   => 'Central Pacific Standard Time',
            'Pacific/Efate'                                                                                                                                                                                                                                                                    => 'Central Pacific Standard Time',
            'Etc/GMT-11'                                                                                                                                                                                                                                                                       => 'Central Pacific Standard Time',
            'Asia/Vladivostok'                                                                                                                                                                                                                                                                 => 'Vladivostok Standard Time',
            'Asia/Vladivostok Asia/Sakhalin Asia/Ust-Nera'                                                                                                                                                                                                                                     => 'Vladivostok Standard Time',
            'Pacific/Auckland'                                                                                                                                                                                                                                                                 => 'New Zealand Standard Time',
            'Antarctica/McMurdo'                                                                                                                                                                                                                                                               => 'New Zealand Standard Time',
            'Pacific/Auckland Antarctica/South_Pole'                                                                                                                                                                                                                                           => 'New Zealand Standard Time',
            'Etc/GMT-12'                                                                                                                                                                                                                                                                       => 'UTC+12',
            'Pacific/Tarawa'                                                                                                                                                                                                                                                                   => 'UTC+12',
            'Pacific/Majuro Pacific/Kwajalein'                                                                                                                                                                                                                                                 => 'UTC+12',
            'Pacific/Nauru'                                                                                                                                                                                                                                                                    => 'UTC+12',
            'Pacific/Funafuti'                                                                                                                                                                                                                                                                 => 'UTC+12',
            'Pacific/Wake'                                                                                                                                                                                                                                                                     => 'UTC+12',
            'Pacific/Wallis'                                                                                                                                                                                                                                                                   => 'UTC+12',
            'Pacific/Fiji'                                                                                                                                                                                                                                                                     => 'Fiji Standard Time',
            'Asia/Magadan'                                                                                                                                                                                                                                                                     => 'Magadan Standard Time',
            'Asia/Magadan Asia/Anadyr Asia/Kamchatka'                                                                                                                                                                                                                                          => 'Magadan Standard Time',
            'Pacific/Tongatapu'                                                                                                                                                                                                                                                                => 'Tonga Standard Time',
            'Pacific/Enderbury'                                                                                                                                                                                                                                                                => 'Tonga Standard Time',
            'Pacific/Fakaofo'                                                                                                                                                                                                                                                                  => 'Tonga Standard Time',
            'Etc/GMT-13'                                                                                                                                                                                                                                                                       => 'Tonga Standard Time',
            'Pacific/Apia'                                                                                                                                                                                                                                                                     => 'Samoa Standard Time',
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'windowstotimezone', 'Pacific/Fiji');
        $this->assertEquals("Fiji Standard Time", $value);
    }

    /**
     * test for reading territorytotimezone from locale
     * expected array
     */
    public function testTerritoryToTimezone()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'territorytotimezone');
        $result = ['America/Rio_Branco' => '001', 'Asia/Kabul' => '001',
            'Africa/Maputo' => '001', 'Africa/Bujumbura' => 'BI', 'Africa/Gaborone' => 'BW',
            'Africa/Lubumbashi' => 'CD', 'Africa/Blantyre' => 'MW', 'Africa/Kigali' => 'RW',
            'Africa/Lusaka' => 'ZM', 'Africa/Harare' => 'ZW', 'Africa/Nairobi' => '001',
            'Africa/Djibouti' => 'DJ', 'Africa/Asmera' => 'ER', 'Africa/Addis_Ababa' => 'ET',
            'Indian/Comoro' => 'KM', 'Indian/Antananarivo' => 'MG', 'Africa/Mogadishu' => 'SO',
            'Africa/Dar_es_Salaam' => 'TZ', 'Africa/Kampala' => 'UG', 'Indian/Mayotte' => 'YT',
            'Africa/El_Aaiun' => '001', 'Africa/Johannesburg' => '001', 'Africa/Maseru' => 'LS',
            'Africa/Mbabane' => 'SZ', 'Africa/Lagos' => '001', 'Africa/Luanda' => 'AO',
            'Africa/Porto-Novo' => 'BJ', 'Africa/Kinshasa' => 'CD', 'Africa/Bangui' => 'CF',
            'Africa/Brazzaville' => 'CG', 'Africa/Douala' => 'CM', 'Africa/Libreville' => 'GA',
            'Africa/Malabo' => 'GQ', 'Africa/Niamey' => 'NE', 'Africa/Ndjamena' => 'TD',
            'Asia/Aqtobe' => '001', 'America/Juneau' => '001', 'America/Anchorage' => '001',
            'Asia/Almaty' => '001', 'America/Manaus' => '001', 'America/Chicago' => '001',
            'America/Belize' => 'BZ', 'America/Winnipeg' => 'CA', 'America/Costa_Rica' => 'CR',
  'America/Guatemala' => 'GT', 'America/Tegucigalpa' => 'HN', 'America/Mexico_City' => 'MX',
  'America/El_Salvador' => 'SV', 'America/New_York' => '001', 'America/Nassau' => 'BS',
  'America/Toronto' => 'CA', 'America/Port-au-Prince' => 'HT', 'America/Jamaica' => 'JM',
  'America/Cayman' => 'KY', 'America/Panama' => 'PA', 'America/Grand_Turk' => 'TC',
  'America/Denver' => '001', 'America/Edmonton' => 'CA',
                        'America/Hermosillo' => 'MX',
                        'America/Los_Angeles' => '001',
                        'America/Vancouver' => 'CA',
                        'America/Tijuana' => 'MX',
                        'Asia/Anadyr' => '001',
                        'Asia/Aqtau' => '001',
                        'Asia/Riyadh' => '001',
                        'Asia/Bahrain' => 'BH',
                        'Asia/Baghdad' => 'IQ',
                        'Asia/Kuwait' => 'KW',
                        'Asia/Qatar' => 'QA',
                        'Asia/Aden' => 'YE',
                        'America/Buenos_Aires' => '001',
                        'America/Argentina/San_Luis' => '001',
                        'Asia/Yerevan' => '001',
                        'Asia/Ashgabat' => '001',
                        'America/Halifax' => '001',
                        'America/Antigua' => 'AG',
                        'America/Anguilla' => 'AI',
                        'America/Curacao' => 'AN',
                        'America/Aruba' => 'AW',
                        'America/Barbados' => 'BB',
                        'Atlantic/Bermuda' => 'BM',
                        'America/Kralendijk' => 'BQ',
                        'America/Dominica' => 'DM',
                        'America/Grenada' => 'GD',
                        'America/Thule' => 'GL',
                        'America/Guadeloupe' => 'GP',
                        'America/St_Kitts' => 'KN',
                        'America/St_Lucia' => 'LC',
                        'America/Marigot' => 'MF',
                        'America/Martinique' => 'MQ',
                        'America/Montserrat' => 'MS',
                        'America/Puerto_Rico' => 'PR',
                        'America/Lower_Princes' => 'SX',
                        'America/Port_of_Spain' => 'TT',
                        'America/St_Vincent' => 'VC',
                        'America/Tortola' => 'VG',
                        'America/St_Thomas' => 'VI',
                        'Australia/Adelaide' => '001',
                        'Australia/Eucla' => '001',
                        'Australia/Sydney' => '001',
                        'Australia/Perth' => '001',
                        'Asia/Baku' => '001',
                        'Atlantic/Azores' => '001',
                        'Asia/Dhaka' => '001',
                        'America/Adak' => '001',
                        'Asia/Thimphu' => '001',
                        'America/La_Paz' => '001',
                        'Asia/Kuching' => '001',
                        'America/Sao_Paulo' => '001',
                        'Europe/London' => '001',
                        'Asia/Brunei' => '001',
                        'Atlantic/Cape_Verde' => '001',
                        'Antarctica/Casey' => '001',
                        'Pacific/Saipan' => '001',
                        'Pacific/Guam' => 'GU',
                        'Asia/Harbin' => '001',
                        'Pacific/Chatham' => '001',
                        'America/Santiago' => '001',
                        'Antarctica/Palmer' => 'AQ',
                        'Asia/Shanghai' => '001',
                        'Asia/Choibalsan' => '001',
                        'Indian/Christmas' => '001',
                        'Indian/Cocos' => '001',
                        'America/Bogota' => '001',
                        'Pacific/Rarotonga' => '001',
                        'America/Havana' => '001',
                        'Antarctica/Davis' => '001',
                        'America/Santo_Domingo' => '001',
                        'Antarctica/DumontDUrville' => '001',
                        'Asia/Dushanbe' => '001',
                        'America/Paramaribo' => '001',
                        'Asia/Dili' => '001',
                        'Pacific/Easter' => '001',
                        'America/Guayaquil' => '001',
                        'Europe/Paris' => '001',
                        'Europe/Andorra' => 'AD',
                        'Europe/Tirane' => 'AL',
                        'Europe/Vienna' => 'AT',
                        'Europe/Sarajevo' => 'BA',
                        'Europe/Brussels' => 'BE',
                        'Europe/Zurich' => 'CH',
                        'Europe/Prague' => 'CZ',
                        'Europe/Berlin' => 'DE',
                        'Europe/Copenhagen' => 'DK',
                        'Europe/Madrid' => 'ES',
                        'Europe/Gibraltar' => 'GI',
                        'Europe/Zagreb' => 'HR',
                        'Europe/Budapest' => 'HU',
                        'Europe/Rome' => 'IT',
                        'Europe/Vaduz' => 'LI',
                        'Europe/Luxembourg' => 'LU',
                        'Europe/Monaco' => 'MC',
                        'Europe/Podgorica' => 'ME',
                        'Europe/Skopje' => 'MK',
                        'Europe/Malta' => 'MT',
                        'Europe/Amsterdam' => 'NL',
                        'Europe/Oslo' => 'NO',
                        'Europe/Warsaw' => 'PL',
                        'Europe/Belgrade' => 'RS',
                        'Europe/Stockholm' => 'SE',
                        'Europe/Ljubljana' => 'SI',
                        'Europe/Bratislava' => 'SK',
                        'Europe/San_Marino' => 'SM',
                        'Africa/Tunis' => 'TN',
                        'Europe/Vatican' => 'VA',
                        'Europe/Bucharest' => '001',
                        'Europe/Mariehamn' => 'AX',
                        'Europe/Sofia' => 'BG',
                        'Asia/Nicosia' => 'CY',
                        'Africa/Cairo' => 'EG',
                        'Europe/Helsinki' => 'FI',
                        'Europe/Athens' => 'GR',
                        'Asia/Amman' => 'JO',
                        'Asia/Beirut' => 'LB',
                        'Asia/Damascus' => 'SY',
                        'Atlantic/Canary' => '001',
                        'Atlantic/Faeroe' => 'FO',
                        'Atlantic/Stanley' => '001',
                        'Pacific/Fiji' => '001',
                        'America/Cayenne' => '001',
                        'Indian/Kerguelen' => '001',
                        'Asia/Bishkek' => '001',
                        'Pacific/Galapagos' => '001',
                        'Pacific/Gambier' => '001',
                        'Asia/Tbilisi' => '001',
                        'Pacific/Tarawa' => '001',
                        'Atlantic/Reykjavik' => '001',
                        'Africa/Ouagadougou' => 'BF',
                        'Africa/Abidjan' => 'CI',
                        'Africa/Accra' => 'GH',
                        'Africa/Banjul' => 'GM',
                        'Africa/Conakry' => 'GN',
                        'Europe/Dublin' => 'IE',
                        'Africa/Bamako' => 'ML',
                        'Africa/Nouakchott' => 'MR',
                        'Atlantic/St_Helena' => 'SH',
                        'Africa/Freetown' => 'SL',
                        'Africa/Dakar' => 'SN',
                        'Africa/Sao_Tome' => 'ST',
                        'Africa/Lome' => 'TG',
                        'America/Goose_Bay' => '001',
                        'America/Scoresbysund' => '001',
                        'America/Godthab' => '001',
                        'Asia/Dubai' => '001',
                        'Asia/Muscat' => 'OM',
                        'America/Guyana' => '001',
                        'Pacific/Honolulu' => '001',
                        'Asia/Hong_Kong' => '001',
                        'Asia/Hovd' => '001',
                        'Asia/Calcutta' => '001',
                        'Asia/Colombo' => 'LK',
                        'Indian/Chagos' => '001',
                        'Asia/Saigon' => '001',
                        'Asia/Phnom_Penh' => 'KH',
                        'Asia/Vientiane' => 'LA',
                        'Asia/Bangkok' => 'TH',
                        'Asia/Makassar' => '001',
                        'Asia/Jayapura' => '001',
                        'Asia/Jakarta' => '001',
                        'Asia/Tehran' => '001',
                        'Asia/Irkutsk' => '001',
                        'Asia/Jerusalem' => '001',
                        'Asia/Tokyo' => '001',
                        'Asia/Kamchatka' => '001',
                        'Asia/Karachi' => '001',
                        'Asia/Kashgar' => '001',
                        'Asia/Qyzylorda' => '001',
                        'Asia/Seoul' => '001',
                        'Asia/Pyongyang' => 'KP',
                        'Pacific/Kosrae' => '001',
                        'Asia/Krasnoyarsk' => '001',
                        'Europe/Samara' => '001',
                        'Pacific/Kwajalein' => '001',
                        'Africa/Monrovia' => '001',
                        'Pacific/Kiritimati' => '001',
                        'Asia/Chongqing' => '001',
                        'Australia/Lord_Howe' => '001',
                        'Asia/Macau' => '001',
                        'Antarctica/Macquarie' => '001',
                        'Asia/Magadan' => '001',
                        'Asia/Kuala_Lumpur' => '001',
                        'Indian/Maldives' => '001',
                        'Pacific/Marquesas' => '001',
                        'Pacific/Majuro' => '001',
                        'Indian/Mauritius' => '001',
                        'Antarctica/Mawson' => '001',
                        'America/Santa_Isabel' => '001',
                        'America/Mazatlan' => '001',
                        'Asia/Ulaanbaatar' => '001',
                        'Europe/Moscow' => '001',
                        'Asia/Rangoon' => '001',
                        'Pacific/Nauru' => '001',
                        'Asia/Katmandu' => '001',
                        'Pacific/Noumea' => '001',
                        'Pacific/Auckland' => '001',
                        'Antarctica/McMurdo' => 'AQ',
                        'America/St_Johns' => '001',
                        'Pacific/Niue' => '001',
                        'Pacific/Norfolk' => '001',
                        'America/Noronha' => '001',
                        'Asia/Novosibirsk' => '001',
                        'Asia/Omsk' => '001',
                        'Asia/Oral' => '001',
                        'Pacific/Palau' => '001',
                        'Pacific/Port_Moresby' => '001',
                        'America/Asuncion' => '001',
                        'America/Lima' => '001',
                        'Asia/Manila' => '001',
                        'Pacific/Enderbury' => '001',
                        'America/Miquelon' => '001',
                        'Pacific/Pitcairn' => '001',
                        'Pacific/Ponape' => '001',
                        'Indian/Reunion' => '001',
                        'Antarctica/Rothera' => '001',
                        'Asia/Sakhalin' => '001',
                        'Asia/Samarkand' => '001',
                        'Pacific/Apia' => '001',
                        'Indian/Mahe' => '001',
                        'Asia/Singapore' => '001',
                        'Pacific/Guadalcanal' => '001',
                        'Atlantic/South_Georgia' => '001',
                        'Asia/Yekaterinburg' => '001',
                        'Antarctica/Syowa' => '001',
                        'Pacific/Tahiti' => '001',
                        'Asia/Taipei' => '001',
                        'Asia/Tashkent' => '001',
                        'Pacific/Fakaofo' => '001',
                        'Pacific/Tongatapu' => '001',
                        'Pacific/Truk' => '001',
                        'Europe/Istanbul' => '001',
                        'Pacific/Funafuti' => '001',
                        'America/Montevideo' => '001',
                        'Asia/Urumqi' => '001',
                        'Pacific/Efate' => '001',
                        'America/Caracas' => '001',
                        'Asia/Vladivostok' => '001',
                        'Europe/Volgograd' => '001',
                        'Antarctica/Vostok' => '001',
                        'Pacific/Wake' => '001',
                        'Pacific/Wallis' => '001',
                        'Asia/Yakutsk' => '001',
                        'America/Yakutat' => '001'];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'territorytotimezone', 'Antarctica/Vostok');
        $this->assertEquals("001", $value);
    }

    /**
     * test for reading timezonetoterritory from locale
     * expected array
     */
    public function testTimezoneToTerritory()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'timezonetoterritory');
        $result = [
            '001' => 'America/Rio_Branco',
            'BI'  => 'Africa/Bujumbura',
            'BW'  => 'Africa/Gaborone',
            'CD'  => 'Africa/Lubumbashi',
            'MW'  => 'Africa/Blantyre',
            'RW'  => 'Africa/Kigali',
            'ZM'  => 'Africa/Lusaka',
            'ZW'  => 'Africa/Harare',
            'DJ'  => 'Africa/Djibouti',
            'ER'  => 'Africa/Asmera',
            'ET'  => 'Africa/Addis_Ababa',
            'KM'  => 'Indian/Comoro',
            'MG'  => 'Indian/Antananarivo',
            'SO'  => 'Africa/Mogadishu',
            'TZ'  => 'Africa/Dar_es_Salaam',
            'UG'  => 'Africa/Kampala',
            'YT'  => 'Indian/Mayotte',
            'LS'  => 'Africa/Maseru',
            'SZ'  => 'Africa/Mbabane',
            'AO'  => 'Africa/Luanda',
            'BJ'  => 'Africa/Porto-Novo',
            'CF'  => 'Africa/Bangui',
            'CG'  => 'Africa/Brazzaville',
            'CM'  => 'Africa/Douala',
            'GA'  => 'Africa/Libreville',
            'GQ'  => 'Africa/Malabo',
            'NE'  => 'Africa/Niamey',
            'TD'  => 'Africa/Ndjamena',
            'BZ'  => 'America/Belize',
            'CA'  => 'America/Winnipeg',
            'CR'  => 'America/Costa_Rica',
            'GT'  => 'America/Guatemala',
            'HN'  => 'America/Tegucigalpa',
            'MX'  => 'America/Mexico_City',
            'SV'  => 'America/El_Salvador',
            'BS'  => 'America/Nassau',
            'HT'  => 'America/Port-au-Prince',
            'JM'  => 'America/Jamaica',
            'KY'  => 'America/Cayman',
            'PA'  => 'America/Panama',
            'TC'  => 'America/Grand_Turk',
            'BH'  => 'Asia/Bahrain',
            'IQ'  => 'Asia/Baghdad',
            'KW'  => 'Asia/Kuwait',
            'QA'  => 'Asia/Qatar',
            'YE'  => 'Asia/Aden',
            'AG'  => 'America/Antigua',
            'AI'  => 'America/Anguilla',
            'AN'  => 'America/Curacao',
            'AW'  => 'America/Aruba',
            'BB'  => 'America/Barbados',
            'BM'  => 'Atlantic/Bermuda',
            'BQ'  => 'America/Kralendijk',
            'DM'  => 'America/Dominica',
            'GD'  => 'America/Grenada',
            'GL'  => 'America/Thule',
            'GP'  => 'America/Guadeloupe',
            'KN'  => 'America/St_Kitts',
            'LC'  => 'America/St_Lucia',
            'MF'  => 'America/Marigot',
            'MQ'  => 'America/Martinique',
            'MS'  => 'America/Montserrat',
            'PR'  => 'America/Puerto_Rico',
            'SX'  => 'America/Lower_Princes',
            'TT'  => 'America/Port_of_Spain',
            'VC'  => 'America/St_Vincent',
            'VG'  => 'America/Tortola',
            'VI'  => 'America/St_Thomas',
            'GU'  => 'Pacific/Guam',
            'AQ'  => 'Antarctica/Palmer',
            'AD'  => 'Europe/Andorra',
            'AL'  => 'Europe/Tirane',
            'AT'  => 'Europe/Vienna',
            'BA'  => 'Europe/Sarajevo',
            'BE'  => 'Europe/Brussels',
            'CH'  => 'Europe/Zurich',
            'CZ'  => 'Europe/Prague',
            'DE'  => 'Europe/Berlin',
            'DK'  => 'Europe/Copenhagen',
            'ES'  => 'Europe/Madrid',
            'GI'  => 'Europe/Gibraltar',
            'HR'  => 'Europe/Zagreb',
            'HU'  => 'Europe/Budapest',
            'IT'  => 'Europe/Rome',
            'LI'  => 'Europe/Vaduz',
            'LU'  => 'Europe/Luxembourg',
            'MC'  => 'Europe/Monaco',
            'ME'  => 'Europe/Podgorica',
            'MK'  => 'Europe/Skopje',
            'MT'  => 'Europe/Malta',
            'NL'  => 'Europe/Amsterdam',
            'NO'  => 'Europe/Oslo',
            'PL'  => 'Europe/Warsaw',
            'RS'  => 'Europe/Belgrade',
            'SE'  => 'Europe/Stockholm',
            'SI'  => 'Europe/Ljubljana',
            'SK'  => 'Europe/Bratislava',
            'SM'  => 'Europe/San_Marino',
            'TN'  => 'Africa/Tunis',
            'VA'  => 'Europe/Vatican',
            'XK'  => 'Europe/Belgrade',
            'AX'  => 'Europe/Mariehamn',
            'BG'  => 'Europe/Sofia',
            'CY'  => 'Asia/Nicosia',
            'EG'  => 'Africa/Cairo',
            'FI'  => 'Europe/Helsinki',
            'GR'  => 'Europe/Athens',
            'JO'  => 'Asia/Amman',
            'LB'  => 'Asia/Beirut',
            'SY'  => 'Asia/Damascus',
            'FO'  => 'Atlantic/Faeroe',
            'BF'  => 'Africa/Ouagadougou',
            'CI'  => 'Africa/Abidjan',
            'GB'  => 'Europe/London',
            'GH'  => 'Africa/Accra',
            'GM'  => 'Africa/Banjul',
            'GN'  => 'Africa/Conakry',
            'IE'  => 'Europe/Dublin',
            'ML'  => 'Africa/Bamako',
            'MR'  => 'Africa/Nouakchott',
            'SH'  => 'Atlantic/St_Helena',
            'SL'  => 'Africa/Freetown',
            'SN'  => 'Africa/Dakar',
            'ST'  => 'Africa/Sao_Tome',
            'TG'  => 'Africa/Lome',
            'OM'  => 'Asia/Muscat',
            'LK'  => 'Asia/Colombo',
            'KH'  => 'Asia/Phnom_Penh',
            'LA'  => 'Asia/Vientiane',
            'TH'  => 'Asia/Bangkok',
            'KP'  => 'Asia/Pyongyang',
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'timezonetoterritory', 'GU');
        $this->assertEquals("Pacific/Guam", $value);
    }

    /**
     * test for reading citytotimezone from locale
     * expected array
     */
    public function testCityToTimezone()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'citytotimezone');
        $result = [
            'Etc/Unknown'                    => 'Unbekannt',
            'Europe/Tirane'                  => 'Tirana',
            'Asia/Yerevan'                   => 'Erivan',
            'Antarctica/Vostok'              => 'Wostok',
            'Antarctica/DumontDUrville'      => 'Dumont D\'Urville',
            'Europe/Vienna'                  => 'Wien',
            'Europe/Brussels'                => 'Brüssel',
            'Africa/Ouagadougou'             => 'Wagadugu',
            'Africa/Porto-Novo'              => 'Porto Novo',
            'America/St_Barthelemy'          => 'Saint-Barthélemy',
            'Atlantic/Bermuda'               => 'Bermudas',
            'America/Sao_Paulo'              => 'São Paulo',
            'America/Coral_Harbour'          => 'Atikokan',
            'America/St_Johns'               => 'St. John\'s',
            'Europe/Zurich'                  => 'Zürich',
            'Pacific/Easter'                 => 'Osterinsel',
            'Asia/Kashgar'                   => 'Kaxgar',
            'America/Bogota'                 => 'Bogotá',
            'America/Havana'                 => 'Havanna',
            'Atlantic/Cape_Verde'            => 'Kap Verde',
            'America/Curacao'                => 'Curaçao',
            'Indian/Christmas'               => 'Weihnachts-Inseln',
            'Asia/Nicosia'                   => 'Nikosia',
            'Europe/Prague'                  => 'Prag',
            'Europe/Busingen'                => 'Büsingen',
            'Africa/Djibouti'                => 'Dschibuti',
            'Europe/Copenhagen'              => 'Kopenhagen',
            'Africa/Algiers'                 => 'Algier',
            'Africa/Cairo'                   => 'Kairo',
            'Africa/El_Aaiun'                => 'El Aaiún',
            'Africa/Asmera'                  => 'Asmara',
            'Atlantic/Canary'                => 'Kanaren',
            'Africa/Addis_Ababa'             => 'Addis Abeba',
            'Pacific/Fiji'                   => 'Fidschi',
            'Pacific/Truk'                   => 'Chuuk',
            'Pacific/Ponape'                 => 'Pohnpei',
            'Atlantic/Faeroe'                => 'Färöer',
            'Asia/Tbilisi'                   => 'Tiflis',
            'Africa/Accra'                   => 'Akkra',
            'America/Godthab'                => 'Nuuk',
            'America/Scoresbysund'           => 'Ittoqqortoormiit',
            'Europe/Athens'                  => 'Athen',
            'Atlantic/South_Georgia'         => 'Süd-Georgien',
            'Asia/Hong_Kong'                 => 'Hongkong',
            'Asia/Jayapura'                  => 'Port Numbay',
            'Asia/Calcutta'                  => 'Kolkata',
            'Asia/Baghdad'                   => 'Bagdad',
            'Asia/Tehran'                    => 'Teheran',
            'Atlantic/Reykjavik'             => 'Reyk­ja­vík',
            'Europe/Rome'                    => 'Rom',
            'America/Jamaica'                => 'Jamaika',
            'Asia/Tokyo'                     => 'Tokio',
            'Asia/Bishkek'                   => 'Bischkek',
            'Indian/Comoro'                  => 'Komoren',
            'America/St_Kitts'               => 'St. Kitts',
            'Asia/Pyongyang'                 => 'Pjöngjang',
            'America/Cayman'                 => 'Kaimaninseln',
            'Asia/Aqtobe'                    => 'Aktobe',
            'America/St_Lucia'               => 'St. Lucia',
            'Europe/Vilnius'                 => 'Wilna',
            'Europe/Luxembourg'              => 'Luxemburg',
            'Africa/Tripoli'                 => 'Tripolis',
            'Europe/Chisinau'                => 'Kischinau',
            'Asia/Macau'                     => 'Macao',
            'Indian/Maldives'                => 'Malediven',
            'America/Mexico_City'            => 'Mexiko-Stadt',
            'Asia/Katmandu'                  => 'Kathmandu',
            'Asia/Muscat'                    => 'Muskat',
            'Europe/Warsaw'                  => 'Warschau',
            'Atlantic/Azores'                => 'Azoren',
            'Europe/Lisbon'                  => 'Lissabon',
            'America/Asuncion'               => 'Asunción',
            'Asia/Qatar'                     => 'Katar',
            'Indian/Reunion'                 => 'Réunion',
            'Europe/Bucharest'               => 'Bukarest',
            'Europe/Belgrade'                => 'Belgrad',
            'Europe/Moscow'                  => 'Moskau',
            'Europe/Volgograd'               => 'Wolgograd',
            'Asia/Yekaterinburg'             => 'Jekaterinburg',
            'Asia/Novosibirsk'               => 'Nowosibirsk',
            'Asia/Novokuznetsk'              => 'Nowokuznetsk',
            'Asia/Krasnoyarsk'               => 'Krasnojarsk',
            'Asia/Yakutsk'                   => 'Jakutsk',
            'Asia/Vladivostok'               => 'Wladiwostok',
            'Asia/Sakhalin'                  => 'Sachalin',
            'Asia/Kamchatka'                 => 'Kamtschatka',
            'Asia/Riyadh'                    => 'Riad',
            'Africa/Khartoum'                => 'Khartum',
            'Asia/Singapore'                 => 'Singapur',
            'Atlantic/St_Helena'             => 'St. Helena',
            'Africa/Mogadishu'               => 'Mogadischu',
            'Africa/Sao_Tome'                => 'São Tomé',
            'America/El_Salvador'            => 'Salvador',
            'America/Lower_Princes'          => 'Lower Prince\'s Quarter',
            'Asia/Damascus'                  => 'Damaskus',
            'Africa/Lome'                    => 'Lomé',
            'Asia/Dushanbe'                  => 'Duschanbe',
            'America/Port_of_Spain'          => 'Port-of-Spain',
            'Asia/Taipei'                    => 'Taipeh',
            'Africa/Dar_es_Salaam'           => 'Daressalam',
            'Europe/Uzhgorod'                => 'Uschgorod',
            'Europe/Kiev'                    => 'Kiew',
            'Europe/Zaporozhye'              => 'Saporischja',
            'America/North_Dakota/Beulah'    => 'Beulah, North Dakota',
            'America/North_Dakota/New_Salem' => 'New Salem, North Dakota',
            'America/North_Dakota/Center'    => 'Center, North Dakota',
            'America/Indiana/Vincennes'      => 'Vincennes, Indiana',
            'America/Indiana/Petersburg'     => 'Petersburg, Indiana',
            'America/Indiana/Tell_City'      => 'Tell City, Indiana',
            'America/Indiana/Knox'           => 'Knox, Indiana',
            'America/Indiana/Winamac'        => 'Winamac, Indiana',
            'America/Indiana/Marengo'        => 'Marengo, Indiana',
            'America/Indiana/Vevay'          => 'Vevay, Indiana',
            'America/Kentucky/Monticello'    => 'Monticello, Kentucky',
            'Asia/Tashkent'                  => 'Taschkent',
            'Europe/Vatican'                 => 'Vatikan',
            'America/St_Vincent'             => 'St. Vincent',
            'America/St_Thomas'              => 'St. Thomas',
            'Asia/Saigon'                    => 'Ho-Chi-Minh-Stadt',
        ];
        $this->assertEquals($result, $value, var_export($value, 1));

        $value = Zend_Locale_Data::getContent('de_AT', 'citytotimezone', 'Pacific/Fiji');
        $this->assertEquals("Fidschi", $value);
    }

    /**
     * test for reading timezonetocity from locale
     * expected array
     */
    public function testTimezoneToCity()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'timezonetocity');
        $result = [
            'Unbekannt'               => 'Etc/Unknown',
            'Tirana'                  => 'Europe/Tirane',
            'Erivan'                  => 'Asia/Yerevan',
            'Wostok'                  => 'Antarctica/Vostok',
            'Dumont D\'Urville'       => 'Antarctica/DumontDUrville',
            'Wien'                    => 'Europe/Vienna',
            'Brüssel'                 => 'Europe/Brussels',
            'Wagadugu'                => 'Africa/Ouagadougou',
            'Porto Novo'              => 'Africa/Porto-Novo',
            'Saint-Barthélemy'        => 'America/St_Barthelemy',
            'Bermudas'                => 'Atlantic/Bermuda',
            'São Paulo'               => 'America/Sao_Paulo',
            'Atikokan'                => 'America/Coral_Harbour',
            'St. John\'s'             => 'America/St_Johns',
            'Zürich'                  => 'Europe/Zurich',
            'Osterinsel'              => 'Pacific/Easter',
            'Kaxgar'                  => 'Asia/Kashgar',
            'Bogotá'                  => 'America/Bogota',
            'Havanna'                 => 'America/Havana',
            'Kap Verde'               => 'Atlantic/Cape_Verde',
            'Curaçao'                 => 'America/Curacao',
            'Weihnachts-Inseln'       => 'Indian/Christmas',
            'Nikosia'                 => 'Asia/Nicosia',
            'Prag'                    => 'Europe/Prague',
            'Büsingen'                => 'Europe/Busingen',
            'Dschibuti'               => 'Africa/Djibouti',
            'Kopenhagen'              => 'Europe/Copenhagen',
            'Algier'                  => 'Africa/Algiers',
            'Kairo'                   => 'Africa/Cairo',
            'El Aaiún'                => 'Africa/El_Aaiun',
            'Asmara'                  => 'Africa/Asmera',
            'Kanaren'                 => 'Atlantic/Canary',
            'Addis Abeba'             => 'Africa/Addis_Ababa',
            'Fidschi'                 => 'Pacific/Fiji',
            'Chuuk'                   => 'Pacific/Truk',
            'Pohnpei'                 => 'Pacific/Ponape',
            'Färöer'                  => 'Atlantic/Faeroe',
            'Tiflis'                  => 'Asia/Tbilisi',
            'Akkra'                   => 'Africa/Accra',
            'Nuuk'                    => 'America/Godthab',
            'Ittoqqortoormiit'        => 'America/Scoresbysund',
            'Athen'                   => 'Europe/Athens',
            'Süd-Georgien'            => 'Atlantic/South_Georgia',
            'Hongkong'                => 'Asia/Hong_Kong',
            'Port Numbay'             => 'Asia/Jayapura',
            'Kolkata'                 => 'Asia/Calcutta',
            'Bagdad'                  => 'Asia/Baghdad',
            'Teheran'                 => 'Asia/Tehran',
            'Reyk­ja­vík'             => 'Atlantic/Reykjavik',
            'Rom'                     => 'Europe/Rome',
            'Jamaika'                 => 'America/Jamaica',
            'Tokio'                   => 'Asia/Tokyo',
            'Bischkek'                => 'Asia/Bishkek',
            'Komoren'                 => 'Indian/Comoro',
            'St. Kitts'               => 'America/St_Kitts',
            'Pjöngjang'               => 'Asia/Pyongyang',
            'Kaimaninseln'            => 'America/Cayman',
            'Aktobe'                  => 'Asia/Aqtobe',
            'St. Lucia'               => 'America/St_Lucia',
            'Wilna'                   => 'Europe/Vilnius',
            'Luxemburg'               => 'Europe/Luxembourg',
            'Tripolis'                => 'Africa/Tripoli',
            'Kischinau'               => 'Europe/Chisinau',
            'Macao'                   => 'Asia/Macau',
            'Malediven'               => 'Indian/Maldives',
            'Mexiko-Stadt'            => 'America/Mexico_City',
            'Kathmandu'               => 'Asia/Katmandu',
            'Muskat'                  => 'Asia/Muscat',
            'Warschau'                => 'Europe/Warsaw',
            'Azoren'                  => 'Atlantic/Azores',
            'Lissabon'                => 'Europe/Lisbon',
            'Asunción'                => 'America/Asuncion',
            'Katar'                   => 'Asia/Qatar',
            'Réunion'                 => 'Indian/Reunion',
            'Bukarest'                => 'Europe/Bucharest',
            'Belgrad'                 => 'Europe/Belgrade',
            'Moskau'                  => 'Europe/Moscow',
            'Wolgograd'               => 'Europe/Volgograd',
            'Jekaterinburg'           => 'Asia/Yekaterinburg',
            'Nowosibirsk'             => 'Asia/Novosibirsk',
            'Nowokuznetsk'            => 'Asia/Novokuznetsk',
            'Krasnojarsk'             => 'Asia/Krasnoyarsk',
            'Jakutsk'                 => 'Asia/Yakutsk',
            'Wladiwostok'             => 'Asia/Vladivostok',
            'Sachalin'                => 'Asia/Sakhalin',
            'Kamtschatka'             => 'Asia/Kamchatka',
            'Riad'                    => 'Asia/Riyadh',
            'Khartum'                 => 'Africa/Khartoum',
            'Singapur'                => 'Asia/Singapore',
            'St. Helena'              => 'Atlantic/St_Helena',
            'Mogadischu'              => 'Africa/Mogadishu',
            'São Tomé'                => 'Africa/Sao_Tome',
            'Salvador'                => 'America/El_Salvador',
            'Lower Prince\'s Quarter' => 'America/Lower_Princes',
            'Damaskus'                => 'Asia/Damascus',
            'Lomé'                    => 'Africa/Lome',
            'Duschanbe'               => 'Asia/Dushanbe',
            'Port-of-Spain'           => 'America/Port_of_Spain',
            'Taipeh'                  => 'Asia/Taipei',
            'Daressalam'              => 'Africa/Dar_es_Salaam',
            'Uschgorod'               => 'Europe/Uzhgorod',
            'Kiew'                    => 'Europe/Kiev',
            'Saporischja'             => 'Europe/Zaporozhye',
            'Beulah, North Dakota'    => 'America/North_Dakota/Beulah',
            'New Salem, North Dakota' => 'America/North_Dakota/New_Salem',
            'Center, North Dakota'    => 'America/North_Dakota/Center',
            'Vincennes, Indiana'      => 'America/Indiana/Vincennes',
            'Petersburg, Indiana'     => 'America/Indiana/Petersburg',
            'Tell City, Indiana'      => 'America/Indiana/Tell_City',
            'Knox, Indiana'           => 'America/Indiana/Knox',
            'Winamac, Indiana'        => 'America/Indiana/Winamac',
            'Marengo, Indiana'        => 'America/Indiana/Marengo',
            'Vevay, Indiana'          => 'America/Indiana/Vevay',
            'Monticello, Kentucky'    => 'America/Kentucky/Monticello',
            'Taschkent'               => 'Asia/Tashkent',
            'Vatikan'                 => 'Europe/Vatican',
            'St. Vincent'             => 'America/St_Vincent',
            'St. Thomas'              => 'America/St_Thomas',
            'Ho-Chi-Minh-Stadt'       => 'Asia/Saigon',
        ];
        $this->assertEquals($result, $value, var_export($value, 1));

        $value = Zend_Locale_Data::getContent('de_AT', 'timezonetocity', 'Fidschi');
        $this->assertEquals("Pacific/Fiji", $value);
    }

    /**
     * test for reading territorytophone from locale
     * expected array
     */
    public function testTerritoryToPhone()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'territorytophone');
        $result = [
            388 => '001',
            247 => 'AC',
            376 => 'AD',
            971 => 'AE',
            93  => 'AF',
            1   => 'AG AI AS BB BM BS CA DM DO GD GU JM KN KY LC MP MS PR SX TC TT UM US VC VG VI',
            355 => 'AL',
            374 => 'AM',
            244 => 'AO',
            672 => 'AQ NF',
            54  => 'AR',
            43  => 'AT',
            61  => 'AU CC CX',
            297 => 'AW',
            358 => 'AX FI',
            994 => 'AZ',
            387 => 'BA',
            880 => 'BD',
            32  => 'BE',
            226 => 'BF',
            359 => 'BG',
            973 => 'BH',
            257 => 'BI',
            229 => 'BJ',
            590 => 'BL GP MF',
            673 => 'BN',
            591 => 'BO',
            599 => 'BQ CW',
            55  => 'BR',
            975 => 'BT',
            267 => 'BW',
            375 => 'BY',
            501 => 'BZ',
            243 => 'CD',
            236 => 'CF',
            242 => 'CG',
            41  => 'CH',
            225 => 'CI',
            682 => 'CK',
            56  => 'CL',
            237 => 'CM',
            86  => 'CN',
            57  => 'CO',
            506 => 'CR',
            53  => 'CU',
            238 => 'CV',
            357 => 'CY',
            420 => 'CZ',
            49  => 'DE',
            253 => 'DJ',
            45  => 'DK',
            213 => 'DZ',
            593 => 'EC',
            372 => 'EE',
            20  => 'EG',
            212 => 'EH MA',
            291 => 'ER',
            34  => 'ES',
            251 => 'ET',
            679 => 'FJ',
            500 => 'FK GS',
            691 => 'FM',
            298 => 'FO',
            33  => 'FR',
            241 => 'GA',
            44  => 'GB GG IM JE',
            995 => 'GE',
            594 => 'GF',
            233 => 'GH',
            350 => 'GI',
            299 => 'GL',
            220 => 'GM',
            224 => 'GN',
            240 => 'GQ',
            30  => 'GR',
            502 => 'GT',
            245 => 'GW',
            592 => 'GY',
            852 => 'HK',
            504 => 'HN',
            385 => 'HR',
            509 => 'HT',
            36  => 'HU',
            62  => 'ID',
            353 => 'IE',
            972 => 'IL PS',
            91  => 'IN',
            246 => 'IO',
            964 => 'IQ',
            98  => 'IR',
            354 => 'IS',
            39  => 'IT VA',
            962 => 'JO',
            81  => 'JP',
            254 => 'KE',
            996 => 'KG',
            855 => 'KH',
            686 => 'KI',
            269 => 'KM',
            850 => 'KP',
            82  => 'KR',
            965 => 'KW',
            7   => 'KZ RU',
            856 => 'LA',
            961 => 'LB',
            423 => 'LI',
            94  => 'LK',
            231 => 'LR',
            266 => 'LS',
            370 => 'LT',
            352 => 'LU',
            371 => 'LV',
            218 => 'LY',
            377 => 'MC XK',
            373 => 'MD',
            382 => 'ME',
            261 => 'MG',
            692 => 'MH',
            389 => 'MK',
            223 => 'ML',
            95  => 'MM',
            976 => 'MN',
            853 => 'MO',
            596 => 'MQ',
            222 => 'MR',
            356 => 'MT',
            230 => 'MU',
            960 => 'MV',
            265 => 'MW',
            52  => 'MX',
            60  => 'MY',
            258 => 'MZ',
            264 => 'NA',
            687 => 'NC',
            227 => 'NE',
            234 => 'NG',
            505 => 'NI',
            31  => 'NL',
            47  => 'NO SJ',
            977 => 'NP',
            674 => 'NR',
            683 => 'NU',
            64  => 'NZ',
            968 => 'OM',
            507 => 'PA',
            51  => 'PE',
            689 => 'PF',
            675 => 'PG',
            63  => 'PH',
            92  => 'PK',
            48  => 'PL',
            508 => 'PM',
            870 => 'PN',
            351 => 'PT',
            680 => 'PW',
            595 => 'PY',
            974 => 'QA',
            262 => 'RE TF YT',
            40  => 'RO',
            381 => 'RS',
            250 => 'RW',
            966 => 'SA',
            677 => 'SB',
            248 => 'SC',
            249 => 'SD',
            46  => 'SE',
            65  => 'SG',
            290 => 'SH',
            386 => 'SI',
            421 => 'SK',
            232 => 'SL',
            378 => 'SM',
            221 => 'SN',
            252 => 'SO',
            597 => 'SR',
            211 => 'SS',
            239 => 'ST',
            503 => 'SV',
            963 => 'SY',
            268 => 'SZ',
            235 => 'TD',
            228 => 'TG',
            66  => 'TH',
            992 => 'TJ',
            690 => 'TK',
            670 => 'TL',
            993 => 'TM',
            216 => 'TN',
            676 => 'TO',
            90  => 'TR',
            688 => 'TV',
            886 => 'TW',
            255 => 'TZ',
            380 => 'UA',
            256 => 'UG',
            598 => 'UY',
            998 => 'UZ',
            58  => 'VE',
            84  => 'VN',
            678 => 'VU',
            681 => 'WF',
            685 => 'WS',
            967 => 'YE',
            27  => 'ZA',
            260 => 'ZM',
            263 => 'ZW',
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'territorytophone', '43');
        $this->assertEquals("AT", $value);
    }

    /**
     * test for reading phonetoterritory from locale
     * expected array
     */
    public function testPhoneToTerritory()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'phonetoterritory');
        $result = [
            '001' => '388',
            'AC'  => '247',
            'AD'  => '376',
            'AE'  => '971',
            'AF'  => '93',
            'AG'  => '1',
            'AI'  => '1',
            'AL'  => '355',
            'AM'  => '374',
            'AO'  => '244',
            'AQ'  => '672',
            'AR'  => '54',
            'AS'  => '1',
            'AT'  => '43',
            'AU'  => '61',
            'AW'  => '297',
            'AX'  => '358',
            'AZ'  => '994',
            'BA'  => '387',
            'BB'  => '1',
            'BD'  => '880',
            'BE'  => '32',
            'BF'  => '226',
            'BG'  => '359',
            'BH'  => '973',
            'BI'  => '257',
            'BJ'  => '229',
            'BL'  => '590',
            'BM'  => '1',
            'BN'  => '673',
            'BO'  => '591',
            'BQ'  => '599',
            'BR'  => '55',
            'BS'  => '1',
            'BT'  => '975',
            'BW'  => '267',
            'BY'  => '375',
            'BZ'  => '501',
            'CA'  => '1',
            'CC'  => '61',
            'CD'  => '243',
            'CF'  => '236',
            'CG'  => '242',
            'CH'  => '41',
            'CI'  => '225',
            'CK'  => '682',
            'CL'  => '56',
            'CM'  => '237',
            'CN'  => '86',
            'CO'  => '57',
            'CR'  => '506',
            'CU'  => '53',
            'CV'  => '238',
            'CW'  => '599',
            'CX'  => '61',
            'CY'  => '357',
            'CZ'  => '420',
            'DE'  => '49',
            'DJ'  => '253',
            'DK'  => '45',
            'DM'  => '1',
            'DO'  => '1',
            'DZ'  => '213',
            'EC'  => '593',
            'EE'  => '372',
            'EG'  => '20',
            'EH'  => '212',
            'ER'  => '291',
            'ES'  => '34',
            'ET'  => '251',
            'FI'  => '358',
            'FJ'  => '679',
            'FK'  => '500',
            'FM'  => '691',
            'FO'  => '298',
            'FR'  => '33',
            'GA'  => '241',
            'GB'  => '44',
            'GD'  => '1',
            'GE'  => '995',
            'GF'  => '594',
            'GG'  => '44',
            'GH'  => '233',
            'GI'  => '350',
            'GL'  => '299',
            'GM'  => '220',
            'GN'  => '224',
            'GP'  => '590',
            'GQ'  => '240',
            'GR'  => '30',
            'GS'  => '500',
            'GT'  => '502',
            'GU'  => '1',
            'GW'  => '245',
            'GY'  => '592',
            'HK'  => '852',
            'HN'  => '504',
            'HR'  => '385',
            'HT'  => '509',
            'HU'  => '36',
            'ID'  => '62',
            'IE'  => '353',
            'IL'  => '972',
            'IM'  => '44',
            'IN'  => '91',
            'IO'  => '246',
            'IQ'  => '964',
            'IR'  => '98',
            'IS'  => '354',
            'IT'  => '39',
            'JE'  => '44',
            'JM'  => '1',
            'JO'  => '962',
            'JP'  => '81',
            'KE'  => '254',
            'KG'  => '996',
            'KH'  => '855',
            'KI'  => '686',
            'KM'  => '269',
            'KN'  => '1',
            'KP'  => '850',
            'KR'  => '82',
            'KW'  => '965',
            'KY'  => '1',
            'KZ'  => '7',
            'LA'  => '856',
            'LB'  => '961',
            'LC'  => '1',
            'LI'  => '423',
            'LK'  => '94',
            'LR'  => '231',
            'LS'  => '266',
            'LT'  => '370',
            'LU'  => '352',
            'LV'  => '371',
            'LY'  => '218',
            'MA'  => '212',
            'MC'  => '377',
            'MD'  => '373',
            'ME'  => '382',
            'MF'  => '590',
            'MG'  => '261',
            'MH'  => '692',
            'MK'  => '389',
            'ML'  => '223',
            'MM'  => '95',
            'MN'  => '976',
            'MO'  => '853',
            'MP'  => '1',
            'MQ'  => '596',
            'MR'  => '222',
            'MS'  => '1',
            'MT'  => '356',
            'MU'  => '230',
            'MV'  => '960',
            'MW'  => '265',
            'MX'  => '52',
            'MY'  => '60',
            'MZ'  => '258',
            'NA'  => '264',
            'NC'  => '687',
            'NE'  => '227',
            'NF'  => '672',
            'NG'  => '234',
            'NI'  => '505',
            'NL'  => '31',
            'NO'  => '47',
            'NP'  => '977',
            'NR'  => '674',
            'NU'  => '683',
            'NZ'  => '64',
            'OM'  => '968',
            'PA'  => '507',
            'PE'  => '51',
            'PF'  => '689',
            'PG'  => '675',
            'PH'  => '63',
            'PK'  => '92',
            'PL'  => '48',
            'PM'  => '508',
            'PN'  => '870',
            'PR'  => '1',
            'PS'  => '972',
            'PT'  => '351',
            'PW'  => '680',
            'PY'  => '595',
            'QA'  => '974',
            'RE'  => '262',
            'RO'  => '40',
            'RS'  => '381',
            'RU'  => '7',
            'RW'  => '250',
            'SA'  => '966',
            'SB'  => '677',
            'SC'  => '248',
            'SD'  => '249',
            'SE'  => '46',
            'SG'  => '65',
            'SH'  => '290',
            'SI'  => '386',
            'SJ'  => '47',
            'SK'  => '421',
            'SL'  => '232',
            'SM'  => '378',
            'SN'  => '221',
            'SO'  => '252',
            'SR'  => '597',
            'SS'  => '211',
            'ST'  => '239',
            'SV'  => '503',
            'SX'  => '1',
            'SY'  => '963',
            'SZ'  => '268',
            'TC'  => '1',
            'TD'  => '235',
            'TF'  => '262',
            'TG'  => '228',
            'TH'  => '66',
            'TJ'  => '992',
            'TK'  => '690',
            'TL'  => '670',
            'TM'  => '993',
            'TN'  => '216',
            'TO'  => '676',
            'TR'  => '90',
            'TT'  => '1',
            'TV'  => '688',
            'TW'  => '886',
            'TZ'  => '255',
            'UA'  => '380',
            'UG'  => '256',
            'UM'  => '1',
            'US'  => '1',
            'UY'  => '598',
            'UZ'  => '998',
            'VA'  => '39',
            'VC'  => '1',
            'VE'  => '58',
            'VG'  => '1',
            'VI'  => '1',
            'VN'  => '84',
            'VU'  => '678',
            'WF'  => '681',
            'WS'  => '685',
            'XK'  => '377',
            'YE'  => '967',
            'YT'  => '262',
            'ZA'  => '27',
            'ZM'  => '260',
            'ZW'  => '263',
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'phonetoterritory', 'AT');
        $this->assertEquals("43", $value);
    }

    /**
     * test for reading territorytonumeric from locale
     * expected array
     */
    public function testTerritoryToNumeric()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'territorytonumeric');
        $result = ['958' => 'AA', '020' => 'AD', '784' => 'AE', '004' => 'AF', '028' => 'AG',
            '660' => 'AI', '008' => 'AL', '051' => 'AM', '530' => 'AN', '024' => 'AO', '010' => 'AQ',
            '032' => 'AR', '016' => 'AS', '040' => 'AT', '036' => 'AU', '533' => 'AW', '248' => 'AX',
            '031' => 'AZ', '070' => 'BA', '052' => 'BB', '050' => 'BD', '056' => 'BE', '854' => 'BF',
            '100' => 'BG', '048' => 'BH', '108' => 'BI', '204' => 'BJ', '652' => 'BL', '060' => 'BM',
            '096' => 'BN', '068' => 'BO', '535' => 'BQ', '076' => 'BR', '044' => 'BS', '064' => 'BT', '104' => 'BU',
            '074' => 'BV', '072' => 'BW', '112' => 'BY', '084' => 'BZ', '124' => 'CA', '166' => 'CC',
            '180' => 'CD', '140' => 'CF', '178' => 'CG', '756' => 'CH', '384' => 'CI', '184' => 'CK',
            '152' => 'CL', '120' => 'CM', '156' => 'CN', '170' => 'CO', '188' => 'CR', '891' => 'CS',
            '192' => 'CU', '132' => 'CV', '531' => 'CW', '162' => 'CX', '196' => 'CY', '203' => 'CZ', '278' => 'DD',
            '276' => 'DE', '262' => 'DJ', '208' => 'DK', '212' => 'DM', '214' => 'DO', '012' => 'DZ',
            '218' => 'EC', '233' => 'EE', '818' => 'EG', '732' => 'EH', '232' => 'ER', '724' => 'ES',
            '231' => 'ET', '967' => 'EU', '246' => 'FI', '242' => 'FJ', '238' => 'FK', '583' => 'FM', '234' => 'FO',
            '250' => 'FR', '249' => 'FX', '266' => 'GA', '826' => 'GB', '308' => 'GD', '268' => 'GE',
            '254' => 'GF', '831' => 'GG', '288' => 'GH', '292' => 'GI', '304' => 'GL', '270' => 'GM',
            '324' => 'GN', '312' => 'GP', '226' => 'GQ', '300' => 'GR', '239' => 'GS', '320' => 'GT',
            '316' => 'GU', '624' => 'GW', '328' => 'GY', '344' => 'HK', '334' => 'HM', '340' => 'HN',
            '191' => 'HR', '332' => 'HT', '348' => 'HU', '360' => 'ID', '372' => 'IE', '376' => 'IL',
            '833' => 'IM', '356' => 'IN', '086' => 'IO', '368' => 'IQ', '364' => 'IR', '352' => 'IS',
            '380' => 'IT', '832' => 'JE', '388' => 'JM', '400' => 'JO', '392' => 'JP', '404' => 'KE',
            '417' => 'KG', '116' => 'KH', '296' => 'KI', '174' => 'KM', '659' => 'KN', '408' => 'KP',
            '410' => 'KR', '414' => 'KW', '136' => 'KY', '398' => 'KZ', '418' => 'LA', '422' => 'LB',
            '662' => 'LC', '438' => 'LI', '144' => 'LK', '430' => 'LR', '426' => 'LS', '440' => 'LT',
            '442' => 'LU', '428' => 'LV', '434' => 'LY', '504' => 'MA', '492' => 'MC', '498' => 'MD',
            '499' => 'ME', '450' => 'MG', '663' => 'MF', '584' => 'MH', '807' => 'MK', '466' => 'ML',
            '496' => 'MN', '446' => 'MO', '580' => 'MP', '474' => 'MQ', '478' => 'MR', '500' => 'MS',
            '470' => 'MT', '480' => 'MU', '462' => 'MV', '454' => 'MW', '484' => 'MX', '458' => 'MY',
            '508' => 'MZ', '516' => 'NA', '540' => 'NC', '562' => 'NE', '574' => 'NF', '566' => 'NG',
            '558' => 'NI', '528' => 'NL', '578' => 'NO', '524' => 'NP', '520' => 'NR', '536' => 'NT',
            '570' => 'NU', '554' => 'NZ', '512' => 'OM', '591' => 'PA', '604' => 'PE', '258' => 'PF',
            '598' => 'PG', '608' => 'PH', '586' => 'PK', '616' => 'PL', '666' => 'PM', '612' => 'PN',
            '630' => 'PR', '275' => 'PS', '620' => 'PT', '585' => 'PW', '600' => 'PY', '634' => 'QA',
            '959' => 'QM', '960' => 'QN', '961' => 'QO', '962' => 'QP', '963' => 'QQ', '964' => 'QR',
            '965' => 'QS', '966' => 'QT', '968' => 'QV', '969' => 'QW', '970' => 'QX',
            '971' => 'QY', '972' => 'QZ', '638' => 'RE', '642' => 'RO', '688' => 'RS', '643' => 'RU',
            '646' => 'RW', '682' => 'SA', '090' => 'SB', '690' => 'SC', '729' => 'SD', '752' => 'SE',
            '702' => 'SG', '654' => 'SH', '705' => 'SI', '744' => 'SJ', '703' => 'SK', '694' => 'SL',
            '674' => 'SM', '686' => 'SN', '706' => 'SO', '740' => 'SR', '728' => 'SS' , '678' => 'ST', '810' => 'SU',
            '222' => 'SV', '534' => 'SX' ,'760' => 'SY', '748' => 'SZ', '796' => 'TC', '148' => 'TD', '260' => 'TF',
            '768' => 'TG', '764' => 'TH', '762' => 'TJ', '772' => 'TK', '626' => 'TL', '795' => 'TM',
            '788' => 'TN', '776' => 'TO', '792' => 'TR', '780' => 'TT', '798' => 'TV', '158' => 'TW',
            '834' => 'TZ', '804' => 'UA', '800' => 'UG', '581' => 'UM', '840' => 'US', '858' => 'UY',
            '860' => 'UZ', '336' => 'VA', '670' => 'VC', '862' => 'VE', '092' => 'VG', '850' => 'VI',
            '704' => 'VN', '548' => 'VU', '876' => 'WF', '882' => 'WS', '973' => 'XA', '974' => 'XB',
            '975' => 'XC', '976' => 'XD', '977' => 'XE', '978' => 'XF', '979' => 'XG', '980' => 'XH',
            '981' => 'XI', '982' => 'XJ', '983' => 'XK', '984' => 'XL', '985' => 'XM', '986' => 'XN',
            '987' => 'XO', '988' => 'XP', '989' => 'XQ', '990' => 'XR', '991' => 'XS', '992' => 'XT',
            '993' => 'XU', '994' => 'XV', '995' => 'XW', '996' => 'XX', '997' => 'XY', '998' => 'XZ',
            '720' => 'YD', '887' => 'YE', '175' => 'YT', '710' => 'ZA', '894' => 'ZM', '716' => 'ZW',
            '999' => 'ZZ'];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'territorytonumeric', '040');
        $this->assertEquals("AT", $value);
    }

    /**
     * test for reading numerictoterritory from locale
     * expected array
     */
    public function testNumericToTerritory()
    {
        $value  = Zend_Locale_Data::getList('de_AT', 'numerictoterritory');
        $result = [
            'AA' => '958',
            'AC' => '',
            'AD' => '020',
            'AE' => '784',
            'AF' => '004',
            'AG' => '028',
            'AI' => '660',
            'AL' => '008',
            'AM' => '051',
            'AN' => '530',
            'AO' => '024',
            'AQ' => '010',
            'AR' => '032',
            'AS' => '016',
            'AT' => '040',
            'AU' => '036',
            'AW' => '533',
            'AX' => '248',
            'AZ' => '031',
            'BA' => '070',
            'BB' => '052',
            'BD' => '050',
            'BE' => '056',
            'BF' => '854',
            'BG' => '100',
            'BH' => '048',
            'BI' => '108',
            'BJ' => '204',
            'BL' => '652',
            'BM' => '060',
            'BN' => '096',
            'BO' => '068',
            'BQ' => '535',
            'BR' => '076',
            'BS' => '044',
            'BT' => '064',
            'BU' => '104',
            'BV' => '074',
            'BW' => '072',
            'BY' => '112',
            'BZ' => '084',
            'CA' => '124',
            'CC' => '166',
            'CD' => '180',
            'CF' => '140',
            'CG' => '178',
            'CH' => '756',
            'CI' => '384',
            'CK' => '184',
            'CL' => '152',
            'CM' => '120',
            'CN' => '156',
            'CO' => '170',
            'CP' => '',
            'CR' => '188',
            'CS' => '891',
            'CU' => '192',
            'CV' => '132',
            'CW' => '531',
            'CX' => '162',
            'CY' => '196',
            'CZ' => '203',
            'DD' => '278',
            'DE' => '276',
            'DG' => '',
            'DJ' => '262',
            'DK' => '208',
            'DM' => '212',
            'DO' => '214',
            'DZ' => '012',
            'EA' => '',
            'EC' => '218',
            'EE' => '233',
            'EG' => '818',
            'EH' => '732',
            'ER' => '232',
            'ES' => '724',
            'ET' => '231',
            'EU' => '967',
            'FI' => '246',
            'FJ' => '242',
            'FK' => '238',
            'FM' => '583',
            'FO' => '234',
            'FR' => '250',
            'FX' => '249',
            'GA' => '266',
            'GB' => '826',
            'GD' => '308',
            'GE' => '268',
            'GF' => '254',
            'GG' => '831',
            'GH' => '288',
            'GI' => '292',
            'GL' => '304',
            'GM' => '270',
            'GN' => '324',
            'GP' => '312',
            'GQ' => '226',
            'GR' => '300',
            'GS' => '239',
            'GT' => '320',
            'GU' => '316',
            'GW' => '624',
            'GY' => '328',
            'HK' => '344',
            'HM' => '334',
            'HN' => '340',
            'HR' => '191',
            'HT' => '332',
            'HU' => '348',
            'IC' => '',
            'ID' => '360',
            'IE' => '372',
            'IL' => '376',
            'IM' => '833',
            'IN' => '356',
            'IO' => '086',
            'IQ' => '368',
            'IR' => '364',
            'IS' => '352',
            'IT' => '380',
            'JE' => '832',
            'JM' => '388',
            'JO' => '400',
            'JP' => '392',
            'KE' => '404',
            'KG' => '417',
            'KH' => '116',
            'KI' => '296',
            'KM' => '174',
            'KN' => '659',
            'KP' => '408',
            'KR' => '410',
            'KW' => '414',
            'KY' => '136',
            'KZ' => '398',
            'LA' => '418',
            'LB' => '422',
            'LC' => '662',
            'LI' => '438',
            'LK' => '144',
            'LR' => '430',
            'LS' => '426',
            'LT' => '440',
            'LU' => '442',
            'LV' => '428',
            'LY' => '434',
            'MA' => '504',
            'MC' => '492',
            'MD' => '498',
            'ME' => '499',
            'MF' => '663',
            'MG' => '450',
            'MH' => '584',
            'MK' => '807',
            'ML' => '466',
            'MM' => '104',
            'MN' => '496',
            'MO' => '446',
            'MP' => '580',
            'MQ' => '474',
            'MR' => '478',
            'MS' => '500',
            'MT' => '470',
            'MU' => '480',
            'MV' => '462',
            'MW' => '454',
            'MX' => '484',
            'MY' => '458',
            'MZ' => '508',
            'NA' => '516',
            'NC' => '540',
            'NE' => '562',
            'NF' => '574',
            'NG' => '566',
            'NI' => '558',
            'NL' => '528',
            'NO' => '578',
            'NP' => '524',
            'NR' => '520',
            'NT' => '536',
            'NU' => '570',
            'NZ' => '554',
            'OM' => '512',
            'PA' => '591',
            'PE' => '604',
            'PF' => '258',
            'PG' => '598',
            'PH' => '608',
            'PK' => '586',
            'PL' => '616',
            'PM' => '666',
            'PN' => '612',
            'PR' => '630',
            'PS' => '275',
            'PT' => '620',
            'PW' => '585',
            'PY' => '600',
            'QA' => '634',
            'QM' => '959',
            'QN' => '960',
            'QO' => '961',
            'QP' => '962',
            'QQ' => '963',
            'QR' => '964',
            'QS' => '965',
            'QT' => '966',
            'QU' => '967',
            'QV' => '968',
            'QW' => '969',
            'QX' => '970',
            'QY' => '971',
            'QZ' => '972',
            'RE' => '638',
            'RO' => '642',
            'RS' => '688',
            'RU' => '643',
            'RW' => '646',
            'SA' => '682',
            'SB' => '090',
            'SC' => '690',
            'SD' => '729',
            'SE' => '752',
            'SG' => '702',
            'SH' => '654',
            'SI' => '705',
            'SJ' => '744',
            'SK' => '703',
            'SL' => '694',
            'SM' => '674',
            'SN' => '686',
            'SO' => '706',
            'SR' => '740',
            'SS' => '728',
            'ST' => '678',
            'SU' => '810',
            'SV' => '222',
            'SX' => '534',
            'SY' => '760',
            'SZ' => '748',
            'TA' => '',
            'TC' => '796',
            'TD' => '148',
            'TF' => '260',
            'TG' => '768',
            'TH' => '764',
            'TJ' => '762',
            'TK' => '772',
            'TL' => '626',
            'TM' => '795',
            'TN' => '788',
            'TO' => '776',
            'TP' => '626',
            'TR' => '792',
            'TT' => '780',
            'TV' => '798',
            'TW' => '158',
            'TZ' => '834',
            'UA' => '804',
            'UG' => '800',
            'UM' => '581',
            'US' => '840',
            'UY' => '858',
            'UZ' => '860',
            'VA' => '336',
            'VC' => '670',
            'VE' => '862',
            'VG' => '092',
            'VI' => '850',
            'VN' => '704',
            'VU' => '548',
            'WF' => '876',
            'WS' => '882',
            'XA' => '973',
            'XB' => '974',
            'XC' => '975',
            'XD' => '976',
            'XE' => '977',
            'XF' => '978',
            'XG' => '979',
            'XH' => '980',
            'XI' => '981',
            'XJ' => '982',
            'XK' => '983',
            'XL' => '984',
            'XM' => '985',
            'XN' => '986',
            'XO' => '987',
            'XP' => '988',
            'XQ' => '989',
            'XR' => '990',
            'XS' => '991',
            'XT' => '992',
            'XU' => '993',
            'XV' => '994',
            'XW' => '995',
            'XX' => '996',
            'XY' => '997',
            'XZ' => '998',
            'YD' => '720',
            'YE' => '887',
            'YT' => '175',
            'YU' => '891',
            'ZA' => '710',
            'ZM' => '894',
            'ZR' => '180',
            'ZW' => '716',
            'ZZ' => '999',
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'numerictoterritory', 'AT');
        $this->assertEquals("040", $value);
    }

    /**
     * test for reading territorytonumeric from locale
     * expected array
     */
    public function testTerritoryToAlpha3()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'territorytoalpha3');
        $result = ['AAA' => 'AA', 'ASC' => 'AC', 'AND' => 'AD', 'ARE' => 'AE', 'AFG' => 'AF', 'ATG' => 'AG',
            'AIA' => 'AI', 'ALB' => 'AL', 'ARM' => 'AM', 'ANT' => 'AN', 'AGO' => 'AO', 'ATA' => 'AQ',
            'ARG' => 'AR', 'ASM' => 'AS', 'AUT' => 'AT', 'AUS' => 'AU', 'ABW' => 'AW', 'ALA' => 'AX',
            'AZE' => 'AZ', 'BIH' => 'BA', 'BRB' => 'BB', 'BGD' => 'BD', 'BEL' => 'BE', 'BFA' => 'BF',
            'BGR' => 'BG', 'BHR' => 'BH', 'BDI' => 'BI', 'BEN' => 'BJ', 'BLM' => 'BL', 'BMU' => 'BM',
            'BRN' => 'BN', 'BOL' => 'BO', 'BES' => 'BQ', 'BRA' => 'BR', 'BHS' => 'BS', 'BTN' => 'BT', 'BUR' => 'BU',
            'BVT' => 'BV', 'BWA' => 'BW', 'BLR' => 'BY', 'BLZ' => 'BZ', 'CAN' => 'CA', 'CCK' => 'CC',
            'COD' => 'CD', 'CAF' => 'CF', 'COG' => 'CG', 'CHE' => 'CH', 'CIV' => 'CI', 'COK' => 'CK',
            'CHL' => 'CL', 'CMR' => 'CM', 'CHN' => 'CN', 'COL' => 'CO', 'CPT' => 'CP', 'CRI' => 'CR', 'SCG' => 'CS',
            'CUB' => 'CU', 'CPV' => 'CV', 'CUW' => 'CW', 'CXR' => 'CX', 'CYP' => 'CY', 'CZE' => 'CZ', 'DDR' => 'DD',
            'DEU' => 'DE', 'DGA' => 'DG', 'DJI' => 'DJ', 'DNK' => 'DK', 'DMA' => 'DM', 'DOM' => 'DO', 'DZA' => 'DZ',
            'ECU' => 'EC', 'EST' => 'EE', 'EGY' => 'EG', 'ESH' => 'EH', 'ERI' => 'ER', 'ESP' => 'ES',
            'ETH' => 'ET', 'FIN' => 'FI', 'FJI' => 'FJ', 'FLK' => 'FK', 'FSM' => 'FM', 'FRO' => 'FO',
            'FRA' => 'FR', 'FXX' => 'FX', 'GAB' => 'GA', 'GBR' => 'GB', 'GRD' => 'GD', 'GEO' => 'GE',
            'GUF' => 'GF', 'GGY' => 'GG', 'GHA' => 'GH', 'GIB' => 'GI', 'GRL' => 'GL', 'GMB' => 'GM',
            'GIN' => 'GN', 'GLP' => 'GP', 'GNQ' => 'GQ', 'GRC' => 'GR', 'SGS' => 'GS', 'GTM' => 'GT',
            'GUM' => 'GU', 'GNB' => 'GW', 'GUY' => 'GY', 'HKG' => 'HK', 'HMD' => 'HM', 'HND' => 'HN',
            'HRV' => 'HR', 'HTI' => 'HT', 'HUN' => 'HU', 'IDN' => 'ID', 'IRL' => 'IE', 'ISR' => 'IL',
            'IMN' => 'IM', 'IND' => 'IN', 'IOT' => 'IO', 'IRQ' => 'IQ', 'IRN' => 'IR', 'ISL' => 'IS',
            'ITA' => 'IT', 'JEY' => 'JE', 'JAM' => 'JM', 'JOR' => 'JO', 'JPN' => 'JP', 'KEN' => 'KE',
            'KGZ' => 'KG', 'KHM' => 'KH', 'KIR' => 'KI', 'COM' => 'KM', 'KNA' => 'KN', 'PRK' => 'KP',
            'KOR' => 'KR', 'KWT' => 'KW', 'CYM' => 'KY', 'KAZ' => 'KZ', 'LAO' => 'LA', 'LBN' => 'LB',
            'LCA' => 'LC', 'LIE' => 'LI', 'LKA' => 'LK', 'LBR' => 'LR', 'LSO' => 'LS', 'LTU' => 'LT',
            'LUX' => 'LU', 'LVA' => 'LV', 'LBY' => 'LY', 'MAR' => 'MA', 'MCO' => 'MC', 'MDA' => 'MD',
            'MNE' => 'ME', 'MDG' => 'MG', 'MAF' => 'MF', 'MHL' => 'MH', 'MKD' => 'MK', 'MLI' => 'ML',
            'MMR' => 'MM', 'MNG' => 'MN', 'MAC' => 'MO', 'MNP' => 'MP', 'MTQ' => 'MQ', 'MRT' => 'MR',
            'MSR' => 'MS', 'MLT' => 'MT', 'MUS' => 'MU', 'MDV' => 'MV', 'MWI' => 'MW', 'MEX' => 'MX',
            'MYS' => 'MY', 'MOZ' => 'MZ', 'NAM' => 'NA', 'NCL' => 'NC', 'NER' => 'NE', 'NFK' => 'NF',
            'NGA' => 'NG', 'NIC' => 'NI', 'NLD' => 'NL', 'NOR' => 'NO', 'NPL' => 'NP', 'NRU' => 'NR',
            'NTZ' => 'NT', 'NIU' => 'NU', 'NZL' => 'NZ', 'OMN' => 'OM', 'PAN' => 'PA', 'PER' => 'PE',
            'PYF' => 'PF', 'PNG' => 'PG', 'PHL' => 'PH', 'PAK' => 'PK', 'POL' => 'PL', 'SPM' => 'PM',
            'PCN' => 'PN', 'PRI' => 'PR', 'PSE' => 'PS', 'PRT' => 'PT', 'PLW' => 'PW', 'PRY' => 'PY',
            'QAT' => 'QA', 'QMM' => 'QM', 'QNN' => 'QN', 'QOO' => 'QO', 'QPP' => 'QP', 'QQQ' => 'QQ',
            'QRR' => 'QR', 'QSS' => 'QS', 'QTT' => 'QT', 'QVV' => 'QV', 'QWW' => 'QW', 'QUU' => 'EU',
            'QXX' => 'QX', 'QYY' => 'QY', 'QZZ' => 'QZ', 'REU' => 'RE', 'ROU' => 'RO', 'SRB' => 'RS',
            'RUS' => 'RU', 'RWA' => 'RW', 'SAU' => 'SA', 'SLB' => 'SB', 'SYC' => 'SC', 'SDN' => 'SD',
            'SWE' => 'SE', 'SGP' => 'SG', 'SHN' => 'SH', 'SVN' => 'SI', 'SJM' => 'SJ', 'SVK' => 'SK',
            'SLE' => 'SL', 'SMR' => 'SM', 'SEN' => 'SN', 'SOM' => 'SO', 'SUR' => 'SR', 'SSD' => 'SS', 'STP' => 'ST',
            'SUN' => 'SU', 'SLV' => 'SV', 'SXM' => 'SX', 'SYR' => 'SY', 'SWZ' => 'SZ', 'TAA' => 'TA', 'TCA' => 'TC', 'TCD' => 'TD',
            'ATF' => 'TF', 'TGO' => 'TG', 'THA' => 'TH', 'TJK' => 'TJ', 'TKL' => 'TK', 'TLS' => 'TL',
            'TKM' => 'TM', 'TUN' => 'TN', 'TON' => 'TO', 'TMP' => 'TP', 'TUR' => 'TR', 'TTO' => 'TT',
            'TUV' => 'TV', 'TWN' => 'TW', 'TZA' => 'TZ', 'UKR' => 'UA', 'UGA' => 'UG', 'UMI' => 'UM',
            'USA' => 'US', 'URY' => 'UY', 'UZB' => 'UZ', 'VAT' => 'VA', 'VCT' => 'VC', 'VEN' => 'VE',
            'VGB' => 'VG', 'VIR' => 'VI', 'VNM' => 'VN', 'VUT' => 'VU', 'WLF' => 'WF', 'WSM' => 'WS',
            'XAA' => 'XA', 'XBB' => 'XB', 'XCC' => 'XC', 'XDD' => 'XD', 'XEE' => 'XE', 'XFF' => 'XF',
            'XGG' => 'XG', 'XHH' => 'XH', 'XII' => 'XI', 'XJJ' => 'XJ', 'XKK' => 'XK', 'XLL' => 'XL',
            'XMM' => 'XM', 'XNN' => 'XN', 'XOO' => 'XO', 'XPP' => 'XP', 'XQQ' => 'XQ', 'XRR' => 'XR',
            'XSS' => 'XS', 'XTT' => 'XT', 'XUU' => 'XU', 'XVV' => 'XV', 'XWW' => 'XW', 'XXX' => 'XX',
            'XYY' => 'XY', 'XZZ' => 'XZ', 'YMD' => 'YD', 'YEM' => 'YE', 'MYT' => 'YT', 'YUG' => 'YU',
            'ZAF' => 'ZA', 'ZMB' => 'ZM', 'ZAR' => 'ZR', 'ZWE' => 'ZW', 'ZZZ' => 'ZZ'];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'territorytoalpha3', 'AUT');
        $this->assertEquals("AT", $value);
    }

    /**
     * test for reading alpha3toterritory from locale
     * expected array
     */
    public function testAlpha3ToTerritory()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'alpha3toterritory');
        $result = [
            'AA' => 'AAA',
            'AC' => 'ASC',
            'AD' => 'AND',
            'AE' => 'ARE',
            'AF' => 'AFG',
            'AG' => 'ATG',
            'AI' => 'AIA',
            'AL' => 'ALB',
            'AM' => 'ARM',
            'AN' => 'ANT',
            'AO' => 'AGO',
            'AQ' => 'ATA',
            'AR' => 'ARG',
            'AS' => 'ASM',
            'AT' => 'AUT',
            'AU' => 'AUS',
            'AW' => 'ABW',
            'AX' => 'ALA',
            'AZ' => 'AZE',
            'BA' => 'BIH',
            'BB' => 'BRB',
            'BD' => 'BGD',
            'BE' => 'BEL',
            'BF' => 'BFA',
            'BG' => 'BGR',
            'BH' => 'BHR',
            'BI' => 'BDI',
            'BJ' => 'BEN',
            'BL' => 'BLM',
            'BM' => 'BMU',
            'BN' => 'BRN',
            'BO' => 'BOL',
            'BQ' => 'BES',
            'BR' => 'BRA',
            'BS' => 'BHS',
            'BT' => 'BTN',
            'BU' => 'BUR',
            'BV' => 'BVT',
            'BW' => 'BWA',
            'BY' => 'BLR',
            'BZ' => 'BLZ',
            'CA' => 'CAN',
            'CC' => 'CCK',
            'CD' => 'COD',
            'CF' => 'CAF',
            'CG' => 'COG',
            'CH' => 'CHE',
            'CI' => 'CIV',
            'CK' => 'COK',
            'CL' => 'CHL',
            'CM' => 'CMR',
            'CN' => 'CHN',
            'CO' => 'COL',
            'CP' => 'CPT',
            'CR' => 'CRI',
            'CS' => 'SCG',
            'CU' => 'CUB',
            'CV' => 'CPV',
            'CW' => 'CUW',
            'CX' => 'CXR',
            'CY' => 'CYP',
            'CZ' => 'CZE',
            'DD' => 'DDR',
            'DE' => 'DEU',
            'DG' => 'DGA',
            'DJ' => 'DJI',
            'DK' => 'DNK',
            'DM' => 'DMA',
            'DO' => 'DOM',
            'DZ' => 'DZA',
            'EA' => '',
            'EC' => 'ECU',
            'EE' => 'EST',
            'EG' => 'EGY',
            'EH' => 'ESH',
            'ER' => 'ERI',
            'ES' => 'ESP',
            'ET' => 'ETH',
            'EU' => 'QUU',
            'FI' => 'FIN',
            'FJ' => 'FJI',
            'FK' => 'FLK',
            'FM' => 'FSM',
            'FO' => 'FRO',
            'FR' => 'FRA',
            'FX' => 'FXX',
            'GA' => 'GAB',
            'GB' => 'GBR',
            'GD' => 'GRD',
            'GE' => 'GEO',
            'GF' => 'GUF',
            'GG' => 'GGY',
            'GH' => 'GHA',
            'GI' => 'GIB',
            'GL' => 'GRL',
            'GM' => 'GMB',
            'GN' => 'GIN',
            'GP' => 'GLP',
            'GQ' => 'GNQ',
            'GR' => 'GRC',
            'GS' => 'SGS',
            'GT' => 'GTM',
            'GU' => 'GUM',
            'GW' => 'GNB',
            'GY' => 'GUY',
            'HK' => 'HKG',
            'HM' => 'HMD',
            'HN' => 'HND',
            'HR' => 'HRV',
            'HT' => 'HTI',
            'HU' => 'HUN',
            'IC' => '',
            'ID' => 'IDN',
            'IE' => 'IRL',
            'IL' => 'ISR',
            'IM' => 'IMN',
            'IN' => 'IND',
            'IO' => 'IOT',
            'IQ' => 'IRQ',
            'IR' => 'IRN',
            'IS' => 'ISL',
            'IT' => 'ITA',
            'JE' => 'JEY',
            'JM' => 'JAM',
            'JO' => 'JOR',
            'JP' => 'JPN',
            'KE' => 'KEN',
            'KG' => 'KGZ',
            'KH' => 'KHM',
            'KI' => 'KIR',
            'KM' => 'COM',
            'KN' => 'KNA',
            'KP' => 'PRK',
            'KR' => 'KOR',
            'KW' => 'KWT',
            'KY' => 'CYM',
            'KZ' => 'KAZ',
            'LA' => 'LAO',
            'LB' => 'LBN',
            'LC' => 'LCA',
            'LI' => 'LIE',
            'LK' => 'LKA',
            'LR' => 'LBR',
            'LS' => 'LSO',
            'LT' => 'LTU',
            'LU' => 'LUX',
            'LV' => 'LVA',
            'LY' => 'LBY',
            'MA' => 'MAR',
            'MC' => 'MCO',
            'MD' => 'MDA',
            'ME' => 'MNE',
            'MF' => 'MAF',
            'MG' => 'MDG',
            'MH' => 'MHL',
            'MK' => 'MKD',
            'ML' => 'MLI',
            'MM' => 'MMR',
            'MN' => 'MNG',
            'MO' => 'MAC',
            'MP' => 'MNP',
            'MQ' => 'MTQ',
            'MR' => 'MRT',
            'MS' => 'MSR',
            'MT' => 'MLT',
            'MU' => 'MUS',
            'MV' => 'MDV',
            'MW' => 'MWI',
            'MX' => 'MEX',
            'MY' => 'MYS',
            'MZ' => 'MOZ',
            'NA' => 'NAM',
            'NC' => 'NCL',
            'NE' => 'NER',
            'NF' => 'NFK',
            'NG' => 'NGA',
            'NI' => 'NIC',
            'NL' => 'NLD',
            'NO' => 'NOR',
            'NP' => 'NPL',
            'NR' => 'NRU',
            'NT' => 'NTZ',
            'NU' => 'NIU',
            'NZ' => 'NZL',
            'OM' => 'OMN',
            'PA' => 'PAN',
            'PE' => 'PER',
            'PF' => 'PYF',
            'PG' => 'PNG',
            'PH' => 'PHL',
            'PK' => 'PAK',
            'PL' => 'POL',
            'PM' => 'SPM',
            'PN' => 'PCN',
            'PR' => 'PRI',
            'PS' => 'PSE',
            'PT' => 'PRT',
            'PW' => 'PLW',
            'PY' => 'PRY',
            'QA' => 'QAT',
            'QM' => 'QMM',
            'QN' => 'QNN',
            'QO' => 'QOO',
            'QP' => 'QPP',
            'QQ' => 'QQQ',
            'QR' => 'QRR',
            'QS' => 'QSS',
            'QT' => 'QTT',
            'QU' => 'QUU',
            'QV' => 'QVV',
            'QW' => 'QWW',
            'QX' => 'QXX',
            'QY' => 'QYY',
            'QZ' => 'QZZ',
            'RE' => 'REU',
            'RO' => 'ROU',
            'RS' => 'SRB',
            'RU' => 'RUS',
            'RW' => 'RWA',
            'SA' => 'SAU',
            'SB' => 'SLB',
            'SC' => 'SYC',
            'SD' => 'SDN',
            'SE' => 'SWE',
            'SG' => 'SGP',
            'SH' => 'SHN',
            'SI' => 'SVN',
            'SJ' => 'SJM',
            'SK' => 'SVK',
            'SL' => 'SLE',
            'SM' => 'SMR',
            'SN' => 'SEN',
            'SO' => 'SOM',
            'SR' => 'SUR',
            'SS' => 'SSD',
            'ST' => 'STP',
            'SU' => 'SUN',
            'SV' => 'SLV',
            'SX' => 'SXM',
            'SY' => 'SYR',
            'SZ' => 'SWZ',
            'TA' => 'TAA',
            'TC' => 'TCA',
            'TD' => 'TCD',
            'TF' => 'ATF',
            'TG' => 'TGO',
            'TH' => 'THA',
            'TJ' => 'TJK',
            'TK' => 'TKL',
            'TL' => 'TLS',
            'TM' => 'TKM',
            'TN' => 'TUN',
            'TO' => 'TON',
            'TP' => 'TMP',
            'TR' => 'TUR',
            'TT' => 'TTO',
            'TV' => 'TUV',
            'TW' => 'TWN',
            'TZ' => 'TZA',
            'UA' => 'UKR',
            'UG' => 'UGA',
            'UM' => 'UMI',
            'US' => 'USA',
            'UY' => 'URY',
            'UZ' => 'UZB',
            'VA' => 'VAT',
            'VC' => 'VCT',
            'VE' => 'VEN',
            'VG' => 'VGB',
            'VI' => 'VIR',
            'VN' => 'VNM',
            'VU' => 'VUT',
            'WF' => 'WLF',
            'WS' => 'WSM',
            'XA' => 'XAA',
            'XB' => 'XBB',
            'XC' => 'XCC',
            'XD' => 'XDD',
            'XE' => 'XEE',
            'XF' => 'XFF',
            'XG' => 'XGG',
            'XH' => 'XHH',
            'XI' => 'XII',
            'XJ' => 'XJJ',
            'XK' => 'XKK',
            'XL' => 'XLL',
            'XM' => 'XMM',
            'XN' => 'XNN',
            'XO' => 'XOO',
            'XP' => 'XPP',
            'XQ' => 'XQQ',
            'XR' => 'XRR',
            'XS' => 'XSS',
            'XT' => 'XTT',
            'XU' => 'XUU',
            'XV' => 'XVV',
            'XW' => 'XWW',
            'XX' => 'XXX',
            'XY' => 'XYY',
            'XZ' => 'XZZ',
            'YD' => 'YMD',
            'YE' => 'YEM',
            'YT' => 'MYT',
            'YU' => 'YUG',
            'ZA' => 'ZAF',
            'ZM' => 'ZMB',
            'ZR' => 'ZAR',
            'ZW' => 'ZWE',
            'ZZ' => 'ZZZ',
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'alpha3toterritory', 'AT');
        $this->assertEquals("AUT", $value);
    }

    /**
     * test for reading postaltoterritory from locale
     * expected array
     */
    public function testPostalToTerritory()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'postaltoterritory');
        $result = ['GB' => 'GIR[ ]?0AA|((AB|AL|B|BA|BB|BD|BH|BL|BN|BR|BS|BT|CA|CB|CF|CH|CM|CO|CR|CT|CV|CW|DA|DD|DE|DG|DH|DL|DN|DT|DY|E|EC|EH|EN|EX|FK|FY|G|GL|GY|GU|HA|HD|HG|HP|HR|HS|HU|HX|IG|IM|IP|IV|JE|KA|KT|KW|KY|L|LA|LD|LE|LL|LN|LS|LU|M|ME|MK|ML|N|NE|NG|NN|NP|NR|NW|OL|OX|PA|PE|PH|PL|PO|PR|RG|RH|RM|S|SA|SE|SG|SK|SL|SM|SN|SO|SP|SR|SS|ST|SW|SY|TA|TD|TF|TN|TQ|TR|TS|TW|UB|W|WA|WC|WD|WF|WN|WR|WS|WV|YO|ZE)(\d[\dA-Z]?[ ]?\d[ABD-HJLN-UW-Z]{2}))|BFPO[ ]?\d{1,4}',
            'JE' => 'JE\d[\dA-Z]?[ ]?\d[ABD-HJLN-UW-Z]{2}',
            'GG' => 'GY\d[\dA-Z]?[ ]?\d[ABD-HJLN-UW-Z]{2}',
            'IM' => 'IM\d[\dA-Z]?[ ]?\d[ABD-HJLN-UW-Z]{2}',
            'US' => '\d{5}([ \-]\d{4})?',
            'CA' => '[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ ]?\d[ABCEGHJ-NPRSTV-Z]\d',
            'DE' => '\d{5}',
            'JP' => '\d{3}-\d{4}',
            'FR' => '\d{2}[ ]?\d{3}',
            'AU' => '\d{4}',
            'IT' => '\d{5}',
            'CH' => '\d{4}',
            'AT' => '\d{4}',
            'ES' => '\d{5}',
            'NL' => '\d{4}[ ]?[A-Z]{2}',
            'BE' => '\d{4}',
            'DK' => '\d{4}',
            'SE' => '\d{3}[ ]?\d{2}',
            'NO' => '\d{4}',
            'BR' => '\d{5}[\-]?\d{3}',
            'PT' => '\d{4}([\-]\d{3})?',
            'FI' => '\d{5}',
            'AX' => '22\d{3}',
            'KR' => '\d{3}[\-]\d{3}',
            'CN' => '\d{6}',
            'TW' => '\d{3}(\d{2})?',
            'SG' => '\d{6}',
            'DZ' => '\d{5}',
            'AD' => 'AD\d{3}',
            'AR' => '([A-HJ-NP-Z])?\d{4}([A-Z]{3})?',
            'AM' => '(37)?\d{4}',
            'AZ' => '\d{4}',
            'BH' => '((1[0-2]|[2-9])\d{2})?',
            'BD' => '\d{4}',
            'BB' => '(BB\d{5})?',
            'BY' => '\d{6}',
            'BM' => '[A-Z]{2}[ ]?[A-Z0-9]{2}',
            'BA' => '\d{5}',
            'IO' => 'BBND 1ZZ',
            'BN' => '[A-Z]{2}[ ]?\d{4}',
            'BG' => '\d{4}',
            'KH' => '\d{5}',
            'CV' => '\d{4}',
            'CL' => '\d{7}',
            'CR' => '\d{4,5}|\d{3}-\d{4}',
            'HR' => '\d{5}',
            'CY' => '\d{4}',
            'CZ' => '\d{3}[ ]?\d{2}',
            'DO' => '\d{5}',
            'EC' => '([A-Z]\d{4}[A-Z]|(?:[A-Z]{2})?\d{6})?',
            'EG' => '\d{5}',
            'EE' => '\d{5}',
            'FO' => '\d{3}',
            'GE' => '\d{4}',
            'GR' => '\d{3}[ ]?\d{2}',
            'GL' => '39\d{2}',
            'GT' => '\d{5}',
            'HT' => '\d{4}',
            'HN' => '(?:\d{5})?',
            'HU' => '\d{4}',
            'IS' => '\d{3}',
            'IN' => '\d{6}',
            'ID' => '\d{5}',
            'IL' => '\d{5}',
            'JO' => '\d{5}',
            'KZ' => '\d{6}',
            'KE' => '\d{5}',
            'KW' => '\d{5}',
            'LA' => '\d{5}',
            'LV' => '\d{4}',
            'LB' => '(\d{4}([ ]?\d{4})?)?',
            'LI' => '(948[5-9])|(949[0-7])',
            'LT' => '\d{5}',
            'LU' => '\d{4}',
            'MK' => '\d{4}',
            'MY' => '\d{5}',
            'MV' => '\d{5}',
            'MT' => '[A-Z]{3}[ ]?\d{2,4}',
            'MU' => '(\d{3}[A-Z]{2}\d{3})?',
            'MX' => '\d{5}',
            'MD' => '\d{4}',
            'MC' => '980\d{2}',
            'MA' => '\d{5}',
            'NP' => '\d{5}',
            'NZ' => '\d{4}',
            'NI' => '((\d{4}-)?\d{3}-\d{3}(-\d{1})?)?',
            'NG' => '(\d{6})?',
            'OM' => '(PC )?\d{3}',
            'PK' => '\d{5}',
            'PY' => '\d{4}',
            'PH' => '\d{4}',
            'PL' => '\d{2}-\d{3}',
            'PR' => '00[679]\d{2}([ \-]\d{4})?',
            'RO' => '\d{6}',
            'RU' => '\d{6}',
            'SM' => '4789\d',
            'SA' => '\d{5}',
            'SN' => '\d{5}',
            'SK' => '\d{3}[ ]?\d{2}',
            'SI' => '\d{4}',
            'ZA' => '\d{4}',
            'LK' => '\d{5}',
            'TJ' => '\d{6}',
            'TH' => '\d{5}',
            'TN' => '\d{4}',
            'TR' => '\d{5}',
            'TM' => '\d{6}',
            'UA' => '\d{5}',
            'UY' => '\d{5}',
            'UZ' => '\d{6}',
            'VA' => '00120',
            'VE' => '\d{4}',
            'ZM' => '\d{5}',
            'AS' => '96799',
            'CC' => '6799',
            'CK' => '\d{4}',
            'RS' => '\d{6}',
            'ME' => '8\d{4}',
            'CS' => '\d{5}',
            'YU' => '\d{5}',
            'CX' => '6798',
            'ET' => '\d{4}',
            'FK' => 'FIQQ 1ZZ',
            'NF' => '2899',
            'FM' => '(9694[1-4])([ \-]\d{4})?',
            'GF' => '9[78]3\d{2}',
            'GN' => '\d{3}',
            'GP' => '9[78][01]\d{2}',
            'GS' => 'SIQQ 1ZZ',
            'GU' => '969[123]\d([ \-]\d{4})?',
            'GW' => '\d{4}',
            'HM' => '\d{4}',
            'IQ' => '\d{5}',
            'KG' => '\d{6}',
            'LR' => '\d{4}',
            'LS' => '\d{3}',
            'MG' => '\d{3}',
            'MH' => '969[67]\d([ \-]\d{4})?',
            'MN' => '\d{6}',
            'MP' => '9695[012]([ \-]\d{4})?',
            'MQ' => '9[78]2\d{2}',
            'NC' => '988\d{2}',
            'NE' => '\d{4}',
            'VI' => '008(([0-4]\d)|(5[01]))([ \-]\d{4})?',
            'PF' => '987\d{2}',
            'PG' => '\d{3}',
            'PM' => '9[78]5\d{2}',
            'PN' => 'PCRN 1ZZ',
            'PW' => '96940',
            'RE' => '9[78]4\d{2}',
            'SH' => '(ASCN|STHL) 1ZZ',
            'SJ' => '\d{4}',
            'SO' => '\d{5}',
            'SZ' => '[HLMS]\d{3}',
            'TC' => 'TKCA 1ZZ',
            'WF' => '986\d{2}',
            'XK' => '\d{5}',
            'YT' => '976\d{2}'
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'postaltoterritory', 'AT');
        $this->assertEquals('\d{4}', $value);
    }

    /**
     * test for reading numberingsystem from locale
     * expected array
     */
    public function testNumberingSystem()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'numberingsystem');
        $result = [
            'arab' => '٠١٢٣٤٥٦٧٨٩',
            'arabext' => '۰۱۲۳۴۵۶۷۸۹',
            'bali' => '᭐᭑᭒᭓᭔᭕᭖᭗᭘᭙',
            'beng' => '০১২৩৪৫৬৭৮৯',
            'brah' => '𑁦𑁧𑁨𑁩𑁪𑁫𑁬𑁭𑁮𑁯',
            'cakm' => '𑄶𑄷𑄸𑄹𑄺𑄻𑄼𑄽𑄾𑄿',
            'cham' => '꩐꩑꩒꩓꩔꩕꩖꩗꩘꩙',
            'deva' => '०१२३४५६७८९',
            'fullwide' => '０１２３４５６７８９',
            'gujr' => '૦૧૨૩૪૫૬૭૮૯',
            'guru' => '੦੧੨੩੪੫੬੭੮੯',
            'hanidec' => '〇一二三四五六七八九',
            'java' => '꧐꧑꧒꧓꧔꧕꧖꧗꧘꧙',
            'kali' => '꤀꤁꤂꤃꤄꤅꤆꤇꤈꤉',
            'khmr' => "០១២៣៤៥៦៧៨៩",
            'knda' => '೦೧೨೩೪೫೬೭೮೯',
            'lana' => '᪀᪁᪂᪃᪄᪅᪆᪇᪈᪉',
            'lanatham' => '᪐᪑᪒᪓᪔᪕᪖᪗᪘᪙',
            'laoo' => '໐໑໒໓໔໕໖໗໘໙',
            'latn' => '0123456789',
            'lepc' => '᱀᱁᱂᱃᱄᱅᱆᱇᱈᱉',
            'limb' => '᥆᥇᥈᥉᥊᥋᥌᥍᥎᥏',
            'mlym' => '൦൧൨൩൪൫൬൭൮൯',
            'mong' => "᠐᠑᠒᠓᠔᠕᠖᠗᠘᠙",
            'mtei' => '꯰꯱꯲꯳꯴꯵꯶꯷꯸꯹',
            'mymr' => "၀၁၂၃၄၅၆၇၈၉",
            'mymrshan' => "႐႑႒႓႔႕႖႗႘႙",
            'nkoo' => '߀߁߂߃߄߅߆߇߈߉',
            'olck' => '᱐᱑᱒᱓᱔᱕᱖᱗᱘᱙',
            'orya' => '୦୧୨୩୪୫୬୭୮୯',
            'osma' => '𐒠𐒡𐒢𐒣𐒤𐒥𐒦𐒧𐒨𐒩',
            'saur' => '꣐꣑꣒꣓꣔꣕꣖꣗꣘꣙',
            'shrd' => '𑇐𑇑𑇒𑇓𑇔𑇕𑇖𑇗𑇘𑇙',
            'sora' => '𑃰𑃱𑃲𑃳𑃴𑃵𑃶𑃷𑃸𑃹',
            'sund' => '᮰᮱᮲᮳᮴᮵᮶᮷᮸᮹',
            'takr' => '𑛀𑛁𑛂𑛃𑛄𑛅𑛆𑛇𑛈𑛉',
            'talu' => '᧐᧑᧒᧓᧔᧕᧖᧗᧘᧙',
            'tamldec' => '௦௧௨௩௪௫௬௭௮௯',
            'telu' => '౦౧౨౩౪౫౬౭౮౯',
            'thai' => '๐๑๒๓๔๕๖๗๘๙',
            'tibt' => '༠༡༢༣༤༥༦༧༨༩',
            'vaii' => '꘠꘡꘢꘣꘤꘥꘦꘧꘨꘩'
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'numberingsystem', 'Arab');
        $this->assertEquals("٠١٢٣٤٥٦٧٨٩", $value);
    }

    /**
     * test for reading chartofallback from locale
     * expected array
     */
    public function testCharToFallback()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'chartofallback');
        $this->assertEquals('©', $value['(C)']);
        $this->assertEquals('½', $value[' 1/2']);
        $this->assertEquals('Æ', $value['AE']);

        $value = Zend_Locale_Data::getContent('de_AT', 'chartofallback', '(C)');
        $this->assertEquals("©", $value);
    }

    /**
     * test for reading chartofallback from locale
     * expected array
     */
    public function testFallbackToChar()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'fallbacktochar');
        $this->assertEquals('(C)', $value['©']);
        $this->assertEquals(' 1/2', $value['½']);
        $this->assertEquals('AE', $value['Æ']);

        $value = Zend_Locale_Data::getContent('de_AT', 'fallbacktochar', '©');
        $this->assertEquals('(C)', $value);
    }

    /**
     * test for reading chartofallback from locale
     * expected array
     */
    public function testLocaleUpgrade()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'localeupgrade');
        $this->assertEquals('en_Latn_US', $value['en']);
        $this->assertEquals('de_Latn_DE', $value['de']);
        $this->assertEquals('sk_Latn_SK', $value['sk']);

        $value = Zend_Locale_Data::getContent('de_AT', 'localeupgrade', 'de');
        $this->assertEquals('de_Latn_DE', $value);
    }

    /**
     * test for reading datetime from locale
     * expected array
     */
    public function testDateItem()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'dateitem');
        $result = [
            'd'       => 'd',
            'Ed'      => 'E, d.',
            'Ehm'     => 'E h:mm a',
            'EHm'     => 'E, HH:mm',
            'Ehms'    => 'E, h:mm:ss a',
            'EHms'    => 'E, HH:mm:ss',
            'Gy'      => 'y G',
            'GyMMM'   => 'MMM y G',
            'GyMMMd'  => 'd. MMM y G',
            'GyMMMEd' => 'E, d. MMM y G',
            'h'       => 'h a',
            'H'       => 'HH \'Uhr\'',
            'hm'      => 'h:mm a',
            'Hm'      => 'HH:mm',
            'hms'     => 'h:mm:ss a',
            'Hms'     => 'HH:mm:ss',
            'M'       => 'L',
            'Md'      => 'd.M.',
            'MEd'     => 'E, d.M.',
            'MMd'     => 'd.MM.',
            'MMdd'    => 'dd.MM.',
            'MMM'     => 'LLL',
            'MMMd'    => 'd. MMM',
            'MMMEd'   => 'E, d. MMM',
            'MMMMEd'  => 'E, d. MMMM',
            'ms'      => 'mm:ss',
            'y'       => 'y',
            'yM'      => 'M.y',
            'yMd'     => 'd.M.y',
            'yMEd'    => 'E, d.M.y',
            'yMM'     => 'MM.y',
            'yMMdd'   => 'dd.MM.y',
            'yMMM'    => 'MMM y',
            'yMMMd'   => 'd. MMM y',
            'yMMMEd'  => 'E, d. MMM y',
            'yMMMM'   => 'MMMM y',
            'yQQQ'    => 'QQQ y',
            'yQQQQ'   => 'QQQQ y',
        ];
        $this->assertEquals($result, $value, var_export($value, 1));

        $value = Zend_Locale_Data::getList('de_AT', 'dateitem', 'gregorian');
        $result = [
            'd'       => 'd',
            'Ed'      => 'E, d.',
            'Ehm'     => 'E h:mm a',
            'EHm'     => 'E, HH:mm',
            'Ehms'    => 'E, h:mm:ss a',
            'EHms'    => 'E, HH:mm:ss',
            'Gy'      => 'y G',
            'GyMMM'   => 'MMM y G',
            'GyMMMd'  => 'd. MMM y G',
            'GyMMMEd' => 'E, d. MMM y G',
            'h'       => 'h a',
            'H'       => 'HH \'Uhr\'',
            'hm'      => 'h:mm a',
            'Hm'      => 'HH:mm',
            'hms'     => 'h:mm:ss a',
            'Hms'     => 'HH:mm:ss',
            'M'       => 'L',
            'Md'      => 'd.M.',
            'MEd'     => 'E, d.M.',
            'MMd'     => 'd.MM.',
            'MMdd'    => 'dd.MM.',
            'MMM'     => 'LLL',
            'MMMd'    => 'd. MMM',
            'MMMEd'   => 'E, d. MMM',
            'MMMMEd'  => 'E, d. MMMM',
            'ms'      => 'mm:ss',
            'y'       => 'y',
            'yM'      => 'M.y',
            'yMd'     => 'd.M.y',
            'yMEd'    => 'E, d.M.y',
            'yMM'     => 'MM.y',
            'yMMdd'   => 'dd.MM.y',
            'yMMM'    => 'MMM y',
            'yMMMd'   => 'd. MMM y',
            'yMMMEd'  => 'E, d. MMM y',
            'yMMMM'   => 'MMMM y',
            'yQQQ'    => 'QQQ y',
            'yQQQQ'   => 'QQQQ y',
        ];
        $this->assertEquals($result, $value, var_export($value, 1));

        $value = Zend_Locale_Data::getContent('de_AT', 'dateitem', 'MMMd');
        $this->assertEquals("d. MMM", $value);
    }

    /**
     * test for reading intervalformat from locale
     * expected array
     */
    public function testDateInterval()
    {
        $value = Zend_Locale_Data::getList('de_AT', 'dateinterval');
        $result = [
            'MMMd' => [
                'd' => "dd.-dd. MMM",
                'M' => "dd. MMM - dd. MMM"],
            'MMMEd' => [
                'd' => "E, dd. - E, dd. MMM",
                'M' => "E, dd. MMM - E, dd. MMM"],
            'yMMMd' => [
                'd' => "dd.-dd. MMM y",
                'M' => "dd. MMM - dd. MMM y",
                'y' => "dd. MMM y - dd. MMM y"],
            'yMMMEd' => [
                'd' => "E, dd. - E, dd. MMM y",
                'M' => "E, dd. MMM - E, dd. MMM y",
                'y' => "E, dd. MMM y - E, dd. MMM y"],
            'd' => [
                'd' => "d.-d."],
            'h' => [
                'a' => "h a - h a",
                'h' => "h-h a"],
            'H' => [
                'H' => "HH-HH 'Uhr'"],
            'hm' => [
                'a' => "h:mm a - h:mm a",
                'h' => "h:mm-h:mm a",
                'm' => "h:mm-h:mm a"],
            'Hm' => [
                'H' => "HH:mm-HH:mm",
                'm' => "HH:mm-HH:mm"],
            'hmv' => [
                'a' => "h:mm a - h:mm a v",
                'h' => "h:mm-h:mm a v",
                'm' => "h:mm-h:mm a v"],
            'Hmv' => [
                'H' => "HH:mm-HH:mm v",
                'm' => "HH:mm-HH:mm v"],
            'hv' => [
                'a' => "h a - h a v",
                'h' => "h-h a v"],
            'Hv' => [
                'H' => "HH-HH 'Uhr' v"],
            'M' => [
                'M' => "M.-M."],
            'Md' => [
                'd' => "dd.MM. - dd.MM.",
                'M' => "dd.MM. - dd.MM."],
            'MEd' => [
                'd' => "E, dd.MM. - E, dd.MM.",
                'M' => "E, dd.MM. - E, dd.MM."],
            'MMM' => [
                'M' => "MMM-MMM"],
            'MMMM' => [
                'M' => "LLLL-LLLL"],
            'y' => [
                'y' => "y-y"],
            'yM' => [
                'M' => "MM.y - MM.y",
                'y' => "MM.y - MM.y"],
            'yMd' => [
                'd' => "dd.MM.y - dd.MM.y",
                'M' => "dd.MM.y - dd.MM.y",
                'y' => "dd.MM.y - dd.MM.y"],
            'yMEd' => [
                'd' => "E, dd.MM.y - E, dd.MM.y",
                'M' => "E, dd.MM.y - E, dd.MM.y",
                'y' => "E, dd.MM.y - E, dd.MM.y"],
            'yMMM' => [
                'M' => "MMM-MMM y",
                'y' => "MMM y - MMM y"],
            'yMMMM' => [
                'M' => "MMMM-MMMM y",
                'y' => "MMMM y - MMMM y"]
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getList('de_AT', 'dateinterval', 'gregorian');
        $result = [
            'MMMd' => [
                'd' => "dd.-dd. MMM",
                'M' => "dd. MMM - dd. MMM"],
            'MMMEd' => [
                'd' => "E, dd. - E, dd. MMM",
                'M' => "E, dd. MMM - E, dd. MMM"],
            'yMMMd' => [
                'd' => "dd.-dd. MMM y",
                'M' => "dd. MMM - dd. MMM y",
                'y' => "dd. MMM y - dd. MMM y"],
            'yMMMEd' => [
                'd' => "E, dd. - E, dd. MMM y",
                'M' => "E, dd. MMM - E, dd. MMM y",
                'y' => "E, dd. MMM y - E, dd. MMM y"],
            'd' => [
                'd' => "d.-d."],
            'h' => [
                'a' => "h a - h a",
                'h' => "h-h a"],
            'H' => [
                'H' => "HH-HH 'Uhr'"],
            'hm' => [
                'a' => "h:mm a - h:mm a",
                'h' => "h:mm-h:mm a",
                'm' => "h:mm-h:mm a"],
            'Hm' => [
                'H' => "HH:mm-HH:mm",
                'm' => "HH:mm-HH:mm"],
            'hmv' => [
                'a' => "h:mm a - h:mm a v",
                'h' => "h:mm-h:mm a v",
                'm' => "h:mm-h:mm a v"],
            'Hmv' => [
                'H' => "HH:mm-HH:mm v",
                'm' => "HH:mm-HH:mm v"],
            'hv' => [
                'a' => "h a - h a v",
                'h' => "h-h a v"],
            'Hv' => [
                'H' => "HH-HH 'Uhr' v"],
            'M' => [
                'M' => "M.-M."],
            'Md' => [
                'd' => "dd.MM. - dd.MM.",
                'M' => "dd.MM. - dd.MM."],
            'MEd' => [
                'd' => "E, dd.MM. - E, dd.MM.",
                'M' => "E, dd.MM. - E, dd.MM."],
            'MMM' => [
                'M' => "MMM-MMM"],
            'MMMM' => [
                'M' => "LLLL-LLLL"],
            'y' => [
                'y' => "y-y"],
            'yM' => [
                'M' => "MM.y - MM.y",
                'y' => "MM.y - MM.y"],
            'yMd' => [
                'd' => "dd.MM.y - dd.MM.y",
                'M' => "dd.MM.y - dd.MM.y",
                'y' => "dd.MM.y - dd.MM.y"],
            'yMEd' => [
                'd' => "E, dd.MM.y - E, dd.MM.y",
                'M' => "E, dd.MM.y - E, dd.MM.y",
                'y' => "E, dd.MM.y - E, dd.MM.y"],
            'yMMM' => [
                'M' => "MMM-MMM y",
                'y' => "MMM y - MMM y"],
            'yMMMM' => [
                'M' => "MMMM-MMMM y",
                'y' => "MMMM y - MMMM y"]
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'dateinterval', ['gregorian', 'yMMMM', 'y']);
        $this->assertEquals("MMMM y - MMMM y", $value);
    }

    /**
     * test for reading intervalformat from locale
     * expected array
     */
    public function testUnit()
    {
        $value  = Zend_Locale_Data::getList('de_AT', 'unit');
        $result = [
            'acceleration-g-force'     => [
                'one'   => '{0}-fache Erdbeschleunigung',
                'other' => '{0}-fache Erdbeschleunigung',
            ],
            'angle-arc-minute'         => [
                'one'   => '{0} Winkelminute',
                'other' => '{0} Winkelminuten',
            ],
            'angle-arc-second'         => [
                'one'   => '{0} Winkelsekunde',
                'other' => '{0} Winkelsekunden',
            ],
            'angle-degree'             => [
                'one'   => '{0} Grad',
                'other' => '{0} Grad',
            ],
            'area-acre'                => [
                'one'   => '{0} Acre',
                'other' => '{0} Acres',
            ],
            'area-hectare'             => [
                'one'   => '{0} Hektar',
                'other' => '{0} Hektar',
            ],
            'area-square-foot'         => [
                'one'   => '{0} Quadratfuß',
                'other' => '{0} Quadratfuß',
            ],
            'area-square-kilometer'    => [
                'one'   => '{0} Quadratkilometer',
                'other' => '{0} Quadratkilometer',
            ],
            'area-square-meter'        => [
                'one'   => '{0} Quadratmeter',
                'other' => '{0} Quadratmeter',
            ],
            'area-square-mile'         => [
                'one'   => '{0} Quadratmeile',
                'other' => '{0} Quadratmeilen',
            ],
            'duration-day'             => [
                'one'   => '{0} Tag',
                'other' => '{0} Tage',
            ],
            'duration-hour'            => [
                'one'   => '{0} Stunde',
                'other' => '{0} Stunden',
            ],
            'duration-millisecond'     => [
                'one'   => '{0} Millisekunde',
                'other' => '{0} Millisekunden',
            ],
            'duration-minute'          => [
                'one'   => '{0} Minute',
                'other' => '{0} Minuten',
            ],
            'duration-month'           => [
                'one'   => '{0} Monat',
                'other' => '{0} Monate',
            ],
            'duration-second'          => [
                'one'   => '{0} Sekunde',
                'other' => '{0} Sekunden',
            ],
            'duration-week'            => [
                'one'   => '{0} Woche',
                'other' => '{0} Wochen',
            ],
            'duration-year'            => [
                'one'   => '{0} Jahr',
                'other' => '{0} Jahre',
            ],
            'length-centimeter'        => [
                'one'   => '{0} Zentimeter',
                'other' => '{0} Zentimeter',
            ],
            'length-foot'              => [
                'one'   => '{0} Fuß',
                'other' => '{0} Fuß',
            ],
            'length-inch'              => [
                'one'   => '{0} Zoll',
                'other' => '{0} Zoll',
            ],
            'length-kilometer'         => [
                'one'   => '{0} Kilometer',
                'other' => '{0} Kilometer',
            ],
            'length-light-year'        => [
                'one'   => '{0} Lichtjahr',
                'other' => '{0} Lichtjahre',
            ],
            'length-meter'             => [
                'one'   => '{0} Meter',
                'other' => '{0} Meter',
            ],
            'length-mile'              => [
                'one'   => '{0} Meile',
                'other' => '{0} Meilen',
            ],
            'length-millimeter'        => [
                'one'   => '{0} Millimeter',
                'other' => '{0} Millimeter',
            ],
            'length-picometer'         => [
                'one'   => '{0} Pikometer',
                'other' => '{0} Pikometer',
            ],
            'length-yard'              => [
                'one'   => '{0} Yard',
                'other' => '{0} Yards',
            ],
            'mass-gram'                => [
                'one'   => '{0} Gramm',
                'other' => '{0} Gramm',
            ],
            'mass-kilogram'            => [
                'one'   => '{0} Kilogramm',
                'other' => '{0} Kilogramm',
            ],
            'mass-ounce'               => [
                'one'   => '{0} Unze',
                'other' => '{0} Unzen',
            ],
            'mass-pound'               => [
                'one'   => '{0} Pfund',
                'other' => '{0} Pfund',
            ],
            'power-horsepower'         => [
                'one'   => '{0} Pferdestärke',
                'other' => '{0} Pferdestärken',
            ],
            'power-kilowatt'           => [
                'one'   => '{0} Kilowatt',
                'other' => '{0} Kilowatt',
            ],
            'power-watt'               => [
                'one'   => '{0} Watt',
                'other' => '{0} Watt',
            ],
            'pressure-hectopascal'     => [
                'one'   => '{0} Hektopascal',
                'other' => '{0} Hektopascal',
            ],
            'pressure-inch-hg'         => [
                'one'   => '{0} Zoll Quecksilbersäule',
                'other' => '{0} Zoll Quecksilbersäule',
            ],
            'pressure-millibar'        => [
                'one'   => '{0} Millibar',
                'other' => '{0} Millibar',
            ],
            'speed-kilometer-per-hour' => [
                'one'   => '{0} Kilometer pro Stunde',
                'other' => '{0} Kilometer pro Stunde',
            ],
            'speed-meter-per-second'   => [
                'one'   => '{0} Meter pro Sekunde',
                'other' => '{0} Meter pro Sekunde',
            ],
            'speed-mile-per-hour'      => [
                'one'   => '{0} Meile pro Stunde',
                'other' => '{0} Meilen pro Stunde',
            ],
            'temperature-celsius'      => [
                'one'   => '{0} Grad Celsius',
                'other' => '{0} Grad Celsius',
            ],
            'temperature-fahrenheit'   => [
                'one'   => '{0} Grad Fahrenheit',
                'other' => '{0} Grad Fahrenheit',
            ],
            'volume-cubic-kilometer'   => [
                'one'   => '{0} Kubikkilometer',
                'other' => '{0} Kubikkilometer',
            ],
            'volume-cubic-mile'        => [
                'one'   => '{0} Kubikmeile',
                'other' => '{0} Kubikmeilen',
            ],
            'volume-liter'             => [
                'one'   => '{0} Liter',
                'other' => '{0} Liter',
            ],
        ];
        $this->assertEquals($result, $value);

        $value = Zend_Locale_Data::getContent('de_AT', 'unit', ['duration-day', 'one']);
        $this->assertEquals('{0} Tag', $value);
    }

    /**
     * @group ZF-12103
     */
    public function testGetListNonexistentTypeReturnsEmptyArray()
    {
        $result = Zend_Locale_Data::getList('de_AT', 'type', 'ddd');
        $this->assertTrue(is_array($result));
        $this->assertTrue(empty($result));
    }

    /**
     * @group ZF-12103
     */
    public function testGetListValidTypeReturnsNonemptyArray()
    {
        $result = Zend_Locale_Data::getList('de_AT', 'type', 'calendar');
        $this->assertTrue(is_array($result));
        $this->assertTrue(count($result) > 0);
    }

    /**
     * @group ZF-12103
     */
    public function testGetListEmptyTypeReturnsNonemptyArray()
    {
        $result = Zend_Locale_Data::getList('de_AT', 'type', '');
        $this->assertTrue(is_array($result));
        $this->assertTrue(count($result) > 0);
    }

    /**
     * @group GH-465
     */
    public function testCreateValidCacheIdsInGetContentMethod()
    {
        try {
            $content = Zend_Locale_Data::getContent('de_DE', 'language', 1234.56);
        } catch (Zend_Cache_Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    /**
     * @group GH-465
     */
    public function testCreateValidCacheIdsInGetListMethod()
    {
        try {
            $list = Zend_Locale_Data::getList('de_DE', 'language', 1234.56);
        } catch (Zend_Cache_Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    /**
     * @group GH-516
     */
    public function testGetParentLocale()
    {
        // Tests only with locale
        $result = Zend_Locale_Data::getContent('pa_Arab', 'parentlocale');
        $this->assertEquals('root', $result);
        $result = Zend_Locale_Data::getContent('en_CK', 'parentlocale');
        $this->assertEquals('en_001', $result);
        $result = Zend_Locale_Data::getContent('en_JE', 'parentlocale');
        $this->assertEquals('en_GB', $result);
        $result = Zend_Locale_Data::getContent('es_AR', 'parentlocale');
        $this->assertEquals('es_419', $result);
        $result = Zend_Locale_Data::getContent('pt_CV', 'parentlocale');
        $this->assertEquals('pt_PT', $result);
        $result = Zend_Locale_Data::getContent('zh_Hant_MO', 'parentlocale');
        $this->assertEquals('zh_Hant_HK', $result);

        // Test with value
        $result = Zend_Locale_Data::getContent('de_DE', 'parentlocale', 'zh_Hant_MO');
        $this->assertEquals('zh_Hant_HK', $result);

        // Test without parent locale
        $result = Zend_Locale_Data::getContent('de_DE', 'parentlocale');
        $this->assertFalse($result);
    }

    /**
     * @group GH-516
     */
    public function testLocaleWhichHasParentLocale()
    {
        $result = Zend_Locale_Data::getContent('en_HK', 'nametocurrency', 'XAF');
        $this->assertEquals('Central African CFA Franc', $result);
    }
}
