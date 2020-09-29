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

// Call Zend_Form_Decorator_ReCaptchaTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Form_Decorator_ReCaptchaTest::main");
}

require_once 'Zend/Form/Decorator/Captcha/ReCaptcha.php';
require_once 'Zend/Form/Element/Captcha.php';
require_once 'Zend/View.php';

/**
 * Test class for Zend_Form_Decorator_Captcha_ReCaptcha
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Form
 */
class Zend_Form_Decorator_ReCaptchaTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {

        $suite  = new PHPUnit_Framework_TestSuite("Zend_Form_Decorator_ReCaptchaTest");
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
        $view = new Zend_View();
        $this->element   = new Zend_Form_Element_Captcha('captcha', [
            'captcha' => [
                'captcha' => 'ReCaptcha',
                'privKey' => 'private',
                'pubKey'  => 'public',
            ],
        ]);
        $this->element->setView($view);
        $this->decorator = new Zend_Form_Decorator_Captcha_ReCaptcha();
        $this->decorator->setElement($this->element);
    }

    /** @group ZF-10991 */
    public function testDecoratorCreatesHiddenFieldsForChallengeAndResponse()
    {
        $html = $this->decorator->render('');
        $this->assertContains('type="hidden" name="recaptcha_challenge_field" value="" id="captcha-challenge"', $html, $html);
        $this->assertContains('type="hidden" name="recaptcha_response_field" value="" id="captcha-response"', $html, $html);
    }

    /** @group ZF-10991 */
    public function testDecoratorCreatesJavascriptOnSubmitHandler()
    {
        $html = $this->decorator->render('');
        // Test that we have script tags
        $this->assertContains('<script type="text/javascript" language="JavaScript">', $html);
        $this->assertContains('</script>', $html);

        // Test that we create a DOM window.onload event, and trigger any previous
        $this->assertContains('function windowOnLoad', $html);
        $this->assertContains('old = window.onload', $html);
        $this->assertContains('if (old)', $html);

        //Test that we create IE/Mozilla zendBindEvent mediator
        $this->assertContains('function zendBindEvent', $html);

        // Test that we add an event listener for the form submit event
        $this->assertContains('document.getElementById("captcha-challenge").form,', $html);

        // Test that we reset the hidden fields with the global recaptcha values
        $this->assertContains('document.getElementById("captcha-challenge").value = document.getElementById("recaptcha_challenge_field").value', $html);
        $this->assertContains('document.getElementById("captcha-response").value = document.getElementById("recaptcha_response_field").value', $html);
    }

    /** @group ZF-10991 */
    public function testDecoratorCreatesHiddenFieldsWithNestedIdsAndNamesWhenElementBelongsToArray()
    {
        $this->element->setBelongsTo('contact');
        $html = $this->decorator->render('');
        $this->assertContains('type="hidden" name="contact[recaptcha_challenge_field]" value="" id="contact-captcha-challenge"', $html, $html);
        $this->assertContains('type="hidden" name="contact[recaptcha_response_field]" value="" id="contact-captcha-response"', $html, $html);
    }

    /** @group ZF-10991 */
    public function testDecoratorUsesNamespacedIdsInJavascriptOnSubmitHandler()
    {
        $this->element->setBelongsTo('contact');
        $html = $this->decorator->render('');
        $this->assertContains('document.getElementById("contact-captcha-challenge").form,', $html);
        $this->assertContains('document.getElementById("contact-captcha-challenge").value = document.getElementById("recaptcha_challenge_field").value', $html);
        $this->assertContains('document.getElementById("contact-captcha-response").value = document.getElementById("recaptcha_response_field").value', $html);
    }
}

// Call Zend_Form_Decorator_ReCaptchaTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Form_Decorator_ReCaptchaTest::main") {
    Zend_Form_Decorator_ReCaptchaTest::main();
}

