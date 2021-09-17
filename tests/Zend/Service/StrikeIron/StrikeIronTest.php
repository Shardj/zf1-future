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
 * @package    Zend_Service_StrikeIron
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Service_StrikeIron
 */
require_once 'Zend/Service/StrikeIron.php';

/**
 * @category   Zend
 * @package    Zend_Service_StrikeIron
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Service
 * @group      Zend_Service_StrikeIron
 */
class Zend_Service_StrikeIron_StrikeIronTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        // stub out SOAPClient instance
        $this->soapClient = new stdclass();
        $this->options    = ['client' => $this->soapClient];
        $this->strikeIron = new Zend_Service_StrikeIron($this->options);
    }

    public function testFactoryThrowsOnBadName()
    {
        try {
            $this->strikeIron->getService(['class' => 'BadServiceNameHere']);
            $this->fail();
        } catch (Zend_Service_StrikeIron_Exception $e) {
            $this->assertRegExp('/could not be loaded/i', $e->getMessage());
            $this->assertRegExp('/not found/i', $e->getMessage());
        }
    }

    public function testFactoryReturnsServiceByStrikeIronClass()
    {
        $base = $this->strikeIron->getService(['class' => 'Base']);
        $this->assertTrue($base instanceof Zend_Service_StrikeIron_Base);
        $this->assertSame(null, $base->getWsdl());
        $this->assertSame($this->soapClient, $base->getSoapClient());
    }

    public function testFactoryReturnsServiceAnyUnderscoredClass()
    {
        $class = 'Zend_Service_StrikeIron_StrikeIronTest_StubbedBase';
        $stub = $this->strikeIron->getService(['class' => $class]);
        $this->assertTrue($stub instanceof $class);
    }

    public function testFactoryReturnsServiceByWsdl()
    {
        $wsdl = 'http://strikeiron.com/foo';
        $base = $this->strikeIron->getService(['wsdl' => $wsdl]);
        $this->assertEquals($wsdl, $base->getWsdl());
    }

    public function testFactoryPassesOptionsFromConstructor()
    {
        $class = 'Zend_Service_StrikeIron_StrikeIronTest_StubbedBase';
        $stub = $this->strikeIron->getService(['class' => $class]);
        $this->assertEquals($this->options, $stub->options);
    }

    public function testFactoryMergesItsOptionsWithConstructorOptions()
    {
        $options = ['class' => 'Zend_Service_StrikeIron_StrikeIronTest_StubbedBase',
                         'foo'   => 'bar'];

        $mergedOptions = array_merge($options, $this->options);
        unset($mergedOptions['class']);

        $stub = $this->strikeIron->getService($options);
        $this->assertEquals($mergedOptions, $stub->options);
    }

}

/**
 * Stub for Zend_Service_StrikeIron_Base
 *
 * @category   Zend
 * @package    Zend_Service_StrikeIron
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_StrikeIron_StrikeIronTest_StubbedBase
{
    public function __construct($options)
    {
        $this->options = $options;
    }
}
