<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';

    // check login
    //checkUserLogin();

    // set template elements
    clearTemplate();
    setTitle("About - SolveIT");
    setHeader("login/login-header.php");
    setMain("about/about-main.php");
    setFooter("about/about-footer.php");
    setCSS(["./css/about.css","css/login.css"]);
    setRemoteCSS(["https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"]);
    setJS(["./js/about.js"]);

    // require template
    require "template/base.php";
?>
