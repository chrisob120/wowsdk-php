<?php namespace WowApi;

use WowApi\Services\CharacterService;
use WowApi\Services\GuildService;
use WowApi\Services\RealmService;
use WowApi\Services\MountService;
use WowApi\Services\AchievementService;
use WowApi\Services\AuctionService;
use WowApi\Services\BossService;
use WowApi\Services\PetService;
use WowApi\Services\QuestService;
use WowApi\Services\RecipeService;
use WowApi\Services\SpellService;
use WowApi\Services\ZoneService;
use WowApi\Services\ChallengeService;
use WowApi\Services\LeaderboardService;
use WowApi\Services\ItemService;
use WowApi\Services\ResourceService;

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
     * @var CharacterService $characterService
     */
    public $characterService;

    /**
     * @var RealmService $realmService
     */
    public $realmService;

    /**
     * @var GuildService $guildService
     */
    public $guildService;

    /**
     * @var MountService $mountService
     */
    public $mountService;

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
     * @var PetService $petService
     */
    public $petService;

    /**
     * @var QuestService $questService
     */
    public $questService;

    /**
     * @var RecipeService $recipeService
     */
    public $recipeService;

    /**
     * @var SpellService $spellService
     */
    public $spellService;

    /**
     * @var ZoneService $zoneService
     */
    public $zoneService;

    /**
     * @var ChallengeService $challengeService
     */
    public $challengeService;

    /**
     * @var LeaderboardService $leaderboardService
     */
    public $leaderboardService;

    /**
     * @var ItemService $itemService
     */
    public $itemService;

    /**
     * @var ResourceService $resourceService
     */
    public $resourceService;

    /**
     * WowApi constructor
     *
     * @param string $apiKey
     * @param array|null $options
     */
    public function __construct($apiKey, $options = null) {
        $this->characterService = new CharacterService($apiKey, $options);
        $this->realmService = new RealmService($apiKey, $options);
        $this->guildService = new GuildService($apiKey, $options);
        $this->mountService = new MountService($apiKey, $options);
        $this->achievementService = new AchievementService($apiKey, $options);
        $this->auctionService = new AuctionService($apiKey, $options);
        $this->bossService = new BossService($apiKey, $options);
        $this->petService = new PetService($apiKey, $options);
        $this->questService = new QuestService($apiKey, $options);
        $this->recipeService = new RecipeService($apiKey, $options);
        $this->spellService = new SpellService($apiKey, $options);
        $this->zoneService = new ZoneService($apiKey, $options);
        $this->challengeService = New ChallengeService($apiKey, $options);
        $this->leaderboardService = New LeaderboardService($apiKey, $options);
        $this->itemService = new ItemService($apiKey, $options);
        $this->resourceService = new ResourceService($apiKey, $options);
    }

}