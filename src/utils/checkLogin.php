<?php
    require_once 'bootstrap.php';

    if(isUserLoggedIn()) {
        goToHome();
    }

    // check credentials
    setErrorMsg($_SESSION["errorMsg"]);
    if(isset($_POST["username"]) && isset($_POST["password"])) {
        // query db
        $result = $dbh->checkLogin($_POST["username"], $_POST["password"]);

        if(count($result)!=0){
            loginUser($result[0]["idUtente"], $result[0]["username"]);
            goToHome();
        }
    }
    setErrorMsg("Wrong username or password");
    goToLogin();

?>
