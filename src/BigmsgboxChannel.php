<?php


namespace Owenoj\LaravelBigmsgbox;


use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class BigmsgboxChannel
{
    
    protected Client $client;
    protected $apiSecret;
    protected $apiKey;
    protected $senderId;
    
    public function __construct()
    {
        $this->client = new Client();
        $this->apiSecret = config('config.apiSecret');
        $this->apiKey = config('config.apiKey');
        $this->senderId = config('config.senderId');
    }
    
    /**
     * @throws \Exception
     */
    public function send($notifiable, Notification $notification)
    {
        try {
            $to = $this->getTo($notifiable);
            $message = $notification->toBigmsgbox($notifiable);
            return $this->client->get("https://api.bigmsgbox.com/message/send-sms?from=$this->senderId&to={$to}&message={$message}&apikey=$this->apiKey&apisecret=$this->apiSecret");
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