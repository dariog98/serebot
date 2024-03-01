<?php

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

    public function get_data() {
        return array(
            "chat" => $this->chat->get_data(),
            "user" => $this->user->get_data(),
            "text" => $this->text,
            "sticker" => $this->sticker ? $this->sticker->get_data() : null,
            "reply_to_message" => $this->reply_to_message ? $this->reply_to_message->get_data() : null
        );
    }
}

?>