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
 * @package    Zend_Controller
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Controller_Router_Route_ChainTest::main');
}

/** Zend_Config */
require_once 'Zend/Config.php';

/** Zend_Controller_Router_Rewrite */
require_once 'Zend/Controller/Router/Rewrite.php';

/** Zend_Controller_Dispatcher_Standard */
require_once 'Zend/Controller/Dispatcher/Standard.php';

/** Zend_Controller_Router_Route_Chain */
require_once 'Zend/Controller/Router/Route/Chain.php';

/** Zend_Controller_Router_Route */
require_once 'Zend/Controller/Router/Route.php';

/** Zend_Controller_Router_Route_Module */
require_once 'Zend/Controller/Router/Route/Module.php';

/** Zend_Controller_Router_Route_Static */
require_once 'Zend/Controller/Router/Route/Static.php';

/** Zend_Controller_Router_Route_Regex */
require_once 'Zend/Controller/Router/Route/Regex.php';

/** Zend_Controller_Router_Route_Hostname */
require_once 'Zend/Controller/Router/Route/Hostname.php';

/** Zend_Controller_Request_Http */
require_once 'Zend/Controller/Request/Http.php';

/** Zend_Uri_Http */
require_once 'Zend/Uri/Http.php';

/** Zend_Config */
require_once 'Zend/Config.php';

/**
 * @category   Zend
 * @package    Zend_Controller
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Controller
 * @group      Zend_Controller_Router
 */
