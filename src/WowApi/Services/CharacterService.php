<?php namespace WowApi\Services;

use WowApi\Components\Characters\Character;
use GuzzleHttp\Exception\ClientException;


/**
 * Character services
 *
 * @package     Services
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class CharacterService extends BaseService {

    public function getCharacter($realm, $character) {
        $url = $this->getPath('character/:realm/:character', [
            'realm' => $realm,
            'character' => $character
        ]);

        echo $url;

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::getClient()->send($request);
        } catch (ClientException $e) {
            var_dump($e);die;
        }

        return new Character($response->getBody());
    }

}