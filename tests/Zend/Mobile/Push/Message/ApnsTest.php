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
class Zend_Mobile_Push_Message_ApnsTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
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

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetAlertThrowsExceptionOnTextNonString()
    {
        $this->message->setAlert([]);
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetAlertThrowsExceptionOnActionLocKeyNonString()
    {
        $this->message->setAlert('text', []);
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetAlertThrowsExceptionOnLocKeyNonString()
    {
        $this->message->setAlert('text', 'button', []);
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetAlertThrowsExceptionOnLocArgsNonArray()
    {
        $this->message->setAlert('text', 'button', 'action', 'whoa');
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetAlertThrowsExceptionOnLaunchImageNonString()
    {
        $this->message->setAlert('text', 'button', 'action', ['locale'], []);
    }

    public function testSetBadgeReturnsCorrectNumber()
    {
        $num = 5;
        $this->message->setBadge($num);
        $this->assertEquals($this->message->getBadge(), $num);
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetBadgeNonNumericThrowsException()
    {
        $this->message->setBadge('string!');
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetBadgeNegativeNumberThrowsException()
    {
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

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetExpireNonNumericThrowsException()
    {
        $this->message->setExpire('sting!');
    }

    public function testSetSoundReturnsString()
    {
        $sound = 'test';
        $this->message->setSound($sound);
        $this->assertEquals($this->message->getSound(), $sound);
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetSoundThrowsExceptionOnNonString()
    {
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

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testAddCustomDataThrowsExceptionOnNonStringKey()
    {
        $this->message->addCustomData(['key'], 'val');
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testAddCustomDataThrowsExceptionOnReservedKeyAps()
    {
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
