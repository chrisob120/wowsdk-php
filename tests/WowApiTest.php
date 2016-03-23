<?php

use WowApi\WowApi;

class WowApiTest extends PHPUnit_Framework_TestCase {

    public function testIsCool() {
        $wowApi = new WowApi();
        $this->assertTrue($wowApi->isCool());
    }

}