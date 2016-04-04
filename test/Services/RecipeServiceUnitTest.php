<?php

/**
 * Recipe Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class RecipeServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\RecipeService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->recipeService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetRecipe() {
        $recipe = $this->_access->getRecipe(33994);
        $this->assertInstanceOf('\WowApi\Components\Recipes\Recipe', $recipe);
        $this->assertEquals(33994, $recipe->id);
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Not Found
     */
    public function testRecipeNotFound() {
        $this->_access->getRecipe(0);
    }

}