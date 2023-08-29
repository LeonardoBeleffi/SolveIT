<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';

    // check login routine
    checkUserLogin();

    // set post query parameter
    clearDownloads();
    if(isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "") {
        $query = $_SERVER["QUERY_STRING"];
        $str = "id";
        // post view
        if (strncmp($query, $str, strlen($str)) === 0) {
            $idPosts = [];
            array_push($idPosts, explode("=",$query,2)[1]);
            setPostsId($idPosts);
        }
        // post view
        $str = "tag";
        if (strncmp($query, $str, strlen($str)) === 0) {
            $postTag = explode("=",$query,2)[1];
            setPostTag($postTag);
        }
        // post view
        $str = "user";
        if (strncmp($query, $str, strlen($str)) === 0) {
            $postTag = explode("=",$query,2)[1];
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
    setCSS(["./css/home.css","./css/search.css"]);
    setRemoteCSS(["https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"]);
    setJS(["./js/shared.js","./js/posts.js","./js/search.js","./js/home.js"]);

    // require template
    require "template/base.php";
?>

