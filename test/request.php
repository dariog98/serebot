<?php

$json = file_get_contents('php://input');
$update = json_decode($json, TRUE);

include_once("../engine/message.php");
include_once("../engine/commands.php");
include_once("../engine/sendtestresponse.php");

$message = Message::create_message_from_data($update["message"]);

#echo json_encode($message->get_data(), JSON_PRETTY_PRINT);

$command_entities = array_filter($message->get_entities(), function($value, $key) {
    return $value->get_type() == "bot_command";
}, ARRAY_FILTER_USE_BOTH);

if (count($command_entities)) {
    foreach($command_entities as $entity) {
        $command = substr($message->get_text(), $entity->get_offset(), $entity->get_length());
        $result = Commands::resolve($command, $message);
        $response = array("text" => $result);
        SendResponse::send_message($response);
    }
} else {
    $response = "Hello world!";
    SendResponse::send_message($response);
}

?>