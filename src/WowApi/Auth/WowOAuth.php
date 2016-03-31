<?php namespace WowApi\Auth;

use WowApi\Exceptions\OAuthException;
use WowApi\Exceptions\IllegalArgumentException;
use WowApi\Util\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use WowApi\Util\Helper;

/**
 * Implements functionality to obtain an access token from a user
 *
 * @package     Auth
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class WowOAuth {

    /**
     * @var string $_accessToken
     */
    private $_accessToken;

    /**
     * @var int $clientId
     */
    private $_clientId;

    /**
     * @var string $clientSecret
     */
    private $_clientSecret;

    /**
     * @var Client $client
     */
    private $_client;

    /**
     * @var string $region
     */
    private $_region;

    /**
     * @var string $locale
     */
    private $_locale;

    /**
     * @var string $redirectUri
     */
    public $redirectUri;

    /**
     * @var string $baseUri
     */
    public $baseUri;

    /**
     * WowApiOAuth constructor
     *
     * @param int $clientId
     * @param string $clientSecret
     * @param string $redirectUri
     * @param array $options
     */
    public function __construct($clientId, $clientSecret, $redirectUri, $options = []) {
        $this->baseUri = Config::get('oauth.base_uri');

        $this->_clientId = $clientId;
        $this->_clientSecret = $clientSecret;
        $this->_region = (isset($options['region'])) ? $options['region'] : Config::get('client.region');
        $this->_locale = (isset($options['locale'])) ? $options['locale'] : Config::get('client.locale');
        $this->redirectUri = $redirectUri;

        // check the current region and locale before submitting a request
        $this->checkOptionalParameters();

        // get client
        $this->_client = new Client();
    }

    /**
     * Get the authorization URL to send to client
     *
     * @param string|null $state
     * @return string
     */
    public function getAuthorizationUrl($state = null) {
        $params = [
            'locale' => $this->_locale,
            'response_type' => Config::get('oauth.response_type'),
            'client_id' => $this->_clientId,
            'redirect_uri' => $this->redirectUri,
            'scope' => Config::get('oauth.scope')
        ];

        if ($state != null) $params['state'] = $state;

        $baseUri = $this->getPath($this->baseUri, ['region' => $this->_region]) . Config::get('oauth.authorization_endpoint');
        return $baseUri. '?' .http_build_query($params);
    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getAccessToken() {
        $params = [
            'locale' => $this->_locale,
            'grant_type' => Config::get('oauth.authorization_grant_type'),
            'client_id' => $this->_clientId,
            'client_secret' => $this->_clientSecret,
            'redirect_uri' => $this->redirectUri
        ];

        $baseUri = $this->getPath($this->baseUri, ['region' => $this->_region]) . Config::get('oauth.token_endpoint');
        $request = new Request('POST', $baseUri);

        try {
            $response = $this->_client->send($request, $params);
        } catch (ClientException $e) {
            echo $e->getMessage();exit;
        }

        return $response->getBody();
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
     * Check the optional parameters given when instantiating the API
     *
     * @return void
     * @throws IllegalArgumentException
     */
    private function checkOptionalParameters() {
        // get the regions
        $allowedRegions = array_keys(Config::get('regions'));
        if (!in_array($this->_region, $allowedRegions)) throw new IllegalArgumentException(sprintf('Region must be one of the following: %s', implode(', ', $allowedRegions)));

        // get the locales
        $allowedLocaleByRegion = Config::get("regions.$this->_region");
        if (!in_array($this->_locale, $allowedLocaleByRegion)) throw new IllegalArgumentException(sprintf('Locale must be one of the following for the %s region: %s', $this->_region, implode(', ', $allowedLocaleByRegion)));
    }

}