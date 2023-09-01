<?php

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
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_View_Helper_PartialLoopTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_View_Helper_PartialLoopTest::main");
}

/** Zend_View_Helper_PartialLoop */
require_once 'Zend/View/Helper/PartialLoop.php';

/** Zend_View */
require_once 'Zend/View.php';

/** Zend_Controller_Front */
require_once 'Zend/Controller/Front.php';

/**
 * Test class for Zend_View_Helper_PartialLoop.
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_View
 * @group      Zend_View_Helper
 */
class Zend_View_Helper_PartialLoopTest extends TestCase
{
    /**
     * @var Zend_View_Helper_PartialLoop
     */
    public $helper;

    /**
     * @var string
     */
    public $basePath;

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_View_Helper_PartialLoopTest");
        $result = (new resources_Runner())->run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function set_up()
    {
        $this->basePath = dirname(__FILE__) . '/_files/modules';
        $this->helper = new Zend_View_Helper_PartialLoop();
        Zend_Controller_Front::getInstance()->resetInstance();
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tear_down()
    {
        unset($this->helper);
    }

    /**
     * @return void
     */
    public function testPartialLoopIteratesOverArray()
    {
        $data = [
            ['message' => 'foo'],
            ['message' => 'bar'],
            ['message' => 'baz'],
            ['message' => 'bat']
        ];

        $view = new Zend_View([
            'scriptPath' => $this->basePath . '/default/views/scripts'
        ]);
        $this->helper->setView($view);

        $result = $this->helper->partialLoop('partialLoop.phtml', $data);
        foreach ($data as $item) {
            $string = 'This is an iteration: ' . $item['message'];
            $this->assertStringContainsString($string, $result);
        }
    }

    /**
     * @return void
     */
    public function testPartialLoopIteratesOverIterator()
    {
        $data = [
            ['message' => 'foo'],
            ['message' => 'bar'],
            ['message' => 'baz'],
            ['message' => 'bat']
        ];
        $o = new Zend_View_Helper_PartialLoop_IteratorTest($data);

        $view = new Zend_View([
            'scriptPath' => $this->basePath . '/default/views/scripts'
        ]);
        $this->helper->setView($view);

        $result = $this->helper->partialLoop('partialLoop.phtml', $o);
        foreach ($data as $item) {
            $string = 'This is an iteration: ' . $item['message'];
            $this->assertStringContainsString($string, $result);
        }
    }

    /**
     * @return void
     */
    public function testPartialLoopIteratesOverRecursiveIterator()
    {
        $rIterator = new Zend_View_Helper_PartialLoop_RecursiveIteratorTest();
        for ($i = 0; $i < 5; ++$i) {
            $data = [
                'message' => 'foo' . $i,
            ];
            $rIterator->addItem(new Zend_View_Helper_PartialLoop_IteratorTest($data));
        }

        $view = new Zend_View([
            'scriptPath' => $this->basePath . '/default/views/scripts'
        ]);
        $this->helper->setView($view);

        $result = $this->helper->partialLoop('partialLoop.phtml', $rIterator);
        foreach ($rIterator as $item) {
            foreach ($item as $key => $value) {
                $this->assertStringContainsString($value, $result, var_export($value, 1));
            }
        }
    }

    /**
     * @return void
     * @doesNotPerformAssertions
     */
    public function testPartialLoopThrowsExceptionWithBadIterator()
    {
        $data = [
            ['message' => 'foo'],
            ['message' => 'bar'],
            ['message' => 'baz'],
            ['message' => 'bat']
        ];
        $o = new Zend_View_Helper_PartialLoop_BogusIteratorTest($data);

        $view = new Zend_View([
            'scriptPath' => $this->basePath . '/default/views/scripts'
        ]);
        $this->helper->setView($view);

        try {
            $result = $this->helper->partialLoop('partialLoop.phtml', $o);
            $this->fail('PartialLoop should only work with arrays and iterators');
        } catch (Exception $e) {
        }
    }

    /**
     * @return void
     */
    public function testPartialLoopFindsModule()
    {
        Zend_Controller_Front::getInstance()->addModuleDirectory($this->basePath);
        $data = [
            ['message' => 'foo'],
            ['message' => 'bar'],
            ['message' => 'baz'],
            ['message' => 'bat']
        ];

        $view = new Zend_View([
            'scriptPath' => $this->basePath . '/default/views/scripts'
        ]);
        $this->helper->setView($view);

        $result = $this->helper->partialLoop('partialLoop.phtml', 'foo', $data);
        foreach ($data as $item) {
            $string = 'This is an iteration in the foo module: ' . $item['message'];
            $this->assertStringContainsString($string, $result);
        }
    }

    public function testPassingNoArgsReturnsHelperInstance()
    {
        $test = $this->helper->partialLoop();
        $this->assertSame($this->helper, $test);
    }

    public function testShouldAllowIteratingOverTraversableObjects()
    {
        $data = [
            ['message' => 'foo'],
            ['message' => 'bar'],
            ['message' => 'baz'],
            ['message' => 'bat']
        ];
        $o = new ArrayObject($data);

        $view = new Zend_View([
            'scriptPath' => $this->basePath . '/default/views/scripts'
        ]);
        $this->helper->setView($view);

        $result = $this->helper->partialLoop('partialLoop.phtml', $o);
        foreach ($data as $item) {
            $string = 'This is an iteration: ' . $item['message'];
            $this->assertStringContainsString($string, $result);
        }
    }

    public function testShouldAllowIteratingOverObjectsImplementingToArray()
    {
        $data = [
            ['message' => 'foo'],
            ['message' => 'bar'],
            ['message' => 'baz'],
            ['message' => 'bat']
        ];
        $o = new Zend_View_Helper_PartialLoop_ToArrayTest($data);

        $view = new Zend_View([
            'scriptPath' => $this->basePath . '/default/views/scripts'
        ]);
        $this->helper->setView($view);

        $result = $this->helper->partialLoop('partialLoop.phtml', $o);
        foreach ($data as $item) {
            $string = 'This is an iteration: ' . $item['message'];
            $this->assertStringContainsString($string, $result, $result);
        }
    }

    /**
     * @group ZF-3350
     * @group ZF-3352
     */
    public function testShouldNotCastToArrayIfObjectIsTraversable()
    {
        $data = [
            new Zend_View_Helper_PartialLoop_IteratorWithToArrayTestContainer(['message' => 'foo']),
            new Zend_View_Helper_PartialLoop_IteratorWithToArrayTestContainer(['message' => 'bar']),
            new Zend_View_Helper_PartialLoop_IteratorWithToArrayTestContainer(['message' => 'baz']),
            new Zend_View_Helper_PartialLoop_IteratorWithToArrayTestContainer(['message' => 'bat']),
        ];
        $o = new Zend_View_Helper_PartialLoop_IteratorWithToArrayTest($data);

        $view = new Zend_View([
            'scriptPath' => $this->basePath . '/default/views/scripts'
        ]);
        $this->helper->setView($view);
        $this->helper->setObjectKey('obj');

        $result = $this->helper->partialLoop('partialLoopObject.phtml', $o);
        foreach ($data as $item) {
            $string = 'This is an iteration: ' . $item->message;
            $this->assertStringContainsString($string, $result, $result);
        }
    }

    /**
     * @group ZF-3083
     * @doesNotPerformAssertions
     */
    public function testEmptyArrayPassedToPartialLoopShouldNotThrowException()
    {
        $view = new Zend_View([
            'scriptPath' => $this->basePath . '/default/views/scripts'
        ]);
        $this->helper->setView($view);

        try {
            $result = $this->helper->partialLoop('partialLoop.phtml', []);
        } catch (Exception $e) {
            $this->fail('Empty array should not cause partialLoop to throw exception');
        }

        try {
            $result = $this->helper->partialLoop('partialLoop.phtml', null, []);
        } catch (Exception $e) {
            $this->fail('Empty array should not cause partialLoop to throw exception');
        }
    }

    /**
     * @group ZF-2737
     * @link http://framework.zend.com/issues/browse/ZF-2737
     */
    public function testPartialLoopIncramentsPartialCounter()
    {
        $data = [
            ['message' => 'foo'],
            ['message' => 'bar'],
            ['message' => 'baz'],
            ['message' => 'bat']
        ];

        $view = new Zend_View([
            'scriptPath' => $this->basePath . '/default/views/scripts'
        ]);
        $this->helper->setView($view);

        $result = $this->helper->partialLoop('partialLoopCouter.phtml', $data);
        foreach ($data as $key => $item) {
            $string = 'This is an iteration: ' . $item['message'] . ', pointer at ' . ($key + 1);
            $this->assertStringContainsString($string, $result);
        }
    }

    /**
     * @group ZF-5174
     * @link http://framework.zend.com/issues/browse/ZF-5174
     */
    public function testPartialLoopPartialCounterResets()
    {
        $data = [
            ['message' => 'foo'],
            ['message' => 'bar'],
            ['message' => 'baz'],
            ['message' => 'bat']
        ];

        $view = new Zend_View([
            'scriptPath' => $this->basePath . '/default/views/scripts'
        ]);
        $this->helper->setView($view);

        $result = $this->helper->partialLoop('partialLoopCouter.phtml', $data);
        foreach ($data as $key => $item) {
            $string = 'This is an iteration: ' . $item['message'] . ', pointer at ' . ($key + 1);
            $this->assertStringContainsString($string, $result);
        }

        $result = $this->helper->partialLoop('partialLoopCouter.phtml', $data);
        foreach ($data as $key => $item) {
            $string = 'This is an iteration: ' . $item['message'] . ', pointer at ' . ($key + 1);
            $this->assertStringContainsString($string, $result);
        }
    }

    /**
     * @see ZF-7157
     */
    public function testPartialLoopSetsTotalCount()
    {
        $data = [
            ['message' => 'foo'],
            ['message' => 'bar'],
            ['message' => 'baz'],
            ['message' => 'bat']
        ];

        $view = new Zend_View(
            [
                 'scriptPath' =>
                 $this->basePath . '/default/views/scripts'
            ]
        );
        $this->helper->setView($view);

        $result = $this->helper->partialLoop('partialLoopCouter.phtml', $data);
        foreach ($data as $key => $item) {
            $string = 'Total count: ' . count($data);
            $this->assertStringContainsString($string, $result);
        }
    }
}

class Zend_View_Helper_PartialLoop_IteratorTest implements Iterator, Countable
{
    public $items;

