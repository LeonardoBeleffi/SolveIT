"use strict";

let nav_bar_links;

window.addEventListener("load", () => {
    nav_bar_links = Array.from(document.querySelectorAll("#nav_bar")[0].children);

    nav_bar_links.forEach(event => {
        addEventListener("click", (event) => {
            let e = event.target;
            if (e.tagName !== 'A') return;
            if (e.className === "selected_link")  return;
            nav_bar_links.forEach(element => element.className = "");
            e.className = "selected_link";
        });
    });
}, false);

