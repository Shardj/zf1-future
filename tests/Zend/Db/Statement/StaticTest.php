<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

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
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id $
 */
/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Db
 * @group      Zend_Db_Statement
 */
class Zend_Db_Statement_StaticTest extends TestCase
{
    public function testStatic()
    {
        $this->assertTrue(true);
    }

    /**
     * Zend_Db mirrors the values the PDO::FETCH_* flags had up to PHP 8.4;
     * PHP 8.5 changed FETCH_GROUP, FETCH_UNIQUE, FETCH_CLASSTYPE and
     * FETCH_SERIALIZE, so Zend_Db_Statement_Pdo translates them.
     *
     * @requires extension pdo
     */
    public function testPdoFetchModeTranslatesTheZendDbFlags()
    {
        // the values of PHP 8.5
        $php85 = [
            Zend_Db::FETCH_UNIQUE    => 64,
            Zend_Db::FETCH_GROUP     => 32,
            Zend_Db::FETCH_CLASSTYPE => 128,
            Zend_Db::FETCH_SERIALIZE => 512,
        ];

        $this->assertSame(2 | 32, Zend_Db_Statement_StaticTest_PdoFetchFlags::translate(Zend_Db::FETCH_ASSOC | Zend_Db::FETCH_GROUP, $php85));
        $this->assertSame(2 | 64, Zend_Db_Statement_StaticTest_PdoFetchFlags::translate(Zend_Db::FETCH_ASSOC | Zend_Db::FETCH_UNIQUE, $php85));
        // Zend_Db::FETCH_UNIQUE contains the FETCH_GROUP bits (as PDO's did), PHP 8.5's FETCH_UNIQUE stands alone
        $this->assertSame(7 | 64, Zend_Db_Statement_StaticTest_PdoFetchFlags::translate(Zend_Db::FETCH_COLUMN | Zend_Db::FETCH_GROUP | Zend_Db::FETCH_UNIQUE, $php85));
        $this->assertSame(8 | 128, Zend_Db_Statement_StaticTest_PdoFetchFlags::translate(Zend_Db::FETCH_CLASS | Zend_Db::FETCH_CLASSTYPE, $php85));
        $this->assertSame(8 | 512, Zend_Db_Statement_StaticTest_PdoFetchFlags::translate(Zend_Db::FETCH_CLASS | Zend_Db::FETCH_SERIALIZE, $php85));
        $this->assertSame(8 | 128 | 512, Zend_Db_Statement_StaticTest_PdoFetchFlags::translate(Zend_Db::FETCH_CLASS | Zend_Db::FETCH_CLASSTYPE | Zend_Db::FETCH_SERIALIZE, $php85));

        // plain fetch types and modes that already use the current PDO values are left alone
        $this->assertSame(Zend_Db::FETCH_ASSOC, Zend_Db_Statement_StaticTest_PdoFetchFlags::translate(Zend_Db::FETCH_ASSOC, $php85));
        $this->assertSame(2 | 32, Zend_Db_Statement_StaticTest_PdoFetchFlags::translate(2 | 32, $php85));

        // on the running PHP the result always equals PDO's own constants
        $this->assertSame(PDO::FETCH_ASSOC | PDO::FETCH_GROUP, Zend_Db_Statement_StaticTest_PdoFetchFlags::mode(Zend_Db::FETCH_ASSOC | Zend_Db::FETCH_GROUP));
        $this->assertSame(PDO::FETCH_ASSOC | PDO::FETCH_UNIQUE, Zend_Db_Statement_StaticTest_PdoFetchFlags::mode(Zend_Db::FETCH_ASSOC | Zend_Db::FETCH_UNIQUE));
        $this->assertSame(PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE | PDO::FETCH_SERIALIZE,
            Zend_Db_Statement_StaticTest_PdoFetchFlags::mode(Zend_Db::FETCH_CLASS | Zend_Db::FETCH_CLASSTYPE | Zend_Db::FETCH_SERIALIZE));
        $this->assertNull(Zend_Db_Statement_StaticTest_PdoFetchFlags::mode(null));
    }

    public function getDriver()
    {
        return 'Static';
    }
}

if (extension_loaded('pdo')) {
    require_once 'Zend/Db/Statement/Pdo.php';

    /**
     * Gives the tests access to the fetch flag translation of Zend_Db_Statement_Pdo
     */
    class Zend_Db_Statement_StaticTest_PdoFetchFlags extends Zend_Db_Statement_Pdo
    {
        public static function translate($mode, array $flags)
        {
            return self::_translateFetchFlags($mode, $flags);
        }

        public static function mode($mode)
        {
            return self::_pdoFetchMode($mode);
        }
    }
}
