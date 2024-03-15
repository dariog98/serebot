<?php 

error_reporting(-1);
ini_set( 'display_errors', 1 );

$bot_token = getenv("BOTTOKEN");

$website = "https://api.telegram.org/bot" . $bot_token;

$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);

include_once("engine/message.php");
include_once("engine/sendresponse.php");
include_once("engine/commands.php");

$message = null;

// Message
if ( isset($update["message"]) ) {
    $message = Message::create_message_from_data($update["message"]);
}

// Handle Response
$command_entities = array_filter($message->get_entities(), function($value, $key) {
    return $value->get_type() == "bot_command";
}, ARRAY_FILTER_USE_BOTH);

foreach($command_entities as $entity) {
    $command = substr($message->get_text(), $entity->get_offset(), $entity->get_length());

    $response = Commands::resolve($command, $message);

    SendResponse::send_message(
        $website,
        $message->get_chat()->get_id(),
        $response
    );
}

?>