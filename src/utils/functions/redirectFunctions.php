<?php

    // ----------------- REDIRECT functions
    function goToHome(){
        header("Location: /src/home.php");
        exit();
    }

    function goToLogin(){
        header("Location: /src/login.php");
        exit();
    }

    function goToRegister(){
        header("Location: /src/register.php");
        exit();
    }

    function goToSettings(){
        header("Location: /src/settings.php");
        exit();
    }

    function goToPostCreation(){
        header("Location: /src/newpost.php");
        exit();
    }

?>

