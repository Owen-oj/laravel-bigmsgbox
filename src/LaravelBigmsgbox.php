<?php

namespace Owenoj\LaravelBigmsgbox;

use GuzzleHttp\Client;

class LaravelBigmsgbox
{
    protected Client $client;
    protected $apiSecret;
    protected $apiKey;
    protected $senderId;
    
    public function __construct()
    {
        $this->client = new Client(['verify' => false]);
        $this->apiVersion = config('laravel-bigmsgbox.apiVersion');
        $this->apiKey = config('laravel-bigmsgbox.apiKey');
        $this->senderId = config('laravel-bigmsgbox.senderId');
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
        return $this->client->get("https://api-new.bigmsgbox.com/message/send?From=$this->senderId&To={$to}&Message={$message}",[
            'X-Api-Key' => $this->apiKey,
            'X-Api-Version'=> $this->apiVersion
        ]);
        
    }
}
