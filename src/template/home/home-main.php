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
                            <!-- Post Likes -->
                            <div class="likes">
                                <span class="likes-count likes-badge">
                                <?php echo count(getPostLikes($post)); ?>
                                </span>
                            </div>
                            <!-- Like button -->
                            <div class="likeButton">
                                <button type="button" onclick="addLike(event)" class="like-button">Like</button>
                            </div>
                            <!-- Post Comments -->
                        </div>
                    </div>
                </div>
                <!-- Post Text -->
                <div class="card-text">
                    <p>
                        <?php echo getPostText($post); ?>
                    </p>
                </div>
                <!-- Post Content -->
                <div class="post-opened">
                    <div class="attachments">
                        <h5>Attachments : <?php echo count(getPostAttachments($post)); ?></h5>
                        <?php loadAttachments($post); ?>
                        <div id="fileContainer"></div>
                    </div>
                    <!-- Post Comments -->
                    <div class="comments mt-3">
                        <h5>Comments : <?php echo count(getPostComments($post)); ?></h5>
                        <?php loadComments($post); ?>
                        <!-- Add comment form -->
                        <form onsubmit="addComment(event)" class="mt-3 root-comment">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Write a comment">
                            </div>
                            <button type="submit" class="btn btn-primary">Post Comment</button>
                        </form>
                    </div>
                </div>
            </article>
        </li>
        <?php endforeach; ?>
    </ul>
</section>