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

    nav_bar_links.forEach(link => {
        let url = window.location.pathname;
        let filename = url.substring(url.lastIndexOf('/')+1);
        let hrefLocal = link.href.split("/");
        let hrefFilename = hrefLocal[hrefLocal.length - 1]
        console.log(url, filename, hrefLocal, hrefFilename)
        if(hrefFilename[hrefFilename.length-1] == "#")
            hrefFilename = hrefFilename.substring(0, hrefFilename.length-1);
        if(filename == hrefFilename){
            link.className = "selected_link";
        }else
        link.className = "";

    });

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
            let cardText = post.querySelector(".post-preview").children[1].children[0];
            // console.log(cardText.textOverflow);
            // cardText.overflow = "visible";
            // cardText.whiteSpace = "normal";
            // cardText.textOverflow = "none";
            posts.forEach(element => {
                // let elementPreview = element.querySelector(".post-preview");
                // let elementTitle = element.querySelector(".card-title");
                // let elementText = element.querySelector(".card-text");
                // let elementContainer = element.querySelector(".post-container");
                if (element !== event.currentTarget) {
                    element.style.display = "none";
                }
            });
        }, false);
    });

    body.addEventListener("click", (event) => {
        let e = event.target;
        if (main.children[0].contains(e) || footer.contains(e)) return;
        posts.forEach(element => {
            let toHide = element.querySelector(".post-opened");
            //let cardText = post.querySelector(".post-preview").children[1].children[0];
            // cardText.overflow = "hidden";
            // cardText.textoverflow = "ellipsis";
            element.style.display = "block";
            toHide.style.display = "none";
        });
    });

}, false);

