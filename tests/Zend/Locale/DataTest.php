<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

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
class Zend_Locale_DataTest extends TestCase
{
    private $_cache = null;

    protected function set_up()
    {
        require_once 'Zend/Cache.php';
        $this->_cache = Zend_Cache::factory(
            'Core',
            'File',
            ['lifetime' => 1, 'automatic_serialization' => true],
            ['cache_dir' => dirname(__FILE__) . '/../_files/']
        );
        Zend_Locale_Data::setCache($this->_cache);
    }


    protected function tear_down()
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
            $value = Zend_Locale_Data::getList('nolocale', 'language');
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
     * @doesNotPerformAssertions
     */
    public function testNoType()
    {
        try {
            $value = Zend_Locale_Data::getContent('de', '');
            $this->fail('content should throw an exception');
        } catch (Zend_Locale_Exception $e) {
            // success
        }

        try {
            $value = Zend_Locale_Data::getContent('de', 'xxxxxxx');
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
        $data = Zend_Locale_Data::getList('de', 'language');
        $this->assertEquals('Deutsch', $data['de']);
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
        $this->assertEquals('Arabisch', $data['Arab']);
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
        $this->assertEquals('Saho', $data['SAAHO']);

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
        $this->assertEquals('Kalender', $data['calendar']);
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
        $this->assertEquals('Strichfolge', $data['stroke']);

        $data = Zend_Locale_Data::getList('de_AT', 'type', 'calendar');
        $this->assertEquals('Chinesischer Kalender', $data['chinese']);
        $this->assertEquals('Japanischer Kalender', $data['japanese']);

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
        $data = Zend_Locale_Data::getList('de', 'characters');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('characters', $data);
        $this->assertArrayHasKey('auxiliary', $data);
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
        $data = Zend_Locale_Data::getList('de', 'measurement');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('001', $data['metric']);
        $this->assertSame('001', $data['A4']);
        $this->assertSame('BZ CA CL CO CR GT MX NI PA PH PR SV US VE', $data['US-Letter']);
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
        $data = Zend_Locale_Data::getList('de_AT', 'months');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('format', $data['context']);
        $this->assertSame('Dezember', $data['format']['wide'][12]);
        $this->assertSame('Dezember', $data['stand-alone']['wide'][12]);

        $data = Zend_Locale_Data::getList('de_AT', 'months', 'islamic');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('format', $data['context']);
        $this->assertSame('Shawwal', $data['format']['wide'][10]);
        $this->assertSame('Shawwal', $data['stand-alone']['wide'][10]);

        $data = Zend_Locale_Data::getList('de_AT', 'month');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Jänner', $data[1]);
        $this->assertSame('Juli', $data[7]);
        $this->assertSame('Dezember', $data[12]);

        $data = Zend_Locale_Data::getList('de_AT', 'month', ['gregorian', 'format', 'wide']);
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Jänner', $data[1]);
        $this->assertSame('Juli', $data[7]);
        $this->assertSame('Dezember', $data[12]);

        $data = Zend_Locale_Data::getContent('de_AT', 'month', 12);
        $this->assertSame('Dezember', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'month', ['gregorian', 'format', 'wide', 12]);
        $this->assertSame('Dezember', $data);

        $data = Zend_Locale_Data::getContent('ar', 'month', ['islamic', 'format', 'wide', 1]);
        $this->assertSame('محرم', $data);
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
        $data = Zend_Locale_Data::getList('de_AT', 'days');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('format', $data['context']);
        $this->assertSame('Samstag', $data['format']['wide']['sat']);
        $this->assertSame('Samstag', $data['stand-alone']['wide']['sat']);

        $data = Zend_Locale_Data::getList('de_AT', 'days', 'islamic');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('format', $data['context']);
        $this->assertSame('S', $data['format']['narrow']['sat']);
        $this->assertSame('S', $data['stand-alone']['narrow']['sat']);

        $data = Zend_Locale_Data::getList('de_AT', 'day');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Sonntag', $data['sun']);
        $this->assertSame('Mittwoch', $data['wed']);
        $this->assertSame('Samstag', $data['sat']);

        $data = Zend_Locale_Data::getList('de_AT', 'day', ['gregorian', 'format', 'wide']);
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Sonntag', $data['sun']);
        $this->assertSame('Mittwoch', $data['wed']);
        $this->assertSame('Samstag', $data['sat']);

        $data = Zend_Locale_Data::getContent('de_AT', 'day', 'mon');
        $this->assertSame('Montag', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'day', ['gregorian', 'format', 'wide', 'mon']);
        $this->assertSame('Montag', $data);

        $data = Zend_Locale_Data::getContent('ar', 'day', ['islamic', 'format', 'wide', 'mon']);
        $this->assertIsString($data);
        $this->assertNotSame('', $data);
    }

    /**
     * test for reading quarter from locale
     * expected array
     */
    public function testQuarter()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'quarters');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Q1', $data['format']['abbreviated'][1]);
        $this->assertSame('Q1', $data['stand-alone']['abbreviated'][1]);
        $this->assertSame('4. Quartal', $data['stand-alone']['wide'][4]);

        $data = Zend_Locale_Data::getList('de_AT', 'quarters', 'islamic');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Q1', $data['format']['abbreviated'][1]);
        $this->assertSame('Q1', $data['stand-alone']['abbreviated'][1]);
        $this->assertSame('4', $data['stand-alone']['narrow'][4]);

