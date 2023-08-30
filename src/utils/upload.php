<?php
    // require defaults PHPs
    require_once 'bootstrap.php';

    // check login routine
    checkUserLogin();

    setErrorMsg("");
    var_dump($_POST);
    // check files variables -  for $_FILES see "https://www.php.net/manual/en/features.file-upload.multiple.php"
    if(isset($_FILES['attachments']) && isset($_POST['title']) && isset($_POST['text']) && isset($_POST['collabs'])  && isset($_POST['tags']) && $_POST['title']!="" && $_POST['text']!="") {
        if($_POST['title']=="" ) {
            setErrorMsg("Failed uploading Post. Empty title.");
            goToPostCreation();
        }
        if($_POST['text']=="") {
            setErrorMsg("Failed uploading Post. Empty text.");
            goToPostCreation();
        }

        $error = $_FILES['attachments']['error'][0];
        // handle no file uploaded error
        $noFileUploaded = $error==4;
        // opnening attachments
        $attachs = array();
        $attachsType = array();
        $attachsName = array();
        for($i = 0; $i < count($_FILES['attachments']['name']) && !$noFileUploaded; $i++)
        {
            array_push($attachs, $_FILES['attachments']['tmp_name'][$i]);
            array_push($attachsType, $_FILES['attachments']['type'][$i]);
            array_push($attachsName, $_FILES['attachments']['name'][$i]);
        }
        // uploading post
        $idPost = $dbh->uploadPost($_POST['title'], $_POST['text'], date("Y-m-d H:i:s"), 1, $attachs, $attachsName, $attachsType, explode(";", $_POST['collabs']), explode(";", $_POST['tags']), getIdUtente());

        if($idPost === false) {
            setErrorMsg("Failed uploading Post.");
            echo "Fail uploading post";
        }
        echo "upload succesful";

    }
    goToHome();
?>