<?php
    // require defaults PHPs
    require_once 'bootstrap.php';

    function getSessionVar($var) {
        return isset($_SESSION[$var]) ? $_SESSION[$var] : "";
    }

    function setErrorMsg($errorMsg){
        $_SESSION["errorMsg"] = $errorMsg;
    }

    function getErrorMsg(){
        return getSessionVar("errorMsg");
    }

    function loadErrorMsg(){
        $msg = getErrorMsg();
        setErrorMsg("");
        if(empty($msg)) return;
        echo    "<div class=\"errorDiv\">" .
                    "<p class=\"errorP\">" .
                        "ERROR:" . $msg .
                    "</p>" .
                "</div>";
    }

    // ----------------- LOGIN functions
    function checkUserLogin(){
        if(!isUserLoggedIn()) {
            goToLogin();
        }
    }

    function isUserLoggedIn(){
        return 
        isset($_SESSION['idUtente']) &&  isset($_SESSION['username']) &&
        !empty($_SESSION['idUtente']) && !empty($_SESSION['username']) ;
    }

    function loginUser($idUtente, $username){
        $_SESSION["idUtente"] = $idUtente;
        $_SESSION["username"] = $username;
    }

    function logoutUser(){
        unset($_SESSION['idUtente']);
        unset($_SESSION['username']);
    }

    function getUsername() {
        return getSessionVar("username");
    }

    function getIdUtente() {
        return getSessionVar("idUtente");
    }

    // ----------------- TEMPLATE functions
    function clearTemplate(){
        unset($_SESSION["CSS"]);
        unset($_SESSION["JS"]);
        unset($_SESSION["title"]);
        unset($_SESSION["header"]);
        unset($_SESSION["main"]);
        unset($_SESSION["footer"]);
    }

    //CSS
    function setCSS($CSS){
        $_SESSION["CSS"] = $CSS;
    }

    function getCSS(){
        return getSessionVar("CSS");
    }

    function loadCSS(){
        if(!empty(getCSS())) : 
            foreach(getCSS() as $css):
                echo "<link rel=\"stylesheet\" type=\"text/css\" href=". $css ." />";
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

    // ----------------- REDIRECT functions
    function goToHome(){
        header("Location: /src/home.php");
        exit();
    }

    function goToLogin(){
        header("Location: /src/login.php");
        exit();
    }

    function goToRegister(){
        header("Location: /src/register.php");
        exit();
    }
?>

