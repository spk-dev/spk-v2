
/**
 * Types d'événement
 **/
function defineTypesEvenement(type){
    var type2 = {
        id          : type.tev_int_id,
        libelle     : type.tev_var_libelle
    }
    console.log('dans model / defineTypesEvenement '+type2);
    return type2;
}

/**
 * Définir l'objet évenement
 * @param {evenement} event
 * @returns {evenement}
 */
function defineEvenement(event){
    
//SELECT ocu_int_id, eve_var_libelle, eve_org_int_id, 
//                ocu_date_debut, ocu_date_fin, tev_int_id, tev_var_libelle, 
//                pla_var_ville, org_int_id, org_var_libelle, med_var_url
//                FROM eve_evenements 


    var evenement = {
    
    eve_id              : event.eve_int_id,
    id                  : event.ocu_int_id,
    titre               : event.eve_var_libelle,
    description         : event.eve_var_description,
    mail                : event.eve_var_mail_inscription,
    contact             : event.eve_var_contact,
    debut               : event.ocu_date_debut,
    fin                 : event.ocu_date_fin,
    image               : event.med_var_url,
    prix                : event.eve_var_prix,
    url                 : event.eve_var_url,
//    themes              : event.themes,
//    intervenants        : event.intervenants,
    garderie            : event.eve_var_gardeenfant,
    hebergement         : event.eve_var_hebergement,
    organisateur_id     : event.eve_org_int_id,
    type_id             : event.tev_int_id,
    type_nom            : event.tev_var_libelle,
    organisateur_nom    : event.org_var_libelle,
    route               : event.pla_var_route,
    cp                  : event.pla_int_cp,
    ville               : event.pla_var_ville,
    pays                : event.pla_var_pays,
    lat                 : event.pla_dec_lat,
    lng                 : event.pla_dec_long

  
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

