<section>
    <ul id="post_list">
        <div class="container mt-4">
            <?php foreach(getPosts() as $post): ?>
            <li>
                <article>
                    <section class="post_preview">
                        <!-- Post -->
                        <div class="card mb-4">
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
                                    <span class="badge bg-primary">
                                    <?php echo count(getPostLikes($post)); ?>
                                    </span>
                                </div>
                                <!-- Like button -->
                                <button type="button" class="btn btn-outline-primary like-button">Like</button>
                                <!-- Post Comments -->
                                <div class="comments mt-3">
                                    <h5>Comments</h5>
                                    <ul class="list-unstyled">
                                        <?php foreach(getPostComments($post) as $comment): ?>
                                        <li><?php echo getCommentText($comment) ?> - author:<?php echo getCommentAuthor($comment) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="attachments mt-3">
                                    <h5>Attachments : <?php echo count(getPostAttachments($post)); ?></h5>
                                    <?php loadAttachments($post); ?>
                                    <div id="fileContainer"></div>
                                </div>
                                <!-- Add comment form -->
                                <form class="mt-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Write a comment">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post Comment</button>
                                </form>
                            </div>
                    </section>
                </article>
            </li>
            </div>
            <?php endforeach; ?>
    </ul>
    </div>
</section>
  <script>
    function loadFile(file, fileType) {
      const fileContainer = document.getElementById("fileContainer");
      fileContainer.innerHTML = ""; // Clear previous content
      
      if (fileType.includes("image")) {
        const img = new Image();
        img.src = file;
        img.style.maxWidth = "100%";
        fileContainer.appendChild(img);
      } else if (fileType.includes("audio")) {
        const audio = document.createElement("audio");
        audio.controls = true;
        audio.src = file;
        fileContainer.appendChild(audio);
      } else if (fileType.includes("video")) {
        const video = document.createElement("video");
        video.controls = true;
        video.style.maxWidth = "100%";
        video.src = file;
        fileContainer.appendChild(video);
      } else if(file.name.endsWith(".pdf")) {
        const loadingTask = pdfjsLib.getDocument(file);
        const pdfDocument = await loadingTask.promise;

        for (let pageNum = 1; pageNum <= pdfDocument.numPages; pageNum++) {
            const page = await pdfDocument.getPage(pageNum);
            const canvas = document.createElement("canvas");
            const scale = 1.5;
            const viewport = page.getViewport({ scale });

            canvas.width = viewport.width;
            canvas.height = viewport.height;

            const canvasContext = canvas.getContext("2d");
            const renderContext = {
            canvasContext,
            viewport,
            };

            await page.render(renderContext);
            fileContainer.appendChild(canvas);
        }
      }
    }
  </script>