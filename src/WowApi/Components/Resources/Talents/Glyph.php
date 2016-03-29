<?php namespace WowApi\Components\Resources\Talents;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Glyph
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Glyph extends BaseComponent {

    /**
     * @var string $glyph
     */
    public $glyph;

    /**
     * @var int $item
     */
    public $item;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $icon
     */
    public $icon;

    /**
     * @var int $typeId
     */
    public $typeId;

    /**
     * Glyph constructor - creates the Glyph object based on the returned service data
     *
     * @param object $jsonData
     * @return Glyph
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

    /**
     * Gets an array of Glyph items
     *
     * @param string $jsonData
     * @return array
     */
    public static function getGlyphs($jsonData) {
        $returnArr = [];
        $glyphs = json_decode($jsonData)->glyphs;

        foreach ($glyphs as $glyph) {
            $returnArr[] = new Glyph(json_encode($glyph));
        }

        return $returnArr;
    }

}