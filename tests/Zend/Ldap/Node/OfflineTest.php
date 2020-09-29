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
 * Zend_Ldap_TestCase
 */
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'TestCase.php';
/**
 * Zend_Ldap_Node
 */
require_once 'Zend/Ldap/Node.php';

/**
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Ldap
 * @group      Zend_Ldap_Node
 */
class Zend_Ldap_Node_OfflineTest extends Zend_Ldap_TestCase
{
    protected function _assertLocalDateTimeString($timestamp, $value)
    {
        $this->assertEquals(date('YmdHis\Z', $timestamp), $value);
    }

    protected function _assertUtcDateTimeString($localTimestamp, $value)
    {
        $localOffset = date('Z', $localTimestamp);
        $utcTimestamp = $localTimestamp - $localOffset;
        $this->assertEquals(date('YmdHis', $utcTimestamp) . 'Z', $value);
    }

    public function testCreateFromArrayStringDn()
    {
        $data=$this->_createTestArrayData();
        $node=Zend_Ldap_Node::fromArray($data);
        $this->assertTrue($node instanceof Zend_Ldap_Node);
        $this->assertFalse($node->isAttached());
        $this->assertFalse($node->willBeDeleted());
        $this->assertFalse($node->willBeMoved());
        $this->assertTrue($node->isNew());
    }

    public function testCreateFromArrayObjectDn()
    {
        $data=$this->_createTestArrayData();
        $data['dn']=Zend_Ldap_Dn::fromString($data['dn']);
        $node=Zend_Ldap_Node::fromArray($data);
        $this->assertTrue($node instanceof Zend_Ldap_Node);
        $this->assertFalse($node->isAttached());
    }

    /**
     * @expectedException Zend_Ldap_Exception
     */
    public function testCreateFromArrayMissingDn()
    {
        $data=$this->_createTestArrayData();
        unset($data['dn']);
        $node=Zend_Ldap_Node::fromArray($data);
    }

    /**
     * @expectedException Zend_Ldap_Exception
     */
    public function testCreateFromArrayIllegalDn()
    {
        $data=$this->_createTestArrayData();
        $data['dn']=5;
        $node=Zend_Ldap_Node::fromArray($data);
    }

    /**
     * @expectedException Zend_Ldap_Exception
     */
    public function testCreateFromArrayMalformedDn()
    {
        $data=$this->_createTestArrayData();
        $data['dn']='name1,cn=name2,dc=example,dc=org';
        $node=Zend_Ldap_Node::fromArray($data);
    }

    public function testCreateFromArrayAndEnsureRdnValues()
    {
        $data=$this->_createTestArrayData();
        $data['dn']=Zend_Ldap_Dn::fromString($data['dn']);
        $node=Zend_Ldap_Node::fromArray($data);
        $this->assertTrue($node instanceof Zend_Ldap_Node);
        $this->assertFalse($node->isAttached());
        unset($data['dn']);
        $this->assertEquals($data, $node->getData());
    }

    public function testGetDnString()
    {
        $data=$this->_createTestArrayData();
        $node=Zend_Ldap_Node::fromArray($data);
        $this->assertEquals($data['dn'], $node->getDnString());
    }

    public function testGetDnArray()
    {
        $data=$this->_createTestArrayData();
        $node=Zend_Ldap_Node::fromArray($data);
        $exA=Zend_Ldap_Dn::explodeDn($data['dn']);
        $this->assertEquals($exA, $node->getDnArray());
    }

    public function testGetDnObject()
    {
        $data=$this->_createTestArrayData();
        $node=Zend_Ldap_Node::fromArray($data);
        $compareDn=Zend_Ldap_Dn::fromString('cn=name,dc=example,dc=org');
        $this->assertEquals($compareDn, $node->getDn());
        $this->assertNotSame($node->getDn(), $node->getDn());
    }

    public function testGetRdnString()
    {
        $node=$this->_createTestNode();
        $this->assertEquals('cn=name', $node->getRdnString());
    }

    public function testGetRdnArray()
    {
        $node=$this->_createTestNode();
        $this->assertEquals(['cn' => 'name'], $node->getRdnArray());
    }

    public function testSerialize()
    {
        $node=$this->_createTestNode();
        $sdata=serialize($node);
        $newObject=unserialize($sdata);
        $this->assertEquals($node, $newObject);
    }

    public function testToString()
    {
        $node=$this->_createTestNode();
        $this->assertEquals('cn=name,dc=example,dc=org', $node->toString());
        $this->assertEquals('cn=name,dc=example,dc=org', (string)$node);
    }

