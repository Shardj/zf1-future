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

require_once 'Zend/Mobile/Push/Response/Gcm.php';
require_once 'Zend/Mobile/Push/Message/Gcm.php';

/**
 * @category   Zend
 * @package    Zend_Mobile
 * @subpackage Push
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Mobile
 * @group      Zend_Mobile_Push
 * @group      Zend_Mobile_Push_Gcm
 */
class Zend_Mobile_Push_Response_GcmTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $response = new Zend_Mobile_Push_Response_Gcm();
        $this->assertNull($response->getResponse());
        $this->assertNull($response->getMessage());

        $message = new Zend_Mobile_Push_Message_Gcm();
        $response = new Zend_Mobile_Push_Response_Gcm(null, $message);
        $this->assertEquals($message, $response->getMessage());
        $this->assertNull($response->getResponse());

        $message = new Zend_Mobile_Push_Message_Gcm();
        $responseArr = json_encode([
            'results' => [
                ['message_id' => '1:1234'],
            ],
            'success' => 1,
            'failure' => 0,
            'canonical_ids' => 0,
            'multicast_id' => 1,
        ]);
        $response = new Zend_Mobile_Push_Response_Gcm($responseArr, $message);
        $this->assertEquals(json_decode($responseArr, true), $response->getResponse());
        $this->assertEquals($message, $response->getMessage());
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception_ServerUnavailable
     */
    public function testConstructorThrowsExceptionOnBadOrEmptyJsonString()
    {
        $response = new Zend_Mobile_Push_Response_Gcm('{bad');
    }

    public function testSetGetMessage()
    {
        $message = new Zend_Mobile_Push_Message_Gcm();
        $response = new Zend_Mobile_Push_Response_Gcm();
        $response->setMessage($message);
        $this->assertEquals($message, $response->getMessage());
    }

    public function testResponse()
    {
        $responseArr = [
            'results' => [
                ['message_id' => '1:234'],
            ],
            'success' => 1,
            'failure' => 0,
            'canonical_ids' => 0,
            'multicast_id' => '123',
        ];
        $response = new Zend_Mobile_Push_Response_Gcm();
        $response->setResponse($responseArr);
        $this->assertEquals($responseArr, $response->getResponse());
        $this->assertEquals(1, $response->getSuccessCount());
        $this->assertEquals(0, $response->getFailureCount());
        $this->assertEquals(0, $response->getCanonicalCount());
        // test results non correlated
        $expected = [['message_id' => '1:234']];
        $this->assertEquals($expected, $response->getResults());
        $expected = [0 => '1:234'];
        $this->assertEquals($expected, $response->getResult(Zend_Mobile_Push_Response_Gcm::RESULT_MESSAGE_ID));

        $message = new Zend_Mobile_Push_Message_Gcm();
        $message->setToken(['ABCDEF']);
        $response->setMessage($message);
        $expected = ['ABCDEF' => '1:234'];
        $this->assertEquals($expected, $response->getResult(Zend_Mobile_Push_Response_Gcm::RESULT_MESSAGE_ID));
    }
}
