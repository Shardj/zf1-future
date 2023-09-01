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
 * @package    Zend_Validate
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Validate_Hostname
 */
require_once 'Zend/Validate/Hostname.php';


/**
 * @category   Zend
 * @package    Zend_Validate
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Validate
 */
class Zend_Validate_HostnameTest extends TestCase
{
    /**
     * Default instance created for all test methods
     *
     * @var Zend_Validate_Hostname
     */
    protected $_validator;

    /**
     * @var string
     */
    protected $_origEncoding;

    /**
     * Creates a new Zend_Validate_Hostname object for each test method
     *
     * @return void
     */
    protected function set_up()
    {
        $this->_origEncoding = PHP_VERSION_ID < 50600
                    ? iconv_get_encoding('internal_encoding')
                    : ini_get('default_charset');
        $this->_validator = new Zend_Validate_Hostname();
    }

    /**
     * Reset iconv
     */
    protected function tear_down()
    {
        if (PHP_VERSION_ID < 50600) {
            iconv_set_encoding('internal_encoding', $this->_origEncoding);
        } else {
            ini_set('default_charset', $this->_origEncoding);
        }
    }

    /**
     * Ensures that the validator follows expected behavior
     *
     * @return void
     */
    public function testBasic()
    {
        $valuesExpected = [
            [Zend_Validate_Hostname::ALLOW_IP, true, ['1.2.3.4', '10.0.0.1', '255.255.255.255']],
            [Zend_Validate_Hostname::ALLOW_IP, false, ['1.2.3.4.5', '0.0.0.256']],
            [Zend_Validate_Hostname::ALLOW_DNS, true, ['example.com', 'example.museum', 'd.hatena.ne.jp']],
            [Zend_Validate_Hostname::ALLOW_DNS, false, ['localhost', 'localhost.localdomain', '1.2.3.4', 'domain.invalid']],
            [Zend_Validate_Hostname::ALLOW_LOCAL, true, ['localhost', 'localhost.localdomain', 'example.com']],
            [Zend_Validate_Hostname::ALLOW_ALL, true, ['localhost', 'example.com', '1.2.3.4']],
            [Zend_Validate_Hostname::ALLOW_LOCAL, false, ['local host', 'example,com', 'exam_ple.com']]
        ];
        foreach ($valuesExpected as $element) {
            $validator = new Zend_Validate_Hostname($element[0]);
            foreach ($element[2] as $input) {
                $this->assertEquals($element[1], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }
    }

    public function testCombination()
    {
        $valuesExpected = [
            [Zend_Validate_Hostname::ALLOW_DNS | Zend_Validate_Hostname::ALLOW_LOCAL, true, ['domain.com', 'localhost', 'local.localhost']],
            [Zend_Validate_Hostname::ALLOW_DNS | Zend_Validate_Hostname::ALLOW_LOCAL, false, ['1.2.3.4', '255.255.255.255']],
            [Zend_Validate_Hostname::ALLOW_DNS | Zend_Validate_Hostname::ALLOW_IP, true, ['1.2.3.4', '255.255.255.255']],
            [Zend_Validate_Hostname::ALLOW_DNS | Zend_Validate_Hostname::ALLOW_IP, false, ['localhost', 'local.localhost']]
            ];
        foreach ($valuesExpected as $element) {
            $validator = new Zend_Validate_Hostname($element[0]);
            foreach ($element[2] as $input) {
                $this->assertEquals($element[1], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }
    }

    /**
     * Ensure the dash character tests work as expected
     *
     */
    public function testDashes()
    {
        $valuesExpected = [
            [Zend_Validate_Hostname::ALLOW_DNS, true, ['domain.com', 'doma-in.com']],
            [Zend_Validate_Hostname::ALLOW_DNS, false, ['-domain.com', 'domain-.com', 'do--main.com']]
            ];
        foreach ($valuesExpected as $element) {
            $validator = new Zend_Validate_Hostname($element[0]);
            foreach ($element[2] as $input) {
                $this->assertEquals($element[1], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }
    }

    /**
     * Ensures that getMessages() returns expected default value
     *
     * @return void
     */
    public function testGetMessages()
    {
        $this->assertEquals([], $this->_validator->getMessages());
    }

    /**
     * Ensure the IDN check works as expected
     *
     */
    public function testIDN()
    {
        $validator = new Zend_Validate_Hostname();

        // Check IDN matching
        $valuesExpected = [
            [true, ['bürger.de', 'hãllo.de', 'hållo.se']],
            [true, ['bÜrger.de', 'hÃllo.de', 'hÅllo.se']],
            [false, ['hãllo.se', 'bürger.lt', 'hãllo.uk']]
            ];
        foreach ($valuesExpected as $element) {
            foreach ($element[1] as $input) {
                $this->assertEquals($element[0], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }

        // Check no IDN matching
        $validator->setValidateIdn(false);
        $valuesExpected = [
            [false, ['bürger.de', 'hãllo.de', 'hållo.se']]
            ];
        foreach ($valuesExpected as $element) {
            foreach ($element[1] as $input) {
                $this->assertEquals($element[0], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }

        // Check setting no IDN matching via constructor
        unset($validator);
        $validator = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_DNS, false);
        $valuesExpected = [
            [false, ['bürger.de', 'hãllo.de', 'hållo.se']]
            ];
        foreach ($valuesExpected as $element) {
            foreach ($element[1] as $input) {
                $this->assertEquals($element[0], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }
    }

    /**
     * Ensure the IDN check works on ressource files as expected
     *
     */
    public function testRessourceIDN()
    {
        $validator = new Zend_Validate_Hostname();

        // Check IDN matching
        $valuesExpected = [
            [true, ['bürger.com', 'hãllo.com', 'hållo.com']],
            [true, ['bÜrger.com', 'hÃllo.com', 'hÅllo.com']],
            [false, ['hãllo.lt', 'bürger.lt', 'hãllo.lt']]
            ];
        foreach ($valuesExpected as $element) {
            foreach ($element[1] as $input) {
                $this->assertEquals($element[0], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }

        // Check no IDN matching
        $validator->setValidateIdn(false);
        $valuesExpected = [
            [false, ['bürger.com', 'hãllo.com', 'hållo.com']]
            ];
        foreach ($valuesExpected as $element) {
            foreach ($element[1] as $input) {
                $this->assertEquals($element[0], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }

        // Check setting no IDN matching via constructor
        unset($validator);
        $validator = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_DNS, false);
        $valuesExpected = [
            [false, ['bürger.com', 'hãllo.com', 'hållo.com']]
            ];
        foreach ($valuesExpected as $element) {
            foreach ($element[1] as $input) {
                $this->assertEquals($element[0], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }
    }

    /**
     * Ensure the TLD check works as expected
     *
     */
    public function testTLD()
    {
        $validator = new Zend_Validate_Hostname();

        // Check TLD matching
        $valuesExpected = [
            [true, ['domain.co.uk', 'domain.uk.com', 'domain.tl', 'domain.zw', 'domain.menu', 'domain.versicherung']],
            [false, ['domain.xx', 'domain.zz', 'domain.madeup']]
            ];
        foreach ($valuesExpected as $element) {
            foreach ($element[1] as $input) {
                $this->assertEquals($element[0], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }

        // Check no TLD matching
        $validator->setValidateTld(false);
        $valuesExpected = [
            [true, ['domain.xx', 'domain.zz', 'domain.madeup']]
            ];
        foreach ($valuesExpected as $element) {
            foreach ($element[1] as $input) {
                $this->assertEquals($element[0], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }

        // Check setting no TLD matching via constructor
        unset($validator);
        $validator = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_DNS, true, false);
        $valuesExpected = [
            [true, ['domain.xx', 'domain.zz', 'domain.madeup']]
            ];
        foreach ($valuesExpected as $element) {
            foreach ($element[1] as $input) {
                $this->assertEquals($element[0], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }
    }

    /**
     * Ensures that getAllow() returns expected default value
     *
     * @return void
     */
    public function testGetAllow()
    {
        $this->assertEquals(Zend_Validate_Hostname::ALLOW_DNS, $this->_validator->getAllow());
    }

    /**
     * Test changed with ZF-6676, as IP check is only involved when IP patterns match
     *
     * @group ZF-2861
     * @group ZF-6676
     */
    public function testValidatorMessagesShouldBeTranslated()
    {
        require_once 'Zend/Translate.php';
        $translations = [
            'hostnameInvalidLocalName' => 'this is the IP error message',
        ];
        $translator = new Zend_Translate('array', $translations);
        $this->_validator->setTranslator($translator);

        $this->_validator->isValid('0.239,512.777');
        $messages = $this->_validator->getMessages();
        $found = false;
        foreach ($messages as $code => $message) {
            if (array_key_exists($code, $translations)) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found);
        $this->assertEquals($translations[$code], $message);
    }

    /**
     * @group ZF-6033
     */
    public function testNumberNames()
    {
        $validator = new Zend_Validate_Hostname();

        // Check TLD matching
        $valuesExpected = [
            [true, ['www.danger1.com', 'danger.com', 'www.danger.com']],
            [false, ['www.danger1com', 'dangercom', 'www.dangercom']]
            ];
        foreach ($valuesExpected as $element) {
            foreach ($element[1] as $input) {
                $this->assertEquals($element[0], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }
    }

    /**
     * @group ZF-6133
     */
    public function testPunycodeDecoding()
    {
        $validator = new Zend_Validate_Hostname();

        // Check TLD matching
        $valuesExpected = [
            [true, ['xn--brger-kva.com', 'xn--eckwd4c7cu47r2wf.jp']],
            [false, ['xn--brger-x45d2va.com', 'xn--bürger.com', 'xn--']]
            ];
        foreach ($valuesExpected as $element) {
            foreach ($element[1] as $input) {
                $this->assertEquals($element[0], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }
    }

    /**
     * @ZF-4352
     */
    public function testNonStringValidation()
    {
        $this->assertFalse($this->_validator->isValid([1 => 1]));
    }

    /**
     * @ZF-7323
     */
    public function testLatinSpecialChars()
    {
        $this->assertFalse($this->_validator->isValid('place@yah&oo.com'));
        $this->assertFalse($this->_validator->isValid('place@y*ahoo.com'));
        $this->assertFalse($this->_validator->isValid('ya#hoo'));
    }

    /**
     * @group ZF-7277
     */
    public function testDifferentIconvEncoding()
    {
        if (PHP_VERSION_ID < 50600) {
            iconv_set_encoding('internal_encoding', 'ISO8859-1');
        } else {
            ini_set('default_charset', 'ISO8859-1');
        }
        $validator = new Zend_Validate_Hostname();

        $valuesExpected = [
            [true, ['bürger.com', 'hãllo.com', 'hållo.com']],
            [true, ['bÜrger.com', 'hÃllo.com', 'hÅllo.com']],
            [false, ['hãllo.lt', 'bürger.lt', 'hãllo.lt']]
            ];
        foreach ($valuesExpected as $element) {
            foreach ($element[1] as $input) {
                $this->assertEquals($element[0], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }
    }

    /**
     * @ZF-8312
     */
    public function testInvalidDoubledIdn()
    {
        $this->assertFalse($this->_validator->isValid('test.com / http://www.test.com'));
    }

    /**
     * @group ZF-10267
     */
    public function testURI()
    {
        $valuesExpected = [
            [Zend_Validate_Hostname::ALLOW_URI, true, ['localhost', 'example.com', '~ex%20ample']],
            [Zend_Validate_Hostname::ALLOW_URI, false, ['§bad', 'don?t.know', 'thisisaverylonghostnamewhichextendstwohundredfiftysixcharactersandthereforshouldnotbeallowedbythisvalidatorbecauserfc3986limitstheallowedcharacterstoalimitoftwohunderedfiftysixcharactersinsumbutifthistestwouldfailthenitshouldreturntruewhichthrowsanexceptionbytheunittest']],
        ];
        foreach ($valuesExpected as $element) {
            $validator = new Zend_Validate_Hostname($element[0]);
            foreach ($element[2] as $input) {
                $this->assertEquals($element[1], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }
    }

    /**
     * Ensure that a trailing "." in a local hostname is permitted
     *
     * @group ZF-6363
     */
    public function testTrailingDot()
    {
        $valuesExpected = [
            [Zend_Validate_Hostname::ALLOW_ALL, true, ['example.', 'example.com.', '~ex%20ample.com.']],
            [Zend_Validate_Hostname::ALLOW_ALL, false, ['example..', ]],
            [Zend_Validate_Hostname::ALLOW_ALL, true, ['1.2.3.4.']],
            [Zend_Validate_Hostname::ALLOW_DNS, false, ['example..', '~ex%20ample..']],
            [Zend_Validate_Hostname::ALLOW_LOCAL, true, ['example.', 'example.com.']],
        ];

        foreach ($valuesExpected as $element) {
            $validator = new Zend_Validate_Hostname($element[0]);
            foreach ($element[2] as $input) {
                $this->assertEquals($element[1], $validator->isValid($input), implode("\n", $validator->getMessages()) . $input);
            }
        }
    }

    /**
     * @group ZF-11334
     * @see http://www.ietf.org/rfc/rfc2732.txt
     */
    public function testSupportsIpv6AddressesWhichContainHexDigitF()
    {
        $validator = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_ALL);

        $this->assertTrue($validator->isValid('FEDC:BA98:7654:3210:FEDC:BA98:7654:3210'));
        $this->assertTrue($validator->isValid('1080:0:0:0:8:800:200C:417A'));
        $this->assertTrue($validator->isValid('3ffe:2a00:100:7031::1'));
        $this->assertTrue($validator->isValid('1080::8:800:200C:417A'));
        $this->assertTrue($validator->isValid('::192.9.5.5'));
        $this->assertTrue($validator->isValid('::FFFF:129.144.52.38'));
        $this->assertTrue($validator->isValid('2010:836B:4179::836B:4179'));
    }

    /**
     * @group ZF-11796
     */
    public function testIDNSI()
    {
        $validator = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_ALL);

        $this->assertTrue($validator->isValid('Test123.si'));
        $this->assertTrue($validator->isValid('țest123.si'));
        $this->assertTrue($validator->isValid('tĕst123.si'));
        $this->assertTrue($validator->isValid('tàrø.si'));
        $this->assertFalse($validator->isValid('رات.si'));
    }
    /**
     * @ZF-12314
     */
    public function testDKSpecialChars()
    {
        $this->assertTrue($this->_validator->isValid('testæøå.dk'));
    }

    /**
     * test for IDN CA
     */
    public function testIDNCA()
    {
        $validator = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_ALL);

        $this->assertTrue($validator->isValid('Test123.ca'));
        $this->assertTrue($validator->isValid('tàr.ca'));
        $this->assertFalse($validator->isValid('țest123.ca'));
        $this->assertFalse($validator->isValid('tĕst123.ca'));
        $this->assertFalse($validator->isValid('رات.ca'));
    }

    /**
     * @group ZF-12413
     */
    public function testIDNUA()
    {
        $validator = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_ALL);

        $this->assertTrue($validator->isValid('самобраноч.com.ua'));
        $this->assertTrue($validator->isValid('hostmaster.ua'));
    }

    /**
     * Test for IDN serbia .rs
     *
     * @group GH-115
     */
    public function testIDNRS()
    {
        $validator = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_ALL);

        $this->assertTrue($validator->isValid('test.rs'));
    }

    /**
     * @group GH-19
     */
    public function testRussianIdn()
    {
        $validator = new Zend_Validate_Hostname();
        $this->assertTrue($validator->isValid('кц.рф'));
        $this->assertTrue($validator->isValid('президент.рф'));
    }

    /**
     * @group GH-451
     */
    public function testVermögensberaterIdns()
    {
        $validator = new Zend_Validate_Hostname();
        $this->assertTrue($validator->isValid('mysite.vermögensberater'));
    }

    /**
     * @group GH-610
     */
    public function testGermanSmallLetterSharpS()
    {
        $validator = new Zend_Validate_Hostname();
        $this->assertTrue($validator->isValid('straße.de'));
    }

    /**
     * @group GH-612
     */
    public function testZeroSubdomain()
    {
        $validator = new Zend_Validate_Hostname();
        $this->assertTrue($validator->isValid('1.pool.ntp.org'));
        $this->assertTrue($validator->isValid('0.pool.ntp.org'));
    }
}
