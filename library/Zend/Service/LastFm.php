<?php
require_once 'Zend/Service/Abstract.php';

/**
 * Client for the read methods of the Last.fm API 2.0 (https://www.last.fm/api)
 *
 * Every API method "package.method" can be called by its name,
 *
 *     $lastFm = new Zend_Service_LastFm($apiKey);
 *     $result = $lastFm->call('user.getTopArtists', ['user' => 'rj', 'limit' => 10]);
 *
 * or as a method of this class, named by the package followed by the method:
 *
 *     $result = $lastFm->userGetTopArtists(['user' => 'rj', 'limit' => 10]);
 *
 * The result is the XML response of the API, with <lfm status="ok"> as its root:
 *
 *     foreach ($result->topartists->artist as $artist) {
 *         echo $artist->name;
 *     }
 *
 * Methods that write (scrobbling, tagging, ...) need a signed request of an
 * authenticated user, which this client does not send.
 *
 * @category   Zend
 * @package    Zend_Service
 * @subpackage LastFm
 */
class Zend_Service_LastFm extends Zend_Service_Abstract
{
    public const API_URI = 'https://ws.audioscrobbler.com/2.0/';

    /**
     * @var string
     */
    protected $_apiKey;

    /**
     * @var string
     */
    protected $_uri = self::API_URI;

    /**
     * @param  string $apiKey API key of a Last.fm API account
     * @throws Zend_Service_LastFm_Exception
     */
    public function __construct($apiKey)
    {
        $this->setApiKey($apiKey);
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->_apiKey;
    }

    /**
     * @param  string $apiKey
     * @return $this
     * @throws Zend_Service_LastFm_Exception
     */
    public function setApiKey($apiKey)
    {
        $apiKey = (string) $apiKey;
        if ($apiKey === '') {
            require_once 'Zend/Service/LastFm/Exception.php';
            throw new Zend_Service_LastFm_Exception('The Last.fm API needs an API key');
        }
        $this->_apiKey = $apiKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * Set the root URI of the API
     *
     * @param  string $uri
     * @return $this
     */
    public function setUri($uri)
    {
        $this->_uri = (string) $uri;

        return $this;
    }

    /**
     * Call a read method of the API
     *
     * @param  string $method API method, e.g. "artist.getSimilar"
     * @param  array  $params Parameters of the method, without "method" and "api_key"
     * @return SimpleXMLElement The <lfm> element of the response
     * @throws Zend_Service_LastFm_Exception For an invalid call, an error reported by the API or an unreadable response
     */
    public function call($method, array $params = [])
    {
        require_once 'Zend/Service/LastFm/Exception.php';

        if (!is_string($method) || !preg_match('/^[a-z]+\.[A-Za-z]+$/', $method)) {
            throw new Zend_Service_LastFm_Exception(
                'A Last.fm API method has the form "package.method", e.g. "user.getTopArtists"'
            );
        }
        if (isset($params['format']) || isset($params['callback']) || isset($params['raw'])) {
            throw new Zend_Service_LastFm_Exception(
                'The parameters "format", "callback" and "raw" cannot be used: the response is read as the XML of the API'
            );
        }

        $params['method']  = $method;
        $params['api_key'] = $this->_apiKey;

        $client = self::getHttpClient();
        $client->resetParameters();
        $client->setUri($this->_uri);
        $client->setParameterGet($params);

        try {
            $response = $client->request(Zend_Http_Client::GET);
        } catch (Zend_Http_Client_Exception $e) {
            throw new Zend_Service_LastFm_Exception('The Last.fm API could not be reached: ' . $e->getMessage(), 0, $e);
        }

        return $this->_parseResponse($response);
    }

    /**
     * Call the API method named by the package followed by the method:
     * userGetTopArtists($params) calls "user.getTopArtists"
     *
     * @param  string $name
     * @param  array  $arguments The parameters of the API method as the only argument
     * @return SimpleXMLElement
     * @throws Zend_Service_LastFm_Exception
     */
    public function __call($name, $arguments)
    {
        if (!preg_match('/^([a-z]+)([A-Z][A-Za-z]*)$/', $name, $parts)) {
            require_once 'Zend/Service/LastFm/Exception.php';
            throw new Zend_Service_LastFm_Exception('Call to undefined method ' . get_class($this) . '::' . $name . '()');
        }

        $params = isset($arguments[0]) ? $arguments[0] : [];
        if (!is_array($params)) {
            require_once 'Zend/Service/LastFm/Exception.php';
            throw new Zend_Service_LastFm_Exception(
                get_class($this) . '::' . $name . '() takes the parameters of the API method as an array'
            );
        }

        return $this->call($parts[1] . '.' . lcfirst($parts[2]), $params);
    }

    /**
     * @param  Zend_Http_Response $response
     * @return SimpleXMLElement
     * @throws Zend_Service_LastFm_Exception
     */
    protected function _parseResponse(Zend_Http_Response $response)
    {
        require_once 'Zend/Xml/Security.php';

        // the API reports its errors as XML too, with an HTTP error status
        $xml  = false;
        $body = trim($response->getBody());
        if ($body !== '') {
            try {
                $xml = Zend_Xml_Security::scan($body);
            } catch (Zend_Xml_Exception $e) {
                $xml = false;
            }
        }

        if (!$xml instanceof SimpleXMLElement || $xml->getName() !== 'lfm') {
            throw new Zend_Service_LastFm_Exception(
                'The Last.fm API returned no API response (HTTP status ' . $response->getStatus() . ')'
            );
        }

        if ((string) $xml['status'] !== 'ok') {
            throw new Zend_Service_LastFm_Exception(
                isset($xml->error) ? trim((string) $xml->error) : 'The Last.fm API reported an error',
                isset($xml->error['code']) ? (int) $xml->error['code'] : 0
            );
        }

        return $xml;
    }
}
