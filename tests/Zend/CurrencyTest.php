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
 * @package    Zend_Currency
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_Currency
 */
require_once 'Zend/Locale.php';
require_once 'Zend/Currency.php';


/**
 * @category   Zend
 * @package    Zend_Currency
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Currency
 */
class Zend_CurrencyTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        require_once 'Zend/Cache.php';
        $this->_cache = Zend_Cache::factory('Core', 'File',
                 ['lifetime' => 120, 'automatic_serialization' => true],
                 ['cache_dir' => dirname(__FILE__) . '/_files/']);
        Zend_Currency::setCache($this->_cache);
    }

    public function tearDown()
    {
        $this->_cache->clean(Zend_Cache::CLEANING_MODE_ALL);
    }

    /**
     * tests the creation of Zend_Currency
     */
    public function testSingleCreation()
    {
        // look if locale is detectable
        try {
            $locale = new Zend_Locale();
        } catch (Zend_Locale_Exception $e) {
            $this->markTestSkipped('Autodetection of locale failed');
            return;
        }

        $locale = new Zend_Locale('de_AT');

        try {
            $currency = new Zend_Currency();
            $this->assertTrue($currency instanceof Zend_Currency);
        } catch (Zend_Currency_Exception $e) {
            $this->assertContains('No region found within the locale', $e->getMessage());
        }

        $currency = new Zend_Currency('de_AT');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('€ 1.000,00', $currency->toCurrency(1000));

        $currency = new Zend_Currency('de_DE');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('1.000,00 €', $currency->toCurrency(1000));

        $currency = new Zend_Currency($locale);
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('€ 1.000,00', $currency->toCurrency(1000));

        try {
            $currency = new Zend_Currency('de_XX');
            $this->fail("Locale without region should not been recognised");
        } catch (Zend_Currency_Exception $e) {
            // success
        }

        try {
            $currency = new Zend_Currency('xx_XX');
        } catch (Zend_Currency_Exception $e) {
            // success
        }

        try {
            $currency = new Zend_Currency(['currency' => 'EUR']);
            $this->assertTrue($currency instanceof Zend_Currency);
        } catch (Zend_Currency_Exception $e) {
            $this->assertContains('No region found within the locale', $e->getMessage());
        }

        try {
            $currency = new Zend_Currency(['currency' => 'USD']);
            $this->assertTrue($currency instanceof Zend_Currency);
        } catch (Zend_Currency_Exception $e) {
            $this->assertContains('No region found within the locale', $e->getMessage());
        }

        try {
            $currency = new Zend_Currency(['currency' => 'AWG']);
            $this->assertTrue($currency instanceof Zend_Currency);
        } catch (Zend_Currency_Exception $e) {
            $this->assertContains('No region found within the locale', $e->getMessage());
        }
    }

    /**
     * tests the creation of Zend_Currency
     */
    public function testDualCreation()
    {
        $locale = new Zend_Locale('de_AT');

        $currency = new Zend_Currency('USD', 'de_AT');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('$ 1.000,00', $currency->toCurrency(1000));

        $currency = new Zend_Currency('USD', $locale);
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('$ 1.000,00', $currency->toCurrency(1000));

        $currency = new Zend_Currency('de_AT', 'USD');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('$ 1.000,00', $currency->toCurrency(1000));

        $currency = new Zend_Currency($locale, 'USD');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('$ 1.000,00', $currency->toCurrency(1000));

        $currency = new Zend_Currency('EUR', 'de_AT');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('€ 1.000,00', $currency->toCurrency(1000));

        try {
            $currency = new Zend_Currency('EUR', 'xx_YY');
            $this->fail("unknown locale should not have been recognised");
        } catch (Zend_Currency_Exception $e) {
            // success
        }
    }

    /**
     * tests the creation of Zend_Currency
     */
    public function testTripleCreation()
    {
        $locale = new Zend_Locale('de_AT');

        $currency = new Zend_Currency('USD', 'de_AT');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('$ 1.000,00', $currency->toCurrency(1000));

        $currency = new Zend_Currency('USD', $locale);
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('$ 1.000,00', $currency->toCurrency(1000));

        try {
            $currency = new Zend_Currency('XXX', 'Latin', $locale);
            $this->fail("unknown shortname should not have been recognised");
        } catch (Zend_Currency_Exception $e) {
            // success
        }
        try {
            $currency = new Zend_Currency('USD', 'Xyzz', $locale);
            $this->fail("unknown script should not have been recognised");
        } catch (Zend_Currency_Exception $e) {
            // success
        }
        try {
            $currency = new Zend_Currency('USD', 'Latin', 'xx_YY');
            $this->fail("unknown locale should not have been recognised");
        } catch (Zend_Currency_Exception $e) {
            // success
        }

        $currency = new Zend_Currency('USD', 'de_AT');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('$ 1.000,00', $currency->toCurrency(1000));

        $currency = new Zend_Currency('Euro', 'de_AT');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('EUR 1.000,00', $currency->toCurrency(1000));

        $currency = new Zend_Currency('USD', $locale);
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('$ 1.000,00', $currency->toCurrency(1000));

        $currency = new Zend_Currency('de_AT', 'EUR');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('€ 1.000,00', $currency->toCurrency(1000));

        $currency = new Zend_Currency($locale, 'USD');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('$ 1.000,00', $currency->toCurrency(1000));

        $currency = new Zend_Currency('EUR', 'en_US');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('€1,000.00', $currency->toCurrency(1000));

        $currency = new Zend_Currency('en_US', 'USD');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('$1,000.00', $currency->toCurrency(1000));

        $currency = new Zend_Currency($locale, 'EUR');
        $this->assertTrue($currency instanceof Zend_Currency);
        $this->assertSame('€ 1.000,00', $currency->toCurrency(1000));
    }

    /**
     * tests failed creation of Zend_Currency
     */
    public function testFailedCreation()
    {
        $locale = new Zend_Locale('de_AT');

        try {
            $currency = new Zend_Currency('de_AT', 'en_US');
            $this->fail("exception expected");
        } catch (Zend_Currency_Exception $e) {
            // success
        }
        try {
            $currency = new Zend_Currency('USD', 'EUR');
            $this->fail("exception expected");
        } catch (Zend_Currency_Exception $e) {
            // success
        }
        try {
            $currency = new Zend_Currency('Arab', 'Latn');
            $this->fail("exception expected");
        } catch (Zend_Currency_Exception $e) {
            // success
        }
        try {
            $currency = new Zend_Currency('EUR');
            $currency->toCurrency('value');
            $this->fail("exception expected");
        } catch (Zend_Currency_Exception $e) {
            // success
        }

        $currency = new Zend_Currency('EUR', 'de_AT');
        $currency->setFormat(['display' => 'SIGN']);
        $this->assertSame('SIGN 1.000,00', $currency->toCurrency(1000));

        try {
            $currency = new Zend_Currency('EUR');
            $currency->setFormat(['format' => 'xy_ZY']);
            $this->fail("exception expected");
        } catch (Zend_Currency_Exception $e) {
            // success
        }
    }

    /*
     * testing toCurrency
     */
    public function testToCurrency()
    {
        $USD = new Zend_Currency('USD','en_US');
        $EGP = new Zend_Currency('EGP','ar_EG');

        $this->assertSame('$53,292.18', $USD->toCurrency(53292.18));
        $this->assertSame('$٥٣,٢٩٢.١٨', $USD->toCurrency(53292.18, ['script' => 'Arab' ]));
        $this->assertSame('$ ٥٣.٢٩٢,١٨', $USD->toCurrency(53292.18, ['script' => 'Arab', 'format' => 'de_AT']));
        $this->assertSame('$ 53.292,18', $USD->toCurrency(53292.18, ['format' => 'de_AT']));

        $this->assertSame('ج.م.‏ 53٬292٫18', $EGP->toCurrency(53292.18));
        $this->assertSame('ج.م.‏ ٥٣٬٢٩٢٫١٨', $EGP->toCurrency(53292.18, ['script' => 'Arab']));
        $this->assertSame('ج.م.‏ ٥٣.٢٩٢,١٨', $EGP->toCurrency(53292.18, ['script' =>'Arab', 'format' => 'de_AT']));
        $this->assertSame('ج.م.‏ 53.292,18', $EGP->toCurrency(53292.18, ['format' => 'de_AT']));

        $USD = new Zend_Currency('en_US');
        $this->assertSame('$53,292.18', $USD->toCurrency(53292.18));
        try {
            $this->assertSame('$ 53,292.18', $USD->toCurrency('nocontent'));
            $this->fail("No currency expected");
        } catch (Zend_Currency_Exception $e) {
            $this->assertContains("has to be numeric", $e->getMessage());
        }

        $INR = new Zend_Currency('INR', 'de_AT');
        $this->assertSame('₹ 1,20', $INR->toCurrency(1.2));
        $this->assertSame('₹ 1,00', $INR->toCurrency(1));
        $this->assertSame('₹ 0,00', $INR->toCurrency(0));
        $this->assertSame('-₹ 3,00', $INR->toCurrency(-3));
    }

    /**
     * testing setFormat
     *
     */
    public function testSetFormat()
    {
        $locale = new Zend_Locale('en_US');
        $USD    = new Zend_Currency('USD','en_US');

        $USD->setFormat(['script' => 'Arab']);
        $this->assertSame('$٥٣,٢٩٢.١٨', $USD->toCurrency(53292.18));

        $USD->setFormat(['script' => 'Arab', 'format' => 'de_AT']);
        $this->assertSame('$ ٥٣.٢٩٢,١٨', $USD->toCurrency(53292.18));

        $USD->setFormat(['script' => 'Latn', 'format' => 'de_AT']);
        $this->assertSame('$ 53.292,18', $USD->toCurrency(53292.18));

        $USD->setFormat(['script' => 'Latn', 'format' => $locale]);
        $this->assertSame('$53,292.18', $USD->toCurrency(53292.18));

        // allignment of currency signs
        $USD->setFormat(['position' => Zend_Currency::RIGHT, 'format' => 'de_AT']);
        $this->assertSame('53.292,18 $', $USD->toCurrency(53292.18));

        $USD->setFormat(['position' => Zend_Currency::RIGHT, 'format' => $locale]);
        $this->assertSame('53,292.18$', $USD->toCurrency(53292.18));

        $USD->setFormat(['position' => Zend_Currency::LEFT, 'format' => 'de_AT']);
        $this->assertSame('$ 53.292,18', $USD->toCurrency(53292.18));

        $USD->setFormat(['position' => Zend_Currency::LEFT, 'format' => $locale]);
        $this->assertSame('$53,292.18', $USD->toCurrency(53292.18));

        $USD->setFormat(['position' => Zend_Currency::STANDARD, 'format' => 'de_AT']);
        $this->assertSame('$ 53.292,18', $USD->toCurrency(53292.18));

        $USD->setFormat(['position' => Zend_Currency::STANDARD, 'format' => $locale]);
        $this->assertSame('$53,292.18', $USD->toCurrency(53292.18));

        // enable/disable currency symbols & currency names
        $USD->setFormat(['display' => Zend_Currency::NO_SYMBOL, 'format' => 'de_AT']);
        $this->assertSame('53.292,18', $USD->toCurrency(53292.18));

        $USD->setFormat(['display' => Zend_Currency::NO_SYMBOL, 'format' => $locale]);
        $this->assertSame('53,292.18', $USD->toCurrency(53292.18));

        $USD->setFormat(['display' => Zend_Currency::USE_SHORTNAME, 'format' => 'de_AT']);
        $this->assertSame('USD 53.292,18', $USD->toCurrency(53292.18));

        $USD->setFormat(['display' => Zend_Currency::USE_SHORTNAME, 'format' => $locale]);
        $this->assertSame('USD53,292.18', $USD->toCurrency(53292.18));

        $USD->setFormat(['display' => Zend_Currency::USE_NAME, 'format' => 'de_AT']);
        $this->assertSame('US Dollar 53.292,18', $USD->toCurrency(53292.18));

        $USD->setFormat(['display' => Zend_Currency::USE_NAME, 'format' => $locale]);
        $this->assertSame('US Dollar53,292.18', $USD->toCurrency(53292.18));

        $USD->setFormat(['display' => Zend_Currency::USE_SYMBOL, 'format' => 'de_AT']);
        $this->assertSame('$ 53.292,18', $USD->toCurrency(53292.18));

        $USD->setFormat(['display' => Zend_Currency::USE_SYMBOL, 'format' => $locale]);
        $this->assertSame('$53,292.18', $USD->toCurrency(53292.18));

        try {
            $USD->setFormat(['position' => 'unknown']);
            $this->fail("Exception expected");
        } catch (Zend_Currency_Exception $e) {
            $this->assertContains("Unknown position", $e->getMessage());
        }

        try {
            $USD->setFormat(['format' => 'unknown']);
            $this->fail("Exception expected");
        } catch (Zend_Currency_Exception $e) {
            $this->assertContains("is no format token", $e->getMessage());
        }

        try {
            $USD->setFormat(['display' => -14]);
            $this->fail("Exception expected");
        } catch (Zend_Currency_Exception $e) {
            $this->assertContains("Unknown display", $e->getMessage());
        }

        try {
            $USD->setFormat(['script' => 'unknown']);
            $this->fail("Exception expected");
        } catch (Zend_Currency_Exception $e) {
            $this->assertContains("Unknown script", $e->getMessage());
        }

        $USD->setFormat(['precision' => null]);

        try {
            $USD->setFormat(['precision' => -14]);
            $this->fail("Exception expected");
        } catch (Zend_Currency_Exception $e) {
            $this->assertContains("precision has to be between", $e->getMessage());
        }
    }

    /**
     * test getSign
     */
    public function testGetSign()
    {
        $locale   = new Zend_Locale('ar_EG');
        $currency = new Zend_Currency('ar_EG');

        $this->assertSame('ج.م.‏', $currency->getSymbol('EGP','ar_EG'));
        $this->assertSame('€',    $currency->getSymbol('EUR','de_AT'));
        $this->assertSame('ج.م.‏', $currency->getSymbol('ar_EG'      ));
        $this->assertSame('€',    $currency->getSymbol('de_AT'      ));
        $this->assertSame('ج.م.‏',    $currency->getSymbol());

        try {
            $currency->getSymbol('EGP', 'de_XX');
            $this->fail("exception expected");
        } catch (Zend_Currency_Exception $e) {
            // success
        }
    }

    /**
     * test getName
     */
    public function testGetName()
    {
        $locale   = new Zend_Locale('ar_EG');
        $currency = new Zend_Currency('ar_EG');

        $this->assertSame('جنيه مصري',       $currency->getName('EGP','ar_EG'));
        $this->assertSame('Estnische Krone', $currency->getName('EEK','de_AT'));
        $this->assertSame('جنيه مصري',       $currency->getName('EGP',$locale));
        $this->assertSame('جنيه مصري',       $currency->getName('ar_EG'      ));
        $this->assertSame('Euro',            $currency->getName('de_AT'      ));
        $this->assertSame('جنيه مصري',       $currency->getName());

        try {
            $currency->getName('EGP', 'xy_XY');
            $this->fail("exception expected");
        } catch (Zend_Currency_Exception $e) {
            // success
        }
    }

    /**
     * test getShortName
     */
    public function testGetShortName()
    {
        $locale   = new Zend_Locale('de_AT');
        $currency = new Zend_Currency('de_AT');

        $this->assertSame('EUR', $currency->getShortName('Euro',     'de_AT'));
        $this->assertSame('EUR', $currency->getShortName('Euro',     $locale));
        $this->assertSame('USD', $currency->getShortName('US-Dollar','de_AT'));
        $this->assertSame('EUR', $currency->getShortName('de_AT'            ));
        $this->assertSame('EUR', $currency->getShortName());

        try {
            $currency->getShortName('EUR', 'xy_ZT');
            $this->fail("exception expected");
        } catch (Zend_Currency_Exception $e) {
            // success
        }
    }

    /**
     * testing getRegionList
     */
    public function testGetRegionList()
    {
        // look if locale is detectable
        try {
            $locale = new Zend_Locale();
        } catch (Zend_Locale_Exception $e) {
            $this->markTestSkipped('Autodetection of locale failed');
            return;
        }

        try {
            $currency = new Zend_Currency(['currency' => 'USD']);
            $this->assertTrue(in_array('US', $currency->getRegionList()));
        } catch (Zend_Currency_Exception $e) {
            $this->assertContains('No region found within the locale', $e->getMessage());
        }

        $currency = new Zend_Currency(['currency' => 'USD'], 'en_US');
        $currency->setFormat(['currency' => null]);
        try {
            $this->assertTrue(in_array('US', $currency->getRegionList()));
            $this->fail("Exception expected");
        } catch (Zend_Currency_Exception $e) {
            $this->assertContains("No currency defined", $e->getMessage());
        }

        $currency = new Zend_Currency(['currency' => 'USD'], 'en_US');
        $this->assertEquals([
            0 => 'AS', 1 => 'BQ', 2 => 'DG', 3 => 'EC', 4 => 'FM', 5 => 'GU', 6 => 'IO', 7 => 'MH',
            8 => 'MP', 9 => 'PR', 10 => 'PW', 11 => 'SV', 12 => 'TC', 13 => 'TL', 14 => 'UM',
            15 => 'US', 16 => 'VG', 17 => 'VI', 18 => 'ZW'], $currency->getRegionList());
    }

    /**
     * testing getCurrencyList
     */
    public function testGetCurrencyList()
    {
        // look if locale is detectable
        try {
            $locale = new Zend_Locale();
        } catch (Zend_Locale_Exception $e) {
            $this->markTestSkipped('Autodetection of locale failed');
            return;
        }

        $currency = new Zend_Currency('ar_EG');
        $this->assertTrue(in_array('EGP', $currency->getCurrencyList()));
    }

    /**
     * testing toString
     *
     */
    public function testToString()
    {
        $USD = new Zend_Currency('USD','en_US');
        $this->assertSame('$0.00', $USD->toString());
        $this->assertSame('$0.00', $USD->__toString());
    }

    /**
     * testing registry Locale
     * ZF-3676
     */
    public function testRegistryLocale()
    {
        $locale = new Zend_Locale('de_AT');
        require_once 'Zend/Registry.php';
        Zend_Registry::set('Zend_Locale', $locale);

        $currency = new Zend_Currency('EUR');
        $this->assertSame('de_AT', $currency->getLocale());
    }

    /**
     * Caching method tests
     */
    public function testCaching()
    {
        $cache = Zend_Currency::getCache();
        $this->assertTrue($cache instanceof Zend_Cache_Core);
        $this->assertTrue(Zend_Currency::hasCache());

        Zend_Currency::clearCache();
        $this->assertTrue(Zend_Currency::hasCache());

        Zend_Currency::removeCache();
        $this->assertFalse(Zend_Currency::hasCache());
    }

    /**
     * @see ZF-6560
     */
    public function testPrecisionForCurrency()
    {
        $currency = new Zend_Currency(null, 'de_DE');

        $this->assertEquals('75 €', $currency->toCurrency(74.95, ['precision' => 0]));
        $this->assertEquals('75,0 €', $currency->toCurrency(74.95, ['precision' => 1]));
        $this->assertEquals('74,95 €', $currency->toCurrency(74.95, ['precision' => 2]));
        $this->assertEquals('74,950 €', $currency->toCurrency(74.95, ['precision' => 3]));
        $this->assertEquals('74,9500 €', $currency->toCurrency(74.95, ['precision' => 4]));
        $this->assertEquals('74,95000 €', $currency->toCurrency(74.95, ['precision' => 5]));
    }

    /**
     * @see ZF-6561
     */
    public function testNegativeRendering()
    {
        $currency = new Zend_Currency(null, 'de_DE');
        $this->assertEquals('-74,9500 €', $currency->toCurrency(-74.95, ['currency' => 'EUR', 'precision' => 4]));

        $currency = new Zend_Currency(null, 'en_US');
        $this->assertEquals('-$74.9500', $currency->toCurrency(-74.95, ['currency' => 'USD', 'precision' => 4]));
    }

    /**
     * @see ZF-7359
     */
    public function testPHPsScientificBug()
    {
        $currency = new Zend_Currency("USD", "en_US");
        $this->assertEquals('$0.00', $currency->toCurrency(1.0E-4));
        $this->assertEquals('$0.00', $currency->toCurrency(1.0E-5));
    }

    /**
     * @see ZF-7864
     */
    public function testCurrencyToToCurrency()
    {
        $currency = new Zend_Currency("de_DE");
        $this->assertEquals('2,3000 $', $currency->toCurrency(2.3, ['currency' => 'USD', 'precision' => 4]));

        $currency = new Zend_Currency("USD", "de_DE");
        $this->assertEquals('2,3000 $', $currency->toCurrency(2.3, ['precision' => 4]));
    }

    /**
     * Testing options at initiation
     */
    public function testOptionsWithConstructor()
    {
        $currency = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT']);
        $this->assertEquals('de_AT', $currency->getLocale());
        $this->assertEquals('EUR', $currency->getShortName());
    }

    /**
     * Testing value at initiation
     */
    public function testValueWithConstructor()
    {
        $currency = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 100]);
        $this->assertEquals('de_AT', $currency->getLocale());
        $this->assertEquals('EUR', $currency->getShortName());
        $this->assertEquals('€ 100,00', $currency->toCurrency());
    }

    /**
     * Add values
     */
    public function testAddValues()
    {
        $currency = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT']);
        $currency->add(100);
        $this->assertEquals('€ 100,00', $currency->toCurrency());

        $currency->add(100)->add(100);
        $this->assertEquals('€ 300,00', $currency->toCurrency());
    }

    /**
     * Substract values
     */
    public function testSubValues()
    {
        $currency = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT']);
        $currency->sub(100);
        $this->assertEquals('-€ 100,00', $currency->toCurrency());

        $currency->sub(100)->sub(100);
        $this->assertEquals('-€ 300,00', $currency->toCurrency());
    }

    /**
     * Multiply values
     */
    public function testMulValues()
    {
        $currency = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT']);
        $currency->add(100);
        $currency->mul(2);
        $this->assertEquals('€ 200,00', $currency->toCurrency());

        $currency->mul(2)->mul(2);
        $this->assertEquals('€ 800,00', $currency->toCurrency());
    }

    /**
     * Divide values
     */
    public function testDivValues()
    {
        $currency = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT']);
        $currency->add(800);
        $currency->div(2);
        $this->assertEquals('€ 400,00', $currency->toCurrency());

        $currency->div(2)->div(2);
        $this->assertEquals('€ 100,00', $currency->toCurrency());
    }

    /**
     * Modulo values
     */
    public function testModValues()
    {
        $currency = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT']);
        $currency->add(801);
        $currency->mod(2);
        $this->assertEquals('€ 1,00', $currency->toCurrency());
    }

    /**
     * Compare values
     */
    public function testCompareValues()
    {
        $currency  = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 100]);
        $currency2 = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 100]);
        $this->assertEquals(0, $currency->compare($currency2));

        $currency3 = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 101]);
        $this->assertEquals(-1, $currency->compare($currency3));

        $currency4 = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 99]);
        $this->assertEquals(1, $currency->compare($currency4));
    }

    /**
     * Equals values
     */
    public function testEqualsValues()
    {
        $currency  = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 100]);
        $currency2 = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 100]);
        $this->assertTrue($currency->equals($currency2));

        $currency3 = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 101]);
        $this->assertFalse($currency->equals($currency3));
    }

    /**
     * IsMore values
     */
    public function testIsMoreValues()
    {
        $currency  = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 100]);
        $currency2 = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 100]);
        $this->assertFalse($currency->isMore($currency2));

        $currency3 = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 99]);
        $this->assertTrue($currency->isMore($currency3));
    }

    /**
     * IsLess values
     */
    public function testIsLessValues()
    {
        $currency  = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 100]);
        $currency2 = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 100]);
        $this->assertFalse($currency->isLess($currency2));

        $currency3 = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 101]);
        $this->assertTrue($currency->isLess($currency3));
    }

    /**
     * Exchange tests
     */
    public function testExchangeValues()
    {
        $currency  = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 100]);
        $currency2 = new Zend_Currency(['currency' => 'EUR', 'locale' => 'de_AT', 'value' => 100]);

        require_once 'Currency/ExchangeTest.php';

        $this->assertEquals(null, $currency->getService());
        $currency->setService(new ExchangeTest());
        $this->assertTrue($currency->getService() instanceof Zend_Currency_CurrencyInterface);

        $currency->setService('ExchangeTest');
        $this->assertTrue($currency->getService() instanceof Zend_Currency_CurrencyInterface);
    }

    /**
     * IsLess values
     */
    public function testConstructingPrecisionValues()
    {
        $currency  = new Zend_Currency(['value' => 100.5]);
        $this->assertEquals('€ 100,50', $currency->toString('de_AT'));
    }

    /**
     * @ZF-9491
     */
    public function testCurrencyWithSelfPattern()
    {
        $currency  = new Zend_Currency(['value' => 10000, 'format' => '#,#0', 'locale' => 'de_DE']);
        $this->assertEquals('1.00.00', $currency->toString());
    }

    /**
     * @ZF-9519
     */
    public function testSetValueWithoutLocale()
    {
        $currency = new Zend_Currency('RUB', 'ru_RU');
        require_once 'Currency/ExchangeTest.php';

        $this->assertEquals(null, $currency->getService());
        $currency->setService(new ExchangeTest());
        $this->assertTrue($currency->getService() instanceof Zend_Currency_CurrencyInterface);

        $currency->setValue(100, 'USD');
        $this->assertEquals(50, $currency->getValue());
        $this->assertEquals('RUB', $currency->getShortName());
    }

    /**
     * @ZF-9941
     */
    public function testSetValueByOutput()
    {
        $currency = new Zend_Currency(['value' => 1000, 'locale' => 'de_AT']);
        $this->assertEquals('€ 2.000,00', $currency->toCurrency(null, ['value' => 2000]));
    }

    /**
     * @group ZF-10751
     */
    public function testSetService()
    {
        $currency = new Zend_Currency();
        $currency->setService('Zend_Currency_Service');
        $this->assertTrue($currency->getService() instanceof Zend_Currency_Service);
    }

    /**
     * @group ZF-11798
     * @dataProvider providerConstructorAllowsOverridingCurrencyDisplayFormat
     */
    public function testConstructorAllowsOverridingCurrencyDisplayFormat($display, $expected)
    {
        $currency = new Zend_Currency(['value' => 100, 'display' => $display], 'en_US');
        $this->assertEquals($expected, $currency->toString());
    }

    /**
     * Data Provider for testConstructorAllowsOverridingCurrencyDisplayFormat
     * @see ZF-11798
     */
    public function providerConstructorAllowsOverridingCurrencyDisplayFormat()
    {
        return [
            [Zend_Currency::NO_SYMBOL, '100.00'],
            [Zend_Currency::USE_SYMBOL, '$100.00'],
            [Zend_Currency::USE_SHORTNAME, 'USD100.00'],
            [Zend_Currency::USE_NAME, 'US Dollar100.00']
        ];
    }

    /**
     * @group GH-516
     */
    public function testToCurrencyWithLocaleWhichHasParentLocale()
    {
        $currency = new Zend_Currency(null, 'es_AR');
        $this->assertEquals('$10,00', $currency->toCurrency(10));
    }
}
