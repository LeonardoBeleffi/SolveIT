"use strict";

const Themes = {
    Dark: "dark",
    Light: "light"
}

const rootObject = document.querySelector(':root');
const rootStyle = getComputedStyle(rootObject);
let currentTheme = Themes.Light;

function initializeNavBar(navBarElements){
    navBarElements.forEach(link => {
        let url = window.location.pathname;
        let filename = url.substring(url.lastIndexOf('/')+1);
        let hrefLocal = link.href.split("/");
        let hrefFilename = hrefLocal[hrefLocal.length - 1]
        //console.log(url, filename, hrefLocal, hrefFilename)
        if(hrefFilename[hrefFilename.length-1] == "#")
            hrefFilename = hrefFilename.substring(0, hrefFilename.length-1);
        if(filename == hrefFilename) {
            link.className = "selected-link";
        } else {
            link.className = "";
        }

        link.addEventListener("click", (event) => {
            let e = event.target;
            if (e.className === "selected-link"){
                event.preventDefault();
                event.stopPropagation();
                return;
            }  
            navBarElements.forEach(element => element.className = "");
            e.className = "selected-link";
        });
    });
}

// refresh loop
setInterval(() => refreshNotifications(), 2000);

function refreshNotifications() {

    const notification_count = document.querySelector('.notification-badge');

    if(!notification_count) {
        return;
    }
    // Send AJAX request to refresh notifications
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'utils/refresh.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // parse response
                    const response = JSON.parse(xhr.responseText);
                    const notifications = response.notifications;
                    notification_count.innerHTML = notifications;
                            
                } else {
                    console.error('Failed to refresh Notifications.');
                }
            }
        };
        // send parentId and text
        xhr.send();
}

function addNotificationButton(){
    const notificationButton = document.querySelector('.notifications-container');

    notificationButton.addEventListener('click', () => {
        window.location.href = 'notification.php';
    });
}

function fix_heights() {
    const body = document.querySelectorAll("body")[0];

    body.style.height = "100%";
    body.style.minHeight = "100%";

    window.addEventListener("resize", event => {
        body.style.height = window.innerHeight+"px";
        body.style.minHeight = window.innerHeight+"px";
    });
}

function toggleSiteTheme(){
    if(currentTheme == Themes.Light){
        currentTheme = Themes.Dark;
        rootObject.style.setProperty('--primaryBackground','#000000')
        localStorage.setItem('primaryBackground', '#000000'); 


    }else if(currentTheme == Themes.Dark){
        currentTheme = Themes.Light;
        rootObject.style.setProperty('--primaryBackground','#C2C2C2')
        localStorage.setItem('primaryBackground', '#C2C2C2'); 
    }
}
