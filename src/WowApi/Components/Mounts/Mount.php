<?php namespace WowApi\Components\Mounts;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Mount
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Mount extends BaseComponent {

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var int $spellId
     */
    public $spellId;

    /**
     * @var int $creatureId
     */
    public $creatureId;

    /**
     * @var int $qualityId
     */
    public $qualityId;

    /**
     * @var string $icon
     */
    public $icon;

    /**
     * @var bool $isGround
     */
    public $isGround;

    /**
     * @var bool $isFlying
     */
    public $isFlying;

    /**
     * @var bool $isAquatic
     */
    public $isAquatic;

    /**
     * @var bool $isJumping
     */
    public $isJumping;

    /**
     * Mount constructor - creates the Mount object based on the returned service data
     *
     * @param object $jsonData
     * @return Mount
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, $jsonData);
    }

    /**
     * Gets an array of Mount items
     *
     * @param object $jsonData
     * @return array
     */
    public static function getMounts($jsonData) {
        $returnArr = [];
        $mounts = $jsonData->mounts;

        foreach ($mounts as $mount) {
            $returnArr[] = new Mount($mount);
        }

        return $returnArr;
    }

}