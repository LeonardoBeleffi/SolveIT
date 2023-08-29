<?php
    global $currentUsername;
    // ----------------- TEMPLATE functions
    function clearTemplate(){
        unset($_SESSION["CSS"]);
        unset($_SESSION["PaletteCSS"]);
        unset($_SESSION["RemoteCSS"]);
        unset($_SESSION["JS"]);
        unset($_SESSION["title"]);
        unset($_SESSION["header"]);
        unset($_SESSION["main"]);
        unset($_SESSION["footer"]);
    }

    // CSS
    function setCSS($CSS){
        $_SESSION["CSS"] = $CSS;
    }

    function getCSS(){
        return getSessionVar("CSS");
    }

    function loadPaletteCSS(){
        if (isset($_SESSION["PaletteCSS"])) {
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $_SESSION["PaletteCSS"] . " \"/>";
        } else {
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"palette.css\"/>";
        }

    }

    function loadCSS(){
        if(!empty(getCSS())) : 
            foreach(getCSS() as $css):
                echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $css . " \"/>";
            endforeach;
        endif;
    }


    //RemoteCSS
    function setRemoteCSS($RemoteCSS){
        $_SESSION["RemoteCSS"] = $RemoteCSS;
    }

    function getRemoteCSS(){
        return getSessionVar("RemoteCSS");
    }

    function loadRemoteCSS(){
        if(!empty(getRemoteCSS())) : 
            foreach(getRemoteCSS() as $css):
                echo "<link rel=\"stylesheet\" href=\"" . $css . "\"/>";
            endforeach;
        endif;
    }

    //JS
    function setJS($JS){
        $_SESSION["JS"] = $JS;
    }

    function getJS(){
        return getSessionVar("JS");
    }

    function loadJS(){
        if(!empty(getJS())) : 
            foreach(getJS() as $js):
                echo "<script src=\"". $js ."\" ></script>";
            endforeach;
        endif;
    }

    function setUsername($username){
       $currentUsername = $username;
    }

    //Title
    function setTitle($title){
        $_SESSION["title"] = $title;
    }

    function getTitle(){
        return getSessionVar("title");
    }

    //Header
    function setHeader($header){
        $_SESSION["header"] = $header;
    }

    function getHeader(){
        return getSessionVar("header");
    }

    //Main
    function setMain($main){
        $_SESSION["main"] = $main;
    }

    function getMain(){
        return getSessionVar("main");
    }

    //Footer
    function setFooter($footer){
        $_SESSION["footer"] = $footer;
    }

    function getFooter(){
        return getSessionVar("footer");
    }

?>

