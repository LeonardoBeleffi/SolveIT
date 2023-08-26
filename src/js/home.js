"use strict";
let nav_bar_links;
let posts;
let body;
let main;
let footer;

window.addEventListener("load", () => {
    nav_bar_links = Array.from(document.querySelectorAll("#nav-bar")[0].children);
    posts = Array.from(document.querySelectorAll("#post-list")[0].children);
    main = document.querySelectorAll("main")[0];
    body = document.querySelectorAll("body")[0];
    footer = body.children[2];

    initializeNavBar(nav_bar_links);    

    posts.forEach(post_li => {
        let post_preview = post_li.children[0].children[0];
        post_preview.addEventListener("click", event => {
            let post_preview_clicked = get_post_preview_from_click(event.target);

            if (click_to_be_ignored(event)){

                return
            } 
            if (post_preview_clicked.parentNode.parentNode.className.includes("post-opened")) {
                close_post();
            } else {
                open_post(post_preview_clicked.parentNode.parentNode);
            }
        }, false);
    });

    body.addEventListener("click", (event) => {
        let e = event.target;
        if (main.children[0].contains(e) || footer.contains(e)) return;
        close_post();
    });

    addNotificationButton();

}, false);

function open_post(post) {
    close_posts_preview();
    post.className = "list-element post-opened";
}

function close_post() {
    posts.forEach(element => {
        element.className = "list-element";
    });
}

function close_posts_preview() {
    posts.forEach(element => {
        element.className = "list-element post-closed";
    });
}

function get_post_preview_from_click(target) {
    while (target.className !== "post-preview") {
        target = target.parentNode;
    }
    return target;
}

function click_to_be_ignored(event) {

    let target = event.target;

    if(Array.from(document.querySelectorAll(".profile-pic")).find(e => e.contains(target)) ||
    Array.from(document.querySelectorAll(".username")).find(e => e.contains(target))){
        //apri utente
        return true;
    }

    if(Array.from(document.querySelectorAll(".tag-badge")).find(e => e.contains(target))){
        //ritorna post con quel tag
        return true;
    }

    if(Array.from(document.querySelectorAll(".like-button")).find(e => e.contains(target))){
        toggleLike(event);
    }


    return Array.from(document.querySelectorAll(".profile-pic")).find(e => e.contains(target)) ||
        Array.from(document.querySelectorAll(".username")).find(e => e.contains(target)) ||
        Array.from(document.querySelectorAll(".tag-badge")).find(e => e.contains(target)) ||
        Array.from(document.querySelectorAll(".like-button")).find(e => e.contains(target));
}

