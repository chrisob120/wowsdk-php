<?php namespace WowApi\Services;

use WowApi\Exceptions\IllegalArgumentException;
use WowApi\Exceptions\WowApiException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use WowApi\Util\Helper;
use WowApi\Util\Config;

/**
 * Super class for all services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
abstract class BaseService {

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
     * @var string $_protocol
     */
    private $_protocol;

    /**
     * @var string $_region
     */
    private $_region;

    /**
     * @var string $_locale
     */
    private $_locale;

    /**
     * @var string $_baseUri
     */
    private $_baseUri;

    /**
     * @var string $_wowUri
     */
    private $_wowUri;

    /**
     * @var string $_authEndpoint
     */
    private $_authEndpoint;

    /**
     * @var string $_tokenEndpoint
     */
    private $_tokenEndpoint;

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
     * @param array|null $options
     */
    public function __construct($apiKey, $options = null) {
        $this->_apiKey = $apiKey;

        // assign URIs
        $this->_baseUri = Config::get('client.base_uri');
        $this->_wowUri = $this->_baseUri . Config::get('client.wow_path');
        $this->_authEndpoint = $this->_baseUri . Config::get('oauth.authorization_endpoint');
        $this->_tokenEndpoint = $this->_baseUri . Config::get('oauth.token_endpoint');

        // assign parameters
        $this->_protocol = (isset($options['protocol'])) ? $options['protocol'] : Config::get('client.protocol');
        $this->_region = (isset($options['region'])) ? $options['region'] : Config::get('client.region');
        $this->_locale = (isset($options['locale'])) ? $options['locale'] : Config::get('client.locale');

        // check the current region and locale before submitting a request
        $this->checkOptionalParameters();

        $baseUri = $this->getPath($this->_wowUri, [
            'protocol' => Helper::checkProtocol($this->_protocol),
            'region' => $this->_region
        ]);

        $this->_client = new Client(['base_uri' => $baseUri]);

        // set the default parameters
        $this->parameters = [
            'timeout' => 5,
            'query' => [
                'locale' => $this->_locale,
                'apikey' => $this->_apiKey
            ]
        ];
    }

    /**
     * Check the optional parameters given when instantiating the API
     *
     * @return void
     * @throws IllegalArgumentException
     */
    private function checkOptionalParameters() {
        if ($this->_protocol != 'http' && $this->_protocol != 'https') throw new IllegalArgumentException('Protocol must be either http or https');

        // get the regions
        $allowedRegions = array_keys(Config::get('regions'));
        if (!in_array($this->_region, $allowedRegions)) throw new IllegalArgumentException(sprintf('Region must be one of the following: %s', implode(', ', $allowedRegions)));

        // get the locales
        $allowedLocaleByRegion = Config::get("regions.$this->_region");
        if (!in_array($this->_locale, $allowedLocaleByRegion)) throw new IllegalArgumentException(sprintf('Locale must be one of the following for the %s region: %s', $this->_region, implode(', ', $allowedLocaleByRegion)));
    }

    /**
     * Create the client request
     *
     * @param string $method
     * @param string $url
     * @return Request
     */
    protected function createRequest($method, $url) {
        // keys
        $publicKey = 'n3hfnyv46xxdu88jp4z9q54qcfmbwgpb';
        $privateKey = 'yPer5s7Bn2ES2kWDDgEbfuWDTSca8W5b';

        // signature
        $date = gmdate(DATE_RFC1123);
        $signStr = "$method\n$date\n$url\n";
        $signature = base64_encode(hash_hmac('sha1', $signStr, $privateKey, true));

        return new Request($method, $url, [
            'headers' => [
                'Accept-Charset'    => 'UTF-8',
                'Content-Type'      => 'application/json',
                'Accept'            => 'application/json',
                'User-Agent'        => 'PHP WowSDK',
                'Date'              => $date,
                'Authorization'     => "BNET $publicKey:$signature"
            ]
        ]);
    }

    /**
     * Do the request
     *
     * @param $request
     * @return mixed
     * @throws WowApiException
     */
    protected function doRequest($request) {
        try {
            $send = $this->_client->send($request, $this->parameters);
        } catch (ConnectException $e) { // catch the timeout error
            throw $this->toWowApiException([$e->getMessage(), 200]);
        }

        return $send;
    }

    /**
     * Throw WowApi exception from ClientException
     *
     * @param ClientException|array $response
     * @return WowApiException
     */
    protected function toWowApiException($response) {
        if (is_array($response)) {
            list($msg, $code) = $response;

            $wowApiEx = new WowApiException($msg, $code);
            $wowApiEx->setError([
                'code' => $code,
                'detail' => $msg
            ]);
        } else {
            $wowApiEx = new WowApiException($response->getResponse()->getReasonPhrase(), $response->getCode());
            $wowApiEx->setError(json_decode($response->getResponse()->getBody()));
        }

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
            $add[':' .$key] = $param;
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

    /**
     * Recursive set query method that allows for multiple queries to be set at once
     *
     * @param array $qryArr
     * @throws IllegalArgumentException
     */
    protected function setQuery($qryArr = []) {
        if (is_array($qryArr)) {
            $key = current(array_keys($qryArr));
            $this->setParameter('query', [$key => $qryArr[$key]]);

            if (count($qryArr) > 1) {
                array_shift($qryArr);
                $this->setQuery($qryArr);
            }
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
     * Sort returned results
     *
     * @param array $dataArr
     * @param array $sortArr
     * @return array
     */
    protected function sortData($dataArr, $sortArr) {
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