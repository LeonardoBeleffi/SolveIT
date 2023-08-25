<section>
    <ul id="post-list">
        <?php foreach(getPosts() as $post): ?>
        <li class="list-element">
            <article class="post-container post" id="post-<?php echo getPostId($post); ?>">
                <!-- Post Title -->
                <div class="post-preview">

                    <div class="post-header">
                        <!-- <div class="profile-pic"> -->
                        <span class="profile-pic"><?php 
                            if(getPostAuthor($post))
                            echo strtoupper(substr(getPostAuthor($post),0,1));
                            echo ""
                            ?>
                         </span>
                        <!-- </div>         -->
                        <div class="cardelement-container">
                            <div class="card-title">
                                <h1>
                                    <?php echo getPostTitle($post); ?>
                                </h1>
                            </div>
                            <div class="tags-container">
                                <!-- Post Tags -->
                                <?php foreach(getPostTags($post) as $tag): ?>
                                <span class="tag-badge">
                                    <?php echo $tag ?>
                                </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-text">
                        <p>
                            <?php echo getPostText($post); ?>
                        </p>
                    </div>
                    <div class="likes-container">
                        <!-- Like button -->
                        <span class="username">@<?php echo getPostAuthor($post); ?> </span>
                        <div class="like-section">
                            <!-- Like button -->
                            <button type="button" onclick="addLike(event)" class="button like-button">
                                <i class="fa-regular fa-thumbs-up"></i>
                            </button>
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
                <div class="post-body">
                    <div class="separator"></div>
                    <div class="attachments">
                        <h1><?php echo count(getPostAttachments($post)); ?> attachments </h1>
                        <?php loadAttachments($post); ?>
                        <div id="fileContainer"></div>
                    </div>
                    <!-- Post Comments -->
                    <div class="comments">
                        <h1 class="comments-count"><?php echo count(getPostComments($post)); ?> comments</h1>
                        <?php loadComments($post); ?>
                        <!-- Add comment form -->
                        <form onsubmit="addComment(event)" class="root-comment">
                            <div class="form-group">
                                <input type="text" class="form-input" placeholder="Write a comment">
                                <button type="submit" class="button comment-button">
                                    <i class="fa-solid fa-reply"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </article>
        </li>
        <?php endforeach; ?>
    </ul>
</section>

