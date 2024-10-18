<?php

class bibliothecaire {

    private $id;
    private $pass;

    function __construct($id, $pass) {
        $this->id = $id;
        $this->pass = $pass;
    }
    function __get($attr) {
        return $this->$attr;
    }
    function __set($attr, $value) {
        $this->$attr = $value;
    }
    function __isset($attr) {
        return isset($this->$attr);
    }
    function __toString() {
     return "id: " . $this->id . " pass: " . $this->pass;
 
    }
        



}
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    
}




?>