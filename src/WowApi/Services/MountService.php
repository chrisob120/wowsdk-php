<?php namespace WowApi\Services;

use WowApi\Components\Mounts\Mount;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\WowApiException;

/**
 * Mount services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class MountService extends BaseService {

    /**
     * Gets all Mounts
     *
     * @return array
     * @throws WowApiException
     */
    public function getMounts() {
        $request = parent::createRequest('GET', 'mount/');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return Mount::getMounts($response);
    }

    /**
     * Sort Mounts by given key val pair
     *
     * @param string $key
     * @param string $val
     * @return array
     */
    public function sortMounts($key, $val) {
        $this->sortWhitelist = ['isGround', 'isFlying', 'isAquatic', 'isJumping'];

        return $this->sortData($this->getMounts(), [$key => $val]);
    }

}