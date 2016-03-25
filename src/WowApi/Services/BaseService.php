<?php namespace WowApi\Services;

use WowApi\Exceptions\IllegalArgumentException;
use WowApi\Exceptions\WowApiException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use WowApi\Util\Helper;

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
     * Set the maximum amount of fields for a service. Default to null means any amount of fields can be called
     * @var mixed $maxFields
     */
    protected $maxFields = null;

    /**
     * @var array $sortWhitelist
     */
    protected $sortWhitelist = [];

    /**
     * BaseService constructor assigning the Guzzle rest client and API Key
     *
     * @param string $apiKey Battle.net API Key
     */
    public function __construct($apiKey) {
        $this->_apiKey = $apiKey;
        $this->_client = new Client(['base_uri' => self::BASE_URI]);

        // set the default parameters
        $this->parameters = [
            'timeout' => 5,
            'query' => [
                'locale' => 'en_US',
                'apikey' => $this->_apiKey
            ]
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
     * @return mixed
     */
    protected function doRequest($request) {
        return $this->_client->send($request, $this->parameters);
    }

    /**
     * Throw WowApi exception from ClientException
     *
     * @param ClientException $clientEx
     * @return WowApiException
     */
    protected function toWowApiException($clientEx) {
        $wowApiEx = new WowApiException($clientEx->getResponse()->getReasonPhrase(), $clientEx->getCode());
        $wowApiEx->setError(json_decode($clientEx->getResponse()->getBody()));

        return $wowApiEx;
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
            $add[':' .$key] = Helper::urlEncode($param);
        }

        return strtr($path, $add);
    }

    /**
     * Set the field(s) to be passed the request query option
     *
     * @param mixed $fields
     * @return void
     * @throws IllegalArgumentException
     */
    protected function setFields($fields) {
        $fieldStr = false;

        if (is_array($fields)) {
            // use closure to check if there is more than one field per array item. if there is, remove the item from the array
            $fields = array_filter($fields, function ($val) {
                return (strpos($val, ',') !== false) ? false : true;
            });

            if ($this->maxFields === null) {
                $fieldStr = implode(',', $fields);
            } else {
                if (count($fields) > $this->maxFields) {
                    throw new IllegalArgumentException(sprintf('The maximum amount of fields per request for this service is %s.', $this->maxFields));
                }
            }
        }

        if ($fieldStr) {
            $fieldsArr['fields'] = $fieldStr;
            $this->setQuery($fieldsArr);
        }
    }

    protected function setQuery($qryArr = []) {
        if (is_array($qryArr)) {
            $this->setParameter('query', $qryArr);
        } else {
            throw new IllegalArgumentException('Query parameter was set incorrectly. Value must an array.');
        }
    }

    /**
     * Set a single parameter to be passed to the request
     *
     * @param string $key
     * @param mixed $value
     * @return void
     * @throws IllegalArgumentException
     */
    protected function setParameter($key, $value) {
        if (is_array($value)) {
            if (count($value) == 1) {
                $arrKey = key($value);
                $this->parameters[$key][$arrKey] = $value[$arrKey];
            } else {
                throw new IllegalArgumentException('Parameter was set incorrectly.');
            }
        } else {
            $this->parameters[$key] = $value;
        }
    }

    /**
     * Replaces all spaces with dashes and puts the string to lower case. This way both the realm name or slug can be entered
     *
     * @param string $slug
     * @return string
     */
    protected static function formatSlug($slug) {
        return strtolower(str_replace(' ', '-', $slug));
    }

    /**
     * Sort returned results
     *
     * @param object $dataArr
     * @param array $sortArr
     * @return array
     */
    public function sortData($dataArr, $sortArr) {
        $returnArr = [];
        $this->checkSort($sortArr);

        foreach ($dataArr as $data) {
            $key = key($sortArr);

            if ($data->$key == $sortArr[$key]) {
                $returnArr[] = $data;
            }
        }

        return $returnArr;
    }

    /**
     * Check the sort key
     *
     * @param array $sortArr
     * @throws IllegalArgumentException
     */
    protected function checkSort($sortArr = []) {
        if ($sortArr != null) {
            if (is_array($sortArr) && count($sortArr) == 1) {
                if (!in_array(key($sortArr), $this->sortWhitelist)) {
                    $allowedKeys = (!empty($this->sortWhitelist)) ? implode(', ', $this->sortWhitelist) : 'No allowed keys found';
                    throw new IllegalArgumentException(sprintf('You may only choose the following sort keys: %s', $allowedKeys));
                }
            } else {
                throw new IllegalArgumentException('Parameter was set incorrectly.');
            }
        }
    }

}