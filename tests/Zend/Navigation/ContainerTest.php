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

require_once 'Zend/Navigation.php';
require_once 'Zend/Config.php';
require_once 'Zend/Controller/Front.php';
require_once 'Zend/Controller/Request/Http.php';

/**
 * Tests the class Zend_Navigation_Container
 *
 * @category   Zend
 * @package    Zend_Navigation
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Navigation
 */
class Zend_Navigation_ContainerTest extends PHPUnit_Framework_TestCase
{
    /**
     * Prepares the environment before running a test.
     *
     */
    protected function setUp()
    {
        Zend_Controller_Front::getInstance()->setRequest(
            new Zend_Controller_Request_Http()
        );
    }

    /**
     * Tear down the environment after running a test
     *
     */
    protected function tearDown()
    {

    }

    public function testConstructWithArray()
    {
        $argument = [
            [
                'label' => 'Page 1',
                'uri'   => 'page1.html'
            ],
            [
                'label' => 'Page 2',
                'uri'   => 'page2.html'
            ],
            [
                'label' => 'Page 3',
                'uri'   => 'page3.html'
            ]
        ];

        $container = new Zend_Navigation($argument);
        $this->assertEquals(3, $container->count());
    }

    public function testConstructWithConfig()
    {
        $argument = new Zend_Config([
            [
                'label' => 'Page 1',
                'uri'   => 'page1.html'
            ],
            [
                'label' => 'Page 2',
                'uri'   => 'page2.html'
            ],
            [
                'label' => 'Page 3',
                'uri'   => 'page3.html'
            ]
        ]);

        $container = new Zend_Navigation($argument);
        $this->assertEquals(3, $container->count());
    }

    public function testConstructorShouldThrowExceptionOnInvalidArgument()
    {
        try {
            $nav = new Zend_Navigation('ok');
            $this->fail('An invalid argument was given to the constructor, ' .
                        'but a Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Invalid argument: $pages', $e->getMessage());
        }

        try {
            $nav = new Zend_Navigation(1337);
            $this->fail('An invalid argument was given to the constructor, ' .
                        'but a Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Invalid argument: $pages', $e->getMessage());
        }

        try {
            $nav = new Zend_Navigation(new stdClass());
            $this->fail('An invalid argument was given to the constructor, ' .
                        'but a Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Invalid argument: $pages', $e->getMessage());
        }
    }

