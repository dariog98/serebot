<?php

include_once("chat.php");
include_once("user.php");
include_once("messageentity.php");
include_once("sticker.php");

class Message {
    private $chat;
    private $user;
    private $date;
    private $text;
    private $sticker;
    private $entities;
    private $reply_to_message;

    public function __construct($chat, $from, $date) {
        $this->chat = $chat;
        $this->user = $from;
        $this->date = $date;
        $this->entities = [];
    }

    public function add_text($text) {
        $this->text = $text;
    }

    public function add_sticker($sticker) {
        $this->sticker = $sticker;
    }

    public function add_reply_message($message) {
        $this->reply_to_message = $message;
    }

    public function add_entity($entity) {
        $this->entities[] = $entity;
    }

    public function get_chat() {
        return $this->chat;
    }

    public function get_text() {
        return $this->text;
    }

    public function get_entities() {
        return $this->entities;
    }

    public function get_reply_message() {
        return $this->reply_to_message;
    }

    public function has_reply_message() {
        return $this->reply_to_message != null;
    }

    public function get_data() {
        return array(
            "chat" => $this->chat->get_data(),
            "user" => $this->user->get_data(),
            "text" => $this->text,
            "sticker" => $this->sticker ? $this->sticker->get_data() : null,
            "reply_to_message" => $this->has_reply_message() ? $this->reply_to_message->get_data() : null
        );
    }

    public static function create_message_from_data($data) {
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
            $message->add_reply_message(Message::create_message_from_data($data["reply_to_message"]));
        }
    
        return $message;
    }
}

?>