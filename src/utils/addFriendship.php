<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    

    if(isset($_POST["username"])) {
        $fsId = $dbh->toggleAmicizia(getIdUtente(), $dbh->getUserByUsername($_POST["username"])[0]["userId"], date("Y-m-d H:i:s"));
        if($fsId) {
            // Add notifications
            require "addNotification.php";
        }
		// check if in followers
		$userId = $dbh->getUserInfoByUsername($_SESSION['postUser'])[0]["userId"];
		$followers = $dbh->getFollowersByUser($userId);
		$inFollowers = 0;
        foreach($followers as $follower) {
            if(getUsername() == $follower["followerUsername"]) {
				$inFollowers = 1;
			}
        }
        // send response
        $array = ['followers' => count($followers), 'inFollowers' => $inFollowers];
        echo json_encode($array);
        http_response_code(200);
        exit();
    }
    // on failure
    setErrorMsg("Failed following user.");
    http_response_code(500);
    exit();
    
?>
