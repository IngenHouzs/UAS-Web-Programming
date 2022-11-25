let navContainer = document.getElementById("navbar");
let navLink = navContainer.getElementsByClassName("navbar-link");
let current = location.pathname;
for (let i = 0; i < navLink.length; i++) {
    const linkArray = current.split("/");
    const linkArray2 = navLink[i].href.split("/");
    let currentPage = linkArray.slice(-1);
    let clickedPage = linkArray2.slice(-1);
    if (clickedPage[0] === currentPage[0]) {
        navLink[i].className += " navbar-active";
        break;
    }
}
if (current === "/") {
    navLink[0].className += " navbar-active";
}
