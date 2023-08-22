<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';
    
    // check login routine
    checkUserLogin();

    // set template elements
    clearTemplate();
    setTitle("Search - SolveIT");
    setMain("search/search-main.php");
    setHeader("search/search-header.php");
    setFooter("home/home-footer.php");
    setCSS(["./css/search.css"]);
    setJS(["./js/search.js"]);

    // require template
    require "template/base.php";
?>