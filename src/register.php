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
    setHeader("register/register-header.php");
    setMain("register/register-main.php");
    setFooter("register/register-footer.php");
    setCSS(["./css/register.css"]);

    // require template
    require "template/base.php";
?>