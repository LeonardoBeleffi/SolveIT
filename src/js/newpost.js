// retrieve HTML objects
const box = document.querySelector('.upload-area');
const attachmentsInput = document.getElementById('attachmentsInput');
const fileInput = document.getElementById('fileInput');
const fileList = document.querySelector('.file-list');

// prevent default behaviour of draggin operations
[ 'drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop' ].forEach( event => box.addEventListener(event, function(e) {
    e.preventDefault();
    e.stopPropagation();
}), false );

[ 'dragover', 'dragenter' ].forEach( event => box.addEventListener(event, function(e) {
    box.classList.add('is-dragover');
}), false );

[ 'dragleave', 'dragend', 'drop' ].forEach( event => box.addEventListener(event, function(e) {
    box.classList.remove('is-dragover');
}), false );

window.addEventListener("load", () => {
    nav_bar_links = Array.from(document.querySelectorAll("#nav_bar")[0].children);

    nav_bar_links.forEach(link => {
        let url = window.location.pathname;
        let filename = url.substring(url.lastIndexOf('/')+1);
        let hrefLocal = link.href.split("/");
        let hrefFilename = hrefLocal[hrefLocal.length - 1]
        console.log(link.href, filename, hrefLocal, hrefFilename)
        if(hrefFilename[hrefFilename.length-1] == "#")
            hrefFilename = hrefFilename.substring(0, hrefFilename.length-1);
        if(filename == hrefFilename){
            link.className = "selected_link";
        }else
        link.className = "";
    });
});


// add drop listener to box
box.addEventListener('drop', function(e) {
    droppedFiles = e.dataTransfer.files;
    attachmentsInput.files = droppedFiles;
    updateFileList();
}, false );

// add change listener on manual file input
fileInput.addEventListener( 'change', function(e) {
    attachmentsInput.files = fileInput.files;
    updateFileList();
}, false  );

// function to print selected files
function updateFileList() {
    const files = Array.from(attachmentsInput.files);
    if (files.length > 0) {
        fileList.innerHTML = '<p>Selected files:</p><ul><li>' + files.map(f => f.name + " (" + formatSize(f.size) + ")").join('</li><li>') + '</li></ul>';
    } else {
        fileList.innerHTML = '';
    }
}

// function to get file size
function formatSize(size) {
    const kbSize = size / 1024;
    if (kbSize < 1024) {
    return kbSize.toFixed(2) + ' KB';
    } else {
    const mbSize = kbSize / 1024;
    return mbSize.toFixed(2) + ' MB';
    }
}
