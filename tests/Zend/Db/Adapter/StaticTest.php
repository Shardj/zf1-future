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
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Db
 */
require_once 'Zend/Db.php';

/**
 * @see Zend_Config
 */
require_once 'Zend/Config.php';

/**
 * @see Zend_Db_Adapter_Static
 */
require_once 'Zend/Db/Adapter/Static.php';


/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Db
 * @group      Zend_Db_Adapter
 */
class Zend_Db_Adapter_StaticTest extends PHPUnit_Framework_TestCase
{

    protected static $_isCaseSensitiveFileSystem = null;

    public function testDbConstructor()
    {
        $db = new Zend_Db_Adapter_Static( ['dbname' => 'dummy'] );
        $this->assertTrue($db instanceof Zend_Db_Adapter_Abstract);
        $this->assertEquals('dummy', $db->config['dbname']);
    }

    public function testDbConstructorExceptionInvalidOptions()
    {
        list($major, $minor, $revision) = explode('.', PHP_VERSION);
        if ($minor >= 2) {
            try {
                $db = new Zend_Db_Adapter_Static('scalar');
                $this->fail('Expected exception not thrown');
            } catch (Exception $e) {
                $this->assertContains('Adapter parameters must be in an array or a Zend_Config object', $e->getMessage());
            }
        } else {
            $this->markTestIncomplete('Failure to meet type hint results in fatal error in PHP < 5.2.0');
        }
    }

    public function testDbConstructorZendConfig()
    {
        $configData1 = [
            'adapter' => 'Static',
            'params' => [
                'dbname' => 'dummy'
            ]
        ];
        $config1 = new Zend_Config($configData1);
        $db = new Zend_Db_Adapter_Static($config1->params);
        $this->assertTrue($db instanceof Zend_Db_Adapter_Abstract);
        $this->assertEquals('dummy', $db->config['dbname']);
    }

    public function testDbFactory()
    {
        $db = Zend_Db::factory('Static', ['dbname' => 'dummy'] );
        $this->assertTrue($db instanceof Zend_Db_Adapter_Abstract);
        $this->assertTrue(class_exists('Zend_Db_Adapter_Static'));
        $this->assertTrue($db instanceof Zend_Db_Adapter_Static);
        $this->assertEquals('dummy', $db->config['dbname']);
    }

    public function testDbFactoryAlternateNamespace()
    {
        $ip = get_include_path();
        $dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . '_files';
        $newIp = $dir . PATH_SEPARATOR . $ip;
        set_include_path($newIp);

        try {
            // this test used to read as 'TestNamespace', but due to ZF-5606 has been changed
            $db = Zend_Db::factory('Static', ['dbname' => 'dummy', 'adapterNamespace' => 'Testnamespace']);
        } catch (Zend_Exception $e) {
            set_include_path($ip);
            $this->fail('Caught exception of type '.get_class($e).' where none was expected: '.$e->getMessage());
        }

        set_include_path($ip);

        $this->assertTrue($db instanceof Zend_Db_Adapter_Abstract);
        $this->assertTrue(class_exists('Zend_Db_Adapter_Static'));
        $this->assertTrue($db instanceof Zend_Db_Adapter_Static);
        $this->assertTrue(class_exists('TestNamespace_Static'));
        $this->assertTrue($db instanceof TestNamespace_Static);
    }

    public function testDbFactoryAlternateNamespaceExceptionInvalidAdapter()
    {
        $ip = get_include_path();
        $dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . '_files';
        $newIp = $dir . PATH_SEPARATOR . $ip;
        set_include_path($newIp);

        try {
            $db = Zend_Db::factory('Version', ['dbname' => 'dummy', 'adapterNamespace' => 'Zend']);
            set_include_path($ip);
            $this->fail('Expected to catch Zend_Db_Exception');
        } catch (Zend_Exception $e) {
            set_include_path($ip);
            $this->assertTrue($e instanceof Zend_Db_Exception,
                'Expected exception of type Zend_Db_Exception, got '.get_class($e));
            $this->assertEquals("Adapter class 'Zend_Version' does not extend Zend_Db_Adapter_Abstract", $e->getMessage());
        }
    }

    public function testDbFactoryExceptionInvalidDriverName()
    {
        try {
            $db = Zend_Db::factory(null);
            $this->fail('Expected to catch Zend_Db_Exception');
        } catch (Zend_Exception $e) {
            $this->assertTrue($e instanceof Zend_Db_Exception,
                'Expected exception of type Zend_Db_Exception, got '.get_class($e));
            $this->assertEquals($e->getMessage(), 'Adapter name must be specified in a string');
        }
    }

