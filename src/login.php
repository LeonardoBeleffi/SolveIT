<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';

    // check login
    if(isUserLoggedIn()) {
        goToHome();
    }

    // set template elements
    clearTemplate();
    setTitle("Sign In - SolveIT");
    setHeader("login/login-header.php");
    setMain("login/login-main.php");
    setFooter("login/login-footer.php");
    setCSS(["./css/login.css"]);
    setRemoteCSS(["https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"]);
    setJS(["./js/login.js"]);

    // require template
    require "template/base.php";
?>

