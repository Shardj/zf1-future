<?php

declare(strict_types=1);

use Yoast\PHPUnitPolyfills\TestCases\TestCase;
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
 * @package    Zend_Loader
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id $
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Loader_LoaderTest::main');
}

/**
 * @package    Zend_Loader
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Loader
 */
class Zend_Loader_LoaderTest extends TestCase
{
    public static function main()
    {
        $suite = new TestSuite(__CLASS__);
        $result = (new resources_Runner())->run($suite);
    }

    public function testLoadTraitDoesNotThrowException()
    {
        $traitName = 'Zend_Loader_TestAsset_TestTrait';

        $this->assertFalse(trait_exists($traitName, false));

        Zend_Loader::loadClass($traitName);

        $this->assertTrue(trait_exists($traitName, false));
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Loader_LoaderTest::main') {
    Zend_Loader_LoaderTest::main();
}
