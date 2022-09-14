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
 * @package    Zend_Config
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_Config
 */
require_once 'Zend/Config.php';

/**
 * @category   Zend
 * @package    Zend_Config
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Config
 */
class Zend_ConfigTest extends PHPUnit_Framework_TestCase
{
    protected $_iniFileConfig;
    protected $_iniFileNested;

    public function setUp()
    {
        // Arrays representing common config configurations
        $this->_all = [
            'hostname' => 'all',
            'name' => 'thisname',
            'db' => [
                'host' => '127.0.0.1',
                'user' => 'username',
                'pass' => 'password',
                'name' => 'live'
                ],
            'one' => [
                'two' => [
                    'three' => 'multi'
                    ]
                ]
            ];

        $this->_numericData = [
             0 => 34,
             1 => 'test',
            ];

        $this->_menuData1 = [
            'button' => [
                'b0' => [
                    'L1' => 'button0-1',
                    'L2' => 'button0-2',
                    'L3' => 'button0-3'
                ],
                'b1' => [
                    'L1' => 'button1-1',
                    'L2' => 'button1-2'
                ],
                'b2' => [
                    'L1' => 'button2-1'
                    ]
                ]
            ];

        $this->_leadingdot = ['.test' => 'dot-test'];
        $this->_invalidkey = [' ' => 'test', ''=>'test2'];

    }

    public function testLoadSingleSection()
    {
        $config = new Zend_Config($this->_all, false);

        $this->assertEquals('all', $config->hostname);
        $this->assertEquals('live', $config->db->name);
        $this->assertEquals('multi', $config->one->two->three);
        $this->assertNull($config->nonexistent); // property doesn't exist
    }

    public function testIsset()
    {
        if (version_compare(PHP_VERSION, '5.1', '>=')) {
            $config = new Zend_Config($this->_all, false);

            $this->assertFalse(isset($config->notarealkey));
            $this->assertTrue(isset($config->hostname)); // top level
            $this->assertTrue(isset($config->db->name)); // one level down
        }
    }

    public function testModification()
    {
        $config = new Zend_Config($this->_all, true);

        // overwrite an existing key
        $this->assertEquals('thisname', $config->name);
        $config->name = 'anothername';
        $this->assertEquals('anothername', $config->name);

        // overwrite an existing multi-level key
        $this->assertEquals('multi', $config->one->two->three);
        $config->one->two->three = 'anothername';
        $this->assertEquals('anothername', $config->one->two->three);

        // create a new multi-level key
        $config->does = ['not'=> ['exist' => 'yet']];
        $this->assertEquals('yet', $config->does->not->exist);

    }

    public function testNoModifications()
    {
        $config = new Zend_Config($this->_all);
        try {
            $config->hostname = 'test';
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('is read only', $expected->getMessage());
            return;
        }
        $this->fail('An expected Zend_Config_Exception has not been raised');
    }

    public function testNoNestedModifications()
    {
        $config = new Zend_Config($this->_all);
        try {
            $config->db->host = 'test';
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('is read only', $expected->getMessage());
            return;
        }
        $this->fail('An expected Zend_Config_Exception has not been raised');
    }

    public function testNumericKeys()
    {
        $data = new Zend_Config($this->_numericData);
        $this->assertEquals('test', $data->{1});
        $this->assertEquals(34, $data->{0});
    }

    public function testCount()
    {
        $data = new Zend_Config($this->_menuData1);
        $this->assertEquals(3, count($data->button));
    }

    public function testIterator()
    {
        // top level
        $config = new Zend_Config($this->_all);
        $var = '';
        foreach ($config as $key=>$value) {
            if (is_string($value)) {
                $var .= "\nkey = $key, value = $value";
            }
        }
        $this->assertContains('key = name, value = thisname', $var);

        // 1 nest
        $var = '';
        foreach ($config->db as $key=>$value) {
            $var .= "\nkey = $key, value = $value";
        }
        $this->assertContains('key = host, value = 127.0.0.1', $var);

        // 2 nests
        $config = new Zend_Config($this->_menuData1);
        $var = '';
        foreach ($config->button->b1 as $key=>$value) {
            $var .= "\nkey = $key, value = $value";
        }
        $this->assertContains('key = L1, value = button1-1', $var);
    }

    public function testArray()
    {
        $config = new Zend_Config($this->_all);

        ob_start();
        print_r($config->toArray());
        $contents = ob_get_clean();

        $this->assertContains('Array', $contents);
        $this->assertContains('[hostname] => all', $contents);
        $this->assertContains('[user] => username', $contents);
    }

