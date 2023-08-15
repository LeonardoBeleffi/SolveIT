<?php
    // require defaults PHPs
    require_once 'bootstrap.php';

    // check login routine
    checkUserLogin();

    // check files variables -  for $_FILES see "https://www.php.net/manual/en/features.file-upload.multiple.php"
    if(isset($_FILES['attachments']) && isset($_POST['title']) && isset($_POST['text']) && isset($_POST['collabs'])) {
        echo "error:".$_FILES['attachments']['error'][0]."<br>";
        foreach ($_FILES['attachments']['name'] as $name) {
            echo $name."<br>";
        }

        foreach ($_FILES['attachments']['size'] as $size) {
            echo $size."<br>";
        }

        foreach ($_FILES['attachments']['tmp_name'] as $tmp_name) {
            echo $tmp_name."<br>";
        }
        // opnening attachments
        $attachs = array();
        $attachsType = array();
        for($i = 0; $i < count($_FILES['attachments']['name']); $i++)
        {
            $myfile = fopen($_FILES['attachments']['tmp_name'][$i], "r") or die("Unable to open ".$_FILES['attachments']['name'][$i]."!");
            array_push($attachs, $myfile);
            echo $_FILES['attachments']['type'][$i];
            array_push($attachsType, $_FILES['attachments']['type'][$i]);
        }
        // uploading post
        $idPost = $dbh->uploadPost($_POST['title'], $_POST['text'], date("Y-m-d H:i:s"), 1, $attachs, $attachsType, array()/*$_POST['collabs']*/, getIdUtente());

        // closing attachments
        foreach ($attachs as $file) {
           fclose($file);
        }

        if($idPost === false) {
            setErrorMsg("Failed uploading Post.");
            echo "Fail uploading post";
        }
        echo "upload succesful";
    
    }
    // header("Location: /src/test.php");
    // exit();
?>