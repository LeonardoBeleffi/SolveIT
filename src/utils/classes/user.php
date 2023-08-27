<?php
// User class
class User {
    private $userId;
    private $name;
    private $surname;
    private $bio;
    private $email;
    private $username;
    private $birthDate;
    private $phoneNumber;
    private $followers;
    private $followings;
    private $posts;

    public function User(){
        $this->userId = 0;
        $this->name = "";
        $this->surname = "";
        $this->bio = "";
        $this->email = "";
        $this->username = "";
        $this->birthDate = "";
        $this->phoneNumber = "";
        $this->followers = [];
        $this->followings = [];
        $this->posts = [];
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