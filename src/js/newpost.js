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
        console.log(toDelete);
        postData["tags"].pop(toDelete);
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

    // let divMain = document.querySelector(".main_content");
    // divMain.addEventListener("scroll", () => moveSuggestionOnScroll());

    // let tag_inputs = Array.from(document.querySelectorAll(".tag_input"));
    // tag_inputs.forEach(tag_input => tag_input.addEventListener("input", (event) => suggestTags(event)));
    // tag_inputs.forEach(tag_input => tag_input.addEventListener("keydown", (event) => createTag(event)));

    // let collab_inputs = Array.from(document.querySelectorAll(".collab_input"));
    // collab_inputs.forEach(collab_input => collab_input.addEventListener("input", (event) => suggestUsernames(event)));

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
    const realInput = input.closest("section").querySelector(".real_input");

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

// function moveSuggestionOnScroll() {
//     const suggestionsContainer = document.querySelector('.suggestions');
//     if(suggestionsContainer.style.display == "none") {
//         return;
//     }
//     let input;
//     if(inputSuggestionType==0) {
//         input = document.querySelector('.collab_input');
//     } else {
//         input = document.querySelector('.tag_input');
//     }
//     setSuggestionPositionOn(input);
// }

// function setSuggestionPositionOn(input) {
//     const suggestionsContainer = document.querySelector('.suggestions');

//     let rect = input.getBoundingClientRect();
//     suggestionsContainer.style.position = "absolute";
//     suggestionsContainer.style.left = (rect.left + window.scrollX)+"px";
//     suggestionsContainer.style.top = (rect.bottom + window.scrollY - 10)+"px";
//     suggestionsContainer.style.width = rect.width+"px";
//     suggestionsContainer.style.display = "flex";
//     suggestionsContainer.style.paddingTop = 10 + "px";
// }

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
    const selected_tags = input.closest("section").querySelector(".selected-tags");
    const selected_collabs = input.closest("section").querySelector(".selected-collabs");
    let suggestionsContainer;
    let selected_list;
    const realInput = input.closest("section").querySelector(".real_input");

    // add name in dictionary
    if(!postData.hasOwnProperty(realInput.name)) {
        postData[realInput.name] = [];
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
                    const _usernames = response.usernames;
                    const _tags = response.tags;
                    console.log(xhr.responseText);
                    // parse suggestions
                    let suggestions = [];
                    switch (type) {
                        case 0:
                            // foreach user
                            suggestions = _usernames;
                            suggestionsContainer = suggestionsContainerCollabs;
                            selected_list = selected_collabs;
                            break;
                        case 1:
                            // foreach tag
                            suggestions = _tags;
                            suggestionsContainer = suggestionsContainerTags;
                            selected_list = selected_tags;
                            break;
                    }

                    suggestionsContainer.innerHTML = '';

                    // display suggestion
                    suggestions.forEach((sugg) => {
                        let suggestionElement = generateSuggestionElement(sugg,type);
                        suggestionsContainer.appendChild(suggestionElement);
                        // add suggestion listener on clicked
                        suggestionElement.addEventListener('click', () => {
                            input.value = "";
                            if (!postData[realInput.name].includes(sugg)) {
                                postData[realInput.name].push(sugg);
                                console.log(postData);
                                realInput.value = postData[realInput.name].join(";");
                                selected_list.innerHTML = selected_list.innerHTML + generateSelectedElement(sugg,type);
                            }
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

