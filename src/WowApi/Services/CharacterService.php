<?php namespace WowApi\Services;

use WowApi\Components\Characters\Character;
use WowApi\Components\Characters\CharacterClass;
use WowApi\Components\Characters\CharacterAchievement;
use GuzzleHttp\Exception\ClientException;
use WowApi\Components\Characters\CharacterRace;
use WowApi\Exceptions\WowApiException;

/**
 * Character services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class CharacterService extends BaseService {

    public function get($realms = null) {
        
    }

    /**
     * Get Character component
     *
     * @param string $realm
     * @param string $character
     * @param array $params
     * @return Character
     * @throws WowApiException
     */
    public function getCharacter($realm, $character, $params = []) {
        $this->setFields($params);
        
        $url = $this->getPath('character/:realm/:character', [
            'realm' => $realm,
            'character' => $character
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new Character($response->getBody());
    }

    /**
     * Get all CharacterClass components
     *
     * @return array
     * @throws WowApiException
     */
    public function getCharacterClasses() {
        $request = parent::createRequest('GET', 'data/character/classes');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return CharacterClass::getCharacterClasses($response->getBody());
    }

    /**
     * Get all CharacterRace components
     *
     * @return array
     * @throws WowApiException
     */
    public function getCharacterRaces() {
        $request = parent::createRequest('GET', 'data/character/races');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return CharacterRace::getCharacterRaces($response->getBody());
    }

    /**
     * Gets all CharacterAchievement components
     *
     * @return array
     * @throws WowApiException
     */
    public function getCharacterAchievements() {
        $this->setParameter('timeout', 8);
        
        $request = parent::createRequest('GET', 'data/character/achievements');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return CharacterAchievement::getCharacterAchievements($response->getBody());
    }
}