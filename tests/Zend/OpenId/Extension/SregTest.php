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
require_once 'Zend/OpenId/Extension/Sreg.php';


/**
 * @category   Zend
 * @package    Zend_OpenId
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_OpenId
 */
class Zend_OpenId_Extension_SregTest extends PHPUnit_Framework_TestCase
{
    const USER = "test_user";
    const EMAIL = "user@test.com";
    const POLICY = "http://www.somewhere.com/policy.html";

    /**
     * testing getProperties
     *
     */
    public function testGetProperties()
    {
        $ext = new Zend_OpenId_Extension_Sreg();
        $this->assertSame( [], $ext->getProperties() );
        $ext = new Zend_OpenId_Extension_Sreg(['nickname'=>true,'email'=>false]);
        $this->assertSame( ['nickname'=>true,'email'=>false], $ext->getProperties() );
    }

    /**
     * testing getPolicyUrl
     *
     */
    public function testGetPolicyUrl()
    {
        $ext = new Zend_OpenId_Extension_Sreg();
        $this->assertSame( null, $ext->getPolicyUrl() );
        $ext = new Zend_OpenId_Extension_Sreg(null, self::POLICY);
        $this->assertSame( self::POLICY, $ext->getPolicyUrl() );
    }

    /**
     * testing getVersion
     *
     */
    public function testGetVersion()
    {
        $ext = new Zend_OpenId_Extension_Sreg();
        $this->assertSame( 1.0, $ext->getVersion() );
        $ext = new Zend_OpenId_Extension_Sreg(null, null, 1.1);
        $this->assertSame( 1.1, $ext->getVersion() );
    }

    /**
     * testing getSregProperties
     *
     */
    public function testGetSregProperties()
    {
        $this->assertSame(
            [
                "nickname",
                "email",
                "fullname",
                "dob",
                "gender",
                "postcode",
                "country",
                "language",
                "timezone"
            ],
            Zend_OpenId_Extension_Sreg::getSregProperties() );
    }

    /**
     * testing prepareRequest
     *
     */
    public function testPrepareRequest()
    {
        $ext = new Zend_OpenId_Extension_Sreg();
        $params = [];
        $this->assertTrue( $ext->prepareRequest($params) );
        $this->assertSame( [], $params );
        $ext = new Zend_OpenId_Extension_Sreg(["nickname"=>true,"email"=>false]);
        $params = [];
        $this->assertTrue( $ext->prepareRequest($params) );
        $this->assertSame( ['openid.sreg.required'=>"nickname", 'openid.sreg.optional'=>"email"], $params );
        $ext = new Zend_OpenId_Extension_Sreg(["nickname"=>true,"email"=>true], self::POLICY);
        $params = [];
        $this->assertTrue( $ext->prepareRequest($params) );
        $this->assertSame( ['openid.sreg.required'=>"nickname,email", 'openid.sreg.policy_url' => self::POLICY], $params );
        $ext = new Zend_OpenId_Extension_Sreg(["nickname"=>false,"email"=>false], self::POLICY, 1.1);
        $params = [];
        $this->assertTrue( $ext->prepareRequest($params) );
        $this->assertSame( ['openid.ns.sreg'=>"http://openid.net/extensions/sreg/1.1",'openid.sreg.optional'=>"nickname,email", 'openid.sreg.policy_url' => self::POLICY], $params );
    }

    /**
     * testing parseRequest
     *
     */
    public function testParseRequest()
    {
        $ext = new Zend_OpenId_Extension_Sreg();

        $this->assertTrue( $ext->parseRequest([]) );
        $this->assertSame( [], $ext->getProperties() );
        $this->assertSame( null, $ext->getPolicyUrl() );
        $this->assertSame( 1.0, $ext->getVersion() );

        $this->assertTrue( $ext->parseRequest(['openid_sreg_required'=>"nickname", 'openid_sreg_optional'=>"email"]) );
        $this->assertSame( ['nickname'=>true,'email'=>false], $ext->getProperties() );
        $this->assertSame( null, $ext->getPolicyUrl() );
        $this->assertSame( 1.0, $ext->getVersion() );

        $this->assertTrue( $ext->parseRequest(['openid_sreg_required'=>"nickname,email", 'openid_sreg_policy_url' => self::POLICY]) );
        $this->assertSame( ['nickname'=>true,'email'=>true], $ext->getProperties() );
        $this->assertSame( self::POLICY, $ext->getPolicyUrl() );
        $this->assertSame( 1.0, $ext->getVersion() );

        $this->assertTrue( $ext->parseRequest(['openid_ns_sreg'=>"http://openid.net/extensions/sreg/1.1", 'openid_sreg_optional'=>"nickname,email", 'openid_sreg_policy_url' => self::POLICY]) );
        $this->assertSame( ['nickname'=>false,'email'=>false], $ext->getProperties() );
        $this->assertSame( self::POLICY, $ext->getPolicyUrl() );
        $this->assertSame( 1.1, $ext->getVersion() );
    }

    /**
     * testing getTrustData
     *
     */
    public function testGetTrustData()
    {
        $ext = new Zend_OpenId_Extension_Sreg();
        $data = [];
        $this->assertTrue( $ext->getTrustData($data) );
        $this->assertSame( 1, count($data) );
        $this->assertSame( [], $data["Zend_OpenId_Extension_Sreg"] );
        $ext = new Zend_OpenId_Extension_Sreg(['nickname'=>true,'email'=>false]);
        $data = [];
        $this->assertTrue( $ext->getTrustData($data) );
        $this->assertSame( 1, count($data) );
        $this->assertSame( ['nickname'=>true,'email'=>false], $data["Zend_OpenId_Extension_Sreg"] );
    }

