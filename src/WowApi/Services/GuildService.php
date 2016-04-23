<?php namespace WowApi\Services;

use WowApi\Components\Guilds\Guild;
use WowApi\Components\Guilds\GuildReward;
use WowApi\Components\Guilds\GuildPerk;
use WowApi\Components\Guilds\GuildAchievement;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\WowApiException;

/**
 * Guild services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class GuildService extends BaseService {

    /**
     * Get Guild component
     *
     * @param string $realm
     * @param string $guild
     * @param array $params
     * @return Guild
     * @throws WowApiException
     */
    public function getGuild($realm, $guild, $params = []) {
        $this->setFields($params);
        
        $url = $this->getPath('guild/:realm/:guild', [
            'realm' => $realm,
            'guild' => $guild
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new Guild($response);
    }

    /**
     * Gets all GuildRewards
     *
     * @return array
     * @throws WowApiException
     */
    public function getGuildRewards() {
        $request = parent::createRequest('GET', 'data/guild/rewards');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return GuildReward::getGuildRewards($response);
    }

    /**
     * Gets all GuildPerks
     *
     * @return array
     * @throws WowApiException
     */
    public function getGuildPerks() {
        $request = parent::createRequest('GET', 'data/guild/perks');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return GuildPerk::getGuildPerks($response);
    }

    /**
     * Gets all GuildAchievements
     *
     * @return array
     * @throws WowApiException
     */
    public function getGuildAchievements() {
        $request = parent::createRequest('GET', 'data/guild/achievements');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return GuildAchievement::getGuildAchievements($response);
    }

}