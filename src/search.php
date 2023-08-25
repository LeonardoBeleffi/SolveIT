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
            $CSSs = ["./css/home.css"];
            $JSs = ["./js/shared.js","./js/home.js","./js/posts.js"];
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
    setRemoteCSS(["https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"]);
    setJS($JSs);

    // require template
    require "template/base.php";
?>