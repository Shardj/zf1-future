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
 * Zend_Ldap_OnlineTestCase
 */
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'OnlineTestCase.php';

/**
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Ldap
 * @group      Zend_Ldap_Node
 */
class Zend_Ldap_Node_RootDseTest extends Zend_Ldap_OnlineTestCase
{
    public function testLoadRootDseNode()
    {
        $root1=$this->_getLdap()->getRootDse();
        $root2=$this->_getLdap()->getRootDse();

        $this->assertEquals($root1, $root2);
        $this->assertSame($root1, $root2);
    }

    public function testSupportCheckMethods()
    {
        $root=$this->_getLdap()->getRootDse();

        $this->assertTrue(is_bool($root->supportsSaslMechanism('GSSAPI')));
        $this->assertTrue(is_bool($root->supportsSaslMechanism(['GSSAPI', 'DIGEST-MD5'])));
        $this->assertTrue(is_bool($root->supportsVersion('3')));
        $this->assertTrue(is_bool($root->supportsVersion(3)));
        $this->assertTrue(is_bool($root->supportsVersion(['3', '2'])));
        $this->assertTrue(is_bool($root->supportsVersion([3, 2])));

        switch ($root->getServerType()) {
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_ACTIVEDIRECTORY:
                $this->assertTrue(is_bool($root->supportsControl('1.2.840.113556.1.4.319')));
                $this->assertTrue(is_bool($root->supportsControl(['1.2.840.113556.1.4.319',
                    '1.2.840.113556.1.4.473'])));
                $this->assertTrue(is_bool($root->supportsCapability('1.3.6.1.4.1.4203.1.9.1.1')));
                $this->assertTrue(is_bool($root->supportsCapability(['1.3.6.1.4.1.4203.1.9.1.1',
                    '2.16.840.1.113730.3.4.18'])));
                $this->assertTrue(is_bool($root->supportsPolicy('unknown')));
                $this->assertTrue(is_bool($root->supportsPolicy(['unknown', 'unknown'])));
                break;
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_EDIRECTORY:
                $this->assertTrue(is_bool($root->supportsExtension('1.3.6.1.4.1.1466.20037')));
                $this->assertTrue(is_bool($root->supportsExtension(['1.3.6.1.4.1.1466.20037',
                    '1.3.6.1.4.1.4203.1.11.1'])));
                break;
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_OPENLDAP:
                $this->assertTrue(is_bool($root->supportsControl('1.3.6.1.4.1.4203.1.9.1.1')));
                $this->assertTrue(is_bool($root->supportsControl(['1.3.6.1.4.1.4203.1.9.1.1',
                    '2.16.840.1.113730.3.4.18'])));
                $this->assertTrue(is_bool($root->supportsExtension('1.3.6.1.4.1.1466.20037')));
                $this->assertTrue(is_bool($root->supportsExtension(['1.3.6.1.4.1.1466.20037',
                    '1.3.6.1.4.1.4203.1.11.1'])));
                $this->assertTrue(is_bool($root->supportsFeature('1.3.6.1.1.14')));
                $this->assertTrue(is_bool($root->supportsFeature(['1.3.6.1.1.14',
                    '1.3.6.1.4.1.4203.1.5.1'])));
                break;
        }
    }

    public function testGetters()
    {
        $root=$this->_getLdap()->getRootDse();

        $this->assertTrue(is_array($root->getNamingContexts()));
        $this->assertTrue(is_array($root->getSubschemaSubentry()));

        switch ($root->getServerType()) {
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_ACTIVEDIRECTORY:
                $this->assertTrue(is_string($root->getConfigurationNamingContext()));
                $this->assertTrue(is_string($root->getCurrentTime()));
                $this->assertTrue(is_string($root->getDefaultNamingContext()));
                $this->assertTrue(is_string($root->getDnsHostName()));
                $this->assertTrue(is_string($root->getDomainControllerFunctionality()));
                $this->assertTrue(is_string($root->getDomainFunctionality()));
                $this->assertTrue(is_string($root->getDsServiceName()));
                $this->assertTrue(is_string($root->getForestFunctionality()));
                $this->assertTrue(is_string($root->getHighestCommittedUSN()));
                $this->assertTrue(is_bool($root->getIsGlobalCatalogReady()));
                $this->assertTrue(is_bool($root->getIsSynchronized()));
                $this->assertTrue(is_string($root->getLdapServiceName()));
                $this->assertTrue(is_string($root->getRootDomainNamingContext()));
                $this->assertTrue(is_string($root->getSchemaNamingContext()));
                $this->assertTrue(is_string($root->getServerName()));
                break;
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_EDIRECTORY:
                $this->assertTrue(is_string($root->getVendorName()));
                $this->assertTrue(is_string($root->getVendorVersion()));
                $this->assertTrue(is_string($root->getDsaName()));
                $this->assertTrue(is_string($root->getStatisticsErrors()));
                $this->assertTrue(is_string($root->getStatisticsSecurityErrors()));
                $this->assertTrue(is_string($root->getStatisticsChainings()));
                $this->assertTrue(is_string($root->getStatisticsReferralsReturned()));
                $this->assertTrue(is_string($root->getStatisticsExtendedOps()));
                $this->assertTrue(is_string($root->getStatisticsAbandonOps()));
                $this->assertTrue(is_string($root->getStatisticsWholeSubtreeSearchOps()));
                break;
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_OPENLDAP:
                $this->_assertNullOrString($root->getConfigContext());
                $this->_assertNullOrString($root->getMonitorContext());
                break;
        }
    }

    protected function _assertNullOrString($value)
    {
        if ($value===null) {
            $this->assertNull($value);
        } else {
            $this->assertTrue(is_string($value));
        }
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetterWillThrowException()
    {
          $root=$this->_getLdap()->getRootDse();
          $root->objectClass='illegal';
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testOffsetSetWillThrowException()
    {
          $root=$this->_getLdap()->getRootDse();
          $root['objectClass']='illegal';
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testUnsetterWillThrowException()
    {
          $root=$this->_getLdap()->getRootDse();
          unset($root->objectClass);
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testOffsetUnsetWillThrowException()
    {
          $root=$this->_getLdap()->getRootDse();
          unset($root['objectClass']);
    }
}
