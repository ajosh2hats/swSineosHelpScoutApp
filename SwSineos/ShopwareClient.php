<?php

namespace SwSineos;

class ShopwareClient
{
    /** 
     * @var \GuzzleHttp\Client 
     */
    private $client;

    /** @var string */
    private $baseUrl;

    /** @var string */
    private $accessToken = null;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        $this->baseUrl = $_ENV['SINEOS_BASE_URL'];

        $this->authenticate();
    }

    private function authenticate()
    {
        $res = $this->client->request('POST', $this->baseUrl . '/api/oauth/token', [
          
        ]);
        
        $this->accessToken = json_decode($res->getBody()->getContents(),true);
    }

    public function getAccessToken()
    {
        if ($this->accessToken) {
            return $this->accessToken;
        }      
    }
}