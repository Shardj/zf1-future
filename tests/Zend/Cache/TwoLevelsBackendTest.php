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
require_once 'Zend/Cache/Backend/TwoLevels.php';
require_once 'Zend/Cache/Backend/Apc.php';

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
class Zend_Cache_TwoLevelsBackendTest extends Zend_Cache_CommonExtendedBackendTest {

    protected $_instance;
    private $_cache_dir;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct('Zend_Cache_Backend_TwoLevels', $data, $dataName);
    }

    public function setUp($notag = false)
    {
        @mkdir($this->getTmpDir());
        $this->_cache_dir = $this->getTmpDir() . DIRECTORY_SEPARATOR;
        $slowBackend = 'File';
        $fastBackend = 'Apc';
        $slowBackendOptions = [
            'cache_dir' => $this->_cache_dir
        ];
        $fastBackendOptions = [
        ];
        $this->_instance = new Zend_Cache_Backend_TwoLevels([
            'fast_backend' => $fastBackend,
            'slow_backend' => $slowBackend,
            'fast_backend_options' => $fastBackendOptions,
            'slow_backend_options' => $slowBackendOptions
        ]);
        parent::setUp($notag);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->_instance);
    }

    public function testConstructorCorrectCall()
    {
        $slowBackend = 'File';
        $fastBackend = 'Apc';
        $slowBackendOptions = [
            'cache_dir' => $this->_cache_dir
        ];
        $fastBackendOptions = [
        ];
        $test = new Zend_Cache_Backend_TwoLevels([
            'fast_backend' => $fastBackend,
            'slow_backend' => $slowBackend,
            'fast_backend_options' => $fastBackendOptions,
            'slow_backend_options' => $slowBackendOptions
        ]);
    }

    public function testSaveOverwritesIfFastIsFull()
    {
        $slowBackend = 'File';
        $fastBackend = $this->getMock('Zend_Cache_Backend_Apc', ['getFillingPercentage']);
        $fastBackend->expects($this->at(0))
            ->method('getFillingPercentage')
            ->will($this->returnValue(0));
        $fastBackend->expects($this->at(1))
            ->method('getFillingPercentage')
            ->will($this->returnValue(90));


        $slowBackendOptions = [
            'cache_dir' => $this->_cache_dir
        ];
        $cache = new Zend_Cache_Backend_TwoLevels([
            'fast_backend' => $fastBackend,
            'slow_backend' => $slowBackend,
            'slow_backend_options' => $slowBackendOptions,
            'stats_update_factor' => 1
        ]);

        $id = 'test'.uniqid();
        $this->assertTrue($cache->save(10, $id)); //fast usage at 0%
        
        $this->assertTrue($cache->save(100, $id)); //fast usage at 90%
        $this->assertEquals(100, $cache->load($id));
    }
    
    /**
     * @group ZF-9855
     */
    public function testSaveReturnsTrueIfFastIsFullOnFirstSave()
    {
        $slowBackend = 'File';
        $fastBackend = $this->getMock('Zend_Cache_Backend_Apc', ['getFillingPercentage']);
        $fastBackend->expects($this->any())
            ->method('getFillingPercentage')
            ->will($this->returnValue(90));

        $slowBackendOptions = [
            'cache_dir' => $this->_cache_dir
        ];
        $cache = new Zend_Cache_Backend_TwoLevels([
            'fast_backend' => $fastBackend,
            'slow_backend' => $slowBackend,
            'slow_backend_options' => $slowBackendOptions,
            'stats_update_factor' => 1
        ]);

        $id = 'test'.uniqid();
        
        $this->assertTrue($cache->save(90, $id)); //fast usage at 90%, failing for 
        $this->assertEquals(90, $cache->load($id));
                
        $this->assertTrue($cache->save(100, $id)); //fast usage at 90%
        $this->assertEquals(100, $cache->load($id));
    }
    
}


