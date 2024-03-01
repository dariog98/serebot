<?php

class MessageEntity {
    private $type;
    private $offset;
    private $length;
    private $url;
    private $user;
    private $custom_emoji_id;

    public function __construct($type, $offset, $length, $url, $user, $custom_emoji_id) {
        $this->type = $type;
        $this->offset = $offset;
        $this->length = $length;
        $this->url = $url;
        $this->user = $user;
        $this->custom_emoji_id = $custom_emoji_id;
    }

    public function get_type() {
        return $this->type;
    }

    public function get_offset() {
        return $this->offset;
    }

    public function get_length() {
        return $this->length;
    }

    public function get_data() {
        return array(
            "type" => $this->type,
            "offset" => $this->offset,
            "length" => $this->length,
            "url" => $this->url,
            "user" => $this->user,
            "custom_emoji_id" => $this->custom_emoji_id
        );
    }
}

?>