<section>
    <div class="main_content">
        <form id="newpost_form" action="/src/utils/upload.php" method="post" enctype="multipart/form-data">
            <h1>Create Post</h1>
            <?php loadErrorMsg(); ?>
            <div>
                <div>
                    <label>Title<input type="text" name="title" maxlength="128" required title="post title"/></label>
                    <label>Text<textarea name="text" form="newpost_form" contentEditable maxlength="256" required title="post text"></textarea></label>
                    <label>Tags<input class="tag_input" type="text" name="tags_cover" title="post tags"/></label>
                    <input class="real_input" type="search" name="tags" hidden title="search tags"/>
                    <div class="suggestions-tags"></div>
                    <ul class="selected-tags selected-list"></ul>
                    <label>Collaborators<input class="collab_input" type="text" name="collabs_cover" title="post collaborators"/></label>
                    <input class="real_input" type="search" name="collabs" hidden  title="search collaborators"/>
                    <div class="suggestions-collabs"></div>
                    <ul class="selected-collabs selected-list"></ul>
                    <div class="upload-area">
                        <p>Drag and drop files here</p>
                        <br>or<br>
                        <input id="attachmentsInput" type="file" name="attachments[]" multiple hidden title="attachments input">
                        <input id="fileInput" type="file" multiple title="attachments button">
                    </div>
                    <div class="file-list" ></div>
                </div>
                <input type="submit" value="Upload"/>
            </div>
        </form>
    </div>
</section>
