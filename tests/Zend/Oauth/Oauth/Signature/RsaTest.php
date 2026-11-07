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
    /**
     * @var resource|OpenSSLAsymmetricKey
     */
    private $_key;

    protected function set_up()
    {
        if (!extension_loaded('openssl')) {
            $this->markTestSkipped('RSA signatures require the openssl extension');
        }
        $this->_key = openssl_pkey_new(['private_key_bits' => 2048, 'private_key_type' => OPENSSL_KEYTYPE_RSA]);
    }

    private function _params()
    {
        return [
            'oauth_version' => '1.0',
            'oauth_consumer_key' => 'dpf43f3p2l4k3l03',
            'oauth_signature_method' => 'RSA-SHA1',
            'oauth_timestamp' => '1191242090',
            'oauth_nonce' => 'hsu94j3884jdopsl',
        ];
    }

    private function _privateKey()
    {
        openssl_pkey_export($this->_key, $pem);
        return new Zend_Crypt_Rsa_Key_Private($pem);
    }

    public function testSignatureIsTheRsaSha1SignatureOfTheBaseString()
    {
        $signature = new Zend_Oauth_Signature_Rsa($this->_privateKey(), null, 'SHA1');
        $result = $signature->sign($this->_params(), 'GET', 'http://photos.example.net/photos');

        $baseString = 'GET&http%3A%2F%2Fphotos.example.net%2Fphotos&'
            . rawurlencode('oauth_consumer_key=dpf43f3p2l4k3l03&oauth_nonce=hsu94j3884jdopsl'
            . '&oauth_signature_method=RSA-SHA1&oauth_timestamp=1191242090&oauth_version=1.0');
        $publicKey = openssl_pkey_get_details($this->_key)['key'];
        $this->assertSame(1, openssl_verify($baseString, base64_decode($result), $publicKey, OPENSSL_ALGO_SHA1));
    }

    public function testTokenSecretDoesNotChangeTheSignature()
    {
        $key = $this->_privateKey();
        $withoutToken = new Zend_Oauth_Signature_Rsa($key, null, 'SHA1');
        $withToken = new Zend_Oauth_Signature_Rsa($key, '0987654321', 'SHA1');

        $this->assertSame(
            $withoutToken->sign($this->_params(), 'GET', 'http://photos.example.net/photos'),
            $withToken->sign($this->_params(), 'GET', 'http://photos.example.net/photos')
        );
    }
}
