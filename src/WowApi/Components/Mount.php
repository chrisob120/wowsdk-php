<?php namespace WowApi\Components;

/**
 * Represents a single Mount
 *
 * @package     Components
 * @author      Chris O'Brien <chris@diobie.com>
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
     * @var string $icon;
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
     * Mount constructor - creates the mount object based on the returned service data
     *
     * @param object $jsonData
     * @return Mount
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

    /**
     * Gets an array of Mount items based on which realms were sent to the method
     *
     * @param string $jsonData
     * @return array
     */
    public static function getMounts($jsonData) {
        $returnArr = [];
        $mounts = json_decode($jsonData)->mounts;

        foreach ($mounts as $mount) {
            $returnArr[] = new Mount(json_encode($mount));
        }

        return $returnArr;
    }

}