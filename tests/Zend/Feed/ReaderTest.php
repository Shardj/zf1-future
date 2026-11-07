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
 * @package    Zend_Feed
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Feed/Reader.php';
require_once 'Zend/Cache.php';

/**
 * @category   Zend
 * @package    Zend_Feed
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Feed
 * @group      Zend_Feed_Reader
 */
class Zend_Feed_ReaderTest extends TestCase
{
    protected $_feedSamplePath = null;

    protected function set_up()
    {
        $this->_feedSamplePath = dirname(__FILE__) . '/Reader/_files';
    }

    protected function tear_down()
    {
        Zend_Feed_Reader::reset();
    }

    public function testDetectsFeedIsRss20()
    {
        $feed = Zend_Feed_Reader::importString(
            file_get_contents($this->_feedSamplePath . '/Reader/rss20.xml')
        );
        $type = Zend_Feed_Reader::detectType($feed);
        $this->assertEquals(Zend_Feed_Reader::TYPE_RSS_20, $type);
    }

    public function testDetectsFeedIsRss094()
    {
        $feed = Zend_Feed_Reader::importString(
            file_get_contents($this->_feedSamplePath . '/Reader/rss094.xml')
        );
        $type = Zend_Feed_Reader::detectType($feed);
        $this->assertEquals(Zend_Feed_Reader::TYPE_RSS_094, $type);
    }

    public function testDetectsFeedIsRss093()
    {
        $feed = Zend_Feed_Reader::importString(
            file_get_contents($this->_feedSamplePath . '/Reader/rss093.xml')
        );
        $type = Zend_Feed_Reader::detectType($feed);
        $this->assertEquals(Zend_Feed_Reader::TYPE_RSS_093, $type);
    }

    public function testDetectsFeedIsRss092()
    {
        $feed = Zend_Feed_Reader::importString(
            file_get_contents($this->_feedSamplePath . '/Reader/rss092.xml')
        );
        $type = Zend_Feed_Reader::detectType($feed);
        $this->assertEquals(Zend_Feed_Reader::TYPE_RSS_092, $type);
    }

    public function testDetectsFeedIsRss091()
    {
        $feed = Zend_Feed_Reader::importString(
            file_get_contents($this->_feedSamplePath . '/Reader/rss091.xml')
        );
        $type = Zend_Feed_Reader::detectType($feed);
        $this->assertEquals(Zend_Feed_Reader::TYPE_RSS_091, $type);
    }

    public function testDetectsFeedIsRss10()
    {
        $feed = Zend_Feed_Reader::importString(
            file_get_contents($this->_feedSamplePath . '/Reader/rss10.xml')
        );
        $type = Zend_Feed_Reader::detectType($feed);
        $this->assertEquals(Zend_Feed_Reader::TYPE_RSS_10, $type);
    }

    public function testDetectsFeedIsRss090()
    {
        $feed = Zend_Feed_Reader::importString(
            file_get_contents($this->_feedSamplePath . '/Reader/rss090.xml')
        );
        $type = Zend_Feed_Reader::detectType($feed);
        $this->assertEquals(Zend_Feed_Reader::TYPE_RSS_090, $type);
    }

    public function testDetectsFeedIsAtom10()
    {
        $feed = Zend_Feed_Reader::importString(
            file_get_contents($this->_feedSamplePath . '/Reader/atom10.xml')
        );
        $type = Zend_Feed_Reader::detectType($feed);
        $this->assertEquals(Zend_Feed_Reader::TYPE_ATOM_10, $type);
    }

    public function testDetectsFeedIsAtom03()
    {
        $feed = Zend_Feed_Reader::importString(
            file_get_contents($this->_feedSamplePath . '/Reader/atom03.xml')
        );
        $type = Zend_Feed_Reader::detectType($feed);
        $this->assertEquals(Zend_Feed_Reader::TYPE_ATOM_03, $type);
    }

    /**
     * @group ZF-9723
     */
    public function testDetectsTypeFromStringOrToRemindPaddyAboutForgettingATestWhichLetsAStupidTypoSurviveUnnoticedForMonths()
    {
        $feed = '<?xml version="1.0" encoding="utf-8" ?><rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/"><channel></channel></rdf:RDF>';
        $type = Zend_Feed_Reader::detectType($feed);
        $this->assertEquals(Zend_Feed_Reader::TYPE_RSS_10, $type);
    }

