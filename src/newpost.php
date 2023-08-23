<?php 
    // require defaults PHPs
    require_once 'utils/bootstrap.php';

    // check login routine
    checkUserLogin();

    // set template elements
    clearTemplate();
    setTitle("Post - SolveIT");
    setHeader("newpost/newpost-header.php");
    setMain("newpost/newpost-main.php");
    setFooter("home/home-footer.php");
    setCSS(["./css/register.css", "./css/newpost.css", "./css/home.css"]);
    setJS(["./js/newpost.js","./js/shared.js"]);

    // require template
    require "template/base.php";
?>