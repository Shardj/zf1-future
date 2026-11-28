<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

require_once 'Zend/Service/LastFm.php';
require_once 'Zend/Service/LastFm/Exception.php';
require_once 'Zend/Http/Client.php';
require_once 'Zend/Http/Client/Adapter/Test.php';

/**
 * @category   Zend
 * @package    Zend_Service_LastFm
 * @subpackage UnitTests
 * @group      Zend_Service
 * @group      Zend_Service_LastFm
 */
class Zend_Service_LastFm_LastFmTest extends TestCase
{
    /**
     * @var Zend_Http_Client_Adapter_Test
     */
    protected $_adapter;

    /**
     * @var Zend_Http_Client
     */
    protected $_client;

    /**
     * @var Zend_Service_LastFm
     */
    protected $_lastFm;

    protected function set_up()
    {
        $this->_adapter = new Zend_Http_Client_Adapter_Test();
        $this->_client  = new Zend_Http_Client(null, ['adapter' => $this->_adapter]);
        Zend_Service_LastFm::setHttpClient($this->_client);

        $this->_lastFm = new Zend_Service_LastFm('0123456789abcdef');
    }

    protected function tear_down()
    {
        Zend_Service_LastFm::setHttpClient(new Zend_Http_Client());
    }

    public function testCallSendsMethodApiKeyAndParameters()
    {
        $this->_respond('topartists.xml');

        $result = $this->_lastFm->call('user.getTopArtists', ['user' => 'rj', 'limit' => 2]);

        $request = $this->_client->getLastRequest();
        $this->assertStringStartsWith('GET /2.0/?', $request);
        $this->assertStringContainsString('Host: ws.audioscrobbler.com', $request);
        parse_str(substr(strtok($request, "\r\n"), strlen('GET /2.0/?'), -strlen(' HTTP/1.1')), $query);
        $this->assertSame(
            ['user' => 'rj', 'limit' => '2', 'method' => 'user.getTopArtists', 'api_key' => '0123456789abcdef'],
            $query
        );

        $this->assertInstanceOf(SimpleXMLElement::class, $result);
        $this->assertSame('lfm', $result->getName());
        $this->assertSame('rj', (string) $result->topartists['user']);
        $this->assertCount(2, $result->topartists->artist);
        $this->assertSame('Dream Theater', (string) $result->topartists->artist[0]->name);
        $this->assertSame('1337', (string) $result->topartists->artist[0]->playcount);
    }

    public function testApiMethodCalledAsMethodOfTheClient()
    {
        $this->_respond('topartists.xml');

        $result = $this->_lastFm->userGetTopArtists(['user' => 'rj']);

        $this->assertStringContainsString('method=user.getTopArtists', $this->_client->getLastRequest());
        $this->assertSame('Tool', (string) $result->topartists->artist[1]->name);
    }

    public function testApiMethodWithoutParameters()
    {
        $this->_respond('topartists.xml');

        $this->_lastFm->chartGetTopArtists();

        $this->assertStringContainsString('method=chart.getTopArtists', $this->_client->getLastRequest());
    }

    /**
     * The shared client must not carry the parameters of one call to the next
     */
    public function testParametersOfAnEarlierCallAreNotSentAgain()
    {
        $this->_respond('topartists.xml');
        $this->_lastFm->call('user.getTopArtists', ['user' => 'rj', 'period' => '7day']);

        $this->_respond('topartists.xml');
        $this->_lastFm->call('chart.getTopArtists');

        $request = $this->_client->getLastRequest();
        $this->assertStringNotContainsString('period=', $request);
        $this->assertStringNotContainsString('user=', $request);
    }

    public function testErrorOfTheApiIsAnException()
    {
        $this->_respond('error.xml', '403 Forbidden');

        try {
            $this->_lastFm->call('user.getTopArtists', ['user' => 'rj']);
            $this->fail('Zend_Service_LastFm_Exception was expected');
        } catch (Zend_Service_LastFm_Exception $e) {
            $this->assertSame('Invalid API key - You must be granted a valid key by last.fm', $e->getMessage());
            $this->assertSame(10, $e->getCode());
        }
    }

    public function testResponseThatIsNoApiResponse()
    {
        $this->_adapter->setResponse(
            "HTTP/1.1 502 Bad Gateway\r\nContent-Type: text/html\r\n\r\n<html><body>Bad Gateway</body></html>"
        );

        $this->expectException(Zend_Service_LastFm_Exception::class);
        $this->expectExceptionMessage('HTTP status 502');
        $this->_lastFm->call('user.getTopArtists', ['user' => 'rj']);
    }

    public function testEmptyResponse()
    {
        $this->_adapter->setResponse("HTTP/1.1 200 OK\r\nContent-Type: text/xml\r\n\r\n");

        $this->expectException(Zend_Service_LastFm_Exception::class);
        $this->_lastFm->call('user.getTopArtists', ['user' => 'rj']);
    }

    /**
     * @dataProvider invalidMethodProvider
     */
    public function testInvalidApiMethod($method)
    {
        $this->expectException(Zend_Service_LastFm_Exception::class);
        $this->_lastFm->call($method);
    }

    /**
     * @return array
     */
    public static function invalidMethodProvider()
    {
        return [
            'no package'   => ['getTopArtists'],
            'path'         => ['user/getTopArtists'],
            'query string' => ['user.getTopArtists&api_key=x'],
            'empty'        => [''],
            'not a string' => [null],
        ];
    }

    public function testResponseFormatCannotBeChanged()
    {
        $this->expectException(Zend_Service_LastFm_Exception::class);
        $this->_lastFm->call('user.getTopArtists', ['user' => 'rj', 'format' => 'json']);
    }

    public function testUnknownMethodOfTheClient()
    {
        $this->expectException(Zend_Service_LastFm_Exception::class);
        $this->expectExceptionMessage('Call to undefined method Zend_Service_LastFm::unknown()');
        $this->_lastFm->unknown();
    }

    public function testParametersHaveToBeAnArray()
    {
        $this->expectException(Zend_Service_LastFm_Exception::class);
        $this->_lastFm->userGetTopArtists('rj');
    }

    public function testApiKeyIsRequired()
    {
        $this->expectException(Zend_Service_LastFm_Exception::class);
        new Zend_Service_LastFm('');
    }

    public function testUriOfTheApiCanBeChanged()
    {
        $this->_respond('topartists.xml');

        $this->assertSame(Zend_Service_LastFm::API_URI, $this->_lastFm->getUri());
        $this->_lastFm->setUri('http://localhost:8080/lastfm/');
        $this->_lastFm->call('chart.getTopArtists');

        $request = $this->_client->getLastRequest();
        $this->assertStringStartsWith('GET /lastfm/?', $request);
        $this->assertStringContainsString('Host: localhost:8080', $request);
    }

    /**
     * @param string $file   Response body in _files
     * @param string $status
     */
    protected function _respond($file, $status = '200 OK')
    {
        $this->_adapter->setResponse(
            "HTTP/1.1 $status\r\nContent-Type: text/xml; charset=UTF-8\r\n\r\n"
            . file_get_contents(__DIR__ . '/_files/' . $file)
        );
    }
}
