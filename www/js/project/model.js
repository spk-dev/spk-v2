
/**
 * Définir l'objet évenement
 * @param {evenement} event
 * @returns {evenement}
 */
function defineEvenement(event){
    var evenement = {
    eve_id              : event.eve_int_id,
    ocu_id              : event.ocu_int_id,
    titre               : event.eve_var_libelle,
    description         : event.eve_var_description,
    mail                : event.eve_var_mail_inscription,
    contact             : event.eve_var_contact,
    debut               : event.ocu_date_debut,
    fin                 : event.ocu_date_fin,
    image               : event.image,
    prix                : event.prix,
    url                 : event.url,
    themes              : event.themes,
    intervenants        : event.intervenants,
    garderie            : event.garderie,
    hebergement         : event.hebergement,
    organisateur_id     : event.lieu_id,
    type_id             : event.type_id,
    type_nom            : event.type_nom,
    organisateur_nom    : event.lieu_nom,
    adresse1            : event.adresse1,
    adresse2            : event.adresse2,
    cp                  : event.cp,
    ville               : event.ville,
    pays                : event.pays,
    lat                 : event.lat,
    long                : event.long

  
    };
    return evenement;
}

/**
 * Définir l'objet organisateur
 * @param {obj} organisateur
 * @returns {organisateur}
 */
function defineOrganisateur(organisateur){
//    var organisateur = {
//        id                  : event.id,
//        titre               : event.titre,
//        description         : event.description,
//        mail                : event.mail,
//        contact             : event.contact,
//        debut               : event.debut,
//        fin                 : event.fin,
//        image               : event.image,
//        prix                : event.prix,
//        url                 : event.url,
//        themes              : event.themes,
//        intervenants        : event.intervenants,
//        garderie            : event.garderie,
//        hebergement         : event.hebergement,
//        organisateur_id     : event.lieu_id,
//        type_id             : event.type_id,
//        type_nom            : event.type_nom,
//        organisateur_nom    : event.lieu_nom,
//        adresse1            : event.adresse1,
//        adresse2            : event.adresse2,
//        cp                  : event.cp,
//        ville               : event.ville,
//        pays                : event.pays,
//        lat                 : event.lat,
//        long                : event.long
//    };
    return organisateur;
}

/**
 * Défini l'objet de recherche
 * @param {array} args
 * @returns {obj}
 */
function beanRechercheEvenement(args){
    
    
     var bean = {};
     if(null){
         
     }
     
}

/**
 * Renvoi un json avec les valeurs du form
 * @returns {String}
 */
function searchEvenementToJSON() {
    return JSON.stringify({
        "types": $('#search-types').val(),
        "themes": $('#name').val(),
        "organisateur" : $('#search-organisateurs').val()
    });
}

