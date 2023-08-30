<?php
    // require defaults PHPs
    require_once 'bootstrap.php';

    if ($dbh->updateUserTheme(getIdUtente()) !== -1) {
        updateUserTheme();
    }
    goToSettings();
?>

