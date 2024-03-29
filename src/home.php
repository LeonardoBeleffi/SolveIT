<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';
	
    // check login routine
    checkUserLogin();
    // echo "Username: " . getUsername() . "<br>".
    // "idUtente: " . getIdUtente(). "<br>".
    // "sectorId: " . getUserSectorId();

    // set post query parameter
    clearDownloads();
    setPostsLimit(100);

    // require post query helper
    include "utils/download.php";

    // set template elements
    clearTemplate();
    setTitle("Home - SolveIT");
    setMain("home/home-main.php");
    setHeader("home/home-header.php");
    setFooter("home/home-footer.php");
    setCSS(["./css/home.css"]);
    setRemoteCSS(["https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"]);
    setJS(["./js/shared.js", "./js/home.js","./js/posts.js"]);
    // require template
    require "template/base.php";
?>

