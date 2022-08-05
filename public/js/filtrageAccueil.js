// Récupération des champs de sorties

let names = Array.from(document.querySelectorAll('.name'));
let dates = Array.from(document.querySelectorAll('.date_debut'));
let clotures = Array.from(document.querySelectorAll('.cloture'));
let places = Array.from(document.querySelectorAll('.place'));
let etats = Array.from(document.querySelectorAll('.etat'));
let inscrits = Array.from(document.querySelectorAll('.inscrit'));
let organisateurs = Array.from(document.querySelectorAll('.organisateur'));
let actions = Array.from(document.querySelectorAll('.action'));
let Rechercher = document.getElementById('search');
let utilisateur = document.getElementById('utilisateur');
let orgas = Array.from(document.querySelectorAll('.orga'));

function getTableau() {
    console.log('ON RECHARGE LE TABLEAU')
    names = Array.from(document.querySelectorAll('.name'));
    dates = Array.from(document.querySelectorAll('.date_debut'));
    clotures = Array.from(document.querySelectorAll('.cloture'));
    places = Array.from(document.querySelectorAll('.place'));
    etats = Array.from(document.querySelectorAll('.etat'));
    inscrits = Array.from(document.querySelectorAll('.inscrit'));
    organisateurs = Array.from(document.querySelectorAll('.organisateur'));
    actions = Array.from(document.querySelectorAll('.action'));
}

// Récupération des checKBox
let isOrganisateur = document.getElementById('accueil_filtrage_form_isOrganisateur');
let isInscrit = document.getElementById('accueil_filtrage_form_isInscrit');
let isPasInscrit = document.getElementById('accueil_filtrage_form_isPasInscrit');
let isPassees = document.getElementById('accueil_filtrage_form_sortiesPassees');

let search = document.getElementById('test');

// LISTENERS
Rechercher.addEventListener('click', checkAll)

let i =0;

// FONCTIONS
function checkAll(){ // a n'importe quel event
 // remettre tTOUT ds le tableau
    getTableau();
    searchBar();
    checkboxPasse();
    checkboxOrga();
    //checkbox();
    console.log('event activé');
}
//
function searchBar(){
    for (let i = 0; i < names.length; i++) {
        if (names[i].innerHTML.toLowerCase().includes(search.value.toLowerCase())) {
            flexAll(i);
            console.log('ola');
        }else {
            console.log('yoyoyoy')
            noneAll(i)
            // virer le truc que tu n'affiches oas
            virerLigne(i);
        }
    }
}
// vérifier quand on peut créer des users
function checkboxPasse(){
    if(isPassees.checked){
        for (let i = 0; i < names.length; i++) {
            if (etats[i].innerHTML.includes('Passée')) {
                flexAll(i);
            }else {
                noneAll(i)
                // virer le truc que tu n'affiches oas
                virerLigne(i);
            }
        }
    }
}

function checkboxOrga(){
    if(!isOrganisateur.checked){
        for (let i = 0; i < names.length; i++) {
            if (organisateurs[i].innerHTML.includes(utilisateur.innerHTML)) {
                noneAll(i)
                console.log('on est ds le IF de orga')
                virerLigne(i);

            }else {
                flexAll(i);
                // virer le truc que tu n'affiches oas
                console.log('on est ds le ELSE de orga')
            }
        }
    }
}

function virerLigne(i) {
    console.log('LE TABLEAU AVANT : ')
    console.log(names);
    names.splice(i, 1);
    dates.splice(i, 1);
    clotures.splice(i, 1);
    places.splice(i, 1);
    etats.splice(i, 1);
    inscrits.splice(i, 1);
    organisateurs.splice(i, 1);
    actions.splice(i, 1);
    console.log('LE TABLEAU APRES : ')
    console.log(names);
}

// AFFICHAGE
function flexAll(i){
    names[i].style.display = 'flex';
    dates[i].style.display = 'flex';
    clotures[i].style.display = 'flex';
    places[i].style.display = 'flex';
    etats[i].style.display = 'flex';
    inscrits[i].style.display = 'flex';
    organisateurs[i].style.display = 'flex';
    actions[i].style.display = 'flex';
}

function noneAll(i){
    names[i].style.display = 'none';
    dates[i].style.display = 'none';
    clotures[i].style.display = 'none';
    places[i].style.display = 'none';
    etats[i].style.display = 'none';
    inscrits[i].style.display = 'none';
    organisateurs[i].style.display = 'none';
    actions[i].style.display = 'none';
}




