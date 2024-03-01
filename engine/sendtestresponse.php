<?php

class SendResponse {
    public static function send_message($response){
        header("Content-Type: application/json");
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}

?>