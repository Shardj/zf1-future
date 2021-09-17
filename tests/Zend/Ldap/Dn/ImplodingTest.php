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
 * @package    Zend_Ldap
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_Ldap_Dn
 */
require_once 'Zend/Ldap/Dn.php';

/**
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Ldap
 * @group      Zend_Ldap_Dn
 */
class Zend_Ldap_Dn_ImplodingTest extends PHPUnit_Framework_TestCase
{
    public function testDnWithMultiValuedRdnRoundTrip()
    {
        $dn1='cn=Surname\, Firstname+uid=userid,cn=name2,dc=example,dc=org';
        $dnArray=Zend_Ldap_Dn::explodeDn($dn1);
        $dn2=Zend_Ldap_Dn::implodeDn($dnArray);
        $this->assertEquals($dn1, $dn2);
    }

    public function testImplodeDn()
    {
        $expected='cn=name1,cn=name2,dc=example,dc=org';
        $dnArray=[
            ["cn" => "name1"],
            ["cn" => "name2"],
            ["dc" => "example"],
            ["dc" => "org"]
        ];
        $dn=Zend_Ldap_Dn::implodeDn($dnArray);
        $this->assertEquals($expected, $dn);

        $dn=Zend_Ldap_Dn::implodeDn($dnArray, Zend_Ldap_Dn::ATTR_CASEFOLD_UPPER, ';');
        $this->assertEquals('CN=name1;CN=name2;DC=example;DC=org', $dn);
    }

    public function testImplodeDnWithUtf8Characters()
    {
        $expected='uid=rogasawara,ou=営業部,o=Airius';
        $dnArray=[
            ["uid" => "rogasawara"],
            ["ou" => "営業部"],
            ["o" => "Airius"],
        ];
        $dn=Zend_Ldap_Dn::implodeDn($dnArray);
        $this->assertEquals($expected, $dn);
    }

    public function testImplodeRdn()
    {
        $a=['cn' => 'value'];
        $expected='cn=value';
        $this->assertEquals($expected, Zend_Ldap_Dn::implodeRdn($a));
    }

    public function testImplodeRdnMultiValuedRdn()
    {
        $a=['cn' => 'value', 'uid' => 'testUser'];
        $expected='cn=value+uid=testUser';
        $this->assertEquals($expected, Zend_Ldap_Dn::implodeRdn($a));
    }

    public function testImplodeRdnMultiValuedRdn2()
    {
        $a=['cn' => 'value', 'uid' => 'testUser', 'ou' => 'myDep'];
        $expected='cn=value+ou=myDep+uid=testUser';
        $this->assertEquals($expected, Zend_Ldap_Dn::implodeRdn($a));
    }

    public function testImplodeRdnCaseFold()
    {
        $a=['cn' => 'value'];
        $expected='CN=value';
        $this->assertEquals($expected,
            Zend_Ldap_Dn::implodeRdn($a, Zend_Ldap_Dn::ATTR_CASEFOLD_UPPER));
        $a=['CN' => 'value'];
        $expected='cn=value';
        $this->assertEquals($expected,
            Zend_Ldap_Dn::implodeRdn($a, Zend_Ldap_Dn::ATTR_CASEFOLD_LOWER));
    }

    public function testImplodeRdnMultiValuedRdnCaseFold()
    {
        $a=['cn' => 'value', 'uid' => 'testUser', 'ou' => 'myDep'];
        $expected='CN=value+OU=myDep+UID=testUser';
        $this->assertEquals($expected,
            Zend_Ldap_Dn::implodeRdn($a, Zend_Ldap_Dn::ATTR_CASEFOLD_UPPER));
        $a=['CN' => 'value', 'uID' => 'testUser', 'ou' => 'myDep'];
        $expected='cn=value+ou=myDep+uid=testUser';
        $this->assertEquals($expected,
            Zend_Ldap_Dn::implodeRdn($a, Zend_Ldap_Dn::ATTR_CASEFOLD_LOWER));
    }

    /**
     * @expectedException Zend_Ldap_Exception
     */
    public function testImplodeRdnInvalidOne()
    {
        $a=['cn'];
        Zend_Ldap_Dn::implodeRdn($a);
    }

    /**
     * @expectedException Zend_Ldap_Exception
     */
    public function testImplodeRdnInvalidThree()
    {
        $a=['cn' => 'value', 'ou'];
        Zend_Ldap_Dn::implodeRdn($a);
    }
}
