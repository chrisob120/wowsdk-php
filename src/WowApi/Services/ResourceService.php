<?php namespace WowApi\Services;

use WowApi\Components\Resources\Battlegroup;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\IllegalArgumentException;
use WowApi\Exceptions\WowApiException;

/**
 * Mount services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ResourceService extends BaseService {

    /**
     * Get Battlegroups based on current region
     *
     * @return array
     * @throws IllegalArgumentException
     * @throws WowApiException
     */
    public function getBattlegroups() {
        $request = parent::createRequest('GET', 'data/battlegroups/');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return Battlegroup::getBattlegroups($response->getBody());
    }

}