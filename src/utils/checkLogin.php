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
            echo var_dump($result);
            loginUser($result[0]["userId"], $result[0]["username"], $result[0]["theme"]);
            goToHome();
        }
    }
    setErrorMsg("Wrong username or password");
    goToLogin();

?>
