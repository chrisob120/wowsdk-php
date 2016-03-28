<?php namespace WowApi\Services;

use WowApi\Components\Guilds\Guild;
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

        return new Guild($response->getBody());
    }

}