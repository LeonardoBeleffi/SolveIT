<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';
    
    // check login routine
    checkUserLogin();

    // set post query parameter
    clearPosts();
    if(isset($_SERVER["QUERY_STRING"])) {
        // post view
        if(str_starts_with($_SERVER["QUERY_STRING"],"id")) {
            $idPosts = [];
            array_push($idPosts, explode("=",$_SERVER["QUERY_STRING"],2)[1]);
            setPostsId($idPosts);
        }
        // post view
        if(str_starts_with($_SERVER["QUERY_STRING"],"tag")) {
            $postTag = explode("=",$_SERVER["QUERY_STRING"],2)[1];
            setPostTag($postTag);
        }
        // post view
        if(str_starts_with($_SERVER["QUERY_STRING"],"user")) {
            $postTag = explode("=",$_SERVER["QUERY_STRING"],2)[1];
            setPostUser($postTag);
        }
    }

    // require post query helper
    include "utils/download.php";

    // set template elements
    clearTemplate();
    setTitle("Search - SolveIT");
    setMain("search/search-main.php");
    setHeader("home/home-header.php");
    setFooter("home/home-footer.php");
    setCSS(["./css/search.css"]);
    setRemoteCSS(["https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"]);
    setJS(["./js/shared.js","./js/posts.js","./js/search.js"]);

    // require template
    require "template/base.php";
?>