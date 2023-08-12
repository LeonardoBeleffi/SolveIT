<?php
    // Start the session (if not already started)
    session_start();

    // require database helper for database queries
    require_once("database.php");
    $dbh = new DatabaseHelper("localhost", "root", "Mysqlsangio03!", "DumBass", 3306);
?>