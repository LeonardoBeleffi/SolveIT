"use strict";

window.addEventListener("load", () => {
    fix_heights();
    sector_inputs = Array.from(document.querySelectorAll("#sector"));
    sector_inputs.forEach(sector_input => sector_input.addEventListener("input", (event) => suggestSector(event)));
});


// SUGGESTIONs LOGIC -------
 
function suggestSector(event) {
    suggest(event,2);
}

// SUGGESTIONS
// type = 0 -> suggest users
// type = 1 -> suggest tags
// type = 2 -> suggest sector
const symbols = ["(°-°)","#","@"]; // user, tag, sector symbols

function suggest(event, type) {
    event.preventDefault();
    const input = event.target;
    const searchText = input.value;
    const suggestionsContainer = document.querySelector('.suggestions');

    if (searchText.trim() !== '') {
        suggestionsContainer.innerHTML = '';
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
                    const _sectors = response.sectors;
                    const _tags = response.tags;
                    console.log(xhr.responseText);
                    // parse suggestions
                    let suggestions = [];
                    switch (type) {
                        case 0:
                            suggestions = _usernames;
                            break;
                        case 1:
                            suggestions = _tags;
                            break;
                        case 2:
                            suggestions = _sectors;
                            break;
                    }
                    // display suggestion
                    suggestions.forEach((sugg) => {
                        let suggestionElement = generateSuggestionElement(sugg,type);
                        suggestionsContainer.appendChild(suggestionElement);
                        // add suggestion listener on clicked
                        suggestionElement.addEventListener('click', () => {
                            input.value = sugg;
                            suggestionsContainer.style.display = 'none';
                        });
                    });
                    

                    // dispaly suggestions container
                    let rect = input.getBoundingClientRect();
                    suggestionsContainer.style.position = "absolute";
                    suggestionsContainer.style.left = (rect.left + window.scrollX)+"px";
                    suggestionsContainer.style.top = (rect.bottom + window.scrollY - 10)+"px";
                    suggestionsContainer.style.width = rect.width+"px";
                    suggestionsContainer.style.display = "flex";
                    suggestionsContainer.style.paddingTop = 10 + "px";


                } else {
                    console.error('Failed to search.');
                }
            }
        };
        // send parentId and text
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

function generateSelecetedElement(sugg,type) {
    return `<li>
                <p>`+symbols[type]+" "+sugg+`</p>
            </li>`;
    
}

