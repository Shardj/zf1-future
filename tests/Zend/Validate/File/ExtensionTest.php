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
 * @package    Zend_Validate_File
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_Validate_File_ExtensionTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Validate_File_ExtensionTest::main");
}

/**
 * @see Zend_Validate_File_Extension
 */
require_once 'Zend/Validate/File/Extension.php';

/**
 * Extension testbed
 *
 * @category   Zend
 * @package    Zend_Validate_File
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Validate
 */
class Zend_Validate_File_ExtensionTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Zend_Validate_File_ExtensionTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Ensures that the validator follows expected behavior
     *
     * @return void
     */
    public function testBasic()
    {
        $valuesExpected = [
            ['mo', true],
            ['gif', false],
            [['mo'], true],
            [['gif'], false],
            [['gif', 'pdf', 'mo', 'pict'], true],
            [['gif', 'gz', 'hint'], false],
        ];

        foreach ($valuesExpected as $element) {
            $validator = new Zend_Validate_File_Extension($element[0]);
            $this->assertEquals(
                $element[1],
                $validator->isValid(dirname(__FILE__) . '/_files/testsize.mo'),
                "Tested with " . var_export($element, 1)
            );
        }

        $validator = new Zend_Validate_File_Extension('mo');
        $this->assertEquals(false, $validator->isValid(dirname(__FILE__) . '/_files/nofile.mo'));
        $this->assertTrue(array_key_exists('fileExtensionNotFound', $validator->getMessages()));

        $files = [
            'name'     => 'test1',
            'type'     => 'text',
            'size'     => 200,
            'tmp_name' => 'tmp_test1',
            'error'    => 0
        ];
        $validator = new Zend_Validate_File_Extension('mo');
        $this->assertEquals(false, $validator->isValid(dirname(__FILE__) . '/_files/nofile.mo', $files));
        $this->assertTrue(array_key_exists('fileExtensionNotFound', $validator->getMessages()));

        $files = [
            'name'     => 'testsize.mo',
            'type'     => 'text',
            'size'     => 200,
            'tmp_name' => dirname(__FILE__) . '/_files/testsize.mo',
            'error'    => 0
        ];
        $validator = new Zend_Validate_File_Extension('mo');
        $this->assertEquals(true, $validator->isValid(dirname(__FILE__) . '/_files/testsize.mo', $files));

        $files = [
            'name'     => 'testsize.mo',
            'type'     => 'text',
            'size'     => 200,
            'tmp_name' => dirname(__FILE__) . '/_files/testsize.mo',
            'error'    => 0
        ];
        $validator = new Zend_Validate_File_Extension('gif');
        $this->assertEquals(false, $validator->isValid(dirname(__FILE__) . '/_files/testsize.mo', $files));
        $this->assertTrue(array_key_exists('fileExtensionFalse', $validator->getMessages()));
    }

    /**
     * GitHub issue #287
     *
     * pathinfo() does not guarantee that the extension index will be set
     * according to the PHP manual (http://se2.php.net/pathinfo#example-2422).
     *
     * @return void
     */
    public function testNoExtension()
    {
        $files = [
            'name'     => 'no_extension',
            'type'     => 'text',
            'size'     => 200,
            'tmp_name' => dirname(__FILE__) . '/_files/no_extension',
            'error'    => 0
        ];
        $validator = new Zend_Validate_File_Extension('txt');
        $this->assertEquals(false, $validator->isValid(dirname(__FILE__) . '/_files/no_extension'));
    }

    public function testZF3891()
    {
        $files = [
            'name'     => 'testsize.mo',
            'type'     => 'text',
            'size'     => 200,
            'tmp_name' => dirname(__FILE__) . '/_files/testsize.mo',
            'error'    => 0
        ];
        $validator = new Zend_Validate_File_Extension(['MO', 'case' => true]);
        $this->assertEquals(false, $validator->isValid(dirname(__FILE__) . '/_files/testsize.mo', $files));

        $validator = new Zend_Validate_File_Extension(['MO', 'case' => false]);
        $this->assertEquals(true, $validator->isValid(dirname(__FILE__) . '/_files/testsize.mo', $files));
    }

    /**
     * Ensures that getExtension() returns expected value
     *
     * @return void
     */
    public function testGetExtension()
    {
        $validator = new Zend_Validate_File_Extension('mo');
        $this->assertEquals(['mo'], $validator->getExtension());

        $validator = new Zend_Validate_File_Extension(['mo', 'gif', 'jpg']);
        $this->assertEquals(['mo', 'gif', 'jpg'], $validator->getExtension());
    }

    /**
     * Ensures that setExtension() returns expected value
     *
     * @return void
     */
    public function testSetExtension()
    {
        $validator = new Zend_Validate_File_Extension('mo');
        $validator->setExtension('gif');
        $this->assertEquals(['gif'], $validator->getExtension());

        $validator->setExtension('jpg, mo');
        $this->assertEquals(['jpg', 'mo'], $validator->getExtension());

        $validator->setExtension(['zip', 'ti']);
        $this->assertEquals(['zip', 'ti'], $validator->getExtension());
    }

    /**
     * Ensures that addExtension() returns expected value
     *
     * @return void
     */
    public function testAddExtension()
    {
        $validator = new Zend_Validate_File_Extension('mo');
        $validator->addExtension('gif');
        $this->assertEquals(['mo', 'gif'], $validator->getExtension());

        $validator->addExtension('jpg, to');
        $this->assertEquals(['mo', 'gif', 'jpg', 'to'], $validator->getExtension());

        $validator->addExtension(['zip', 'ti']);
        $this->assertEquals(['mo', 'gif', 'jpg', 'to', 'zip', 'ti'], $validator->getExtension());

        $validator->addExtension('');
        $this->assertEquals(['mo', 'gif', 'jpg', 'to', 'zip', 'ti'], $validator->getExtension());
    }
}

// Call Zend_Validate_File_ExtensionTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Validate_File_ExtensionTest::main") {
    Zend_Validate_File_ExtensionTest::main();
}