    public function testDbFactoryExceptionInvalidOptions()
    {
        list($major, $minor, $revision) = explode('.', PHP_VERSION);
        if ($minor >= 2) {
            try {
                $db = Zend_Db::factory('Static', 'scalar');
                $this->fail('Expected exception not thrown');
            } catch (Exception $e) {
                $this->assertContains('Adapter parameters must be in an array or a Zend_Config object', $e->getMessage());
            }
        } else {
            $this->markTestIncomplete('Failure to meet type hint results in fatal error in PHP < 5.2.0');
        }
    }

    public function testDbFactoryExceptionNoConfig()
    {
        list($major, $minor, $revision) = explode('.', PHP_VERSION);
        if ($minor >= 2) {
            try {
                $db = Zend_Db::factory('Static');
                $this->fail('Expected exception not thrown');
            } catch (Exception $e) {
                $this->assertContains('Configuration must have a key for \'dbname\' that names the database instance', $e->getMessage());
            }
        } else {
            $this->markTestIncomplete('Failure to meet type hint results in fatal error in PHP < 5.2.0');
        }
    }

    public function testDbFactoryExceptionNoDatabaseName()
    {
        try {
            $db = Zend_Db::factory('Static', []);
            $this->fail('Expected to catch Zend_Db_Adapter_Exception');
        } catch (Zend_Exception $e) {
            $this->assertTrue($e instanceof Zend_Db_Adapter_Exception,
                'Expected exception of type Zend_Db_Adapter_Exception, got '.get_class($e));
            $this->assertEquals("Configuration must have a key for 'dbname' that names the database instance", $e->getMessage());
        }
    }

    public function testDbFactoryZendConfig()
    {
        $configData1 = [
            'adapter' => 'Static',
            'params' => [
                'dbname' => 'dummy'
            ]
        ];
        $config1 = new Zend_Config($configData1);
        $db = Zend_Db::factory($config1);
        $this->assertTrue($db instanceof Zend_Db_Adapter_Static);
        $this->assertEquals('dummy', $db->config['dbname']);
    }

    public function testDbFactoryZendConfigExceptionNoAdapter()
    {
        $configData1 = [
            'params' => [
                'dbname' => 'dummy'
            ]
        ];
        $config1 = new Zend_Config($configData1);
        try {
            $db = Zend_Db::factory($config1);
            $this->fail('Expected to catch Zend_Db_Exception');
        } catch (Zend_Exception $e) {
            $this->assertTrue($e instanceof Zend_Db_Exception,
                'Expected exception of type Zend_Db_Exception, got '.get_class($e));
            $this->assertEquals($e->getMessage(), 'Adapter name must be specified in a string');
        }
    }

    public function testDbFactoryZendConfigOverrideArray()
    {
        $configData1 = [
            'adapter' => 'Static',
            'params' => [
                'dbname' => 'dummy'
            ]
        ];
        $configData2 = [
            'dbname' => 'vanilla'
        ];
        $config1 = new Zend_Config($configData1);
        $db = Zend_Db::factory($config1, $configData2);
        $this->assertTrue($db instanceof Zend_Db_Adapter_Static);
        // second arg should be ignored
        $this->assertEquals('dummy', $db->config['dbname']);
    }

    public function testDbFactoryZendConfigOverrideZendConfig()
    {
        $configData1 = [
            'adapter' => 'Static',
            'params' => [
                'dbname' => 'dummy'
            ]
        ];
        $configData2 = [
            'dbname' => 'vanilla'
        ];
        $config1 = new Zend_Config($configData1);
        $config2 = new Zend_Config($configData2);
        $db = Zend_Db::factory($config1, $config2);
        $this->assertTrue($db instanceof Zend_Db_Adapter_Static);
        // second arg should be ignored
        $this->assertEquals('dummy', $db->config['dbname']);
    }

    public function testDbGetConnection()
    {
        $db = Zend_Db::factory('Static', ['dbname' => 'dummy']);
        $conn = $db->getConnection();
        $this->assertTrue($conn instanceof Zend_Db_Adapter_Static);
    }

    public function testDbGetFetchMode()
    {
        $db = Zend_Db::factory('Static', ['dbname' => 'dummy']);
        $mode = $db->getFetchMode();
        $this->assertTrue(is_int($mode));
    }

