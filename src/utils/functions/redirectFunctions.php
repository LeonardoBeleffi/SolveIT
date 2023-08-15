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
?>

