<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

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
 * @package    Zend_Service_Amazon_SimpleDb
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: OfflineTest.php 8064 2008-02-16 10:58:39Z thomas $
 */

require_once 'Zend/Service/Amazon/SimpleDb/Page.php';

/**
 * @category   Zend
 * @package    Zend_Service_Amazon_SimpleDb
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_Amazon_SimpleDb_PageTest extends TestCase
{
    /**
     * @var Zend_Service_Amazon_SimpleDb_Page
     */
    protected $page;

    protected function set_up()
    {
        $this->page = new Zend_Service_Amazon_SimpleDb_Page('foobar');
    }

    public function testSetAndGetDataPerMethods()
    {
        $this->page->setData('data');
        $this->assertEquals('data', $this->page->getData());
    }

    public function testSetDataPerConstructor()
    {
        $page = new Zend_Service_Amazon_SimpleDb_Page('data');
        $this->assertEquals('data', $page->getData());
    }

    public function testSetAndGetTokenPerMethods()
    {
        $this->page->setToken('token');
        $this->assertEquals('token', $this->page->getToken());
    }

    public function testSetTokenPerConstructor()
    {
        $page = new Zend_Service_Amazon_SimpleDb_Page('data', 'token');
        $this->assertEquals('token', $page->getToken());
    }

    public function testSetTokenShouldAcceptsNullValue()
    {
        $this->page->setToken('token');
        $this->page->setToken(null);
        $this->assertNull($this->page->getToken());
    }

    public function testSetTokenDoesNotAcceptsEmptyStrings()
    {
        $this->page->setToken('token');
        $this->page->setToken('');
        $this->assertNull($this->page->getToken());
    }

    public function testIsLastShouldReturnTrueWhenNoTokenIsSet()
    {
        $this->assertTrue($this->page->isLast());
    }

    public function testIsLastShouldReturnFalseWhenTokenIsSet()
    {
        $this->page->setToken('token');
        $this->assertFalse($this->page->isLast());
    }

    public function testIsLastShouldReturnTrueWhenTokenIsRemoved()
    {
        $this->page->setToken('');
        $this->assertTrue($this->page->isLast());
    }

    public function testToStringMethod()
    {
        $this->page->setData('data');
        $this->page->setToken('token');
        $this->assertEquals(
            "Page with token: token\n and data: data",
            $this->page->__toString()
        );
    }
}
