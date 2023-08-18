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
    setFooter("newpost/newpost-footer.php");
    setCSS(["./css/register.css", "./css/newpost.css"]);
    setJS(["./js/newpost.js"]);

    // require template
    require "template/base.php";
?>