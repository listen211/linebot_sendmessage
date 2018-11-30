<?php
define("CHANNEL_SECRET", 'da8aca117b32379f251ec6b91f5de126');
define("CHANNEL_TOKEN",
    'mc7Ll1w8ekb/9hIo4diqsqSffKrec3pQPrp+rLd/a7K8QnTs7JSyPq5dKY1upFXj+ePPz9BcSOjTx2rRwk6jVlpisCdKulLUqcLfTtjqAW8SAKoCpPKW+a+lzxqr0xBxPeslkMlslBqz+bWMv3KlMQdB04t89/1O/w1cDnyilFU=');
require __DIR__."/vendor/autoload.php";
require_once (__DIR__.'/vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

function messageContent($event, $text){
    return [
        'replyToken' => $event['replyToken'],
        'messages' => [
            [
                'type' => 'text',
                'text' => $text
            ]
        ]
    ];
}

$client = new LINEBotTiny(CHANNEL_TOKEN, CHANNEL_SECRET);
foreach ($client->parseEvents() as $event) {
    $userId = $event['source']['userId'];
    error_log('User_ID: '.$userId);
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    $request = $message['text'];
                    $model_nm = $request;
                    error_log(implode(' / ', $event), 0);
                    $client->replyMessage(messageContent($event,$model_nm));
                    break;
            }
            break;
        case 'postback':
            $postback = $event['postback'];
            $data = $postback['data'];
            break;
    }
}
?>