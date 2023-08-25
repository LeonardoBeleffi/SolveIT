<?php
    // require defaults PHPs
    require_once 'bootstrap.php';

    // refresh posts
    $newNotifications = getNewNotificationsFrom(require "downloadNotifications.php");
    $array = ['notifications' => count($newNotifications)];
    echo json_encode($array);
    http_response_code(200);
    exit();
?>