    public function testErrorWriteToReadOnly()
    {
        $config = new Zend_Config($this->_all);
        try {
            $config->test = '32';
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('read only', $expected->getMessage());
            return;
        }

        $this->fail('An expected Zend_Config_Exception has not been raised');
    }

    public function testZF343()
    {
        $config_array = [
            'controls' => [
                'visible' => [
                    'name' => 'visible',
                    'type' => 'checkbox',
                    'attribs' => [], // empty array
                ],
            ],
        ];
        $form_config = new Zend_Config($config_array, true);
        $this->assertSame([], $form_config->controls->visible->attribs->toArray());
    }

    public function testZF402()
    {
        $configArray = [
            'data1'  => 'someValue',
            'data2'  => 'someValue',
            'false1' => false,
            'data3'  => 'someValue'
            ];
        $config = new Zend_Config($configArray);
        $this->assertTrue(count($config) === count($configArray));
        $count = 0;
        foreach ($config as $key => $value) {
            if ($key === 'false1') {
                $this->assertTrue($value === false);
            } else {
                $this->assertTrue($value === 'someValue');
            }
            $count++;
        }
        $this->assertTrue($count === 4);
    }

    public function testZf1019_HandlingInvalidKeyNames()
    {
        $config = new Zend_Config($this->_leadingdot);
        $array = $config->toArray();
        $this->assertContains('dot-test', $array['.test']);
    }

    public function testZF1019_EmptyKeys()
    {
        $config = new Zend_Config($this->_invalidkey);
        $array = $config->toArray();
        $this->assertContains('test', $array[' ']);
        $this->assertContains('test', $array['']);
    }

    public function testZF1417_DefaultValues()
    {
        $config = new Zend_Config($this->_all);
        $value = $config->get('notthere', 'default');
        $this->assertTrue($value === 'default');
        $this->assertTrue($config->notThere === null);

    }

    public function testUnsetException()
    {
        // allow modifications is off - expect an exception
        $config = new Zend_Config($this->_all, false);

        $this->assertTrue(isset($config->hostname)); // top level

        try {
            unset($config->hostname);
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('is read only', $expected->getMessage());
            return;
        }
        $this->fail('Expected read only exception has not been raised.');
    }
    public function testUnset()
    {
        // allow modifications is on
        $config = new Zend_Config($this->_all, true);

        $this->assertTrue(isset($config->hostname));
        $this->assertTrue(isset($config->db->name));

        unset($config->hostname);
        unset($config->db->name);

        $this->assertFalse(isset($config->hostname));
        $this->assertFalse(isset($config->db->name));

    }

    public function testMerge()
    {
        $stdArray = [
            'test_feature' => false,
            'some_files' => [
                'foo'=>'dir/foo.xml',
                'bar'=>'dir/bar.xml',
            ],
            2 => 123,
        ];
        $stdConfig = new Zend_Config($stdArray, true);

        $devArray = [
            'test_feature'=>true,
            'some_files' => [
               'bar' => 'myDir/bar.xml',
               'baz' => 'myDir/baz.xml',
            ],
            2 => 456,
        ];
        $devConfig = new Zend_Config($devArray);

        $stdConfig->merge($devConfig);

        $this->assertTrue($stdConfig->test_feature);
        $this->assertEquals('myDir/bar.xml', $stdConfig->some_files->bar);
        $this->assertEquals('myDir/baz.xml', $stdConfig->some_files->baz);
        $this->assertEquals('dir/foo.xml', $stdConfig->some_files->foo);
        $this->assertEquals(456, $stdConfig->{2});

    }

    /**
     * Ensures that toArray() supports objects of types other than Zend_Config
     *
     * @return void
     */
    public function testToArraySupportsObjects()
    {
        $configData = [
            'a' => new stdClass(),
            'b' => [
                'c' => new stdClass(),
                'd' => new stdClass()
                ]
            ];
        $config = new Zend_Config($configData);
        $this->assertEquals($config->toArray(), $configData);
        $this->assertTrue($config->a instanceof stdClass);
        $this->assertTrue($config->b->c instanceof stdClass);
        $this->assertTrue($config->b->d instanceof stdClass);
    }

