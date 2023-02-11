<?php

class Sticker {
    private $id;
    private $emoji;
    private $set_name;

    public function __construct($id, $emoji, $set_name) {
        $this->id = $id;
        $this->emoji = $emoji;
        $this->set_name = $set_name;
    }

    public function get_data() {
        return array(
            "id" => $this->id,
            "emoji" => $this->emoji,
            "set_name" => $this->set_name,
        );
    }
}

?>