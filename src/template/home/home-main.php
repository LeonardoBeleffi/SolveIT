<section>
    <ul id="post_list">
        <?php foreach(getPosts() as $post): ?>
        <li class="list-element">
            <article class="post-container post" id="post-<?php echo getPostId($post); ?>">
                <!-- Post Title -->
                <div class="post-preview">
                
                    <div class="inline-container">
                    <!-- <div class="profile-pic"> -->
                            <span class="profile-pic"><?php 
                            if(getPostAuthor($post))
                                echo strtoupper(substr(getPostAuthor($post),0,1));
                            echo ""
                            ?> </span>
                        <!-- </div>         -->
                        <div class="cardelement-container">
                            <div class="card-title">
                                <h1>
                                    <?php echo getPostTitle($post); ?>
                                </h1>
                            </div>
                            <div class="tags-container">
                                <!-- Post Tags -->
                                <div class="tags">
                                    <?php foreach(getPostTags($post) as $tag): ?>
                                    <parent class="tag-badge">
                                    <?php echo $tag ?>
                                    </span>
                                    <?php endforeach; ?>
                                </div>
                                <!-- Post Comments -->
                            </div>
                        </div>
                        <!-- Post Text -->
                    </div>

                    <div class="card-text">
                        <p>
                            <?php echo getPostText($post); ?>
                        </p>
                    </div>
                    <div class="likes-container">
                        <!-- Like button -->
                        <div class="username">
                            <span>@<?php echo getPostAuthor($post); ?> </span>
                        </div>
                        <div class="like-section">
                        <!-- Like button -->
                        <div class="like-button">
                            <button type="button" onclick="addLike(event)" class="button">Like</button>
                        </div>
                        <!-- Post Likes -->
                        <div class="likes">
                            <span class="likes-count likes-badge">
                            liked by <?php echo count(getPostLikes($post)); ?>
                            </span>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Post Content -->
                <div class="post-opened">
                    <div class="attachments">
                        <h5>Attachments : <?php echo count(getPostAttachments($post)); ?></h5>
                        <?php loadAttachments($post); ?>
                        <div id="fileContainer"></div>
                    </div>
                    <!-- Post Comments -->
                    <div class="comments">
                        <h5 class ="comments-count">Comments : <?php echo count(getPostComments($post)); ?></h5>
                        <?php loadComments($post); ?>
                        <!-- Add comment form -->
                        <form onsubmit="addComment(event)" class="root-comment">
                            <div class="form-group">
                                <input type="text" class="form-input" placeholder="Write a comment">
                                <button type="submit" class="btn button">Post Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </article>
        </li>
        <?php endforeach; ?>
    </ul>
</section>
