
$(document).ready(() => {
    $("body").click((e) => {
        if (!$(e.target).hasClass("filter-dropdown")) {
            if (
                document.querySelector(".dropdown-filter").style.display ===
                "block"
            ) {
                document.querySelector(".dropdown-filter").style.display =
                    "none";
            }
        }
    });
});

function clickNavbar() {
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
}

const closeWarning = () =>{
    document.querySelector('.late-warning').style.display = 'none';
}

clickNavbar();

const filterDropdown = () => {
    const dropdown = document.querySelector(".dropdown-filter");
    if (dropdown.style.display === "none") {
        document.querySelector(".dropdown-filter").style.display = "block";
    } else {
        document.querySelector(".dropdown-filter").style.display = "none";
    }
};

function showDivs(n) {
    let i;
    let x = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("demo");
    if (n > x.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = x.length;
    }
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" w3-white", "");
    }

    x[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " w3-white";
}
function plusDivs(n) {
    showDivs((slideIndex += n));
}
function currentDiv(n) {
    showDivs((slideIndex = n));
}
let slideIndex = 1;
showDivs(slideIndex);

function removeActive() {
    const changePasswordActive = document.getElementById("change-password");
    changePasswordActive.className.replace(" navbar-active", "");
}
removeActive();



const addAuthor = () => {
    const input = document.createElement("input");
    input.setAttribute("name", "penulis[]");
    input.setAttribute("type", "text");
    document.querySelector(".author-box").append(input);
};


