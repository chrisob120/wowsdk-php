<?php namespace WowApi\Services;

use WowApi\Components\Realms\Realm;
use GuzzleHttp\Exception\ClientException;
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
     * @param string $realm
     * @return Realm
     * @throws WowApiException
     */
    public function getRealm($realm) {
        $this->setQuery(['realm' => $realm]);

        $request = parent::createRequest('GET', 'realm/status');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new Realm($response->getBody());
    }

    public function getAllRealms($realms = []) {
    }

}