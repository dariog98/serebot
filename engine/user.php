<?php

class User {
    private $id;
    private $is_bot;
    private $first_name;
    private $last_name;
    private $username;

    public function __construct($id, $is_bot, $first_name, $last_name, $username) {
        $this->id = $id;
        $this->is_bot = $is_bot;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->username = $username;
    }

    public function get_data() {
        return array(
            "id" => $this->id,
            "is_bot" => $this->is_bot,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "username" => $this->username,
        );
    }
}

?>