    public function __construct(array $array)
    {
        $this->items = $array;
    }

    #[ReturnTypeWillChange]
    public function current()
    {
        return current($this->items);
    }

    #[ReturnTypeWillChange]
    public function key()
    {
        return key($this->items);
    }

    #[ReturnTypeWillChange]
    public function next()
    {
        return next($this->items);
    }

    #[ReturnTypeWillChange]
    public function rewind()
    {
        return reset($this->items);
    }

    #[ReturnTypeWillChange]
    public function valid()
    {
        return (current($this->items) !== false);
    }

    public function toArray()
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items ?? []);
    }
}

class Zend_View_Helper_PartialLoop_RecursiveIteratorTest implements Iterator, Countable
{
    public $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function addItem(Iterator $iterator)
    {
        $this->items[] = $iterator;
        return $this;
    }

    #[ReturnTypeWillChange]
    public function current()
    {
        return current($this->items);
    }

    #[ReturnTypeWillChange]
    public function key()
    {
        return key($this->items);
    }

    #[ReturnTypeWillChange]
    public function next()
    {
        return next($this->items);
    }

    #[ReturnTypeWillChange]
    public function rewind()
    {
        return reset($this->items);
    }

    #[ReturnTypeWillChange]
    public function valid()
    {
        return (current($this->items) !== false);
    }

