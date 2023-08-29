<?php
    // require defaults PHPs
    require_once 'bootstrap.php';

    // check login routine
    checkUserLogin();

    setErrorMsg("");
    var_dump($_POST);
    // check files variables -  for $_FILES see "https://www.php.net/manual/en/features.file-upload.multiple.php"
    if(isset($_FILES['attachments']) && isset($_POST['title']) && isset($_POST['text']) && isset($_POST['collabs'])  && isset($_POST['tags'])) {
        $error = $_FILES['attachments']['error'][0];
        echo "error:".$error."<br>";
        // handle no file uploaded error
        $noFileUploaded = $error==4;

        foreach ($_FILES['attachments']['name'] as $name) {
            echo $name."<br>";
        }

        foreach ($_FILES['attachments']['size'] as $size) {
            echo $size."<br>";
        }

        foreach ($_FILES['attachments']['tmp_name'] as $tmp_name) {
            echo $tmp_name."<br>";
        }
        echo "tags:".var_dump(explode(";", $_POST['tags']))."<br>";
        echo "collabs:".var_dump(explode(";", $_POST['collabs']))."<br>";
        // opnening attachments
        $attachs = array();
        $attachsType = array();
        $attachsName = array();
        for($i = 0; $i < count($_FILES['attachments']['name']) && !$noFileUploaded; $i++)
        {
            array_push($attachs, $_FILES['attachments']['tmp_name'][$i]);
            echo $_FILES['attachments']['type'][$i];

            array_push($attachsType, $_FILES['attachments']['type'][$i]);
            array_push($attachsName, $_FILES['attachments']['name'][$i]);
        }
        // uploading post
        $idPost = $dbh->uploadPost($_POST['title'], $_POST['text'], date("Y-m-d H:i:s"), getUserSectorId(), $attachs, $attachsName, $attachsType, explode(";", $_POST['collabs']), explode(";", $_POST['tags']), getIdUtente());

        if($idPost === false) {
            setErrorMsg("Failed uploading Post.");
            echo "Fail uploading post";
        }
        echo "upload succesful";

    }
    goToHome();
?>