    public function testToArray()
    {
        $node=$this->_createTestNode();
        $this->assertEquals([
            'dn'          => 'cn=name,dc=example,dc=org',
            'cn'          => ['name'],
            'host'        => ['a', 'b', 'c'],
            'empty'       => [],
            'boolean'     => [true, false],
            'objectclass' => ['account', 'top'],
        ], $node->toArray());
    }

    public function testToJson()
    {
        $node=$this->_createTestNode();
        $this->assertEquals('{"dn":"cn=name,dc=example,dc=org",' .
            '"boolean":[true,false],' .
            '"cn":["name"],' .
            '"empty":[],' .
            '"host":["a","b","c"],' .
            '"objectclass":["account","top"]}', $node->toJson());
    }

    public function testGetData()
    {
        $data=$this->_createTestArrayData();
        $node=Zend_Ldap_Node::fromArray($data);
        ksort($data, SORT_STRING);
        unset($data['dn']);
        $this->assertEquals($data, $node->getData());
    }

    public function testGetObjectClass()
    {
        $node=$this->_createTestNode();
        $this->assertEquals(['account', 'top'], $node->getObjectClass());
    }

    public function testModifyObjectClass()
    {
        $node=$this->_createTestNode();
        $this->assertEquals(['account', 'top'], $node->getObjectClass());

        $node->setObjectClass('domain');
        $this->assertEquals(['domain'], $node->getObjectClass());

        $node->setObjectClass(['account', 'top']);
        $this->assertEquals(['account', 'top'], $node->getObjectClass());

        $node->appendObjectClass('domain');
        $this->assertEquals(['account', 'top', 'domain'], $node->getObjectClass());

        $node->setObjectClass('domain');
        $node->appendObjectClass(['account', 'top']);
        $this->assertEquals(['domain', 'account', 'top'], $node->getObjectClass());
    }

    public function testGetAttributes()
    {
        $node=$this->_createTestNode();
        $expected=[
            'boolean'     => [true, false],
            'cn'          => ['name'],
            'empty'       => [],
            'host'        => ['a', 'b', 'c'],
            'objectclass' => ['account', 'top'],
        ];
        $this->assertEquals($expected, $node->getAttributes());
        $this->assertFalse($node->willBeDeleted());
        $this->assertFalse($node->willBeMoved());
        $this->assertFalse($node->isNew());

        $node->delete();
        $this->assertTrue($node->willBeDeleted());
    }

    public function testAppendToAttributeFirstTime()
    {
        $node=$this->_createTestNode();
        $node->appendToAttribute('host', 'newHost');
        $ts=mktime(12, 30, 30, 6, 25, 2008);
        $node->appendToDateTimeAttribute('objectClass', $ts);
        $this->assertEquals('newHost', $node->host[3]);
        $this->assertEquals($ts, $node->getDateTimeAttribute('objectClass', 2));
    }

    public function testExistsAttribute()
    {
        $node=$this->_createTestNode();
        $this->assertFalse($node->existsAttribute('nonExistant'));
        $this->assertFalse($node->existsAttribute('empty', false));
        $this->assertTrue($node->existsAttribute('empty', true));

        $node->newEmpty=null;
        $this->assertFalse($node->existsAttribute('newEmpty', false));
        $this->assertTrue($node->existsAttribute('newEmpty', true));

        $node->empty='string';
        $this->assertTrue($node->existsAttribute('empty', false));
        $this->assertTrue($node->existsAttribute('empty', true));

        $node->deleteAttribute('empty');
        $this->assertFalse($node->existsAttribute('empty', false));
        $this->assertTrue($node->existsAttribute('empty', true));
    }

