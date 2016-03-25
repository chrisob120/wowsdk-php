<?php namespace WowApi\Services;

use WowApi\Components\Realms\Realm;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\IllegalArgumentException;
use WowApi\Exceptions\NotFoundException;
use WowApi\Exceptions\WowApiException;


/**
 * Realm services
 *
 * @package     Services
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class RealmService extends BaseService {

    /**
     * Get realm service
     *
     * @param string $realm Realm slug
     * @return Realm
     * @throws WowApiException
     * @throws NotFoundException
     */
    public function getRealm($realm) {
        $this->setQuery(['realm' => self::formatSlug($realm)]);

        $request = parent::createRequest('GET', 'realm/status');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        // if there is more than one result from a getRealm request, that means it was not found. the API returns all realms if the query string search does not find one
        if (count(json_decode($response->getBody())->realms) > 1) {
            throw new NotFoundException(sprintf("The realm '%s' could not be retrieved.", $realm));
        } else {
            return new Realm($response->getBody());
        }
    }

    /**
     * Gets the realm(s)
     *
     * @param null $realms
     * @return array
     * @throws IllegalArgumentException
     * @throws WowApiException
     */
    public function getRealms($realms = null) {
        $error = false;

        if (is_array($realms)) {
            if (!empty($realms)) {
                // format each array item slug
                foreach ($realms as $key => $realm) $realms[$key] = self::formatSlug($realm);
                $this->setQuery(['realms' => implode(',', $realms)]);
            } else {
                $error = true;
            }
        } else if ($realms != null) {
            $error = true;
        }

        // if there is a parameter error, throw an exception
        if ($error) {
            throw new IllegalArgumentException('The realms parameter must be an array with at least one value or null.');
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
     * Replaces all spaces with dashes and puts the string to lower case. This way both the realm name or slug can be entered
     *
     * @param string $slug
     * @return string
     */
    private static function formatSlug($slug) {
        return strtolower(str_replace(' ', '-', $slug));
    }

}