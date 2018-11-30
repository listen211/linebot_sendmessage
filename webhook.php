<?php
define("CHANNEL_SECRET", 'da8aca117b32379f251ec6b91f5de126');
define("CHANNEL_TOKEN",
    'mc7Ll1w8ekb/9hIo4diqsqSffKrec3pQPrp+rLd/a7K8QnTs7JSyPq5dKY1upFXj+ePPz9BcSOjTx2rRwk6jVlpisCdKulLUqcLfTtjqAW8SAKoCpPKW+a+lzxqr0xBxPeslkMlslBqz+bWMv3KlMQdB04t89/1O/w1cDnyilFU=');
require __DIR__."/vendor/autoload.php";
require_once (__DIR__.'/vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

    $client = new LINEBotTiny(CHANNEL_TOKEN, CHANNEL_SECRET);
    foreach ($client->parseEvents() as $event) {
        /** get user id */
        $userId = $event['source']['userId'];
        /** Handle request */
        switch ($event['type']) {
            // Tr??ng h?p user g?i request tin nh?n l?n server
            case 'message':
                $message = $event['message'];
                switch ($message['type']) {
                    // n?u TH request ???c g?i l?n l? d?ng text
                    case 'text':
                        // n?i dung message ???c g?i l?n t? user
                        $request = $message['text'];
                        // function tr? l?i tin nh?n cho user
                        error_log ('replytoken',$event['replyToken']);
                        $client->replyMessage(
                            [
                                'replyToken' => $event['replyToken'],
                                'messages' => [
                                    [
                                        'type' => 'text',
                                        'text' => 'Hello Thu'
                                    ]
                                ]
                            ]
                        );
                        break;
                    // c?c lo?i tin nh?n kh?c nh? image, video, location, audio. . .
                    // xem th?m t?i: https://developers.line.biz/en/reference/messaging-api/#message-event
                    case 'video':
                    case 'image':
                        break;
                }
                break;
            // Tr??ng h?p user click v?o item rich menu
            case 'postback':
                $postback = $event['postback'];
                $data = $postback['data']; // n?i dung postback ?c g?i l?n
                break;
        }
    }
?>