<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    require_once 'classes/notification.php';


    // download new notifications
    // query notifications
    $result = $dbh->getAllNotifications(getIdUtente());
    $notifications = [];
    foreach($result as $res) {
        $not = new Notification();
        $not->notificationId = $res["notificationId"];
        $not->notificator = $dbh->getUserById($res["notificatorId"])[0]["username"];
        $not->read = $res["isRead"];
        $not->type = $res["type"];
        $not->postId = $res["postId"];
        $not->timestamp = $res["timestamp"];
        array_push($notifications, $not);
    }
    return $notifications;
?>