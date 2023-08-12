<?php
    // Start the session (if not already started)
    session_start();

    // require database helper for database queries
    require_once("database.php");
    $dbh = new DatabaseHelper("localhost", "root", "admin", "DumBass", 3306);
?>