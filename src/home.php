<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';
    
    // check login routine
    checkUserLogin();
    echo "Username: " . getUsername() . "<br>".
        "idUtente: " . getIdUtente();

    // set post query parameter
    clearPosts();
    setPostsLimit(10);

    // require post query helper
    require "utils/download.php";

    // set template elements
    clearTemplate();
    setTitle("Home - SolveIT");
    setMain("home/home-main.php");
    setHeader("home/home-header.php");
    setFooter("login/login-footer.php");
    setCSS(["./css/home.css", "./css/bootstrap-5.3.1-dist/css/bootstrap.min.css"]);
    setJS(["./js/home.js", "./css/bootstrap-5.3.1-dist//js/bootstrap.min.js"]);

    // require template
    require "template/base.php";
?>
