
$(document).ready(() => {

    let navLinks = document.querySelectorAll('.nav-link');
    let titleBar = document.getElementById('title-bar');
    navLinks.forEach(link => {
        if (link.href == location.href) {
            link.classList.add('active');
            titleBar.innerHTML = link.innerHTML;
            document.title = link.innerText;
        }
    });

});