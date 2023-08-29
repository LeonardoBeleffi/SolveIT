<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';

    // check login
    if(isUserLoggedIn()) {
        goToHome();
    }

    // set template elements
    clearTemplate();
    setTitle("Sign Up - SolveIT");
    setHeader("login/login-header.php");
    setMain("register/register-main.php");
    setFooter("register/register-footer.php");
    setRemoteCSS(["https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"]);
    setCSS(["./css/register.css"]);
    setJS(["./js/register.js"]);

    // require template
    require "template/base.php";
?>
