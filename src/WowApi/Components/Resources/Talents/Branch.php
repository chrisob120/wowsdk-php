<?php namespace WowApi\Components\Resources\Talents;

use WowApi\Components\BaseComponent;

/**
 * Represents the TalentTree
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Branch extends BaseComponent {

    /**
     * @var array $glyphs
     */
    public $glyphs;

    /**
     * @var array $talents
     */
    public $talents;

    /**
     * @var string $class
     */
    public $class;

    /**
     * @var array $specs
     */
    public $specs;

    /**
     * Branch constructor - creates the Branch object based on the returned service data
     */
    public function __construct() {
    }

}