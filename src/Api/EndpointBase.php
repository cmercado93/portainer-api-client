<?php

namespace Cmercado93\PortainerApiClient\Api;

use Cmercado93\PortainerApiClient\Config;
use Cmercado93\PortainerApiClient\Api\Http\Curl;

abstract class EndpointBase
{
    protected $data;

    protected $curl;

    public function __construct(array $data = [])
    {
        $this->data = $data;

        $this->initCurl();
    }

    public function needAuth()
    {
        $this->curl->setApiKey(Config::getApiKey());
    }

    protected function getUrl()
    {
        return Config::getUrl();
    }

    protected function getApiKey()
    {
        return Config::getApiKey();
    }

    protected function initCurl()
    {
        $config = [];

        $this->curl = new Curl($this->getUrl(), $config);
    }

    public function send()
    {
    }
}