    /**
     * @group ZF-5099
     */
    public function testDbGetServerVersion()
    {
        $db = Zend_Db::factory('Static', ['dbname' => 'dummy']);
        $version = $db->getServerVersion();
        $this->assertEquals($version, '5.6.7.8');
        $this->assertTrue(version_compare($version, '1.0.0', '>'));
        $this->assertTrue(version_compare($version, '99.0.0', '<'));
    }

    /**
     * @group ZF-5050
     */
    public function testDbCloseConnection()
    {
        $db = Zend_Db::factory('Static', ['dbname' => 'dummy']);
        $db->getConnection();
        $this->assertTrue($db->isConnected());
        $db->closeConnection();
        $this->assertFalse($db->isConnected());
    }

    /**
     * @group ZF-5606
     */
    public function testDbFactoryDoesNotNormalizeNamespace()
    {
        $newIncludePath = realpath(dirname(__FILE__) . '/_files/') . PATH_SEPARATOR . get_include_path();
        $oldIncludePath = set_include_path($newIncludePath);

        try {
            $adapter = Zend_Db::factory(
                'Dbadapter',
                ['dbname' => 'dummy', 'adapterNamespace' => 'Test_MyCompany1']
                );
        } catch (Exception $e) {
            set_include_path($oldIncludePath);
            $this->fail('Could not load file for reason: ' . $e->getMessage());
        }
        $this->assertEquals('Test_MyCompany1_Dbadapter', get_class($adapter));
        set_include_path($oldIncludePath);

    }

    /**
     * @group ZF-5606
     */
    public function testDbFactoryWillThrowExceptionWhenAssumingBadBehavior()
    {
        $newIncludePath = realpath(dirname(__FILE__) . '/_files/') . PATH_SEPARATOR . get_include_path();
        $oldIncludePath = set_include_path($newIncludePath);

        if (!$this->_isCaseSensitiveFileSystem()) {
            set_include_path($oldIncludePath);
            $this->markTestSkipped('This test is irrelevant on case-inspecific file systems.');
            return;
        }

        try {
            $adapter = Zend_Db::factory(
                'Dbadapter',
                ['dbname' => 'dummy', 'adapterNamespace' => 'Test_MyCompany2']
                );
        } catch (Exception $e) {
            set_include_path($oldIncludePath);
            $this->assertContains('failed to open stream', strtolower($e->getMessage()));
            return;
        }

        $this->assertFalse($adapter instanceof Test_Mycompany2_Dbadapter);
        set_include_path($oldIncludePath);
    }

    /**
     * @group ZF-7924
     */
    public function testDbFactoryWillLoadCaseInsensitiveAdapterName()
    {
        $newIncludePath = realpath(dirname(__FILE__) . '/_files/') . PATH_SEPARATOR . get_include_path();
        $oldIncludePath = set_include_path($newIncludePath);

        try {
            $adapter = Zend_Db::factory(
                'DB_ADAPTER',
                ['dbname' => 'dummy', 'adapterNamespace' => 'Test_MyCompany1']
                );
        } catch (Exception $e) {
            set_include_path($oldIncludePath);
            $this->fail('Could not load file for reason: ' . $e->getMessage());
        }
        $this->assertEquals('Test_MyCompany1_Db_Adapter', get_class($adapter));
        set_include_path($oldIncludePath);

    }

    /**
     * @group ZF-6620
     */
    public function testDbConstructorSetOptionFetchMode()
    {
        $db = new Zend_Db_Adapter_Static(['dbname' => 'dummy']);
        $this->assertEquals($db->getFetchMode(), Zend_Db::FETCH_ASSOC);

        $params = [
            'dbname' => 'dummy',
            'options' => [
                Zend_Db::FETCH_MODE => 'obj'
             ]
        ];
        $db = new Zend_Db_Adapter_Static($params);
        $this->assertEquals($db->getFetchMode(), Zend_Db::FETCH_OBJ);

        $params = [
            'dbname' => 'dummy',
            'options' => [
                Zend_Db::FETCH_MODE => Zend_Db::FETCH_OBJ
             ]
        ];
        $db = new Zend_Db_Adapter_Static($params);
        $this->assertEquals($db->getFetchMode(), Zend_Db::FETCH_OBJ);
    }

    protected function _isCaseSensitiveFileSystem()
    {
        if (self::$_isCaseSensitiveFileSystem === null) {
            self::$_isCaseSensitiveFileSystem = !(@include 'Test/MyCompany1/iscasespecific.php');
        }

        return self::$_isCaseSensitiveFileSystem;
    }

    public function getDriver()
    {
        return 'Static';
    }

}
