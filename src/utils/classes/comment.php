<?php
// comment class
class Comment {
    private $commentId;
    private $author;
    private $text;
    private $timestamp;
    private $parentId;

    public function Comment(){
        $this->$commentId = "";
        $this->$author = "";
        $this->$text = [];
        $this->$timestamp = [];
        $this->$parentId = [];
    }

    // overloading functions - see "https://www.php.net/manual/en/language.oop5.overloading.php"
    public function __get($prop)
    {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
        return null;
    }

    public function __set($prop, $value) {
        if (property_exists($this, $prop)) {
        $this->$prop = $value;
        }
        return $this;
    }
}
?>