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
        $this->client = new Client();
        $this->apiSecret = config('laravel-bigmsgbox.apiSecret');
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
        return $this->client->get("https://api.bigmsgbox.com/message/send-sms?from=$this->senderId&to={$to}&message={$message}&apikey=$this->apiKey&apisecret=$this->apiSecret");
        
    }
}
