<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;
use PHPUnit\Framework\TestSuite;
use PHPUnit\TextUI\TestRunner;

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
 * @package    Zend_Dojo
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_Dojo_Form_Decorator_StackContainerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Dojo_Form_Decorator_StackContainerTest::main");
}

/** Zend_Dojo_Form_Decorator_StackContainer */
require_once 'Zend/Dojo/Form/Decorator/StackContainer.php';

/** Zend_Dojo_Form_SubForm */
require_once 'Zend/Dojo/Form.php';

/** Zend_View */
require_once 'Zend/View.php';

/** Zend_Registry */
require_once 'Zend/Registry.php';

/** Zend_Dojo_View_Helper_Dojo */
require_once 'Zend/Dojo/View/Helper/Dojo.php';

/**
 * Test class for Zend_Dojo_Form_Decorator_StackContainer.
 *
 * @category   Zend
 * @package    Zend_Dojo
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Dojo
 * @group      Zend_Dojo_Form
 */
class Zend_Dojo_Form_Decorator_StackContainerTest extends TestCase
{
    /**
     * @var \Zend_View
     */
    protected $view;

    /**
     * @var \Zend_Dojo_Form_Decorator_StackContainer|mixed
     */
    protected $decorator;

    /**
     * @var \Zend_Dojo_Form
     */
    protected $element;

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_Dojo_Form_Decorator_StackContainerTest");
        $result = (new resources_Runner())->run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function set_up()
    {
        Zend_Registry::_unsetInstance();
        Zend_Dojo_View_Helper_Dojo::setUseDeclarative();

        $this->view = $this->getView();
        $this->decorator = new Zend_Dojo_Form_Decorator_StackContainer();
        $this->element = $this->getElement();
        $this->element->setView($this->view);
        $this->decorator->setElement($this->element);
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tear_down()
    {
    }

    public function getView()
    {
        require_once 'Zend/View.php';
        $view = new Zend_View();
        $view->addHelperPath('Zend/Dojo/View/Helper/', 'Zend_Dojo_View_Helper');
        return $view;
    }

    public function getElement()
    {
        $element = new Zend_Dojo_Form();
        $element->setAttribs([
            'name' => 'foo',
            'style' => 'width: 300px; height: 500px;',
            'class' => 'someclass',
            'dijitParams' => [
                'labelAttr' => 'foobar',
                'typeAttr' => 'barbaz',
            ],
        ]);
        return $element;
    }

    public function testRenderingShouldEnableDojo()
    {
        $html = $this->decorator->render('');
        $this->assertTrue($this->view->dojo()->isEnabled());
    }

    public function testRenderingShouldCreateDijit()
    {
        $html = $this->decorator->render('');
        $this->assertStringContainsString('dojoType="dijit.layout.StackContainer"', $html);
    }
}

// Call Zend_Dojo_Form_Decorator_StackContainerTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_Dojo_Form_Decorator_StackContainerTest::main") {
    Zend_Dojo_Form_Decorator_StackContainerTest::main();
}
