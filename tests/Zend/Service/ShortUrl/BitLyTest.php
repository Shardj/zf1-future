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

/** Zend_Service_ShortUrl_BitLy */
require_once 'Zend/Service/ShortUrl/BitLy.php';

/**
 * @package  Zend_Service
 * @subpackage  UnitTests
 */
class Zend_Service_ShortUrl_BitLyTest extends PHPUnit_Framework_TestCase
{

    /**
     * reset zend service http client
     *
     * @return void
     */
    public function setUp ()
    {
        if (!defined('TESTS_ZEND_SERVICE_SHORTURL_BITLY_ENABLED')
            || !constant('TESTS_ZEND_SERVICE_SHORTURL_BITLY_ENABLED')
        ) {
            $this->markTestSkipped('Testing Zend_Service_ShortUrl_BitLyTest only works when TESTS_ZEND_SERVICE_SHORTURL_BITLY_ENABLED is set.');
        }
        
        Zend_Service_Abstract::setHttpClient(new Zend_Http_Client());
    }

    public function testShortenEmptyUrlException()
    {
        $this->setExpectedException('Zend_Service_ShortUrl_Exception');

        $s = new Zend_Service_ShortUrl_BitLy('test');
        $s->shorten('');
    }

    public function testShortenIncorrectUrlException()
    {
        $this->setExpectedException('Zend_Service_ShortUrl_Exception');

        $s = new Zend_Service_ShortUrl_BitLy('test');
        $s->shorten('wrongAdress.cccc');
    }

    public function testExceptionOnBadApiResponse()
    {
        $this->setExpectedException('Zend_Service_ShortUrl_Exception');

        $clientResponse = $this->getMock('Zend_Http_Response', [], [], '', false);
        $clientResponse->expects($this->once())->method('getStatus')->will($this->returnValue(500));

        $client = $this->getMock('Zend_Http_Client', [], [], '', false);
        $client->expects($this->once())->method('request')->will($this->returnValue($clientResponse));

        $s = new Zend_Service_ShortUrl_BitLy('test');
        $s->setHttpClient($client);
        $s->shorten('http://framework.zend.com');
    }

    public function testAuthenticationWithAccessToken()
    {
        $accessToken = 'test';

        $clientResponse = $this->getMock('Zend_Http_Response', [], [], '', false);
        $clientResponse->expects($this->once())->method('getStatus')->will($this->returnValue(200));
        $clientResponse->expects($this->once())->method('getBody')->will($this->returnValue('http://bit.ly/ZFramework'));

        $client = $this->getMock('Zend_Http_Client', [], [], '', false);
        $client->expects($this->any())->method('setParameterGet')->with($this->anything(),$this->anything());
        $client->expects($this->at(0))->method('setParameterGet')->with('access_token',$accessToken);
        $client->expects($this->once())->method('request')->will($this->returnValue($clientResponse));

        $s = new Zend_Service_ShortUrl_BitLy($accessToken);
        $s->setHttpClient($client);
        $s->shorten('http://framework.zend.com');
    }

    public function testAuthenticationWithUserCredentials()
    {
        $login = 'test';
        $apiKey = 'api';

        $clientResponse = $this->getMock('Zend_Http_Response', [], [], '', false);
        $clientResponse->expects($this->once())->method('getStatus')->will($this->returnValue(200));
        $clientResponse->expects($this->once())->method('getBody')->will($this->returnValue('http://bit.ly/ZFramework'));

        $client = $this->getMock('Zend_Http_Client', [], [], '', false);
        $client->expects($this->any())->method('setParameterGet')->with($this->anything(),$this->anything());
        $client->expects($this->at(0))->method('setParameterGet')->with('login',$login);
        $client->expects($this->at(1))->method('setParameterGet')->with('apiKey',$apiKey);
        $client->expects($this->once())->method('request')->will($this->returnValue($clientResponse));

        $s = new Zend_Service_ShortUrl_BitLy($login, $apiKey);
        $s->setHttpClient($client);
        $s->shorten('http://framework.zend.com');
    }
}
