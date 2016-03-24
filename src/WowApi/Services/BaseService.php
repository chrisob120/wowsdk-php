<?php namespace WowApi\Services;

use GuzzleHttp\Client;
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
     * BaseService constructor assigning the Guzzle rest client and API Key
     *
     * @param string $apiKey Battle.net API Key
     */
    public function __construct($apiKey) {
        $this->_apiKey = $apiKey;
        $this->_client = new Client(['base_uri' => self::BASE_URI]);
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
     * @return Client
     */
    protected function createRequest($method, $url) {
        $request = $this->_client->request($method, $url, [
            'query' =>
                ["locale=en_US"],
                ["apikey=$this->_apiKey"]
        ]);

        return $request;
    }

    protected function getPath($path, $params = []) {
        $add = [];

        foreach ($params as $key => $param) {
            $add[':' .$key] = Utilities::urlEncode($param);
        }

        return strtr($path, $add);
    }

}