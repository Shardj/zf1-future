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

require_once 'Zend/Oauth.php';
require_once 'Zend/Oauth/Config.php';
require_once 'Zend/Oauth/Client.php';

class Test_Oauth_Client extends Zend_Oauth_Client {
    public function getSignableParametersAsQueryString()
    {
        return $this->_getSignableParametersAsQueryString();
    }
}

/**
 * @category   Zend
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Oauth
 */
class Zend_Oauth_ClientTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->client = new Zend_Oauth_Client([]);
    }

    /**
     * @group ZF-12488
     */
    public function testAllowsOptionsAsRequestMethod()
    {
        $this->client->setRequestMethod(Zend_Oauth_Client::OPTIONS);
        $this->assertEquals(Zend_Oauth_Client::OPTIONS, $this->client->getRequestMethod());
    }

    /**
     * zendframework / zf1 # 244
     */
    public function testIncludesParametersForSignatureOnPostEncUrlEncoded()
    {
        $client = new Test_Oauth_Client([]);
        $client->setEncType(Zend_Http_Client::ENC_URLENCODED);
        $params = [
            'param1' => 'dummy1',
            'param2' => 'dummy2',
        ];
        $client->setParameterPost($params);
        $client->setMethod(Zend_Http_Client::POST);
        $this->assertEquals(2, count($client->getSignableParametersAsQueryString()));
    }

    /**
     * zendframework / zf1 # 244
     */
    public function testExcludesParametersOnPostEncFormData()
    {
        $client = new Test_Oauth_Client([]);
        $client->setEncType(Zend_Http_Client::ENC_FORMDATA);
        $params = [
            'param1' => 'dummy1',
            'param2' => 'dummy2',
        ];
        $client->setParameterPost($params);
        $client->setMethod(Zend_Http_Client::POST);
        $this->assertEquals(0, count($client->getSignableParametersAsQueryString()));
    }
}
