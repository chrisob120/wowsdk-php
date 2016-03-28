<?php namespace WowApi\Components;

/**
 * Represents a single Challenge
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Challenge extends BaseComponent {

    /**
     * @var Realm $realm
     */
    public $realm;

    /**
     * @var object $map
     */
    public $map;

    /**
     * @var array $groups
     */
    public $groups;

    /**
     * Mount constructor - creates the Mount object based on the returned service data
     *
     * @param object $jsonData
     * @param bool $region
     * @return Challenge
     */
    public function __construct($jsonData, $region = false) {
        // unset the realm property if region is true
        if ($region) unset($this->realm);

        return parent::assignValues($this, json_decode($jsonData));
    }

    /**
     * Gets an array of Challenge items
     *
     * @param string $jsonData
     * @param bool $region
     * @return array
     */
    public static function getChallenges($jsonData, $region = false) {
        $returnArr = [];
        $challenges = json_decode($jsonData)->challenge;

        // sometimes the results from Blizzard are empty
        if (!empty($challenges[0]->groups)) {
            foreach ($challenges as $challenge) {
                $returnArr[] = new Challenge(json_encode($challenge), $region);
            }
        }

        return $returnArr;
    }

}