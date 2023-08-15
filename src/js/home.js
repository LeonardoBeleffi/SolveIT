"use strict";

let nav_bar_links;
let posts;
let body;
let main;
let footer;

window.addEventListener("load", () => {
    nav_bar_links = Array.from(document.querySelectorAll("#nav_bar")[0].children);
    posts = Array.from(document.querySelectorAll("#post_list")[0].children);
    main = document.querySelectorAll("main")[0];
    body = document.querySelectorAll("body")[0];
    footer = body.children[2];

    nav_bar_links.forEach(event => {
        event.addEventListener("click", (event) => {
            let e = event.target;
            if (e.className === "selected_link")  return;
            nav_bar_links.forEach(element => element.className = "");
            e.className = "selected_link";
        });
    });

    posts.forEach(post => {
        post.addEventListener("click", (event) => {
            let e = event.target;
            post.children[0].style.height = "100%";
            post.children[0].children[0].className = "";
            post.children[0].children[1].style.display = "block";
            posts.forEach(element => {
                let elementPreview = element.children[0].children[0];
                if (elementPreview !== e) element.style.display = "none";
            });
        }, false);
    });

    body.addEventListener("click", (event) => {
        let e = event.target;
        if (main.children[0].contains(e) || footer.contains(e)) return;
        posts.forEach(element => {
            element.style.display = "block";
            element.children[0].children[0].className = "post_preview";
            // element.children[0].style.height = "15vh";
            element.children[0].children[1].style.display = "none";
        });
    });

}, false);

