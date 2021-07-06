<?php


namespace Owenoj\LaravelBigmsgbox;


use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class BigmsgboxChannel
{
    
    
    /**
     * @throws \Exception
     */
    public function send($notifiable, Notification $notification)
    {
        
        $to = $this->getTo($notifiable);
        $message = $notification->toBigmsgbox($notifiable);
        return Bigmsgbox::send($to, $message);
        
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