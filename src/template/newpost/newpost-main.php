<section>
    <div>
        <form id="newpost_form" action="/src/utils/upload.php" method="post" enctype="multipart/form-data">
            <h1>Create Post</h1>
            <?php loadErrorMsg(); ?>
            <div>
                <div>
                    <label>Title<input type="text" name="title" /></label>
                    <label>Text<input type="text" name="text" /></label>
                    <label>Collaborators (ToDo)<input type="text" name="collabs" /></label>
                    <label>Attatachments
                    <div class="upload-area">
                        <p>Drag and drop files here</p>
                        <br> or<br>
                        <input id="attachmentsInput" type="file" name="attachments[]" multiple hidden>
                        <input id="fileInput" type="file" multiple>
                    </div></label>
                    <div class="file-list" ></div>
                </div>
                <input type="submit" value="Upload" />
            </div>
        </form>
    </div>
</section>