<section>
    <ul class="notifications-list">
        <?php foreach(getNotifications() as $not): ?>
            <?php   
                    $iconName = "";
                    if(isLikeNotification($not)) {
                        $iconName = "fa-thumbs-up";
                    } else if(isCommentNotification($not)) {
                        $iconName = "fa-comment";
                    } else if(isFollowNotification($not)) {
                        $iconName = "fa-user";
                    }
            ?>
        <li class="notification">
            <span class="timestamp"><?php echo getNotificationTimestamp($not); ?></span>
            <div class="notification-header">
                <span class="fas <?php echo $iconName ?> notification-icon" aria-hidden="true" title="notification type icon"></span>
                <span class="sr-only">notification type icon</span>
                <span class="notification-content">
                    <p><?php echo getNotificationText($not); ?></p>
                    <a href="./search.php?id=<?php echo getNotificationPostId($not)?>" class="post-link">View Post</a>
                </span>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
    </section>