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
 * @package    Zend_Form
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_Form_Element_NoteTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Form_Element_NoteTest::main");
}

require_once dirname(__FILE__) . '/../../../TestHelper.php';

require_once 'Zend/Form/Element/Note.php';

/**
 * Test class for Zend_Form_Element_Text
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Form
 */
class Zend_Form_Element_NoteTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Zend_Form_Element_NoteTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->element = new Zend_Form_Element_Note('foo');
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    public function tearDown()
    {
    }

    public function testNoteElementSubclassesXhtmlElement()
    {
        $this->assertTrue($this->element instanceof Zend_Form_Element_Xhtml);
    }

    public function testNoteElementInstanceOfBaseElement()
    {
        $this->assertTrue($this->element instanceof Zend_Form_Element);
    }

    public function testNoteElementUsesNoteHelperInViewHelperDecoratorByDefault()
    {
        $this->_checkZf2794();

        $decorator = $this->element->getDecorator('viewHelper');
        $this->assertTrue($decorator instanceof Zend_Form_Decorator_ViewHelper);

        $decorator->setElement($this->element);
        $helper = $decorator->getHelper();
        $this->assertEquals('formNote', $helper);
    }

    public function testNoteElementValidationIsAlwaysTrue()
    {
        // Solo
        $this->assertTrue($this->element->isValid('foo'));

        // Set required
        $this->element->setRequired(true);
        $this->assertTrue($this->element->isValid(''));
        // Reset
        $this->element->setRequired(false);

        // Examining various validators
        $validators = [
            [
                'options' => ['Alnum'],
                'value'   => 'aa11?? ',
            ],
            [
                'options' => ['Alpha'],
                'value'   => 'aabb11',
            ],
            [
                'options' => [
                    'Between',
                    false,
                    [
                        'min' => 0,
                        'max' => 10,
                    ]
                ],
                'value'   => '11',
            ],
            [
                'options' => ['Date'],
                'value'   => '10.10.2000',
            ],
            [
                'options' => ['Digits'],
                'value'   => '1122aa',
            ],
            [
                'options' => ['EmailAddress'],
                'value'   => 'foo',
            ],
            [
                'options' => ['Float'],
                'value'   => '10a01',
            ],
            [
                'options' => [
                    'GreaterThan',
                    false,
                    ['min' => 10],
                ],
                'value'   => '9',
            ],
            [
                'options' => ['Hex'],
                'value'   => '123ABCDEFGH',
            ],
            [
                'options' => [
                    'InArray',
                    false,
                    [
                        'key'      => 'value',
                        'otherkey' => 'othervalue',
                    ]
                ],
                'value'   => 'foo',
            ],
            [
                'options' => ['Int'],
                'value'   => '1234.5',
            ],
            [
                'options' => [
                    'LessThan',
                    false,
                    ['max' => 10],
                ],
                'value'   => '11',
            ],
            [
                'options' => ['NotEmpty'],
                'value'   => '',
            ],
            [
                'options' => [
                    'Regex',
                    false,
                    ['pattern' => '/^Test/'],
                ],
                'value'   => 'Pest',
            ],
            [
                'options' => [
                    'StringLength',
                    false,
                    [
                        6,
                        20,
                    ]
                ],
                'value'   => 'foo',
            ],
        ];

        foreach ($validators as $validator) {
            // Add validator
            $this->element->addValidators([$validator['options']]);

            // Testing
            $this->assertTrue($this->element->isValid($validator['value']));

            // Remove validator
            $this->element->removeValidator($validator['options'][0]);
        }
    }

    /**
     * Used by test methods susceptible to ZF-2794, marks a test as incomplete
     *
     * @link   http://framework.zend.com/issues/browse/ZF-2794
     * @return void
     */
    protected function _checkZf2794()
    {
        if (strtolower(substr(PHP_OS, 0, 3)) == 'win'
            && version_compare(PHP_VERSION, '5.1.4', '=')
        ) {
            $this->markTestIncomplete('Error occurs for PHP 5.1.4 on Windows');
        }
    }
}

// Call Zend_Form_Element_NoteTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Form_Element_NoteTest::main") {
    Zend_Form_Element_NoteTest::main();
}
