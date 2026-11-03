<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

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
//require_once 'Zend/Oauth/Signature/Rsa.php';
/**
 * @category   Zend
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Oauth
 * @group      Zend_Oauth_Signature
 */
class Zend_Oauth_Signature_RsaTest extends TestCase
{
    public function testSignatureWithoutAccessSecretIsHashedWithConsumerSecret()
    {
        $this->markTestIncomplete('Zend_Crypt_Rsa finalisation outstanding');
    }

    public function testSignatureWithAccessSecretIsHashedWithConsumerAndAccessSecret()
    {
        $this->markTestIncomplete('Zend_Crypt_Rsa finalisation outstanding');
    }
}