    /**
     * testing checkTrustData
     *
     */
    public function testCheckTrustData()
    {
        $ext = new Zend_OpenId_Extension_Sreg();
        $this->assertTrue( $ext->checkTrustData([]) );
        $this->assertSame( [], $ext->getProperties() );

        $ext = new Zend_OpenId_Extension_Sreg();
        $this->assertTrue( $ext->checkTrustData(["Zend_OpenId_Extension_Sreg"=>[]]) );
        $this->assertSame( [], $ext->getProperties() );

        $ext = new Zend_OpenId_Extension_Sreg([]);
        $this->assertTrue( $ext->checkTrustData(["Zend_OpenId_Extension_Sreg"=>["nickname"=>self::USER, "email"=>self::EMAIL]]) );
        $this->assertSame( [], $ext->getProperties() );

        $ext = new Zend_OpenId_Extension_Sreg(["nickname"=>true,"email"=>true]);
        $this->assertTrue( $ext->checkTrustData(["Zend_OpenId_Extension_Sreg"=>["nickname"=>self::USER, "email"=>self::EMAIL]]) );
        $this->assertSame( ['nickname'=>self::USER, "email"=>self::EMAIL], $ext->getProperties() );

        $ext = new Zend_OpenId_Extension_Sreg(["nickname"=>true,"email"=>true]);
        $this->assertFalse( $ext->checkTrustData(["Zend_OpenId_Extension_Sreg"=>["nickname"=>self::USER]]) );

        $ext = new Zend_OpenId_Extension_Sreg(["nickname"=>true,"email"=>false]);
        $this->assertTrue( $ext->checkTrustData(["Zend_OpenId_Extension_Sreg"=>["nickname"=>self::USER]]) );
        $this->assertSame( ['nickname'=>self::USER], $ext->getProperties() );

        $ext = new Zend_OpenId_Extension_Sreg(["nickname"=>false,"email"=>true]);
        $this->assertTrue( $ext->checkTrustData(["Zend_OpenId_Extension_Sreg"=>["nickname"=>self::USER, "email"=>self::EMAIL]]) );
        $this->assertSame( ['nickname'=>self::USER, "email"=>self::EMAIL], $ext->getProperties() );

        $ext = new Zend_OpenId_Extension_Sreg(["nickname"=>false,"email"=>true]);
        $this->assertFalse( $ext->checkTrustData(["Zend_OpenId_Extension_SregX"=>["nickname"=>self::USER, "email"=>self::EMAIL]]) );
    }

    /**
     * testing prepareResponse
     *
     */
    public function testPrepareResponse()
    {
        $ext = new Zend_OpenId_Extension_Sreg();
        $params = [];
        $this->assertTrue( $ext->prepareResponse($params) );
        $this->assertSame( [], $params );

        $ext = new Zend_OpenId_Extension_Sreg(['nickname'=>self::USER, "email"=>self::EMAIL], self::POLICY);
        $params = [];
        $this->assertTrue( $ext->prepareResponse($params) );
        $this->assertSame( ['openid.sreg.nickname'=>self::USER, 'openid.sreg.email'=>self::EMAIL], $params );

        $ext = new Zend_OpenId_Extension_Sreg(['nickname'=>self::USER, "email"=>self::EMAIL], self::POLICY, 1.1);
        $params = [];
        $this->assertTrue( $ext->prepareResponse($params) );
        $this->assertSame( ['openid.ns.sreg'=>"http://openid.net/extensions/sreg/1.1", 'openid.sreg.nickname'=>self::USER, 'openid.sreg.email'=>self::EMAIL], $params );
    }

    /**
     * testing parseResponse
     *
     */
    public function testParseResponse()
    {
        $ext = new Zend_OpenId_Extension_Sreg();

        $this->assertTrue( $ext->parseResponse([]) );
        $this->assertSame( [], $ext->getProperties() );
        $this->assertSame( null, $ext->getPolicyUrl() );
        $this->assertSame( 1.0, $ext->getVersion() );

        $this->assertTrue( $ext->parseResponse(['openid_sreg_nickname'=>self::USER, 'openid_sreg_email'=>self::EMAIL]) );
        $this->assertSame( ['nickname'=>self::USER,'email'=>self::EMAIL], $ext->getProperties() );
        $this->assertSame( null, $ext->getPolicyUrl() );
        $this->assertSame( 1.0, $ext->getVersion() );

        $this->assertTrue( $ext->parseResponse(['openid_sreg_nickname'=>self::USER, 'openid_sreg_email'=>self::EMAIL, 'openid_sreg_policy_url' => self::POLICY]) );
        $this->assertSame( ['nickname'=>self::USER,'email'=>self::EMAIL], $ext->getProperties() );
        $this->assertSame( null, $ext->getPolicyUrl() );
        $this->assertSame( 1.0, $ext->getVersion() );

        $this->assertTrue( $ext->parseResponse(['openid_ns_sreg'=>"http://openid.net/extensions/sreg/1.1",'openid_sreg_nickname'=>self::USER, 'openid_sreg_email'=>self::EMAIL]) );
        $this->assertSame( ['nickname'=>self::USER,'email'=>self::EMAIL], $ext->getProperties() );
        $this->assertSame( null, $ext->getPolicyUrl() );
        $this->assertSame( 1.1, $ext->getVersion() );
    }
}
