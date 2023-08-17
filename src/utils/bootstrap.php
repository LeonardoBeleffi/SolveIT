<?php
    require_once "functions.php";

    // Start the session (if not already started)
    session_start();
    $_SESSION["DEBUG"] = false;

    // require database helper for database queries
    require_once "classes/database.php";

    // attachments download directory
    $ATTACHMENTS_DIRECTORY = realpath(__DIR__."/../private/attachments");

    // silence warning concerning network connections
    error_reporting(E_ERROR | E_PARSE);

    // create attachments download directory
    mkdir($ATTACHMENTS_DIRECTORY, 0777, true);

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
    error_reporting(-1);
?>