        $data = Zend_Locale_Data::getList('de_AT', 'quarter');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('1. Quartal', $data[1]);
        $this->assertSame('3. Quartal', $data[3]);
        $this->assertSame('4. Quartal', $data[4]);

        $data = Zend_Locale_Data::getList('de_AT', 'quarter', ['gregorian', 'format', 'wide']);
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('1. Quartal', $data[1]);
        $this->assertSame('3. Quartal', $data[3]);
        $this->assertSame('4. Quartal', $data[4]);

        $data = Zend_Locale_Data::getContent('de_AT', 'quarter', '1');
        $this->assertSame('1. Quartal', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'quarter', ['gregorian', 'format', 'wide', '1']);
        $this->assertSame('1. Quartal', $data);

        $data = Zend_Locale_Data::getContent('ar', 'quarter', ['islamic', 'format', 'wide', '1']);
        $this->assertIsString($data);
        $this->assertNotSame('', $data);
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
        $data = Zend_Locale_Data::getContent('de_AT', 'am');
        $this->assertIsString($data);
        $this->assertNotSame('', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'am', 'islamic');
        $this->assertSame('AM', $data);
    }

    /**
     * test for reading pm from locale
     * expected array
     */
    public function testPm()
    {
        $data = Zend_Locale_Data::getContent('de_AT', 'pm');
        $this->assertIsString($data);
        $this->assertNotSame('', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'pm', 'islamic');
        $this->assertSame('PM', $data);
    }

    /**
     * test for reading era from locale
     * expected array
     */
    public function testEra()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'eras');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('v. Chr.', $data['names'][0]);
        $this->assertSame('n. Chr.', $data['abbreviated'][1]);
        $this->assertSame('n. Chr.', $data['narrow'][1]);

        $data = Zend_Locale_Data::getList('de_AT', 'eras', 'islamic');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('AH', $data['names'][0]);
        $this->assertSame('AH', $data['abbreviated'][0]);
        $this->assertSame('AH', $data['narrow'][0]);

        $data = Zend_Locale_Data::getList('de_AT', 'era');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('v. Chr.', $data[0]);
        $this->assertSame('n. Chr.', $data[1]);

        $data = Zend_Locale_Data::getList('de_AT', 'era', ['gregorian', 'Abbr']);
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('v. Chr.', $data[0]);
        $this->assertSame('n. Chr.', $data[1]);

        $data = Zend_Locale_Data::getContent('de_AT', 'era', '1');
        $this->assertSame('n. Chr.', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'era', ['gregorian', 'Names', '1']);
        $this->assertSame('n. Chr.', $data);

        $data = Zend_Locale_Data::getContent('ar', 'era', ['islamic', 'Abbr', '0']);
        $this->assertSame('هـ', $data);
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
        $data = Zend_Locale_Data::getList('de_AT', 'date');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('dd.MM.y', $data['medium']);
        $this->assertSame('dd.MM.yy', $data['short']);

        $data = Zend_Locale_Data::getList('de_AT', 'date', 'islamic');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('full', $data);
        $this->assertArrayHasKey('long', $data);
        $this->assertArrayHasKey('medium', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'date');
        $this->assertSame('dd.MM.y', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'date', 'long');
        $this->assertIsString($data);
        $this->assertNotSame('', $data);

        $data = Zend_Locale_Data::getContent('ar', 'date', ['islamic', 'long']);
        $this->assertIsString($data);
        $this->assertNotSame('', $data);
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
        $data = Zend_Locale_Data::getList('de_AT', 'time');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('HH:mm:ss zzzz', $data['full']);
        $this->assertSame('HH:mm:ss', $data['medium']);
        $this->assertSame('HH:mm', $data['short']);

        $data = Zend_Locale_Data::getList('de_AT', 'time', 'islamic');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('HH:mm:ss zzzz', $data['full']);
        $this->assertSame('HH:mm:ss', $data['medium']);
        $this->assertSame('HH:mm', $data['short']);

        $data = Zend_Locale_Data::getContent('de_AT', 'time');
        $this->assertSame('HH:mm:ss', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'time', 'long');
        $this->assertSame('HH:mm:ss z', $data);

        $data = Zend_Locale_Data::getContent('ar', 'time', ['islamic', 'long']);
        $this->assertIsString($data);
        $this->assertNotSame('', $data);
    }

    /**
     * test for reading datetime from locale
     * expected array
     */
    public function testDateTime()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'datetime');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('full', $data);
        $this->assertArrayHasKey('long', $data);
        $this->assertArrayHasKey('medium', $data);

        $data = Zend_Locale_Data::getList('de_AT', 'datetime', 'gregorian');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('full', $data);
        $this->assertArrayHasKey('long', $data);
        $this->assertArrayHasKey('medium', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'datetime', 'full');
        $this->assertIsString($data);
        $this->assertNotSame('', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'datetime', ['gregorian', 'long']);
        $this->assertIsString($data);
        $this->assertNotSame('', $data);
    }

    /**
     * test for reading field from locale
     * expected array
     */
    public function testField()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'field');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Epoche', $data['era']);
        $this->assertSame('Wochentag', $data['weekday']);
        $this->assertSame('Zeitzone', $data['zone']);

        $data = Zend_Locale_Data::getList('de_AT', 'field', 'gregorian');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Epoche', $data['era']);
        $this->assertSame('Wochentag', $data['weekday']);
        $this->assertSame('Zeitzone', $data['zone']);

        $data = Zend_Locale_Data::getContent('de_AT', 'field', 'week');
        $this->assertSame('Woche', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'field', ['gregorian', 'week']);
        $this->assertSame('Woche', $data);
    }

    /**
     * test for reading relative from locale
     * expected array
     */
    public function testRelative()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'relative');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey(-2, $data);
        $this->assertArrayHasKey(-1, $data);
        $this->assertArrayHasKey(0, $data);

        $data = Zend_Locale_Data::getList('de_AT', 'relative', 'day');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey(-2, $data);
        $this->assertArrayHasKey(-1, $data);
        $this->assertArrayHasKey(0, $data);

        $data = Zend_Locale_Data::getList('de_AT', 'relative', 'week');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey(-1, $data);
        $this->assertArrayHasKey(0, $data);
        $this->assertArrayHasKey(1, $data);

        $data = Zend_Locale_Data::getList('de_AT', 'relative', 'month');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey(-1, $data);
        $this->assertArrayHasKey(0, $data);
        $this->assertArrayHasKey(1, $data);

        $data = Zend_Locale_Data::getList('de_AT', 'relative', 'year');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey(-1, $data);
        $this->assertArrayHasKey(0, $data);
        $this->assertArrayHasKey(1, $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'relative', '-1');
        $this->assertIsString($data);
        $this->assertNotSame('', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'relative', ['gregorian', '-1']);
        $this->assertIsString($data);
        $this->assertNotSame('', $data);
    }

    /**
     * test for reading symbols from locale
     * expected array
     */
    public function testSymbols()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'symbols');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame(',', $data['decimal']);
        $this->assertSame('-', $data['minus']);
        $this->assertSame('NaN', $data['nan']);
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
        $data = Zend_Locale_Data::getList('de_AT', 'nametocurrency');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Andorranische Pesete', $data['ADP']);
        $this->assertSame('Luxemburgischer Franc (konvertibel)', $data['LUC']);
        $this->assertSame('Simbabwe-Dollar (2008)', $data['ZWR']);

        $data = Zend_Locale_Data::getContent('de_AT', 'nametocurrency', 'USD');
        $this->assertSame('US-Dollar', $data);
    }

    /**
     * test for reading currencytoname from locale
     * expected array
     */
    public function testCurrencyToName()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'currencytoname');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('ADP', $data['Andorranische Pesete']);
        $this->assertSame('LUC', $data['Luxemburgischer Franc (konvertibel)']);
        $this->assertSame('ZWR', $data['Simbabwe-Dollar (2008)']);

        $data = Zend_Locale_Data::getContent('de_AT', 'currencytoname', 'Unze Platin');
        $this->assertSame('XPT', $data);
    }

    /**
     * test for reading currencysymbol from locale
     * expected array
     */
    public function testCurrencySymbol()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'currencysymbol');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('öS', $data['ATS']);
        $this->assertSame('¥', $data['JPY']);
        $this->assertSame('CFPF', $data['XPF']);

        $data = Zend_Locale_Data::getContent('de_AT', 'currencysymbol', 'USD');
        $this->assertSame('$', $data);
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
        $data = Zend_Locale_Data::getList('de_AT', 'currencyfraction');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('0', $data['ADP']);
        $this->assertSame('0', $data['LBP']);
        $this->assertSame('0', $data['ZWD']);

        $data = Zend_Locale_Data::getContent('de_AT', 'currencyfraction');
        $this->assertSame('2', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'currencyfraction', 'BHD');
        $this->assertSame('3', $data);
    }

    /**
     * test for reading currencyrounding from locale
     * expected array
     */
    public function testCurrencyRounding()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'currencyrounding');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('0', $data['ADP']);
        $this->assertSame('0', $data['LUF']);
        $this->assertSame('0', $data['ZWD']);

        $data = Zend_Locale_Data::getContent('de_AT', 'currencyrounding');
        $this->assertSame('0', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'currencyrounding', 'BHD');
        $this->assertSame('0', $data);
    }

    /**
     * test for reading currencytoregion from locale
     * expected array
     */
    public function testCurrencyToRegion()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'currencytoregion');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('SHP', $data['AC']);
        $this->assertSame('KWD', $data['KW']);
        $this->assertSame('ZRN', $data['ZR']);

        $data = Zend_Locale_Data::getContent('de_AT', 'currencytoregion', 'AT');
        $this->assertSame('EUR', $data);
    }

    /**
     * test for reading regiontocurrency from locale
     * expected array
     */
    public function testRegionToCurrency()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'regiontocurrency');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('AC SH', $data['SHP']);
        $this->assertSame('KM', $data['KMF']);
        $this->assertSame('ZR', $data['ZRN']);

        $data = Zend_Locale_Data::getContent('de_AT', 'regiontocurrency', 'EUR');
        $this->assertIsString($data);
        $this->assertNotSame('', $data);
    }

    /**
     * test for reading regiontoterritory from locale
     * expected array
     */
    public function testRegionToTerritory()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'regiontoterritory');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('019 002 150 142 009', $data['001']);
        $this->assertSame('015 011 017 014 018', $data['002']);
        $this->assertSame('053 054 057 061 QO', $data['009']);

        $data = Zend_Locale_Data::getContent('de_AT', 'regiontoterritory', '143');
        $this->assertSame('TM TJ KG KZ UZ', $data);
    }

    /**
     * test for reading territorytoregion from locale
     * expected array
     */
    public function testTerritoryToRegion()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'territorytoregion');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('001', $data['019']);
        $this->assertSame('029', $data['CW']);
        $this->assertSame('QO', $data['TA']);

        $data = Zend_Locale_Data::getContent('de_AT', 'territorytoregion', 'AT');
        $this->assertIsString($data);
        $this->assertNotSame('', $data);
    }

    /**
     * test for reading scripttolanguage from locale
     * expected array
     */
    public function testScriptToLanguage()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'scripttolanguage');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Latn', $data['aa']);
        $this->assertSame('Latn', $data['li']);
        $this->assertSame('Latn', $data['zun']);

        $data = Zend_Locale_Data::getContent('de_AT', 'scripttolanguage', 'uk');
        $this->assertSame('Cyrl', $data);
    }

    /**
     * test for reading languagetoscript from locale
     * expected array
     */
    public function testLanguageToScript()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'languagetoscript');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('ae', $data['Avst']);
        $this->assertSame('ko', $data['Kore']);
        $this->assertSame('xsa', $data['Sarb']);

        $data = Zend_Locale_Data::getContent('de_AT', 'languagetoscript', 'Kana');
        $this->assertIsString($data);
        $this->assertNotSame('', $data);
    }

    /**
     * test for reading territorytolanguage from locale
     * expected array
     */
    public function testTerritoryToLanguage()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'territorytolanguage');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('GH', $data['abr']);
        $this->assertSame('LT', $data['lt']);
        $this->assertSame('TR', $data['zza']);

        $data = Zend_Locale_Data::getContent('de_AT', 'territorytolanguage', 'uk');
        $this->assertSame('UA', $data);
    }

    /**
     * test for reading languagetoterritory from locale
     * expected array
     */
    public function testLanguageToTerritory()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'languagetoterritory');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('ca', $data['AD']);
        $this->assertSame('en', $data['LC']);
        $this->assertSame('buc fr swb', $data['YT']);

        $data = Zend_Locale_Data::getContent('de_AT', 'languagetoterritory', 'GQ');
        $this->assertIsString($data);
        $this->assertNotSame('', $data);
    }

    /**
     * test for reading timezonetowindows from locale
     * expected array
     */
    public function testTimezoneToWindows()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'timezonetowindows');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Etc/GMT+12', $data['Dateline Standard Time']);
        $this->assertSame('Africa/Tripoli', $data['Libya Standard Time']);
        $this->assertSame('Pacific/Apia', $data['Samoa Standard Time']);

        $data = Zend_Locale_Data::getContent('de_AT', 'timezonetowindows', 'Fiji Standard Time');
        $this->assertSame('Pacific/Fiji', $data);
    }

    /**
     * test for reading windowstotimezone from locale
     * expected array
     */
    public function testWindowsToTimezone()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'windowstotimezone');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Dateline Standard Time', $data['Etc/GMT+12']);
        $this->assertSame('W. Central Africa Standard Time', $data['Africa/Kinshasa']);
        $this->assertSame('Samoa Standard Time', $data['Pacific/Apia']);

        $data = Zend_Locale_Data::getContent('de_AT', 'windowstotimezone', 'Pacific/Fiji');
        $this->assertSame('Fiji Standard Time', $data);
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
            'BI' => 'Africa/Bujumbura',
            'BW' => 'Africa/Gaborone',
            'CD' => 'Africa/Lubumbashi',
            'MW' => 'Africa/Blantyre',
            'RW' => 'Africa/Kigali',
            'ZM' => 'Africa/Lusaka',
            'ZW' => 'Africa/Harare',
            'DJ' => 'Africa/Djibouti',
            'ER' => 'Africa/Asmera',
            'ET' => 'Africa/Addis_Ababa',
            'KM' => 'Indian/Comoro',
            'MG' => 'Indian/Antananarivo',
            'SO' => 'Africa/Mogadishu',
            'TZ' => 'Africa/Dar_es_Salaam',
            'UG' => 'Africa/Kampala',
            'YT' => 'Indian/Mayotte',
            'LS' => 'Africa/Maseru',
            'SZ' => 'Africa/Mbabane',
            'AO' => 'Africa/Luanda',
            'BJ' => 'Africa/Porto-Novo',
            'CF' => 'Africa/Bangui',
            'CG' => 'Africa/Brazzaville',
            'CM' => 'Africa/Douala',
            'GA' => 'Africa/Libreville',
            'GQ' => 'Africa/Malabo',
            'NE' => 'Africa/Niamey',
            'TD' => 'Africa/Ndjamena',
            'BZ' => 'America/Belize',
            'CA' => 'America/Winnipeg',
            'CR' => 'America/Costa_Rica',
            'GT' => 'America/Guatemala',
            'HN' => 'America/Tegucigalpa',
            'MX' => 'America/Mexico_City',
            'SV' => 'America/El_Salvador',
            'BS' => 'America/Nassau',
            'HT' => 'America/Port-au-Prince',
            'JM' => 'America/Jamaica',
            'KY' => 'America/Cayman',
            'PA' => 'America/Panama',
            'TC' => 'America/Grand_Turk',
            'BH' => 'Asia/Bahrain',
            'IQ' => 'Asia/Baghdad',
            'KW' => 'Asia/Kuwait',
            'QA' => 'Asia/Qatar',
            'YE' => 'Asia/Aden',
            'AG' => 'America/Antigua',
            'AI' => 'America/Anguilla',
            'AN' => 'America/Curacao',
            'AW' => 'America/Aruba',
            'BB' => 'America/Barbados',
            'BM' => 'Atlantic/Bermuda',
            'BQ' => 'America/Kralendijk',
            'DM' => 'America/Dominica',
            'GD' => 'America/Grenada',
            'GL' => 'America/Thule',
            'GP' => 'America/Guadeloupe',
            'KN' => 'America/St_Kitts',
            'LC' => 'America/St_Lucia',
            'MF' => 'America/Marigot',
            'MQ' => 'America/Martinique',
            'MS' => 'America/Montserrat',
            'PR' => 'America/Puerto_Rico',
            'SX' => 'America/Lower_Princes',
            'TT' => 'America/Port_of_Spain',
            'VC' => 'America/St_Vincent',
            'VG' => 'America/Tortola',
            'VI' => 'America/St_Thomas',
            'GU' => 'Pacific/Guam',
            'AQ' => 'Antarctica/Palmer',
            'AD' => 'Europe/Andorra',
            'AL' => 'Europe/Tirane',
            'AT' => 'Europe/Vienna',
            'BA' => 'Europe/Sarajevo',
            'BE' => 'Europe/Brussels',
            'CH' => 'Europe/Zurich',
            'CZ' => 'Europe/Prague',
            'DE' => 'Europe/Berlin',
            'DK' => 'Europe/Copenhagen',
            'ES' => 'Europe/Madrid',
            'GI' => 'Europe/Gibraltar',
            'HR' => 'Europe/Zagreb',
            'HU' => 'Europe/Budapest',
            'IT' => 'Europe/Rome',
            'LI' => 'Europe/Vaduz',
            'LU' => 'Europe/Luxembourg',
            'MC' => 'Europe/Monaco',
            'ME' => 'Europe/Podgorica',
            'MK' => 'Europe/Skopje',
            'MT' => 'Europe/Malta',
            'NL' => 'Europe/Amsterdam',
            'NO' => 'Europe/Oslo',
            'PL' => 'Europe/Warsaw',
            'RS' => 'Europe/Belgrade',
            'SE' => 'Europe/Stockholm',
            'SI' => 'Europe/Ljubljana',
            'SK' => 'Europe/Bratislava',
            'SM' => 'Europe/San_Marino',
            'TN' => 'Africa/Tunis',
            'VA' => 'Europe/Vatican',
            'XK' => 'Europe/Belgrade',
            'AX' => 'Europe/Mariehamn',
            'BG' => 'Europe/Sofia',
            'CY' => 'Asia/Nicosia',
            'EG' => 'Africa/Cairo',
            'FI' => 'Europe/Helsinki',
            'GR' => 'Europe/Athens',
            'JO' => 'Asia/Amman',
            'LB' => 'Asia/Beirut',
            'SY' => 'Asia/Damascus',
            'FO' => 'Atlantic/Faeroe',
            'BF' => 'Africa/Ouagadougou',
            'CI' => 'Africa/Abidjan',
            'GB' => 'Europe/London',
            'GH' => 'Africa/Accra',
            'GM' => 'Africa/Banjul',
            'GN' => 'Africa/Conakry',
            'IE' => 'Europe/Dublin',
            'ML' => 'Africa/Bamako',
            'MR' => 'Africa/Nouakchott',
            'SH' => 'Atlantic/St_Helena',
            'SL' => 'Africa/Freetown',
            'SN' => 'Africa/Dakar',
            'ST' => 'Africa/Sao_Tome',
            'TG' => 'Africa/Lome',
            'OM' => 'Asia/Muscat',
            'LK' => 'Asia/Colombo',
            'KH' => 'Asia/Phnom_Penh',
            'LA' => 'Asia/Vientiane',
            'TH' => 'Asia/Bangkok',
            'KP' => 'Asia/Pyongyang',
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
        $data = Zend_Locale_Data::getList('de_AT', 'citytotimezone');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Unbekannt', $data['Etc/Unknown']);
        $this->assertSame('Jakutsk', $data['Asia/Yakutsk']);
        $this->assertSame('St. Thomas', $data['America/St_Thomas']);

        $data = Zend_Locale_Data::getContent('de_AT', 'citytotimezone', 'Pacific/Fiji');
        $this->assertSame('Fidschi', $data);
    }

    /**
     * test for reading timezonetocity from locale
     * expected array
     */
    public function testTimezoneToCity()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'timezonetocity');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('Etc/Unknown', $data['Unbekannt']);
        $this->assertSame('Asia/Yakutsk', $data['Jakutsk']);
        $this->assertSame('America/St_Thomas', $data['St. Thomas']);

        $data = Zend_Locale_Data::getContent('de_AT', 'timezonetocity', 'Fidschi');
        $this->assertSame('Pacific/Fiji', $data);
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
            93 => 'AF',
            1 => 'AG AI AS BB BM BS CA DM DO GD GU JM KN KY LC MP MS PR SX TC TT UM US VC VG VI',
            355 => 'AL',
            374 => 'AM',
            244 => 'AO',
            672 => 'AQ NF',
            54 => 'AR',
            43 => 'AT',
            61 => 'AU CC CX',
            297 => 'AW',
            358 => 'AX FI',
            994 => 'AZ',
            387 => 'BA',
            880 => 'BD',
            32 => 'BE',
            226 => 'BF',
            359 => 'BG',
            973 => 'BH',
            257 => 'BI',
            229 => 'BJ',
            590 => 'BL GP MF',
            673 => 'BN',
            591 => 'BO',
            599 => 'BQ CW',
            55 => 'BR',
            975 => 'BT',
            267 => 'BW',
            375 => 'BY',
            501 => 'BZ',
            243 => 'CD',
            236 => 'CF',
            242 => 'CG',
            41 => 'CH',
            225 => 'CI',
            682 => 'CK',
            56 => 'CL',
            237 => 'CM',
            86 => 'CN',
            57 => 'CO',
            506 => 'CR',
            53 => 'CU',
            238 => 'CV',
            357 => 'CY',
            420 => 'CZ',
            49 => 'DE',
            253 => 'DJ',
            45 => 'DK',
            213 => 'DZ',
            593 => 'EC',
            372 => 'EE',
            20 => 'EG',
            212 => 'EH MA',
            291 => 'ER',
            34 => 'ES',
            251 => 'ET',
            679 => 'FJ',
            500 => 'FK GS',
            691 => 'FM',
            298 => 'FO',
            33 => 'FR',
            241 => 'GA',
            44 => 'GB GG IM JE',
            995 => 'GE',
            594 => 'GF',
            233 => 'GH',
            350 => 'GI',
            299 => 'GL',
            220 => 'GM',
            224 => 'GN',
            240 => 'GQ',
            30 => 'GR',
            502 => 'GT',
            245 => 'GW',
            592 => 'GY',
            852 => 'HK',
            504 => 'HN',
            385 => 'HR',
            509 => 'HT',
            36 => 'HU',
            62 => 'ID',
            353 => 'IE',
            972 => 'IL PS',
            91 => 'IN',
            246 => 'IO',
            964 => 'IQ',
            98 => 'IR',
            354 => 'IS',
            39 => 'IT VA',
            962 => 'JO',
            81 => 'JP',
            254 => 'KE',
            996 => 'KG',
            855 => 'KH',
            686 => 'KI',
            269 => 'KM',
            850 => 'KP',
            82 => 'KR',
            965 => 'KW',
            7 => 'KZ RU',
            856 => 'LA',
            961 => 'LB',
            423 => 'LI',
            94 => 'LK',
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
            95 => 'MM',
            976 => 'MN',
            853 => 'MO',
            596 => 'MQ',
            222 => 'MR',
            356 => 'MT',
            230 => 'MU',
            960 => 'MV',
            265 => 'MW',
            52 => 'MX',
            60 => 'MY',
            258 => 'MZ',
            264 => 'NA',
            687 => 'NC',
            227 => 'NE',
            234 => 'NG',
            505 => 'NI',
            31 => 'NL',
            47 => 'NO SJ',
            977 => 'NP',
            674 => 'NR',
            683 => 'NU',
            64 => 'NZ',
            968 => 'OM',
            507 => 'PA',
            51 => 'PE',
            689 => 'PF',
            675 => 'PG',
            63 => 'PH',
            92 => 'PK',
            48 => 'PL',
            508 => 'PM',
            870 => 'PN',
            351 => 'PT',
            680 => 'PW',
            595 => 'PY',
            974 => 'QA',
            262 => 'RE TF YT',
            40 => 'RO',
            381 => 'RS',
            250 => 'RW',
            966 => 'SA',
            677 => 'SB',
            248 => 'SC',
            249 => 'SD',
            46 => 'SE',
            65 => 'SG',
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
            66 => 'TH',
            992 => 'TJ',
            690 => 'TK',
            670 => 'TL',
            993 => 'TM',
            216 => 'TN',
            676 => 'TO',
            90 => 'TR',
            688 => 'TV',
            886 => 'TW',
            255 => 'TZ',
            380 => 'UA',
            256 => 'UG',
            598 => 'UY',
            998 => 'UZ',
            58 => 'VE',
            84 => 'VN',
            678 => 'VU',
            681 => 'WF',
            685 => 'WS',
            967 => 'YE',
            27 => 'ZA',
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
            'AC' => '247',
            'AD' => '376',
            'AE' => '971',
            'AF' => '93',
            'AG' => '1',
            'AI' => '1',
            'AL' => '355',
            'AM' => '374',
            'AO' => '244',
            'AQ' => '672',
            'AR' => '54',
            'AS' => '1',
            'AT' => '43',
            'AU' => '61',
            'AW' => '297',
            'AX' => '358',
            'AZ' => '994',
            'BA' => '387',
            'BB' => '1',
            'BD' => '880',
            'BE' => '32',
            'BF' => '226',
            'BG' => '359',
            'BH' => '973',
            'BI' => '257',
            'BJ' => '229',
            'BL' => '590',
            'BM' => '1',
            'BN' => '673',
            'BO' => '591',
            'BQ' => '599',
            'BR' => '55',
            'BS' => '1',
            'BT' => '975',
            'BW' => '267',
            'BY' => '375',
            'BZ' => '501',
            'CA' => '1',
            'CC' => '61',
            'CD' => '243',
            'CF' => '236',
            'CG' => '242',
            'CH' => '41',
            'CI' => '225',
            'CK' => '682',
            'CL' => '56',
            'CM' => '237',
            'CN' => '86',
            'CO' => '57',
            'CR' => '506',
            'CU' => '53',
            'CV' => '238',
            'CW' => '599',
            'CX' => '61',
            'CY' => '357',
            'CZ' => '420',
            'DE' => '49',
            'DJ' => '253',
            'DK' => '45',
            'DM' => '1',
            'DO' => '1',
            'DZ' => '213',
            'EC' => '593',
            'EE' => '372',
            'EG' => '20',
            'EH' => '212',
            'ER' => '291',
            'ES' => '34',
            'ET' => '251',
            'FI' => '358',
            'FJ' => '679',
            'FK' => '500',
            'FM' => '691',
            'FO' => '298',
            'FR' => '33',
            'GA' => '241',
            'GB' => '44',
            'GD' => '1',
            'GE' => '995',
            'GF' => '594',
            'GG' => '44',
            'GH' => '233',
            'GI' => '350',
            'GL' => '299',
            'GM' => '220',
            'GN' => '224',
            'GP' => '590',
            'GQ' => '240',
            'GR' => '30',
            'GS' => '500',
            'GT' => '502',
            'GU' => '1',
            'GW' => '245',
            'GY' => '592',
            'HK' => '852',
            'HN' => '504',
            'HR' => '385',
            'HT' => '509',
            'HU' => '36',
            'ID' => '62',
            'IE' => '353',
            'IL' => '972',
            'IM' => '44',
            'IN' => '91',
            'IO' => '246',
            'IQ' => '964',
            'IR' => '98',
            'IS' => '354',
            'IT' => '39',
            'JE' => '44',
            'JM' => '1',
            'JO' => '962',
            'JP' => '81',
            'KE' => '254',
            'KG' => '996',
            'KH' => '855',
            'KI' => '686',
            'KM' => '269',
            'KN' => '1',
            'KP' => '850',
            'KR' => '82',
            'KW' => '965',
            'KY' => '1',
            'KZ' => '7',
            'LA' => '856',
            'LB' => '961',
            'LC' => '1',
            'LI' => '423',
            'LK' => '94',
            'LR' => '231',
            'LS' => '266',
            'LT' => '370',
            'LU' => '352',
            'LV' => '371',
            'LY' => '218',
            'MA' => '212',
            'MC' => '377',
            'MD' => '373',
            'ME' => '382',
            'MF' => '590',
            'MG' => '261',
            'MH' => '692',
            'MK' => '389',
            'ML' => '223',
            'MM' => '95',
            'MN' => '976',
            'MO' => '853',
            'MP' => '1',
            'MQ' => '596',
            'MR' => '222',
            'MS' => '1',
            'MT' => '356',
            'MU' => '230',
            'MV' => '960',
            'MW' => '265',
            'MX' => '52',
            'MY' => '60',
            'MZ' => '258',
            'NA' => '264',
            'NC' => '687',
            'NE' => '227',
            'NF' => '672',
            'NG' => '234',
            'NI' => '505',
            'NL' => '31',
            'NO' => '47',
            'NP' => '977',
            'NR' => '674',
            'NU' => '683',
            'NZ' => '64',
            'OM' => '968',
            'PA' => '507',
            'PE' => '51',
            'PF' => '689',
            'PG' => '675',
            'PH' => '63',
            'PK' => '92',
            'PL' => '48',
            'PM' => '508',
            'PN' => '870',
            'PR' => '1',
            'PS' => '972',
            'PT' => '351',
            'PW' => '680',
            'PY' => '595',
            'QA' => '974',
            'RE' => '262',
            'RO' => '40',
            'RS' => '381',
            'RU' => '7',
            'RW' => '250',
            'SA' => '966',
            'SB' => '677',
            'SC' => '248',
            'SD' => '249',
            'SE' => '46',
            'SG' => '65',
            'SH' => '290',
            'SI' => '386',
            'SJ' => '47',
            'SK' => '421',
            'SL' => '232',
            'SM' => '378',
            'SN' => '221',
            'SO' => '252',
            'SR' => '597',
            'SS' => '211',
            'ST' => '239',
            'SV' => '503',
            'SX' => '1',
            'SY' => '963',
            'SZ' => '268',
            'TC' => '1',
            'TD' => '235',
            'TF' => '262',
            'TG' => '228',
            'TH' => '66',
            'TJ' => '992',
            'TK' => '690',
            'TL' => '670',
            'TM' => '993',
            'TN' => '216',
            'TO' => '676',
            'TR' => '90',
            'TT' => '1',
            'TV' => '688',
            'TW' => '886',
            'TZ' => '255',
            'UA' => '380',
            'UG' => '256',
            'UM' => '1',
            'US' => '1',
            'UY' => '598',
            'UZ' => '998',
            'VA' => '39',
            'VC' => '1',
            'VE' => '58',
            'VG' => '1',
            'VI' => '1',
            'VN' => '84',
            'VU' => '678',
            'WF' => '681',
            'WS' => '685',
            'XK' => '377',
            'YE' => '967',
            'YT' => '262',
            'ZA' => '27',
            'ZM' => '260',
            'ZW' => '263',
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
            '674' => 'SM', '686' => 'SN', '706' => 'SO', '740' => 'SR', '728' => 'SS', '678' => 'ST', '810' => 'SU',
            '222' => 'SV', '534' => 'SX', '760' => 'SY', '748' => 'SZ', '796' => 'TC', '148' => 'TD', '260' => 'TF',
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
        $value = Zend_Locale_Data::getList('de_AT', 'numerictoterritory');
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
        $data = Zend_Locale_Data::getList('de_AT', 'numberingsystem');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('٠١٢٣٤٥٦٧٨٩', $data['arab']);
        $this->assertSame('᥆᥇᥈᥉᥊᥋᥌᥍᥎᥏', $data['limb']);
        $this->assertSame('꘠꘡꘢꘣꘤꘥꘦꘧꘨꘩', $data['vaii']);

        $data = Zend_Locale_Data::getContent('de_AT', 'numberingsystem', 'Arab');
        $this->assertSame('٠١٢٣٤٥٦٧٨٩', $data);
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
        $data = Zend_Locale_Data::getList('de_AT', 'dateitem');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('E, d.', $data['Ed']);
        $this->assertSame('E, d.M.y', $data['yMEd']);
        $this->assertSame('y', $data['y']);

        $data = Zend_Locale_Data::getList('de_AT', 'dateitem', 'gregorian');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('E, d.', $data['Ed']);
        $this->assertSame('E, d.M.y', $data['yMEd']);
        $this->assertSame('y', $data['y']);

        $data = Zend_Locale_Data::getContent('de_AT', 'dateitem', 'MMMd');
        $this->assertSame('d. MMM', $data);
    }

    /**
     * test for reading intervalformat from locale
     * expected array
     */
    public function testDateInterval()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'dateinterval');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('d', $data);
        $this->assertArrayHasKey('h', $data);
        $this->assertArrayHasKey('H', $data);

        $data = Zend_Locale_Data::getList('de_AT', 'dateinterval', 'gregorian');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('d', $data);
        $this->assertArrayHasKey('h', $data);
        $this->assertArrayHasKey('H', $data);

        $data = Zend_Locale_Data::getContent('de_AT', 'dateinterval', ['gregorian', 'yMMMM', 'y']);
        $this->assertIsString($data);
        $this->assertNotSame('', $data);
    }

    /**
     * test for reading intervalformat from locale
     * expected array
     */
    public function testUnit()
    {
        $data = Zend_Locale_Data::getList('de_AT', 'unit');
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertSame('{0} Grad', $data['angle-degree']['one']);
        $this->assertSame('{0} Meile', $data['length-mile']['one']);
        $this->assertSame('{0} Liter', $data['volume-liter']['other']);

        $data = Zend_Locale_Data::getContent('de_AT', 'unit', ['duration-day', 'one']);
        $this->assertSame('{0} Tag', $data);
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
     * @doesNotPerformAssertions
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
     * @doesNotPerformAssertions
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
        $data = Zend_Locale_Data::getContent('pa_Arab', 'parentlocale');
        $this->assertSame('root', $data);

        $data = Zend_Locale_Data::getContent('en_CK', 'parentlocale');
        $this->assertSame('en_001', $data);

        $data = Zend_Locale_Data::getContent('en_JE', 'parentlocale');
        $this->assertIsString($data);
        $this->assertNotSame('', $data);

        $data = Zend_Locale_Data::getContent('es_AR', 'parentlocale');
        $this->assertSame('es_419', $data);

        $data = Zend_Locale_Data::getContent('pt_CV', 'parentlocale');
        $this->assertSame('pt_PT', $data);

        $data = Zend_Locale_Data::getContent('zh_Hant_MO', 'parentlocale');
        $this->assertSame('zh_Hant_HK', $data);

        $data = Zend_Locale_Data::getContent('de_DE', 'parentlocale', 'zh_Hant_MO');
        $this->assertSame('zh_Hant_HK', $data);

        $data = Zend_Locale_Data::getContent('de_DE', 'parentlocale');
        $this->assertSame(false, $data);
    }

    /**
     * @group GH-516
     */
    public function testLocaleWhichHasParentLocale()
    {
        $result = Zend_Locale_Data::getContent('en_HK', 'nametocurrency', 'XAF');
        $this->assertEquals('Central African CFA Franc', $result);
    }

    /**
     * The flexible day period 'B' of CLDR time patterns is mapped to the
     * AM/PM marker 'a', which Zend_Date knows ('B' is the Swatch beat there).
     *
     * @group GH-441
     */
    public function testFlexibleDayPeriodIsReadAsAmPmMarker()
    {
        $this->assertEquals('ah:mm:ss', Zend_Locale_Data::getContent('zh_TW', 'time'));
        $this->assertEquals('ah:mm', Zend_Locale_Data::getContent('zh_TW', 'time', 'short'));
        $this->assertEquals('y年M月d日 ah:mm:ss', Zend_Locale_Data::getContent('zh_TW', 'datetime'));
        $this->assertEquals(['full' => 'ah:mm:ss [zzzz]', 'long' => 'ah:mm:ss [z]', 'medium' => 'ah:mm:ss', 'short' => 'ah:mm'],
            Zend_Locale_Data::getList('zh_TW', 'time'));
        $this->assertEquals('ah:mm', Zend_Locale_Data::getContent('zh_TW', 'dateitem', 'Bhm'));

        // names and other content are not touched
        $this->assertEquals('上午', Zend_Locale_Data::getContent('zh_TW', 'am'));
        $this->assertEquals('HH:mm:ss', Zend_Locale_Data::getContent('de', 'time'));
    }
}
