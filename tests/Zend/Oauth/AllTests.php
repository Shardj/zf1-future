<?php

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
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Oauth_AllTests::main');
}

require_once 'OauthTest.php';
require_once 'ClientTest.php';
require_once 'ConfigTest.php';
require_once 'Oauth/ConsumerTest.php';
require_once 'Oauth/Signature/AbstractTest.php';
require_once 'Oauth/Signature/PlaintextTest.php';
require_once 'Oauth/Signature/HmacTest.php';
require_once 'Oauth/Signature/RsaTest.php';
require_once 'Oauth/Http/RequestTokenTest.php';
require_once 'Oauth/Http/UserAuthorizationTest.php';
require_once 'Oauth/Http/AccessTokenTest.php';
require_once 'Oauth/Http/UtilityTest.php';
require_once 'Oauth/Token/RequestTest.php';
require_once 'Oauth/Token/AuthorizedRequestTest.php';
require_once 'Oauth/Token/AccessTest.php';

/**
 * @category   Zend
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Oauth
 */
class Zend_Oauth_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_Oauth');

        $suite->addTestSuite('Zend_OauthTest');
        $suite->addTestSuite('Zend_Oauth_ClientTest');
        $suite->addTestSuite('Zend_Oauth_ConfigTest');
        $suite->addTestSuite('Zend_Oauth_ConsumerTest');
        $suite->addTestSuite('Zend_Oauth_Signature_AbstractTest');
        $suite->addTestSuite('Zend_Oauth_Signature_PlaintextTest');
        $suite->addTestSuite('Zend_Oauth_Signature_HmacTest');
        $suite->addTestSuite('Zend_Oauth_Signature_RsaTest');
        $suite->addTestSuite('Zend_Oauth_Http_RequestTokenTest');
        $suite->addTestSuite('Zend_Oauth_Http_UserAuthorizationTest');
        $suite->addTestSuite('Zend_Oauth_Http_AccessTokenTest');
        $suite->addTestSuite('Zend_Oauth_Http_UtilityTest');
        $suite->addTestSuite('Zend_Oauth_Token_RequestTest');
        $suite->addTestSuite('Zend_Oauth_Token_AuthorizedRequestTest');
        $suite->addTestSuite('Zend_Oauth_Token_AccessTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Oauth_AllTests::main') {
    Zend_Oauth_AllTests::main();
}
