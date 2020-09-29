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
    define('PHPUnit_MAIN_METHOD', 'Zend_Application_Resource_TranslateTest::main');
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
class Zend_Application_Resource_TranslateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $_translationOptions = [
        'data' => [
            'message1' => 'message1',
            'message2' => 'message2',
            'message3' => 'message3'
        ]
    ];

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

        Zend_Loader_Autoloader::resetInstance();
        $this->autoloader = Zend_Loader_Autoloader::getInstance();

        $this->application = new Zend_Application('testing');

        $this->bootstrap = new Zend_Application_Bootstrap_Bootstrap($this->application);

        Zend_Registry::_unsetInstance();
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

        // Reset autoloader instance so it doesn't affect other tests
        Zend_Loader_Autoloader::resetInstance();
    }

    public function testInitializationInitializesTranslateObject()
    {
        $resource = new Zend_Application_Resource_Translate($this->_translationOptions);
        $resource->setBootstrap($this->bootstrap);
        $resource->init();
        $this->assertTrue($resource->getTranslate() instanceof Zend_Translate);
    }

    public function testInitializationReturnsLocaleObject()
    {
        $resource = new Zend_Application_Resource_Translate($this->_translationOptions);
        $resource->setBootstrap($this->bootstrap);
        $test = $resource->init();
        $this->assertTrue($test instanceof Zend_Translate);
    }

    public function testOptionsPassedToResourceAreUsedToSetLocaleState()
    {
        $resource = new Zend_Application_Resource_Translate($this->_translationOptions);
        $resource->setBootstrap($this->bootstrap);
        $resource->init();
        $translate = $resource->getTranslate();
        $this->assertTrue(Zend_Registry::isRegistered('Zend_Translate'));
        $this->assertSame(Zend_Registry::get('Zend_Translate'), $translate);
    }

    public function testResourceThrowsExceptionWithoutData()
    {
        try {
            $resource = new Zend_Application_Resource_Translate();
            $resource->getTranslate();
            $this->fail('Expected Zend_Application_Resource_Exception');
        } catch (Zend_Application_Resource_Exception $e) {
            $this->assertTrue($e instanceof Zend_Application_Resource_Exception);
        }
    }

    /**
     * @group ZF-7352
     */
    public function testTranslationIsAddedIfRegistryKeyExistsAlready()
    {
        $options1 = ['foo' => 'bar'];
        $options2 = array_merge_recursive($this->_translationOptions,
                                          ['data' => ['message4' => 'bericht4']]);

        $translate = new Zend_Translate(Zend_Translate::AN_ARRAY, $options1);
        Zend_Registry::set('Zend_Translate', $translate);

        $resource = new Zend_Application_Resource_Translate($options2);

        $this->assertTrue($translate === $resource->getTranslate());
        $this->assertEquals('bar', $translate->translate('foo'));
        $this->assertEquals('bericht4', $translate->translate('message4'));
        $this->assertEquals('shouldNotExist', $translate->translate('shouldNotExist'));
    }

    /**
     * @group ZF-10034
     */
    public function testSetCacheFromCacheManager()
    {
        $configCache = [
            'translate' => [
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

        $options = $this->_translationOptions;
        $options['cache'] = 'translate';
        $resource = new Zend_Application_Resource_Translate($options);
        $resource->setBootstrap($this->bootstrap);
        $resource->init();

        $this->assertTrue(Zend_Translate::getCache() instanceof Zend_Cache_Core);
        Zend_Translate::removeCache();
    }

    /**
     * @group ZF-10352
     */
    public function testToUseTheSameKeyAsTheOptionsZendTranslate()
    {
        $options = [
            'adapter' => 'array',
            'content' => [
                'm1' => 'message1',
                'm2' => 'message2'
            ],
            'locale' => 'auto'
        ];

        $resource = new Zend_Application_Resource_Translate($options);
        $translator = $resource->init();

        $this->assertEquals(new Zend_Translate($options), $translator);
        $this->assertEquals('message2', $translator->_('m2'));
    }

    /**
     * @group ZF-10352
     * @expectedException Zend_Application_Resource_Exception
     */
    public function testToUseTheTwoKeysContentAndDataShouldThrowsException()
    {
        $options = [
            'adapter' => 'array',
            'content' => [
                'm1' => 'message1',
                'm2' => 'message2'
            ],
            'data' => [
                'm3' => 'message3',
                'm4' => 'message4'
            ],
            'locale' => 'auto'
        ];

        $resource = new Zend_Application_Resource_Translate($options);
        $translator = $resource->init();
    }

    /**
     * @group GH-103
     */
    public function testLogFactory()
    {
        $options                    = $this->_translationOptions;
        $options['log'][0]          = new Zend_Log_Writer_Mock();
        $options['logUntranslated'] = true;
        $options['locale']          = 'en';

        $resource = new Zend_Application_Resource_Translate($options);
        $resource->setBootstrap($this->bootstrap);

        $resource->init()->translate('untranslated');
        $event = current($options['log'][0]->events);

        $this->assertTrue(is_array($event));
        $this->assertTrue(array_key_exists('message', $event));
        $this->assertEquals(
            "Untranslated message within 'en': untranslated",
            $event['message']
        );
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Application_Resource_TranslateTest::main') {
    Zend_Application_Resource_TranslateTest::main();
}
