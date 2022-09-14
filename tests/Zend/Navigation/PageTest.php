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
require_once 'Zend/Config.php';

/**
 * Tests the class Zend_Navigation_Page
 *
 * @author    Robin Skoglund
 * @category   Zend
 * @package    Zend_Navigation
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Navigation
 */
class Zend_Navigation_PageTest extends PHPUnit_Framework_TestCase
{
    /**
     * Prepares the environment before running a test.
     *
     */
    protected function setUp()
    {

    }

    /**
     * Tear down the environment after running a test
     *
     */
    protected function tearDown()
    {
        // setConfig, setOptions
    }

    public function testSetShouldMapToNativeProperties()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'mvc'
        ]);

        $page->set('action', 'foo');
        $this->assertEquals('foo', $page->getAction());

        $page->set('Action', 'bar');
        $this->assertEquals('bar', $page->getAction());
    }

    public function testGetShouldMapToNativeProperties()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'mvc'
        ]);

        $page->setAction('foo');
        $this->assertEquals('foo', $page->get('action'));

        $page->setAction('bar');
        $this->assertEquals('bar', $page->get('Action'));
    }

    public function testSetShouldNormalizePropertyName()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'mvc'
        ]);

        $page->setResetParams(false);
        $page->set('reset_params', true);
        $this->assertTrue($page->getResetParams());
    }

    public function testGetShouldNormalizePropertyName()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'mvc'
        ]);

        $page->setResetParams(false);
        $this->assertFalse($page->get('reset_params'));
    }

    public function testShouldSetAndGetShouldMapToProperties()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri'
        ]);

        $page->set('action', 'Laughing Out Loud');
        $this->assertEquals('Laughing Out Loud', $page->get('action'));
    }

    public function testSetShouldNotMapToSetOptionsToPreventRecursion()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri',
            'label' => 'foo'
        ]);

        $options = ['label' => 'bar'];
        $page->set('options', $options);

        $this->assertEquals('foo', $page->getLabel());
        $this->assertEquals($options, $page->get('options'));
    }

    public function testSetShouldNotMapToSetConfigToPreventRecursion()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri',
            'label' => 'foo'
        ]);

        $options = ['label' => 'bar'];
        $page->set('config', $options);

        $this->assertEquals('foo', $page->getLabel());
        $this->assertEquals($options, $page->get('config'));
    }

    public function testSetAndGetLabel()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => '#'
        ]);

        $this->assertEquals('foo', $page->getLabel());
        $page->setLabel('bar');
        $this->assertEquals('bar', $page->getLabel());

        $invalids = [42, (object) null];
        foreach ($invalids as $invalid) {
            try {
                $page->setLabel($invalid);
                $this->fail('An invalid value was set, but a ' .
                            'Zend_Navigation_Exception was not thrown');
            } catch (Zend_Navigation_Exception $e) {
                $this->assertContains('Invalid argument: $label', $e->getMessage());
            }
        }
    }

    /**
     * @group ZF-8922
     */
    public function testSetAndGetFragmentIdentifier()
    {
        $page = Zend_Navigation_Page::factory([
            'uri'                => '#',
            'fragment'           => 'foo',
        ]);
        
        $this->assertEquals('foo', $page->getFragment());
        
        $page->setFragment('bar');
        $this->assertEquals('bar', $page->getFragment());
        
        $invalids = [42, (object) null];
        foreach ($invalids as $invalid) {
            try {
                $page->setFragment($invalid);
                $this->fail('An invalid value was set, but a ' .
                            'Zend_Navigation_Exception was not thrown');
            } catch (Zend_Navigation_Exception $e) {
                $this->assertContains(
                    'Invalid argument: $fragment', $e->getMessage()
                );
            }
        }
    } 

    public function testSetAndGetId()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => '#'
        ]);

        $this->assertEquals(null, $page->getId());

        $page->setId('bar');
        $this->assertEquals('bar', $page->getId());

        $invalids = [true, (object) null];
        foreach ($invalids as $invalid) {
            try {
                $page->setId($invalid);
                $this->fail('An invalid value was set, but a ' .
                            'Zend_Navigation_Exception was not thrown');
            } catch (Zend_Navigation_Exception $e) {
                $this->assertContains('Invalid argument: $id', $e->getMessage());
            }
        }
    }

    public function testIdCouldBeAnInteger()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => '#',
            'id' => 10
        ]);

        $this->assertEquals(10, $page->getId());
    }

    public function testSetAndGetClass()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => '#'
        ]);

        $this->assertEquals(null, $page->getClass());
        $page->setClass('bar');
        $this->assertEquals('bar', $page->getClass());

        $invalids = [42, true, (object) null];
        foreach ($invalids as $invalid) {
            try {
                $page->setClass($invalid);
                $this->fail('An invalid value was set, but a ' .
                            'Zend_Navigation_Exception was not thrown');
            } catch (Zend_Navigation_Exception $e) {
                $this->assertContains('Invalid argument: $class', $e->getMessage());
            }
        }
    }

    public function testSetAndGetTitle()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => '#'
        ]);

        $this->assertEquals(null, $page->getTitle());
        $page->setTitle('bar');
        $this->assertEquals('bar', $page->getTitle());

        $invalids = [42, true, (object) null];
        foreach ($invalids as $invalid) {
            try {
                $page->setTitle($invalid);
                $this->fail('An invalid value was set, but a ' .
                            'Zend_Navigation_Exception was not thrown');
            } catch (Zend_Navigation_Exception $e) {
                $this->assertContains('Invalid argument: $title', $e->getMessage());
            }
        }
    }

    public function testSetAndGetTarget()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => '#'
        ]);

        $this->assertEquals(null, $page->getTarget());
        $page->setTarget('bar');
        $this->assertEquals('bar', $page->getTarget());

        $invalids = [42, true, (object) null];
        foreach ($invalids as $invalid) {
            try {
                $page->setTarget($invalid);
                $this->fail('An invalid value was set, but a ' .
                            'Zend_Navigation_Exception was not thrown');
            } catch (Zend_Navigation_Exception $e) {
                $this->assertContains('Invalid argument: $target', $e->getMessage());
            }
        }
    }

    /**
     * @group ZF-9746
     */
    public function testSetAndGetAccesskey()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri'   => '#',
        ]);
        
        $this->assertEquals(null, $page->getAccesskey());
        $page->setAccesskey('b');
        $this->assertEquals('b', $page->getAccesskey());
        
        $invalids = ['bar', 42, true, (object) null];
        foreach ($invalids as $invalid) {
            try {
                $page->setAccesskey($invalid);
                $this->fail('An invalid value was set, but a ' .
                            'Zend_Navigation_Exception was not thrown');
            } catch (Zend_Navigation_Exception $e) {
                $this->assertContains(
                    'Invalid argument: $character',
                    $e->getMessage()
                );
            }
        }
    }

    public function testConstructingWithRelationsInArray()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'bar',
            'uri'   => '#',
            'rel'   => [
                'prev' => 'foo',
                'next' => 'baz'
            ],
            'rev'   => [
                'alternate' => 'bat'
            ]
        ]);

        $expected = [
            'rel'   => [
                'prev' => 'foo',
                'next' => 'baz'
            ],
            'rev'   => [
                'alternate' => 'bat'
            ]
        ];

        $actual = [
            'rel' => $page->getRel(),
            'rev' => $page->getRev()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testConstructingWithRelationsInConfig()
    {
        $page = Zend_Navigation_Page::factory(new Zend_Config([
            'label' => 'bar',
            'uri'   => '#',
            'rel'   => [
                'prev' => 'foo',
                'next' => 'baz'
            ],
            'rev'   => [
                'alternate' => 'bat'
            ]
        ]));

        $expected = [
            'rel'   => [
                'prev' => 'foo',
                'next' => 'baz'
            ],
            'rev'   => [
                'alternate' => 'bat'
            ]
        ];

        $actual = [
            'rel' => $page->getRel(),
            'rev' => $page->getRev()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testGettingSpecificRelations()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'bar',
            'uri'   => '#',
            'rel'   => [
                'prev' => 'foo',
                'next' => 'baz'
            ],
            'rev'   => [
                'next' => 'foo'
            ]
        ]);

        $expected = [
            'foo', 'foo'
        ];

        $actual = [
            $page->getRel('prev'),
            $page->getRev('next')
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testSetAndGetOrder()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => '#'
        ]);

        $this->assertEquals(null, $page->getOrder());

        $page->setOrder('1');
        $this->assertEquals(1, $page->getOrder());

        $page->setOrder(1337);
        $this->assertEquals(1337, $page->getOrder());

        $page->setOrder('-25');
        $this->assertEquals(-25, $page->getOrder());

        $invalids = [3.14, 'e', "\n", '0,4', true, (object) null];
        foreach ($invalids as $invalid) {
            try {
                $page->setOrder($invalid);
                $this->fail('An invalid value was set, but a ' .
                            'Zend_Navigation_Exception was not thrown');
            } catch (Zend_Navigation_Exception $e) {
                $this->assertContains('Invalid argument: $order', $e->getMessage());
            }
        }
    }

    public function testSetResourceString()
    {
        $page = Zend_Navigation_Page::factory([
            'type'  => 'uri',
            'label' => 'hello'
        ]);

        $page->setResource('foo');
        $this->assertEquals('foo', $page->getResource());
    }

    public function testSetResourceNoParam()
    {
        $page = Zend_Navigation_Page::factory([
            'type'     => 'uri',
            'label'    => 'hello',
            'resource' => 'foo'
        ]);

        $page->setResource();
        $this->assertEquals(null, $page->getResource());
    }

    public function testSetResourceNull()
    {
        $page = Zend_Navigation_Page::factory([
            'type'     => 'uri',
            'label'    => 'hello',
            'resource' => 'foo'
        ]);

        $page->setResource(null);
        $this->assertEquals(null, $page->getResource());
    }

    public function testSetResourceInterface()
    {
        $page = Zend_Navigation_Page::factory([
            'type'     => 'uri',
            'label'    => 'hello'
        ]);

        require_once 'Zend/Acl/Resource.php';
        $resource = new Zend_Acl_Resource('bar');

        $page->setResource($resource);
        $this->assertEquals($resource, $page->getResource());
    }

    public function testSetResourceShouldThrowExceptionWhenGivenInteger()
    {
        $page = Zend_Navigation_Page::factory([
            'type'     => 'uri',
            'label'    => 'hello'
        ]);

        try {
            $page->setResource(0);
            $this->fail('An invalid value was set, but a ' .
                        'Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Invalid argument: $resource', $e->getMessage());
        }
    }

    public function testSetResourceShouldThrowExceptionWhenGivenObject()
    {
        $page = Zend_Navigation_Page::factory([
            'type'     => 'uri',
            'label'    => 'hello'
        ]);

        try {
            $page->setResource(new stdClass());
            $this->fail('An invalid value was set, but a ' .
                        'Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Invalid argument: $resource', $e->getMessage());
        }
    }

    public function testSetPrivilegeNoParams()
    {
        $page = Zend_Navigation_Page::factory([
            'type'     => 'uri',
            'label'    => 'hello',
            'privilege' => 'foo'
        ]);

        $page->setPrivilege();
        $this->assertEquals(null, $page->getPrivilege());
    }

    public function testSetPrivilegeNull()
    {
        $page = Zend_Navigation_Page::factory([
            'type'     => 'uri',
            'label'    => 'hello',
            'privilege' => 'foo'
        ]);

        $page->setPrivilege(null);
        $this->assertEquals(null, $page->getPrivilege());
    }

    public function testSetPrivilegeString()
    {
        $page = Zend_Navigation_Page::factory([
            'type'     => 'uri',
            'label'    => 'hello',
            'privilege' => 'foo'
        ]);

        $page->setPrivilege('bar');
        $this->assertEquals('bar', $page->getPrivilege());
    }

    public function testGetActiveOnNewlyConstructedPageShouldReturnFalse()
    {
        $page = new Zend_Navigation_Page_Uri();
        $this->assertFalse($page->getActive());
    }

    public function testIsActiveOnNewlyConstructedPageShouldReturnFalse()
    {
        $page = new Zend_Navigation_Page_Uri();
        $this->assertFalse($page->isActive());
    }

    public function testGetActiveShouldReturnTrueIfPageIsActive()
    {
        $page = new Zend_Navigation_Page_Uri(['active' => true]);
        $this->assertTrue($page->getActive());
    }

    public function testIsActiveShouldReturnTrueIfPageIsActive()
    {
        $page = new Zend_Navigation_Page_Uri(['active' => true]);
        $this->assertTrue($page->isActive());
    }

    public function testIsActiveWithRecursiveTrueShouldReturnTrueIfChildActive()
    {
        $page = new Zend_Navigation_Page_Uri([
            'label'  => 'Page 1',
            'active' => false,
            'pages'  => [
                new Zend_Navigation_Page_Uri([
                    'label'  => 'Page 1.1',
                    'active' => false,
                    'pages'  => [
                        new Zend_Navigation_Page_Uri([
                            'label'  => 'Page 1.1',
                            'active' => true
                        ])
                    ]
                ])
            ]
        ]);

        $this->assertFalse($page->isActive(false));
        $this->assertTrue($page->isActive(true));
    }

    public function testGetActiveWithRecursiveTrueShouldReturnTrueIfChildActive()
    {
        $page = new Zend_Navigation_Page_Uri([
            'label'  => 'Page 1',
            'active' => false,
            'pages'  => [
                new Zend_Navigation_Page_Uri([
                    'label'  => 'Page 1.1',
                    'active' => false,
                    'pages'  => [
                        new Zend_Navigation_Page_Uri([
                            'label'  => 'Page 1.1',
                            'active' => true
                        ])
                    ]
                ])
            ]
        ]);

        $this->assertFalse($page->getActive(false));
        $this->assertTrue($page->getActive(true));
    }

    public function testSetActiveWithNoParamShouldSetFalse()
    {
        $page = new Zend_Navigation_Page_Uri();
        $page->setActive();
        $this->assertTrue($page->getActive());
    }

    public function testSetActiveShouldJuggleValue()
    {
        $page = new Zend_Navigation_Page_Uri();

        $page->setActive(1);
        $this->assertTrue($page->getActive());

        $page->setActive('true');
        $this->assertTrue($page->getActive());

        $page->setActive(0);
        $this->assertFalse($page->getActive());

        $page->setActive([]);
        $this->assertFalse($page->getActive());
    }

    public function testIsVisibleOnNewlyConstructedPageShouldReturnTrue()
    {
        $page = new Zend_Navigation_Page_Uri();
        $this->assertTrue($page->isVisible());
    }

    public function testGetVisibleOnNewlyConstructedPageShouldReturnTrue()
    {
        $page = new Zend_Navigation_Page_Uri();
        $this->assertTrue($page->getVisible());
    }

    public function testIsVisibleShouldReturnFalseIfPageIsNotVisible()
    {
        $page = new Zend_Navigation_Page_Uri(['visible' => false]);
        $this->assertFalse($page->isVisible());
    }

    public function testGetVisibleShouldReturnFalseIfPageIsNotVisible()
    {
        $page = new Zend_Navigation_Page_Uri(['visible' => false]);
        $this->assertFalse($page->getVisible());
    }

    public function testIsVisibleRecursiveTrueShouldReturnFalseIfParentInivisble()
    {
        $page = new Zend_Navigation_Page_Uri([
            'label'  => 'Page 1',
            'visible' => false,
            'pages'  => [
                new Zend_Navigation_Page_Uri([
                    'label'  => 'Page 1.1',
                    'pages'  => [
                        new Zend_Navigation_Page_Uri([
                            'label'  => 'Page 1.1'
                        ])
                    ]
                ])
            ]
        ]);

        $childPage = $page->findOneByLabel('Page 1.1');
        $this->assertTrue($childPage->isVisible(false));
        $this->assertFalse($childPage->isVisible(true));
    }

    public function testGetVisibleRecursiveTrueShouldReturnFalseIfParentInivisble()
    {
        $page = new Zend_Navigation_Page_Uri([
            'label'  => 'Page 1',
            'visible' => false,
            'pages'  => [
                new Zend_Navigation_Page_Uri([
                    'label'  => 'Page 1.1',
                    'pages'  => [
                        new Zend_Navigation_Page_Uri([
                            'label'  => 'Page 1.1'
                        ])
                    ]
                ])
            ]
        ]);

        $childPage = $page->findOneByLabel('Page 1.1');
        $this->assertTrue($childPage->getVisible(false));
        $this->assertFalse($childPage->getVisible(true));
    }

    public function testSetVisibleWithNoParamShouldSetVisble()
    {
        $page = new Zend_Navigation_Page_Uri(['visible' => false]);
        $page->setVisible();
        $this->assertTrue($page->isVisible());
    }

    public function testSetVisibleShouldJuggleValue()
    {
        $page = new Zend_Navigation_Page_Uri();

        $page->setVisible(1);
        $this->assertTrue($page->isVisible());

        $page->setVisible('true');
        $this->assertTrue($page->isVisible());

        $page->setVisible(0);
        $this->assertFalse($page->isVisible());

        /**
         * ZF-10146
         * 
         * @link http://framework.zend.com/issues/browse/ZF-10146
         */
        $page->setVisible('False');
        $this->assertFalse($page->isVisible());

        $page->setVisible([]);
        $this->assertFalse($page->isVisible());
    }

    public function testMagicOverLoadsShouldSetAndGetNativeProperties()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => 'foo'
        ]);

        $this->assertSame('foo', $page->getUri());
        $this->assertSame('foo', $page->uri);

        $page->uri = 'bar';
        $this->assertSame('bar', $page->getUri());
        $this->assertSame('bar', $page->uri);
    }

    public function testMagicOverLoadsShouldCheckNativeProperties()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => 'foo'
        ]);

        $this->assertTrue(isset($page->uri));

        try {
            unset($page->uri);
            $this->fail('Should not be possible to unset native properties');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Unsetting native property', $e->getMessage());
        }
    }

    public function testMagicOverLoadsShouldHandleCustomProperties()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => 'foo'
        ]);

        $this->assertFalse(isset($page->category));

        $page->category = 'music';
        $this->assertTrue(isset($page->category));
        $this->assertSame('music', $page->category);

        unset($page->category);
        $this->assertFalse(isset($page->category));
    }

    public function testMagicToStringMethodShouldReturnLabel()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => '#'
        ]);

        $this->assertEquals('foo', (string) $page);
    }

    public function testSetOptionsShouldTranslateToAccessor()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'action' => 'index',
            'controller' => 'index'
        ]);

        $options = [
            'label' => 'bar',
            'action' => 'baz',
            'controller' => 'bat',
            'module' => 'test',
            'reset_params' => false,
            'id' => 'foo-test'
        ];

        $page->setOptions($options);

        $expected = [
            'label'       => 'bar',
            'action'      => 'baz',
            'controller'  => 'bat',
            'module'      => 'test',
            'resetParams' => false,
            'id'          => 'foo-test'
        ];

        $actual = [
            'label'       => $page->getLabel(),
            'action'      => $page->getAction(),
            'controller'  => $page->getController(),
            'module'      => $page->getModule(),
            'resetParams' => $page->getResetParams(),
            'id'          => $page->getId()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testSetConfig()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'action' => 'index',
            'controller' => 'index'
        ]);

        $options = [
            'label' => 'bar',
            'action' => 'baz',
            'controller' => 'bat',
            'module' => 'test',
            'reset_params' => false,
            'id' => 'foo-test'
        ];

        $page->setConfig(new Zend_Config($options));

        $expected = [
            'label'       => 'bar',
            'action'      => 'baz',
            'controller'  => 'bat',
            'module'      => 'test',
            'resetParams' => false,
            'id'          => 'foo-test'
        ];

        $actual = [
            'label'       => $page->getLabel(),
            'action'      => $page->getAction(),
            'controller'  => $page->getController(),
            'module'      => $page->getModule(),
            'resetParams' => $page->getResetParams(),
            'id'          => $page->getId()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testSetOptionsShouldSetCustomProperties()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => '#'
        ]);

        $options = [
            'test' => 'test',
            'meaning' => 42
        ];

        $page->setOptions($options);

        $actual = [
            'test' => $page->test,
            'meaning' => $page->meaning
        ];

        $this->assertEquals($options, $actual);
    }

    public function testAddingRelations()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'page',
            'uri'   => '#'
        ]);

        $page->addRel('alternate', 'foo');
        $page->addRev('alternate', 'bar');

        $expected = [
            'rel' => ['alternate' => 'foo'],
            'rev' => ['alternate' => 'bar']
        ];

        $actual = [
            'rel' => $page->getRel(),
            'rev' => $page->getRev()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testRemovingRelations()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'page',
            'uri'   => '#'
        ]);

        $page->addRel('alternate', 'foo');
        $page->addRev('alternate', 'bar');
        $page->removeRel('alternate');
        $page->removeRev('alternate');

        $expected = [
            'rel' => [],
            'rev' => []
        ];

        $actual = [
            'rel' => $page->getRel(),
            'rev' => $page->getRev()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testSetRelShouldWorkWithArray()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri',
            'rel'  => [
                'foo' => 'bar',
                'baz' => 'bat'
            ]
        ]);

        $value = ['alternate' => 'format/xml'];
        $page->setRel($value);
        $this->assertEquals($value, $page->getRel());
    }

    public function testSetRelShouldWorkWithConfig()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri',
            'rel'  => [
                'foo' => 'bar',
                'baz' => 'bat'
            ]
        ]);

        $value = ['alternate' => 'format/xml'];
        $page->setRel(new Zend_Config($value));
        $this->assertEquals($value, $page->getRel());
    }

    public function testSetRelShouldWithNoParamsShouldResetRelations()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri',
            'rel'  => [
                'foo' => 'bar',
                'baz' => 'bat'
            ]
        ]);

        $value = [];
        $page->setRel();
        $this->assertEquals($value, $page->getRel());
    }

    public function testSetRelShouldThrowExceptionWhenNotNullOrArrayOrConfig()
    {
        $page = Zend_Navigation_Page::factory(['type' => 'uri']);

        try {
            $page->setRel('alternate');
            $this->fail('An invalid value was set, but a ' .
                        'Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Invalid argument: $relations', $e->getMessage());
        }
    }

    public function testSetRevShouldWorkWithArray()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri',
            'rev'  => [
                'foo' => 'bar',
                'baz' => 'bat'
            ]
        ]);

        $value = ['alternate' => 'format/xml'];
        $page->setRev($value);
        $this->assertEquals($value, $page->getRev());
    }

    public function testSetRevShouldWorkWithConfig()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri',
            'rev'  => [
                'foo' => 'bar',
                'baz' => 'bat'
            ]
        ]);

        $value = ['alternate' => 'format/xml'];
        $page->setRev(new Zend_Config($value));
        $this->assertEquals($value, $page->getRev());
    }

    public function testSetRevShouldWithNoParamsShouldResetRelations()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri',
            'rev'  => [
                'foo' => 'bar',
                'baz' => 'bat'
            ]
        ]);

        $value = [];
        $page->setRev();
        $this->assertEquals($value, $page->getRev());
    }

    public function testSetRevShouldThrowExceptionWhenNotNullOrArrayOrConfig()
    {
        $page = Zend_Navigation_Page::factory(['type' => 'uri']);

        try {
            $page->setRev('alternate');
            $this->fail('An invalid value was set, but a ' .
                        'Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertContains('Invalid argument: $relations', $e->getMessage());
        }
    }

    public function testGetRelWithArgumentShouldRetrieveSpecificRelation()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri',
            'rel'  => [
                'foo' => 'bar'
            ]
        ]);

        $this->assertEquals('bar', $page->getRel('foo'));
    }

    public function testGetRevWithArgumentShouldRetrieveSpecificRelation()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri',
            'rev'  => [
                'foo' => 'bar'
            ]
        ]);

        $this->assertEquals('bar', $page->getRev('foo'));
    }

    public function testGetDefinedRel()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri',
            'rel'  => [
                'alternate' => 'foo',
                'foo' => 'bar'
            ]
        ]);

        $expected = ['alternate', 'foo'];
        $this->assertEquals($expected, $page->getDefinedRel());
    }

    public function testGetDefinedRev()
    {
        $page = Zend_Navigation_Page::factory([
            'type' => 'uri',
            'rev'  => [
                'alternate' => 'foo',
                'foo' => 'bar'
            ]
        ]);

        $expected = ['alternate', 'foo'];
        $this->assertEquals($expected, $page->getDefinedRev());
    }

    public function testGetCustomProperties()
    {
        $page = Zend_Navigation_Page::factory([
            'label' => 'foo',
            'uri' => '#',
            'baz' => 'bat'
        ]);

        $options = [
            'test' => 'test',
            'meaning' => 42
        ];

        $page->setOptions($options);

        $expected = [
            'baz' => 'bat',
            'test' => 'test',
            'meaning' => 42
        ];

        $this->assertEquals($expected, $page->getCustomProperties());
    }

    /**
     * @group ZF-11876
     */
    public function testSetCustomHtmlAttrib()
    {
        $page = Zend_Navigation_Page::factory(
            [
                 'type' => 'uri',
            ]
        );

        $page->setCustomHtmlAttrib('rel', 'nofollow');

        $this->assertEquals('nofollow', $page->getCustomHtmlAttrib('rel'));
    }

    /**
     * @group ZF-11876
     */
    public function testSetCustomHtmlAttribWithNull()
    {
        $page = Zend_Navigation_Page::factory(
            [
                 'type' => 'uri',
            ]
        );

        $page->setCustomHtmlAttrib('rel', 'nofollow');
        $page->setCustomHtmlAttrib('rel', null);

        $this->assertNull($page->getCustomHtmlAttrib('rel'));
    }

    /**
     * @group ZF-11876
     */
    public function testSetCustomHtmlAttribs()
    {
        $page = Zend_Navigation_Page::factory(
            [
                 'type' => 'uri',
            ]
        );

        $attribs = [
             'rel'   => 'nofollow',
             'style' => 'font-weight: bold;',
        ];

        $page->setCustomHtmlAttribs($attribs);

        $this->assertEquals($attribs, $page->getCustomHtmlAttribs());
    }

    /**
     * @group ZF-11876
     */
    public function testRemoveCustomHtmlAttrib()
    {
        $page = Zend_Navigation_Page::factory(
            [
                 'type' => 'uri',
            ]
        );

        $page->setCustomHtmlAttrib('rel', 'nofollow');
        $page->removeCustomHtmlAttrib('rel');

        $this->assertEquals([], $page->getCustomHtmlAttribs());
    }

    /**
     * @group ZF-11876
     */
    public function testClearCustomHtmlAttribs()
    {
        $page = Zend_Navigation_Page::factory(
            [
                 'type' => 'uri',
            ]
        );

        $page->setCustomHtmlAttribs(
            [
                 'rel'   => 'nofollow',
                 'style' => 'font-weight: bold;',
            ]
        );

        $page->clearCustomHtmlAttribs();

        $this->assertEquals([], $page->getCustomHtmlAttribs());
    }

    public function testToArrayMethod()
    {
        $options = [
            'label'    => 'foo',
            'uri'      => 'http://www.example.com/foo.html',
            'fragment' => 'bar',
            'id'       => 'my-id',
            'class'    => 'my-class',
            'title'    => 'my-title',
            'target'   => 'my-target',
            'accesskey' => 'f',
            'rel'      => [],
            'rev'      => [],
            'order'    => 100,
            'active'   => true,
            'visible'  => false,

            'resource' => 'joker',
            'privilege' => null,

            'foo'      => 'bar',
            'meaning'  => 42,

            'pages'    => [
                [
                    'label' => 'foo.bar',
                    'uri'   => 'http://www.example.com/foo.html',
                    'fragment' => null,
                    'id' => null,
                    'class' => null,
                    'title' => null,
                    'target' => null,
                    'accesskey' => null,
                    'rel' => [],
                    'rev' => [],
                    'customHtmlAttribs' => [],
                    'order' => null,
                    'resource' => null,
                    'privilege' => null,
                    'active' => false,
                    'visible' => true,
                    'type' => 'Zend_Navigation_Page_Uri',
                    'pages' => [],
                ],
                [
                    'label' => 'foo.baz',
                    'uri'   => 'http://www.example.com/foo.html',
                    'fragment' => null,
                    'id' => null,
                    'class' => null,
                    'title' => null,
                    'target' => null,
                    'accesskey' => null,
                    'rel' => [],
                    'rev' => [],
                    'customHtmlAttribs' => [],
                    'order' => null,
                    'resource' => null,
                    'privilege' => null,
                    'active' => false,
                    'visible' => true,
                    'type' => 'Zend_Navigation_Page_Uri',
                    'pages' => [],
                ]
            ],

            'customHtmlAttribs' => [
                'rel'   => 'nofollow',
                'style' => 'font-weight: bold;',
            ],
        ];

        $page = Zend_Navigation_Page::factory($options);
        $toArray = $page->toArray();

        // tweak options to what we expect toArray() to contain
        $options['type'] = 'Zend_Navigation_Page_Uri';

        // should be same
        $this->assertEquals($options, $toArray);

        // $toArray should have 2 sub pages
        $this->assertEquals(2, count($toArray['pages']));

        // tweak options to what we expect sub page 1 to be
        $options['label'] = 'foo.bar';
        $options['fragment'] = null;
        $options['order'] = null;
        $options['id'] = null;
        $options['class'] = null;
        $options['title'] = null;
        $options['target'] = null;
        $options['accesskey'] = null;
        $options['resource'] = null;
        $options['active'] = false;
        $options['visible'] = true;
        $options['customHtmlAttribs'] = [];
        $options['pages'] = [];
        unset($options['foo']);
        unset($options['meaning']);

        // assert that there is no diff from what we expect
        $this->assertEquals($options, $toArray['pages'][0]);

        // tweak options to what we expect sub page 2 to be
        $options['label'] = 'foo.baz';

        // assert that there is no diff from what we expect
        $this->assertEquals($options, $toArray['pages'][1]);
    }
    
    /**
     * @group ZF-11805
     */
    public function testFactoryExceptionWhenNoPageTypeDetected()
    {
        // Without label
        try {
            $page = Zend_Navigation_Page::factory([]);
            $this->fail('An invalid value was set, but a ' .
                        'Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertSame(
                'Invalid argument: Unable to determine class to instantiate', 
                $e->getMessage()
            );
}
        
        // With label
        try {
            $page = Zend_Navigation_Page::factory([
                'label' => 'Foo',
            ]);
            $this->fail('An invalid value was set, but a ' .
                        'Zend_Navigation_Exception was not thrown');
        } catch (Zend_Navigation_Exception $e) {
            $this->assertSame(
                'Invalid argument: Unable to determine class to instantiate'
                . ' (Page label: Foo)', 
                $e->getMessage()
            );
        }
    }
}
