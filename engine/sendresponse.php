<?php

class SendResponse {
    public static function send_message($bot_website, $chat_id, $response){
        $url = $bot_website . "/sendMessage";
        $context = array (
            "http" => array (
                "method" => "GET",
                "header" => "Content-type: application/json\r\n",
                "content" => json_encode(array(
                    "chat_id" => $chat_id,
                    "parse_mode" => "HTML",
                    "text" => $response
                ))
            )
        );
        file_get_contents($url, false, stream_context_create($context));
    }

    public static function send_photo($bot_website, $chat_id, $photo, $caption = null) {
        $url = $bot_website . "/sendPhoto";
        $context = array (
            "http" => array (
                "method" => "GET",
                "header" => "Content-type: application/json\r\n",
                "content" => json_encode(array(
                    "chat_id" => $chat_id,
                    "photo" => $photo,
                    "caption" => $caption
                ))
            )
        );
        file_get_contents($url, false, stream_context_create($context));
    }
}

?>