    public function testGetSetAndDeleteMethods()
    {
        $timezone = date_default_timezone_get();
        date_default_timezone_set('GMT');

        $node=$this->_createTestNode();

        $node->setAttribute('key', 'value1');
        $this->assertEquals('value1', $node->getAttribute('key', 0));
        $node->appendToAttribute('key', 'value2');
        $this->assertEquals('value1', $node->getAttribute('key', 0));
        $this->assertEquals('value2', $node->getAttribute('key', 1));
        $this->assertTrue($node->existsAttribute('key', true));
        $this->assertTrue($node->existsAttribute('key', false));
        $node->deleteAttribute('key');
        $this->assertEquals(0, count($node->getAttribute('key')));
        $this->assertTrue($node->existsAttribute('key', true));
        $this->assertFalse($node->existsAttribute('key', false));

        $ts=mktime(12, 30, 30, 6, 25, 2008);
        $node->setDateTimeAttribute('key', $ts, false);
        $this->_assertLocalDateTimeString($ts, $node->getAttribute('key', 0));
        $this->assertEquals($ts, $node->getDateTimeAttribute('key', 0));
        $node->appendToDateTimeAttribute('key', $ts, true);
        $this->_assertLocalDateTimeString($ts, $node->getAttribute('key', 0));
        $this->assertEquals($ts, $node->getDateTimeAttribute('key', 0));
        $this->_assertUtcDateTimeString($ts, $node->getAttribute('key', 1));
        $this->assertEquals($ts, $node->getDateTimeAttribute('key', 1));
        $this->assertTrue($node->existsAttribute('key', true));
        $this->assertTrue($node->existsAttribute('key', false));
        $node->deleteAttribute('key');
        $this->assertEquals(0, count($node->getAttribute('key')));
        $this->assertTrue($node->existsAttribute('key', true));
        $this->assertFalse($node->existsAttribute('key', false));

        $node->setPasswordAttribute('pa$$w0rd', Zend_Ldap_Attribute::PASSWORD_HASH_MD5);
        $this->assertEquals('{MD5}bJuLJ96h3bhF+WqiVnxnVA==', $node->getAttribute('userPassword', 0));
        $this->assertTrue($node->existsAttribute('userPassword', true));
        $this->assertTrue($node->existsAttribute('userPassword', false));
        $node->deleteAttribute('userPassword');
        $this->assertEquals(0, count($node->getAttribute('userPassword')));
        $this->assertTrue($node->existsAttribute('userPassword', true));
        $this->assertFalse($node->existsAttribute('userPassword', false));

        date_default_timezone_set($timezone);
    }

    public function testOverloading()
    {
        $node=$this->_createTestNode();

        $node->key='value1';
        $this->assertEquals('value1', $node->key[0]);
        $this->assertTrue(isset($node->key));
        unset($node->key);
        $this->assertEquals(0, count($node->key));
        $this->assertFalse(isset($node->key));
    }

    /**
     * @expectedException Zend_Ldap_Exception
     */
    public function testIllegalAttributeAccessRdnAttributeSet()
    {
        $node=$this->_createTestNode();
        $node->cn='test';
    }

    /**
     * @expectedException Zend_Ldap_Exception
     */
    public function testIllegalAttributeAccessDnSet()
    {
        $node=$this->_createTestNode();
        $node->dn='test';
    }

    public function testAttributeAccessDnGet()
    {
        $node=$this->_createTestNode();
        $this->assertTrue(is_string($node->dn));
        $this->assertEquals($node->getDn()->toString(), $node->dn);
    }

    public function testArrayAccess()
    {
        $node=$this->_createTestNode();

        $node['key']='value1';
        $this->assertEquals('value1', $node['key'][0]);
        $this->assertTrue(isset($node['key']));
        unset($node['key']);
        $this->assertEquals(0, count($node['key']));
        $this->assertFalse(isset($node['key']));
    }

    public function testCreateEmptyNode()
    {
        $dn='cn=name,dc=example,dc=org';
        $objectClass=['account', 'test', 'inetOrgPerson'];
        $node=Zend_Ldap_Node::create($dn, $objectClass);
        $this->assertEquals($dn, $node->getDnString());
        $this->assertEquals('cn=name', $node->getRdnString());
        $this->assertEquals('name', $node->cn[0]);
        $this->assertEquals($objectClass, $node->objectClass);
        $this->assertFalse($node->willBeDeleted());
        $this->assertFalse($node->willBeMoved());
        $this->assertTrue($node->isNew());

        $node->delete();
        $this->assertTrue($node->willBeDeleted());
    }

    public function testGetChangedData()
    {
        $node=$this->_createTestNode();
        $node->host=['d'];
        $node->empty='not Empty';
        unset($node->objectClass);
        $changedData=$node->getChangedData();
        $this->assertEquals(['d'], $changedData['host']);
        $this->assertEquals(['not Empty'], $changedData['empty']);
        $this->assertEquals([], $changedData['objectclass']);
    }

    public function testDeleteUnusedAttribute()
    {
        $node=$this->_createTestNode();
        $node->deleteAttribute('nonexistant');
        $changedData=$node->getChangedData();
        $this->assertArrayNotHasKey('nonexistant', $changedData);
    }

