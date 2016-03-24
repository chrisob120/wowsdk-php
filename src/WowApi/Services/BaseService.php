<?php namespace WowApi\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use WowApi\Util\Utilities;

/**
 * Super class for all services
 *
 * @package     Services
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
abstract class BaseService {

    const BASE_URI = 'https://us.api.battle.net/wow/';

    /**
     * GuzzleHttp client
     * @var Client $_client
     */
    private $_client;

    /**
     * Battle.net API Key used for API access
     * @var string $_apiKey
     */
    private $_apiKey;

    /**
     * Extra parameters to be optionally set
     * @var array $parameters
     */
    protected $parameters = [];

    /**
     * BaseService constructor assigning the Guzzle rest client and API Key
     *
     * @param string $apiKey Battle.net API Key
     */
    public function __construct($apiKey) {
        $this->_apiKey = $apiKey;
        $this->_client = new Client(['base_uri' => self::BASE_URI]);

        // set the default parameters
        $this->parameters['timeout'] = 2;
        $this->parameters['query'] = [
            'locale' => 'en_US',
            'apikey' => $this->_apiKey
        ];
    }

    /**
     * Get the Guzzle client
     *
     * @return Client - Guzzle client
     */
    protected function getClient() {
        return $this->_client;
    }

    /**
     * Create the client request
     *
     * @param string $method
     * @param string $url
     * @return Request
     */
    protected function createRequest($method, $url) {
        return new Request($method, $url);
    }

    /**
     * Do the request
     *
     * @param $request
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    protected function doRequest($request) {
        return $this->_client->send($request, $this->parameters);
    }

    /**
     * Set the rest of the API call path
     *
     * @param string $path
     * @param array $params
     * @return string
     */
    protected function getPath($path, $params = []) {
        $add = [];

        foreach ($params as $key => $param) {
            $add[':' .$key] = Utilities::urlEncode($param);
        }

        return strtr($path, $add);
    }

    /**
     * @param array $fields
     * @return void
     */
    protected function setFields($fields) {
        if (is_array($fields)) {
            foreach ($fields as $field) {

            }
        }
    }

    protected function setParameters() {

    }

}