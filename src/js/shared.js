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
            link.className = "selected_link";
        } else {
            link.className = "";
        }

        link.addEventListener("click", (event) => {
            let e = event.target;
            if (e.className === "selected_link"){
                event.preventDefault();
                event.stopPropagation();
                return;
            }  
            navBarElements.forEach(element => element.className = "");
            e.className = "selected_link";
        });
    });
}

