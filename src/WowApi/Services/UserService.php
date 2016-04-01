<?php namespace WowApi\Services;

use WowApi\Components\Characters\Character;
use WowApi\Components\Resources\Talents\Spec;
use WowApi\Components\User\Profile;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\WowApiException;
use WowApi\Util\Helper;

/**
 * User services - Utilizes OAuth2
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class UserService extends BaseService {

    /**
     * UserService constructor
     *
     * @param string $apiKey
     * @param array|null $options
     * @throws WowApiException
     */
    public function __construct($apiKey, $options = null) {
        parent::__construct($apiKey, $options);

        if (isset($options['access_token'])) {
            $this->setHeaders($options['access_token']);
        } else {
            throw parent::toWowApiException(['This service requires an access token.', 110]);
        }
    }

    /**
     * Get user Profile
     *
     * @return array
     * @throws WowApiException
     */
    public function getProfile() {
        $request = parent::createRequest('GET', 'user/characters');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return $this->getCharacters($response->getBody());
    }

    /**
     * @param array $characterArr
     * @return array
     */
    private function getCharacters($characterArr = []) {
        $characterArr = json_decode($characterArr)->characters;
        $returnArr = [];

        if (count($characterArr)) {
            $cnt = 0;

            foreach ($characterArr as $characterObj) {
                $returnArr[$cnt] = new Character(json_encode($characterObj));

                // add extra Character object features
                if (isset($characterArr[$cnt]->spec)) $returnArr[$cnt]->spec = new Spec(json_encode($characterArr[$cnt]->spec));
                if (isset($characterArr[$cnt]->guild)) $returnArr[$cnt]->guild = $characterArr[$cnt]->guild;
                if (isset($characterArr[$cnt]->guildRealm)) $returnArr[$cnt]->guildRealm = $characterArr[$cnt]->guildRealm;

                $cnt++;
            }
        }

        return $returnArr;
    }

}