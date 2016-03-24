<?php namespace WowApi\Services;

use WowApi\Components\Characters\Character;
use GuzzleHttp\Exception\ClientException;
use WowApi\Util\Utilities;


/**
 * Character services
 *
 * @package     Services
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class CharacterService extends BaseService {

    /**
     * @param string $realm
     * @param string $character
     * @param array $params
     * @return Character
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
            Utilities::print_rci($e->getResponse());
            die;
        }

        return new Character($response->getBody());
    }

}