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

// Call Zend_Form_Element_CaptchaTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Form_Element_CaptchaTest::main");
}

/** Zend_Form_Element_Captcha */
require_once 'Zend/Form/Element/Captcha.php';

/** Zend_Captcha_Dumb */
require_once 'Zend/Captcha/Dumb.php';

/** Zend_Captcha_ReCaptcha */
require_once 'Zend/Captcha/ReCaptcha.php';

/**
 * @category   Zend
 * @package    Zend_Form
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Form
 */
class Zend_Form_Element_CaptchaTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {

        $suite  = new PHPUnit_Framework_TestSuite('Zend_Form_Element_CaptchaTest');
        PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        $this->element = new Zend_Form_Element_Captcha(
            'foo',
            [
                'captcha' => 'Dumb',
                'captchaOptions' => [
                    'sessionClass' => 'Zend_Form_Element_CaptchaTest_SessionContainer',
                ],
            ]
        );
    }

    public function getCaptcha()
    {
        $captcha = new Zend_Captcha_Dumb([
            'sessionClass' => 'Zend_Form_Element_CaptchaTest_SessionContainer',
        ]);
        return $captcha;
    }

    /**
     * @expectedException Zend_Form_Exception
     */
    public function testConstructionShouldRequireCaptchaDetails()
    {
        $this->element = new Zend_Form_Element_Captcha('foo');
    }

    public function testShouldAllowSettingCaptcha()
    {
        $captcha = $this->getCaptcha();
        $this->assertNotSame($this->element->getCaptcha(), $captcha);
        $this->element->setCaptcha($captcha);
        $this->assertSame($captcha, $this->element->getCaptcha());
    }

    public function testShouldAllowAddingCaptchaPrefixPath()
    {
        $this->element->addPrefixPath('My_Captcha', 'My/Captcha/', 'captcha');
        $loader = $this->element->getPluginLoader('captcha');
        $paths  = $loader->getPaths('My_Captcha');
        $this->assertTrue(is_array($paths));
    }

    public function testAddingNullPrefixPathShouldAddCaptchaPrefixPath()
    {
        $this->element->addPrefixPath('My', 'My');
        $loader = $this->element->getPluginLoader('captcha');
        $paths  = $loader->getPaths('My_Captcha');
        $this->assertTrue(is_array($paths));
    }

    /**
     * @group ZF-12161
     */
    public function testSettingCustomCaptchaAdapterPerConstructor()
    {
        $element = new Zend_Form_Element_Captcha(
            'foo',
            [
                 'prefixPath' => [
                     'prefix' => 'Zend_Form_Element_CaptchaTest',
                     'path'   => dirname(__FILE__) . '/_files',
                 ],
                 'captcha'    => 'Foo',
            ]
        );

        $this->assertTrue(
            $element->getCaptcha() instanceof
                Zend_Form_Element_CaptchaTest_Captcha_Foo
        );
    }

    /**
     * @see   ZF-4038
     * @group ZF-4038
     */
    public function testCaptchaShouldRenderFullyQualifiedElementName()
    {
        require_once 'Zend/Form.php';
        require_once 'Zend/View.php';
        $form = new Zend_Form();
        $form->addElement($this->element)
             ->setElementsBelongTo('bar');
        $html = $form->render(new Zend_View);
        $this->assertContains('name="bar[foo', $html, $html);
        $this->assertContains('id="bar-foo-', $html, $html);
        $this->form = $form;
    }

    /**
     * @see   ZF-4038
     * @group ZF-4038
     */
    public function testCaptchaShouldValidateUsingFullyQualifiedElementName()
    {
        $this->testCaptchaShouldRenderFullyQualifiedElementName();
        $word = $this->element->getCaptcha()->getWord();
        $id   = $this->element->getCaptcha()->getId();
        $data = [
            'bar' => [
                'foo' => [
                    'id'    => $id,
                    'input' => $word,
                ]
            ]
        ];
        $valid = $this->form->isValid($data);
        $this->assertTrue($valid, var_export($this->form->getMessages(), 1));
    }

    /**
     * @group ZF-4822
     */
    public function testDefaultDecoratorsShouldIncludeErrorsDescriptionHtmlTagAndLabel()
    {
        $decorators = $this->element->getDecorators();
        $this->assertTrue(is_array($decorators));
        $this->assertTrue(array_key_exists('Zend_Form_Decorator_Errors', $decorators), 'Missing Errors decorator' . var_export(array_keys($decorators), 1));
        $this->assertTrue(array_key_exists('Zend_Form_Decorator_Description', $decorators), 'Missing Description decorator' . var_export(array_keys($decorators), 1));
        $this->assertTrue(array_key_exists('Zend_Form_Decorator_HtmlTag', $decorators), 'Missing HtmlTag decorator' . var_export(array_keys($decorators), 1));
        $this->assertTrue(array_key_exists('Zend_Form_Decorator_Label', $decorators), 'Missing Label decorator' . var_export(array_keys($decorators), 1));
    }

    /**
     * @group ZF-5855
     */
    public function testHelperDoesNotShowUpInAttribs()
    {
        require_once 'Zend/View.php';
        $this->assertFalse(array_key_exists('helper', $this->element->getAttribs()));
    }

    /**
     * Prove the fluent interface on Zend_Form_Element_Captcha::loadDefaultDecorators
     *
     * @link http://framework.zend.com/issues/browse/ZF-9913
     * @return void
     */
    public function testFluentInterfaceOnLoadDefaultDecorators()
    {
        $this->assertSame($this->element, $this->element->loadDefaultDecorators());
    }
    
    /**
     * @group ZF-11609
     */
    public function testDefaultDecoratorsBeforeAndAfterRendering()
    {
        /**
         * Dumb captcha
         */
        
        // Before rendering
        $decorators = array_keys($this->element->getDecorators());
        $this->assertSame(
            [
                'Zend_Form_Decorator_Errors',
                'Zend_Form_Decorator_Description',
                'Zend_Form_Decorator_HtmlTag',
                'Zend_Form_Decorator_Label',
            ],
            $decorators,
            var_export($decorators, true)
        );
        
        $this->element->render();
        
        // After rendering
        $decorators = array_keys($this->element->getDecorators());
        $this->assertSame(
            [
                'Zend_Form_Decorator_Captcha',
                'Zend_Form_Decorator_Captcha_Word',
                'Zend_Form_Decorator_Errors',
                'Zend_Form_Decorator_Description',
                'Zend_Form_Decorator_HtmlTag',
                'Zend_Form_Decorator_Label',
            ],
            $decorators,
            var_export($decorators, true)
        );
   
        /**
         * ReCaptcha
         */
        
        // Reset element
        $this->setUp();
        
        $options = [
            'privKey' => 'privateKey',
            'pubKey'  => 'publicKey',
            'ssl'     => true,
            'xhtml'   => true,
        ];
        $this->element->setCaptcha(new Zend_Captcha_ReCaptcha($options));
        
        // Before rendering
        $decorators = array_keys($this->element->getDecorators());
        $this->assertSame(
            [
                'Zend_Form_Decorator_Errors',
                'Zend_Form_Decorator_Description',
                'Zend_Form_Decorator_HtmlTag',
                'Zend_Form_Decorator_Label',
            ],
            $decorators,
            var_export($decorators, true)
        );
        
        $this->element->render();
        
        // After rendering
        $decorators = array_keys($this->element->getDecorators());
        $this->assertSame(
            [
                'Zend_Form_Decorator_Captcha_ReCaptcha',
                'Zend_Form_Decorator_Errors',
                'Zend_Form_Decorator_Description',
                'Zend_Form_Decorator_HtmlTag',
                'Zend_Form_Decorator_Label',
            ],
            $decorators,
            var_export($decorators, true)
        );
    }
    
    /**
     * @group ZF-11609
     */
    public function testDefaultDecoratorsBeforeAndAfterRenderingWhenDefaultDecoratorsAreDisabled()
    {
        $element = new Zend_Form_Element_Captcha(
            'foo',
            [
                'captcha'        => 'Dumb',
                'captchaOptions' => [
                    'sessionClass' => 'Zend_Form_Element_CaptchaTest_SessionContainer',
                ],
                'disableLoadDefaultDecorators' => true,
            ]
        );
        
        // Before rendering
        $decorators = $element->getDecorators();
        $this->assertTrue(empty($decorators));
        
        $element->render();
        
        // After rendering
        $decorators = $element->getDecorators();
        $this->assertTrue(empty($decorators));
    }
    
    /**
     * @group ZF-11609
     */
    public function testIndividualDecoratorsBeforeAndAfterRendering()
    {
        // Disable default decorators is true
        $element = new Zend_Form_Element_Captcha(
            'foo',
            [
                'captcha'        => 'Dumb',
                'captchaOptions' => [
                    'sessionClass' => 'Zend_Form_Element_CaptchaTest_SessionContainer',
                ],
                'disableLoadDefaultDecorators' => true,
                'decorators'                   => [
                    'Description',
                    'Errors',
                    'Captcha_Word',
                    'Captcha',
                    'Label',
                ],
            ]
        );
        
        // Before rendering
        $decorators = array_keys($element->getDecorators());
        $this->assertSame(
            [
                'Zend_Form_Decorator_Description',
                'Zend_Form_Decorator_Errors',
                'Zend_Form_Decorator_Captcha_Word',
                'Zend_Form_Decorator_Captcha',
                'Zend_Form_Decorator_Label',
            ],
            $decorators,
            var_export($decorators, true)
        );
        
        $element->render();
        
        // After rendering
        $decorators = array_keys($element->getDecorators());
        $this->assertSame(
            [
                'Zend_Form_Decorator_Description',
                'Zend_Form_Decorator_Errors',
                'Zend_Form_Decorator_Captcha_Word',
                'Zend_Form_Decorator_Captcha',
                'Zend_Form_Decorator_Label',
            ],
            $decorators,
            var_export($decorators, true)
        );
        
        // Disable default decorators is false
        $element = new Zend_Form_Element_Captcha(
            'foo',
            [
                'captcha'        => 'Dumb',
                'captchaOptions' => [
                    'sessionClass' => 'Zend_Form_Element_CaptchaTest_SessionContainer',
                ],
                'decorators' => [
                    'Description',
                    'Errors',
                    'Captcha_Word',
                    'Captcha',
                    'Label',
                ],
            ]
        );
        
        // Before rendering
        $decorators = array_keys($element->getDecorators());
        $this->assertSame(
            [
                'Zend_Form_Decorator_Description',
                'Zend_Form_Decorator_Errors',
                'Zend_Form_Decorator_Captcha_Word',
                'Zend_Form_Decorator_Captcha',
                'Zend_Form_Decorator_Label',
            ],
            $decorators,
            var_export($decorators, true)
        );
        
        $element->render();
        
        // After rendering
        $decorators = array_keys($element->getDecorators());
        $this->assertSame(
            [
                'Zend_Form_Decorator_Description',
                'Zend_Form_Decorator_Errors',
                'Zend_Form_Decorator_Captcha_Word',
                'Zend_Form_Decorator_Captcha',
                'Zend_Form_Decorator_Label',
            ],
            $decorators,
            var_export($decorators, true)
        );
    }
    
    /**
     * @group ZF-12173
     */
    public function testShouldAllowAddingCaptchaPrefixPathWithBackslash()
    {
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            $this->markTestSkipped(__CLASS__ . '::' . __METHOD__ . ' requires PHP 5.3.0 or greater');
            return;
        }
        $this->element->addPrefixPath('My\Captcha', 'My/Captcha/', 'captcha');
        $loader = $this->element->getPluginLoader('captcha');
        $paths  = $loader->getPaths('My\Captcha');
        $this->assertTrue(is_array($paths));
    }
    
    /**
     * @group ZF-12173
     */
    public function testAddingCaptchaPrefixPathWithBackslash()
    {
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            $this->markTestSkipped(__CLASS__ . '::' . __METHOD__ . ' requires PHP 5.3.0 or greater');
            return;
        }
        $this->element->addPrefixPath('My\\', 'My/');
        $loader = $this->element->getPluginLoader('captcha');
        $paths  = $loader->getPaths('My\Captcha');
        $this->assertTrue(is_array($paths));
    }
}

/**
 * @category   Zend
 * @package    Zend_Form
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Form
 */
class Zend_Form_Element_CaptchaTest_SessionContainer
{
    protected static $_word;

    public function __get($name)
    {
        if ('word' == $name) {
            return self::$_word;
        }

        return null;
    }

    public function __set($name, $value)
    {
        if ('word' == $name) {
            self::$_word = $value;
        } else {
            $this->$name = $value;
        }
    }

    public function __isset($name)
    {
        if (('word' == $name) && (null !== self::$_word))  {
            return true;
        }

        return false;
    }

    public function __call($method, $args)
    {
        switch ($method) {
            case 'setExpirationHops':
            case 'setExpirationSeconds':
                $this->$method = array_shift($args);
                break;
            default:
        }
    }
}

// Call Zend_Form_Element_CaptchaTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Form_Element_CaptchaTest::main") {
    Zend_Form_Element_CaptchaTest::main();
}
