<?php
/**
 * Zend_Cache
 */
require_once 'Zend/Cache.php';
require_once 'Zend/Cache/Backend/Sqlite.php';

/**
 * Common tests for backends
 */
require_once 'CommonExtendedBackendTest.php';

/**
 * @category   Zend
 * @package    Zend_Cache
 * @subpackage UnitTests
 * @group      Zend_Cache
 */
class Zend_Cache_SqliteBackendTest extends Zend_Cache_CommonExtendedBackendTest
{
    protected $_instance;
    protected $_cache_dir;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct('Zend_Cache_Backend_Sqlite', $data, $dataName);
    }

    public function set_up($notag = false)
    {
        @mkdir($this->getTmpDir());
        $this->_cache_dir = $this->getTmpDir() . DIRECTORY_SEPARATOR;
        $this->_instance = new Zend_Cache_Backend_Sqlite([
            'cache_db_complete_path' => $this->_cache_dir . 'cache.db'
        ]);
        parent::set_up($notag);
    }

    protected function tear_down()
    {
        parent::tear_down();
        unset($this->_instance);
        @unlink($this->_cache_dir . 'cache.db');
        $this->rmdir();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testConstructorCorrectCall()
    {
        $test = new Zend_Cache_Backend_Sqlite(['cache_db_complete_path' => $this->_cache_dir . 'cache.db']);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testConstructorWithABadDBPath()
    {
        try {
            $test = new Zend_Cache_Backend_Sqlite(['cache_db_complete_path' => '/foo/bar/lfjlqsdjfklsqd/cache.db']);
        } catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testCleanModeAllWithVacuum()
    {
        $this->_instance = new Zend_Cache_Backend_Sqlite([
            'cache_db_complete_path' => $this->_cache_dir . 'cache.db',
            'automatic_vacuum_factor' => 1
        ]);
        parent::set_up();
        $this->assertTrue($this->_instance->clean('all'));
        $this->assertFalse($this->_instance->test('bar'));
        $this->assertFalse($this->_instance->test('bar2'));
    }

    public function testRemoveCorrectCallWithVacuum()
    {
        $this->_instance = new Zend_Cache_Backend_Sqlite([
            'cache_db_complete_path' => $this->_cache_dir . 'cache.db',
            'automatic_vacuum_factor' => 1
        ]);
        parent::set_up();

        $this->assertTrue($this->_instance->remove('bar'));
        $this->assertFalse($this->_instance->test('bar'));
        $this->assertFalse($this->_instance->remove('barbar'));
        $this->assertFalse($this->_instance->test('barbar'));
    }

    /**
     * @group ZF-11640
     */
    public function testRemoveCorrectCallWithVacuumOnMemoryDb()
    {
        $this->_instance = new Zend_Cache_Backend_Sqlite([
            'cache_db_complete_path' => ':memory:',
            'automatic_vacuum_factor' => 1
        ]);
        parent::set_up();

        $this->assertGreaterThan(0, $this->_instance->test('bar2'));

        $this->assertTrue($this->_instance->remove('bar'));
        $this->assertFalse($this->_instance->test('bar'));

        $this->assertGreaterThan(0, $this->_instance->test('bar2'));
    }

    public function testBinaryContentIsStoredUnchanged()
    {
        $data = "\x00\x01'\"\xff binary \x00 end";

        $this->assertTrue($this->_instance->save($data, 'binary'));
        $this->assertSame($data, $this->_instance->load('binary'));
    }

    public function testTagWithApostrophe()
    {
        $this->assertTrue($this->_instance->save('data', 'quoted', ["it's"]));

        $this->assertSame(['quoted'], $this->_instance->getIdsMatchingTags(["it's"]));
        $this->assertContains("it's", $this->_instance->getTags());
        $this->assertTrue($this->_instance->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, ["it's"]));
        $this->assertFalse($this->_instance->test('quoted'));
    }

    public function testMetadatasOfUnknownId()
    {
        $this->assertFalse($this->_instance->getMetadatas('unknown'));
    }

    public function testFileThatIsNoSqlite3Database()
    {
        $file = $this->_cache_dir . 'old.db';
        file_put_contents($file, '** This file contains an SQLite 2.1 database **' . str_repeat("\x00", 2048));

        $backend = new Zend_Cache_Backend_Sqlite(['cache_db_complete_path' => $file]);
        try {
            $backend->load('foo');
            $this->fail('Zend_Cache_Exception was expected but not thrown');
        } catch (Zend_Cache_Exception $e) {
            $this->assertStringContainsString('Impossible to build cache structure', $e->getMessage());
        } finally {
            unset($backend);
            @unlink($file);
        }
    }
}
