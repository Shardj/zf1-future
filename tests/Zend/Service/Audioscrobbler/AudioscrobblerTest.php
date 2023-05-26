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
 * @package    Zend_Service_Audioscrobbler
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Service_Audioscrobbler
 */
require_once 'Zend/Service/Audioscrobbler.php';

require_once 'AudioscrobblerTestCase.php';

/**
 * @category   Zend
 * @package    Zend_Service_Audioscrobbler
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Service
 * @group      Zend_Service_Audioscrobbler
 */
class Zend_Service_Audioscrobbler_AudioscrobblerTest extends Zend_Service_Audioscrobbler_AudioscrobblerTestCase
{
    public function testRequestThrowsHttpClientExceptionWithNoUserError()
    {
        $this->setAudioscrobblerResponse(self::readTestResponse('errorNoUserExists'));
        $as = $this->getAudioscrobblerService();
        $as->set('user', 'foobarfoo');

        try {
            $response = $as->userGetProfileInformation();
            $this->fail('Expected Zend_Http_Client_Exception not thrown');
        } catch (Zend_Http_Client_Exception $e) {
            $this->assertStringContainsString("No user exists with this name", $e->getMessage());
        }
    }

    public function testRequestThrowsHttpClientExceptionWithoutSuccessfulResponse()
    {
        $this->setAudioscrobblerResponse(self::readTestResponse('errorResponseStatusError'));
        $as = $this->getAudioscrobblerService();
        $as->set('user', 'foobarfoo');

        try {
            $response = $as->userGetProfileInformation();
            $this->fail('Expected Zend_Http_Client_Exception not thrown');
        } catch (Zend_Http_Client_Exception $e) {
            $this->assertStringContainsString("404", $e->getMessage());
        }
    }

    /**
     * @group ZF-4509
     */
    public function testSetViaCallIntercept()
    {
        $as = new Zend_Service_Audioscrobbler();
        $as->setUser("foobar");
        $as->setAlbum("Baz");
        $this->assertEquals("foobar", $as->get("user"));
        $this->assertEquals("Baz", $as->get("album"));
    }

    /**
     * @group ZF-6251
     */
    public function testUnknownMethodViaCallInterceptThrowsException()
    {
        $this->expectException("Zend_Service_Exception");

        $as = new Zend_Service_Audioscrobbler();
        $as->someInvalidMethod();
    }

    /**
     * @group ZF-6251
     */
    public function testCallInterceptMethodsRequireExactlyOneParameterAndThrowExceptionOtherwise()
    {
        $this->expectException("Zend_Service_Exception");

        $as = new Zend_Service_Audioscrobbler();
        $as->setUser();
    }

    public static function readTestResponse($file)
    {
        $message = file_get_contents(sprintf('%s/_files/%s', dirname(__FILE__), $file));
        // Line endings are sometimes an issue inside the canned responses; the
        // following is a negative lookbehind assertion, and replaces any \n
        // not preceded by \r with the sequence \r\n, ensuring that the message
        // is well-formed.
        return preg_replace("#(?<!\r)\n#", "\r\n", $message);
    }
}
