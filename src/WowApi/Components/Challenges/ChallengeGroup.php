<?php namespace WowApi\Components\Challenges;

use WowApi\Components\BaseComponent;

/**
 * Represents a single ChallengeGroup
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ChallengeGroup extends BaseComponent {

    /**
     * @var int $ranking
     */
    public $ranking;

    /**
     * @var ChallengeTime $time
     */
    public $time;

    /**
     * @var string $date
     */
    public $date;

    /**
     * @var string $medal
     */
    public $medal;

    /**
     * @var string $faction
     */
    public $faction;

    /**
     * @var bool $isRecurring
     */
    public $isRecurring;

    /**
     * @var array $members
     */
    public $members;

    /**
     * ChallengeGroup constructor - creates the ChallengeGroup object based on the returned service data
     *
     * @param object $jsonData
     * @return ChallengeGroup
     */
    public function __construct($jsonData) {
        $groupObj = parent::assignValues($this, json_decode($jsonData));
        $groupObj->time = $this->getTime($groupObj->time);
        if (isset($groupObj->members)) $groupObj->members = $this->getMembers($groupObj->members);

        return $groupObj;
    }

    /**
     * @param object $timeObj
     * @return ChallengeTime
     */
    private function getTime($timeObj) {
        return new ChallengeTime(json_encode($timeObj));
    }

    /**
     * @param array $memberArr
     * @return array
     */
    private function getMembers($memberArr = []) {
        $returnArr = [];

        foreach ($memberArr as $member) {
            $returnArr[] = new ChallengeGroupMember(json_encode($member));
        }

        return $returnArr;
    }

}