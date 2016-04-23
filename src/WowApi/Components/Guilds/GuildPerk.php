<?php namespace WowApi\Components\Guilds;

use WowApi\Components\BaseComponent;
use WowApi\Components\Spells\Spell;

/**
 * Represents a single GuildReward
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class GuildPerk extends BaseComponent {

    /**
     * @var int $guildLevel
     */
    public $guildLevel;

    /**
     * @var Spell $spell
     */
    public $spell;

    /**
     *  GuildPerk constructor - creates the GuildPerk object based on the returned service data
     *
     * @param object $jsonData
     * @return GuildPerk
     */
    public function __construct($jsonData) {
        $guildPerk = parent::assignValues($this, $jsonData);
        $guildPerk->spell = $this->getSpell($guildPerk->spell);

        return $guildPerk;
    }

    /**
     * @param object $spellObj
     * @return Spell
     */
    private function getSpell($spellObj) {
        return new Spell($spellObj);
    }

    /**
     * Gets an array of GuildPerk items
     *
     * @param object $jsonData
     * @return array
     */
    public static function getGuildPerks($jsonData) {
        $returnArr = [];
        $guildPerks = $jsonData->perks;

        foreach ($guildPerks as $perk) {
            $returnArr[] = new GuildPerk($perk);
        }

        return $returnArr;
    }

}