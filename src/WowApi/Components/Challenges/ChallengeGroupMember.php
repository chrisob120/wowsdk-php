<?php namespace WowApi\Components\Challenges;

use WowApi\Components\BaseComponent;
use WowApi\Components\Characters\Character;
use WowApi\Components\Resources\Talents\Spec;

/**
 * Represents a single ChallengeGroupMember
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ChallengeGroupMember extends BaseComponent {

    /**
     * @var Character $character
     */
    public $character;

    /**
     * @var Spec $spec
     */
    public $spec;

    /**
     * ChallengeGroupMember constructor - creates the ChallengeGroupMember object based on the returned service data
     *
     * @param object $jsonData
     * @return ChallengeGroupMember
     */
    public function __construct($jsonData) {
        $challengeGMObj = parent::assignValues($this, $jsonData);
        $challengeGMObj->character = $this->getCharacter($challengeGMObj->character);
        $challengeGMObj->spec = $this->getSpec($challengeGMObj->spec);

        return $challengeGMObj;
    }

    /**
     * @param object $characterObj
     * @return Character
     */
    private function getCharacter($characterObj) {
        // get the Character object and add properties not included with Character class
        if (isset($characterObj)) {
            $charBackObj = clone $characterObj;

            $characterObj = new Character($characterObj);
            if (isset($charBackObj->spec)) $characterObj->spec = new Spec($charBackObj->spec);
            if (isset($charBackObj->guild)) $characterObj->guild = $charBackObj->guild;
            if (isset($charBackObj->guildRealm)) $characterObj->guildRealm = $charBackObj->guildRealm;
        }

        return $characterObj;
    }

    /**
     * @param object $specObj
     * @return Spec
     */
    private function getSpec($specObj) {
        if (isset($specObj)) $specObj = new Spec($specObj);
        return $specObj;
    }

}