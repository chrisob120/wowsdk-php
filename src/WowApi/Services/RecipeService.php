<?php namespace WowApi\Services;

use WowApi\Components\Recipes\Recipe;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\WowApiException;

/**
 * Recipe services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class RecipeService extends BaseService {

    /**
     * Get Recipe component
     *
     * @param int $recipeId
     * @return Recipe
     * @throws WowApiException
     */
    public function getRecipe($recipeId) {
        $url = $this->getPath('recipe/:recipe', [
            'recipe' => (int)$recipeId
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new Recipe($response->getBody());
    }
}