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
 * @see Zend_Validate_StringLength
 */
require_once 'Zend/Validate/StringLength.php';

/**
 * @category   Zend
 * @package    Zend_Validate
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Validate
 */
class Zend_Validate_StringLengthTest extends TestCase
{
    /**
     * Default instance created for all test methods
     *
     * @var Zend_Validate_StringLength
     */
    protected $_validator;

    /**
     * Creates a new Zend_Validate_StringLength object for each test method
     *
     * @return void
     */
    protected function set_up()
    {
        $this->_validator = new Zend_Validate_StringLength();
    }

    /**
     * Ensures that the validator follows expected behavior
     *
     * @return void
     */
    public function testBasic()
    {
        if (PHP_VERSION_ID < 50600) {
            iconv_set_encoding('internal_encoding', 'UTF-8');
        } else {
            ini_set('default_charset', 'UTF-8');
        }
        /**
         * The elements of each array are, in order:
         *      - minimum length
         *      - maximum length
         *      - expected validation result
         *      - array of test input values
         */
        $valuesExpected = [
            [0, null, true, ['', 'a', 'ab']],
            [-1, null, true, ['']],
            [2, 2, true, ['ab', '  ']],
            [2, 2, false, ['a', 'abc']],
            [1, null, false, ['']],
            [2, 3, true, ['ab', 'abc']],
            [2, 3, false, ['a', 'abcd']],
            [3, 3, true, ['äöü']],
            [6, 6, true, ['Müller']]
            ];
        foreach ($valuesExpected as $element) {
            $validator = new Zend_Validate_StringLength($element[0], $element[1]);
            foreach ($element[3] as $input) {
                $this->assertEquals($element[2], $validator->isValid($input));
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
     * Ensures that getMin() returns expected default value
     *
     * @return void
     */
    public function testGetMin()
    {
        $this->assertEquals(0, $this->_validator->getMin());
    }

    /**
     * Ensures that getMax() returns expected default value
     *
     * @return void
     */
    public function testGetMax()
    {
        $this->assertEquals(null, $this->_validator->getMax());
    }

    /**
     * Ensures that setMin() throws an exception when given a value greater than the maximum
     *
     * @return void
     */
    public function testSetMinExceptionGreaterThanMax()
    {
        $max = 1;
        $min = 2;
        try {
            $this->_validator->setMax($max)->setMin($min);
            $this->fail('Expected Zend_Validate_Exception not thrown');
        } catch (Zend_Validate_Exception $e) {
            $this->assertEquals(
                "The minimum must be less than or equal to the maximum length, but $min > $max",
                $e->getMessage()
            );
        }
    }

    /**
     * Ensures that setMax() throws an exception when given a value less than the minimum
     *
     * @return void
     */
    public function testSetMaxExceptionLessThanMin()
    {
        $max = 1;
        $min = 2;
        try {
            $this->_validator->setMin($min)->setMax($max);
            $this->fail('Expected Zend_Validate_Exception not thrown');
        } catch (Zend_Validate_Exception $e) {
            $this->assertEquals(
                "The maximum must be greater than or equal to the minimum length, but $max < $min",
                $e->getMessage()
            );
        }
    }

    /**
     * @return void
     */
    public function testDifferentEncodingWithValidator()
    {
        if (PHP_VERSION_ID < 50600) {
            iconv_set_encoding('internal_encoding', 'UTF-8');
        } else {
            ini_set('default_charset', 'UTF-8');
        }
        $validator = new Zend_Validate_StringLength(2, 2, 'UTF-8');
        $this->assertEquals(true, $validator->isValid('ab'));

        $this->assertEquals('UTF-8', $validator->getEncoding());
        $validator->setEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', $validator->getEncoding());
    }

    /**
     * @group GH-634
     */
    public function testWrongEncoding()
    {
        $this->expectException(Zend_Validate_Exception::class);
        $this->_validator->setEncoding('');
    }

    /**
     * @ZF-4352
     */
    public function testNonStringValidation()
    {
        $this->assertFalse($this->_validator->isValid([1 => 1]));
    }
}
