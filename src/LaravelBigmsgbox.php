<?php

namespace Owenoj\LaravelBigmsgbox;

use GuzzleHttp\Client;

class LaravelBigmsgbox
{
    protected Client $client;
    protected $apiVersion;
    protected $apiKey;
    protected $senderId;
    protected $baseUrl;
    
    public function __construct()
    {
    
        $this->apiVersion = config('laravel-bigmsgbox.apiVersion');
        $this->apiKey = config('laravel-bigmsgbox.apiKey');
        $this->senderId = config('laravel-bigmsgbox.senderId');
        $this->baseUrl = config('laravel-bigmsgbox.baseUrl');
        
        $this->client = new Client([
            'verify' => false,
            'headers' => [
                'X-Api-Key' => $this->apiKey,
                'X-Api-Version' => $this->apiVersion
            ]
        ]);
    }
    
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function send($to, $message)
    {
        if (is_null($this->senderId)) {
            throw new \Exception("Invalid senderId or senderId is null");
        }
        return $this->client->get("$this->baseUrl?From=$this->senderId&To={$to}&Message={$message}");
        
    }
}
