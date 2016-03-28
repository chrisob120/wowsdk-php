<?php namespace WowApi\Services;

use WowApi\Components\Pet;
use WowApi\Components\Pets\PetSpecies;
use WowApi\Components\Pets\PetSpeciesStats;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\WowApiException;

/**
 * Battle and Vanity Pet services
 *
 * @package     Services
 * @author      Chris O'Brien
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

    /**
     * Get Species component
     * 
     * @param int $speciesId
     * @return PetSpecies
     * @throws WowApiException
     */
    public function getSpecies($speciesId) {
        $url = $this->getPath('pet/species/:species', [
            'species' => (int)$speciesId
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new PetSpecies($response->getBody());
    }

    /**
     * Get species stats based on different parameters
     *
     * @param int $speciesId
     * @param array $options
     * @return PetSpeciesStats
     * @throws WowApiException
     * @throws \WowApi\Exceptions\IllegalArgumentException
     */
    public function getSpeciesStats($speciesId, $options = []) {
        $this->setQuery($options);

        $url = $this->getPath('pet/stats/:species', [
            'species' => (int)$speciesId
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new PetSpeciesStats($response->getBody());
    }

}