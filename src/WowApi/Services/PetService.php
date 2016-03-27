<?php namespace WowApi\Services;

use WowApi\Components\Pet;
use WowApi\Components\Pets\PetSpecies;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\WowApiException;

/**
 * Battle and Vanity Pet services
 *
 * @package     Services
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class PetService extends BaseService {

    /**
     * Gets all pets
     *
     * @return array
     * @throws WowApiException
     */
    public function getPets() {
        $request = parent::createRequest('GET', 'pet/');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return Pet::getPets($response->getBody());
    }

    public function getSpecies($speciesId) {
        $request = parent::createRequest('GET', "pet/species/$speciesId");

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new PetSpecies($response->getBody());
    }

}