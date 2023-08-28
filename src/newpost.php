<?php 
    // require defaults PHPs
    require_once 'utils/bootstrap.php';

    // check login routine
    checkUserLogin();

    // set template elements
    clearTemplate();
    setTitle("New Post - SolveIT");
    setHeader("home/home-header.php");
    setMain("newpost/newpost-main.php");
    setFooter("home/home-footer.php");
    setCSS(["./css/newpost.css", "./css/home.css"]);
    setRemoteCSS(["https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"]);
    setJS(["./js/newpost.js","./js/shared.js","./js/home.js"]);

    // require template
    require "template/base.php";
?>