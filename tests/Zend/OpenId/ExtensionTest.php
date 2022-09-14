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
 * @package    Zend_OpenId
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_OpenId
 */
require_once 'Zend/OpenId/Extension.php';
require_once 'Zend/OpenId/Extension/Sreg.php';


/**
 * @category   Zend
 * @package    Zend_OpenId
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_OpenId
 */
class Zend_OpenId_ExtensionTest extends PHPUnit_Framework_TestCase
{
    /**
     * testing forAll
     *
     */
    public function testForAll()
    {
        $params = [];
        $this->assertTrue( Zend_OpenId_Extension::forAll(null, 'getTrustData', $params) );
        $this->assertSame( [], $params );

        $params = [];
        $this->assertTrue( Zend_OpenId_Extension::forAll([], 'getTrustData', $params) );
        $this->assertSame( [], $params );

        $params = [];
        $this->assertFalse( Zend_OpenId_Extension::forAll([1], 'getTrustData', $params) );

        $params = [];
        $this->assertFalse( Zend_OpenId_Extension::forAll(new stdClass(), 'getTrustData', $params) );

        $ext = new Zend_OpenId_Extension_Sreg();
        $params = [];
        $this->assertTrue( Zend_OpenId_Extension::forAll($ext, 'getTrustData', $params) );
        $this->assertSame( ['Zend_OpenId_Extension_Sreg'=>[]], $params );

        $ext = new Zend_OpenId_Extension_Sreg();
        $params = [];
        $this->assertTrue( Zend_OpenId_Extension::forAll([$ext], 'getTrustData', $params) );
        $this->assertSame( ['Zend_OpenId_Extension_Sreg'=>[]], $params );

        $ext = new Zend_OpenId_Extension_Helper();
        $params = [];
        $this->assertTrue( Zend_OpenId_Extension::forAll([$ext], 'getTrustData', $params) );
        $this->assertSame( [], $params );
        $this->assertFalse( Zend_OpenId_Extension::forAll([$ext], 'wrong', $params) );
        $this->assertSame( [], $params );
    }

    /**
     * testing extension callbacks
     *
     */
    public function testCallbacks()
    {
        $ext = new Zend_OpenId_Extension_Helper();
        $a = [];
        $this->assertTrue( $ext->prepareRequest($a) );
        $this->assertSame( [], $a );
        $this->assertTrue( $ext->parseRequest($a) );
        $this->assertSame( [], $a );
        $this->assertTrue( $ext->prepareResponse($a) );
        $this->assertSame( [], $a );
        $this->assertTrue( $ext->parseResponse($a) );
        $this->assertSame( [], $a );
        $this->assertTrue( $ext->getTrustData($a) );
        $this->assertSame( [], $a );
        $this->assertTrue( $ext->checkTrustData($a) );
        $this->assertSame( [], $a );
        $this->assertFalse( $ext->wrong($a) );
        $this->assertSame( [], $a );
    }
}

class Zend_OpenId_Extension_Helper extends Zend_OpenId_Extension
{
    function wrong($data)
    {
        return false;
    }
}
