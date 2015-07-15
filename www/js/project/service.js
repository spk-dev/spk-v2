
/* global encodeUR */

/**
 * Construire la liste des événements
 * @returns {null}
 */
function pageHome(){
    pageHomeEvenement(null);
    toutesPagesTypesEvenements(1,"home");
    
    //pageHomeOrganisateurs();
    //getNbEvenementsParThemes();
    //getListeTypesEvenements();
    
}

function pageHomeOrganisateurs(){
    return null;
    var url = urlOrganisateursNextEvent;
    console.log(url);
    $.getJSON(url, function (data) {
        $(data.organisateurs).each(function (i, organisateur) {
            console.log(organisateur);
            appendOrganisateurHome(organisateur);
        });
    });  
    
}


function toutesPagesTypesEvenements(avecEvenement,page){
    removeElementFromDiv("listeTypesEvenements");
    var tous = {id:null,libelle:"Tous"};
    appendTypesEvenements(tous,page);
    
    $.getJSON(urlTypesEvenements+avecEvenement, function (data) {
        $(data.types).each(function (i, type) {
            //console.log(type);
            var type2 = defineTypesEvenement(type);
            
            appendTypesEvenements(type2,page);
        });
    });
}

/**
 * Récupère les événements à afficher sur la home page
 * et affiche la map en conséquence
 **/
function pageHomeEvenement(type){
    tableauMarqueurs.length = 0;
    var url = "";
    if(type===null){
        url = urlEvenements;
      
    }else{
        url = urlEvenements+"?types="+type;
      
    }
    
    removeEvenementHome();
    $('#loading').show();
    
    $.getJSON(url, function (data) {
        $(data.evenements).each(function (i, event) {
            var evenement = defineEvenement(event);
            var debut = evenement.debut;
            var fin = evenement.fin;
            // lister les coordonnées GPS dans le tableauMarqueurs
//            console.log('dans service/pageHomeEvenement');
//            console.log('lat '+evenement.lat);
//            console.log('lng '+evenement.lng);
//            console.log('titre '+evenement.titre);
//            console.log('date '+debut+' - '+fin);
//            console.log('ville '+evenement.ville);
//            console.log('id '+evenement.id);
            
            tableauMarqueurs.push({
               lat     : evenement.lat,
               lng     : evenement.lng,
               titre   : evenement.titre,
               date    : debut+' <br/> '+fin,
               ville   : evenement.ville,
               id      : evenement.id
//                event : evenement
            });
            
            initialisation();
            appendEvenementHome(evenement);
        });
    });
    $('#loading').hide();
}

function sleep(seconds){
    var waitUntil = new Date().getTime() + seconds*1000;
    while(new Date().getTime() < waitUntil) true;
}


/**
 * Construire la liste des événements
 * @returns {null}
 */
function pageEvenements(type){
    tableauMarqueurs.length = 0;
    var url = "";
    if(type===null){
        url = urlEvenements;
      
    }else{
        
        url = urlEvenements+"?"+getParamEvenement();
      
    }

    $('#listeEvenements div').remove();
    $('#loading').show();
    
    formData = $('#formResearch input').serialize();
    //console.log(formData);
//    var url = "";
//    var plural = "";
//
//    url = urlEvenements+"?"+formData;
//    console.log('url : '+url);

    var nbItems;
    var nbItemsParPage;



    $.getJSON(url, function (data) {
        //console.log(data);
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
                //console.log("debut = "+debut);
                
                datedebut = formatDate(debut,"moisAn");
                //datedebut = nomsDesMois[datedebut.getUTCMonth()]+" "+datedebut.getUTCFullYear();
                //console.log("datedebug = "+datedebut);
                
                if($.inArray(datedebut,listDate)<1){
                    listDate.push(datedebut);
                    appendEvenementsDate(datedebut);
                }
                
                // lister les coordonnées GPS dans le tableauMarqueurs
                tableauMarqueurs.push({
                    lat: evenement.lat,
                    lng: evenement.lng,
                    popup: evenement.titre,
                    date: debut + ' <br/> ' + fin,
                    lieu: evenement.ville,
                    id : evenement.id
                });
                appendEvenements(evenement);
//            }



        });
        toutesPagesTypesEvenements(1,"event");
        appendEvenementsListeOrder(listDate);
        //console.log(listDate);
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

    console.log('rentre dans pageOrganisateurs');

    formData = $('#formResearch').serialize();
    var url = "";
    var plural = "";

    url = urlOrganisateurs;
    console.log('url : '+url);

    var nbItems;
    var nbItemsParPage;

    $('#listeItems div').remove();

    $.getJSON(url, function (data) {

        nbItems = data.organisateurs.length;
        nbItemsParPage = $("#nbItemParPage option:selected").val();

        if(nbItems>1){
            plural = "s";
        }
        $("#nbItems").html(nbItems);
        $("#plural").html(plural);

        // Création de la pagination
        if(nbItems > nbItemsParPage && isoCriteres===true) {
            createPagination(nbItems, nbItemsParPage);
        }else{
            removePagination();
        }

        var nbItemsParPage = $("#nbItemParPage option:selected").val();
        var currentPage = $('#currentPage').val();
        var min = (nbItemsParPage * currentPage) - nbItemsParPage;
        var max = (nbItemsParPage * currentPage) - 1;

        $(data.organisateurs).each(function (i, organisateur) {


            if(i >= min && i <= max) {

                var org = defineOrganisateur(organisateur);



                // lister les coordonnées GPS dans le tableauMarqueurs
                tableauMarqueurs.push({
                    lat: org.lat,
                    lng: org.long,
                    popup: org.nom

                });
                appendOrganisateurs(org);
            }



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
    return null;
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

/**
 * setParametre dans les champs
 * @param {type} arrParam
 * @param {type} concat
 * @returns {undefined}
 */
function setParamEvenement(inputId, value ,concat){
    
    var val  = "";
    
    
    if(value === "null"){
        $('#'+inputId).val("");
    }else{
        if(concat === true){
        
            val = $("#"+inputId).val();

            if(val === "-null"){
                $('#'+inputId).val("-"+value);
            }else{


               if(val.search(-value) !== -1){
                   val = val.replace("-"+value,"");
                   $('#'+inputId).val(val);
               }else{
                   $('#'+inputId).val(val+"-"+value);
               }
            }
        }else{
            $('#'+inputId).val("-"+value);
        }
    }
    
    
   
    setParamEvenementStr();
    pageEvenements();
   
      
}


function setParamEvenementStr(){
    var str = "";
    var types =     $('#types').val();
    var mots =      $('#mots').val();
    var datemin =   $('#datemin').val();
    var datemax =   $('#datemax').val();
    var dep     =   $('#dep').val();
    
    if(types !== ""){
        str += "types="+types.substring(1)+"&";
    }
    if(mots !== ""){
        str += "mots="+encodeURIComponent(mots)+"&";
    }
    if(datemin !== ""){
        str += "datemin="+encodeURIComponent(datemin)+"&";
    }
    if(datemax !== ""){
        str += "datemax="+encodeURIComponent(datemax)+"&";
    }
    if(dep !== ""){
        str += "dep="+(dep)+"&";
    }
    $('#search').val(str);
    
    
    
}

function getParamEvenement(){
    return $('#search').val();
}