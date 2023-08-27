<?php

    function clearProfileInfo(){
        unset($_SESSION['addProfileInfo']);
        unset($_SESSION['profileInfo']);
    }

    function getProfileInfo() {
        return getSessionVar("profileInfo");
    }

    function enableProfileInfo() {
        $_SESSION['addProfileInfo'] = true;
    }


    function addProfileInfo($profile) {
        if(!isset($_SESSION["profileInfo"])) {
            $_SESSION["profileInfo"] = [];
        }
        $_SESSION['profileInfo'] = $profile;
    }

    // PROFILE props

    function getProfileId() {
        return getProfileInfo()->userId;
    }
    function getProfileUsername() {
        return getProfileInfo()->username;
    }
    function getProfileName() {
        return getProfileInfo()->name;
    }
    function getProfileSurname() {
        return getProfileInfo()->surname;
    }
    function getProfileBio() {
        return getProfileInfo()->bio;
    }
    function getProfileEmail() {
        return getProfileInfo()->email;
    }
    function getProfileBirthDate() {
        return getProfileInfo()->birthDate;
    }
    function getProfilePhoneNumber() {
        return getProfileInfo()->phoneNumber;
    }
    function getProfileFollowers() {
        return getProfileInfo()->followers;
    }
    function getProfileFollowings() {
        return getProfileInfo()->followings;
    }
    function getProfilePosts() {
        return getProfileInfo()->posts;
    }

?>

