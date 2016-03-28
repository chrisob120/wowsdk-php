<?php namespace WowApi\Services;

use WowApi\Components\Leaderboard\Leaderboard;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\WowApiException;

/**
 * PVP Leaderboard services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class LeaderboardService extends BaseService {

    /**
     * Get Leaderboard component
     *
     * @param string $type
     * @return Leaderboard
     * @throws WowApiException
     */
    public function getLeaderboard($type) {
        $this->setParameter('timeout', 10);

        $url = $this->getPath('leaderboard/:type', [
            'type' => $type
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return Leaderboard::getLeaderboard($response->getBody());
    }
}