    public function testRenameNodeString()
    {
        $data=$this->_createTestArrayData();
        $node=Zend_Ldap_Node::fromArray($data);

        $newDnString='cn=test+ou=Lab+uid=tester,cn=name,dc=example,dc=org';
        $node->setDn($newDnString);
        $this->assertEquals($data['dn'], $node->getCurrentDn()->toString());
        $this->assertEquals($newDnString, $node->getDn()->toString());
        $this->assertEquals(['test'], $node->cn);
        $this->assertEquals(['tester'], $node->uid);
        $this->assertEquals(['Lab'], $node->ou);

        $this->assertFalse($node->willBeDeleted());
        $this->assertFalse($node->willBeMoved());
        $this->assertTrue($node->isNew());
    }

    public function testRenameNodeArray()
    {
        $data=$this->_createTestArrayData();
        $node=Zend_Ldap_Node::fromArray($data);

        $newDnArray=[
            ['uid' => 'tester'],
            ['dc' => 'example'],
            ['dc' => 'org']];

        $node->setDn($newDnArray);
        $this->assertEquals($data['dn'], $node->getCurrentDn()->toString());
        $this->assertEquals($newDnArray, $node->getDn()->toArray());
        $this->assertEquals(['name'], $node->cn);
    }

    public function testRenameNodeDnObject()
    {
        $data=$this->_createTestArrayData();
        $node=Zend_Ldap_Node::fromArray($data);

        $newDn=Zend_Ldap_Dn::fromString('cn=test+ou=Lab+uid=tester,cn=name,dc=example,dc=org');
        $node->setDn($newDn);
        $this->assertEquals($data['dn'], $node->getCurrentDn()->toString());
        $this->assertEquals($newDn, $node->getDn());
        $this->assertEquals(['test'], $node->cn);
        $this->assertEquals(['tester'], $node->uid);
        $this->assertEquals(['Lab'], $node->ou);
    }

    public function testRenameNodeFromDataSource()
    {
        $node=$this->_createTestNode();
        $newDnString='cn=test+ou=Lab+uid=tester,cn=name,dc=example,dc=org';
        $node->rename($newDnString);

        $this->assertFalse($node->willBeDeleted());
        $this->assertTrue($node->willBeMoved());
        $this->assertFalse($node->isNew());
    }

    public function testDnObjectCloning()
    {
        $node1=$this->_createTestNode();
        $dn1=Zend_Ldap_Dn::fromString('cn=name2,dc=example,dc=org');
        $node1->setDn($dn1);
        $dn1->prepend(['cn' => 'name']);
        $this->assertNotEquals($dn1->toString(), $node1->getDn()->toString());

        $dn2=Zend_Ldap_Dn::fromString('cn=name2,dc=example,dc=org');
        $node2=Zend_Ldap_Node::create($dn2);
        $dn2->prepend(['cn' => 'name']);
        $this->assertNotEquals($dn2->toString(), $node2->getDn()->toString());

        $dn3=Zend_Ldap_Dn::fromString('cn=name2,dc=example,dc=org');
        $node3=Zend_Ldap_Node::fromArray([
            'dn' => $dn3,
            'ou' => 'Test'], false);
        $dn3->prepend(['cn' => 'name']);
        $this->assertNotEquals($dn3->toString(), $node3->getDn()->toString());
    }

    public function testGetChanges()
    {
        $node=$this->_createTestNode();
        $node->host=['d'];
        $node->empty='not Empty';
        unset($node->boolean);
        $changes=$node->getChanges();
        $this->assertEquals([
            'add'     => [
                'empty' => ['not Empty']
            ],
            'delete'  => [
                'boolean' => []
            ],
            'replace' => [
                'host' => ['d']
            ]
        ], $changes);

        $node=Zend_Ldap_Node::create('uid=test,dc=example,dc=org', ['account']);
        $node->host='host';
        unset($node->cn);
        unset($node['sn']);
        $node['givenName']='givenName';
        $node->appendToAttribute('objectClass', 'domain');
        $this->assertEquals([
            'uid' => ['test'],
            'objectclass' => ['account', 'domain'],
            'host' => ['host'],
            'givenname' => ['givenName']
        ], $node->getChangedData());
        $this->assertEquals([
            'add'     => [
                'uid' => ['test'],
                'objectclass' => ['account', 'domain'],
                'host' => ['host'],
                'givenname' => ['givenName'],
            ],
            'delete'  => [],
            'replace' => []
        ], $node->getChanges());
    }

    public function testHasValue()
    {
        $node=$this->_createTestNode();

        $this->assertTrue($node->attributeHasValue('cn', 'name'));
        $this->assertFalse($node->attributeHasValue('cn', 'noname'));
        $this->assertTrue($node->attributeHasValue('boolean', true));
        $this->assertTrue($node->attributeHasValue('boolean', false));

        $this->assertTrue($node->attributeHasValue('host', ['a', 'b']));
        $this->assertTrue($node->attributeHasValue('host', ['a', 'b', 'c']));
        $this->assertFalse($node->attributeHasValue('host', ['a', 'b', 'c', 'd']));
        $this->assertTrue($node->attributeHasValue('boolean', [true, false]));
    }

