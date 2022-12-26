<?php

namespace Cmercado93\PortainerApiClient\Exceptions;

use Curl\Curl;

class CurlException extends \Exception
{
    protected $curl;

    public function __construct(string $message = "", int $code = 0, Curl $curl = null)
    {
        $this->curl = $curl;

        parent::__construct($message, $code);
    }

    public function getCurl() : ?Curl
    {
        return $this->curl;
    }

    public function getResponse()
    {
        return $this->curl->response;
    }
}
