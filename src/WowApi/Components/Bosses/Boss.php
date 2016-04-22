<?php namespace WowApi\Components\Bosses;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Boss
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Boss extends BaseComponent {

    /**
     * @var int $id
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
     * @var bool $availableInNormalMode
     */
    public $availableInNormalMode;

    /**
     * @var bool $availableInHeroicMode
     */
    public $availableInHeroicMode;

    /**
     * @var int $health
     */
    public $health;

    /**
     * @var int $heroicHealth
     */
    public $heroicHealth;

    /**
     * @var int $level
     */
    public $level;

    /**
     * @var int $heroicLevel
     */
    public $heroicLevel;

    /**
     * @var int $journalId
     */
    public $journalId;

    /**
     * @var array $npcs
     */
    public $npcs;

    /**
     * Boss constructor - creates the Boss object based on the returned service data
     *
     * @param object $jsonData
     * @return Boss
     */
    public function __construct($jsonData) {
        $boss = parent::assignValues($this, $jsonData);
        if (isset($boss->npcs)) $boss->npcs = $this->getNPCs($boss->npcs);

        return $boss;
    }

    /**
     * @param array $npcArr
     * @return array
     */
    private function getNPCs($npcArr = []) {
        $returnArr = [];

        foreach ($npcArr as $npc) {
            $returnArr[] = new NPC($npc);
        }

        return $returnArr;
    }

}