<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [

    '' => ['HomeController', 'index', ['message', 'type'] ],
    'categorie/add' => ['CategorieController', 'add'],
    'offre' => ['OffreController', 'index'],
    'depot' => ['DeposerOffreController', 'index'],
    'depot/add' => ['DeposerOffreController', 'add'],
    'mesoffres/delete' => ['DeposerOffreController', 'delete'],
    'search' => ['OffreController', 'search'],
    'contact' => ['MailController', 'mail'],
    'note' => ['NoteController', 'add'],
    'mesoffres' => ['DeposerOffreController', 'show'],
    'login' => ['SecurityController', 'login'],
    'logout' => ['SecurityController', 'logout'],
    'dashboard' => ['DashboardController', 'index',],
    'dashboard/delete' => ['DashboardController', 'delete',['id']],
    'dashboard/search' => ['DashboardController', 'search'],
    'createUser/add' => ['CreateUserController', 'add'],
    'depot/edit' => ['DeposerOffreController', 'redit', ['id']],
    'depot/edit/update' => ['DeposerOffreController', 'edit', ['id']],
];
