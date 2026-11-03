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
 * @package    Zend_Ldap
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Ldap_Dn_AllTests::main');
}

require_once 'Zend/Ldap/Dn/EscapingTest.php';
require_once 'Zend/Ldap/Dn/ExplodingTest.php';
require_once 'Zend/Ldap/Dn/ImplodingTest.php';
require_once 'Zend/Ldap/Dn/CreationTest.php';
require_once 'Zend/Ldap/Dn/ModificationTest.php';
require_once 'Zend/Ldap/Dn/MiscTest.php';

/**
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Ldap
 * @group      Zend_Ldap_Dn
 */
class Zend_Ldap_Dn_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_Ldap_Dn');

        $suite->addTestSuite('Zend_Ldap_Dn_EscapingTest');
        $suite->addTestSuite('Zend_Ldap_Dn_ExplodingTest');
        $suite->addTestSuite('Zend_Ldap_Dn_ImplodingTest');
        $suite->addTestSuite('Zend_Ldap_Dn_CreationTest');
        $suite->addTestSuite('Zend_Ldap_Dn_ModificationTest');
        $suite->addTestSuite('Zend_Ldap_Dn_MiscTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Ldap_Dn_AllTests::main') {
    Zend_Ldap_Dn_AllTests::main();
}
