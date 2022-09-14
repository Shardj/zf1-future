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
 * @package    Zend_Feed
 * @subpackage UnitTests
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Feed
 */
require_once 'Zend/Feed.php';

/**
 * @category   Zend
 * @package    Zend_Feed
 * @subpackage UnitTests
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Feed
 */

class AtomTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorElementException()
    {
        try {
            new Zend_Feed_Entry_Rss(null, 'foo');
        } catch (Exception $e) {
            self::assertInstanceOf('Zend_Feed_Exception', $e);
            self::assertContains('message not available', $e->getMessage());

            return;
        }

        self::fail('Test should throw exception and not reach this point');
    }
}