    /**
     * ensure that modification is not allowed after calling setReadOnly()
     *
     */
    public function testSetReadOnly()
    {
        $configData = [
            'a' => 'a'
            ];
        $config = new Zend_Config($configData, true);
        $config->b = 'b';

        $config->setReadOnly();
        try {
            $config->c = 'c';
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('is read only', $expected->getMessage());
            return;
        }
        $this->fail('Expected read only exception has not been raised.');
    }

    public function testZF3408_countNotDecreasingOnUnset()
    {
        $configData = [
            'a' => 'a',
            'b' => 'b',
            'c' => 'c',
            ];
        $config = new Zend_Config($configData, true);
        $this->assertEquals(count($config), 3);
        unset($config->b);
        $this->assertEquals(count($config), 2);
    }

    public function testZF4107_ensureCloneDoesNotKeepNestedReferences()
    {
        $parent = new Zend_Config(['key' => ['nested' => 'parent']], true);
        $newConfig = clone $parent;
        $newConfig->merge(new Zend_Config(['key' => ['nested' => 'override']], true));

        $this->assertEquals('override', $newConfig->key->nested, '$newConfig is not overridden');
        $this->assertEquals('parent', $parent->key->nested, '$parent has been overridden');

    }

    /**
     * @group ZF-3575
     *
     */
    public function testMergeHonoursAllowModificationsFlagAtAllLevels()
    {
        $config = new Zend_Config(['key' => ['nested' => 'yes'], 'key2'=>'yes'], false);
        $config2 = new Zend_Config([], true);

        $config2->merge($config);
        try {
            $config2->key2 = 'no';
        }  catch (Zend_Config_Exception $e) {
            $this->fail('Unexpected exception at top level has been raised: ' . $e->getMessage());
        }
        $this->assertEquals('no', $config2->key2);

        try {
            $config2->key->nested = 'no';
        }  catch (Zend_Config_Exception $e) {
            $this->fail('Unexpected exception on nested object has been raised: ' . $e->getMessage());
        }
        $this->assertEquals('no', $config2->key->nested);

    }

    /**
     * @group ZF-5771a
     *
     */
    public function testUnsettingFirstElementDuringForeachDoesNotSkipAnElement()
    {
        $config = new Zend_Config([
            'first'  => [1],
            'second' => [2],
            'third'  => [3]
        ], true);

        $keyList = [];
        foreach ($config as $key => $value)
        {
            $keyList[] = $key;
            if ($key == 'first') {
                unset($config->$key); // uses magic Zend_Config::__unset() method
            }
        }

        $this->assertEquals('first', $keyList[0]);
        $this->assertEquals('second', $keyList[1]);
        $this->assertEquals('third', $keyList[2]);
    }

    /**
     * @group ZF-5771
     *
     */
    public function testUnsettingAMiddleElementDuringForeachDoesNotSkipAnElement()
    {
        $config = new Zend_Config([
            'first'  => [1],
            'second' => [2],
            'third'  => [3]
        ], true);

        $keyList = [];
        foreach ($config as $key => $value)
        {
            $keyList[] = $key;
            if ($key == 'second') {
                unset($config->$key); // uses magic Zend_Config::__unset() method
            }
        }

        $this->assertEquals('first', $keyList[0]);
        $this->assertEquals('second', $keyList[1]);
        $this->assertEquals('third', $keyList[2]);
    }

    /**
     * @group ZF-5771
     *
     */
    public function testUnsettingLastElementDuringForeachDoesNotSkipAnElement()
    {
        $config = new Zend_Config([
            'first'  => [1],
            'second' => [2],
            'third'  => [3]
        ], true);

        $keyList = [];
        foreach ($config as $key => $value)
        {
            $keyList[] = $key;
            if ($key == 'third') {
                unset($config->$key); // uses magic Zend_Config::__unset() method
            }
        }

        $this->assertEquals('first', $keyList[0]);
        $this->assertEquals('second', $keyList[1]);
        $this->assertEquals('third', $keyList[2]);
    }

    /**
     * @group ZF-4728
     *
     */
    public function testSetReadOnlyAppliesToChildren()
    {
        $config = new Zend_Config($this->_all, true);

        $config->setReadOnly();
        $this->assertTrue($config->readOnly());
        $this->assertTrue($config->one->readOnly(), 'First level children are writable');
        $this->assertTrue($config->one->two->readOnly(), 'Second level children are writable');
    }

    public function testZF6995_toArrayDoesNotDisturbInternalIterator()
    {
        $config = new Zend_Config(range(1,10));
        $config->rewind();
        $this->assertEquals(1, $config->current());

        $config->toArray();
        $this->assertEquals(1, $config->current());
    }
}