    public function testGetEncoding()
    {
        $feed = Zend_Feed_Reader::importString(
            file_get_contents(dirname(__FILE__) . '/Reader/Entry/_files/Atom/title/plain/atom10.xml')
        );

        $this->assertEquals('utf-8', $feed->getEncoding());
        $this->assertEquals('utf-8', $feed->current()->getEncoding());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testImportsFile()
    {
        try {
            $feed = Zend_Feed_Reader::importFile(
                dirname(__FILE__) . '/Reader/Entry/_files/Atom/title/plain/atom10.xml'
            );
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    /**
     * Lets Zend_Feed_Reader answer the HTTP requests with the given bodies
     *
     * @param  array $bodies response bodies in request order
     * @return void
     */
    protected function _answerWith(array $bodies)
    {
        $adapter = new Zend_Http_Client_Adapter_Test();
        foreach ($bodies as $i => $body) {
            $response = new Zend_Http_Response(200, ['Content-Type' => 'text/html'], $body);
            $i === 0 ? $adapter->setResponse($response) : $adapter->addResponse($response);
        }
        Zend_Feed_Reader::setHttpClient(new Zend_Http_Client(null, ['adapter' => $adapter]));
    }

    public function testImportsUri()
    {
        $this->_answerWith([file_get_contents($this->_feedSamplePath . '/Reader/rss20.xml')]);
        $feed = Zend_Feed_Reader::import('http://www.example.com/rdf/');
        $this->assertInstanceOf('Zend_Feed_Reader_Feed_Rss', $feed);
        $this->assertEquals(Zend_Feed_Reader::TYPE_RSS_20, $feed->getType());
    }

    /**
     * @group ZF-8328
     */
    public function testImportsUriAndThrowsExceptionIfNotAFeed()
    {
        $this->_answerWith(['<!DOCTYPE html><html><head><title>Not a feed</title></head><body></body></html>']);
        $this->expectException(Zend_Feed_Exception::class);
        Zend_Feed_Reader::import('http://www.example.com/');
    }

    public function testGetsFeedLinksAsValueObject()
    {
        $this->_answerWith(['<html><head><link rel="alternate" type="application/rss+xml" href="http://www.example.com/rss/"></head><body></body></html>']);
        $links = Zend_Feed_Reader::findFeedLinks('http://www.example.com');
        $this->assertEquals('http://www.example.com/rss/', $links->rss);
    }

    public function testCompilesLinksAsArrayObject()
    {
        $this->_answerWith(['<html><head><link rel="alternate" type="application/rss+xml" href="http://www.example.com/rss/"></head><body></body></html>']);
        $links = Zend_Feed_Reader::findFeedLinks('http://www.example.com');
        $this->assertTrue($links instanceof Zend_Feed_Reader_FeedSet);
        $this->assertEquals([
            'rel' => 'alternate', 'type' => 'application/rss+xml', 'href' => 'http://www.example.com/rss/'
        ], (array) $links->getIterator()->current());
    }

    public function testFeedSetLoadsFeedObjectWhenFeedArrayKeyAccessed()
    {
        $this->_answerWith([
            '<html><head><link rel="alternate" type="application/rss+xml" href="http://www.example.com/rss/"></head><body></body></html>',
            file_get_contents($this->_feedSamplePath . '/Reader/rss20.xml'),
        ]);
        $links = Zend_Feed_Reader::findFeedLinks('http://www.example.com');
        $link = $links->getIterator()->current();
        $this->assertTrue($link['feed'] instanceof Zend_Feed_Reader_Feed_Rss);
    }

    public function testZeroCountFeedSetReturnedFromEmptyList()
    {
        $this->_answerWith(['<html><head><title>No feeds</title></head><body></body></html>']);
        $links = Zend_Feed_Reader::findFeedLinks('http://www.example.com');
        $this->assertEquals(0, count($links));
    }

    /**
     * @group ZF-8327
     */
    public function testGetsFeedLinksAndTrimsNewlines()
    {
        $this->_answerWith(["<html><head><link rel=\"alternate\" type=\"application/rss+xml\" href=\"\n http://feeds.example.com/blog\n\"></head><body></body></html>"]);
        $links = Zend_Feed_Reader::findFeedLinks('http://www.example.com');
        $this->assertEquals('http://feeds.example.com/blog', $links->rss);
    }

    /**
     * @group ZF-8330
     */
    public function testGetsFeedLinksAndNormalisesRelativeUrls()
    {
        $this->_answerWith(['<html><head><link rel="alternate" type="application/rss+xml" href="/rss.xml"></head><body></body></html>']);
        $links = Zend_Feed_Reader::findFeedLinks('http://www.example.com');
        $this->assertEquals('http://www.example.com/rss.xml', $links->rss);
    }

    public function testFindFeedLinksRestoresTheLibxmlErrorSetting()
    {
        $currClient = Zend_Feed_Reader::getHttpClient();
        $testAdapter = new Zend_Http_Client_Adapter_Test();
        $testAdapter->setResponse(new Zend_Http_Response(200, [], ''));
        Zend_Feed_Reader::setHttpClient(new Zend_Http_Client(null, ['adapter' => $testAdapter]));

        // PHP 7.4 warns about the empty document, PHP 8 throws a ValueError
        $thrown = null;
        $useInternalErrors = libxml_use_internal_errors(false);
        try {
            Zend_Feed_Reader::findFeedLinks('http://foo/bar');
        } catch (Throwable $e) {
            $thrown = $e;
        } finally {
            $useInternalErrorsAfter = libxml_use_internal_errors($useInternalErrors);
            Zend_Feed_Reader::setHttpClient($currClient);
        }

        $this->assertNotNull($thrown, 'An empty document has not been rejected');
        $this->assertFalse($useInternalErrorsAfter);
    }

    /**
     * @group ZF-8330
     */
    public function testGetsFeedLinksAndNormalisesRelativeUrlsOnUriWithPath()
    {
        try {
            $currClient = Zend_Feed_Reader::getHttpClient();

            $testAdapter = new Zend_Http_Client_Adapter_Test();
            $testAdapter->setResponse(new Zend_Http_Response(200, [], '<!DOCTYPE html><html><head><link rel="alternate" type="application/rss+xml" href="../test.rss"><link rel="alternate" type="application/atom+xml" href="/test.atom"></head><body></body></html>'));
            Zend_Feed_Reader::setHttpClient(new Zend_Http_Client(null, ['adapter' => $testAdapter]));

            $links = Zend_Feed_Reader::findFeedLinks('http://foo/bar');

            Zend_Feed_Reader::setHttpClient($currClient);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }

        $this->assertEquals('http://foo/test.rss', $links->rss);
        $this->assertEquals('http://foo/test.atom', $links->atom);
    }

    public function testAddsPrefixPath()
    {
        Zend_Feed_Reader::addPrefixPath('A_B_C', '/A/B/C');
        $prefixPaths = Zend_Feed_Reader::getPluginLoader()->getPaths();
        $this->assertEquals('/A/B/C/', $prefixPaths['A_B_C_'][0]);
    }

    public function testRegistersUserExtension()
    {
        try {
            Zend_Feed_Reader::addPrefixPath('My_FeedReader_Extension', dirname(__FILE__) . '/Reader/_files/My/Extension');
            Zend_Feed_Reader::registerExtension('JungleBooks');
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
        $this->assertTrue(Zend_Feed_Reader::isRegistered('JungleBooks'));
    }
    
    /**
     * @group ZF-11184
     */
    public function testImportingUriWithEmptyResponseBodyTriggersException()
    {
        $currClient = Zend_Feed_Reader::getHttpClient();
        $testAdapter = new Zend_Http_Client_Adapter_Test();
        $testAdapter->setResponse(new Zend_Http_Response(200, [], ''));
        Zend_Feed_Reader::setHttpClient(new Zend_Http_Client(null, [
            'adapter' => $testAdapter
        ]));
        
        $this->expectException('Zend_Feed_Exception');
        $this->expectExceptionMessage('Feed failed to load');
        $result = Zend_Feed_Reader::import('http://www.example.com');
    }

    public function testXxePreventionOnFeedParsing()
    {
        $string = file_get_contents($this->_feedSamplePath . '/Reader/xxe-atom10.xml');
        $string = str_replace('XXE_URI', $this->_feedSamplePath . '/Reader/xxe-info.txt', $string);
        $this->expectException('Zend_Feed_Exception');
        $feed = Zend_Feed_Reader::importString($string);
    }

    public function testDetectTypeException()
    {
        try {
            Zend_Feed_Reader::detectType('foo');
        } catch (Zend_Feed_Exception $e) {
            self::assertInstanceOf('Zend_Feed_Exception', $e);

            return;
        }

        self::fail('Illegal string should create an exception');
    }
 
    protected function _getTempDirectory()
    {
        $tmpdir = [];
        foreach ([$_ENV, $_SERVER] as $tab) {
            foreach (['TMPDIR', 'TEMP', 'TMP', 'windir', 'SystemRoot'] as $key) {
                if (isset($tab[$key])) {
                    if (($key == 'windir') || ($key == 'SystemRoot')) {
                        $dir = realpath($tab[$key] . '\\temp');
                    } else {
                        $dir = realpath($tab[$key]);
                    }
                    if ($this->_isGoodTmpDir($dir)) {
                        return $dir;
                    }
                }
            }
        }
        if (function_exists('sys_get_temp_dir')) {
            $dir = sys_get_temp_dir();
            if ($this->_isGoodTmpDir($dir)) {
                return $dir;
            }
        }
        $tempFile = tempnam(md5(uniqid(rand(), true)), '');
        if ($tempFile) {
            $dir = realpath(dirname($tempFile));
            unlink($tempFile);
            if ($this->_isGoodTmpDir($dir)) {
                return $dir;
            }
        }
        if ($this->_isGoodTmpDir('/tmp')) {
            return '/tmp';
        }
        if ($this->_isGoodTmpDir('\\temp')) {
            return '\\temp';
        }
    }

    protected function _isGoodTmpDir($dir)
    {
        if (is_readable($dir) && is_writable($dir)) {
            return true;
        }
        return false;
    }
}
