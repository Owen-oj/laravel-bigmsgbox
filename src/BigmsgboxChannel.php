<?php


namespace Owenoj\LaravelBigmsgbox;


use GuzzleHttp\Client;

class BigmsgboxChannel
{
    
    protected Client $client;
    protected string $message;
    protected $apiSecret;
    protected $apiKey;
    
    public function __construct($message)
    {
        $this->client = new Client();
        $this->client = $message;
        $this->apiSecret = config('config.apiSecret');
        $this->apiKey = config('config.apiKey');
    }
    
    /**
     * @throws \Exception
     */
    public function send($notifiable, \Notification $notification)
    {
        try {
            $to = $this->getTo($notifiable);
            $message = $notification->toBigmsgbox($notifiable);
            $senderId = config('config.senderId');
            return $this->client->get("https://api.bigmsgbox.com/message/send-sms?from=$senderId&to={$to}&message={$message}&apikey=$this->apiKey&apisecret=$this->apiSecret");
        } catch (\Exception $exception) {
            
            throw $exception;
        }
    }
    
    /**
     * @throws \Exception
     */
    public function getTo($notifiable)
    {
        if ($notifiable->routeNotificationFor('bigmsgbox')) {
            return $notifiable->routeNotificationFor('bigmsgbox');
        }
        if (isset($notifiable->phone_number)) {
            return $notifiable->phone_number;
        }
        
        throw new \Exception("Invalid phone number");
    }
    
}