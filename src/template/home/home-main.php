<div class="container mt-4">
  <?php foreach(getPosts() as $post): ?>
          <!-- Post -->
          <div id="post-<?php echo getPostId($post); ?>" class="post card mb-4">
            <!-- Post Title -->
            <div class="card-header">
              <?php echo getPostTitle($post); ?>
            </div>
            <!-- Post Content -->
            <div class="card-body">
              <!-- Post Text -->
              <p class="card-text">
                <?php echo getPostText($post); ?>
              </p>
              <!-- Post Tags -->
              <div class="tags">Tags: 
                <?php foreach(getPostTags($post) as $tag): ?>
                      <span class="badge bg-secondary">
                        <?php echo $tag ?>
                      </span>
                <?php endforeach; ?>
              </div>
              <!-- Post Likes -->
              <div class="likes">Likes:
                <span class="likes-count badge bg-primary">
                  <?php echo count(getPostLikes($post)); ?>
                </span></div>
              <!-- Like button -->
              <button type="button" onclick="addLike(event)" class="btn btn-outline-primary like-button">Like</button>
              <!-- Post Attachments -->
              <div class="attachments mt-3">
                <h5>Attachments : <?php echo count(getPostAttachments($post)); ?></h5>
                  <?php loadAttachments($post); ?>
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
    </div>
  <?php endforeach; ?>
  </div>