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

    // require template
    require "template/base.php";
?>