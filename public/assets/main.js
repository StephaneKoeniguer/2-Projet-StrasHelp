
// display modal login
function displayModalLogin() {
    document.getElementById("contentlogin").style.display= "block"; 
}

function hiddenModalLogin(){
    document.getElementById("contentlogin").style.display= "none";
}


// Display modal contact
function displayModalContact() {
    document.getElementById("content").style.display= "block"; 
}

function hiddenModalContact(){
    document.getElementById("content").style.display= "none";
}



//display burger menu
var menu = document.querySelector('nav ul');
var menuBar = document.querySelector('nav .menu-icon');
var iconMenu = document.querySelector('nav .menu-icon img');

menuBar.addEventListener('click',function(){

    if (iconMenu.getAttribute("src") == 'assets/images/menu.png') {
        iconMenu.setAttribute("src","assets/images/close.png");
    }else{
        iconMenu.setAttribute("src","assets/images/menu.png");
    }

   menu.classList.toggle('active');
});


