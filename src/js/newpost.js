
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

document.addEventListener("keydown", (event) =>{
    if(event.target.classList.contains("tag_input")){
        createTag(event);
    }
});


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

    if(event.target.classList.contains("delete-suggestion")){
        console.log(event.target.classList);

        let toDelete = event.target.innerHTML.slice(1,0);
        //console.log(toDelete);
        postData["tags"].pop(toDelete);
        console.log("delete",postData["tags"]);
        event.target.parentNode.remove();
    }
});


window.addEventListener("load", () => {
    fix_heights();

    let nav_bar_links = Array.from(document.querySelectorAll("#nav-bar")[0].children);
    initializeNavBar(nav_bar_links);

    let form = document.querySelector("#newpost_form");
    form.addEventListener('keydown', (event) => {
        // Prevent form submission on Enter key press
        if (event.keyCode === 13 && event.target.tagName == 'INPUT') {
            event.preventDefault();
        }
    });

    addNotificationButton();

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
let inputSuggestionType = 0;


// TAG creation
function createTag(event) {
    const input = event.target;
    const searchText = input.value;
    const selected_list = input.closest("section").querySelector(".selected-tags");
    const realInput = document.querySelector("#real_input_tags");
    //const realInputCollabs = document.querySelector("#real_input_collabs");

    // perform only on enter key
    if(event.keyCode != 13) {
        return;
    }
    // add name in dictionary
    if(!postData.hasOwnProperty(realInput.name)) {
        postData[realInput.name] = [];
        console.log(postData);
    }
    if (searchText.trim() !== '') {
        input.value = "";
        if (!postData[realInput.name].includes(searchText)) {
            input.value = "";
            postData[realInput.name].push(searchText);
            realInput.value = postData[realInput.name].join(";");
            selected_list.innerHTML = selected_list.innerHTML + generateSelectedElement(searchText,1);
        }
    }

}

function suggestUsernames(event) {
    suggest(event,0);
}
function suggestTags(event) {
    suggest(event,1);
}

// SUGGESTIONS
// type = 0 -> suggest users
// type = 1 -> suggest tags
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
    const selected_tags = document.querySelector(".selected-tags");
    const selected_collabs = document.querySelector(".selected-collabs");
    let suggestionsContainer;
    let selected_list;
    let realInput;

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
                    const _usernames = response.usernames;
                    const _tags = response.tags;
                    console.log(xhr.responseText);
                    // parse suggestions
                    let suggestions = [];
                    let typeString;
                    switch (type) {
                        case 0:
                            // foreach user
                            typeString = "tags";
                            realInput = document.querySelector("#real_input_tags");
                            suggestions = _usernames;
                            suggestionsContainer = suggestionsContainerCollabs;
                            selected_list = selected_collabs;
                            break;
                        case 1:
                            // foreach tag
                            typeString = "collabs";
                            realInput = document.querySelector("#real_input_collabs");
                            suggestions = _tags;
                            suggestionsContainer = suggestionsContainerTags;
                            selected_list = selected_tags;
                            break;
                    }

                    // add name in dictionary
                    if(!postData.hasOwnProperty(realInput.name)) {
                        postData[realInput.name] = [];
                    }

                    suggestionsContainer.innerHTML = '';

                    // display suggestion
                    suggestions.forEach((sugg) => {
                        let suggestionElement = generateSuggestionElement(sugg,type);
                        suggestionsContainer.appendChild(suggestionElement);
                        // add suggestion listener on clicked
                        suggestionElement.addEventListener('click', () => {
                            input.value = "";
                            insertSuggestion(realInput, sugg, typeString, selected_list);
                            suggestionsContainer.style.display = 'none';
                        });
                    });


                    if(suggestions.length != 0) {
                        // dispaly suggestions container
                        //setSuggestionPositionOn(input);
                        suggestionsContainer.style.display = 'flex';
                    } else {
                        suggestionsContainer.style.display = 'none';
                    }
                    inputSuggestionType = type;
                    isQuering = false;
                } else {
                    console.error('Failed to search.');
                }
            }
        };
        // send parentId and text
        isQuering=true;
        xhr.send(`text=${searchText}`);
    }
}

function insertSuggestion(realInput, sugg, type, selected_list){
    if (!postData[type].includes(sugg)) {
        postData[type].push(sugg);
        console.log("create",postData);
        realInput.value = postData[type].join(";");
        selected_list.innerHTML = selected_list.innerHTML + generateSelectedElement(sugg,type);
    }
}

function generateSuggestionElement(sugg,type) {
    const suggestionsContainer = document.querySelector('.suggestions');
    const suggestionElement = document.createElement('div');
    suggestionElement.classList.add('suggestion');
    suggestionElement.textContent = symbols[type]+ " " +sugg;
    return suggestionElement;
}

function generateSelectedElement(sugg,type) {
    return `<li class="selected-suggestion">
                <span class="sugg-text">`+symbols[type]+" "+sugg+`</span>
                <span class="fa-regular fa-trash-can delete-suggestion" aria-hidden="true" title="Delete suggestion"></span>
                <span class="sr-only">Delete suggestion</span>
            </li>`;

}

