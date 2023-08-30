<?php
    // ----------------- LOGIN functions
    function checkUserLogin(){
        if(!isUserLoggedIn()) {
            goToLogin();
        }
    }

    function isUserLoggedIn(){
        return
        isset($_SESSION['idUtente']) &&  isset($_SESSION['username']) &&
        !empty($_SESSION['idUtente']) && !empty($_SESSION['username']) ;
    }

    function loginUser($idUtente, $username, $sectorId, $theme){
        $_SESSION["idUtente"] = $idUtente;
        $_SESSION["username"] = $username;
        $_SESSION["sectorId"] = $sectorId;
        $_SESSION["theme"] = $theme;
    }

    function logoutUser(){
        unset($_SESSION['idUtente']);
        unset($_SESSION['username']);
        unset($_SESSION['theme']);
        unset($_SESSION['sectorId']);
    }

    function getUsername() {
        return getSessionVar("username");
    }

    function getIdUtente() {
        return getSessionVar("idUtente");
    }

    function getUserTheme() {
        return getSessionVar("theme");
    }

    function getUserSectorId() {
        return getSessionVar("sectorId");
    }

    function updateUserTheme() {
        if (!isset($_SESSION["theme"])) {
            $_SESSION["theme"] = 0;
            return;
        }
        $_SESSION["theme"] = 1 - $_SESSION["theme"];
    }

?>

