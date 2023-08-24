<?php
// notification class
class Notification {
    private $notificationId;
    private $notificator;
    private $read;
    private $type;
    private $postId;
    private $timestamp;

    public function Notification(){
        $this->$notificationId = "";
        $this->$notificator = "";
        $this->$read = 0;
        $this->$type = 0;
        $this->$postId = 0;
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