<?php namespace WowApi\Components\Challenges;

use WowApi\Components\BaseComponent;
use WowApi\Components\Realms\Realm;
use WowApi\Components\Characters\Character;
use WowApi\Components\Resources\Talents\Spec;

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
        $challengeObj = parent::assignValues($this, json_decode($jsonData));
        $challengeObj->realm = $this->getRealm($challengeObj->realm);
        $challengeObj->map = $this->getMap($challengeObj->map);
        $challengeObj->groups = $this->getMembersCharSpec($challengeObj->groups);


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
     * @return Map
     */
    private function getMap($mapObj) {
        return new Map(json_encode($mapObj));
    }

    /**
     * @param array $groupsArr
     * @return array
     */
    private function getMembersCharSpec($groupsArr = []) {
        foreach ($groupsArr as $group) {
            foreach ($group->members as $member) {
                if (isset($member->spec)) $member->spec = new Spec(json_encode($member->spec));

                // get the Character object and add properties not included with Character class
                if (isset($member->character)) {
                    $charBackObj = clone $member->character;

                    $member->character = new Character(json_encode($member->character));
                    if (isset($charBackObj->spec)) $member->character->spec = new Spec(json_encode($charBackObj->spec));
                    if (isset($charBackObj->guild)) $member->character->guild = $charBackObj->guild;
                    if (isset($charBackObj->guildRealm)) $member->character->guildRealm = $charBackObj->guildRealm;
                }
            }
        }

        return $groupsArr;
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