function showModal() {
    var element = document.getElementById("modal");
    element.classList.add("show-modal");
}

function closeModal() {
    var element = document.getElementById("modal");
    element.classList.remove("show-modal");
}

var menu = document.querySelector('nav ul');
var menuBar = document.querySelector('nav .menu-icon');
var iconMenu = document.querySelector('nav .menu-icon img');

menuBar.addEventListener('click',function(){

    if (iconMenu.getAttribute("src") == 'assets/menu.png') {
        iconMenu.setAttribute("src","assets/close.png");
    }else{
        iconMenu.setAttribute("src","assets/menu.png");
    }

   menu.classList.toggle('active');
});