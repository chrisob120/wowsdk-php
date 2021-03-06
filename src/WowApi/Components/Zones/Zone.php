<?php namespace WowApi\Components\Zones;

use WowApi\Components\BaseComponent;
use WowApi\Components\Bosses\Boss;

/**
 * Represents a single Zone
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Zone extends BaseComponent {

    /**
     * @var int $id;
     */
    public $id;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $urlSlug
     */
    public $urlSlug;

    /**
     * @var string $description
     */
    public $description;

    /**
     * @var object $location
     */
    public $location;

    /**
     * @var int $expansionId
     */
    public $expansionId;

    /**
     * @var int $numPlayers
     */
    public $numPlayers;

    /**
     * @var bool $isDungeon
     */
    public $isDungeon;

    /**
     * @var bool $isRaid
     */
    public $isRaid;

    /**
     * @var int $advisedMinLevel
     */
    public $advisedMinLevel;

    /**
     * @var int $advisedMaxLevel
     */
    public $advisedMaxLevel;

    /**
     * @var int $advisedHeroicMinLevel
     */
    public $advisedHeroicMinLevel;

    /**
     * @var int $advisedHeroicMaxLevel
     */
    public $advisedHeroicMaxLevel;

    /**
     * @var array $availableModes
     */
    public $availableModes;

    /**
     * @var int $lfgNormalMinGearLevel
     */
    public $lfgNormalMinGearLevel;

    /**
     * @var int $lfgHeroicMinGearLevel
     */
    public $lfgHeroicMinGearLevel;

    /**
     * @var int $floors
     */
    public $floors;

    /**
     * @var array $bosses
     */
    public $bosses;

    /**
     * Zone constructor - creates the Zone object based on the returned service data
     *
     * @param object $jsonData
     * @return Zone
     */
    public function __construct($jsonData) {
        // checks which method the data is coming in from. if it's a multiple zone request, there will be no 'zones' property on the response object because it gets the Zone object one by one
        $realObj = (!property_exists($jsonData, 'zones')) ? $jsonData : $jsonData->zones[0];
        $zoneObj = parent::assignValues($this, $realObj);

        $zoneObj->location = $this->getZoneLocation($zoneObj->location);
        if (count($zoneObj->bosses)) $zoneObj->bosses = $this->getBosses($zoneObj->bosses);

        return $zoneObj;
    }

    /**
     * Get the an array of Boss objects
     *
     * @param array $bossArr
     * @return array
     */
    private function getBosses($bossArr = []) {
        $returnArr = [];

        foreach ($bossArr as $boss) {
            $returnArr[] = new Boss($boss);
        }

        return $returnArr;
    }

    /**
     * @param object $zoneLocObj
     * @return ZoneLocation
     */
    private function getZoneLocation($zoneLocObj) {
        return new ZoneLocation($zoneLocObj);
    }

    /**
     * Gets an array of Zone items based on which zones were sent to the method
     *
     * @param object $jsonData
     * @return array
     */
    public static function getZones($jsonData) {
        $returnArr = [];
        $zones = $jsonData->zones;

        foreach ($zones as $zone) {
            $returnArr[] = new Zone($zone);
        }

        return $returnArr;
    }

}