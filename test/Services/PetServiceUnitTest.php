<?php

/**
 * Pet Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class PetServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\PetService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->petService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetPets() {
        $pets = $this->_access->getPets();
        $this->assertInstanceOf('\WowApi\Components\Pets\Pet', $pets[0]);
        $this->assertInstanceOf('\WowApi\Components\Pets\PetSpeciesStats', $pets[0]->stats);
        $this->assertNotNull($pets[0]->name);
    }

    public function testGetSpies() {
        $petSpecies = $this->_access->getSpecies(258);
        $this->assertInstanceOf('\WowApi\Components\Pets\PetSpecies', $petSpecies);

        if (count($petSpecies->abilities)) {
            $this->assertInstanceOf('\WowApi\Components\Pets\PetAbility', $petSpecies->abilities[0]);
        }

        $this->assertEquals(258, $petSpecies->speciesId);
    }

    public function testGetSpeciesStats() {
        $petSpeciesStats = $this->_access->getSpeciesStats(258, ['level' => 20, 'breedId' => 1, 'qualityId' => 1]);
        $this->assertInstanceOf('\WowApi\Components\Pets\PetSpeciesStats', $petSpeciesStats);

        $this->assertEquals(258, $petSpeciesStats->speciesId);
    }

    public function testSpeciesStatsIncrease() {
        $petSpeciesStats1 = $this->_access->getSpeciesStats(258, ['level' => 20, 'breedId' => 1, 'qualityId' => 1]);
        $petSpeciesStats2 = $this->_access->getSpeciesStats(258, ['level' => 60, 'breedId' => 3, 'qualityId' => 3]);

        $this->assertTrue($petSpeciesStats1->power < $petSpeciesStats2->power);
    }
    
    public function testGetPetTypes() {
        $petTypes = $this->_access->getPetTypes();
        $this->assertInstanceOf('\WowApi\Components\Pets\PetType', $petTypes[0]);
        $this->assertNotNull($petTypes[0]->id);
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Not Found
     */
    public function testSpeciesNotFound() {
        $this->_access->getSpecies(0);
    }

}