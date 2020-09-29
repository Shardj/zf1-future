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

require_once 'Zend/Oauth/Token/AuthorizedRequest.php';

/**
 * @category   Zend
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Oauth
 * @group      Zend_Oauth_Token
 */
class Zend_Oauth_Token_AuthorizedRequestTest extends PHPUnit_Framework_TestCase
{

    public function testConstructorSetsInputData()
    {
        $data = ['foo'=>'bar'];
        $token = new Zend_Oauth_Token_AuthorizedRequest($data);
        $this->assertEquals($data, $token->getData());
    }

    public function testConstructorParsesAccessTokenFromInputData()
    {
        $data = [
            'oauth_token'=>'jZaee4GF52O3lUb9'
        ];
        $token = new Zend_Oauth_Token_AuthorizedRequest($data);
        $this->assertEquals('jZaee4GF52O3lUb9', $token->getToken());
    }

    public function testPropertyAccessWorks()
    {
        $data = [
            'oauth_token'=>'jZaee4GF52O3lUb9'
        ];
        $token = new Zend_Oauth_Token_AuthorizedRequest($data);
        $this->assertEquals('jZaee4GF52O3lUb9', $token->oauth_token);
    }

    public function testTokenCastsToEncodedQueryString()
    {
        $queryString = 'oauth_token=jZaee4GF52O3lUb9&foo%20=bar~';
        $token = new Zend_Oauth_Token_AuthorizedRequest();
        $token->setToken('jZaee4GF52O3lUb9');
        $token->setParam('foo ', 'bar~');
        $this->assertEquals($queryString, (string) $token);
    }

    public function testToStringReturnsEncodedQueryString()
    {
        $queryString = 'oauth_token=jZaee4GF52O3lUb9';
        $token = new Zend_Oauth_Token_AuthorizedRequest();
        $token->setToken('jZaee4GF52O3lUb9');
        $this->assertEquals($queryString, $token->toString());
    }

    public function testIsValidDetectsBadResponse()
    {
        $data = [
            'missing_oauth_token'=>'jZaee4GF52O3lUb9'
        ];
        $token = new Zend_Oauth_Token_AuthorizedRequest($data);
        $this->assertFalse($token->isValid());
    }

    public function testIsValidDetectsGoodResponse()
    {
        $data = [
            'oauth_token'=>'jZaee4GF52O3lUb9',
            'foo'=>'bar'
        ];
        $token = new Zend_Oauth_Token_AuthorizedRequest($data);
        $this->assertTrue($token->isValid());
    }

}