    public function testIterationShouldBeOrderAware()
    {
        $nav = new Zend_Navigation([
            [
                'label' => 'Page 1',
                'uri' => '#'
            ],
            [
                'label' => 'Page 2',
                'uri' => '#',
                'order' => -1
            ],
            [
                'label' => 'Page 3',
                'uri' => '#'
            ],
            [
                'label' => 'Page 4',
                'uri' => '#',
                'order' => 100
            ],
            [
                'label' => 'Page 5',
                'uri' => '#'
            ]
        ]);

        $expected = ['Page 2', 'Page 1', 'Page 3', 'Page 5', 'Page 4'];
        $actual = [];
        foreach ($nav as $page) {
            $actual[] = $page->getLabel();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testRecursiveIteration()
    {
        $nav = new Zend_Navigation([
            [
                'label' => 'Page 1',
                'uri' => '#',
                'pages' => [
                    [
                        'label' => 'Page 1.1',
                        'uri' => '#',
                        'pages' => [
                            [
                                'label' => 'Page 1.1.1',
                                'uri' => '#'
                            ],
                            [
                                'label' => 'Page 1.1.2',
                                'uri' => '#'
                            ]
                        ]
                    ],
                    [
                        'label' => 'Page 1.2',
                        'uri' => '#'
                    ]
                ]
            ],
            [
                'label' => 'Page 2',
                'uri' => '#',
                'pages' => [
                    [
                        'label' => 'Page 2.1',
                        'uri' => '#'
                    ]
                ]
            ],
            [
                'label' => 'Page 3',
                'uri' => '#'
            ]
        ]);

        $actual = [];
        $expected = [
            'Page 1',
            'Page 1.1',
            'Page 1.1.1',
            'Page 1.1.2',
            'Page 1.2',
            'Page 2',
            'Page 2.1',
            'Page 3'
        ];

        $iterator = new RecursiveIteratorIterator($nav,
            RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $page) {
            $actual[] = $page->getLabel();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSettingPageOrderShouldUpdateContainerOrder()
    {
        $nav = new Zend_Navigation([
            [
                'label' => 'Page 1',
                'uri' => '#'
            ],
            [
                'label' => 'Page 2',
                'uri' => '#'
            ]
        ]);

        $page3 = Zend_Navigation_Page::factory([
            'label' => 'Page 3',
            'uri' => '#'
        ]);

        $nav->addPage($page3);

        $expected = [
            'before' => ['Page 1', 'Page 2', 'Page 3'],
            'after'  => ['Page 3', 'Page 1', 'Page 2']
        ];

        $actual = [
            'before' => [],
            'after'  => []
        ];

        foreach ($nav as $page) {
            $actual['before'][] = $page->getLabel();
        }

        $page3->setOrder(-1);

        foreach ($nav as $page) {
            $actual['after'][] = $page->getLabel();
        }

        $this->assertEquals($expected, $actual);
    }

    public function testAddPageShouldWorkWithArray()
    {
        $pageOptions = [
            'label' => 'From array',
            'uri' => '#array'
        ];

        $nav = new Zend_Navigation();
        $nav->addPage($pageOptions);

        $this->assertEquals(1, count($nav));
    }

    public function testAddPageShouldWorkWithConfig()
    {
        $pageOptions = [
            'label' => 'From config',
            'uri' => '#config'
        ];

        $pageOptions = new Zend_Config($pageOptions);

        $nav = new Zend_Navigation();
        $nav->addPage($pageOptions);

        $this->assertEquals(1, count($nav));
    }

    public function testAddPageShouldWorkWithPageInstance()
    {
        $pageOptions = [
            'label' => 'From array 1',
            'uri' => '#array'
        ];

        $nav = new Zend_Navigation([$pageOptions]);

        $page = Zend_Navigation_Page::factory($pageOptions);
        $nav->addPage($page);

        $this->assertEquals(2, count($nav));
    }

    public function testAddPagesShouldWorkWithArray()
    {
        $nav = new Zend_Navigation();
        $nav->addPages([
            [
                'label' => 'Page 1',
                'uri' => '#'
            ],
            [
                'label' => 'Page 2',
                'action' => 'index',
                'controller' => 'index'
            ]
        ]);

        $this->assertEquals(2, count($nav),
                            'Expected 2 pages, found ' . count($nav));
    }

    public function testAddPagesShouldWorkWithConfig()
    {
        $nav = new Zend_Navigation();
        $nav->addPages(new Zend_Config([
            [
                'label' => 'Page 1',
                'uri' => '#'
            ],
            [
                'label' => 'Page 2',
                'action' => 'index',
                'controller' => 'index'
            ]
        ]));

        $this->assertEquals(2, count($nav),
                            'Expected 2 pages, found ' . count($nav));
    }

    public function testAddPagesShouldWorkWithMixedArray()
    {
        $nav = new Zend_Navigation();
        $nav->addPages(new Zend_Config([
            [
                'label' => 'Page 1',
                'uri' => '#'
            ],
            new Zend_Config([
                'label' => 'Page 2',
                'action' => 'index',
                'controller' => 'index'
            ]),
            Zend_Navigation_Page::factory([
                'label' => 'Page 3',
                'uri' => '#'
            ])
        ]));

        $this->assertEquals(3, count($nav),
                            'Expected 3 pages, found ' . count($nav));
    }

    /**
     * @group ZF-9815
     */
    public function testAddPagesShouldWorkWithNavigationContainer()
    {        
        $nav = new Zend_Navigation();
        $nav->addPages($this->_getFindByNavigation());
        
        $this->assertEquals(3, count($nav),
                            'Expected 3 pages, found ' . count($nav));
        
        $this->assertEquals($nav->toArray(), $this->_getFindByNavigation()->toArray());
    }

    public function testAddPagesShouldThrowExceptionWhenGivenString()
    {
        $nav = new Zend_Navigation();

        try {
            $nav->addPages('this is a string');
            $this->fail('An invalid argument was given to addPages(), ' .
                        'but a Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Invalid argument: $pages must be', $e->getMessage());
        }
    }

    public function testAddPagesShouldThrowExceptionWhenGivenAnArbitraryObject()
    {
        $nav = new Zend_Navigation();

        try {
            $nav->addPages($pages = new stdClass());
            $this->fail('An invalid argument was given to addPages(), ' .
                        'but a Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Invalid argument: $pages must be', $e->getMessage());
        }
    }

    public function testRemovingAllPages()
    {
        $nav = new Zend_Navigation();
        $nav->addPages([
            [
                'label' => 'Page 1',
                'uri' => '#'
            ],
            [
                'label' => 'Page 2',
                'uri' => '#'
            ]
        ]);

        $nav->removePages();

        $this->assertEquals(0, count($nav),
                            'Expected 0 pages, found ' . count($nav));
    }

    public function testSettingPages()
    {
        $nav = new Zend_Navigation();
        $nav->addPages([
            [
                'label' => 'Page 1',
                'uri' => '#'
            ],
            [
                'label' => 'Page 2',
                'uri' => '#'
            ]
        ]);

        $nav->setPages([
            [
                'label' => 'Page 3',
                'uri' => '#'
            ]
        ]);

        $this->assertEquals(1, count($nav),
                            'Expected 1 page, found ' . count($nav));
    }

    public function testGetPagesShouldReturnAnArrayOfPages()
    {
        $nav = new Zend_Navigation([
            [
                'uri' => 'Page 1'
            ],
            [
                'uri' => 'Page 2'
            ]
        ]);

        $pages = $nav->getPages();

        $expected = [
            'type' => 'array',
            'count' => 2
        ];

        $actual = [
            'type' => gettype($pages),
            'count' => count($pages)
        ];

        $this->assertEquals($expected, $actual);
        $this->assertContainsOnly('Zend_Navigation_Page_Uri', $pages, false);
    }

    public function testGetPagesShouldReturnUnorderedPages()
    {
        $nav = new Zend_Navigation([
            [
                'label' => 'Page 2',
                'uri' => '#',
                'order' => -1
            ],
            [
                'label' => 'Page 4',
                'uri' => '#',
                'order' => 100
            ],
            [
                'label' => 'Page 1',
                'uri' => '#'
            ],
            [
                'label' => 'Page 5',
                'uri' => '#'
            ],
            [
                'label' => 'Page 3',
                'uri' => '#'
            ]
        ]);

        $expected = ['Page 2', 'Page 4', 'Page 1', 'Page 5', 'Page 3'];
        $actual = [];
        foreach ($nav->getPages() as $page) {
            $actual[] = $page->getLabel();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testRemovingPageByOrder()
    {
        $nav = new Zend_Navigation([
            [
                'label' => 'Page 1',
                'uri' => '#'
            ],
            [
                'label' => 'Page 2',
                'uri' => '#',
                'order' => 32
            ],
            [
                'label' => 'Page 3',
                'uri' => '#'
            ],
            [
                'label' => 'Page 4',
                'uri' => '#'
            ]
        ]);

        $expected = [
            'remove0'      => true,
            'remove32'     => true,
            'remove0again' => true,
            'remove1000'   => false,
            'count'        => 1,
            'current'      => 'Page 4'
        ];

        $actual = [
            'remove0'      => $nav->removePage(0),
            'remove32'     => $nav->removePage(32),
            'remove0again' => $nav->removePage(0),
            'remove1000'   => $nav->removePage(1000),
            'count'        => $nav->count(),
            'current'      => $nav->current()->getLabel()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testRemovingPageByInstance()
    {
        $nav = new Zend_Navigation([
            [
                'label' => 'Page 1',
                'uri' => '#'
            ],
            [
                'label' => 'Page 2',
                'uri' => '#'
            ]
        ]);

        $page3 = Zend_Navigation_Page::factory([
            'label' => 'Page 3',
            'uri' => '#'
        ]);

        $nav->addPage($page3);

        $this->assertEquals(true, $nav->removePage($page3));
    }

    public function testRemovingPageByInstanceShouldReturnFalseIfPageIsNotInContainer()
    {
        $nav = new Zend_Navigation([
            [
                'label' => 'Page 1',
                'uri' => '#'
            ],
            [
                'label' => 'Page 2',
                'uri' => '#'
            ]
        ]);

        $page = Zend_Navigation_Page::factory([
            'label' => 'Page lol',
            'uri' => '#'
        ]);

        $this->assertEquals(false, $nav->removePage($page));
    }

    public function testHasPage()
    {
        $page0 = Zend_Navigation_Page::factory([
            'label' => 'Page 0',
            'uri' => '#'
        ]);

        $page1 = Zend_Navigation_Page::factory([
            'label' => 'Page 1',
            'uri' => '#'
        ]);

        $page1_1 = Zend_Navigation_Page::factory([
            'label' => 'Page 1.1',
            'uri' => '#'
        ]);

        $page1_2 = Zend_Navigation_Page::factory([
            'label' => 'Page 1.2',
            'uri' => '#'
        ]);

        $page1_2_1 = Zend_Navigation_Page::factory([
            'label' => 'Page 1.2.1',
            'uri' => '#'
        ]);

        $page1_3 = Zend_Navigation_Page::factory([
            'label' => 'Page 1.3',
            'uri' => '#'
        ]);

        $page2 = Zend_Navigation_Page::factory([
            'label' => 'Page 2',
            'uri' => '#'
        ]);

        $page3 = Zend_Navigation_Page::factory([
            'label' => 'Page 3',
            'uri' => '#'
        ]);

        $nav = new Zend_Navigation([$page1, $page2, $page3]);

        $page1->addPage($page1_1);
        $page1->addPage($page1_2);
        $page1_2->addPage($page1_2_1);
        $page1->addPage($page1_3);

        $expected = [
            'haspage0'            => false,
            'haspage2'            => true,
            'haspage1_1'          => false,
            'haspage1_1recursive' => true
        ];

        $actual = [
            'haspage0'            => $nav->hasPage($page0),
            'haspage2'            => $nav->hasPage($page2),
            'haspage1_1'          => $nav->hasPage($page1_1),
            'haspage1_1recursive' => $nav->hasPage($page1_1, true)
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testHasPages()
    {
        $nav1 = new Zend_Navigation();
        $nav2 = new Zend_Navigation();
        $nav2->addPage([
            'label' => 'Page 1',
            'uri' => '#'
        ]);

        $expected = [
            'empty' => false,
            'notempty' => true
        ];

        $actual = [
            'empty' => $nav1->hasPages(),
            'notempty' => $nav2->hasPages()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testSetParentShouldWorkWithPage()
    {
        $page1 = Zend_Navigation_Page::factory([
            'label' => 'Page 1',
            'uri' => '#'
        ]);

        $page2 = Zend_Navigation_Page::factory([
            'label' => 'Page 2',
            'uri' => '#'
        ]);

        $page2->setParent($page1);

        $expected = [
            'parent' => 'Page 1',
            'hasPages' => true
        ];

        $actual = [
            'parent' => $page2->getParent()->getLabel(),
            'hasPages' => $page1->hasPages()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testSetParentShouldWorkWithNull()
    {
        $page1 = Zend_Navigation_Page::factory([
            'label' => 'Page 1',
            'uri' => '#'
        ]);

        $page2 = Zend_Navigation_Page::factory([
            'label' => 'Page 2',
            'uri' => '#'
        ]);

        $page2->setParent($page1);
        $page2->setParent(null);

        $this->assertEquals(null, $page2->getParent());
    }

    public function testSetParentShouldRemoveFromOldParentPage()
    {
        $page1 = Zend_Navigation_Page::factory([
            'label' => 'Page 1',
            'uri' => '#'
        ]);

        $page2 = Zend_Navigation_Page::factory([
            'label' => 'Page 2',
            'uri' => '#'
        ]);

        $page2->setParent($page1);
        $page2->setParent(null);

        $expected = [
            'parent' => null,
            'haspages' => false
        ];

        $actual = [
            'parent' => $page2->getParent(),
            'haspages' => $page2->hasPages()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testFinderMethodsShouldWorkWithCustomProperties()
    {
        $nav = $this->_getFindByNavigation();

        $found = $nav->findOneBy('page2', 'page2');
        $this->assertTrue($found instanceof Zend_Navigation_Page);
        $this->assertEquals('Page 2', $found->getLabel());
    }

    public function testFindOneByShouldReturnOnlyOnePage()
    {
        $nav = $this->_getFindByNavigation();

        $found = $nav->findOneBy('id', 'page_2_and_3');
        $this->assertTrue($found instanceof Zend_Navigation_Page);
        $this->assertEquals('Page 2', $found->getLabel());
    }

    public function testFindOneByShouldReturnNullIfNotFound()
    {
        $nav = $this->_getFindByNavigation();

        $found = $nav->findOneBy('id', 'non-existant');
        $this->assertNull($found);
    }
    
    /**
     * @group ZF-9994
     */
    public function testFindOneByWithRegex()
    {
        $nav = $this->_getFindByNavigation();
        
        $found = $nav->findOneBy('id', '/page_2/', true);
        $this->assertEquals('Page 2', $found->getLabel());
        
        $found = $nav->findOneBy('class', '/([o]{2})/', true);
        $this->assertEquals('Page 1.3', $found->getLabel());
    }
    
    /**
     * @group ZF-9994
     */
    public function testFindOneWithinArrayProperties()
    {
        $nav = $this->_getFindByNavigation();
        
        $found = $nav->findOneBy('rel', 'Example.org');
        $this->assertEquals('Page 1.2', $found->getLabel());
        
        $found = $nav->findOneBy('rel', '/Example/', true);
        $this->assertEquals('Page 1.2', $found->getLabel());
    }
    
    /**
     * @group ZF-9994
     */
    public function testFindOneWithRegexWithinArrayProperties()
    {
        $nav = $this->_getFindByNavigation();

        $found = $nav->findOneBy('rel', '#Example(.*)#', true);
        $this->assertEquals('Page 1.2', $found->getLabel());
        
        $found = $nav->findOneBy('rel', '?Ex([a-z]*)?', true);
        $this->assertEquals('Page 1.2', $found->getLabel());
    }
    
    /**
     * @group ZF-9994
     */
    public function testFindByWithRegex()
    {
        $nav = $this->_getFindByNavigation();
        
        // Find one
        $found = $nav->findBy('id', '/page_2/', false, true);
        $this->assertEquals('Page 2', $found->getLabel());
        
        $found = $nav->findBy('class', '/([fo]{2})/', false, true);
        $this->assertEquals('Page 1.3', $found->getLabel());
        
        // Find all
        $found = $nav->findBy('title', '/(The){1}.*(given){1}/', true, true);
        
        $expected = ['Page 1.1', 'Page 1.2', 'Page 1.3'];
        $actual   = [];

        foreach ($found as $page) {
            $actual[] = $page->getLabel();
        }

        $this->assertEquals($expected, $actual);
    }

    public function testFindAllByShouldReturnAllMatchingPages()
    {
        $nav = $this->_getFindByNavigation();

        $found = $nav->findAllBy('id', 'page_2_and_3');
        $this->assertContainsOnly('Zend_Navigation_Page', $found, false);

        $expected = ['Page 2', 'Page 3'];
        $actual = [];

        foreach ($found as $page) {
            $actual[] = $page->getLabel();
        }

        $this->assertEquals($expected, $actual);
    }

    public function testFindAllByShouldReturnEmptyArrayifNotFound()
    {
        $nav = $this->_getFindByNavigation();
        $found = $nav->findAllBy('id', 'non-existant');

        $expected = ['type' => 'array', 'count' => 0];
        $actual = ['type' => gettype($found), 'count' => count($found)];
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group ZF-9994
     */
    public function testFindAllByWithRegex()
    {
        $nav = $this->_getFindByNavigation();
        
        $found = $nav->findAllBy('title', '/(The){1}.*(given){1}/', true);
        
        $expected = ['Page 1.1', 'Page 1.2', 'Page 1.3'];
        $actual = [];

        foreach ($found as $page) {
            $actual[] = $page->getLabel();
        }

        $this->assertEquals($expected, $actual);
    }
        
    /**
     * @group ZF-9994
     */
    public function testFindAllWithinArrayProperties()
    {
        $nav = $this->_getFindByNavigation();
        
        // Strict is true
        $found = $nav->findAllBy('rel', 'Example.org');
        
        $expected = ['Page 1.2', 'Page 1.3'];
        $actual   = [];

        foreach ($found as $page) {
            $actual[] = $page->getLabel();
        }

        $this->assertEquals($expected, $actual);
    }
        
    /**
     * @group ZF-9994
     */
    public function testFindAllWithRegexWithinArrayProperties()
    {
        $nav = $this->_getFindByNavigation();
        
        // Test 1
        $found = $nav->findAllBy('rel', '#Example(.*)#', true);
        
        $expected = ['Page 1.2', 'Page 1.3'];
        $actual   = [];

        foreach ($found as $page) {
            $actual[] = $page->getLabel();
        }

        $this->assertEquals($expected, $actual);
        
        // Test 2
        $found = $nav->findAllBy('rel', '?Ex([a-z]*)?', true);
        
        $actual = [];

        foreach ($found as $page) {
            $actual[] = $page->getLabel();
        }

        $this->assertEquals($expected, $actual);
    }

    public function testFindByShouldDefaultToFindOneBy()
    {
        $nav = $this->_getFindByNavigation();

        $found = $nav->findBy('id', 'page_2_and_3');
        $this->assertTrue($found instanceof Zend_Navigation_Page);
    }

    public function testFindOneByMagicMethodNativeProperty()
    {
        $nav = $this->_getFindByNavigation();

        $found = $nav->findOneById('page_2_and_3');
        $this->assertTrue($found instanceof Zend_Navigation_Page);
        $this->assertEquals('Page 2', $found->getLabel());
    }

    public function testFindOneByMagicMethodCustomProperty()
    {
        $nav = $this->_getFindByNavigation();

        $found = $nav->findOneBypage2('page2');
        $this->assertTrue($found instanceof Zend_Navigation_Page);
        $this->assertEquals('Page 2', $found->getLabel());
    }

    public function testFindAllByWithMagicMethodNativeProperty()
    {
        $nav = $this->_getFindByNavigation();

        $found = $nav->findAllById('page_2_and_3');
        $this->assertContainsOnly('Zend_Navigation_Page', $found, false);

        $expected = ['Page 2', 'Page 3'];
        $actual = [];
        foreach ($found as $page) {
            $actual[] = $page->getLabel();
        }

        $this->assertEquals($expected, $actual);
    }

    public function testFindAllByMagicUcfirstPropDoesNotFindCustomLowercaseProps()
    {
        $nav = $this->_getFindByNavigation();

        $found = $nav->findAllByAction('about');
        $this->assertContainsOnly('Zend_Navigation_Page', $found, false);

        $expected = ['Page 3'];
        $actual = [];
        foreach ($found as $page) {
            $actual[] = $page->getLabel();
        }

        $this->assertEquals($expected, $actual);
    }

    public function testFindAllByMagicLowercaseFindsBothNativeAndCustomProps()
    {
        $nav = $this->_getFindByNavigation();

        $found = $nav->findAllByaction('about');
        $this->assertContainsOnly('Zend_Navigation_Page', $found, false);

        $expected = ['Page 1.3', 'Page 3'];
        $actual = [];
        foreach ($found as $page) {
            $actual[] = $page->getLabel();
        }

        $this->assertEquals($expected, $actual);
    }

    public function testFindByMagicMethodIsEquivalentToFindOneBy()
    {
        $nav = $this->_getFindByNavigation();

        $found = $nav->findById('page_2_and_3');
        $this->assertTrue($found instanceof Zend_Navigation_Page);
        $this->assertEquals('Page 2', $found->getLabel());
    }

    public function testInvalidMagicFinderMethodShouldThrowException()
    {
        $nav = $this->_getFindByNavigation();

        try {
            $found = $nav->findSomeById('page_2_and_3');
            $this->fail('An invalid magic finder method was used, ' .
                        'but a Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Bad method call', $e->getMessage());
        }
    }

    public function testInvalidMagicMethodShouldThrowException()
    {
        $nav = $this->_getFindByNavigation();

        try {
            $found = $nav->getPagez();
            $this->fail('An invalid magic finder method was used, ' .
                        'but a Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Bad method call', $e->getMessage());
        }
    }
    
    /**
     * @group ZF-9994
     */
    public function testFindByMagicMethodWithRegex()
    {
        $nav = $this->_getFindByNavigation();
        
        // Find one
        $found = $nav->findOneByClass('/bar/', true);
        $this->assertSame('page-1.3', $found->getUri());
        
        // Find all
        $found = $nav->findAllById('/page_2_/', true);
        $this->assertContainsOnly('Zend_Navigation_Page', $found, false);

        $expected = ['Page 2', 'Page 3'];
        $actual = [];
        foreach ($found as $page) {
            $actual[] = $page->getLabel();
        }

        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group ZF-9994
     */
    public function testFindByMagicMethodActivateRegex()
    {
        $nav = $this->_getFindByNavigation();
                
        $found = $nav->findOneByClass('/bar/', true);
        $this->assertSame('page-1.3', $found->getUri());
        
        $found = $nav->findOneByClass('/bar/', 1);
        $this->assertSame('page-1.3', $found->getUri());
        
        $found = $nav->findOneByClass('/bar/', 42);
        $this->assertSame('page-1.3', $found->getUri());
        
        $found = $nav->findOneByClass('/bar/', 'true');
        $this->assertSame('page-1.3', $found->getUri());
        
        $found = $nav->findOneByClass('/bar/', (object) null);
        $this->assertSame('page-1.3', $found->getUri());
        
        $found = $nav->findOneByClass('/bar/', '0');
        $this->assertNull($found);
        
        $found = $nav->findOneByClass('/bar/', []);
        $this->assertNull($found);               
    }

    protected function _getFindByNavigation()
    {
        // findAllByFoo('bar')         // Page 1, Page 1.1
        // findById('page_2_and_3')    // Page 2
        // findOneById('page_2_and_3') // Page 2
        // findAllById('page_2_and_3') // Page 2, Page 3
        // findAllByAction('about')    // Page 1.3, Page 3
        return new Zend_Navigation([
            [
                'label' => 'Page 1',
                'uri'   => 'page-1',
                'foo'   => 'bar',
                'pages' => [
                    [
                        'label' => 'Page 1.1',
                        'uri'   => 'page-1.1',
                        'foo'   => 'bar',
                        'title' => 'The given title',
                    ],
                    [
                        'label' => 'Page 1.2',
                        'uri'   => 'page-1.2',
                        'title' => 'The given title',
                        'rel'   => [
                            'alternate' => [
                                'label' => 'Example.org',
                                'uri'   => 'http://www.example.org/',
                            ],
                        ],
                    ],
                    [
                        'type'   => 'uri',
                        'label'  => 'Page 1.3',
                        'uri'    => 'page-1.3',
                        'title'  => 'The given title',
                        'action' => 'about',
                        'class'  => 'foo bar',
                        'rel'    => [
                            'alternate' => [
                                'label' => 'Example.org',
                                'uri'   => 'http://www.example.org/',
                            ],
                        ],
                    ]
                ]
            ],
            [
                'id'         => 'page_2_and_3',
                'label'      => 'Page 2',
                'module'     => 'page2',
                'controller' => 'index',
                'action'     => 'page1',
                'page2'      => 'page2',
            ],
            [
                'id'         => 'page_2_and_3',
                'label'      => 'Page 3',
                'module'     => 'page3',
                'controller' => 'index',
                'action'     => 'about',
            ]
        ]);
    }

    public function testCurrent()
    {
        $container = new Zend_Navigation([
            [
                'label' => 'Page 2',
                'type'  => 'uri'
            ],
            [
                'label' => 'Page 1',
                'type'  => 'uri',
                'order' => -1
            ]
        ]);

        $page = $container->current();
        $this->assertEquals('Page 1', $page->getLabel());
    }

    public function testCurrentShouldThrowExceptionIfIndexIsInvalid()
    {
        require_once dirname(__FILE__) . '/_files/My/Container.php';
        $container = new My_Container([
            [
                'label' => 'Page 2',
                'type'  => 'uri'
            ],
            [
                'label' => 'Page 1',
                'type'  => 'uri',
                'order' => -1
            ]
        ]);

        try {
            $page = $container->current();
            $this->fail('Container index is invalid, ' .
                        'but a Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Corruption detected', $e->getMessage());
        }
    }

    public function testKeyWhenContainerIsEmpty()
    {
        $container = new Zend_Navigation();
        $this->assertEquals(null, $container->key());
    }

    public function testKeyShouldReturnCurrentPageHash()
    {
        $container = new Zend_Navigation();
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri'
        ]);
        $container->addPage($page);

        $this->assertEquals($page->hashCode(), $container->key());
    }

    public function testGetChildrenShouldReturnTheCurrentPage()
    {
        $container = new Zend_Navigation();
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri'
        ]);
        $container->addPage($page);

        $this->assertEquals($page, $container->getChildren());
    }

    public function testGetChildrenShouldReturnNullWhenContainerIsEmpty()
    {
        $container = new Zend_Navigation();

        $this->assertEquals(null, $container->getChildren());
    }

    public function testRemovePageRecursively()
    {
        $container = new Zend_Navigation([
            [
                'route' => 'foo',
                'pages' => [
                    [
                        'route' => 'bar',
                        'pages' => [
                            [
                                'route' => 'baz',
                            ],
                        ],
                    ]
                ]
            ],
        ]);

        $container->removePage($container->findOneBy('route', 'baz'), true);
        $this->assertNull($container->findOneBy('route', 'baz'));
        $container->removePage($container->findOneBy('route', 'bar'), true);
        $this->assertNull($container->findOneBy('route', 'bar'));
    }
}
