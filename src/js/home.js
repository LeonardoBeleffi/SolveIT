"use strict";

let nav_bar_links;
let posts;
let body;
let replybtns;
let deletebtns;
let main;
let footer;

window.addEventListener("load", () => {
    fix_heights();

    nav_bar_links = Array.from(document.querySelectorAll("#nav-bar")[0].children);
    posts = Array.from(document.querySelectorAll("#post-list")[0].children);
    replybtns = Array.from(document.querySelectorAll(".reply-button"));
    deletebtns = Array.from(document.querySelectorAll(".delete-button"));
    main = document.querySelectorAll("main")[0];
    body = document.querySelectorAll("body")[0];
    footer = body.children[2];

    initializeNavBar(nav_bar_links);    

    if(posts){
        posts.forEach(post_li => {
            let post_preview = post_li.children[0].children[0];
            post_preview.addEventListener("click", event => {
                let post_preview_clicked = get_post_preview_from_click(event.target);

                if (filter_clicks(event)) return;
                if (post_preview_clicked.parentNode.parentNode.className.includes("post-opened")) {
                    if(close_post_button_clicked(event.target))
                        close_post();
                } else {
                    open_post(post_preview_clicked.parentNode.parentNode);
                }
            }, false);
        });
    }

    // if(replybtns){
    //     replybtns.forEach(button => {
    //         button.addEventListener("click", event => {
    //             toggleReply(event);
    //         }, false);
    //     });
    // }

    if(deletebtns){
        deletebtns.forEach(button => {
            button.addEventListener("click", event => {
                deleteComment(event);
            }, false);
        });
    }


    Array.from(document.querySelectorAll(".like-button")).forEach(button => {
        button.addEventListener("click", event => {
            toggleLike(event);
        });
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

function close_post_button_clicked(target) {
    return target.className.includes("close-post-button") ||
        target.parentNode.className.includes("close-post-button");
}

function filter_clicks(event) {

    let target = event.target;

    //Array.from(document.querySelectorAll(".profile-pic")).find(e => e.contains(target))

    if(Array.from(document.querySelectorAll(".username")).find(e => e.contains(target))){
        let username = event.target.innerHTML.trim();
        username = username.substring(1,username.length);
        window.location.href = "./profile.php?user="+username;
        return true;
    }

    if(Array.from(document.querySelectorAll(".tag-badge")).find(e => e.contains(target))){
        window.location.href = "./search.php?tag="+event.target.innerHTML.trim();
        return true;
    }

    if(Array.from(document.querySelectorAll(".like-button")).find(e => e.contains(target))){
        return true;
    }

    return false;
}

