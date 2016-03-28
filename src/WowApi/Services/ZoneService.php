<?php namespace WowApi\Services;

use WowApi\Components\Zone;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\IllegalArgumentException;
use WowApi\Exceptions\NotFoundException;
use WowApi\Exceptions\WowApiException;

/**
 * Zone services
 *
 * @package     Services
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class ZoneService extends BaseService {

    /**
     * Get Zone component
     *
     * @param int $zoneId
     * @return Zone
     * @throws WowApiException
     * @throws NotFoundException
     */
    public function getZone($zoneId) {
        $url = $this->getPath('zone/:zoneId', [
            'zoneId' => (int)$zoneId
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new Zone($response->getBody());
    }

    /**
     * Gets all zones
     *
     * @return array
     * @throws IllegalArgumentException
     * @throws WowApiException
     */
    public function getZones() {
        $request = parent::createRequest('GET', 'zone/');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return Zone::getZones($response->getBody());
    }

}