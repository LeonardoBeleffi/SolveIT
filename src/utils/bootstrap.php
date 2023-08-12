<?php
    require_once "functions.php";

    // Start the session (if not already started)
    session_start();

    // require database helper for database queries
    require_once("database.php");
    try{
        $dbh = new DatabaseHelper("sql202.infinityfree.com", "epiz_34305586", "PsLXCJjQlcI", "epiz_34305586_solveit", 3306);
    } catch(Exception $e) {
        setErrorMsg("Cannot connect to Database!");
    }
?>