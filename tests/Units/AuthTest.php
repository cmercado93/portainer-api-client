<?php

namespace Cmercado93\PortainerApiClient\Tests\Units;

use Cmercado93\PortainerApiClient\Config;
use Cmercado93\PortainerApiClient\Api\Http\Curl;
use Cmercado93\PortainerApiClient\Tests\TestCase;
use Cmercado93\PortainerApiClient\Api\Endpoints\Status;

class AuthTest extends TestCase
{
    public function test_auth()
    {
        try {
            Config::setUrl('http://192.168.49.2:30777');

            Config::setApiKey('ptr_nHxVmxVfmnGE7TAoLkDqeYdd84jTFBoSN+JEswBB6RE=');

            $status = new Status;

            var_dump($status->getVersion());
        } catch (\Exception $e) {
            var_dump($e->getCode());
            var_dump($e->getMessage());
            var_dump($e->getResponse());
        }
    }
}
