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
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: BaseUrlTest.php 20096 2010-01-06 02:05:09Z bkarwin $
 */

// Call Zend_View_Helper_BaseUrlTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_View_Helper_GravatarTest::main');
}

/**
 * @see Zend_View_Helper_Gravatar
 */
require_once 'Zend/View/Helper/Gravatar.php';

/**
 * @see Zend_View
 */
require_once 'Zend/View.php';

/**
 * @category   Zend
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_View
 * @group      Zend_View_Helper
 */
class Zend_View_Helper_GravatarTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Zend_View_Helper_Gravatar
     */
    protected $_object;

    /**
     * @var Zend_View
     */
    protected $_view;

    /**
     * Main
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Zend_View_Helper_GravatarTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        $this->_object = new Zend_View_Helper_Gravatar();
        $this->_view   = new Zend_View();
        $this->_view->doctype()->setDoctype(strtoupper("XHTML1_STRICT"));
        $this->_object->setView($this->_view);

        if( isset($_SERVER['HTTPS'])) {
            unset ($_SERVER['HTTPS']);
        }
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        unset($this->_object, $this->_view);
    }

    /**
     * Test default options.
     */
    public function testGravataXHTMLDoctype()
    {
        $this->assertRegExp('/\/>$/',
            $this->_object->gravatar('example@example.com')->__toString());
    }

    /**
     * Test if doctype is HTML
     */
    public function testGravatarHTMLDoctype()
    {
        $object = new Zend_View_Helper_Gravatar();
        $view   = new Zend_View();
        $view->doctype()->setDoctype(strtoupper("HTML5"));
        $object->setView($view);

        $this->assertRegExp('/[^\/]>$/',
            $this->_object->gravatar('example@example.com')->__toString());
    }

    /**
     * Test get set methods
     */
    public function testGetAndSetMethods()
    {
        $attribs = ['class' => 'gravatar', 'title' => 'avatar', 'id' => 'gravatar-1'];
        $this->_object->setDefaultImg('monsterid')
             ->setImgSize(150)
             ->setSecure(true)
             ->setEmail("example@example.com")
             ->setAttribs($attribs)
             ->setRating('pg');
        $this->assertEquals("monsterid", $this->_object->getDefaultImg());
        $this->assertEquals("pg", $this->_object->getRating());
        $this->assertEquals("example@example.com", $this->_object->getEmail());
        $this->assertEquals($attribs, $this->_object->getAttribs());
        $this->assertEquals(150, $this->_object->getImgSize());
        $this->assertTrue($this->_object->getSecure());
    }

    public function tesSetDefaultImg()
    {
        $this->_object->gravatar("example@example.com");

        $img = [
            "wavatar",
            "http://www.example.com/images/avatar/example.png",
            Zend_View_Helper_Gravatar::DEFAULT_MONSTERID,
        ];

        foreach ($img as $value) {
            $this->_object->setDefaultImg($value);
            $this->assertEquals(urlencode($value), $this->_object->getDefaultImg());
        }
    }

    public function testSetImgSize()
    {
        $imgSizesRight = [1, 500, "600"];
        foreach ($imgSizesRight as $value) {
            $this->_object->setImgSize($value);
            $this->assertTrue(is_int($this->_object->getImgSize()));
        }
    }

    public function testInvalidRatingParametr()
    {
        $ratingsWrong = [ 'a', 'cs', 456];
        $this->setExpectedException('Zend_View_Exception');
        foreach ($ratingsWrong as $value) {
            $this->_object->setRating($value);
        }
    }

    public function testSetRating()
    {
        $ratingsRight = [ 'g', 'pg', 'r', 'x', Zend_View_Helper_Gravatar::RATING_R];
        foreach ($ratingsRight as $value) {
            $this->_object->setRating($value);
            $this->assertEquals($value, $this->_object->getRating());
        }
    }

    public function testSetSecure()
    {
        $values = ["true", "false", "text", $this->_view, 100, true, "", null, 0, false];
        foreach ($values as $value) {
            $this->_object->setSecure($value);
            $this->assertTrue(is_bool($this->_object->getSecure()));
        }
    }

    /**
     * Test SSL location
     */
    public function testHttpsSource()
    {
        $this->assertRegExp('/src="https:\/\/secure.gravatar.com\/avatar\/[a-z0-9]{32}.+"/',
                $this->_object->gravatar("example@example.com", ['secure' => true])->__toString());
    }

    /**
     * Test HTML attribs
     */
    public function testImgAttribs()
    {
        $this->assertRegExp('/class="gravatar" title="Gravatar"/',
                $this->_object->gravatar("example@example.com", [],
                        ['class' => 'gravatar', 'title' => 'Gravatar'])
                     ->__toString()
        );
    }

    /**
     * Test gravatar's options (rating, size, default image and secure)
     */
    public function testGravatarOptions()
    {
        $this->assertRegExp('/src="http:\/\/www.gravatar.com\/avatar\/[a-z0-9]{32}\?s=125&amp;d=wavatar&amp;r=pg"/',
                $this->_object->gravatar("example@example.com",
                        ['rating' => 'pg', 'imgSize' => 125, 'defaultImg' => 'wavatar',
                            'secure' => false])
                     ->__toString()
        );
    }

    /**
     * Test auto detect location.
     * If request was made through the HTTPS protocol use secure location.
     */
    public function testAutoDetectLocation()
    {
        $values = ["on", "", 1, true];

        foreach ($values as $value) {
            $_SERVER['HTTPS'] = $value;
            $this->assertRegExp('/src="https:\/\/secure.gravatar.com\/avatar\/[a-z0-9]{32}.+"/',
                    $this->_object->gravatar("example@example.com")->__toString());
        }
    }

    /**
     * @link http://php.net/manual/en/reserved.variables.server.php Section "HTTPS"
     */
    public function testAutoDetectLocationOnIis()
    {
        $_SERVER['HTTPS'] = "off";

        $this->assertRegExp('/src="http:\/\/www.gravatar.com\/avatar\/[a-z0-9]{32}.+"/',
                $this->_object->gravatar("example@example.com")->__toString());
    }

    public function testSetAttribsWithSrcKey()
    {
        $email = 'example@example.com';
        $this->_object->setEmail($email);
        $this->_object->setAttribs([
            'class' => 'gravatar',
            'src'   => 'http://example.com',
            'id'    => 'gravatarID',
        ]);

        $this->assertRegExp('/src="http:\/\/www.gravatar.com\/avatar\/[a-z0-9]{32}.+"/',
                            $this->_object->getImgTag());
    }

    public function testForgottenEmailParameter()
    {
        $this->assertRegExp('/(src="http:\/\/www.gravatar.com\/avatar\/[a-z0-9]{32}.+")/',
                            $this->_object->getImgTag());
    }

    public function testReturnImgTag()
    {
        $this->assertRegExp("/^<img\s.+/",
        $this->_object->gravatar("example@example.com")->__toString());
    }

    public function testReturnThisObject()
    {
        $this->assertTrue(
            $this->_object->gravatar() instanceof Zend_View_Helper_Gravatar
        );
    }

    public function testInvalidKeyPassedToSetOptionsMethod()
    {
        $options = [
            'unknown' => ['val' => 1]
        ];
        $this->_object->gravatar()->setOptions($options);
    }
}

// Call Zend_View_Helper_BaseUrlTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Zend_View_Helper_BaseUrlTest::main') {
    Zend_View_Helper_BaseUrlTest::main();
}
