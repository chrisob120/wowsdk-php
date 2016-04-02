<?php namespace WowApi;

use WowApi\Services\AchievementService;
use WowApi\Services\AuctionService;
use WowApi\Services\BossService;
use WowApi\Services\ChallengeService;
use WowApi\Services\CharacterService;
use WowApi\Services\GuildService;
use WowApi\Services\ItemService;
use WowApi\Services\LeaderboardService;
use WowApi\Services\MountService;
use WowApi\Services\PetService;
use WowApi\Services\QuestService;
use WowApi\Services\RealmService;
use WowApi\Services\RecipeService;
use WowApi\Services\ResourceService;
use WowApi\Services\SpellService;
use WowApi\Services\UserService;
use WowApi\Services\ZoneService;

/**
 * WoW API Class
 *
 * Description
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class WowApi {

    /**
     * @var AchievementService $achievementService
     */
    public $achievementService;

    /**
     * @var AuctionService $auctionService
     */
    public $auctionService;

    /**
     * @var BossService $bossService
     */
    public $bossService;

    /**
     * @var ChallengeService $challengeService
     */
    public $challengeService;

    /**
     * @var CharacterService $characterService
     */
    public $characterService;

    /**
     * @var GuildService $guildService
     */
    public $guildService;

    /**
     * @var ItemService $itemService
     */
    public $itemService;

    /**
     * @var LeaderboardService $leaderboardService
     */
    public $leaderboardService;

    /**
     * @var MountService $mountService
     */
    public $mountService;

    /**
     * @var PetService $petService
     */
    public $petService;

    /**
     * @var QuestService $questService
     */
    public $questService;

    /**
     * @var RealmService $realmService
     */
    public $realmService;

    /**
     * @var RecipeService $recipeService
     */
    public $recipeService;

    /**
     * @var ResourceService $resourceService
     */
    public $resourceService;

    /**
     * @var SpellService $spellService
     */
    public $spellService;

    /**
     * @var UserService $userService
     */
    public $userService;

    /**
     * @var ZoneService $zoneService
     */
    public $zoneService;

    /**
     * WowApi constructor
     *
     * @param string $apiKey
     * @param array|null $options
     */
    public function __construct($apiKey, $options = null) {
        $this->achievementService = new AchievementService($apiKey, $options);
        $this->auctionService = new AuctionService($apiKey, $options);
        $this->bossService = new BossService($apiKey, $options);
        $this->challengeService = New ChallengeService($apiKey, $options);
        $this->characterService = new CharacterService($apiKey, $options);
        $this->guildService = new GuildService($apiKey, $options);
        $this->itemService = new ItemService($apiKey, $options);
        $this->leaderboardService = New LeaderboardService($apiKey, $options);
        $this->mountService = new MountService($apiKey, $options);
        $this->petService = new PetService($apiKey, $options);
        $this->questService = new QuestService($apiKey, $options);
        $this->realmService = new RealmService($apiKey, $options);
        $this->recipeService = new RecipeService($apiKey, $options);
        $this->resourceService = new ResourceService($apiKey, $options);
        $this->spellService = new SpellService($apiKey, $options);
        $this->userService = new UserService($apiKey, $options);
        $this->zoneService = new ZoneService($apiKey, $options);
    }

}