class Zend_Controller_Router_Route_ChainTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main()
    {

        $suite  = new PHPUnit_Framework_TestSuite("Zend_Controller_Router_Route_ChainTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function testChaining()
    {
        $request = new Zend_Controller_Router_ChainTest_Request('http://localhost/foo/bar');

        $foo = new Zend_Controller_Router_Route('foo');
        $bar = new Zend_Controller_Router_Route('bar');

        $chain = $foo->chain($bar);

        $this->assertTrue($chain instanceof Zend_Controller_Router_Route_Chain);
    }

    public function testChainingMatch()
    {
        $chain = new Zend_Controller_Router_Route_Chain();
        $foo = new Zend_Controller_Router_Route_Hostname('www.zend.com', ['foo' => 1]);
        $bar = new Zend_Controller_Router_Route_Static('bar', ['bar' => 2]);

        $chain->chain($foo)->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/bla');
        $res = $chain->match($request);

        $this->assertFalse($res);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/bar');
        $res = $chain->match($request);

        $this->assertEquals(1, $res['foo']);
        $this->assertEquals(2, $res['bar']);
    }

    /**
     * @group ZF-8812
     */
    public function testChainingMatchToDefaultValues()
    {
        $foo = new Zend_Controller_Router_Route(
            ':foo',
            ['foo' => 'bar'],
            ['foo' => '[a-z]{3}']
        );

        $bar = new Zend_Controller_Router_Route_Module([
            'module' => 0,
            'controller' => 1,
            'action' => 2
        ]);

        $chain = $foo->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/');
        $res = $chain->match($request);

        $this->assertTrue(is_array($res), 'Route did not match to default values.');
    }

    public function testChainingShortcutMatch()
    {
        $foo = new Zend_Controller_Router_Route_Hostname('www.zend.com', ['foo' => 1]);
        $bar = new Zend_Controller_Router_Route_Static('bar', ['bar' => 2, 'controller' => 'foo', 'action' => 'bar']);

        $chain = $foo->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/bar');
        $res = $chain->match($request);

        $this->assertEquals(1, $res['foo']);
        $this->assertEquals(2, $res['bar']);
    }

    public function testChainingMatchFailure()
    {
        $foo = new Zend_Controller_Router_Route_Hostname('www.zend.com', ['foo' => 1]);
        $bar = new Zend_Controller_Router_Route_Static('bar', ['bar' => 2, 'controller' => 'foo', 'action' => 'bar']);

        $chain = $foo->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://nope.zend.com/bar');
        $res = $chain->match($request);

        $this->assertFalse($res);
    }

    public function testChainingVariableOverriding()
    {
        $foo = new Zend_Controller_Router_Route_Hostname('www.zend.com', ['foo' => 1, 'controller' => 'foo', 'module' => 'foo']);
        $bar = new Zend_Controller_Router_Route('bar', ['bar' => 2, 'controller' => 'bar', 'action' => 'bar']);

        $chain = $foo->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/bar');
        $res = $chain->match($request);

        $this->assertEquals('foo', $res['module']);
        $this->assertEquals('bar', $res['controller']);
        $this->assertEquals('bar', $res['action']);
    }

    public function testChainingTooLongPath()
    {
        $foo = new Zend_Controller_Router_Route_Static('foo', ['foo' => 1]);
        $bar = new Zend_Controller_Router_Route_Static('bar', ['bar' => 2]);

        $chain = $foo->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/foo/bar/baz');
        $res = $chain->match($request);

        $this->assertFalse($res);
    }

    public function testChainingRegex()
    {
        $foo = new Zend_Controller_Router_Route_Regex('f..', ['foo' => 1]);
        $bar = new Zend_Controller_Router_Route_Regex('b..', ['bar' => 2]);

        $chain = $foo->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/foo/bar');
        $res = $chain->match($request);

        $this->assertEquals(1, $res['foo']);
        $this->assertEquals(2, $res['bar']);
    }

    public function testChainingModule()
    {
        $foo = new Zend_Controller_Router_Route_Static('foo', ['foo' => 'bar']);
        $bar = new Zend_Controller_Router_Route_Module();

        $chain = $foo->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/foo/bar/baz/var/val');
        $res = $chain->match($request);

        $this->assertEquals('bar', $res['foo']);
        $this->assertEquals('bar', $res['controller']);
        $this->assertEquals('baz', $res['action']);
        $this->assertEquals('val', $res['var']);
    }

    public function testVariableOmittingWhenPartial()
    {
        $foo = new Zend_Controller_Router_Route(':foo', ['foo' => 'foo']);
        $bar = new Zend_Controller_Router_Route(':bar', ['bar' => 'bar']);

        $chain = $foo->chain($bar);

        $path = $chain->assemble([]);

        $this->assertEquals('foo/', $path);
    }

    public function testVariableUnsettingRoute()
    {
        $foo = new Zend_Controller_Router_Route(':foo');
        $bar = new Zend_Controller_Router_Route_Module(['controller' => 'ctrl', 'action' => 'act']);

        $chain = $foo->chain($bar);

        $path = $chain->assemble(['foo' => 'bar', 'baz' => 'bat']);

        $this->assertEquals('bar/ctrl/act/baz/bat', $path);
    }

    public function testVariableUnsettingRegex()
    {
        $foo = new Zend_Controller_Router_Route_Regex('([^/]+)', [], [1 => 'foo'], '%s');
        $bar = new Zend_Controller_Router_Route_Module(['controller' => 'ctrl', 'action' => 'act']);

        $chain = $foo->chain($bar);

        $path = $chain->assemble(['foo' => 'bar', 'baz' => 'bat']);

        $this->assertEquals('bar/ctrl/act/baz/bat', $path);
    }

    public function testChainingSeparatorOverriding()
    {
        $foo = new Zend_Controller_Router_Route_Static('foo', ['foo' => 1]);
        $bar = new Zend_Controller_Router_Route_Static('bar', ['bar' => 2]);
        $baz = new Zend_Controller_Router_Route_Static('baz', ['baz' => 3]);

        $chain = $foo->chain($bar, '.');

        $res = $chain->match(new Zend_Controller_Router_ChainTest_Request('http://localhost/foo.bar'));

        $this->assertTrue(is_array($res));

        $res = $chain->match(new Zend_Controller_Router_ChainTest_Request('http://localhost/foo/bar'));
        $this->assertEquals(false, $res);

        $chain->chain($baz, ':');

        $res = $chain->match(new Zend_Controller_Router_ChainTest_Request('http://localhost/foo.bar:baz'));
        $this->assertTrue(is_array($res));
    }

    public function testI18nChaining()
    {
        $lang = new Zend_Controller_Router_Route(':lang', ['lang' => 'en']);
        $profile = new Zend_Controller_Router_Route('user/:id', ['controller' => 'foo', 'action' => 'bar']);

        $chain = $lang->chain($profile);

        $res = $chain->match(new Zend_Controller_Router_ChainTest_Request('http://localhost/en/user/1'));

        $this->assertEquals('en', $res['lang']);
        $this->assertEquals('1', $res['id']);
    }

    public function testChainingAssembleWithRoutePlaceholder()
    {
        $chain = new Zend_Controller_Router_Route_Chain();

        $foo = new Zend_Controller_Router_Route_Hostname(':account.zend.com');
        $bar = new Zend_Controller_Router_Route('bar/*');

        $chain->chain($foo)->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://foobar.zend.com/bar');
        $res = $chain->match($request);

        $this->assertTrue(is_array($res));
        $this->assertRegexp('#[^a-z0-9]?foobar\.zend\.com/bar/foo/bar#i', $chain->assemble(['account' => 'foobar', 'foo' => 'bar']));
    }

    public function testChainingAssembleWithStatic()
    {
        $chain = new Zend_Controller_Router_Route_Chain();

        $foo = new Zend_Controller_Router_Route_Hostname('www.zend.com', ['foo' => 'foo']);
        $bar = new Zend_Controller_Router_Route_Static('bar', ['bar' => 'bar']);

        $chain->chain($foo)->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/bar');
        $res = $chain->match($request);

        $this->assertTrue(is_array($res));
        $this->assertRegexp('#[^a-z0-9]?www\.zend\.com/bar$#i', $chain->assemble());
    }

    public function testChainingAssembleWithRegex()
    {
        $chain = new Zend_Controller_Router_Route_Chain();

        $foo = new Zend_Controller_Router_Route_Hostname('www.zend.com', ['foo' => 'foo']);
        $bar = new Zend_Controller_Router_Route_Regex('bar', ['bar' => 'bar'], [], 'bar');

        $chain->chain($foo)->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/bar');
        $res = $chain->match($request);

        $this->assertTrue(is_array($res));
        $this->assertRegexp('#[^a-z0-9]?www\.zend\.com/bar$#i', $chain->assemble());
    }

    public function testChainingReuse()
    {
        $foo = new Zend_Controller_Router_Route_Hostname('www.zend.com', ['foo' => 'foo']);
        $profile = new Zend_Controller_Router_Route('user/:id', ['controller' => 'prof']);
        $article = new Zend_Controller_Router_Route('article/:id', ['controller' => 'art', 'action' => 'art']);

        $profileChain = $foo->chain($profile);
        $articleChain = $foo->chain($article);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/user/1');
        $res = $profileChain->match($request);

        $this->assertTrue(is_array($res));
        $this->assertEquals('prof', $res['controller']);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/article/1');
        $res = $articleChain->match($request);

        $this->assertTrue(is_array($res));
        $this->assertEquals('art', $res['controller']);
        $this->assertEquals('art', $res['action']);
    }

    public function testConfigChaining()
    {
        $routes = [

            /** Abstract routes */

            'www' => [
                'type'  => 'Zend_Controller_Router_Route_Hostname',
                'route' => 'www.example.com',
                'abstract' => true
            ],
            'user' => [
                'type'  => 'Zend_Controller_Router_Route_Hostname',
                'route' => 'user.example.com',
                'abstract' => true
            ],
            'index' => [
                'type'  => 'Zend_Controller_Router_Route_Static',
                'route' => '',
                'abstract' => true,
                'defaults' => [
                    'module'     => 'default',
                    'controller' => 'index',
                    'action'     => 'index'
                ]
            ],
            'imprint' => [
                'type'  => 'Zend_Controller_Router_Route_Static',
                'route' => 'imprint',
                'abstract' => true,
                'defaults' => [
                    'module'     => 'default',
                    'controller' => 'index',
                    'action'     => 'imprint'
                ]
            ],
            'profile' => [
                'type'  => 'Zend_Controller_Router_Route_Static',
                'route' => 'profile',
                'abstract' => true,
                'defaults' => [
                    'module'     => 'user',
                    'controller' => 'profile',
                    'action'     => 'index'
                ]
            ],
            'profile-edit' => [
                'type'  => 'Zend_Controller_Router_Route_Static',
                'route' => 'profile/edit',
                'abstract' => true,
                'defaults' => [
                    'module'     => 'user',
                    'controller' => 'profile',
                    'action'     => 'edit'
                ]
            ],

            /** Chains */

            'www-index' => [
                'type'  => 'Zend_Controller_Router_Route_Chain',
                'chain' => 'www, index' // or array('www-subdomain', 'index'); / maybe both
            ],
            'www-imprint' => [
                'type'  => 'Zend_Controller_Router_Route_Chain',
                'chain' => 'www, imprint'
            ],
            'user-index' => [
                'type'  => 'Zend_Controller_Router_Route_Chain',
                'chain' => 'user, index'
            ],
            'user-profile' => [
                'type'  => 'Zend_Controller_Router_Route_Chain',
                'chain' => 'user, profile'
            ],
            'user-profile-edit' => [
                'type'  => 'Zend_Controller_Router_Route_Chain',
                'chain' => 'user, profile-edit'
            ]
        ];

        $router = new Zend_Controller_Router_Rewrite();
        $front = Zend_Controller_Front::getInstance();
        $front->resetInstance();
        $front->setDispatcher(new Zend_Controller_Router_ChainTest_Dispatcher());
        $front->setRequest(new Zend_Controller_Router_ChainTest_Request());
        $router->setFrontController($front);

        $router->addConfig(new Zend_Config($routes));

        $request = new Zend_Controller_Router_ChainTest_Request('http://user.example.com/profile');
        $token   = $router->route($request);

        $this->assertEquals('user',    $token->getModuleName());
        $this->assertEquals('profile', $token->getControllerName());
        $this->assertEquals('index',   $token->getActionName());

        $request = new Zend_Controller_Router_ChainTest_Request('http://foo.example.com/imprint');
        $token   = $router->route($request);

        $this->assertEquals('default', $token->getModuleName());
        $this->assertEquals('imprint', $token->getControllerName());
        $this->assertEquals('defact',  $token->getActionName());
    }

    public function testConfigChainingAlternative()
    {
        $routes = [
            'www' => [
                'type'  => 'Zend_Controller_Router_Route_Hostname',
                'route' => 'www.example.com',
                'chains' => [
                    'index' => [
                        'type'  => 'Zend_Controller_Router_Route_Static',
                        'route' => '',
                        'defaults' => [
                            'module'     => 'default',
                            'controller' => 'index',
                            'action'     => 'index'
                        ]
                    ],
                    'imprint' => [
                        'type'  => 'Zend_Controller_Router_Route_Static',
                        'route' => 'imprint',
                        'defaults' => [
                            'module'     => 'default',
                            'controller' => 'index',
                            'action'     => 'imprint'
                        ]
                    ],
                ]
            ],
            'user' => [
                'type'  => 'Zend_Controller_Router_Route_Hostname',
                'route' => 'user.example.com',
                'chains' => [
                    'profile' => [
                        'type'  => 'Zend_Controller_Router_Route_Static',
                        'route' => 'profile',
                        'defaults' => [
                            'module'     => 'user',
                            'controller' => 'profile',
                            'action'     => 'index'
                        ],
                        'chains' => [
                            'standard' => [
                                'type'  => 'Zend_Controller_Router_Route_Static',
                                'route' => 'standard2',
                                'defaults' => [
                                    'mode' => 'standard'
                                ]
                            ],
                            'detail' => [
                                'type'  => 'Zend_Controller_Router_Route_Static',
                                'route' => 'detail',
                                'defaults' => [
                                    'mode' => 'detail'
                                ]
                            ]
                        ]
                    ],
                    'profile-edit' => [
                        'type'  => 'Zend_Controller_Router_Route_Static',
                        'route' => 'profile/edit',
                        'defaults' => [
                            'module'     => 'user',
                            'controller' => 'profile',
                            'action'     => 'edit'
                        ]
                    ],
                ]
            ],
        ];

        $router = $this->_getRouter();
        $router->addConfig(new Zend_Config($routes));

        $request = new Zend_Controller_Router_ChainTest_Request('http://user.example.com/profile/edit');
        $token   = $router->route($request);

        $this->assertEquals('user',    $token->getModuleName());
        $this->assertEquals('profile', $token->getControllerName());
        $this->assertEquals('edit',    $token->getActionName());

        $request = new Zend_Controller_Router_ChainTest_Request('http://user.example.com/profile/detail');
        $token   = $router->route($request);

        $this->assertEquals('user',    $token->getModuleName());
        $this->assertEquals('profile', $token->getControllerName());
        $this->assertEquals('index',   $token->getActionName());
        $this->assertEquals('detail',  $token->getParam('mode'));

        $request = new Zend_Controller_Router_ChainTest_Request('http://user.example.com/profile');
        $token   = $router->route($request);
    }


    public function testConfigChainingMixed()
    {
        $routes = [
            'index' => [
                'type'  => 'Zend_Controller_Router_Route_Static',
                'route' => '',
                'defaults' => [
                    'module'     => 'default',
                    'controller' => 'index',
                    'action'     => 'index'
                ]
            ],
            'www' => [
                'type'  => 'Zend_Controller_Router_Route_Hostname',
                'route' => 'www.example.com',
                'chains' => [
                    'index',
                    'imprint' => [
                        'type'  => 'Zend_Controller_Router_Route_Static',
                        'route' => 'imprint',
                        'defaults' => [
                            'module'     => 'default',
                            'controller' => 'index',
                            'action'     => 'imprint'
                        ]
                    ],
                ]
            ],
            'user' => [
                'type'  => 'Zend_Controller_Router_Route_Hostname',
                'route' => 'user.example.com',
                'chains' => [
                    'index',
                    'profile' => [
                        'type'  => 'Zend_Controller_Router_Route_Static',
                        'route' => 'profile',
                        'defaults' => [
                            'module'     => 'user',
                            'controller' => 'profile',
                            'action'     => 'index'
                        ]
                    ],
                    'profile-edit' => [
                        'type'  => 'Zend_Controller_Router_Route_Static',
                        'route' => 'profile/edit',
                        'defaults' => [
                            'module'     => 'user',
                            'controller' => 'profile',
                            'action'     => 'edit'
                        ]
                    ],
                ]
            ],
        ];

        $router = $this->_getRouter();

        $router->addConfig(new Zend_Config($routes));

        $request = new Zend_Controller_Router_ChainTest_Request('http://user.example.com');
        $token   = $router->route($request);

        $this->assertEquals('default',    $token->getModuleName());
        $this->assertEquals('index', $token->getControllerName());
        $this->assertEquals('index',   $token->getActionName());

        $this->assertTrue($router->getRoute('user-profile') instanceof Zend_Controller_Router_Route_Chain);
        $this->assertTrue($router->getRoute('www-imprint') instanceof Zend_Controller_Router_Route_Chain);
        $this->assertTrue($router->getRoute('www-index') instanceof Zend_Controller_Router_Route_Chain);
        $this->assertTrue($router->getRoute('www-index') instanceof Zend_Controller_Router_Route_Chain);
    }

    public function testChainingWorksWithWildcardAndNoParameters()
    {
        $foo = new Zend_Controller_Router_Route_Hostname('www.zend.com', ['module' => 'simple', 'controller' => 'bar', 'action' => 'bar']);
        $bar = new Zend_Controller_Router_Route(':controller/:action/*', ['controller' => 'index', 'action' => 'index']);

        $chain = $foo->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/foo/bar/');
        $res = $chain->match($request);

        $this->assertEquals('simple', $res['module']);
        $this->assertEquals('foo', $res['controller']);
        $this->assertEquals('bar', $res['action']);
    }

    public function testChainingWorksWithWildcardAndOneParameter()
    {
        $foo = new Zend_Controller_Router_Route_Hostname('www.zend.com', ['module' => 'simple', 'controller' => 'foo', 'action' => 'bar']);
        $bar = new Zend_Controller_Router_Route(':controller/:action/*', ['controller' => 'index', 'action' => 'index']);

        $chain = $foo->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/foo/bar/id/12');
        $res = $chain->match($request);

        $this->assertEquals('simple', $res['module']);
        $this->assertEquals('foo', $res['controller']);
        $this->assertEquals('bar', $res['action']);
    }

    /**
     * @group ZF-7848
     */
    public function testChainingWithEmptyStaticRoutesMatchesCorrectly()
    {
        $adminRoute = new Zend_Controller_Router_Route('admin', [
            'module'     => 'admin',
            'controller' => 'index',
            'action'     => 'index',
        ]);
        $indexRoute = new Zend_Controller_Router_Route_Static('', [
            'module'     => 'admin',
            'controller' => 'index',
            'action'     => 'index',
        ]);
        $loginRoute = new Zend_Controller_Router_Route('login', [
            'module'     => 'admin',
            'controller' => 'login',
            'action'     => 'index',
        ]);
        $emptyRoute    = $adminRoute->chain($indexRoute);
        $nonEmptyRoute = $adminRoute->chain($loginRoute);

        $request = new Zend_Controller_Request_Http();
        $request->setPathInfo('/admin');
        $values = $emptyRoute->match($request);
        $this->assertEquals([
            'module'     => 'admin',
            'controller' => 'index',
            'action'     => 'index',
        ], $values);

        $request->setPathInfo('/admin/');
        $values = $emptyRoute->match($request);
        $this->assertEquals([
            'module'     => 'admin',
            'controller' => 'index',
            'action'     => 'index',
        ], $values);

        $request->setPathInfo('/admin/login');
        $values = $nonEmptyRoute->match($request);
        $this->assertEquals([
            'module'     => 'admin',
            'controller' => 'login',
            'action'     => 'index',
        ], $values);
    }

    /**
     * @group ZF-7848
     */
    public function testChainingWithConfiguredEmptyStaticRoutesMatchesCorrectly()
    {
        $routes = [
            'admin' => [
                'route' => 'admin',
                'defaults' => [
                    'module'     => 'admin',
                    'controller' => 'index',
                    'action'     => 'index',
                ],
                'chains' => [
                    'index' => [
                        'type'  => 'Zend_Controller_Router_Route_Static',
                        'route' => '',
                        'defaults' => [
                            'module'     => 'admin',
                            'controller' => 'index',
                            'action'     => 'index',
                        ],
                    ],
                    'login' => [
                        'route' => 'login',
                        'defaults' => [
                            'module'     => 'admin',
                            'controller' => 'login',
                            'action'     => 'index',
                        ],
                    ],

                ],
            ],
        ];
        $config = new Zend_Config($routes);
        $rewrite = new Zend_Controller_Router_Rewrite();
        $rewrite->addConfig($config);
        $routes = $rewrite->getRoutes();
        $indexRoute = $rewrite->getRoute('admin-index');
        $loginRoute = $rewrite->getRoute('admin-login');

        $request = new Zend_Controller_Request_Http();
        $request->setPathInfo('/admin');
        $values = $indexRoute->match($request);
        $this->assertEquals([
            'module'     => 'admin',
            'controller' => 'index',
            'action'     => 'index',
        ], $values);

        $request->setPathInfo('/admin/');
        $values = $indexRoute->match($request);
        $this->assertEquals([
            'module'     => 'admin',
            'controller' => 'index',
            'action'     => 'index',
        ], $values);

        $request->setPathInfo('/admin/login');
        $values = $loginRoute->match($request);
        $this->assertEquals([
            'module'     => 'admin',
            'controller' => 'login',
            'action'     => 'index',
        ], $values);
    }

    /**
     * @group ZF-7368
     */
    public function testChainingStaticDynamicMatchToDefaults()
    {
        $foo = new Zend_Controller_Router_Route_Static('foo');
        $bar = new Zend_Controller_Router_Route(':bar', ['bar' => 0]);
        $chain = $foo->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/foo');
        $res = $chain->match($request);

        $this->assertTrue(is_array($res), 'Route did not match');
        $this->assertEquals(0, $res['bar']);
    }

    /**
     * @group ZF-7368
     */
    public function testChainingStaticDynamicMatchToParams()
    {
        $foo = new Zend_Controller_Router_Route_Static('foo');
        $bar = new Zend_Controller_Router_Route(':bar', ['bar' => 1]);
        $chain = $foo->chain($bar);

        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/foo/2');
        $res = $chain->match($request);

        $this->assertTrue(is_array($res), 'Route did not match');
        $this->assertEquals(2, $res['bar']);
    }

    public function testMultipleChainsWithVersion2Routes()
    {

        $foo = new Zend_Controller_Router_Route_SubclassTest('foo');
        $bar = new Zend_Controller_Router_Route_SubclassTest('bar', ['baz' => 'no']);


        $chain = $foo->chain($bar);

        $foo2 = new Zend_Controller_Router_Route_SubclassTest('foo');
        $baz = new Zend_Controller_Router_Route_SubclassTest('baz', ['baz' => 'baz']);

        $chain2 = $foo2->chain($baz);

        $rewrite = new Zend_Controller_Router_Rewrite();
        $rewrite->addRoute('chain2', $chain2); // First In Last Out, we want this to be matched against second
        $rewrite->addRoute('chain1', $chain);
        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/foo/baz');

        $res = $rewrite->route($request);
        $this->assertEquals('baz', $res->getParam('baz'), 'Route did not match');
        $this->assertEquals('chain2', $rewrite->getCurrentRouteName(), 'Routing did not match expected route');
    }

    /**
     * @throws Zend_Controller_Router_Exception
     */
    public function testMultipleChainsResettingPathInfoInSegmentBlock()
    {
        $foo = new Zend_Controller_Router_Route_SubclassTest('notfoo');
        $bar = new Zend_Controller_Router_Route_SubclassTest('bar', ['baz' => 'no']);


        $chain = $foo->chain($bar);

        $static = new Zend_Controller_Router_Route_SimpleSubclassTest('/foo', ['foo' => 'foo']);

        $rewrite = new Zend_Controller_Router_Rewrite();
        $rewrite->addRoute('static', $static); // First In Last Out, we want this to be matched against second
        $rewrite->addRoute('chain', $chain);
        $request = new Zend_Controller_Router_ChainTest_Request('http://www.zend.com/foo');

        $res = $rewrite->route($request);
        $this->assertEquals('foo', $res->getParam('foo'), 'Route did not match');
        $this->assertEquals('static', $rewrite->getCurrentRouteName(), 'Routing did not match expected route');

    }

    /**
     * @group ZF-11443
     */
    public function testGetDefault()
    {
        // Create chained route
        $chain = new Zend_Controller_Router_Route_Chain();

        $foo = new Zend_Controller_Router_Route_Hostname(
            'www.example.com', ['foo' => 'foo']
        );
        $bar = new Zend_Controller_Router_Route_Regex(
            'bar', ['bar' => 'bar'], [], 'bar'
        );
        $baz = new Zend_Controller_Router_Route_Static(
            'baz', ['baz' => 'baz']
        );

        $chain->chain($foo)->chain($bar)->chain($baz);

        // Test
        $this->assertSame('foo', $chain->getDefault('foo'));
        $this->assertSame('bar', $chain->getDefault('bar'));
        $this->assertSame('baz', $chain->getDefault('baz'));
    }

    /**
     * @group ZF-11443
     */
    public function testGetDefaultPriority()
    {
        // Create chained route
        $chain = new Zend_Controller_Router_Route_Chain();

        $foo = new Zend_Controller_Router_Route_Hostname(
            'www.example.com', ['priority' => 1]
        );
        $bar = new Zend_Controller_Router_Route_Regex(
            'bar', ['priority' => 2], [], 'bar'
        );
        $baz = new Zend_Controller_Router_Route_Static(
            'baz', ['priority' => 3]
        );

        $chain->chain($foo)->chain($bar)->chain($baz);

        // Test
        $this->assertSame(3, $chain->getDefault('priority'));
    }

    /**
     * @group ZF-11443
     */
    public function testGetDefaults()
    {
        // Create chained route
        $chain = new Zend_Controller_Router_Route_Chain();

        $foo = new Zend_Controller_Router_Route_Hostname(
            'www.example.com', ['foo' => 'foo']
        );
        $bar = new Zend_Controller_Router_Route_Regex(
            'bar', ['bar' => 'bar'], [], 'bar'
        );
        $baz = new Zend_Controller_Router_Route_Static(
            'baz', ['baz' => 'baz']
        );

        $chain->chain($foo)->chain($bar)->chain($baz);

        // Get defaults
        $values = $chain->getDefaults();

        // Test
        $this->assertTrue(is_array($values));
        $this->assertSame('foo', $values['foo']);
        $this->assertSame('bar', $values['bar']);
        $this->assertSame('baz', $values['baz']);
    }

    /**
     * @group ZF-11443
     */
    public function testGetDefaultsPriority()
    {
        // Create chained route
        $chain = new Zend_Controller_Router_Route_Chain();

        $foo = new Zend_Controller_Router_Route_Hostname(
            'www.zend.com', ['priority' => 1]
        );
        $bar = new Zend_Controller_Router_Route_Regex(
            'bar', ['priority' => 2], [], 'bar'
        );
        $baz = new Zend_Controller_Router_Route_Static(
            'baz', ['priority' => 3]
        );

        $chain->chain($foo)->chain($bar)->chain($baz);

        // Get defaults
        $values = $chain->getDefaults();

        // Test
        $this->assertSame(3, $values['priority']);
    }

    protected function _getRouter()
    {
        $router = new Zend_Controller_Router_Rewrite();
        $front = Zend_Controller_Front::getInstance();
        $front->resetInstance();
        $front->setRequest(new Zend_Controller_Router_ChainTest_Request());
        $router->setFrontController($front);

        return $router;
    }
}

class Zend_Controller_Router_Route_SimpleSubclassTest extends Zend_Controller_Router_Route_Abstract
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $params = [];

    public function __construct($path, $params)
    {
        $this->path = $path;
        $this->params = $params;
    }

    public function match($path, $partial = false)
    {
        $path = $path->getPathInfo();
        if ($path == $this->path) {
            $this->setMatchedPath($this->path);
            return $this->params;
        }
        return false;
    }

    public function getVersion()
    {
        return 2;
    }

    public function assemble($data = [], $reset = false, $encode = false)
    {}

    public static function getInstance(Zend_Config $config)
    {}

}

