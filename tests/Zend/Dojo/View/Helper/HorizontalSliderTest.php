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

// Call Zend_Dojo_View_Helper_HorizontalSliderTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Dojo_View_Helper_HorizontalSliderTest::main");
}

/** Zend_Dojo_View_Helper_HorizontalSlider */
require_once 'Zend/Dojo/View/Helper/HorizontalSlider.php';

/** Zend_View */
require_once 'Zend/View.php';

/** Zend_Registry */
require_once 'Zend/Registry.php';

/** Zend_Dojo_Form */
require_once 'Zend/Dojo/Form.php';

/** Zend_Dojo_Form_SubForm */
require_once 'Zend/Dojo/Form/SubForm.php';

/** Zend_Dojo_View_Helper_Dojo */
require_once 'Zend/Dojo/View/Helper/Dojo.php';

/**
 * Test class for Zend_Dojo_View_Helper_HorizontalSlider.
 *
 * @category   Zend
 * @package    Zend_Dojo
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Dojo
 * @group      Zend_Dojo_View
 */
class Zend_Dojo_View_Helper_HorizontalSliderTest extends TestCase
{
    /**
     * @var \Zend_View
     */
    protected $view;

    /**
     * @var \Zend_Dojo_View_Helper_HorizontalSlider|mixed
     */
    protected $helper;

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_Dojo_View_Helper_HorizontalSliderTest");
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
        $this->helper = new Zend_Dojo_View_Helper_HorizontalSlider();
        $this->helper->setView($this->view);
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
        return $this->helper->horizontalSlider(
            'elementId',
            '',
            [
                'minimum' => -10,
                'maximum' => 10,
                'discreteValues' => 11,
                'topDecoration' => [
                    'labels' => [
                        ' ',
                        '20%',
                        '40%',
                        '60%',
                        '80%',
                        ' ',
                    ],
                    'container' => 'top',
                    'attribs' => [
                        'container' => [
                            'style' => 'height:1.2em; font-size=75%;color:gray;',
                        ],
                        'labels' => [
                            'style' => 'height:1em; font-size=75%;color:gray;',
                        ],
                    ],
                    'dijit' => 'HorizontalRuleLabels',
                ],
                'bottomDecoration' => [
                    'labels' => [
                        '0%',
                        '50%',
                        '100%',
                    ],
                    'attribs' => [
                        'labels' => [
                            'style' => 'height:1em; font-size=75%;color:gray;',
                        ],
                    ],
                ],
                'leftDecoration' => [
                    'labels' => [
                        ' ',
                        '20%',
                        '40%',
                        '60%',
                        '80%',
                        ' ',
                    ],
                    'attribs' => [
                        'container' => [
                            'style' => 'height:1.2em; font-size=75%;color:gray;',
                        ],
                        'labels' => [
                            'style' => 'height:1em; font-size=75%;color:gray;',
                        ],
                    ],
                    'dijit' => 'VerticalRuleLabels',
                ],
                'rightDecoration' => [
                    'labels' => [
                        '0%',
                        '50%',
                        '100%',
                    ],
                    'attribs' => [
                        'labels' => [
                            'style' => 'height:1em; font-size=75%;color:gray;',
                        ],
                    ],
                ],
            ],
            []
        );
    }

    public function testShouldAllowDeclarativeDijitCreation()
    {
        $html = $this->getElement();
        $this->assertMatchesRegularExpression('/<div[^>]*(dojoType="dijit.form.HorizontalSlider")/', $html, $html);
    }

    public function testShouldAllowProgrammaticDijitCreation()
    {
        Zend_Dojo_View_Helper_Dojo::setUseProgrammatic();
        $html = $this->getElement();
        $this->assertDoesNotMatchRegularExpression('/<div[^>]*(dojoType="dijit.form.HorizontalSlider")/', $html);
        $this->assertNotNull($this->view->dojo()->getDijit('elementId-slider'));
    }

    public function testShouldCreateOnChangeAttributeByDefault()
    {
        $html = $this->getElement();
        // Note that ' is converted to &#39; in Zend_View_Helper_HtmlElement::_htmlAttribs() (line 116)
        $this->assertStringContainsString('onChange="dojo.byId(&#39;elementId&#39;).value = arguments[0];"', $html, $html);
    }

    public function testShouldCreateHiddenElementWithValue()
    {
        $html = $this->getElement();
        if (!preg_match('/(<input[^>]*(type="hidden")[^>]*>)/', $html, $m)) {
            $this->fail('No hidden element found');
        }
        $this->assertStringContainsString('id="elementId"', $m[1]);
        $this->assertStringContainsString('value="', $m[1]);
    }

    public function testShouldCreateTopAndBottomDecorationsWhenRequested()
    {
        $html = $this->getElement();
        $this->assertMatchesRegularExpression('/<div[^>]*(dojoType="dijit.form.HorizontalRule")/', $html, $html);
        $this->assertMatchesRegularExpression('/<ol[^>]*(dojoType="dijit.form.HorizontalRuleLabels")/', $html, $html);
        $this->assertStringContainsString('topDecoration', $html);
        $this->assertStringContainsString('bottomDecoration', $html);
    }

    public function testShouldIgnoreLeftAndRightDecorationsWhenPassed()
    {
        $html = $this->getElement();
        $this->assertStringNotContainsString('leftDecoration', $html);
        $this->assertStringNotContainsString('rightDecoration', $html);
    }

    public function testSliderShouldRaiseExceptionIfMissingRequiredParameters()
    {
        $this->expectException(Zend_Dojo_View_Exception::class);
        $this->helper->prepareSlider('foo', 4);
    }

    public function testShouldAllowPassingLabelParametersViaDecorationParameters()
    {
        $html = $this->helper->horizontalSlider(
            'elementId',
            '',
            [
                'minimum' => -10,
                'maximum' => 10,
                'discreteValues' => 11,
                'topDecoration' => [
                    'labels' => [
                        ' ',
                        '20%',
                        '40%',
                        '60%',
                        '80%',
                        ' ',
                    ],
                    'params' => [
                        'required' => true,
                        'labels' => [
                            'minimum' => 5,
                        ]
                    ],
                    'dijit' => 'HorizontalRuleLabels',
                ],
            ]
        );
        $this->assertStringContainsString('required="', $html);
        $this->assertStringContainsString('minimum="', $html);
    }

    /**
     * @group ZF-4435
     */
    public function testShouldCreateAppropriateIdsForElementsInSubForms()
    {
        $form = new Zend_Dojo_Form();
        $form->setDecorators([
            'FormElements',
            ['TabContainer', [
                'id' => 'tabContainer',
                'style' => 'width: 600px; height: 300px;',
                'dijitParams' => [
                    'tabPosition' => 'top'
                ],
            ]],
            'DijitForm',
        ]);

        $sliderForm = new Zend_Dojo_Form_SubForm();
        $sliderForm->setAttribs([
            'name' => 'slidertab',
            'legend' => 'Slider Elements',
        ]);

        $sliderForm->addElement(
            'HorizontalSlider',
            'slide1',
            [
                    'label' => 'Slide me:',
                    'minimum' => 0,
                    'maximum' => 25,
                    'discreteValues' => 10,
                    'style' => 'width: 450px;',
                    'topDecorationDijit' => 'HorizontalRuleLabels',
                    'topDecorationLabels' => ['0%', '50%', '100%'],
                    'topDecorationParams' => ['style' => 'padding-bottom: 20px;']
                ]
        );

        $form->addSubForm($sliderForm, 'slidertab')
             ->setView($this->getView());
        $html = $form->render();
        $this->assertStringContainsString('id="slidertab-slide1-slider"', $html);
        $this->assertStringContainsString('id="slidertab-slide1-slider-topDecoration"', $html);
        $this->assertStringContainsString('id="slidertab-slide1-slider-topDecoration-labels"', $html);
    }

    /**
     * @group ZF-5220
     */
    public function testLabelDivShouldOpenAndCloseBeforeLabelOl()
    {
        $html = $this->getElement();
        $this->assertDoesNotMatchRegularExpression('/<div[^>]*(dojoType="dijit.form.HorizontalRuleLabels")[^>]*><\/div>\s*<ol/s', $html, $html);
        $this->assertMatchesRegularExpression('/<div[^>]*><\/div>\s*<ol[^>]*(dojoType="dijit.form.HorizontalRuleLabels")/s', $html, $html);
    }
}

// Call Zend_Dojo_View_Helper_HorizontalSliderTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_Dojo_View_Helper_HorizontalSliderTest::main") {
    Zend_Dojo_View_Helper_HorizontalSliderTest::main();
}
