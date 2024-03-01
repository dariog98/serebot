<?php
$json = file_get_contents('php://input');
$update = json_decode($json, TRUE);

include_once("../engine/chat.php");
include_once("../engine/user.php");
include_once("../engine/message.php");
include_once("../engine/messageentity.php");
include_once("../engine/sticker.php");
include_once("../engine/sendtestresponse.php");
include_once("../engine/commands.php");

function create_message($data) {
    $chat = new PrivateChat(1, 'Serebot', 'Tester', 'tester');
    $user = new User(1, FALSE, 'Serebot', 'Tester', 'tester');
    $date = $data['date'];

    $message = new Message($chat, $user, $date);

    if ( isset($data["text"]) ) {
        $message->add_text($data["text"]);
    }

    if ( isset($data["entities"]) ) {
        foreach ($data["entities"] as $entity) {
            $message->add_entity(
                new MessageEntity(
                    $entity["type"],
                    $entity["offset"],
                    $entity["length"],
                    null, null, null
                )
            );
        }
    }

    if ( isset($data["reply_to_message"]) ) {
        $message->add_reply_message(create_message($data["reply_to_message"]));
    }

    return $message;
}

$message = create_message($update);

$command_entities = array_filter($message->get_entities(), function($value, $key) {
    return $value->get_type() == "bot_command";
}, ARRAY_FILTER_USE_BOTH);

foreach($command_entities as $entity) {
    $command = substr($message->get_text(), $entity->get_offset(), $entity->get_length());
    
    $result = Commands::resolve($command, $message);

    $response = array("text" => $result);

    SendResponse::send_message($response);
};

exit();
?>