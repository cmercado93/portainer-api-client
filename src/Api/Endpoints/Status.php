<?php

namespace Cmercado93\PortainerApiClient\Api\Endpoints;

use Cmercado93\PortainerApiClient\Api\EndpointBase;

class Status extends EndpointBase
{
    public function getStatus()
    {
        return $this->curl->get('/api/status');
    }

    public function getVersion()
    {
        $this->needAuth();

        return $this->curl->get('/api/status/version');
    }
}
