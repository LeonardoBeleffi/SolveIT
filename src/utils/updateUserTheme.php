<?php
    // require defaults PHPs
    require_once 'bootstrap.php';

    if(isset($_POST["settingId"])) {
        $commentId = $dbh->toggleUserTheme($_POST["settingId"], $_POST["themeValue"]);
        http_response_code(200);
        exit();
    }
    setErrorMsg("Failed updating theme.");
    http_response_code(500);
    exit();

?>
