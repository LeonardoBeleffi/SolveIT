<?php

// post class
class Post{
    private $postId;
    private $authorName;
    private $tags;
    private $likes;
    private $comments;
    private $contributors;
    private $attachments;
    private $attachmentsName;
    private $attachmentsType;
    private $sector;
    private $title;
    private $text;
    private $timestamp;


    public function Post(){
        $this->$postId = "";
        $this->$authorName = "";
        $this->$tags = [];
        $this->$likes = [];
        $this->$comments = [];
        $this->$contributors = [];
        $this->$title = "";
        $this->$text = "";
        $this->$sector = 0;
        $this->$attachments = [];
        $this->$attachmentsType = [];
        $this->$attachmentsName = [];
        $this->$timestamp = "";
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