<?php namespace WowApi\Services;

use WowApi\Components\Quests\Quest;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\WowApiException;

/**
 * Quest services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class QuestService extends BaseService {

    /**
     * Get Quest component
     *
     * @param int $questId
     * @return Quest
     * @throws WowApiException
     */
    public function getQuest($questId) {
        $url = $this->getPath('quest/:quest', [
            'quest' => (int)$questId
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new Quest($response);
    }
}