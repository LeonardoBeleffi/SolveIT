<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';
    
    // check login routine
    checkUserLogin();

    $mainPhp = "search/search-main.php";
    $CSSs = ["./css/search.css"];
    $JSs = ["./js/search.js","./js/shared.js"];

    // set post query parameter
    clearPosts();
    if(isset($_SERVER["QUERY_STRING"])) {
        // post view
        if(str_starts_with($_SERVER["QUERY_STRING"],"id")) {
            $idPosts = [];
            array_push($idPosts, explode("=",$_SERVER["QUERY_STRING"])[1]);
            setPostsId($idPosts);
            // set graphics component
            $mainPhp = "home/home-main.php";
            array_push($CSSs, "./css/home.css");
            array_push($JSs, "./js/home.js");
            array_push($JSs, "./js/posts.js");
        }
    }

    // require post query helper
    include "utils/download.php";

    // set template elements
    clearTemplate();
    setTitle("Search - SolveIT");
    setMain($mainPhp);
    setHeader("search/search-header.php");
    setFooter("home/home-footer.php");
    setCSS($CSSs);
    setJS($JSs);

    // require template
    require "template/base.php";
?>