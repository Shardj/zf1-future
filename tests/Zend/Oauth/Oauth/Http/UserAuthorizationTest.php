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
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Oauth/Http/UserAuthorization.php';

/**
 * @category   Zend
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Oauth
 * @group      Zend_Oauth_Http
 */
class Zend_Oauth_Http_UserAuthorizationTest extends PHPUnit_Framework_TestCase
{

    protected $stubConsumer = null;

    public function setup()
    {
        $this->stubConsumer = new Test_Consumer_34879;
    }

    public function testConstructorSetsConsumerInstance()
    {
        $redirect = new Zend_Oauth_Http_UserAuthorization($this->stubConsumer);
        $this->assertTrue($redirect->getConsumer() instanceof Test_Consumer_34879);
    }

    public function testConstructorSetsCustomServiceParameters()
    {
        $redirect = new Zend_Oauth_Http_UserAuthorization($this->stubConsumer, [1,2,3]);
        $this->assertEquals([1,2,3], $redirect->getParameters());
    }

    public function testAssembleParametersReturnsUserAuthorizationParamArray()
    {
        $redirect = new Zend_Oauth_Http_UserAuthorization($this->stubConsumer, ['foo '=>'bar~']);
        $expected = [
            'oauth_token'=>'1234567890',
            'oauth_callback'=>'http://www.example.com/local',
            'foo '=>'bar~'
        ];
        $this->assertEquals($expected, $redirect->assembleParams());
    }

    public function testGetUrlReturnsEncodedQueryStringParamsAppendedToLocalUrl()
    {
        $redirect = new Zend_Oauth_Http_UserAuthorization($this->stubConsumer, ['foo '=>'bar~']);
        $expected =
            'http://www.example.com/authorize?oauth_token=1234567890&oauth_callback=http%3A%2F%2Fwww.example.com%2Flocal&foo%20=bar~';
        $this->assertEquals($expected, $redirect->getUrl());
    }

}

class Test_Consumer_34879 extends Zend_Oauth_Consumer
{
    public function getUserAuthorizationUrl(){return 'http://www.example.com/authorize';}
    public function getCallbackUrl(){return 'http://www.example.com/local';}
    public function getLastRequestToken(){$r=new Test_Token_34879;return $r;}
}
class Test_Token_34879
{
    public function getToken(){return '1234567890';}
}
