<section>
    <h1>Profile</h1>
    <div class="profile-container">
        <div class ="profile-header">
            <img src="your_profile_picture.jpg" alt="Profile Picture" class="profile-picture">
            <h2 class="profile-username"><?php echo getProfileUsername()?></h2>
            <span class="profile-bio"><?php echo getProfileBio();?></span>
        </div>
        <div class="profile-details">
            <?php if(getProfileUsername() != getUsername()) {
                echo '<button onclick="follow(event)" class="button follow-button">Follow</button>';
            }
            ?>
            <em>Solutions(posts):</em> <?php echo count(getProfilePosts())?>
            <em>Followers:</em> <?php echo count(getProfileFollowers())?>
            <em>Following:</em> <?php echo count(getProfileFollowings())?>
            <em>Email:</em> <?php echo getProfileEmail();?>
        </div>
        <?php require "./template/home/home-post-list.php" ?>
    </div>
</section>