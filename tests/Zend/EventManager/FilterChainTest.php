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
 * @package    Zend_EventManager
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id:$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_EventManager_FilterChainTest::main');
}

require_once 'Zend/EventManager/FilterChain.php';
require_once 'Zend/Stdlib/CallbackHandler.php';

/**
 * @category   Zend
 * @package    Zend_EventManager
 * @subpackage UnitTests
 * @group      Zend_EventManager
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_EventManager_FilterChainTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        if (isset($this->message)) {
            unset($this->message);
        }
        $this->filterchain = new Zend_EventManager_FilterChain;
    }

    public function testSubscribeShouldReturnCallbackHandler()
    {
        $handle = $this->filterchain->attach([ $this, __METHOD__ ]);
        $this->assertTrue($handle instanceof Zend_Stdlib_CallbackHandler);
    }

    public function testSubscribeShouldAddCallbackHandlerToFilters()
    {
        $handler  = $this->filterchain->attach([$this, __METHOD__]);
        $handlers = $this->filterchain->getFilters();
        $this->assertEquals(1, count($handlers));
        $this->assertTrue($handlers->contains($handler));
    }

    public function testDetachShouldRemoveCallbackHandlerFromFilters()
    {
        $handle = $this->filterchain->attach([ $this, __METHOD__ ]);
        $handles = $this->filterchain->getFilters();
        $this->assertTrue($handles->contains($handle));
        $this->filterchain->detach($handle);
        $handles = $this->filterchain->getFilters();
        $this->assertFalse($handles->contains($handle));
    }

    public function testDetachShouldReturnFalseIfCallbackHandlerDoesNotExist()
    {
        $handle1 = $this->filterchain->attach([ $this, __METHOD__ ]);
        $this->filterchain->clearFilters();
        $handle2 = $this->filterchain->attach([ $this, 'handleTestTopic' ]);
        $this->assertFalse($this->filterchain->detach($handle1));
    }

    public function testRetrievingAttachedFiltersShouldReturnEmptyArrayWhenNoFiltersExist()
    {
        $handles = $this->filterchain->getFilters();
        $this->assertEquals(0, count($handles));
    }

    public function testFilterChainShouldReturnLastResponse()
    {
        $this->filterchain->attach([$this, 'filterTrim']);
        $this->filterchain->attach([$this, 'filterStrRot13']);
        $value = $this->filterchain->run($this, ['string' => ' foo ']);
        $this->assertEquals(str_rot13(trim(' foo ')), $value);
    }

    public function testFilterIsPassedContextAndArguments()
    {
        $this->filterchain->attach([ $this, 'filterTestCallback1' ]);
        $obj = (object) ['foo' => 'bar', 'bar' => 'baz'];
        $value = $this->filterchain->run($this, ['object' => $obj]);
        $this->assertEquals('filtered', $value);
        $this->assertEquals('filterTestCallback1', $this->message);
        $this->assertEquals('foobarbaz', $obj->foo);
    }

    public function testInterceptingFilterShouldReceiveChain()
    {
        $this->filterchain->attach([$this, 'filterReceivalCallback']);
        $this->filterchain->run($this);
    }

    public function testFilteringStopsAsSoonAsAFilterFailsToCallNext()
    {
        $this->filterchain->attach([$this, 'filterTrim'], 10000);
        $this->filterchain->attach([$this, 'filterStrRot13'], 1000);
        $this->filterchain->attach([$this, 'filterHashMd5'], 100);
        $value = $this->filterchain->run($this, ['string' => ' foo ']);
        $this->assertEquals(str_rot13(trim(' foo ')), $value);
    }

    public function handleTestTopic($message)
    {
        $this->message = $message;
    }

    public function filterTestCallback1($context, array $params)
    {
        $context->message = __FUNCTION__;
        if (isset($params['object']) && is_object($params['object'])) {
            $params['object']->foo = 'foobarbaz';
        }
        return 'filtered';
    }

    public function filterReceivalCallback($context, array $params, $chain)
    {
        $this->assertTrue($chain instanceof Zend_EventManager_Filter_FilterIterator);
    }

    public function filterTrim($context, $params, $chain)
    {
        if (isset($params['string'])) {
            $params['string'] = trim($params['string']);
        }
        $return =  $chain->next($context, $params, $chain);
        return $return;
    }

    public function filterStrRot13($context, array $params)
    {
        $string = isset($params['string']) ? $params['string'] : '';
        return str_rot13($string);
    }

    public function filterHashMd5($context, $params, $chain)
    {
        $string = isset($params['string']) ? $params['string'] : '';
        return hash('md5', $string);
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_EventManager_FilterChainTest::main') {
    Zend_EventManager_FilterChainTest::main();
}
