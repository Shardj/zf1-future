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
 * @package    Zend_Crypt
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Crypt/Math.php';
require_once 'Zend/Crypt/Exception.php';

/**
 * @category   Zend
 * @package    Zend_Crypt
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Crypt
 */
class Zend_Crypt_MathTest extends TestCase
{
    /**
     * @return Zend_Crypt_Math
     */
    protected function _math()
    {
        if (!extension_loaded('bcmath') && !extension_loaded('gmp')) {
            $this->markTestSkipped('Neither bcmath nor gmp is loaded');
        }

        return new Zend_Crypt_Math();
    }

    public function testRandStaysInRange()
    {
        $math   = $this->_math();
        $higher = '155172898181473697471232257763715539915724801966915404479707795314057629378541917580651227423698188993727816152646631438561595825688188889951272158842675419950341258706556549803580104870537681476726513255747040765857479291291572334510643245094715007229621094194349783925984760375594985848253359305585439638443';
        $lower  = '155172898181473697471232257763715539915724801966915404479707795314057629378541917580651227423698188993727816152646631438561595825688188889951272158842675419950341258706556549803580104870537681476726513255747040765857479291291572334510643245094715007229621094194349783925984760375594985848253359305585439638442';

        // the only value of [lower, higher)
        $this->assertSame($lower, (string) $math->rand($lower, $higher));

        for ($i = 0; $i < 20; $i++) {
            $result = (string) $math->rand('1000000000000000000000000000000', '9000000000000000000000000000000');
            $this->assertMatchesRegularExpression('/^\d+$/', $result);
            $this->assertGreaterThanOrEqual(0, $math->compare($result, '1000000000000000000000000000000'));
            $this->assertLessThan(0, $math->compare($result, '9000000000000000000000000000000'));
        }
    }

    public function testRandIsNotConstant()
    {
        $math = $this->_math();
        $seen = [];
        for ($i = 0; $i < 50; $i++) {
            $seen[(string) $math->rand(0, 1000000)] = true;
        }
        $this->assertGreaterThan(1, count($seen));
    }

    public function testRandWithAnEmptyRangeThrows()
    {
        $math = $this->_math();
        $this->expectException('Zend_Crypt_Math_Exception');
        $math->rand(5, 5);
    }

    public function testRandBytes()
    {
        for ($length = 1; $length < 4096; $length++) {
            $rand = Zend_Crypt_Math::randBytes($length);
            $this->assertTrue(false !== $rand);
            $this->assertEquals($length, strlen($rand));
        }
    }

    public function testRandInteger()
    {
        for ($i = 0; $i < 1024; $i++) {
            $min = rand(1, PHP_INT_MAX / 2);
            $max = $min + rand(1, PHP_INT_MAX / 2 - 1);
            $rand = Zend_Crypt_Math::randInteger($min, $max);
            $this->assertGreaterThanOrEqual($min, $rand);
            $this->assertLessThanOrEqual($max, $rand);
        }
    }

    public static function provideRandInt()
    {
        return [
            [2, 1, 10000, 100, 0.9, 1.1, false],
            [2, 1, 10000, 100, 0.8, 1.2, true]
        ];
    }

    /**
     * A Monte Carlo test that generates $cycles numbers from 0 to $tot
     * and test if the numbers are above or below the line y=x with a
     * frequency range of [$min, $max]
     *
     * @dataProvider provideRandInt
     */
    public function testMontecarloRandInteger($num, $valid, $cycles, $tot, $min, $max, $strong)
    {
        try {
            $test = Zend_Crypt_Math::randBytes(1, $strong);
        } catch (Zend_Crypt_Exception $e) {
            $this->markTestSkipped($e->getMessage());
        }

        $i = 0;
        $count = 0;
        do {
            $up = 0;
            $down = 0;
            for ($i = 0; $i < $cycles; $i++) {
                $x = Zend_Crypt_Math::randInteger(0, $tot, $strong);
                $y = Zend_Crypt_Math::randInteger(0, $tot, $strong);
                if ($x > $y) {
                    $up++;
                } elseif ($x < $y) {
                    $down++;
                }
            }
            $this->assertGreaterThan(0, $up);
            $this->assertGreaterThan(0, $down);
            $ratio = $up / $down;
            if ($ratio > $min && $ratio < $max) {
                $count++;
            }
            $i++;
        } while ($i < $num && $count < $valid);

        if ($count < $valid) {
            $this->fail('The random number generator failed the Monte Carlo test');
        }
    }
}
