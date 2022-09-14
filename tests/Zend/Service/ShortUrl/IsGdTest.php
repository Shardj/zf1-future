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
 * @package    Zend_Service
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_Service_ShortUrl_IsGd */
require_once 'Zend/Service/ShortUrl/IsGd.php';

/**
 * @package  Zend_Service
 * @subpackage  UnitTests
 */
class Zend_Service_ShortUrl_IsGdTest extends PHPUnit_Framework_TestCase
{
    /**
     * Zend_Service_ShortUrl_IsGd object
     *
     * @var Zend_Service_ShortUrl_IsGd
     */
    protected $_s;

    /**
     * Creates a new Zend_Service_ShortUrl_IsGd object for each test method
     *
     * @return void
     */
    public function setUp ()
    {
        if (!defined('TESTS_ZEND_SERVICE_SHORTURL_ISGD_ENABLED')
            || !constant('TESTS_ZEND_SERVICE_SHORTURL_ISGD_ENABLED')
        ) {
            $this->markTestSkipped('Testing Zend_Service_ShortUrl_IsGdTest only works when TESTS_ZEND_SERVICE_SHORTURL_ISGD_ENABLED is set.');
        }
        
        Zend_Service_Abstract::setHttpClient(new Zend_Http_Client());

        $this->_s = new Zend_Service_ShortUrl_IsGd();
        $this->_s->getHttpClient()->resetParameters(true);
    }

    public function testShortenEmptyUrlException()
    {
        $this->setExpectedException('Zend_Service_ShortUrl_Exception');
        $this->_s->shorten('');
    }

    public function testShortenIncorrectUrlException()
    {
        $this->setExpectedException('Zend_Service_ShortUrl_Exception');
        $this->_s->shorten('wrongAdress.cccc');
    }

    public function testShorten()
    {
        $urls = [
            'http://framework.zend.com/',
            'http://framework.zend.com/manual/en/',
        ];

        foreach ($urls as $url) {
            $shortenedUrl = $this->_s->shorten($url);

            $this->assertNotEquals($url, $shortenedUrl);
            $this->assertEquals($url, $this->_s->unshorten($shortenedUrl));
        }
    }

    public function testUnshorten()
    {
        $urls = [
            'http://framework.zend.com/'           => 'http://is.gd/g3ASn',
            'http://framework.zend.com/manual/en/' => 'http://is.gd/g3AVm'
        ];

        foreach ($urls as $url => $shortenedUrl) {
            $this->assertEquals($url, $this->_s->unshorten($shortenedUrl));
        }
    }

    public function testUnshortenEmptyUrlException()
    {
        $this->setExpectedException('Zend_Service_ShortUrl_Exception');
        $this->_s->unshorten('');
    }

    public function testUnshortenIncorrectUrlException()
    {
        $this->setExpectedException('Zend_Service_ShortUrl_Exception');
        $this->_s->unshorten('wrongAdress.cccc');
    }

    public function testUnshortenWrongUrlException()
    {
        $this->setExpectedException('Zend_Service_ShortUrl_Exception');
        $this->_s->unshorten('http://www.zend.com');
    }
}
