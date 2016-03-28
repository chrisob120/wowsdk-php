<?php namespace WowApi\Services;

use WowApi\Components\Realms\Realm;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\IllegalArgumentException;
use WowApi\Exceptions\NotFoundException;
use WowApi\Exceptions\WowApiException;
use WowApi\Util\Helper;

/**
 * Realm services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class RealmService extends BaseService {

    /**
     * @var array $ruleSets
     */
    public $ruleSets;

    /**
     * @var array $populationTypes
     */
    public $populationTypes;

    /**
     * RealmService constructor
     *
     * @param string $apiKey
     * @param array|null $options
     */
    public function __construct($apiKey, $options = null) {
        parent::__construct($apiKey, $options);

        $this->ruleSets = ['pve', 'pvp', 'rp', 'rppvp'];
        $this->populationTypes = ['high', 'medium', 'low'];
    }

    /**
     * Get Realm component
     *
     * @param string $realm Realm slug
     * @return Realm
     * @throws WowApiException
     * @throws NotFoundException
     */
    public function getRealm($realm) {
        $this->setQuery(['realm' => Helper::formatSlug($realm)]);

        $request = parent::createRequest('GET', 'realm/status');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        // if there is more than one result from a getRealm request, that means it was not found. the API returns all realms if the query string search does not find one
        if (count(json_decode($response->getBody())->realms) > 1) {
            throw parent::toWowApiException(['Realm Not Found', 404]);
        } else {
            return new Realm($response->getBody());
        }
    }

    /**
     * Gets the realm(s)
     *
     * @param null $realms
     * @return array
     * @throws WowApiException
     * @throws IllegalArgumentException
     */
    public function getRealms($realms = null) {
        $error = false;

        // realms check
        if (is_array($realms)) {
            if (!empty($realms)) {
                // format each array item slug
                foreach ($realms as $key => $realm) $realms[$key] = Helper::formatSlug($realm);
                $this->setQuery(['realms' => implode(',', $realms)]);
            } else {
                $error = true;
            }
        } else if ($realms != null) {
            $error = true;
        }

        // if there is a parameter error, throw an exception
        if ($error) {
            throw parent::toWowApiException(['The realms parameter must be an array with at least one value or null.', 10]);
        }

        $request = parent::createRequest('GET', 'realm/status');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return Realm::getRealms($response->getBody());
    }

    /**
     * Sort realms by given key val pair
     *
     * @param string $key
     * @param string $val
     * @return array
     */
    public function sortRealms($key, $val) {
        $this->sortWhitelist = ['type', 'population', 'status'];
        
        return $this->sortData($this->getRealms(), [$key => $val]);
    }

}