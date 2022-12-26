<?php

namespace Cmercado93\PortainerApiClient\Api;

use Cmercado93\PortainerApiClient\Exceptions\CurlException;
use Curl\Curl as CurlLib;

class Curl
{
    protected $curl;

    protected $baseUrl;

    protected $configs;

    public function __construct(string $baseUrl, array $configs = [])
    {
        $this->baseUrl = $baseUrl;
        $this->configs = $configs;

        $this->initCurl();
    }

    protected function resetCurl()
    {
        $this->initCurl();
    }

    protected function initCurl()
    {
        $this->curl = new CurlLib;

        if (isset($this->configs['disable_ssl']) && $this->configs['disable_ssl']) {
            $this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
            $this->curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
        }

        if (isset($this->configs['verbose_mode']) && $this->configs['verbose_mode']) {
            $this->curl->verbose();
        }

        $this->curl->setHeader('Content-Type', 'application/json');
        $this->curl->setHeader('Accept', 'application/json');

        if (isset($this->configs['api_key'])) {
            $this->setApiKey($this->configs['api_key']);
        }
    }

    public function setApiKey(string $apiKey)
    {
        $this->curl->setHeader('X-API-Key', $apiKey);
    }

    public function post($uri, array $data = []) : array
    {
        return $this->exec('post', $uri, $data);
    }

    public function get($uri, array $data = []) : array
    {
        return $this->exec('get', $uri, $data);
    }

    public function delete($uri, array $data = []) : array
    {
        return $this->exec('delete', $uri, $data);
    }

    public function put($uri, array $data = []) : array
    {
        return $this->exec('put', $uri, $data);
    }

    public function exec(string $method, string $uri, array $data = [])
    {
        $url = $this->makeUrl($uri, $data['query'] ?? []);

        switch ($method) {
            case 'delete':
                $this->curl->{$method}($url, [], $data['body'] ?? []);
                break;
            default:
                $this->curl->{$method}($url, $data['body'] ?? []);
                break;
        }


        if ($this->curl->error) {
            throw new CurlException($this->curl->errorMessage, $this->curl->errorCode, $this->curl);
        }

        return json_decode(json_encode($this->curl->response), true);
    }

    protected function makeUrl($uri, array $data = [])
    {
        $uri = trim($this->baseUrl, '/') . '/' . trim($uri, '/');

        if (count($data)) {
            $uri .= '?' . http_build_query($data);
        }

        return $uri;
    }
}
