<section>
    <ul id="post_list">
        <?php foreach(getPosts() as $post): ?>
        <li class="list-element">
            <article class="post-container post" id="post-<?php echo getPostId($post); ?>">
                <!-- Post Title -->
                <div class="post-preview">
                    <div class = "inline-container">
                        <div class = "profile-pic">
                            <p>T</p>
                        </div>
                        <div class = "cardelement-container">
                            <div class="card-title">
                                <h1>
                                    <?php echo getPostTitle($post); ?>
                                </h1>
                            </div>
                            <div class = "tags-container">
                                <!-- Post Tags -->
                                <div class="tags">
                                    <?php foreach(getPostTags($post) as $tag): ?>
                                    <parent class="tag-badge">
                                    <?php echo $tag ?>
                                    </span>
                                    <?php endforeach; ?>
                                </div>
                                <!-- Like button -->
                                <div class="likeButton">
                                    <button type="button" onclick="addLike(event)" class="button">Like</button>
                                </div>
                                <!-- Post Likes -->
                                <div class="likes">
                                    <span class="likes-count likes-badge">
                                    liked by <?php echo count(getPostLikes($post)); ?> people
                                    </span>
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
                        <h5>Comments : <?php echo count(getPostComments($post)); ?></h5>
                        <?php loadComments($post); ?>
                        <!-- Add comment form -->
                        <form onsubmit="addComment(event)" class="root-comment">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Write a comment">
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