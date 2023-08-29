<?php
    // require defaults PHPs
    require_once 'bootstrap.php';

    // check user login
    if(isUserLoggedIn()) {
        goToHome();
    }

    // check post variables
    if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["birth_date"]) && isset($_POST["phone_number"]) && isset($_POST["username"]) && isset($_POST["password"])) {
        // get sector id
        // $result = $dbh->getSectorByName($_POST["sector"]);
        // if(count($result)==0){
        //     setErrorMsg("Wrong Sector registration.");
        //     goToRegister();
        // }
        // $sectorId = $result[0]["sectorId"];
        // insert user
        $idUtente = $dbh->insertUtente($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["birth_date"], $_POST["phone_number"], $_POST["username"], 1);
        if($idUtente==false){
            setErrorMsg("Wrong User registration, username or email  may already exists.");
            goToRegister();
        }
        // insert credentials
        $idCred = $dbh->insertCredenziali($idUtente, $_POST["password"]);
        if($idCred==false){
            setErrorMsg("Wrong Credential registration.");
            goToRegister();
        }

        goToLogin();
    }

    goToRegister();
?>