class Zend_Controller_Router_Route_SubclassTest extends Zend_Controller_Router_Route_Static
{
    public function match($path, $partial = false)
    {
        $path = $path->getPathInfo();
        $match = parent::match($path, $partial);
        if (is_array($match)) {
            $this->setMatchedPath($this->_route);
        }
        return $match;
    }

    public function getVersion()
    {
        return 2;
    }

    public function assemble($data = [], $reset = false, $encode = false)
    {}

    public static function getInstance(Zend_Config $config)
    {}

}

/**
 * Zend_Controller_Router_ChainTest_Request - request object for router testing
 *
 * @uses Zend_Controller_Request_Interface
 */
class Zend_Controller_Router_ChainTest_Request extends Zend_Controller_Request_Http
{
    protected $_host;
    protected $_port;

    public function __construct($uri = null)
    {
        if (null === $uri) {
            $uri = 'http://localhost/foo/bar/baz/2';
        }

        $uri = Zend_Uri_Http::fromString($uri);
        $this->_host = $uri->getHost();
        $this->_port = $uri->getPort();

        parent::__construct($uri);
    }

    public function getHttpHost() {
        $return = $this->_host;
        if ($this->_port)  $return .= ':' . $this->_port;
        return $return;
    }
}

/**
 * Zend_Controller_Router_ChainTest_Dispatcher - dispatcher object for router testing
 */
class Zend_Controller_Router_ChainTest_Dispatcher extends Zend_Controller_Dispatcher_Standard
{
    public function getDefaultControllerName()
    {
        return 'defctrl';
    }

    public function getDefaultAction()
    {
        return 'defact';
    }
}

if (PHPUnit_MAIN_METHOD == "Zend_Controller_Router_Route_ChainTest::main") {
    Zend_Controller_Router_Route_ChainTest::main();
}
