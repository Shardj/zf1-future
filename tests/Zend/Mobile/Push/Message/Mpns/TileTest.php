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

require_once 'Zend/Mobile/Push/Message/Mpns/Tile.php';

/**
 * @category   Zend
 * @package    Zend_Mobile
 * @subpackage Push
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Mobile
 * @group      Zend_Mobile_Push
 * @group      Zend_Mobile_Push_Mpns
 */
class Zend_Mobile_Push_Message_Mpns_TileTest extends PHPUnit_Framework_TestCase
{
    private $_msg;

    public function setUp()
    {
        $this->_msg = new Zend_Mobile_Push_Message_Mpns_Tile();
    }

    public function testSetToken()
    {
        $token = 'http://sn1.notify.live.net/throttledthirdparty/bogusdata';
        $this->_msg->setToken($token);
        $this->assertEquals($token, $this->_msg->getToken());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetTokenNonStringThrowsException()
    {
        $token = ['foo' => 'bar'];
        $this->_msg->setToken($token);
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetTokenInvalidUrlThrowsException()
    {
        $token = 'notaurl';
        $this->_msg->setToken($token);
    }

    public function testGetNotificationType()
    {
        $this->assertEquals(Zend_Mobile_Push_Message_Mpns::TYPE_TILE, $this->_msg->getNotificationType());
    }

    public function testGetDelayHasDefaultOfImmediate()
    {
        $this->assertEquals(Zend_Mobile_Push_Message_Mpns_Tile::DELAY_IMMEDIATE, $this->_msg->getDelay());
    }

    public function testSetBackgroundImage()
    {
        $image = 'foo.bar';
        $this->_msg->setBackgroundImage($image);
        $this->assertEquals($image, $this->_msg->getBackgroundImage());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetBackgroundImageThrowsExceptionOnNonString()
    {
        $image = ['foo' => 'bar'];
        $this->_msg->setBackgroundImage($image);
    }

    public function testSetCount()
    {
        $negCount = -1;
        $posCount = 1;
        $this->_msg->setCount($negCount);
        $this->assertEquals($negCount, $this->_msg->getCount());
        $this->_msg->setCount($posCount);
        $this->assertEquals($posCount, $this->_msg->getCount());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetCountThrowsExceptionOnNonNumeric()
    {
        $count = 'five';
        $this->_msg->setCount($count);
    }

    public function testSetTitle()
    {
        $title = 'foo';
        $this->_msg->setTitle($title);
        $this->assertEquals($title, $this->_msg->getTitle());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetTitleThrowsExceptionOnNonString()
    {
        $title = ['foo' => 'bar'];
        $this->_msg->setTitle($title);
    }

    public function testSetBackBackgroundImage()
    {
        $image = 'foo.bar';
        $this->_msg->setBackBackgroundImage($image);
        $this->assertEquals($image, $this->_msg->getBackBackgroundImage());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetBackBackgroundImageThrowsExceptionOnNonString()
    {
        $image = ['foo' => 'bar'];
        $this->_msg->setBackBackgroundImage($image);
    }

    public function testSetBackTitle()
    {
        $title = 'foo';
        $this->_msg->setBackTitle($title);
        $this->assertEquals($title, $this->_msg->getBackTitle());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetBackTitleThrowsExceptionOnNonString()
    {
        $title = ['foo' => 'bar'];
        $this->_msg->setBackTitle($title);
    }

    public function testSetBackContent()
    {
        $content = 'foo';
        $this->_msg->setBackContent($content);
        $this->assertEquals($content, $this->_msg->getBackContent());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetBackContentThrowsExceptionOnNonString()
    {
        $content = ['foo' => 'bar'];
        $this->_msg->setBackContent($content);
        $this->assertEquals($content, $this->_msg->getBackContent());
    }

    public function testSetTileId()
    {
        $id = '?foo.bar';
        $this->_msg->setTileId($id);
        $this->assertEquals($id, $this->_msg->getTileId());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetTileIdThrowsExceptionOnNonString()
    {
        $id = ['foo' => 'bar'];
        $this->_msg->setTileId($id);
    }


    public function testSetDelay()
    {
        $this->_msg->setDelay(Zend_Mobile_Push_Message_Mpns_Tile::DELAY_450S);
        $this->assertEquals(Zend_Mobile_Push_Message_Mpns_Tile::DELAY_450S, $this->_msg->getDelay());
        $this->_msg->setDelay(Zend_Mobile_Push_Message_Mpns_Tile::DELAY_900S);
        $this->assertEquals(Zend_Mobile_Push_Message_Mpns_Tile::DELAY_900S, $this->_msg->getDelay());
        $this->_msg->setDelay(Zend_Mobile_Push_Message_Mpns_Tile::DELAY_IMMEDIATE);
        $this->assertEquals(Zend_Mobile_Push_Message_Mpns_Tile::DELAY_IMMEDIATE, $this->_msg->getDelay());
    }

    public function testValidate()
    {
        $this->assertFalse($this->_msg->validate());
        $this->_msg->setToken('http://sn1.notify.live.net/throttledthirdparty/bogusdata');
        $this->assertFalse($this->_msg->validate());
        $this->_msg->setBackgroundImage('foo.bar');
        $this->assertFalse($this->_msg->validate());
        $this->_msg->setTitle('foo');
        $this->assertTrue($this->_msg->validate());
    }

    public function testGetXmlPayload()
    {
        $title = 'foo';
        $backgroundImage = 'bar.jpg';
        $count = 5;
        $this->_msg->setToken('http://sn1.notify.live.net/throttledthirdparty/abcdef1234567890');
        $this->_msg->setTitle($title);
        $this->_msg->setBackgroundImage($backgroundImage);
        $this->_msg->setCount($count);

        $xml = new SimpleXMLElement($this->_msg->getXmlPayload(), 0, false, 'wp', true);

        $this->assertEquals($title, (string) $xml->Tile->Title);
        $this->assertEquals($backgroundImage, (string) $xml->Tile->BackgroundImage);
        $this->assertEquals($count, (int) $xml->Tile->Count);
    }

}