    public function count(): int
    {
        return count($this->items ?? []);
    }
}

class Zend_View_Helper_PartialLoop_BogusIteratorTest
{
}

class Zend_View_Helper_PartialLoop_ToArrayTest
{
    /**
     * @var array
     */
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function toArray()
    {
        return $this->data;
    }
}

class Zend_View_Helper_PartialLoop_IteratorWithToArrayTest implements Iterator, Countable
{
    public $items;

    public function __construct(array $array)
    {
        $this->items = $array;
    }

    public function toArray()
    {
        return $this->items;
    }

    #[ReturnTypeWillChange]
    public function current()
    {
        return current($this->items);
    }

    #[ReturnTypeWillChange]
    public function key()
    {
        return key($this->items);
    }

    #[ReturnTypeWillChange]
    public function next()
    {
        return next($this->items);
    }

    #[ReturnTypeWillChange]
    public function rewind()
    {
        return reset($this->items);
    }

    #[ReturnTypeWillChange]
    public function valid()
    {
        return (current($this->items) !== false);
    }

    public function count(): int
    {
        return count($this->items ?? []);
    }
}

class Zend_View_Helper_PartialLoop_IteratorWithToArrayTestContainer
{
    protected $_info;

    public $message;

    public function __construct(array $info)
    {
        foreach ($info as $key => $value) {
            $this->$key = $value;
        }
        $this->_info = $info;
    }

    public function toArray()
    {
        return $this->_info;
    }
}

// Call Zend_View_Helper_PartialLoopTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_View_Helper_PartialLoopTest::main") {
    Zend_View_Helper_PartialLoopTest::main();
}
