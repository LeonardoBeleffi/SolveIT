<?php
    require_once "functions.php";

    // Start the session (if not already started)
    session_start();

    // require database helper for database queries
    require_once "classes/database.php";

    // session variables
    $_SESSION["ATTACHMENTS_DIRECTORY"] = "./private/attachments";
    $_SESSION["DEBUG"] = false;

    // silence warning concerning network connections
    error_reporting(E_ERROR | E_PARSE);

    // try connecting to remote/local database
    try{
        $dbh = new DatabaseHelper("sql202.infinityfree.com", "epiz_34305586", "PsLXCJjQlcI", "epiz_34305586_solveit", 3306);
    } catch(Exception $e) {
        setErrorMsg("Cannot connect to remote Database!");
        try{
            $dbh = new DatabaseHelper("localhost", "root", "Mysqlsangio03!", "epiz_34305586_solveit", 3306);
            setErrorMsg("");
        } catch(Exception $e) {
            setErrorMsg("Cannot connect to local Database!");
        }
    }
    // restore warnings 
    error_reporting(-1);
?>