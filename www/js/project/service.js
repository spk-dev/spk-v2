
/**
 * Construire la liste des événements
 * @returns {null}
 */
function pageHome(){
    pageHomeEvenement();
    pageHomeOrganisateurs();
    getNbEvenementsParThemes();
    
}

function pageHomeOrganisateurs(){
    
    var url = urlOrganisateursNextEvent;
    console.log(url);
    $.getJSON(url, function (data) {
        $(data.organisateurs).each(function (i, organisateur) {
            console.log(organisateur);
            appendOrganisateurHome(organisateur);
        });
    });  
    
}
function pageHomeEvenement(){
    removeItems('#listeEvenements');
    //removeEvenementHome();
    $.getJSON(urlEvenements, function (data) {
        $(data.evenements).each(function (i, event) {
            var evenement = defineEvenement(event);
            var debut = evenement.debut;
            var fin = evenement.fin;
            // lister les coordonnées GPS dans le tableauMarqueurs
             tableauMarqueurs.push({
                lat     : evenement.lat,
                lng     : evenement.long,
                popup   : evenement.titre,
                date    : debut+' <br/> '+fin,
                lieu    : evenement.ville,
                id      : evenement.id
            });
            appendEvenementHome(evenement);
        });
    });
}
/**
 * Construire la liste des événements
 * @returns {null}
 */
function pageEvenements(){


    $('#listeEvenements div').remove();
    $('#loading').show();
    
    formData = $('#formResearch input').serialize();
    console.log(formData);
    var url = "";
    var plural = "";

    url = urlEvenements+"?"+formData;
    console.log('url : '+url);

//    var nbItems;
//    var nbItemsParPage;

    
    $.getJSON(url, function (data) {
        console.log(data);
        nbItems = data.evenements.length;
//        nbItemsParPage = $("#nbItemParPage option:selected").val();

        if(nbItems>1){
            plural = "s";
        }
        $("#nbItems").html(nbItems);
        $("#plural").html(plural);

       
        //nomsDesMois = new Array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre") ;
        var listDate = new Array();
        
        $(data.evenements).each(function (i, event) {
                

//            if(i >= min && i <= max) {

                var evenement = defineEvenement(event);
                var debut = evenement.debut;
                var fin = evenement.fin;
                console.log("debut = "+debut);
                
                datedebut = formatDate(debut,"moisAn");
                //datedebut = nomsDesMois[datedebut.getUTCMonth()]+" "+datedebut.getUTCFullYear();
                console.log("datedebug = "+datedebut);
                if($.inArray(datedebut,listDate)<1){
                    listDate.push(datedebut);
                    appendEvenementsDate(datedebut);
                }
                
                // lister les coordonnées GPS dans le tableauMarqueurs
                tableauMarqueurs.push({
                    lat: evenement.lat,
                    lng: evenement.long,
                    popup: evenement.titre,
                    date: debut + ' <br/> ' + fin,
                    lieu: evenement.ville,
                    id : evenement.id
                });
                appendEvenements(evenement);
//            }



        });
        appendEvenementsListeOrder(listDate);
        console.log(listDate);
    });
    $('#loading').hide();
}


/**
 * Construire la liste des événements
 * @returns {null}
 */
function pageEvenement(id){

    console.log('rentre dans pageEvenement id = ['+id+']');


    var url = urlEvenement+id;
    var i
    console.log('url : '+url);
    console.log(tableauMarqueurs);
    tableauMarqueurs = [];
    console.log(tableauMarqueurs);
    //$('#Item div').remove();
    
    
    
    $.getJSON(url, function (data) {
        console.log();
        $(data.evenements).each(function (i, event) {
            // lister les coordonnées GPS dans le tableauMarqueurs

                
            var evenement = defineEvenement(event);
            var debut = evenement.debut;
            var fin = evenement.fin;
      
            appendEvenement(evenement);
        });
    });
    $('#loading').hide();
}


/**
 * Construire la liste des événements
 * @returns {null}
 */
function pageOrganisateurs(isoCriteres, filter){
    var url = "";

    url = urlOrganisateurs;

    removeItems('#listeItems');
    $.getJSON(url, function (data) {
        
        console.log('data : '+data);
        nbItems = data.organisateurs.length;
        nbItemsParPage = $("#nbItemParPage option:selected").val();

        $(data.organisateurs).each(function (i, organisateur) {
            var org = defineOrganisateur(organisateur);

            // lister les coordonnées GPS dans le tableauMarqueurs
            tableauMarqueurs.push({
                lat: org.lat,
                lng: org.long,
                popup: org.nom,

            });
            appendOrganisateurs(org);
        });
    });
    $('#loading').hide();
}


function pageOrganisateur(id){

    console.log('rentre dans pageOrganisateur');


    var url = "";
    var plural = "";

    url = urlOrganisateur+id;
    console.log('url : '+url);


    $('#Item div').remove();
    console.log('Apres remove');
    $.getJSON(url, function (data) {
        console.log('Apres getjson');

        $(data.organisateurs).each(function (i, organisateur) {
            console.log('Apres data.orga');

                var org = defineOrganisateur(organisateur);

                // lister les coordonnées GPS dans le tableauMarqueurs
                tableauMarqueurs.push({
                    lat: org.lat,
                    lng: org.long,
                    popup: org.nom

                });
                appendOrganisateur(org);




        });
    });
    $('#loading').hide();
}


function getNbEvenementsParThemes(){
    
    $.ajax({
        url : urlNbEvenementParThemes,
        async : false,
        dataType: 'json',
        success : function(data){
            themes = data.themes;
        }
    });
//    
    $(themes).each(function (i, theme) {
        
        appendListeThemeHome(theme);
    });

}


/**
 * Récupère les labels des themes passés en parametres 
 * @param {type} strId
 * @returns {liste}
 */
function getThemesEvenement(strId){

    var liste = new Array();
    
    if(strId === null || strId === ""){
        liste["#"] = "pas de theme identifié";
    }else{
        
        // retrait de la dernière virgule s'il y en a une
//        ln = strId.length;
//        dernierCaractere = strId.substring(ln -1, ln);
//        if(dernierCaractere === ","){strId =  strId.substring(0, ln - 1);}
        var url = urlThemes+strId;
        console.log("service.js - getThemesEvenement - l335 - ["+url+"]");
        $.ajax({
            url : url,
            async : false,
            dataType: 'json',
            success : function(data){
                themes = data.themes;
            }
        });
        
        $(themes).each(function (i, theme) {
            cle = theme.id;
            valeur = theme.nom;
            liste[cle] = valeur;
        });

    }
    return liste;
}


/**
 * Récupère les labels des types passés en parametres 
 * @param {type} strThemes
 * @returns {liste}
 */
function getTypeEvenement(strId){
//    strId = "";
    var liste= new Array();
    
    if(strId === null || strId === ""){
        liste["#"] = "Type non défini";
    }else{
        
        // retrait de la dernière virgule s'il y en a une
        ln = strId.length;
        dernierCaractere = strId.substring(ln -1, ln);
        if(dernierCaractere === ","){strId =  strId.substring(0, ln - 1);}

        var url = urlTypesEvenement+strId;
        
        $.ajax({
            url : url,
            async : false,
            dataType: 'json',
            success : function(data){
                    types = data.types;
            }
        });
        
        $(types).each(function (i, type) {
            cle = type.id;
            valeur = type.nom;
            liste[cle] = valeur;
        });

    }
    return liste;
}


/**
 * Change le nombre d'item par page
 */
function modifyNbItemParPage(){
    $('#currentPage').val(1);

    pageEvenements(true,false);
}

