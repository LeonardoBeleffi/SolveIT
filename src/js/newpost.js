"use strict";

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

document.addEventListener("input", (event) =>{



    if(event.target.classList.contains("tag_input")){
        event.stopPropagation();
        suggestTags(event)
    }
    if(event.target.classList.contains("collab_input")){
        event.stopPropagation();
        suggestUsernames(event);
    }

});

document.addEventListener("click", (event) =>{

    if(event.target.classList.contains("delete-tag-suggestion")){
        let toDelete = event.target.closest(".selected-suggestion").querySelector(".sugg-name").innerHTML;
        deleteTag(toDelete);
        event.target.parentNode.remove();
    }
    if(event.target.classList.contains("delete-collab-suggestion")){
        let toDelete = event.target.closest(".selected-suggestion").querySelector(".sugg-name").innerHTML;
        deleteCollab(toDelete);
        event.target.parentNode.remove();
    }
});

window.addEventListener("load", () => {
    let form = document.querySelector("#newpost_form");
    form.addEventListener('keydown', (event) => {
        // Prevent form submission on Enter key press
        if (event.keyCode === 13 && event.target.tagName == 'INPUT') {
            event.preventDefault();
        }
    });
});

// add drop listener to box
box.addEventListener('drop', function(e) {
    let droppedFiles = e.dataTransfer.files;
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



// SUGGESTIONs LOGIC -------

let postData = {};
let isQuering = false;

function suggestUsernames(event) {
    suggest(event,0);
}
function suggestTags(event) {
    suggest(event,1);
}

// SUGGESTIONS
// type = 0 -> suggest users
// type = 1 -> suggest tags
const COLLAB_INDEX = 0;
const TAG_INDEX = 1;
const symbols = ["@","#"]; // user, tags

function suggest(event, type) {
    if(isQuering) {
        return;
    }
    event.preventDefault();
    const input = event.target;
    const searchText = input.value;
    const suggestionsContainerTags = document.querySelector('.suggestions-tags');
    const suggestionsContainerCollabs = document.querySelector('.suggestions-collabs');
    const suggestionsContainer = [suggestionsContainerCollabs, suggestionsContainerTags];
    const realInputCollabs = document.querySelector('#real_input_collabs');
    const realInputTags = document.querySelector('#real_input_tags');
    const realInput = [realInputCollabs, realInputTags];
    const selected_tags = document.querySelector(".selected-tags");
    const selected_collabs = document.querySelector(".selected-collabs");
    const selected_list = [selected_collabs, selected_tags];

    // add name in dictionary
    if(!postData.hasOwnProperty(type)) {
        postData[type] = [];
    }

    if (searchText.trim() !== '') {

        // Send AJAX request to add comment reply
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'utils/search.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // parse response
                    const response = JSON.parse(xhr.responseText);
                    const suggestions = [response.usernames, response.tags];
                    
                    suggestionsContainer[type].innerHTML="";
                    suggestionsContainer[type].style.display = 'none';

                    // display suggestion
                    suggestions[type].forEach((sugg) => {
                        let suggestionElement = generateSuggestionElement(sugg,type);
                        suggestionsContainer[type].appendChild(suggestionElement);
                        suggestionsContainer[type].style.display = 'flex';
                        // add suggestion listener on clicked
                        suggestionElement.addEventListener('click', () => {
                            input.value = "";
                            addSuggestion(sugg,type);
                            suggestionsContainer[type].style.display = 'none';
                        });
                    });

                    isQuering = false;
                } else {
                    console.error('Failed to search.');
                }
            }
        };
        // send parentId and text
        isQuering=true;
        xhr.send(`text=${searchText}`);
    } else {
        suggestionsContainer.innerHTML="";
    }
}


function addSuggestion(sugg, type) {
    switch(type) {
        case COLLAB_INDEX: 
            return addCollab(sugg);
        case TAG_INDEX: 
            return addTag(sugg);
    }
}

function addCollab(collab) {
    const realInputCollabs = document.querySelector('#real_input_collabs');
    const selected_collabs = document.querySelector(".selected-collabs");
    if (!postData[COLLAB_INDEX].includes(collab)) {
        postData[COLLAB_INDEX].push(collab);
        realInputCollabs.value = postData[COLLAB_INDEX].join(";");
        selected_collabs.innerHTML = selected_collabs.innerHTML + generateSelectedElement(collab,COLLAB_INDEX);
    }
}

function addTag(tag) {
    const realInputTags = document.querySelector('#real_input_tags');
    const selected_tags = document.querySelector(".selected-tags");
    if (!postData[TAG_INDEX].includes(tag)) {
        postData[TAG_INDEX].push(tag);
        realInputTags.value = postData[TAG_INDEX].join(";");
        selected_tags.innerHTML = selected_tags.innerHTML + generateSelectedElement(tag,TAG_INDEX);
    }
}

function deleteCollab(collab) {
    const realInputCollabs = document.querySelector('#real_input_collabs');
    realInputCollabs.value = realInputCollabs.value.replace(collab, '');
    postData[COLLAB_INDEX].pop(collab);
}

function deleteTag(tag) {
    const realInputTags = document.querySelector('#real_input_collabs');
    realInputTags.value = realInputTags.value.replace(tag, '');
    postData[TAG_INDEX].pop(tag);
}


function generateSuggestionElement(sugg,type) {
    const suggestionElement = document.createElement('div');
    suggestionElement.classList.add('suggestion');
    suggestionElement.textContent = symbols[type]+ " " +sugg;
    return suggestionElement;
}

function generateSelectedElement(sugg,type) {
    let typeString = (type) ? "tag":"collab" ;
    return `<li class="selected-suggestion">
                <span class="sugg-text"><span class="sugg-symb">`+symbols[type]+`</span> <span class="sugg-name">`+sugg+`</span></span>
                <span class="fa-regular fa-trash-can delete-`+typeString+`-suggestion" aria-hidden="true" title="Delete suggestion"></span>
                <span class="sr-only">Delete suggestion</span>
            </li>`;

}

