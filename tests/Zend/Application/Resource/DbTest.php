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
 * @package    Zend_Application
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Application_Resource_DbTest::main');
}

/**
 * Zend_Loader_Autoloader
 */
require_once 'Zend/Loader/Autoloader.php';

/**
 * @category   Zend
 * @package    Zend_Application
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Application
 */
class Zend_Application_Resource_DbTest extends TestCase
{
    /**
     * @var array
     */
    protected $loaders;

    /**
     * @var Zend_Loader_Autoloader
     */
    protected $autoloader;

    /**
     * @var Zend_Application
     */
    protected $application;

    /**
     * @var Zend_Application_Bootstrap_Bootstrap
     */
    protected $bootstrap;

    public static function main()
    {
        $suite = new TestSuite(__CLASS__);
        $result = (new resources_Runner())->run($suite);
    }

    protected function set_up()
    {
        // Store original autoloaders
        $this->loaders = spl_autoload_functions();
        if (!is_array($this->loaders)) {
            // spl_autoload_functions does not return empty array when no
            // autoloaders registered...
            $this->loaders = [];
        }

        Zend_Loader_Autoloader::resetInstance();
        $this->autoloader = Zend_Loader_Autoloader::getInstance();

        $this->application = new Zend_Application('testing');

        require_once dirname(__FILE__) . '/../_files/ZfAppBootstrap.php';
        $this->bootstrap = new ZfAppBootstrap($this->application);
    }

    protected function tear_down()
    {
        Zend_Db_Table::setDefaultMetadataCache();

        // Restore original autoloaders
        $loaders = spl_autoload_functions();
        foreach ($loaders as $loader) {
            spl_autoload_unregister($loader);
        }

        foreach ($this->loaders as $loader) {
            spl_autoload_register($loader);
        }

        // Reset autoloader instance so it doesn't affect other tests
        Zend_Loader_Autoloader::resetInstance();
    }

    public function testAdapterIsNullByDefault()
    {
        require_once 'Zend/Application/Resource/Db.php';
        $resource = new Zend_Application_Resource_Db();
        $this->assertNull($resource->getAdapter());
    }

    public function testDbIsNullByDefault()
    {
        require_once 'Zend/Application/Resource/Db.php';
        $resource = new Zend_Application_Resource_Db();
        $this->assertNull($resource->getDbAdapter());
    }

    public function testParamsAreEmptyByDefault()
    {
        require_once 'Zend/Application/Resource/Db.php';
        $resource = new Zend_Application_Resource_Db();
        $params = $resource->getParams();
        $this->assertTrue(empty($params));
    }

    public function testIsDefaultTableAdapter()
    {
        require_once 'Zend/Application/Resource/Db.php';
        $resource = new Zend_Application_Resource_Db();
        $this->assertTrue($resource->isDefaultTableAdapter());
    }

    /**
     * @requires extension pdo
     * @requires extension pdo_sqlite
     */
    public function testPassingDatabaseConfigurationSetsObjectState()
    {
        require_once 'Zend/Application/Resource/Db.php';
        $config = [
            'adapter' => 'Pdo_Sqlite',
            'params' => [
                'dbname' => ':memory:',
            ],
            'isDefaultTableAdapter' => false,
        ];
        $resource = new Zend_Application_Resource_Db($config);
        $this->assertFalse($resource->isDefaultTableAdapter());
        $this->assertEquals($config['adapter'], $resource->getAdapter());
        $this->assertEquals($config['params'], $resource->getParams());
    }

    /**
     * @requires extension pdo
     * @requires extension pdo_sqlite
     */
    public function testInitShouldInitializeDbAdapter()
    {
        require_once 'Zend/Application/Resource/Db.php';
        $config = [
            'adapter' => 'Pdo_Sqlite',
            'params' => [
                'dbname' => ':memory:',
            ],
            'isDefaultTableAdapter' => false,
        ];
        $resource = new Zend_Application_Resource_Db($config);
        $resource->init();
        $db = $resource->getDbAdapter();
        $this->assertTrue($db instanceof Zend_Db_Adapter_Pdo_Sqlite);
    }

    /**
     * @group ZF-10033
     * @requires extension pdo
     * @requires extension pdo_sqlite
     */
    public function testSetDefaultMetadataCache()
    {
        $cache = Zend_Cache::factory('Core', 'Black Hole', [
            'lifetime' => 120,
            'automatic_serialization' => true
        ]);

        $config = [
            'adapter' => 'PDO_SQLite',
            'params' => [
                'dbname' => ':memory:',
            ],
            'defaultMetadataCache' => $cache,
        ];
        $resource = new Zend_Application_Resource_Db($config);
        $resource->init();
        $this->assertTrue(Zend_Db_Table::getDefaultMetadataCache() instanceof Zend_Cache_Core);
    }

    /**
     * @group ZF-10033
     * @requires extension pdo
     * @requires extension pdo_sqlite
     */
    public function testSetDefaultMetadataCacheFromCacheManager()
    {
        $configCache = [
            'database' => [
                'frontend' => [
                    'name' => 'Core',
                    'options' => [
                        'lifetime' => 120,
                        'automatic_serialization' => true
                    ]
                ],
                'backend' => [
                    'name' => 'Black Hole'
                ]
            ]
        ];
        $this->bootstrap->registerPluginResource('cachemanager', $configCache);

        $config = [
            'bootstrap' => $this->bootstrap,
            'adapter' => 'PDO_SQLite',
            'params' => [
                'dbname' => ':memory:',
            ],
            'defaultMetadataCache' => 'database',
        ];
        $resource = new Zend_Application_Resource_Db($config);
        $resource->init();
        $this->assertTrue(Zend_Db_Table::getDefaultMetadataCache() instanceof Zend_Cache_Core);
    }

    /**
     * @group ZF-6620
     * @requires extension pdo
     * @requires extension pdo_sqlite
     */
    public function testSetOptionFetchMode()
    {
        $config = [
            'bootstrap' => $this->bootstrap,
            'adapter' => 'PDO_SQLite',
            'params' => [
                'dbname' => ':memory:',
                'options' => [
                    'fetchMode' => 'obj'
                ]
            ],
        ];
        $resource = new Zend_Application_Resource_Db($config);
        $db = $resource->init();
        $this->assertEquals($db->getFetchMode(), Zend_Db::FETCH_OBJ);
    }

    /**
     * @group ZF-10543
     * @requires extension pdo
     * @requires extension pdo_sqlite
     */
    public function testSetDefaultMetadataCacheThroughBootstrap()
    {
        $options = [
            'resources' => [
                'db' => [
                    'adapter' => 'Pdo_Sqlite',
                    'params' => [
                        'dbname' => ':memory:'
                    ],
                    'defaultMetadataCache' => 'default'
                ],
                'cachemanager' => [
                    'default' => [
                        'backend' => ['name' => 'black-hole']
                    ]
                ]
            ]
        ];

        $this->bootstrap->setOptions($options);
        $this->bootstrap->bootstrap();
        $resource = $this->bootstrap->getResource('cachemanager');
        $this->assertEquals($resource->getCache('default'), Zend_Db_Table::getDefaultMetadataCache());
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Application_Resource_DbTest::main') {
    Zend_Application_Resource_DbTest::main();
}