    public function testRemoveDuplicates()
    {
        $node=$this->_createTestNode();
        $node->strings1= ['value1', 'value2', 'value2', 'value3'];
        $node->strings2= ['value1', 'value2', 'value3', 'value4'];
        $node->boolean1= [true, true, true, true];
        $node->boolean2= [true, false, true, false];

        $expected=[
            'cn'          => ['name'],
            'host'        => ['a', 'b', 'c'],
            'empty'       => [],
            'boolean'     => ['TRUE', 'FALSE'],
            'objectclass' => ['account', 'top'],
            'strings1' => ['value1', 'value2', 'value3'],
            'strings2' => ['value1', 'value2', 'value3', 'value4'],
            'boolean1' => ['TRUE'],
            'boolean2' => ['TRUE', 'FALSE'],
        ];

        $node->removeDuplicatesFromAttribute('strings1');
        $node->removeDuplicatesFromAttribute('strings2');
        $node->removeDuplicatesFromAttribute('boolean1');
        $node->removeDuplicatesFromAttribute('boolean2');
        $this->assertEquals($expected, $node->getData(false));
    }

    public function testRemoveFromAttributeSimple()
    {
        $node=$this->_createTestNode();
        $node->test=['value1', 'value2', 'value3', 'value3'];
        $node->removeFromAttribute('test', 'value2');
        $this->assertEquals(['value1', 'value3', 'value3'], $node->test);
    }

    public function testRemoveFromAttributeArray()
    {
        $node=$this->_createTestNode();
        $node->test=['value1', 'value2', 'value3', 'value3'];
        $node->removeFromAttribute('test', ['value1', 'value2']);
        $this->assertEquals(['value3', 'value3'], $node->test);
    }

    public function testRemoveFromAttributeMultipleSimple()
    {
        $node=$this->_createTestNode();
        $node->test=['value1', 'value2', 'value3', 'value3'];
        $node->removeFromAttribute('test', 'value3');
        $this->assertEquals(['value1', 'value2'], $node->test);
    }

    public function testRemoveFromAttributeMultipleArray()
    {
        $node=$this->_createTestNode();
        $node->test=['value1', 'value2', 'value3', 'value3'];
        $node->removeFromAttribute('test', ['value1', 'value3']);
        $this->assertEquals(['value2'], $node->test);
    }

    /**
     * ZF-11611
     */
    public function testRdnAttributesHandleMultiValuedAttribute()
    {
        $data = [
        	'dn' => 'cn=funkygroup,ou=Groupes,dc=domain,dc=local',
        	'objectClass' => [
        		'groupOfNames',
        		'top',
        	],
        	'cn' => [
        		'The Funkygroup',
        		'funkygroup',
        	],
        	'member' => 'uid=john-doe,ou=Users,dc=domain,dc=local',
        ];

        $node = Zend_Ldap_Node::fromArray($data, true);
        $changedData = $node->getChangedData();
        $this->assertTrue(empty($changedData));
    }

	/**
     * ZF-11611
     */
    public function testRdnAttributesHandleMultiValuedAttribute2()
    {
        $data = [
        	'dn' => 'cn=funkygroup,ou=Groupes,dc=domain,dc=local',
        	'objectClass' => [
        		'groupOfNames',
        		'top',
        	],
        	'member' => 'uid=john-doe,ou=Users,dc=domain,dc=local',
        ];

        $node = Zend_Ldap_Node::fromArray($data, true);
        $cn = $node->getAttribute('cn');
        $this->assertEquals([
            0 => 'funkygroup'
        ], $cn);
    }

	/**
     * ZF-11611
     */
    public function testRdnAttributesHandleMultiValuedAttribute3()
    {
        $data = [
        	'dn' => 'cn=funkygroup,ou=Groupes,dc=domain,dc=local',
        	'objectClass' => [
        		'groupOfNames',
        		'top',
        	],
        	'cn' => [
        	    0 => 'The Funkygroup'
        	],
        	'member' => 'uid=john-doe,ou=Users,dc=domain,dc=local',
        ];

        $node = Zend_Ldap_Node::fromArray($data, true);
        $cn = $node->getAttribute('cn');
        $this->assertEquals([
           0 => 'The Funkygroup',
           1 => 'funkygroup',
        ], $cn);
    }
}
