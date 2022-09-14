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
 * @package    Zend_Application
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Application_ApplicationTest::main');
}

/** Zend_Loader_Autoloader */
require_once 'Zend/Loader/Autoloader.php';

/** Zend_Application */
require_once 'Zend/Application.php';

/**
 * @category   Zend
 * @package    Zend_Application
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Application
 */
class Zend_Application_ApplicationTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        // Store original autoloaders
        $this->loaders = spl_autoload_functions();
        if (!is_array($this->loaders)) {
            // spl_autoload_functions does not return empty array when no
            // autoloaders registered...
            $this->loaders = [];
        }

        // Store original include_path
        $this->includePath = get_include_path();

        Zend_Loader_Autoloader::resetInstance();
        $this->autoloader = Zend_Loader_Autoloader::getInstance();

        $this->application = new Zend_Application('testing');

        $this->iniOptions = [];
    }

    public function tearDown()
    {
        // Restore original autoloaders
        $loaders = spl_autoload_functions();
        foreach ($loaders as $loader) {
            spl_autoload_unregister($loader);
        }

        foreach ($this->loaders as $loader) {
            spl_autoload_register($loader);
        }

        foreach ($this->iniOptions as $key) {
            ini_restore($key);
        }

        // Reset autoloader instance so it doesn't affect other tests
        Zend_Loader_Autoloader::resetInstance();
    }

    public function testConstructorSetsEnvironment()
    {
        $this->assertEquals('testing', $this->application->getEnvironment());
    }

    public function testConstructorInstantiatesAutoloader()
    {
        $autoloader = $this->application->getAutoloader();
        $this->assertTrue($autoloader instanceof Zend_Loader_Autoloader);
    }

    public function testConstructorShouldSetOptionsWhenProvided()
    {
        $options = [
            'foo' => 'bar',
            'bar' => 'baz',
        ];
        $application = new Zend_Application('testing', $options);
        $this->assertEquals($options, $application->getOptions());
    }

    /**
     * @group GH-564
     * @depends testConstructorInstantiatesAutoloader
     */
    public function testConstructorRespectsSuppressFileNotFoundWarningFlag()
    {
        $application = new Zend_Application('testing');
        $this->assertFalse($application->getAutoloader()->suppressNotFoundWarnings()); //Default value

        $application = new Zend_Application('testing', null, $suppressNotFoundWarnings = true);
        $this->assertTrue($application->getAutoloader()->suppressNotFoundWarnings());

        $application = new Zend_Application('testing', null, $suppressNotFoundWarnings = false);
        $this->assertFalse($application->getAutoloader()->suppressNotFoundWarnings());

        $options = [
            'foo' => 'bar',
            'bar' => 'baz',
        ];

        $application = new Zend_Application('testing', $options, $suppressNotFoundWarnings = true);
        $this->assertTrue($application->getAutoloader()->suppressNotFoundWarnings());

        $application = new Zend_Application('testing', $options, $suppressNotFoundWarnings = false);
        $this->assertFalse($application->getAutoloader()->suppressNotFoundWarnings());
    }

    public function testHasOptionShouldReturnFalseWhenOptionNotPresent()
    {
        $this->assertFalse($this->application->hasOption('foo'));
    }

    public function testHasOptionShouldReturnTrueWhenOptionPresent()
    {
        $options = [
            'foo' => 'bar',
            'bar' => 'baz',
        ];
        $application = new Zend_Application('testing', $options);
        $this->assertTrue($application->hasOption('foo'));
    }

    public function testGetOptionShouldReturnNullWhenOptionNotPresent()
    {
        $this->assertNull($this->application->getOption('foo'));
    }

    public function testGetOptionShouldReturnOptionValue()
    {
        $options = [
            'foo' => 'bar',
            'bar' => 'baz',
        ];
        $application = new Zend_Application('testing', $options);
        $this->assertEquals($options['foo'], $application->getOption('foo'));
    }

    public function testPassingAutoloaderNamespaceOptionsShouldProxyToAutoloader()
    {
        $autoloader = $this->autoloader;
        $this->application->setOptions([
            'autoloaderNamespaces' => [
                'Foo',
            ],
        ]);
        $namespaces = $this->autoloader->getRegisteredNamespaces();
        $this->assertContains('Foo', $namespaces);
    }

    public function testPassingIncludePathOptionShouldModifyIncludePath()
    {
        $expected = dirname(__FILE__) . '/_files';
        $this->application->setOptions([
            'includePaths' => [
                $expected,
            ],
        ]);
        $test = get_include_path();
        $this->assertContains($expected, $test);
    }

    public function testPassingPhpSettingsSetsIniValues()
    {
        $this->iniOptions[] = 'html_errors';
        $orig     = ini_get('html_errors');
        $expected = $orig ? 0 : 1;
        $this->application->setOptions([
            'phpSettings' => [
                'html_errors' => $expected,
            ],
        ]);
        $this->assertEquals($expected, ini_get('html_errors'));
    }

    public function testPassingPhpSettingsAsArrayShouldConstructDotValuesAndSetRelatedIniValues()
    {
        $this->iniOptions[] = 'date.default_latitude';
        $orig     = ini_get('date.default_latitude');
        $expected = '1.234';
        $this->application->setOptions([
            'phpSettings' => [
                'date' => [
                    'default_latitude' => $expected,
                ],
            ],
        ]);
        $this->assertEquals($expected, ini_get('date.default_latitude'));
    }

    public function testShouldUseBaseBootstrapClassByDefaultIfNoBootstrapRegistered()
    {
        $bootstrap = $this->application->getBootstrap();
        $this->assertTrue($bootstrap instanceof Zend_Application_Bootstrap_Bootstrap);
    }

    public function testPassingStringBootstrapPathOptionShouldRegisterBootstrap()
    {
        $this->application->setOptions([
            'bootstrap' => dirname(__FILE__) . '/_files/modules/default/Bootstrap.php',
        ]);
        $bootstrap = $this->application->getBootstrap();
        $this->assertTrue($bootstrap instanceof Bootstrap);
    }

    public function testPassingArrayBootstrapOptionShouldRegisterBootstrapBasedOnPathOption()
    {
        $this->application->setOptions([
            'bootstrap' => [
                'path' => dirname(__FILE__) . '/_files/modules/default/Bootstrap.php',
            ],
        ]);
        $bootstrap = $this->application->getBootstrap();
        $this->assertTrue($bootstrap instanceof Bootstrap);
    }

    public function testPassingArrayBootstrapOptionShouldRegisterBootstrapBasedOnPathAndClassOption()
    {
        $this->application->setOptions([
            'bootstrap' => [
                'path'  => dirname(__FILE__) . '/_files/ZfAppBootstrap.php',
                'class' => 'ZfAppBootstrap',
            ],
        ]);
        $bootstrap = $this->application->getBootstrap();
        $this->assertTrue($bootstrap instanceof ZfAppBootstrap);
    }

    /**
     * @expectedException Zend_Application_Exception
     */
    public function testPassingArrayBootstrapWithoutPathOptionShouldRaiseException()
    {
        $this->application->setOptions([
            'bootstrap' => [
                'class' => 'ZfAppBootstrap',
            ],
        ]);
        $bootstrap = $this->application->getBootstrap();
    }

    /**
     * @expectedException Zend_Application_Exception
     */
    public function testPassingInvalidBootstrapOptionShouldRaiseException()
    {
        $this->application->setOptions([
            'bootstrap' => new stdClass(),
        ]);
        $bootstrap = $this->application->getBootstrap();
    }

    /**
     * @expectedException Zend_Application_Exception
     */
    public function testPassingInvalidOptionsArgumentToConstructorShouldRaiseException()
    {
        $application = new Zend_Application('testing', new stdClass());
    }

    public function testPassingStringIniConfigPathOptionToConstructorShouldLoadOptions()
    {
        $application = new Zend_Application('testing', dirname(__FILE__) . '/_files/appconfig.ini');
        $this->assertTrue($application->hasOption('foo'));
    }

    public function testPassingStringXmlConfigPathOptionToConstructorShouldLoadOptions()
    {
        $application = new Zend_Application('testing', dirname(__FILE__) . '/_files/appconfig.xml');
        $this->assertTrue($application->hasOption('foo'));
    }

    public function testPassingStringPhpConfigPathOptionToConstructorShouldLoadOptions()
    {
        $application = new Zend_Application('testing', dirname(__FILE__) . '/_files/appconfig.php');
        $this->assertTrue($application->hasOption('foo'));
    }

    public function testPassingStringIncConfigPathOptionToConstructorShouldLoadOptions()
    {
        $application = new Zend_Application('testing', dirname(__FILE__) . '/_files/appconfig.inc');
        $this->assertTrue($application->hasOption('foo'));
    }

    /**
     * @group ZF-10898
     */
    public function testPassingStringIniDistfileConfigPathOptionToConstructorShouldLoadOptions()
    {
        $application = new Zend_Application('testing', dirname(__FILE__) . '/_files/appconfig.ini.dist');
        $this->assertTrue($application->hasOption('foo'));
    }

    /**
     * @group ZF-10898
     */
    public function testPassingArrayOptionsWithConfigKeyDistfileShouldLoadOptions()
    {
        $application = new Zend_Application('testing', ['bar' => 'baz', 'config' => dirname(__FILE__) . '/_files/appconfig.ini.dist']);
        $this->assertTrue($application->hasOption('foo'));
        $this->assertTrue($application->hasOption('bar'));
    }

    /**
     * @group ZF-10568
     */
    public function testPassingStringYamlConfigPathOptionToConstructorShouldLoadOptions()
    {
        $application = new Zend_Application('testing', dirname(__FILE__) . '/_files/appconfig.yaml');
        $this->assertTrue($application->hasOption('foo'));
    }

    /**
     * @group ZF-10568
     */
    public function testPassingStringJsonConfigPathOptionToConstructorShouldLoadOptions()
    {
        $application = new Zend_Application('testing', dirname(__FILE__) . '/_files/appconfig.json');
        $this->assertTrue($application->hasOption('foo'));
    }
    
    /**
     * @group ZF-11425
     */
    public function testPassingStringYmlConfigPathOptionToConstructorShouldLoadOptionsAsYaml()
    {
        $application = new Zend_Application('testing', dirname(__FILE__) . '/_files/appconfig.yml');
        $this->assertTrue($application->hasOption('foo'));
    }

    public function testPassingArrayOptionsWithConfigKeyShouldLoadOptions()
    {
        $application = new Zend_Application('testing', ['bar' => 'baz', 'config' => dirname(__FILE__) . '/_files/appconfig.inc']);
        $this->assertTrue($application->hasOption('foo'));
        $this->assertTrue($application->hasOption('bar'));
    }

    /**
     * This was changed to have the passed in array always overwrite the config file.
     * @group ZF-6811
     */
    public function testPassingArrayOptionsWithConfigKeyShouldLoadOptionsAndNotOverride()
    {
        $application = new Zend_Application('testing', ['foo' => 'baz', 'config' => dirname(__FILE__) . '/_files/appconfig.inc']);
        $this->assertNotEquals('bar', $application->getOption('foo'));
    }

    /**
     * @expectedException Zend_Application_Exception
     */
    public function testPassingInvalidStringOptionToConstructorShouldRaiseException()
    {
        $application = new Zend_Application('testing', dirname(__FILE__) . '/_files/appconfig');
    }

    public function testPassingZendConfigToConstructorShouldLoadOptions()
    {
        $config = new Zend_Config_Ini(dirname(__FILE__) . '/_files/appconfig.ini', 'testing');
        $application = new Zend_Application('testing', $config);
        $this->assertTrue($application->hasOption('foo'));
    }

    public function testPassingArrayOptionsToConstructorShouldLoadOptions()
    {
        $config = new Zend_Config_Ini(dirname(__FILE__) . '/_files/appconfig.ini', 'testing');
        $application = new Zend_Application('testing', $config->toArray());
        $this->assertTrue($application->hasOption('foo'));
    }

    public function testBootstrapImplementsFluentInterface()
    {
        $application = $this->application->bootstrap();
        $this->assertSame($application, $this->application);
    }

    /**
     * @expectedException Zend_Application_Exception
     */
    public function testApplicationShouldRaiseExceptionIfBootstrapFileDoesNotContainBootstrapClass()
    {
        $this->application->setOptions([
            'bootstrap' => [
                'path'  => dirname(__FILE__) . '/_files/ZfAppNoBootstrap.php',
                'class' => 'ZfAppNoBootstrap',
            ],
        ]);
        $bootstrap = $this->application->getBootstrap();
    }

    /**
     * @expectedException Zend_Application_Exception
     */
    public function testApplicationShouldRaiseExceptionWhenBootstrapClassNotOfCorrectType()
    {
        $this->application->setOptions([
            'bootstrap' => [
                'path'  => dirname(__FILE__) . '/_files/ZfAppBadBootstrap.php',
                'class' => 'ZfAppBadBootstrap',
            ],
        ]);
        $bootstrap = $this->application->getBootstrap();
    }

    public function testOptionsShouldRetainOriginalCase()
    {
        require_once dirname(__FILE__) . '/_files/ZfModuleBootstrap.php';
        $options = [
            'pluginPaths' => [
                'Zend_Application_Test_Path' => dirname(__FILE__),
            ],
            'Resources' => [
                'modules' => [],
                'FrontController' => [
                    'baseUrl'             => '/foo',
                    'moduleDirectory'     => dirname(__FILE__) . '/_files/modules',
                ],
            ],
            'Bootstrap' => [
                'path'  => dirname(__FILE__) . '/_files/ZfAppBootstrap.php',
                'class' => 'ZfAppBootstrap',
            ],
        ];
        $this->application->setOptions($options);
        $setOptions = $this->application->getOptions();
        $this->assertSame(array_keys($options), array_keys($setOptions));
    }

    /**
     * @group ZF-6679
     */
    public function testSetOptionsShouldProperlyMergeTwoConfigFileOptions()
    {
        $application = new Zend_Application(
            'production', dirname(__FILE__) .
            '/_files/zf-6679-1.inc'
        );
        $options = $application->getOptions();
        $this->assertEquals(['includePaths', 'config'], array_keys($options));
    }

    public function testPassingZfVersionAutoloaderInformationConfiguresAutoloader()
    {
        if (!constant('TESTS_ZEND_LOADER_AUTOLOADER_MULTIVERSION_ENABLED')) {
            $this->markTestSkipped();
        }
        if (!constant('TESTS_ZEND_LOADER_AUTOLOADER_MULTIVERSION_LATEST')) {
            $this->markTestSkipped();
        }
        $path   = constant('TESTS_ZEND_LOADER_AUTOLOADER_MULTIVERSION_PATH');
        $latest = constant('TESTS_ZEND_LOADER_AUTOLOADER_MULTIVERSION_LATEST');

        $application = new Zend_Application('production', [
            'autoloaderZfPath'    => $path,
            'autoloaderZfVersion' => 'latest',
        ]);
        $autoloader = $application->getAutoloader();
        $actual     = $autoloader->getZfPath();
        $this->assertContains($latest, $actual);
    }

    /**
     * @group ZF-7742
     */
    public function testHasOptionShouldTreatOptionKeysAsCaseInsensitive()
    {
        $application = new Zend_Application('production', [
            'fooBar' => 'baz',
        ]);
        $this->assertTrue($application->hasOption('FooBar'));
    }

    /**
     * @group ZF-7742
     */
    public function testGetOptionShouldTreatOptionKeysAsCaseInsensitive()
    {
        $application = new Zend_Application('production', [
            'fooBar' => 'baz',
        ]);
        $this->assertEquals('baz', $application->getOption('FooBar'));
    }

    /**
     * @group ZF-6618
     */
    public function testCanExecuteBoostrapResourceViaApplicationInstanceBootstrapMethod()
    {
        $application = new Zend_Application('testing', [
            'bootstrap' => [
                'path' => dirname(__FILE__) . '/_files/ZfAppBootstrap.php',
                'class' => 'ZfAppBootstrap'
                ]
            ]
        );
        $application->bootstrap('foo');

        $this->assertEquals(1, $application->getBootstrap()->fooExecuted);
        $this->assertEquals(0, $application->getBootstrap()->barExecuted);
    }

    public function testOptionsCanHandleMuiltipleConigFiles()
    {
        $application = new Zend_Application('testing', [
            'config' => [
                dirname(__FILE__) . '/_files/Zf-6719-1.ini',
                dirname(__FILE__) . '/_files/Zf-6719-2.ini'
                ]
            ]
        );

        $this->assertEquals('baz', $application->getOption('foo'));
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Application_ApplicationTest::main') {
    Zend_Application_ApplicationTest::main();
}
