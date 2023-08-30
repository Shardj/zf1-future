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
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Ldap
 */
class Zend_Ldap_SortTest extends Zend_Ldap_OnlineTestCase
{
    protected function set_up()
    {
        parent::set_up();
        $this->_prepareLdapServer();
    }

    protected function tear_down()
    {
        $this->_cleanupLdapServer();
        parent::tear_down();
    }

    /**
     * Test whether a callable is set correctly
     */
    public function testSettingCallable()
    {
        $search = ldap_search(
            $this->_getLdap()->getResource(),
            TESTS_ZEND_LDAP_WRITEABLE_SUBTREE,
            '(l=*)',
            array('l')
        );

        $iterator     = new Zend_Ldap_Collection_Iterator_Default($this->_getLdap(), $search);
        $sortFunction = function($a, $b) { return 1; };

        $reflectionObject   = new ReflectionObject($iterator);
        $reflectionProperty = $reflectionObject->getProperty('_sortFunction');
        $reflectionProperty->setAccessible(true);
        $this->assertEquals('strnatcasecmp', $reflectionProperty->getValue($iterator));
        $iterator->setSortFunction($sortFunction);
        $this->assertEquals($sortFunction, $reflectionProperty->getValue($iterator));
    }

    /**
     * Test whether sorting works as expected out of the box
     */
    public function testSorting()
    {
        $lSorted = array('a', 'b', 'c', 'd', 'e');

        $search = ldap_search(
            $this->_getLdap()->getResource(),
            TESTS_ZEND_LDAP_WRITEABLE_SUBTREE,
            '(l=*)',
            array('l')
        );

        $iterator = new Zend_Ldap_Collection_Iterator_Default($this->_getLdap(), $search);

        $reflectionObject   = new ReflectionObject($iterator);
        $reflectionProperty = $reflectionObject->getProperty('_sortFunction');
        $reflectionProperty->setAccessible(true);
        $this->assertEquals('strnatcasecmp', $reflectionProperty->getValue($iterator));

        $reflectionProperty = $reflectionObject->getProperty('_entries');
        $reflectionProperty->setAccessible(true);

        $iterator->sort('l');

        $reflectionEntries = $reflectionProperty->getValue($iterator);
        foreach ($lSorted as $index => $value) {
            $this->assertEquals($value, $reflectionEntries[$index]['sortValue']);
        }
    }

    /**
     * Test sorting with custom sort-function
     */
    public function testCustomSorting()
    {
        $lSorted = array('d', 'e', 'a', 'b', 'c');

        $search = ldap_search(
            $this->_getLdap()->getResource(),
            TESTS_ZEND_LDAP_WRITEABLE_SUBTREE,
            '(l=*)',
            array('l')
        );

        $iterator     = new Zend_Ldap_Collection_Iterator_Default($this->_getLdap(), $search);
        $sortFunction = function ($a, $b) {
            // Sort values by the number of "1" in their binary representation
            // and when that is equals by their position in the alphabet.
            $f = strlen(str_replace('0', '', decbin(bin2hex($a)))) -
                 strlen(str_replace('0', '', decbin(bin2hex($b))));
            if ($f < 0) {
                return -1;
            } elseif ($f > 0) {
                return 1;
            }
            return strnatcasecmp($a, $b);
        };
        $iterator->setSortFunction($sortFunction);

        $reflectionObject   = new ReflectionObject($iterator);
        $reflectionProperty = $reflectionObject->getProperty('_sortFunction');
        $reflectionProperty->setAccessible(true);
        $this->assertEquals($sortFunction, $reflectionProperty->getValue($iterator));

        $reflectionProperty = $reflectionObject->getProperty('_entries');
        $reflectionProperty->setAccessible(true);

        $iterator->sort('l');

        $reflectionEntries = $reflectionProperty->getValue($iterator);
        foreach ($lSorted as $index => $value) {
            $this->assertEquals($value, $reflectionEntries[$index]['sortValue']);
        }
    }
}
