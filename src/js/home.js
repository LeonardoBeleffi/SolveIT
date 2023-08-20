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
            let toShow = post.querySelector(".post-opened")
            toShow.style.display = "block";
            posts.forEach(element => {
                // let elementPreview = element.querySelector(".post-preview");
                // let elementTitle = element.querySelector(".card-title");
                // let elementText = element.querySelector(".card-text");
                // let elementContainer = element.querySelector(".post-container");
                if (element !== event.currentTarget) {
                    element.style.display = "none";
                }
                // }else{
                //     element.style.display = "none";
                // }
            });
        }, false);
    });

    body.addEventListener("click", (event) => {
        let e = event.target;
        if (main.children[0].contains(e) || footer.contains(e)) return;
        posts.forEach(element => {
            let toHide = element.querySelector(".post-opened");
            element.style.display = "block";
            toHide.style.display = "none";
        });
    });

}, false);

