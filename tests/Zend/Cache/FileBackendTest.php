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
require_once 'Zend/Cache/Backend/File.php';

/**
 * Zend_Log
 */
require_once 'Zend/Log.php';
require_once 'Zend/Log/Writer/Null.php';

/**
 * Common tests for backends
 */
require_once 'CommonExtendedBackendTest.php';

/**
 * @category   Zend
 * @package    Zend_Cache
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Cache
 */
class Zend_Cache_FileBackendTest extends Zend_Cache_CommonExtendedBackendTest {

    protected $_instance;
    protected $_instance2;
    protected $_cache_dir;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct('Zend_Cache_Backend_File', $data, $dataName);
    }

    public function setUp($notag = false)
    {
        $this->mkdir();
        $this->_cache_dir = $this->getTmpDir() . DIRECTORY_SEPARATOR;
        $this->_instance = new Zend_Cache_Backend_File([
            'cache_dir' => $this->_cache_dir,
        ]);

        $logger = new Zend_Log(new Zend_Log_Writer_Null());
        $this->_instance->setDirectives(['logger' => $logger]);

        parent::setUp($notag);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->_instance);
    }

    public function testSetDeprecatedHashedDirectoryUmask()
    {
        try {
            $cache = new Zend_Cache_Backend_File([
                'cache_dir'              => $this->_cache_dir,
                'hashed_directory_umask' => 0700,
            ]);
            $this->fail("Missing expected E_USER_NOTICE error");
        } catch (PHPUnit_Framework_Error $e) {
            if ($e->getCode() != E_USER_NOTICE) {
                throw $e;
            }

            $this->assertContains('hashed_directory_umask', $e->getMessage());
        }
    }

    public function testSetDeprecatedCacheFileUmask()
    {
        try {
            $cache = new Zend_Cache_Backend_File([
                    'cache_dir'        => $this->_cache_dir,
                    'cache_file_umask' => 0700,
            ]);
            $this->fail("Missing expected E_USER_NOTICE error");
        } catch (PHPUnit_Framework_Error $e) {
            if ($e->getCode() != E_USER_NOTICE) {
                throw $e;
            }

            $this->assertContains('cache_file_umask', $e->getMessage());
        }
    }

    public function testConstructorCorrectCall()
    {
        $test = new Zend_Cache_Backend_File([]);
    }

    public function testConstructorWithABadFileNamePrefix()
    {
        try {
            $class = new Zend_Cache_Backend_File([
                'file_name_prefix' => 'foo bar'
            ]);
        } catch (Zend_Cache_Exception $e) {
            return;
        }
        $this->fail('Zend_Cache_Exception was expected but not thrown');
    }

    public function testGetWithANonExistingCacheIdAndANullLifeTime()
    {
        $this->_instance->setDirectives(['lifetime' => null]);
        $this->assertFalse($this->_instance->load('barbar'));
    }

    public function testSaveCorrectCallWithHashedDirectoryStructure()
    {
        $this->_instance->setOption('hashed_directory_level', 2);
        $res = $this->_instance->save('data to cache', 'foo', ['tag1', 'tag2']);
        $this->assertTrue($res);
    }

    public function testCleanModeAllWithHashedDirectoryStructure()
    {
        // clean files created in setUp (without hashed directory level) first
        $this->assertTrue($this->_instance->clean('all'));

        // set the hashed directory mode
        $this->_instance->setOption('hashed_directory_level', 2);

        // save the data again
        $this->_instance->save('bar : data to cache', 'bar');
        $this->_instance->save('bar2 : data to cache', 'bar2');
        $this->_instance->save('bar3 : data to cache', 'bar3');

        // now delete them
        $this->assertTrue($this->_instance->clean('all'));
        $this->assertFalse($this->_instance->test('bar'));
        $this->assertFalse($this->_instance->test('bar2'));
    }

    public function testSaveWithABadCacheDir()
    {
        if (getenv('TRAVIS')) {
            $this->markTestSkipped(
                'Test randomly fail on Travis CI.'
            );
        }

        $this->_instance->setOption('cache_dir', '/foo/bar/lfjlqsdjfklsqd/');
        $res = $this->_instance->save('data to cache', 'foo', ['tag1', 'tag2']);
        $this->assertFalse($res);
    }

    public function testShouldProperlyCleanCacheNoMatterTheCacheId()
    {
        // the 'zzz' and 'ďťň' keys will be sorted after internal-metadatas file
        $keys = [
            '9230de5449e0c818ed4804587ed422d5',
            'zzz',
            'Zend_LocaleC_cs_CZ_date_',
            'ďťň'
        ];

        foreach ($keys as $key) {
            $this->_instance->save('data to cache', $key);
        }

        $this->assertTrue($this->_instance->clean(Zend_Cache::CLEANING_MODE_ALL));
    }

    /**
     * The CLEANING_MODE_ALL should delete also old orphaned metadatafiles
     */
    public function testShouldDeleteOldMetadataFiles()
    {
        // simulate orphaned metadata file
        $fn = $this->_cache_dir
            . DIRECTORY_SEPARATOR
            . 'zend_cache---internal-metadatas---7a38619e110f03740970cbcd5310f33f';
        $file = fopen($fn, 'a+');
        fclose($file);

        $this->assertTrue(file_exists($fn));
        $this->assertTrue($this->_instance->clean(Zend_Cache::CLEANING_MODE_ALL));
        $this->assertFalse(file_exists($fn));
    }
}
