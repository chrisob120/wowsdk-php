<?php

/**
 * Client Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ClientTest extends PHPUnit_Framework_TestCase {

    public function testGetClient() {
        $client = API::getClient();
        $this->assertInstanceOf('\WoWApi\WowApi', $client);
    }

    public function testGetGuzzleClient() {
        $client = new \GuzzleHttp\Client();
        $this->assertInstanceOf('\GuzzleHttp\Client', $client);
    }

    public function testGetClientWithAuth() {
        $client = API::getClient(null, null, $token = 'good');
        $this->assertNotNull($client->userService->getUserAccountId());
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Forbidden
     */
    public function testClientBadAPIKey() {
        $client = API::getClient('1');
        $client->mountService->getMounts();
    }

    /**
     * @expectedException \WowApi\Exceptions\IllegalArgumentException
     * @expectedExceptionMessage Region must be one of the following
     */
    public function testClientBadRegion() {
        API::getClient(null, ['region' => 'catDog']);
    }

    /**
     * @expectedException \WowApi\Exceptions\IllegalArgumentException
     * @expectedExceptionMessage Locale must be one of the following
     */
    public function testClientBadLocale() {
        API::getClient(null, ['locale' => 'catDog']);
    }

    /**
     * @expectedException \WowApi\Exceptions\IllegalArgumentException
     * @expectedExceptionMessage Protocol must be either http or https
     */
    public function testClientBadProtocol() {
        API::getClient(null, ['protocol' => 'catDog']);
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