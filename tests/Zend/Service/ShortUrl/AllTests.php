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
 * @package    Zend_Service
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: $
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Service_ShortUrl_AllTests::main');
}

/**
 * @see Zend_Service_ShortUrl_IsGdTest
 */
require_once 'Zend/Service/ShortUrl/IsGdTest.php';

/**
 * @see Zend_Service_ShortUrl_JdemCzTest
 */
require_once 'Zend/Service/ShortUrl/JdemCzTest.php';

/**
 * @see Zend_Service_ShortUrl_MetamarkNetTest
 */
require_once 'Zend/Service/ShortUrl/MetamarkNetTest.php';

/**
 * @see Zend_Service_ShortUrl_TinyUrlComTest
 */
require_once 'Zend/Service/ShortUrl/TinyUrlComTest.php';

/**
 * @see Zend_Service_ShortUrl_BitLyTest
 */
require_once 'Zend/Service/ShortUrl/BitLyTest.php';

/**
 * @category   Zend
 * @package    Zend_Service_ShortUrl
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Service
 */
class Zend_Service_ShortUrl_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_Service_ShortUrl');

        $suite->addTestSuite('Zend_Service_ShortUrl_IsGdTest');
        $suite->addTestSuite('Zend_Service_ShortUrl_JdemCzTest');
        $suite->addTestSuite('Zend_Service_ShortUrl_MetamarkNetTest');
        $suite->addTestSuite('Zend_Service_ShortUrl_TinyUrlComTest');
        $suite->addTestSuite('Zend_Service_ShortUrl_BitLyTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Service_ShortUrl_AllTests::main') {
    Zend_Service_ShortUrl_AllTests::main();
}
