document.addEventListener("click", (event) =>{
    if(event.target.classList.contains("header-title")){
        window.location.href = "./login.php";
    }
});