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
 * @package    Zend_Mail
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_Mail_Message
 */
require_once 'Zend/Mail/Header/HeaderName.php';

class Zend_Mail_Header_HeaderNameTest extends PHPUnit_Framework_TestCase
{
    /**
     * Data for filter name
     */
    public function getFilterNames()
    {
        return [
            ['Subject', 'Subject'],
            ['Subject:', 'Subject'],
            [':Subject:', 'Subject'],
            ['Subject' . chr(32), 'Subject'],
            ['Subject' . chr(33), 'Subject' . chr(33)],
            ['Subject' . chr(126), 'Subject' . chr(126)],
            ['Subject' . chr(127), 'Subject'],
        ];
    }

    /**
     * @dataProvider getFilterNames
     * @group ZF2015-04
     */
    public function testFilterName($name, $expected)
    {
        $this->assertEquals($expected, Zend_Mail_Header_HeaderName::filter($name));
    }

    public function validateNames()
    {
        return [
            ['Subject', 'assertTrue'],
            ['Subject:', 'assertFalse'],
            [':Subject:', 'assertFalse'],
            ['Subject' . chr(32), 'assertFalse'],
            ['Subject' . chr(33), 'assertTrue'],
            ['Subject' . chr(126), 'assertTrue'],
            ['Subject' . chr(127), 'assertFalse'],
        ];
    }

    /**
     * @dataProvider validateNames
     * @group ZF2015-04
     */
    public function testValidateName($name, $assertion)
    {
        $this->{$assertion}(Zend_Mail_Header_HeaderName::isValid($name));
    }

    public function assertNames()
    {
        return [
            ['Subject:'],
            [':Subject:'],
            ['Subject' . chr(32)],
            ['Subject' . chr(127)],
        ];
    }

    /**
     * @dataProvider assertNames
     * @group ZF2015-04
     */
    public function testAssertValidRaisesExceptionForInvalidNames($name)
    {
        $this->setExpectedException('Zend_Mail_Exception', 'Invalid');
        Zend_Mail_Header_HeaderName::assertValid($name);
    }
}
