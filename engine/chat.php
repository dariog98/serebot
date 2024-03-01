<?php

class Chat {
    protected $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_data() {
        return array(
            "id" => $this->id
        );
    }
}

class GroupChat extends Chat {
    private $title;
    private $type = "group";

    public function __construct($id, $title) {
        $this->id = $id;
        $this->title = $title;
    }

    public function get_data() {
        return array(
            "id" => $this->id,
            "title" => $this->title,
            "type" => $this->type
        );
    }
}

class PrivateChat extends Chat {
    private $first_name;
    private $last_name;
    private $user_name;
    private $type = "private";

    public function __construct($id, $first_name, $last_name, $user_name) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->user_name = $user_name;
    }

    public function get_data() {
        return array(
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "user_name" => $this->user_name,
            "type" => $this->type
        );
    }
}

?>