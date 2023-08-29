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

    function loginUser($idUtente, $username, $sectorId){
        $_SESSION["idUtente"] = $idUtente;
        $_SESSION["username"] = $username;
        $_SESSION["userSectorId"] = $sectorId;
    }

    function logoutUser(){
        unset($_SESSION['idUtente']);
        unset($_SESSION['username']);
        unset($_SESSION['userSectorId']);
    }

    function getUsername() {
        return getSessionVar("username");
    }

    function getIdUtente() {
        return getSessionVar("idUtente");
    }

    function getUserSectorId() {
        return getSessionVar("userSectorId");
    }
?>

