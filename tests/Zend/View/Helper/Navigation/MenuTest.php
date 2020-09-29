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
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once dirname(__FILE__) . '/TestAbstract.php';
require_once 'Zend/View/Helper/Navigation/Menu.php';

/**
 * Tests Zend_View_Helper_Navigation_Menu
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_View
 * @group      Zend_View_Helper
 */
class Zend_View_Helper_Navigation_MenuTest
    extends Zend_View_Helper_Navigation_TestAbstract
{
    /**
     * Class name for view helper to test
     *
     * @var string
     */
    protected $_helperName = 'Zend_View_Helper_Navigation_Menu';

    /**
     * View helper
     *
     * @var Zend_View_Helper_Navigation_Menu
     */
    protected $_helper;

    public function testHelperEntryPointWithoutAnyParams()
    {
        $returned = $this->_helper->menu();
        $this->assertEquals($this->_helper, $returned);
        $this->assertEquals($this->_nav1, $returned->getContainer());
    }

    public function testHelperEntryPointWithContainerParam()
    {
        $returned = $this->_helper->menu($this->_nav2);
        $this->assertEquals($this->_helper, $returned);
        $this->assertEquals($this->_nav2, $returned->getContainer());
    }

    public function testNullingOutContainerInHelper()
    {
        $this->_helper->setContainer();
        $this->assertEquals(0, count($this->_helper->getContainer()));
    }

    public function testAutoloadingContainerFromRegistry()
    {
        $oldReg = null;
        if (Zend_Registry::isRegistered(self::REGISTRY_KEY)) {
            $oldReg = Zend_Registry::get(self::REGISTRY_KEY);
        }
        Zend_Registry::set(self::REGISTRY_KEY, $this->_nav1);

        $this->_helper->setContainer(null);

        $expected = $this->_getExpected('menu/default1.html');
        $actual = $this->_helper->render();

        Zend_Registry::set(self::REGISTRY_KEY, $oldReg);

        $this->assertEquals($expected, $actual);
    }

    public function testSetIndentAndOverrideInRenderMenu()
    {
        $this->_helper->setIndent(8);

        $expected = [
            'indent4' => $this->_getExpected('menu/indent4.html'),
            'indent8' => $this->_getExpected('menu/indent8.html')
        ];

        $renderOptions = [
            'indent' => 4
        ];

        $actual = [
            'indent4' => rtrim($this->_helper->renderMenu(null, $renderOptions), PHP_EOL),
            'indent8' => rtrim($this->_helper->renderMenu(), PHP_EOL)
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testRenderSuppliedContainerWithoutInterfering()
    {
        $rendered1 = $this->_getExpected('menu/default1.html');
        $rendered2 = $this->_getExpected('menu/default2.html');
        $expected = [
            'registered'       => $rendered1,
            'supplied'         => $rendered2,
            'registered_again' => $rendered1
        ];

        $actual = [
            'registered'       => $this->_helper->render(),
            'supplied'         => $this->_helper->render($this->_nav2),
            'registered_again' => $this->_helper->render()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testUseAclRoleAsString()
    {
        $acl = $this->_getAcl();
        $this->_helper->setAcl($acl['acl']);
        $this->_helper->setRole('member');

        $expected = $this->_getExpected('menu/acl_string.html');
        $this->assertEquals($expected, $this->_helper->render());
    }

    public function testFilterOutPagesBasedOnAcl()
    {
        $acl = $this->_getAcl();
        $this->_helper->setAcl($acl['acl']);
        $this->_helper->setRole($acl['role']);

        $expected = $this->_getExpected('menu/acl.html');
        $actual = $this->_helper->render();

        $this->assertEquals($expected, $actual);
    }

    public function testDisablingAcl()
    {
        $acl = $this->_getAcl();
        $this->_helper->setAcl($acl['acl']);
        $this->_helper->setRole($acl['role']);
        $this->_helper->setUseAcl(false);

        $expected = $this->_getExpected('menu/default1.html');
        $actual = $this->_helper->render();

        $this->assertEquals($expected, $actual);
    }

    public function testUseAnAclRoleInstanceFromAclObject()
    {
        $acl = $this->_getAcl();
        $this->_helper->setAcl($acl['acl']);
        $this->_helper->setRole($acl['acl']->getRole('member'));

        $expected = $this->_getExpected('menu/acl_role_interface.html');
        $this->assertEquals($expected, $this->_helper->render());
    }

    public function testUseConstructedAclRolesNotFromAclObject()
    {
        $acl = $this->_getAcl();
        $this->_helper->setAcl($acl['acl']);
        $this->_helper->setRole(new Zend_Acl_Role('member'));

        $expected = $this->_getExpected('menu/acl_role_interface.html');
        $this->assertEquals($expected, $this->_helper->render());
    }

    public function testSetUlCssClass()
    {
        $this->_helper->setUlClass('My_Nav');
        $expected = $this->_getExpected('menu/css.html');
        $this->assertEquals($expected, $this->_helper->render($this->_nav2));
    }

    /**
     * @group ZF-10409
     */
    public function testSetPrefixForIdWithContent()
    {
        $this->_helper->setPrefixForId('test-');
        $expected = $this->_getExpected('menu/normalize-id-prefix-with-content.html');
        $this->assertEquals($expected, $this->_helper->render($this->_nav3));
    }

    /**
     * @group ZF-10409
     */
    public function testSetPrefixForIdWithoutContent()
    {
        $this->_helper->setPrefixForId('');
        $expected = $this->_getExpected('menu/normalize-id-prefix-without-content.html');
        $this->assertEquals($expected, $this->_helper->render($this->_nav3));
    }

    /**
     * @group ZF-10409
     */
    public function testSetPrefixForIdWithNull()
    {
        $this->_helper->setPrefixForId(null);
        $expected = $this->_getExpected('menu/normalize-id-prefix-with-null.html');
        $this->assertEquals($expected, $this->_helper->render($this->_nav3));
    }

    /**
     * @group ZF-10409
     */
    public function testGetPrefixForIdWithContent()
    {
        $this->_helper->setPrefixForId('test');
        $this->assertEquals('test', $this->_helper->getPrefixForId());
    }

    /**
     * @group ZF-10409
     */
    public function testGetPrefixForIdWithoutContent()
    {
        $this->_helper->setPrefixForId('');
        $this->assertEquals('', $this->_helper->getPrefixForId());
    }

    /**
     * @group ZF-10409
     */
    public function testGetPrefixForIdWithNull()
    {
        $this->_helper->setPrefixForId(null);
        $this->assertEquals('menu-', $this->_helper->getPrefixForId());
    }

    /**
     * @group ZF-10409
     */
    public function testSkipPrefixForIdTrue()
    {
        $this->_helper->skipPrefixForId(true);
        $expected = $this->_getExpected('menu/normalize-id-prefix-without-content.html');
        $this->assertEquals($expected, $this->_helper->render($this->_nav3));
    }

    /**
     * @group ZF-10409
     */
    public function testSkipPrefixForIdFalse()
    {
        $this->_helper->skipPrefixForId(false);
        $expected = $this->_getExpected('menu/normalize-id-prefix-with-null.html');
        $this->assertEquals($expected, $this->_helper->render($this->_nav3));
    }

    public function testTranslationUsingZendTranslate()
    {
        $translator = $this->_getTranslator();
        $this->_helper->setTranslator($translator);

        $expected = $this->_getExpected('menu/translated.html');
        $this->assertEquals($expected, $this->_helper->render());
    }

    public function testTranslationUsingZendTranslateAdapter()
    {
        $translator = $this->_getTranslator();
        $this->_helper->setTranslator($translator->getAdapter());

        $expected = $this->_getExpected('menu/translated.html');
        $this->assertEquals($expected, $this->_helper->render());
    }

    public function testTranslationUsingTranslatorFromRegistry()
    {
        $oldReg = Zend_Registry::isRegistered('Zend_Translate')
                ? Zend_Registry::get('Zend_Translate')
                : null;

        $translator = $this->_getTranslator();
        Zend_Registry::set('Zend_Translate', $translator);

        $expected = $this->_getExpected('menu/translated.html');
        $actual = $this->_helper->render();

        Zend_Registry::set('Zend_Translate', $oldReg);

        $this->assertEquals($expected, $actual);

    }

    public function testDisablingTranslation()
    {
        $translator = $this->_getTranslator();
        $this->_helper->setTranslator($translator);
        $this->_helper->setUseTranslator(false);

        $expected = $this->_getExpected('menu/default1.html');
        $this->assertEquals($expected, $this->_helper->render());
    }

    public function testRenderingPartial()
    {
        $this->_helper->setPartial('menu.phtml');

        $expected = $this->_getExpected('menu/partial.html');
        $actual = $this->_helper->render();

        $this->assertEquals($expected, $actual);
    }

    public function testRenderingPartialBySpecifyingAnArrayAsPartial()
    {
        $this->_helper->setPartial(['menu.phtml', 'default']);

        $expected = $this->_getExpected('menu/partial.html');
        $actual = $this->_helper->render();

        $this->assertEquals($expected, $actual);
    }

    public function testRenderingPartialShouldFailOnInvalidPartialArray()
    {
        $this->_helper->setPartial(['menu.phtml']);

        try {
            $this->_helper->render();
            $this->fail('invalid $partial should throw Zend_View_Exception');
        } catch (Zend_View_Exception $e) {
        }
    }

    public function testSetMaxDepth()
    {
        $this->_helper->setMaxDepth(1);

        $expected = $this->_getExpected('menu/maxdepth.html');
        $actual = $this->_helper->renderMenu();

        $this->assertEquals($expected, $actual);
    }

    public function testSetMinDepth()
    {
        $this->_helper->setMinDepth(1);

        $expected = $this->_getExpected('menu/mindepth.html');
        $actual = $this->_helper->renderMenu();

        $this->assertEquals($expected, $actual);
    }

    public function testSetBothDepts()
    {
        $this->_helper->setMinDepth(1)->setMaxDepth(2);

        $expected = $this->_getExpected('menu/bothdepts.html');
        $actual = $this->_helper->renderMenu();

        $this->assertEquals($expected, $actual);
    }

    public function testSetOnlyActiveBranch()
    {
        $this->_helper->setOnlyActiveBranch(true);

        $expected = $this->_getExpected('menu/onlyactivebranch.html');
        $actual = $this->_helper->renderMenu();

        $this->assertEquals($expected, $actual);
    }

    public function testSetRenderParents()
    {
        $this->_helper->setOnlyActiveBranch(true)->setRenderParents(false);

        $expected = $this->_getExpected('menu/onlyactivebranch_noparents.html');
        $actual = $this->_helper->renderMenu();

        $this->assertEquals($expected, $actual);
    }

    public function testSetOnlyActiveBranchAndMinDepth()
    {
        $this->_helper->setOnlyActiveBranch()->setMinDepth(1);

        $expected = $this->_getExpected('menu/onlyactivebranch_mindepth.html');
        $actual = $this->_helper->renderMenu();

        $this->assertEquals($expected, $actual);
    }

    public function testOnlyActiveBranchAndMaxDepth()
    {
        $this->_helper->setOnlyActiveBranch()->setMaxDepth(2);

        $expected = $this->_getExpected('menu/onlyactivebranch_maxdepth.html');
        $actual = $this->_helper->renderMenu();

        $this->assertEquals($expected, $actual);
    }

    public function testOnlyActiveBranchAndBothDepthsSpecified()
    {
        $this->_helper->setOnlyActiveBranch()->setMinDepth(1)->setMaxDepth(2);

        $expected = $this->_getExpected('menu/onlyactivebranch_bothdepts.html');
        $actual = $this->_helper->renderMenu();

        $this->assertEquals($expected, $actual);
    }

    public function testOnlyActiveBranchNoParentsAndBothDepthsSpecified()
    {
        $this->_helper->setOnlyActiveBranch()
                      ->setMinDepth(1)
                      ->setMaxDepth(2)
                      ->setRenderParents(false);

        $expected = $this->_getExpected('menu/onlyactivebranch_np_bd.html');
        $actual = $this->_helper->renderMenu();

        $this->assertEquals($expected, $actual);
    }

    private function _setActive($label)
    {
        $container = $this->_helper->getContainer();

        foreach ($container->findAllByActive(true) as $page) {
            $page->setActive(false);
        }

        if ($p = $container->findOneByLabel($label)) {
            $p->setActive(true);
        }
    }

    public function testOnlyActiveBranchNoParentsActiveOneBelowMinDepth()
    {
        $this->_setActive('Page 2');

        $this->_helper->setOnlyActiveBranch()
                      ->setMinDepth(1)
                      ->setMaxDepth(1)
                      ->setRenderParents(false);

        $expected = $this->_getExpected('menu/onlyactivebranch_np_bd2.html');
        $actual = $this->_helper->renderMenu();

        $this->assertEquals($expected, $actual);
    }

    public function testRenderSubMenuShouldOverrideOptions()
    {
        $this->_helper->setOnlyActiveBranch(false)
                      ->setMinDepth(1)
                      ->setMaxDepth(2)
                      ->setRenderParents(true);

        $expected = $this->_getExpected('menu/onlyactivebranch_noparents.html');
        $actual = $this->_helper->renderSubMenu();

        $this->assertEquals($expected, $actual);
    }

    public function testOptionMaxDepth()
    {
        $options = [
            'maxDepth' => 1
        ];

        $expected = $this->_getExpected('menu/maxdepth.html');
        $actual = $this->_helper->renderMenu(null, $options);

        $this->assertEquals($expected, $actual);
    }

    public function testOptionMinDepth()
    {
        $options = [
            'minDepth' => 1
        ];

        $expected = $this->_getExpected('menu/mindepth.html');
        $actual = $this->_helper->renderMenu(null, $options);

        $this->assertEquals($expected, $actual);
    }

    public function testOptionBothDepts()
    {
        $options = [
            'minDepth' => 1,
            'maxDepth' => 2
        ];

        $expected = $this->_getExpected('menu/bothdepts.html');
        $actual = $this->_helper->renderMenu(null, $options);

        $this->assertEquals($expected, $actual);
    }

    public function testOptionOnlyActiveBranch()
    {
        $options = [
            'onlyActiveBranch' => true
        ];

        $expected = $this->_getExpected('menu/onlyactivebranch.html');
        $actual = $this->_helper->renderMenu(null, $options);

        $this->assertEquals($expected, $actual);
    }

    public function testOptionOnlyActiveBranchNoParents()
    {
        $options = [
            'onlyActiveBranch' => true,
            'renderParents' => false
        ];

        $expected = $this->_getExpected('menu/onlyactivebranch_noparents.html');
        $actual = $this->_helper->renderMenu(null, $options);

        $this->assertEquals($expected, $actual);
    }

    public function testOptionOnlyActiveBranchAndMinDepth()
    {
        $options = [
            'minDepth' => 1,
            'onlyActiveBranch' => true
        ];

        $expected = $this->_getExpected('menu/onlyactivebranch_mindepth.html');
        $actual = $this->_helper->renderMenu(null, $options);

        $this->assertEquals($expected, $actual);
    }

    public function testOptionOnlyActiveBranchAndMaxDepth()
    {
        $options = [
            'maxDepth' => 2,
            'onlyActiveBranch' => true
        ];

        $expected = $this->_getExpected('menu/onlyactivebranch_maxdepth.html');
        $actual = $this->_helper->renderMenu(null, $options);

        $this->assertEquals($expected, $actual);
    }

    public function testOptionOnlyActiveBranchAndBothDepthsSpecified()
    {
        $options = [
            'minDepth' => 1,
            'maxDepth' => 2,
            'onlyActiveBranch' => true
        ];

        $expected = $this->_getExpected('menu/onlyactivebranch_bothdepts.html');
        $actual = $this->_helper->renderMenu(null, $options);

        $this->assertEquals($expected, $actual);
    }

    public function testOptionOnlyActiveBranchNoParentsAndBothDepthsSpecified()
    {
        $options = [
            'minDepth' => 2,
            'maxDepth' => 2,
            'onlyActiveBranch' => true,
            'renderParents' => false
        ];

        $expected = $this->_getExpected('menu/onlyactivebranch_np_bd.html');
        $actual = $this->_helper->renderMenu(null, $options);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group ZF-9746
     */
    public function testRenderingWithAccesskey()
    {
        $this->_nav3->findOneBy('id', 'home')->setAccesskey('H');
        $this->_nav3->findOneBy('uri', 'contact')->setAccesskey('c');
        $this->_nav3->findOneBy('id', 'imprint')->setAccesskey('i');
        
        $expected = $this->_getExpected('menu/accesskey.html');
        
        $this->assertEquals($expected, $this->_helper->render($this->_nav3));
    }

    /**
     * @group ZF-6941
     */
    public function testExpandSiblingNodesOfActiveBranch()
    {
        $this->_helper->setExpandSiblingNodesOfActiveBranch(true);
 
        $expected = $this->_getExpected('menu/expandbranch.html');
        $actual = $this->_helper->renderMenu();
 
        $this->assertEquals($expected, $actual);
    }

    /**
     * @group ZF-6941
     */
    public function testExpandSiblingNodesOfActiveBranchWhenShowingOnlyActiveBranch()
    {
        $this->_helper->setExpandSiblingNodesOfActiveBranch(true)->setOnlyActiveBranch(true);
 
        $expected = $this->_getExpected('menu/expandbranch_onlyactivebranch.html');
        $actual = $this->_helper->renderMenu();
 
        $this->assertEquals($expected, $actual);
    }

    /**
     * @group ZF-11876
     */
    public function testRenderingWithCustomHtmlAttribs()
    {
        $this->_nav3->findOneBy('id', 'home')->setCustomHtmlAttrib('rel', 'nofollow');
        $this->_nav3->findOneBy('uri', 'contact')->setCustomHtmlAttribs(
            [
                 'rel'   => 'nofollow',
                 'style' => 'font-weight: bold;',
            ]
        );
        $this->_nav3->findOneBy('id', 'imprint')->setCustomHtmlAttrib('rel', 'nofollow');

        $expected = $this->_getExpected('menu/customhtmlattribs.html');

        $this->assertEquals($expected, $this->_helper->render($this->_nav3));
    }

    /**
     * @group ZF-7212
     */
    public function testRenderingWithUlId()
    {
        $this->_helper->setUlId('foo');

        $this->assertContains(
            '<ul class="navigation" id="foo">',
            $this->_helper->renderMenu()
        );
    }

    /**
     * @group ZF-7212
     */
    public function testRenderingWithUlIdPerOptions()
    {
        $this->assertContains(
            '<ul class="navigation" id="foo">',
            $this->_helper->renderMenu(null, ['ulId' => 'foo'])
        );
    }

    /**
     * @group ZF-7212
     */
    public function testRenderingOnlyActiveBranchWithUlId()
    {
        $this->_helper->setUlId('foo')
                      ->setOnlyActiveBranch()
                      ->setRenderParents();

        $this->assertContains(
            '<ul class="navigation" id="foo">',
            $this->_helper->renderMenu()
        );
    }

    /**
     * @group ZF-7212
     */
    public function testRenderingSubMenuWithUlId()
    {
        $this->assertContains(
            '<ul class="navigation" id="foo">',
            $this->_helper->renderSubMenu(null, null, null, 'foo')
        );
    }

    /**
     * @group ZF-7212
     */
    public function testRenderingDeepestMenuWithUlId()
    {
        $this->assertContains(
            '<ul class="navigation" id="foo">',
            $this->_helper->renderMenu(null, ['ulId' => 'foo'])
        );
    }

    /**
     * @group ZF-7003
     */
    public function testSetAddPageClassToLi()
    {
        $this->_helper->addPageClassToLi();
        $this->assertTrue($this->_helper->getAddPageClassToLi());
    }

    /**
     * @group ZF-7003
     */
    public function testRenderingWithPageClassToLi()
    {
        $this->_helper->addPageClassToLi();

        // Add css class
        $container = $this->_helper->getContainer();
        $container->findBy('href', 'page1')->setClass('foo');

        // Tests
        $this->assertContains(
            '<li class="foo">',
            $this->_helper->renderMenu()
        );
        $this->assertNotContains(
            '<a class="foo" href="page1">Page 1</a>',
            $this->_helper->renderMenu()
        );
    }

    /**
     * @group ZF-7003
     */
    public function testRenderDeepestMenuWithPageClassToLi()
    {
        // Add css class
        $container = $this->_helper->getContainer();
        $container->findBy('label', 'Page 2.3.3.1')->setClass('foo');

        // Tests
        $options = [
            'onlyActiveBranch' => true,
            'renderParents'    => false,
            'addPageClassToLi' => true,
        ];

        $this->assertContains(
            '<li class="active foo">',
            $this->_helper->renderMenu(null, $options)
        );
        $this->assertNotContains(
            '<a class="foo" href="page1">Page 1</a>',
            $this->_helper->renderMenu(null, $options)
        );
    }

    /**
     * @group ZF-9543
     */
    public function testSetActiveClass()
    {
        $this->_helper->setActiveClass('current');

        // Test getter
        $this->assertEquals('current', $this->_helper->getActiveClass());

        // Test rendering
        $expected = $this->_getExpected('menu/css_active.html');
        $this->assertEquals($expected, $this->_helper->render($this->_nav2));
    }

    /**
     * @group ZF-9543
     */
    public function testRenderDeepestMenuWithCustomActiveClass()
    {
        // Tests
        $options = [
            'onlyActiveBranch' => true,
            'renderParents'    => false,
            'activeClass'      => 'current',
        ];

        $html = $this->_helper->renderMenu(null, $options);

        $this->assertContains('<li class="current">', $html);
        $this->assertNotContains('<li class="active">', $html);
    }

    /**
     * @group ZF-8951
     */
    public function testSetRenderParentClass()
    {
        $this->_helper->setRenderParentClass(true);

        $this->assertTrue($this->_helper->getRenderParentClass());
    }

    /**
     * @group ZF-8951
     */
    public function testSetParentClass()
    {
        $this->_helper->setParentClass('foo');

        $this->assertEquals('foo', $this->_helper->getParentClass());
    }

    /**
     * @group ZF-8951
     */
    public function testOptionRenderParentClass()
    {
        $expected = $this->_getExpected('menu/parentclass_standard.html');
        $actual   = $this->_helper->renderMenu(
            null ,
            [
                 'renderParentClass' => true,
            ]
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group ZF-8951
     */
    public function testOptionRenderParentClassAndParentClass()
    {
        $expected = $this->_getExpected('menu/parentclass_custom.html');
        $actual   = $this->_helper->renderMenu(
            null ,
            [
                 'renderParentClass' => true,
                 'parentClass'       => 'foo',
            ]
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group ZF-8951
     */
    public function testRenderingWithStandardParentClass()
    {
        $this->_helper->setRenderParentClass(true);
        $expected = $this->_getExpected('menu/parentclass_standard.html');

        $this->assertEquals($expected, $this->_helper->render());
    }

    /**
     * @group ZF-8951
     */
    public function testRenderingWithCustomParentClass()
    {
        $this->_helper->setRenderParentClass(true);
        $this->_helper->setParentClass('foo');
        $expected = $this->_getExpected('menu/parentclass_custom.html');

        $this->assertEquals($expected, $this->_helper->render());
    }

    /**
     * @group ZF-8951
     */
    public function testRenderingWithParentClassAndBothDepts()
    {
        $this->_helper->setRenderParentClass(true);

        $expected = $this->_getExpected('menu/parentclass_bothdepts.html');
        $actual   = $this->_helper->setMinDepth(1)->setMaxDepth(2)->render();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group ZF-8951
     */
    public function testRenderingWithParentClassAndOnlyActiveBranchAndBothDepts()
    {
        $this->_helper->setRenderParentClass(true);
        $this->_helper->setOnlyActiveBranch(true);

        $expected = $this->_getExpected('menu/parentclass_onlyactivebranch_bothdepts.html');
        $actual   = $this->_helper->setMinDepth(1)->setMaxDepth(2)->render();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group ZF-8874
     */
    public function testSetAndGetInnerIndent()
    {
        // Test standard
        $this->assertSame('    ', $this->_helper->getInnerIndent());

        // Test with format output true
        $this->_helper->setInnerIndent(0);
        $this->assertSame('', $this->_helper->getInnerIndent());

        $this->_helper->setInnerIndent('        ');
        $this->assertSame('        ', $this->_helper->getInnerIndent());

        // Test with format output false
        $this->_helper->setFormatOutput(false);
        $this->assertSame('', $this->_helper->getInnerIndent());
    }

    /**
     * @group ZF-8874
     */
    public function testRenderingWithoutWhitespace()
    {
        $this->_helper->setFormatOutput(false);

        $expected = $this->_getExpected('menu/without_whitespace.html');

        $this->assertEquals($expected, $this->_helper->render($this->_nav1));
    }

    /**
     * @group ZF-8874
     */
    public function testRenderingWithInnerIndent()
    {
        $this->_helper->setIndent(4);

        // Inner indent = 0
        $this->_helper->setInnerIndent(0);
        $expected = $this->_getExpected('menu/innerindent0.html');

        $this->assertEquals($expected, $this->_helper->render($this->_nav1));

        // Inner indent = 4
        $this->_helper->setInnerIndent(4);
        $expected = $this->_getExpected('menu/innerindent4.html');

        $this->assertEquals($expected, $this->_helper->render($this->_nav1));

        // Inner indent = 8
        $this->_helper->setInnerIndent(8);
        $expected = $this->_getExpected('menu/innerindent8.html');

        $this->assertEquals($expected, $this->_helper->render($this->_nav1));
    }
}
