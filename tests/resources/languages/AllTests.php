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
 * @package    Zend
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'resources_languages_AllTests::main');
}

require_once dirname(__FILE__) . '/Zend_ValidateTest.php';

/**
 * @category   Zend
 * @package    Zend_recource
 * @subpackage UnitTests
 * @group      Zend
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class resources_languages_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    /**
     * Regular suite
     *
     * All tests except those that require output buffering.
     *
     * @return TestSuite
     */
    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - resources - languages');

        $suite->addTestSuite('resources_languages_Zend_ValidateTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'resources_languages_AllTests::main') {
    resources_languages_AllTests::main();
}
