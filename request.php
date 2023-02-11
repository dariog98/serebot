<?php 

error_reporting(-1);
ini_set( 'display_errors', 1 );

$bot_token = getenv("BOTTOKEN");

$website = "https://api.telegram.org/bot" . $bot_token;

$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);

include_once("chat.php");
include_once("user.php");
include_once("message.php");
include_once("messageentity.php");
include_once("sticker.php");
include_once("sendresponse.php");

function create_message($data) {
    // Loading Message Data
    $user = new User(
        $data["from"]["id"],
        $data["from"]["is_bot"],
        $data["from"]["first_name"],
        $data["from"]["last_name"],
        $data["from"]["username"]
    );

    $chat = ($data["chat"]["type"] == "private")
        ? new PrivateChat(
            $data["chat"]["id"],
            $data["chat"]["first_name"],
            $data["chat"]["last_name"],
            $data["chat"]["username"]
        )
        : new GroupChat(
            $data["chat"]["id"],
            $data["chat"]["title"]
        );
    
    $date = $data["date"];
    
    $message = new Message($chat, $user, $date);

    if ( isset($data["text"]) ) {
        $message->add_text($data["text"]);
    }

    if ( isset($data["sticker"]) ) {
        $message->add_sticker(
            new Sticker(
                $data["sticker"]["file_unique_id"],
                $data["sticker"]["emoji"],
                $data["sticker"]["set_name"]
            )
        );
    }

    if ( isset($data["entities"]) ) {
        foreach ($data["entities"] as $entity) {
            $message->add_entity(
                new MessageEntity(
                    $entity["type"],
                    $entity["offset"],
                    $entity["length"],
                    $entity["url"],
                    $entity["user"],
                    $entity["custom_emoji_id"]
                )
            );
        }
    }

    if ( isset($data["reply_to_message"]) ) {
        $message->add_reply_message(create_message($data["reply_to_message"]));
    }

    return $message;
}

$message = null;

// Message
if ( isset($update["message"]) ) {
    $message = create_message($update["message"]);
}

// Handle Response
$command_entities = array_filter($message->get_entities(), function($value, $key) {
    return $value->get_type() == "bot_command";
}, ARRAY_FILTER_USE_BOTH);

foreach($command_entities as $entity) {
    $command = substr($message->get_text(), $entity->get_offset(), $entity->get_length());
    if ($command == "/toJSON") {
        SendResponse::send_message(
            $website,
            $message->get_chat()->get_id(),
            json_encode($update["message"]["reply_to_message"], JSON_PRETTY_PRINT)
        );
    }
}

?>