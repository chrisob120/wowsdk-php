<?php namespace WowApi\Components\Challenges;

use WowApi\Components\BaseComponent;
use WowApi\Components\Realms\Realm;

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
     * @var ChallengeMap $map
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
        $challengeObj = parent::assignValues($this, json_decode($jsonData));
        $challengeObj->realm = $this->getRealm($challengeObj->realm);
        $challengeObj->map = $this->getMap($challengeObj->map);
        $challengeObj->groups = $this->getGroups($challengeObj->groups);

        // unset the realm property if region is true
        if ($region) unset($challengeObj->realm);

        return $challengeObj;
    }

    /**
     * @param object $realmObj
     * @return Realm
     */
    private function getRealm($realmObj) {
        return new Realm(json_encode($realmObj));
    }

    /**
     * @param object $mapObj
     * @return ChallengeMap
     */
    private function getMap($mapObj) {
        return new ChallengeMap(json_encode($mapObj));
    }

    /**
     * @param array $groupArr
     * @return array
     */
    private function getGroups($groupArr = []) {
        $returnArr = [];
        
        if (is_array($groupArr)) {
            foreach ($groupArr as $group) {
                $returnArr[] = new ChallengeGroup(json_encode($group));
            }
        }

        return $returnArr;
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