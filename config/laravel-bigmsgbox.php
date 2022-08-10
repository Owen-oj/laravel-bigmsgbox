<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'apiKey' => env('BIGMSGBOX_API_KEY'),
    'apiVersion' => env('BIGMSGBOX_API_VERSION','1.0'),
    'senderId' => env('BIGMSGBOX_SENDERID'),
    'baseUrl' => env('BIGMSGBOX_BASE_URL','https://api.bigmsgbox.com/message/send'),
];