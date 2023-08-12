<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';
    
    // check login routine
    checkUserLogin();
    echo "Username: " . getUsername() . "<br>";
    echo "idUtente: " . getIdUtente();

    // set template elements
    clearTemplate();
    setTitle("Home - SolveIT");
    setMain("home/home-main.php");
    setHeader("home/home-header.php");
    setFooter("login/login-footer.php");
    setCSS(["./css/login.css", "./css/bootstrap-5.3.1-dist/css/bootstrap.min.css"]);
    setJS(["./css/bootstrap-5.3.1-dist//js/bootstrap.min.js"]);

    // require template
    require "template/base.php";
?>