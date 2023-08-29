<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';

    // check login routine
    checkUserLogin();

    // set post query parameter
    clearDownloads();
    $username = getUsername();
    if(isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "") {
        // post view
        if (strncmp($_SERVER["QUERY_STRING"],"user",4) === 0) {
            $username = explode("=",$_SERVER["QUERY_STRING"],2)[1];
        }
    }
    setPostUser($username);
    enableProfileInfo();

    // require post query helper
    include "utils/download.php";

    // set template elements
    clearTemplate();
    setTitle("Profile - SolveIT");
    setMain("profile/profile-main.php");
    setHeader("home/home-header.php");
    setFooter("home/home-footer.php");
    setCSS(["./css/profile.css", "./css/home.css"]);
    setRemoteCSS(["https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"]);
    setJS(["./js/shared.js","./js/home.js","./js/posts.js","./js/profile.js"]);

    // require template
    require "template/base.php";
?>
