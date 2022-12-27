<?php

namespace Cmercado93\PortainerApiClient;

use Cmercado93\PortainerApiClient\Exceptions\ConfigException;

class Config
{
    protected static $url;

    protected static $apiKey;

    protected function __construct()
    {
        //
    }

    public static function setUrl(string $url)
    {
        $url = trim($url);

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new ConfigException("No se ingreso la URL de portainer");
        }

        $url = parse_url($url);

        static::$url = $url['scheme'] . '://' . $url['host'] . ':' . ($url['port'] ?? 80);
    }

    public static function getUrl() : string
    {
        if (!static::$url) {
            throw new ConfigException("No se ingreso la URL de portainer");
        }

        return static::$url;
    }

    public static function setApiKey(string $apiKey)
    {
        $apiKey = trim($apiKey);

        if (!$apiKey) {
            throw new ConfigException("No se ingreso la API KEY");
        }

        static::$apiKey = $apiKey;
    }

    public static function getApiKey() : string
    {
        if (!static::$apiKey) {
            throw new ConfigException("No se ingreso la API KEY");
        }

        return static::$apiKey;
    }
}
