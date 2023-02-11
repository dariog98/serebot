<?php

class Photo {
    private $file_id;
    private $file_unique_id;
    private $file_size;
    private $width;
    private $height;

    public function __construct($file_id, $file_unique_id, $file_size, $width, $height) {
        $this->file_id = $file_id;
        $this->file_unique_id = $file_unique_id;
        $this->file_size = $file_size;
        $this->width = $width;
        $this->height = $height;
    }

    public function get_data() {
        return array(
            "file_id" => $this->file_id,
            "file_unique_id" => $this->file_unique_id,
            "file_size" => $this->file_size,
            "width" => $this->width,
            "height" => $this->height,
        );
    }
}

?>