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
 * @category   Zend_Cache
 * @package    UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */
 
require_once 'Zend/Cache.php';
require_once 'Zend/Cache/Manager.php';
require_once 'Zend/Config.php';

/**
 * @category   Zend_Cache
 * @package    UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Cache_ManagerTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->_cache_dir = $this->mkdir();
        $this->_cache = Zend_Cache::factory(
            'Core', 'File',
            ['automatic_serialization'=>true],
            ['cache_dir'=>$this->_cache_dir]
        );
    }

    public function tearDown()
    {
        $this->rmdir();
        $this->_cache = null;
    }

    public function testSetsCacheObject()
    {
        $manager = new Zend_Cache_Manager;
        $manager->setCache('cache1', $this->_cache);
        $this->assertTrue($manager->getCache('cache1') instanceof Zend_Cache_Core);
    }

    /**
     * @group ZF-10220
     */
    public function testGetAvialableCaches()
    {
        $manager = new Zend_Cache_Manager();
        $caches  = $manager->getCaches();

        $this->assertTrue(is_array($caches));
        $this->assertArrayHasKey('default', $caches);
    }

    public function testLazyLoadsDefaultPageCache()
    {
        $manager = new Zend_Cache_Manager;
        $manager->setTemplateOptions('pagetag',[
            'backend' => [
                'options' => [
                    'cache_dir' => $this->_cache_dir
                ]
            ]
        ]);
        $this->assertTrue($manager->getCache('page') instanceof Zend_Cache_Frontend_Capture);
    }

    public function testCanOverrideCacheFrontendNameConfiguration()
    {
        $manager = new Zend_Cache_Manager;
        $manager->setTemplateOptions('pagetag',[
            'backend' => [
                'options' => [
                    'cache_dir' => $this->_cache_dir
                ]
            ]
        ]);
        $manager->setTemplateOptions('page', [
            'frontend' => [
                'name'=> 'Page'
            ]
        ]);
        $this->assertTrue($manager->getCache('page') instanceof Zend_Cache_Frontend_Page);
    }

    public function testCanMergeTemplateCacheOptionsFromZendConfig()
    {
        $manager = new Zend_Cache_Manager;
        $config = new Zend_Config([
            'backend' => [
                'options' => [
                    'cache_dir' => $this->_cache_dir
                ]
            ]
        ]);
        $manager->setTemplateOptions('pagetag', $config);
        $options = $manager->getCacheTemplate('pagetag');
        $this->assertEquals($this->_cache_dir, $options['backend']['options']['cache_dir']);
    }

    public function testCanOverrideCacheBackendendNameConfiguration()
    {
        $manager = new Zend_Cache_Manager;
        $manager->setTemplateOptions('pagetag',[
            'backend' => [
                'options' => [
                    'cache_dir' => $this->_cache_dir
                ]
            ]
        ]);
        $manager->setTemplateOptions('page', [
            'backend' => [
                'name'=> 'File'
            ]
        ]);
        $this->assertTrue($manager->getCache('page')->getBackend() instanceof Zend_Cache_Backend_File);
    }

    public function testCanOverrideCacheFrontendOptionsConfiguration()
    {
        $manager = new Zend_Cache_Manager;
        $manager->setTemplateOptions('page', [
            'frontend' => [
                'options'=> [
                    'lifetime' => 9999
                ]
            ]
        ]);
        $config = $manager->getCacheTemplate('page');
        $this->assertEquals(9999, $config['frontend']['options']['lifetime']);
    }

    public function testCanOverrideCacheBackendOptionsConfiguration()
    {
        $manager = new Zend_Cache_Manager;
        $manager->setTemplateOptions('page', [
            'backend' => [
                'options'=> [
                    'public_dir' => './cacheDir'
                ]
            ]
        ]);
        $config = $manager->getCacheTemplate('page');
        $this->assertEquals('./cacheDir', $config['backend']['options']['public_dir']);
    }

    public function testSetsConfigTemplate()
    {
        $manager = new Zend_Cache_Manager;
        $config = [
            'frontend' => [
                'name' => 'Core',
                'options' => [
                    'automatic_serialization' => true
                ]
            ],
            'backend' => [
                'name' => 'File',
                'options' => [
                    'cache_dir' => '../cache',
                ]
            ]
        ];
        $manager->setCacheTemplate('myCache', $config);
        $this->assertSame($config, $manager->getCacheTemplate('myCache'));
    }
    
    public function testSetsConfigTemplateWithoutMultipartNameNormalisation()
    {
        $manager = new Zend_Cache_Manager;
        $config = [
            'frontend' => [
                'name' => 'Core',
                'options' => [
                    'automatic_serialization' => true
                ]
            ],
            'backend' => [
                'name' => 'BlackHole'
            ]
        ];
        $manager->setCacheTemplate('myCache', $config);
        $this->assertSame($config, $manager->getCacheTemplate('myCache'));
    }

    public function testSetsOptionsTemplateUsingZendConfig()
    {
        $manager = new Zend_Cache_Manager;
        $config = [
            'frontend' => [
                'name' => 'Core',
                'options' => [
                    'automatic_serialization' => true
                ]
            ],
            'backend' => [
                'name' => 'File',
                'options' => [
                    'cache_dir' => '../cache',
                ]
            ]
        ];
        $manager->setCacheTemplate('myCache', new Zend_Config($config));
        $this->assertSame($config, $manager->getCacheTemplate('myCache'));
    }

    public function testConfigTemplatesDetectedAsAvailableCaches()
    {
        $manager = new Zend_Cache_Manager;
        $this->assertTrue($manager->hasCache('page'));
    }

    public function testGettingPageCacheAlsoCreatesTagCache()
    {
        $manager = new Zend_Cache_Manager;
        $tagCacheConfig = $manager->getCacheTemplate('tagCache');
        $tagCacheConfig['backend']['options']['cache_dir'] = $this->getTmpDir();
        $manager->setTemplateOptions('pagetag', $tagCacheConfig);
        $tagCache = $manager->getCache('page')->getBackend()->getOption('tag_cache');
        $this->assertTrue($tagCache instanceof Zend_Cache_Core);
    }

    /**
     * @group GH-189
     */
    public function testSetsOptionsWithCustomFrontendAndBackendNamingAndAutoload()
    {
        $manager = new Zend_Cache_Manager;
        $manager->setTemplateOptions(
            'page',
            [
                 'frontend' => [
                     'customFrontendNaming' => true,
                 ],
                 'backend'  => [
                     'customBackendNaming' => true,
                 ],
                 'frontendBackendAutoload' => true,
            ]
        );
        $config = $manager->getCacheTemplate('page');
        $this->assertTrue($config['frontend']['customFrontendNaming']);
        $this->assertTrue($config['backend']['customBackendNaming']);
        $this->assertTrue($config['frontendBackendAutoload']);
    }

    // Helper Methods

    public function mkdir()
    {
        $tmp = $this->getTmpDir();
        @mkdir($tmp);
        return $tmp;
    }

    public function rmdir()
    {
        $tmpDir = $this->getTmpDir(false);
        foreach (glob("$tmpDir*") as $dirname) {
            @rmdir($dirname);
        }
    }

    public function getTmpDir($date = true)
    {
        $suffix = '';
        $tmp = sys_get_temp_dir();
        if ($date) {
            $suffix = date('mdyHis');
        }
        if (is_writeable($tmp)) {
            return $tmp . DIRECTORY_SEPARATOR . 'zend_cache_tmp_dir_' . $suffix;
        } else {
            throw new Exception("no writable tmpdir found");
        }
    }

}
