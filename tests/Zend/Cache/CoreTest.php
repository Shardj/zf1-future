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
 * @package    Zend_Cache
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_Cache
 */
require_once 'Zend/Cache.php';
require_once 'Zend/Cache/Core.php';
require_once 'Zend/Cache/Backend/File.php'; // TODO : use only Test backend ?
require_once 'Zend/Cache/Backend/Test.php';

require_once 'Zend/Config.php';

/**
 * @category   Zend
 * @package    Zend_Cache
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Cache
 */
class Zend_Cache_CoreTest extends PHPUnit_Framework_TestCase
{
    private $_instance;

    public function setUp()
    {
        if (!$this->_instance) {
            $this->_instance = new Zend_Cache_Core([]);
            $this->_backend = new Zend_Cache_Backend_Test();
            $this->_instance->setBackend($this->_backend);
        }
    }

    public function tearDown()
    {
        unset($this->_instance);
    }

    public function testConstructorCorrectCall()
    {
        $test = new Zend_Cache_Core(['lifetime' => 3600, 'caching' => true]);
    }

    /**
     * @group ZF-7568
     */
    public function testConstructorCorrectCallWithZendConfig()
    {
        $test = new Zend_Cache_Core(
            new Zend_Config(['lifetime' => 3600, 'caching' => true])
        );
    }

    /**
     * @group ZF-7568
     */
    public function testSettingOptionsWithZendConfig()
    {
        $config = new Zend_Config(['lifetime' => 3600, 'caching' => true]);
        $test = new Zend_Cache_Core();
        $test->setConfig($config);
        $this->assertEquals(3600, $test->getOption('lifetime'));
    }

    /**
     * @group ZF-9092
     */
    public function testSettingLifetimeAsEmptyIsInterpretedAsNull()
    {
        $config = new Zend_Config(['lifetime' => '', 'caching' => true]);
        $test = new Zend_Cache_Core();
        $test->setConfig($config);
        $this->assertSame(NULL, $test->getOption('lifetime'));
    }

