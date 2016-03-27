<?php namespace WowApi\Services;

use WowApi\Components\Boss;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\WowApiException;

/**
 * Boss services
 *
 * @package     Services
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class BossService extends BaseService {

    /**
     * Get Boss component
     *
     * @param int $bossId
     * @return Boss
     * @throws WowApiException
     */
    public function getBoss($bossId) {
        $url = $this->getPath(sprintf('boss/:boss', [
            'boss' => (int)$bossId
        ]));

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new Boss($response->getBody());
    }
}