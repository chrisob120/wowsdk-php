<?php namespace WowApi\Services;

use WowApi\Components\Spells\Spell;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\WowApiException;

/**
 * Spell services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class SpellService extends BaseService {

    /**
     * Get Spell component
     *
     * @param int $spellId
     * @return Spell
     * @throws WowApiException
     */
    public function getSpell($spellId) {
        $url = $this->getPath('spell/:spell', [
            'spell' => (int)$spellId
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new Spell($response->getBody());
    }
}