<?php namespace WowApi\Services;

use WowApi\Components\Challenges\Challenge;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\IllegalArgumentException;
use WowApi\Exceptions\WowApiException;
use WowApi\Util\Helper;

/**
 * Challenge services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ChallengeService extends BaseService {

    /**
     * Gets all realm dungeon challenges
     *
     * @param string $realm
     * @return array
     * @throws IllegalArgumentException
     * @throws WowApiException
     */
    public function getLadder($realm) {
        // allow for longer timeout because it's a big call
        $this->setParameter('timeout', 10);

        $url = $this->getPath('challenge/:realm', [
            'realm' => $realm
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return Challenge::getChallenges($response->getBody());
    }

    /**
     * Get all realm challenges by dungeon
     *
     * @param string $realm
     * @param string $dungeon
     * @return array
     * @throws WowApiException
     */
    public function getLadderByDungeon($realm, $dungeon) {
        return $this->sortLadderData($this->getLadder($realm), $dungeon);
    }

    /**
     * Do the actual sorting for ladder dungeon challenges
     *
     * @param array $ladderObjArr
     * @param string $dungeon
     * @return array
     */
    private function sortLadderData($ladderObjArr = [], $dungeon) {
        $returnArr = [];

        foreach ($ladderObjArr as $ladderObj) {
            if ($ladderObj->map->slug == Helper::formatSlug($dungeon)) {
                $returnArr[] = $ladderObj;
            }
        }

        return $returnArr;
    }

    /**
     * Get the challenge ladder for the current region
     *
     * @return array
     * @throws IllegalArgumentException
     * @throws WowApiException
     */
    public function getRegionLadder() {
        // allow for longer timeout because it's a big call
        $this->setParameter('timeout', 10);

        $request = parent::createRequest('GET', 'challenge/region');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return Challenge::getChallenges($response->getBody(), $region = true);
    }

}