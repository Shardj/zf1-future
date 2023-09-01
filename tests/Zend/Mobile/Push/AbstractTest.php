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
 * @package    Zend_Mobile
 * @subpackage Push
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id $
 */

require_once 'Zend/Mobile/Push/Abstract.php';
require_once 'Zend/Mobile/Push/Message/Abstract.php';

/**
 * @category   Zend
 * @package    Zend_Mobile
 * @subpackage Push
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Mobile
 * @group      Zend_Mobile_Push
 * @group      Zend_Mobile_Push_Abstract
 */
class Zend_Mobile_Push_AbstractTest extends TestCase
{
    /**
     * @var \Zend_Mobile_Push_AbstractProxy|mixed
     */
    protected $adapter;

    protected function set_up()
    {
        $this->adapter = new Zend_Mobile_Push_AbstractProxy();
    }

    public function testConnect()
    {
        $ret = $this->adapter->connect();
        $this->assertEquals($this->adapter, $ret);
        $this->assertTrue($this->adapter->isConnected());
    }

    public function testSend()
    {
        $msg = new Zend_Mobile_Push_AbstractProxy_Message();
        $this->assertTrue($this->adapter->send($msg));
    }

    public function testClose()
    {
        $this->adapter->connect();
        $ret = $this->adapter->close();
        $this->assertNull($ret);
        $this->assertFalse($this->adapter->isConnected());
    }
}

class Zend_Mobile_Push_AbstractProxy extends Zend_Mobile_Push_Abstract
{
}

class Zend_Mobile_Push_AbstractProxy_Message extends Zend_Mobile_Push_Message_Abstract
{
}
