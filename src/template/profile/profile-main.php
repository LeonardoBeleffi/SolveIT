<section>
    <h1>Profile</h1>
    <div id="profile-<?php echo getProfileUsername();?>" class="profile-container">
        <div class ="profile-header">
            <div class="profile-picture">
                <?php echo strtoupper(substr(getProfileUsername(),0,1));?>
            </div>

            <!-- <div class="profile-picture">
                <div class="profile-initial">
                    <?php echo strtoupper(substr(getProfileUsername(),0,1));?>
                </div>
                <div class="profile-logout">
                    <?php if(getProfileUsername() == getUsername()) {
                        echo '<button type="button" id="logout-button" class="button">
                            <span class="fa-solid fa-arrow-right-to-bracket" title="Logout button></span>
                            <span class="sr-only">Logout button</span>
                        </button>';
                    }?>
                </div>
            </div> -->

            <div class="profile-logout">
                <?php if(getProfileUsername() == getUsername()) {
                    echo '<button type="button" id="logout-button" class="button">
                        <span class="fa-solid fa-arrow-right-to-bracket" title="Logout button"></span>
                        <span class="sr-only">Logout button</span>
                    </button>';
                }?>
            </div>

            <div class="profile-id">
                <h2 class="profile-username" title="<?php echo getProfileUsername()?>">
                    <?php echo getProfileUsername()?>
                </h2>
                <h3 class="profile-fullname" title="<?php echo getProfileName()." ".getProfileSurname()?>">
                    <?php
                        echo getProfileName()." ".getProfileSurname()
                    ?>
                </h3>
            </div>

            <div class="profile-bio">
                <p>
                   <?php echo getProfileBio();?>
                </p>
            </div>
        </div>

        <div class="follow-container">
                <?php 	if(getProfileUsername() != getUsername()) {
							if(!in_array(getUsername(), getProfileFollowers())) {
								echo '<button class="button follow-button">Follow</button>';
							} else {
								echo '<button class="button follow-button">Unfollow</button>';
							}	
						}
                ?>
            </div>

        <div class="profile-details">

            <div class="post-number">
                <em>Posts </em> <?php echo count(getProfilePosts())?>
            </div>
            <div class="followers">
                <em>Followers </em> <span class="followers-count"><?php echo count(getProfileFollowers())?></span>
            </div>
            <div class="following">
                <em>Following </em> <span class="followings-count"><?php echo count(getProfileFollowings())?></span>
            </div>
            <!-- <div class="email">
                <em>Email:</em> <?php echo getProfileEmail();?>
            </div> -->
        </div>
        <?php require "./template/home/home-post-list.php" ?>
    </div>
</section>

