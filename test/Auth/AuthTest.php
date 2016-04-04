<?php

/**
 * Auth Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class AuthTest extends PHPUnit_Framework_TestCase {

    public function testGetClientWithAuth() {
        $client = API::getClient(null, null, $token = 'good');
        $this->assertNotNull($client->userService->getUserAccountId());
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Unauthorized
     */
    public function testAuthTokenNotWorking() {
        $client = API::getClient(null, null, $token = 'bad');
        $client->userService->getUserAccountId();
    }

}