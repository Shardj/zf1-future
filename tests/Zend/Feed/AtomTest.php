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
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once dirname(__FILE__) . '/AbstractFeedTest.php';

/**
 * @see Zend_Feed_Atom
 */
require_once 'Zend/Feed/Atom.php';

/**
 * @category   Zend
 * @package    Zend_Feed
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Feed
 */
class Zend_Feed_AtomTest extends Zend_Feed_AbstractFeedTest
{
    public $remoteFeedNames = ['zend_feed_atom_xxe.remote.xml'];

    public function testPreventsXxeAttacksOnParsing()
    {
        $uri   = $this->baseUri . '/' . $this->prepareFeed('zend_feed_atom_xxe.xml');
        $this->setExpectedException('Zend_Feed_Exception', 'parse');
        $feed  = new Zend_Feed_Atom($uri);
    }
}

