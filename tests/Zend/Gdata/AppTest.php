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
 * @package    Zend_Gdata
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id $
 */

require_once 'Zend/Gdata/App.php';
require_once 'Zend/Gdata/HttpClient.php';
require_once 'Zend/Gdata/TestUtility/MockHttpClient.php';

/**
 * @category   Zend
 * @package    Zend_Gdata_App
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Gdata
 * @group      Zend_Gdata_App
 */
class Zend_Gdata_AppTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->fileName = 'Zend/Gdata/App/_files/FeedSample1.xml';
        $this->expectedEtag = 'W/"CkcHQH8_fCp7ImA9WxRTGEw."';
        $this->expectedMajorProtocolVersion = 1;
        $this->expectedMinorProtocolVersion = 2;
        $this->httpEntrySample = $this->loadResponse(
            dirname(__FILE__) . '/_files/AppSample1.txt'
        );
        $this->httpEntrySampleWithoutVersion = $this->loadResponse(
            dirname(__FILE__) . '/_files/AppSample2.txt'
        );
        $this->httpFeedSample = $this->loadResponse(
            dirname(__FILE__) . '/_files/AppSample3.txt'
        );
        $this->httpFeedSampleWithoutVersion = $this->loadResponse(
            dirname(__FILE__) . '/_files/AppSample4.txt'
        );

        $this->adapter = new Test_Zend_Gdata_MockHttpClient();
        $this->client = new Zend_Gdata_HttpClient();
        $this->client->setAdapter($this->adapter);
        $this->service = new Zend_Gdata_App($this->client);
    }

    public function loadResponse($filename)
    {
        $response = file_get_contents($filename);

        // Line endings are sometimes an issue inside the canned responses; the
        // following is a negative lookbehind assertion, and replaces any \n
        // not preceded by \r with the sequence \r\n, ensuring that the message
        // is well-formed.
        return preg_replace("#(?<!\r)\n#", "\r\n", $response);
    }

    public function testImportFile()
    {
        $feed = Zend_Gdata_App::importFile($this->fileName,
                'Zend_Gdata_App_Feed', true);
        $this->assertEquals('dive into mark', $feed->title->text);
    }

    public function testSetAndGetHttpMethodOverride()
    {
        Zend_Gdata_App::setHttpMethodOverride(true);
        $this->assertEquals(true, Zend_Gdata_App::getHttpMethodOverride());
    }

    public function testSetAndGetProtocolVersion()
    {
        $this->service->setMajorProtocolVersion(2);
        $this->service->setMinorProtocolVersion(1);
        $this->assertEquals(2, $this->service->getMajorProtocolVersion());
        $this->assertEquals(1, $this->service->getMinorProtocolVersion());
    }

    public function testDefaultProtocolVersionIs1X()
    {
        $this->assertEquals(1, $this->service->getMajorProtocolVersion());
        $this->assertEquals(null, $this->service->getMinorProtocolVersion());
    }

    public function testMajorProtocolVersionCannotBeLessThanOne()
    {
        $exceptionCaught = false;
        try {
            $this->service->setMajorProtocolVersion(0);
        } catch (Zend_Gdata_App_InvalidArgumentException $e) {
            $exceptionCaught = true;
        }
        $this->assertTrue($exceptionCaught, 'Expected exception not caught: '
                + 'Zend_Gdata_App_InvalidArgumentException');
    }

    public function testMajorProtocolVersionCannotBeNull()
    {
        $exceptionCaught = false;
        try {
            $this->service->setMajorProtocolVersion(null);
        } catch (Zend_Gdata_App_InvalidArgumentException $e) {
            $exceptionCaught = true;
        }
        $this->assertTrue($exceptionCaught, 'Expected exception not caught: '
                + 'Zend_Gdata_App_InvalidArgumentException');
    }

    public function testMinorProtocolVersionCannotBeLessThanZero()
    {
        $exceptionCaught = false;
        try {
            $this->service->setMinorProtocolVersion(-1);
        } catch (Zend_Gdata_App_InvalidArgumentException $e) {
            $exceptionCaught = true;
        }
        $this->assertTrue($exceptionCaught, 'Expected exception not caught: '
                + 'Zend_Gdata_App_InvalidArgumentException');
    }

    public function testNoGdataVersionHeaderSentWhenUsingV1()
    {
        $this->adapter->setResponse(['HTTP/1.1 200 OK\r\n\r\n']);

        $this->service->setMajorProtocolVersion(1);
        $this->service->setMinorProtocolVersion(null);
        $this->service->get('http://www.example.com');

        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if (strstr($header, 'GData-Version:'))
                $found = true;
        }
        $this->assertFalse($found, 'Version header found in V1 feed');
    }

    public function testNoGdataVersionHeaderSentWhenUsingV1X()
    {
        $this->adapter->setResponse(['HTTP/1.1 200 OK\r\n\r\n']);

        $this->service->setMajorProtocolVersion(1);
        $this->service->setMinorProtocolVersion(1);
        $this->service->get('http://www.example.com');

        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if (strstr($header, 'GData-Version:'))
                $found = true;
        }
        $this->assertTrue(!$found, 'Version header found in V1 feed');
    }

    public function testGdataVersionHeaderSentWhenUsingV2()
    {
        $this->adapter->setResponse(['HTTP/1.1 200 OK\r\n\r\n']);

        $this->service->setMajorProtocolVersion(2);
        $this->service->setMinorProtocolVersion(null);
        $this->service->get('http://www.example.com');

        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'GData-Version: 2')
                $found = true;
        }
        $this->assertTrue($found, 'Version header not found or incorrect');
    }

    public function testGdataVersionHeaderSentWhenUsingV2X()
    {
        $this->adapter->setResponse(['HTTP/1.1 200 OK\r\n\r\n']);

        $this->service->setMajorProtocolVersion(2);
        $this->service->setMinorProtocolVersion(1);
        $this->service->get('http://www.example.com');

        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'GData-Version: 2')
                $found = true;
        }
        $this->assertTrue($found, 'Version header not found or incorrect');
    }

    public function testHTTPETagsPropagateToEntriesOnGet()
    {
        $this->adapter->setResponse($this->httpEntrySample);
        $entry = $this->service->getEntry('http://www.example.com');
        $this->assertEquals($this->expectedEtag, $entry->getEtag());
    }

    public function testHTTPETagsPropagateToEntriesOnUpdate()
    {
        $this->adapter->setResponse($this->httpEntrySample);
        $entry = new Zend_Gdata_App_Entry();
        $newEntry = $this->service->updateEntry($entry, 'http://www.example.com');
        $this->assertEquals($this->expectedEtag, $newEntry->getEtag());
    }

    public function testHTTPEtagsPropagateToEntriesOnInsert()
    {
        $this->adapter->setResponse($this->httpEntrySample);
        $entry = new Zend_Gdata_App_Entry();
        $newEntry = $this->service->insertEntry($entry, 'http://www.example.com');
        $this->assertEquals($this->expectedEtag, $newEntry->getEtag());
    }

    public function testIfMatchHTTPHeaderSetOnUpdate()
    {
        $etag = 'ABCD1234';
        $this->adapter->setResponse("HTTP/1.1 201 Created");
        $this->service->setMajorProtocolVersion(2);
        $entry = new Zend_Gdata_App_Entry();
        $entry->link = [new Zend_Gdata_App_Extension_Link(
                'http://www.example.com',
                'edit',
                'application/atom+xml')];
        $entry->setEtag($etag);
        $this->service->updateEntry($entry);
        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'If-Match: ' . $etag)
                $found = true;
        }
        $this->assertTrue($found, 'If-Match header not found or incorrect');
    }

    public function testIfMatchHTTPHeaderSetOnUpdateIfWeak()
    {
        $etag = 'W/ABCD1234';
        $this->adapter->setResponse("HTTP/1.1 201 Created");
        $this->service->setMajorProtocolVersion(2);
        $entry = new Zend_Gdata_App_Entry();
        $entry->link = [new Zend_Gdata_App_Extension_Link(
                'http://www.example.com',
                'edit',
                'application/atom+xml')];
        $entry->setEtag($etag);
        $this->service->updateEntry($entry);
        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'If-Match: ' . $etag)
                $found = true;
        }
        $this->assertFalse($found, 'If-Match header found');
    }

    public function testIfMatchHTTPHeaderSetOnSave()
    {
        $etag = 'ABCD1234';
        $this->adapter->setResponse("HTTP/1.1 201 Created");
        $this->service->setMajorProtocolVersion(2);
        $entry = $this->service->newEntry();
        $entry->link = [new Zend_Gdata_App_Extension_Link(
                'http://www.example.com',
                'edit',
                'application/atom+xml')];
        $entry->setEtag($etag);
        $entry->setService($this->service);
        $entry->save();
        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'If-Match: ' . $etag)
                $found = true;
        }
        $this->assertTrue($found, 'If-Match header not found or incorrect');
    }

    public function testIfMatchHTTPHeaderNotSetOnDelete()
    {
        $etag = 'ABCD1234';
        $this->adapter->setResponse("HTTP/1.1 201 Created");
        $this->service->setMajorProtocolVersion(2);
        $entry = $this->service->newEntry();
        $entry->link = [new Zend_Gdata_App_Extension_Link(
                'http://www.example.com',
                'edit',
                'application/atom+xml')];
        $entry->setEtag($etag);
        $entry->setService($this->service);
        $entry->delete();
        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'If-Match: ' . $etag)
                $found = true;
        }
        $this->assertFalse($found, 'If-Match header found on delete');
    }

    public function testIfMatchHTTPHeaderSetOnManualPost()
    {
        $etag = 'ABCD1234';
        $this->adapter->setResponse("HTTP/1.1 201 Created");
        $this->service->setMajorProtocolVersion(2);
        $entry = $this->service->newEntry();
        $entry->setEtag($etag);
        $entry->setService($this->service);
        $this->service->post($entry, 'http://www.example.com');
        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'If-Match: ' . $etag)
                $found = true;
        }
        $this->assertTrue($found, 'If-Match header not found or incorrect');
    }

    public function testIfMatchHTTPHeaderSetOnManualPut()
    {
        $etag = 'ABCD1234';
        $this->adapter->setResponse("HTTP/1.1 201 Created");
        $this->service->setMajorProtocolVersion(2);
        $entry = $this->service->newEntry();
        $entry->link = [new Zend_Gdata_App_Extension_Link(
                'http://www.example.com',
                'edit',
                'application/atom+xml')];
        $entry->setEtag($etag);
        $entry->setService($this->service);
        $this->service->put($entry);
        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'If-Match: ' . $etag)
                $found = true;
        }
        $this->assertTrue($found, 'If-Match header not found or incorrect');
    }

    public function testIfMatchHTTPHeaderSetOnManualDelete()
    {
        $etag = 'ABCD1234';
        $this->adapter->setResponse("HTTP/1.1 201 Created");
        $this->service->setMajorProtocolVersion(2);
        $entry = $this->service->newEntry();
        $entry->link = [new Zend_Gdata_App_Extension_Link(
                'http://www.example.com',
                'edit',
                'application/atom+xml')];
        $entry->setEtag($etag);
        $entry->setService($this->service);
        $this->service->delete($entry);
        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'If-Match: ' . $etag)
                $found = true;
        }
        $this->assertFalse($found, 'If-Match header found on delete');
    }

    public function testIfMatchHeaderCanBeSetOnInsert() {
        $etagOverride = 'foo';
        $etag = 'ABCD1234';
        $this->service->setMajorProtocolVersion(2);
        $this->adapter->setResponse($this->httpEntrySample);
        $entry = new Zend_Gdata_App_Entry();
        $entry->setEtag($etag);
        $newEntry = $this->service->insertEntry($entry,
                'http://www.example.com',
                'Zend_Gdata_App_Entry',
                ['If-Match' => $etagOverride]);
        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'If-Match: ' . $etagOverride)
                $found = true;
        }
        $this->assertTrue($found, 'If-Match header not found or incorrect');
    }

    public function testIfNoneMatchHeaderCanBeSetOnInsert() {
        $etagOverride = 'foo';
        $etag = 'ABCD1234';
        $this->service->setMajorProtocolVersion(2);
        $this->adapter->setResponse($this->httpEntrySample);
        $entry = new Zend_Gdata_App_Entry();
        $entry->setEtag($etag);
        $newEntry = $this->service->insertEntry($entry,
                'http://www.example.com',
                'Zend_Gdata_App_Entry',
                ['If-None-Match' => $etagOverride]);
        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'If-None-Match: ' . $etagOverride)
                $found = true;
        }
        $this->assertTrue($found, 'If-None-Match header not found or incorrect ');
    }

    public function testIfMatchHeaderCanBeSetOnUpdate() {
        $etagOverride = 'foo';
        $etag = 'ABCD1234';
        $this->service->setMajorProtocolVersion(2);
        $this->adapter->setResponse($this->httpEntrySample);
        $entry = new Zend_Gdata_App_Entry();
        $entry->setEtag($etag);
        $newEntry = $this->service->updateEntry($entry,
                'http://www.example.com',
                'Zend_Gdata_App_Entry',
                ['If-Match' => $etagOverride]);
        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'If-Match: ' . $etagOverride)
                $found = true;
        }
        $this->assertTrue($found, 'If-Match header not found or incorrect or incorrect');
    }

    public function testIfNoneMatchHeaderCanBeSetOnUpdate() {
        $etagOverride = 'foo';
        $etag = 'ABCD1234';
        $this->service->setMajorProtocolVersion(2);
        $this->adapter->setResponse($this->httpEntrySample);
        $entry = new Zend_Gdata_App_Entry();
        $entry->setEtag($etag);
        $newEntry = $this->service->updateEntry($entry,
                'http://www.example.com',
                'Zend_Gdata_App_Entry',
                ['If-None-Match' => $etagOverride]);
        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'If-None-Match: ' . $etagOverride)
                $found = true;
        }
        $this->assertTrue($found, 'If-None-Match header not found or incorrect');
    }

    /**
     * @group ZF-8397
     */
    public function testIfMatchHTTPHeaderIsResetEachRequest()
    {
        // Update an entry
        $etag = 'ABCD1234';
        $this->adapter->setResponse("HTTP/1.1 201 Created");
        $this->service->setMajorProtocolVersion(2);
        $entry = new Zend_Gdata_App_Entry();
        $entry->link = [new Zend_Gdata_App_Extension_Link(
                'http://www.example.com',
                'edit',
                'application/atom+xml')];
        $entry->setEtag($etag);
        $this->service->updateEntry($entry);

        // Get another entry without ETag set,
        // Previous value of If-Match HTTP header should not be sent
        $this->adapter->setResponse($this->httpEntrySample);
        $entry = $this->service->getEntry('http://www.example.com');
        $headers = $this->adapter->popRequest()->headers;
        $found = false;
        foreach ($headers as $header) {
            if ($header == 'If-Match: ' . $etag)
                $found = true;
        }
        $this->assertFalse($found, 'If-Match header found');
    }

    public function testGenerateIfMatchHeaderDataReturnsEtagIfV2() {
        $etag = 'ABCD1234';
        $this->service->setMajorProtocolVersion(2);
        $entry = new Zend_Gdata_App_Entry();
        $entry->setEtag($etag);
        $result = $this->service->generateIfMatchHeaderData($entry, false);
        $this->assertEquals($etag, $result);
    }

    public function testGenerateIfMatchHeaderDataReturnsNullIfV1() {
        $etag = 'ABCD1234';
        $this->service->setMajorProtocolVersion(1);
        $entry = new Zend_Gdata_App_Entry();
        $entry->setEtag($etag);
        $result = $this->service->generateIfMatchHeaderData($entry, false);
        $this->assertEquals(null, $result);
    }

    public function testGenerateIfMatchHeaderDataReturnsNullIfNotEntry() {
        $this->service->setMajorProtocolVersion(2);
        $result = $this->service->generateIfMatchHeaderData("Hello world", false);
        $this->assertEquals(null, $result);
    }

    public function testGenerateIfMatchHeaderDataReturnsNullIfWeak() {
        $etag = 'W/ABCD1234';
        $this->service->setMajorProtocolVersion(2);
        $entry = new Zend_Gdata_App_Entry();
        $entry->setEtag($etag);
        $result = $this->service->generateIfMatchHeaderData($entry, false);
        $this->assertEquals(null, $result);
    }

    public function testGenerateIfMatchHeaderDataReturnsEtagIfWeakAndFlagSet() {
        $etag = 'W/ABCD1234';
        $this->service->setMajorProtocolVersion(2);
        $entry = new Zend_Gdata_App_Entry();
        $entry->setEtag($etag);
        $result = $this->service->generateIfMatchHeaderData($entry, true);
        $this->assertEquals($etag, $result);
    }

    public function testGenerateIfMatchHeaderDataReturnsEtagIfNotWeakAndFlagSet() {
        $etag = 'ABCD1234';
        $this->service->setMajorProtocolVersion(2);
        $entry = new Zend_Gdata_App_Entry();
        $entry->setEtag($etag);
        $result = $this->service->generateIfMatchHeaderData($entry, true);
        $this->assertEquals($etag, $result);
    }

    public function testImportUrlSetsMajorProtocolVersionOnEntry() {
        $this->adapter->setResponse($this->httpEntrySample);
        $entry = $this->service->getEntry('http://www.example.com');
        $this->assertEquals($this->expectedMajorProtocolVersion, $entry->getMajorProtocolVersion());
    }

    public function testImportUrlSetsMinorProtocolVersionOnEntry() {
        $this->adapter->setResponse($this->httpEntrySample);
        $entry = $this->service->getEntry('http://www.example.com');
        $this->assertEquals($this->expectedMinorProtocolVersion, $entry->getMinorProtocolVersion());
    }

    public function testImportUrlSetsNullVersionIfNoVersionHeaderOnEntry() {
        $this->adapter->setResponse($this->httpEntrySampleWithoutVersion);
        $entry = $this->service->getEntry('http://www.example.com');
        $this->assertEquals(null, $entry->getMinorProtocolVersion());
        $this->assertEquals(null, $entry->getMinorProtocolVersion());
    }

    public function testImportUrlSetsMajorProtocolVersionOnFeed() {
        $this->adapter->setResponse($this->httpFeedSample);
        $feed = $this->service->getFeed('http://www.example.com');
        $this->assertEquals($this->expectedMajorProtocolVersion, $feed->getMajorProtocolVersion());
        foreach ($feed as $entry) {
            $this->assertEquals($this->expectedMajorProtocolVersion, $entry->getMajorProtocolVersion());
        }
    }

    public function testImportUrlSetsMinorProtocolVersionOnFeed() {
        $this->adapter->setResponse($this->httpFeedSample);
        $feed = $this->service->getFeed('http://www.example.com');
        $this->assertEquals($this->expectedMinorProtocolVersion, $feed->getMinorProtocolVersion());
        foreach ($feed as $entry) {
            $this->assertEquals($this->expectedMinorProtocolVersion, $entry->getMinorProtocolVersion());
        }
    }

    public function testImportUrlSetsNullVersionIfNoVersionHeaderOnFeed() {
        $this->adapter->setResponse($this->httpFeedSampleWithoutVersion);
        $feed = $this->service->getFeed('http://www.example.com');
        $this->assertEquals(null, $feed->getMajorProtocolVersion());
        $this->assertEquals(null, $feed->getMinorProtocolVersion());
        foreach ($feed as $entry) {
            $this->assertEquals(null, $entry->getMajorProtocolVersion());
            $this->assertEquals(null, $entry->getMinorProtocolVersion());
        }
    }

    public function testMagicConstructorsPropogateMajorVersion() {
        $v = 42;
        $this->service->setMajorProtocolVersion($v);
        $feed = $this->service->newFeed();
        $this->assertEquals($v, $feed->getMajorProtocolVersion());
    }

    public function testMagicConstructorsPropogateMinorVersion() {
        $v = 84;
        $this->service->setMinorProtocolVersion($v);
        $feed = $this->service->newFeed();
        $this->assertEquals($v, $feed->getMinorProtocolVersion());
    }

    /**
     * When error handler is overridden to throw an ErrorException, the extension loader
     * in Zend_Gdata will throw an ErrorException when the class doesn't exist in the
     * first extension directory even if it exists in subsequent ones.  This test
     * enforces a fix that keeps this from happening
     *
     * @group ZF-12268
     * @group ZF-7013
     */
    public function testLoadExtensionCausesFatalErrorWhenErrorHandlerIsOverridden()
    {
        // Override the error handler to throw an ErrorException
        set_error_handler(function($a, $b, $c, $d) { throw new ErrorException($b, 0, $a, $c, $d); }, E_ALL);
        try {
            $eq = $this->service->newEventQuery();
            restore_error_handler();
            $this->assertTrue($eq instanceof Zend_Gdata_Calendar_EventQuery);
        } catch ( Zend_Gdata_App_Exception $ex ) {
            // If we catch this exception, it means the ErrorException resulting
            // from the include_once E_NOTICE was caught in the right place,
            // but the extension was not found in any directory
            // (Expected since we didn't load the Calendar extension dir)
            restore_error_handler();
            $this->assertContains('EventQuery', $ex->getMessage());
        } catch ( ErrorException $ex ) {
            restore_error_handler();
            $this->fail('Did not expect ErrorException');
        }
    }

    /**
     * @group ZF-10243
     */
    public function testStaticImportWithoutUsingObjectMapping()
    {
        $this->adapter->setResponse($this->httpEntrySample);
        $feed = Zend_Gdata_App::import(
            'http://www.example.com',
            $this->client,
            'Zend_Gdata_App_Feed',
            false
        );

        $this->assertContains('<id>12345678901234567890</id>', $feed);
    }

    public function testImportStringException()
    {
        try {
            Zend_Gdata_App::importString('foo');
        } catch (Exception $e) {
            self::assertInstanceOf('Zend_Gdata_App_Exception', $e);
            self::assertContains('DOMDocument', $e->getMessage());

            return;
        }

        self::fail('This test should throw an exception and return early');
    }

    public function testImportFileException()
    {
        try {
            Zend_Gdata_App::importFile('foo');
        } catch (Exception $e) {
            self::assertInstanceOf('Zend_Gdata_App_Exception', $e);
            self::assertContains('could not be loaded', $e->getMessage());

            return;
        }

        self::fail('This test should throw an exception and return early');
    }
}
