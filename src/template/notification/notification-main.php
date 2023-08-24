<section>
    <ul class="container">
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
            <div class="notification-header">
                <i class="fas <?php echo $iconName ?> notification-icon"></i>
                <span class="notification-content">
                    <p><?php echo getNotificationText($not); ?></p>
                    <a href="#" class="post-link">View Post</a>
                </span>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</section>