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
 * @package    Zend_Navigation
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Navigation/Page.php';

/**
 * Tests Zend_Navigation_Page::factory()
 *
/**
 * @category   Zend
 * @package    Zend_Navigation
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Navigation
 */
class Zend_Navigation_PageFactoryTest extends PHPUnit_Framework_TestCase
{
    protected $_oldIncludePath;

    protected function setUp()
    {
        // store old include path
        $this->_oldIncludePath = get_include_path();

        // add _files dir to include path
        $addToPath = dirname(__FILE__) . '/_files';
        set_include_path($addToPath . PATH_SEPARATOR . $this->_oldIncludePath);
    }

    protected function tearDown()
    {
        // reset include path
        set_include_path($this->_oldIncludePath);
    }

    public function testDetectMvcPage()
    {
        $pages = [
            Zend_Navigation_Page::factory([
                'label'  => 'MVC Page',
                'action' => 'index'
            ]),
            Zend_Navigation_Page::factory([
                'label'      => 'MVC Page',
                'controller' => 'index'
            ]),
            Zend_Navigation_Page::factory([
                'label'  => 'MVC Page',
                'module' => 'index'
            ]),
            Zend_Navigation_Page::factory([
                'label' => 'MVC Page',
                'route' => 'home'
            ]),
            Zend_Navigation_Page::factory([
                'label'  => 'MVC Page',
                'params' => [
                    'foo' => 'bar',
                ],
            ]),
        ];

        $this->assertContainsOnly('Zend_Navigation_Page_Mvc', $pages);
    }

    public function testDetectUriPage()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'URI Page',
            'uri'   => '#'
        ]);

        $this->assertTrue($page instanceof Zend_Navigation_Page_Uri);
    }

    public function testSupportsMvcShorthand()
    {
        $mvcPage = Zend_Navigation_Page::factory([
            'type'       => 'mvc',
            'label'      => 'MVC Page',
            'action'     => 'index',
            'controller' => 'index'
        ]);

        $this->assertTrue($mvcPage instanceof Zend_Navigation_Page_Mvc);
    }

    public function testSupportsUriShorthand()
    {
        $uriPage = Zend_Navigation_Page::factory([
            'type'  => 'uri',
            'label' => 'URI Page',
            'uri'   => 'http://www.example.com/'
        ]);

        $this->assertTrue($uriPage instanceof Zend_Navigation_Page_Uri);
    }

    public function testSupportsCustomPageTypes()
    {
        $page = Zend_Navigation_Page::factory([
            'type'  => 'My_Page',
            'label' => 'My Custom Page'
        ]);

        return $this->assertTrue($page instanceof My_Page);
    }

    public function testShouldFailForInvalidType()
    {
        try {
            $page = Zend_Navigation_Page::factory([
                'type'  => 'My_InvalidPage',
                'label' => 'My Invalid Page'
            ]);
        } catch(Zend_Navigation_Exception $e) {
            return;
        }

        $this->fail('An exception has not been thrown for invalid page type');
    }

    public function testShouldFailForNonExistantType()
    {
        $pageConfig = [
            'type'  => 'My_NonExistant_Page',
            'label' => 'My non-existant Page'
        ];

        try {
            $page = Zend_Navigation_Page::factory($pageConfig);

            $this->fail(
                'A Zend_Exception has not been thrown for non-existant class'
            );
        } catch(Zend_Exception $e) {
            $this->assertEquals(
                'File "My' . DIRECTORY_SEPARATOR . 'NonExistant' . DIRECTORY_SEPARATOR . 'Page.php" does not exist or class '
                . '"My_NonExistant_Page" was not found in the file',
                $e->getMessage()
            );
        }
    }

    public function testShouldFailIfUnableToDetermineType()
    {
        try {
            $page = Zend_Navigation_Page::factory([
                'label' => 'My Invalid Page'
            ]);

            $this->fail(
                'An exception has not been thrown for invalid page type'
            );
        } catch(Zend_Navigation_Exception $e) {
            $this->assertEquals(
                'Invalid argument: Unable to determine class to instantiate '
                . '(Page label: My Invalid Page)',
                $e->getMessage()
            );
        }
    }
}
