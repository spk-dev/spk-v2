//setListeThemes();
//setListeTypes();
//setListeOrganisateurs();

//setDateField();
//loadMap();


/**
 * Aiguillage en fonction des pages
 * @param {type} page
 * @returns {undefined}
 */
function launcher(page,id){
    switch(page) {
        case 'home':
            pageHome();
            break;
        case 'evenements':
            pageEvenements(null);
            break;
        case 'evenement':
            pageEvenement(id);
            break;
        case 'organisateurs':
            pageOrganisateurs(true,false);
            break;
        case 'organisateur':
            pageOrganisateur(id);
            break;
        default:
    }
}