<?php namespace WowApi\Services;

use WowApi\Components\Resources\Battlegroup;
use WowApi\Components\Resources\Talents\Branch;
use WowApi\Components\Resources\Talents\Glyph;
use WowApi\Components\Resources\Talents\Spec;
use WowApi\Components\Resources\Talents\Talent;
use WowApi\Components\Resources\Talents\TalentTree;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\IllegalArgumentException;
use WowApi\Exceptions\WowApiException;

/**
 * Resource services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ResourceService extends BaseService {

    /**
     * Get Battlegroups based on current region
     *
     * @return array
     * @throws IllegalArgumentException
     * @throws WowApiException
     */
    public function getBattlegroups() {
        $request = parent::createRequest('GET', 'data/battlegroups/');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return Battlegroup::getBattlegroups($response->getBody());
    }

    /**
     * Get TalentTree
     *
     * @return TalentTree
     * @throws IllegalArgumentException
     * @throws WowApiException
     */
    public function getTalentTree() {
        $request = parent::createRequest('GET', 'data/talents');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        $buildTree = $this->buildTalentTree(json_decode($response->getBody()));

        $talentTree = new TalentTree();
        $talentTree->tree = $buildTree;

        return $talentTree;
    }

    /**
     * Build the TalentTree
     *
     * @param object $talentTree
     * @return array
     */
    private function buildTalentTree($talentTree) {
        $branches = [];

        foreach ($talentTree as $branch) {
            $branchObj = new Branch();
            $branchObj->glyphs = $this->getGlyphs($branch->glyphs);
            $branchObj->talents = $this->getTalents($branch->talents);
            $branchObj->class = $branch->class;
            $branchObj->specs = $this->getSpecs($branch->specs);

            $branches[] = $branchObj;
        }

        return $branches;
    }

    /**
     * Get the Glyphs for each Branch
     *
     * @param array $glyphArr
     * @return array
     */
    private function getGlyphs($glyphArr = []) {
        $returnArr = [];

        foreach ($glyphArr as $glyph) {
            $returnArr[] = new Glyph(json_encode($glyph));
        }

        return $returnArr;
    }

    /**
     * Get the tiers and their Talents
     *
     * @param array $tierArr
     * @return array
     */
    private function getTalents($tierArr = []) {
        $returnArr = [];

        foreach ($tierArr as $tier) {
            $tierArr = [];

            foreach ($tier as $tierTalents) {
                $talentArr = [];

                foreach ($tierTalents as $talent) {
                    $talentArr[] = new Talent(json_encode($talent));
                }

                $tierArr[] = $talentArr;
            }

            $returnArr[] = $tierArr;
        }

        return $returnArr;
    }

    /**
     * Get the Talent Specs
     *
     * @param array $specArr
     * @return array
     */
    private function getSpecs($specArr = []) {
        $returnArr = [];

        foreach ($specArr as $spec) {
            $returnArr[] = new Spec(json_encode($spec));
        }

        return $returnArr;
    }

}