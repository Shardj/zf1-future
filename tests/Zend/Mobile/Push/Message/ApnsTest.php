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

require_once 'Zend/Mobile/Push/Message/Apns.php';

/**
 * @category   Zend
 * @package    Zend_Mobile
 * @subpackage Push
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Mobile
 * @group      Zend_Mobile_Push
 * @group      Zend_Mobile_Push_Apns
 */
class Zend_Mobile_Push_Message_ApnsTest extends TestCase
{
    /**
     * @var \Zend_Mobile_Push_Message_Apns|mixed
     */
    protected $message;

    protected function set_up()
    {
        $this->message = new Zend_Mobile_Push_Message_Apns();
    }

    public function testSetAlertTextReturnsCorrectly()
    {
        $text = 'my alert';
        $ret = $this->message->setAlert($text);
        $this->assertTrue($ret instanceof Zend_Mobile_Push_Message_Apns);
        $checkText = $this->message->getAlert();
        $this->assertTrue(is_array($checkText));
        $this->assertEquals($checkText['body'], $text);
    }

    public function testSetAlertThrowsExceptionOnTextNonString()
    {
        $this->expectException(Zend_Mobile_Push_Message_Exception::class);
        $this->message->setAlert([]);
    }

    public function testSetAlertThrowsExceptionOnActionLocKeyNonString()
    {
        $this->expectException(Zend_Mobile_Push_Message_Exception::class);
        $this->message->setAlert('text', []);
    }

    public function testSetAlertThrowsExceptionOnLocKeyNonString()
    {
        $this->expectException(Zend_Mobile_Push_Message_Exception::class);
        $this->message->setAlert('text', 'button', []);
    }

    public function testSetAlertThrowsExceptionOnLocArgsNonArray()
    {
        $this->expectException(Zend_Mobile_Push_Message_Exception::class);
        $this->message->setAlert('text', 'button', 'action', 'whoa');
    }

    public function testSetAlertThrowsExceptionOnLaunchImageNonString()
    {
        $this->expectException(Zend_Mobile_Push_Message_Exception::class);
        $this->message->setAlert('text', 'button', 'action', ['locale'], []);
    }

    public function testSetBadgeReturnsCorrectNumber()
    {
        $num = 5;
        $this->message->setBadge($num);
        $this->assertEquals($this->message->getBadge(), $num);
    }

    public function testSetBadgeNonNumericThrowsException()
    {
        $this->expectException(Zend_Mobile_Push_Message_Exception::class);
        $this->message->setBadge('string!');
    }

    public function testSetBadgeNegativeNumberThrowsException()
    {
        $this->expectException(Zend_Mobile_Push_Message_Exception::class);
        $this->message->setBadge(-5);
    }

    public function testSetBadgeAllowsNull()
    {
        $this->message->setBadge(null);
        $this->assertNull($this->message->getBadge());
    }

    public function testSetExpireReturnsInteger()
    {
        $expire = 100;
        $this->message->setExpire($expire);
        $this->assertEquals($this->message->getExpire(), $expire);
    }

    public function testSetExpireNonNumericThrowsException()
    {
        $this->expectException(Zend_Mobile_Push_Message_Exception::class);
        $this->message->setExpire('sting!');
    }

    public function testSetSoundReturnsString()
    {
        $sound = 'test';
        $this->message->setSound($sound);
        $this->assertEquals($this->message->getSound(), $sound);
    }

    public function testSetSoundThrowsExceptionOnNonString()
    {
        $this->expectException(Zend_Mobile_Push_Message_Exception::class);
        $this->message->setSound([]);
    }

    public function testAddCustomDataReturnsSetData()
    {
        $addKey1 = 'test1';
        $addValue1 = ['val', 'ue', '1'];

        $addKey2 = 'test2';
        $addValue2 = 'value2';

        $expected = [$addKey1 => $addValue1];
        $this->message->addCustomData($addKey1, $addValue1);
        $this->assertEquals($this->message->getCustomData(), $expected);

        $expected[$addKey2] = $addValue2;
        $this->message->addCustomData($addKey2, $addValue2);
        $this->assertEquals($this->message->getCustomData(), $expected);
    }

    public function testAddCustomDataThrowsExceptionOnNonStringKey()
    {
        $this->expectException(Zend_Mobile_Push_Message_Exception::class);
        $this->message->addCustomData(['key'], 'val');
    }

    public function testAddCustomDataThrowsExceptionOnReservedKeyAps()
    {
        $this->expectException(Zend_Mobile_Push_Message_Exception::class);
        $this->message->addCustomData('aps', 'val');
    }

    public function testClearCustomDataClearsData()
    {
        $this->message->addCustomData('key', 'val');
        $this->message->clearCustomData();
        $this->assertEquals($this->message->getCustomData(), []);
    }

    public function testSetCustomData()
    {
        $data = ['key' => 'val', 'key2' => [1, 2, 3, 4, 5]];
        $this->message->setCustomData($data);
        $this->assertEquals($this->message->getCustomData(), $data);
    }

    public function testValidateReturnsFalseWithoutToken()
    {
        $this->assertFalse($this->message->validate());
    }

    public function testValidateReturnsFalseIdNotNumeric()
    {
        $this->message->setToken('abc');
        $this->message->setId('def');
        $this->assertFalse($this->message->validate());
    }

    public function testValidateReturnsTrueWhenProperlySet()
    {
        $this->message->setToken('abc');
        $this->assertTrue($this->message->validate());

        $this->message->setId(12345);
        $this->assertTrue($this->message->validate());
    }
}
