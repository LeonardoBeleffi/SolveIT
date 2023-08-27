<section>
    <div class="profile-container">
        <img src="your_profile_picture.jpg" alt="Profile Picture" class="profile-picture">
        <h1 class="profile-heading"><?php echo getProfileUsername()?></h1>
        <p class="profile-bio"><?php echo getProfileBio();?></p>
        <div class="profile-details">
        <?php if(getProfileUsername() != getUsername()) {
            echo '<button onclick="follow(event)" class="button follow-button">Follow</button>';
        }
        ?>
            <p><emph>Solutions(posts):</emph> <?php echo count(getProfilePosts())?></p>
            <p><emph>Followers:</emph> <?php echo count(getProfileFollowers())?></p>
            <p><emph>Following:</emph> <?php echo count(getProfileFollowings())?></p>
            <p><emph>Name:</emph> <?php echo getProfileName()?></p>
            <p><emph>Surname:</emph> <?php echo getProfileSurname();?></p>
            <p><emph>Email:</emph> <?php echo getProfileEmail();?></p>

        </div>
        <?php require "./template/home/home-main.php" ?>
    </div>
</section>