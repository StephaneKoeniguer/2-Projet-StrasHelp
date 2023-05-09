// display modal login
function displayModalLogin() {
    document.getElementById("contentlogin").style.display = "block";
}

function hiddenModalLogin() {
    document.getElementById("contentlogin").style.display = "none";
}

// Display modal contact
function displayModalContact() {
    document.getElementById("content").style.display = "block";
}

function hiddenModalContact() {
    document.getElementById("content").style.display = "none";
}

//display burger menu
var menu = document.querySelector("nav ul");
var menuBar = document.querySelector("nav .menu-icon");
var iconMenu = document.querySelector("nav .menu-icon img");

menuBar.addEventListener("click", function () {
    if (iconMenu.getAttribute("src") == "/assets/images/menu.png") {
        iconMenu.setAttribute("src", "/assets/images/close.png");
    } else {
        iconMenu.setAttribute("src", "/assets/images/menu.png");
    }

    menu.classList.toggle("active");
});

// Show and hidden date in Home form

// Récupération des éléments HTML nécessaires
const dateField = document.getElementById("date");
const associationRadio = document.querySelector(
    'input[name="type"][value="association"]'
);
const particulierRadio = document.querySelector(
    'input[name="type"][value="particulier"]'
);

// Fonction pour afficher ou masquer le champ de la date
const date = document.querySelector('#labeldate');

function toggleDateField() {
    if (associationRadio.checked) {
        dateField.style.display = "block";
        date.style.display = "block"
    } else {
        dateField.style.display = "none";
        date.style.display = "none"
    }
}

// Ajout d'un écouteur d'événements sur les radios de type
associationRadio.addEventListener("click", toggleDateField);
particulierRadio.addEventListener("click", toggleDateField);

// Masquage initial du champ de la date si le radio particulier est sélectionné
toggleDateField();