    public function testConstructorBadOption()
    {
        try {
            $test = new Zend_Cache_Core([0 => 'bar', 'lifetime' => 3600]);
        } catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testSetLifeTime()
    {
        $this->_instance->setLifeTime(3600);
    }

    public function testSetBackendCorrectCall1()
    {
        $backend = new Zend_Cache_Backend_File([]);
        $this->_instance->setBackend($backend);
    }

    public function testSetBackendCorrectCall2()
    {
        $backend = new Zend_Cache_Backend_Test([]);
        $this->_instance->setBackend($backend);
        $log = $backend->getLastLog();
        $this->assertEquals('setDirectives', $log['methodName']);
        $this->assertTrue(is_array($log['args'][0]));
    }

    public function testSetOptionCorrectCall()
    {
        $this->_instance->setOption('caching', false);
    }

    public function testSetOptionBadCall()
    {
        try {
            $this->_instance->setOption(['lifetime'], 1200);
        } catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    /**
     * Unknown options are okay and should be silently ignored. Non-string
     * options, however, should throw exceptions.
     *
     * @group ZF-5034
     */
    public function testSetOptionUnknownOption()
    {
        try {
            $this->_instance->setOption(0, 1200);
            $this->fail('Zend_Cache_Exception was expected but not thrown');
        } catch (Zend_Cache_Exception $e) {
        }

        try {
            $this->_instance->setOption('foo', 1200);
        } catch (Zend_Cache_Exception $e) {
            $this->fail('Zend_Cache_Exception was thrown but should not have been');
        }
    }

    public function testSaveCorrectBadCall1()
    {
        try {
            $this->_instance->save('data', 'foo bar');
        }  catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testSaveCorrectBadCall2()
    {
        try {
            $this->_instance->save('data', 'foobar', ['tag1', 'foo bar']);
        }  catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testSaveCorrectBadCall3()
    {
        try {
            $this->_instance->save(['data'], 'foobar');
        }  catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testSaveWithABadCacheId()
    {
        try {
            $this->_instance->save(['data'], true);
        }  catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testSaveWithABadCacheId2()
    {
        try {
            $this->_instance->save(['data'], 'internal_foo');
        }  catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testSaveWithABadTags()
    {
        try {
            $this->_instance->save(['data'], 'foo', 'foobar');
        }  catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testSaveCorrectCallNoCaching()
    {
        $i1 = $this->_backend->getLogIndex();
        $this->_instance->setOption('caching', false);
        $res = $this->_instance->save('data', 'foo');
        $i2 = $this->_backend->getLogIndex();
        $this->assertTrue($res);
        $this->assertEquals($i1, $i2);
    }

    public function testSaveCorrectCallNoWriteControl()
    {
        $this->_instance->setOption('write_control', false);
        $res = $this->_instance->save('data', 'foo', ['tag1', 'tag2']);
        $log = $this->_backend->getLastLog();
        $expected = [
            'methodName' => 'save',
            'args' => [
                0 => 'data',
                1 => 'foo',
                2 => [
                    0 => 'tag1',
                    1 => 'tag2'
                ]
            ]
        ];
        $this->assertEquals($expected, $log);
    }

    public function testSaveCorrectCall()
    {
        $res = $this->_instance->save('data', 'foo', ['tag1', 'tag2']);
        $logs = $this->_backend->getAllLogs();
        $expected1 = [
            'methodName' => 'save',
            'args' => [
                0 => 'data',
                1 => 'foo',
                2 => [
                    0 => 'tag1',
                    1 => 'tag2'
                ]
            ]
        ];
        $expected2 = [
            'methodName' => 'get',
            'args' => [
                0 => 'foo',
                1 => true
            ]
        ];
        $expected3 = [
            'methodName' => 'remove',
            'args' => [
                0 => 'foo'
            ]
        ];
        $this->assertFalse($res);
        $this->assertEquals($expected1, $logs[count($logs) - 3]);
        $this->assertEquals($expected2, $logs[count($logs) - 2]);
        $this->assertEquals($expected3, $logs[count($logs) - 1]);
    }

    public function testSaveCorrectCallButFileCorruption()
    {
        $cacheIdPrefix = 'cacheIdPrefix';
        $this->_instance->setOption('cache_id_prefix', $cacheIdPrefix);
        $res = $this->_instance->save('data', 'false', ['tag1', 'tag2']);
        $logs = $this->_backend->getAllLogs();
        $expected1 = [
            'methodName' => 'save',
            'args' => [
                0 => 'data',
                1 => $cacheIdPrefix . 'false',
                2 => [
                    0 => 'tag1',
                    1 => 'tag2'
                ]
            ]
        ];
        $expected2 = [
            'methodName' => 'remove',
            'args' => [
                0 => $cacheIdPrefix.'false'
            ]
        ];
        $this->assertFalse($res);
        $this->assertEquals($expected1, $logs[count($logs) - 2]);
        $this->assertEquals($expected2, $logs[count($logs) - 1]);
    }

    public function testSaveCorrectCallWithAutomaticCleaning()
    {
        $this->_instance->setOption('automatic_cleaning_factor', 1);
        $res = $this->_instance->save('data', 'false', ['tag1', 'tag2']);
        $logs = $this->_backend->getAllLogs();
        $expected = [
            'methodName' => 'clean',
            'args' => [
                0 => 'old',
                1 => []
            ]
        ];
        $this->assertFalse($res);
        $this->assertEquals($expected, $logs[count($logs) - 3]);
    }

    public function testTestCorrectCallNoCaching()
    {
        $i1 = $this->_backend->getLogIndex();
        $this->_instance->setOption('caching', false);
        $res = $this->_instance->test('foo');
        $i2 = $this->_backend->getLogIndex();
        $this->assertFalse($res);
        $this->assertEquals($i1, $i2);
    }

    public function testTestBadCall()
    {
        try {
            $this->_instance->test('foo bar');
        }  catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testTestCorrectCall1()
    {
         $res = $this->_instance->test('foo');
         $log = $this->_backend->getLastLog();
         $expected = [
            'methodName' => 'test',
            'args' => [
                0 => 'foo'
            ]
         ];
         $this->assertEquals(123456, $res);
         $this->assertEquals($expected, $log);
    }

    public function testTestCorrectCall2()
    {
         $res = $this->_instance->test('false');
         $this->assertFalse($res);
    }

    public function testGetCorrectCallNoCaching()
    {
        $i1 = $this->_backend->getLogIndex();
        $this->_instance->setOption('caching', false);
        $res = $this->_instance->load('foo');
        $i2 = $this->_backend->getLogIndex();
        $this->assertFalse($res);
        $this->assertEquals($i1, $i2);
    }

    public function testGetBadCall()
    {
        try {
            $res = $this->_instance->load('foo bar');
        }  catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testGetCorrectCall1()
    {
        $res = $this->_instance->load('false');
        $this->assertFalse($res);
    }

    public function testGetCorrectCall2()
    {
        $res = $this->_instance->load('bar');
        $this->assertEquals('foo', 'foo');
    }

    public function testGetCorrectCallWithAutomaticSerialization()
    {
        $this->_instance->setOption('automatic_serialization', true);
        $res = $this->_instance->load('serialized');
        $this->assertEquals(['foo'], $res);
    }

    public function testRemoveBadCall()
    {
        try {
            $res = $this->_instance->remove('foo bar');
        }  catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testRemoveCorrectCallNoCaching()
    {
        $i1 = $this->_backend->getLogIndex();
        $this->_instance->setOption('caching', false);
        $res = $this->_instance->remove('foo');
        $i2 = $this->_backend->getLogIndex();
        $this->assertTrue($res);
        $this->assertEquals($i1, $i2);
    }

    public function testRemoveCorrectCall()
    {
        $res = $this->_instance->remove('foo');
        $log = $this->_backend->getLastLog();
        $expected = [
            'methodName' => 'remove',
            'args' => [
                0 => 'foo'
            ]
        ];
        $this->assertTrue($res);
        $this->assertEquals($expected, $log);
    }

    public function testCleanBadCall1()
    {
        try {
            $res = $this->_instance->clean('matchingTag', ['foo bar', 'foo']);
        }  catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testCleanBadCall2()
    {
        try {
            $res = $this->_instance->clean('foo');
        }  catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testCleanCorrectCallNoCaching()
    {
        $i1 = $this->_backend->getLogIndex();
        $this->_instance->setOption('caching', false);
        $res = $this->_instance->clean('all');
        $i2 = $this->_backend->getLogIndex();
        $this->assertTrue($res);
        $this->assertEquals($i1, $i2);
    }

    public function testCleanCorrectCall()
    {
        $res = $this->_instance->clean('matchingTag', ['tag1', 'tag2']);
        $log = $this->_backend->getLastLog();
        $expected = [
            'methodName' => 'clean',
            'args' => [
                0 => 'matchingTag',
                1 => [
                    0 => 'tag1',
                    1 => 'tag2'
                ]
            ]
        ];
        $this->assertTrue($res);
        $this->assertEquals($expected, $log);
    }

    public function testGetIds()
    {
        $this->_instance->setOption('cache_id_prefix', 'prefix_');
        $ids = $this->_instance->getIds();
        $this->assertContains('id1', $ids);
        $this->assertContains('id2', $ids);
    }

    public function testGetIdsMatchingTags()
    {
        $this->_instance->setOption('cache_id_prefix', 'prefix_');
        $ids = $this->_instance->getIdsMatchingTags(['tag1', 'tag2']);
        $this->assertContains('id1', $ids);
        $this->assertContains('id2', $ids);
    }

    public function testGetIdsNotMatchingTags()
    {
        $this->_instance->setOption('cache_id_prefix', 'prefix_');
        $ids = $this->_instance->getIdsNotMatchingTags(['tag3', 'tag4']);
        $this->assertContains('id3', $ids);
        $this->assertContains('id4', $ids);
    }

    public function testGetIdsMatchingAnyTags()
    {
        $this->_instance->setOption('cache_id_prefix', 'prefix_');
        $ids = $this->_instance->getIdsMatchingAnyTags(['tag5', 'tag6']);
        $this->assertContains('id5', $ids);
        $this->assertContains('id6', $ids);
    }

    public function testLoggerSanity()
    {
        $this->_instance = new Zend_Cache_Core([
            'logging' => true
        ]);
        $this->_instance->setBackend($this->_backend);

        $logger = $this->_instance->getOption('logger');
        $this->assertTrue($logger instanceof Zend_Log);
    }

    /**
     * @group ZF-10189
     */
    public function testIfFileZendLogWasIncluded()
    {
        if (class_exists('Zend_Log', false)) {
            $this->markTestSkipped('File Zend/Log.php already included');
        }

        $cacheCore = new Zend_Cache_Core(
            ['logging' => true]
        );
        $this->assertTrue($cacheCore->getOption('logger') instanceof Zend_Log);
    }
}
