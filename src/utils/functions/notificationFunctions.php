<?php

    function clearNotifications(){
        unset($_SESSION['notifications']);
        unset($_SESSION['newNotifications']);
    }

    function getNotifications() {
        return getSessionArray("notifications");
    }

    function getNewNotifications() {
        return getSessionArray("newNotifications");
    }

    function addNotification($not) {
        if(!isset($_SESSION["notifications"])) {
            $_SESSION["notifications"] = [];
        }
        array_push($_SESSION['notifications'],$not);
    }

    function addNewNotification($not) {
        if(!isset($_SESSION["newNotifications"])) {
            $_SESSION["newNotifications"] = [];
        }
        array_push($_SESSION['newNotifications'],$not);
    }

    function getNewNotificationsFrom($notifications) {
        $newNotifications = [];
        foreach($notifications as $not) {
            if(!$not->read) {
                array_push($newNotifications, $not);
            }
        }
        return $newNotifications;
    }

    // TYPE of Notification
    function getCommentToPostNotificationType() {
        return 0;
    }
    function getCommentToCommentNotificationType() {
        return 1;
    }
    function getCommentToContributedPostNotificationType() {
        return 2;
    }
    function getLikeNotificationType() {
        return 3;
    }
    function getFollowNotificationType() {
        return 4;
    }

    // NOTIFICATION props

    function getNotificationId($not) {
        return $not->notificationId;
    }
    function getNotificator($not) {
        return $not->notificator;
    }
    function getNotificationReadStatus($not) {
        return $not->read;
    }
    function getNotificationPostId($not) {
        return $not->postId;
    }
    function getNotificationType($not) {
        return $not->type;
    }
    function getNotificationTimestamp($not) {
        return timeDifferenceToText($not->timestamp, date("Y-m-d H:i:s"));
    }

    // NOTIFICATION generation
    
    function getNotificationText($not) {
        $notificationText = "";
        switch(getNotificationType($not)) {
            case getCommentToPostNotificationType(): {
                $notificationText = 'commented on your post';
                break;
            }
            case getCommentToCommentNotificationType(): {
                $notificationText = 'replied to your comment';
                break;
            }
            case getCommentToContributedPostNotificationType(): {
                $notificationText = 'commented on a post you contributed in';
                break;
            }
            case getLikeNotificationType(): {
                $notificationText = 'liked your post';
                break;
            }
            case getFollowNotificationType(): {
                $notificationText = 'started following you';
                break;
            }
        }
        return '<strong>'.getNotificator($not).'</strong> '.$notificationText.'.';
    }

    function isCommentNotification($not) {
        return ( getNotificationType($not) == getCommentToPostNotificationType() ||
                getNotificationType($not) == getCommentToCommentNotificationType() ||
                getNotificationType($not) == getCommentToContributedPostNotificationType());
    }

    function isLikeNotification($not) {
        return ( getNotificationType($not) == getLikeNotificationType() );
    }


    function isFollowNotification($not) {
        return ( getNotificationType($not) == getFollowNotificationType());
    }


?>

