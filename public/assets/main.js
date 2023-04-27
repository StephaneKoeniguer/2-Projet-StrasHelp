
// display modal login
/*function showModal() {
    var element = document.getElementById("modal").style.display= "block";
    element.classList.add("show-modal");
}*/


function displayModalLogin() {
    document.getElementById("content").style.display= "block";  
}

/*function closeModal() {
    var element = document.getElementById("modal").style.display= "none";
    element.classList.remove("show-modal");
}*/



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


