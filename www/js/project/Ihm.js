/**
 * Ecrit les éléments d'une liste de checkbox
 * @param {String} cssId - du div qui contiendra les valeurs
 * @param {String} id - valeur de l'item (value)
 * @param {String} value - Valeur à afficher
 * @param {String} fieldName - name du champ
 * @returns {void}
 */
function appendSelectList(cssId, id, value,fieldName){

    var h  = '<label>';
        h += '<input type="checkbox" value="'+id+'" name="'+fieldName+'[]"> '+value;
        h += '</label>&nbsp;';

    $('#'+cssId).append(h);
}

/**
 * Ecriture de l'événement dans la page de détail
 * @param {type} event
 * @returns {undefined}
 */
function appendOrganisateur(org) {
    console.log('rentre dans appendOrganisateur');
    //var listeThemes = getThemesEvenements(event.themes);



    var img = org.image;
    if(img === '' || !img){img = 'default_lieux.png'; }

    var h= "<div class='row '>";
    h += '      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 " >';
    h += '          <img src="imgData/Lieu/'+img+'" class="img-responsive"/>';
    h += '      </div>';

    h += '           <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 ">';
    h += '              <div class="evenement_titre row">'+org.nom.toUpperCase()+'</div>';
    h += '              <div class="evenement_description row">';
    h += '                  <p class="evenement_lieu">'+org.ville+'</p>';
    h += '              </div>';
    h += '          </div>';
    h += ' </div>';
    $('#Item').append(h);

}

/**
 * Ecriture de l'événement dans la page de détail
 * @param {type} event
 * @returns {undefined}
 */
function appendEvenement(event) {
    
    var listeThemesHtml = createListThemes("","","theme_evenement",event.themes);
    var formatedDebut = formatTime(event.debut,"text");
    var formatedFin = formatTime(event.fin,"text")
    
    var img = event.image;
    if(img === '' || !img){img = 'default_evenements.png'; }

    var hebergement = event.hebergement;
    if(hebergement === 1){hebergement = 'Hébergement sur place';}
    else{hebergement = "Pas d'hébergement sur place";}
    
    
//    var hiddenFormInfos = "<input type='hidden' name='organisateur-evenement-email' value='"+event.mail+"'/>";
//    hiddenFormInfos += "<input type='hidden' name='organisateur-evenement-titre' value='"+event.titre+"'/>";
//    hiddenFormInfos += "<input type='hidden' name='organisateur-evenement-dates' value='"+formatDate(event.debut,"numerique")+" - "+formatDate(event.fin,"numerique")+"'/>";
//    hiddenFormInfos += "<input type='hidden' name='organisateur-evenement-ville' value='"+event.ville+"'/>";
    
    var hiddenFormInfos = "<input type='hidden' name='organisateur-evenement-id' value='"+event.id+"'/>";
    
    
    $('#evenement-ville').append(event.ville);
    $('#evenement-titre').append(event.titre);
    $('#evenement-type').append(event.type_nom);
    $('#evenement-description').append(event.description);
    $('#evenement-informations-complementaires').append(event.prix);
    $('#evenement-inscription-contact').append(event.inscription);
    $('#evenement-date-debut').append(formatDate(event.debut,"numerique"));
    $('#evenement-date-fin').append(formatDate(event.fin,"numerique"));
    $('#evenement-time-debut').append(formatedDebut.date+" à "+formatedDebut.time);
    $('#evenement-time-fin').append(formatedFin.date+" à "+formatedFin.time);
    $('.evenement-mail').append('<a href="mailto:'+event.mail+'">'+event.mail+'</a>');
    $('#evenement-web').append('<a href="'+event.url+'"  target="_blank">'+event.url+'</a>');
    $('#evenement-tel').append(event.tel);
    $('#evenement-adresse').append(event.adresse1+"<br/>"+event.adresse2+"<br/>"+event.cp+"<br/>"+event.ville+"<br/>"+event.pays+"<br/>");
    $('#evenement-image').append('<img src="imgData/Evenement/'+img+'" class="img-responsive" width="100%"/>');
    $('#evenement-inscription').append(event.contact);
    $('#evenement-hebergement').append(hebergement);
    $('#evenement-intervenants').append(event.intervenants);
    $('#evenement-liste-themes').append(listeThemesHtml);
    
    $('#evenement-hidden-form-infos').append(hiddenFormInfos);
    
    //$('#evenement-covoiturage').append(widgetCovoiturage("passager",event.ville)+widgetCovoiturage("conducteur",event.ville));
    pageHome();
    
}

// --------------------------------------------------- HOME PAGE

function removeEvenementHome(){
    $('#listeEvenements div').remove();
}

function removeItems(idDivParent){
    $(idDivParent+' div').remove();
}

/**
 * Ecriture de la liste d'événements en Home Page
 * @param {type} event
 * @returns {undefined}
 */
function appendEvenementHome(event) {
   
   

    var img = event.image;
    if(img === '' || !img){img = 'default_evenements.png'; }


    var h = '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 vignette" ><a href="index.php?page=evenement&id='+event.id+'">';

    h += '          <div class="row  hidden-xs vignette_image">';
    h += '              <img src="imgData/Evenement/'+img+'" class="img-responsive"/>';
    h += '          </div>';
    h += '          <div class="hidden-lg hidden-md hidden-sm col-sm-6 col-xs-6 vignette_image">';
    h += '              <img src="imgData/Evenement/'+img+'" class="img-responsive row"/>';
    h += '          </div>';


// CAPTION POUR SMALL
    h += '           <div class="hidden-lg hidden-md hidden-sm col-sm-6 col-xs-6 vignette_caption_small">';
    h += '              <div class="vignette_titre row">'+event.titre.toUpperCase()+'</div>';
    h += '              <div class="vignette_description row">';
    h += '                  <p class="vignette_date">du '+formatDate(event.debut,"numerique")+' au '+formatDate(event.fin,"numerique")+'</p>';
    h += '                  <p class="vignette_lieu">'+event.ville+'</p>';
    h += '              </div>';
    h += '          </div>';

// CAPTION POUR LARGE
    h += '           <div class=" hidden-xs vignette_caption_large">';
    h += '              <h2 class="vignette_titre">'+event.titre.toUpperCase()+'</h2>';
    h += '              <div class="vignette_description">';
    h += '                  <p class="vignette_date">du '+formatDate(event.debut,"numerique")+' au '+formatDate(event.fin,"numerique")+'</p>';
    h += '                  <p class="vignette_lieu">'+event.ville+'</p>';
    h += '              </div>';
    h += '          </div>';
    h += '     </a></div>';


    $('#listeEvenements').append(h);


}

function appendListeThemeHome(theme){
    var h ="<li class='label theme_home'><a href='"+theme.id+"'>"+theme.nom+" <span class='badge'>"+theme.nb+"</span></a></li>";
    $('#home-list-themes').append(h);
}

/**
 * Ecriture de la liste d'événements en Home Page
 * @param {organisateur} org
 * @returns {null}
 */
function appendOrganisateurHome(org) {
   
    var img = org.image;
    if(img === '' || !img){img = 'default_lieux.png'; }
    console.log(org.image);
    
    var h = '<li class="panel row"><a href="index.php?page=organisateur&id='+org.id+'">';
                                    
    h += '    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">';
    h += '        <img src="imgData/Lieu/small/small_'+img+'" class="img-responsive" />';
    h += '    </div>';
    h += '    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">';

    h += '            <h3>'+org.nom+'<small>  - '+org.ville+'  ('+org.cp+')</small></h3>';
    h += '            <p>Prochain événement dans : '+org.nbjours+' jours</p>';
    h += '            <p class="row text-right"><a href="index.php?page=organisateur&id='+org.id+'">En savoir plus</a>&nbsp;|&nbsp;<a href="index.php?page=evenements">Voir les événements</a></p>';

    h += '    </div>';


    h += '</a></li>';


    $('#listeOrganisateurs').append(h);


}
// ---------------------------------------------------/HOME PAGE

function appendEvenementsDate(date){
    $('#listeEvenements').append("<a name='"+date+"'></a><h3 class='monthTitle'>"+date+"</h3>");
    
}

function appendEvenementsListeOrder(listeDate){
    var h = "";
    $(listeDate).each(function (i, date) {
        h += "<li class='list-group-item'><a href='#"+date+"'>"+date+"</a></li>";
    });
                
    $('#listeOrder').append(h);
}

/**
 * Ecriture de la liste d'événements dans la page evenements
 * @param {type} event
 * @returns {undefined}
 */
function appendEvenements(event) {
   
   
   
    var img = event.image;
    if(img === '' || !img){img = 'default_evenements.png'; }

    var h= "<div class='row vignette'><a href='index.php?page=evenement&id="+event.id+"'>";
    h += '      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 " >';
    h += '          <img src="imgData/Evenement/'+img+'" class="img-responsive"/>';
    h += '      </div>';

    h += '           <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 vignette_caption_small">';
    h += '              <div class="vignette_titre row">'+event.titre.toUpperCase()+'</div>';
    h += '              <div class="vignette_description row">';
    h += '                  <p class="vignette_date">du '+formatDate(event.debut,"numerique")+' au '+formatDate(event.fin,"numerique")+'</p>';
    h += '                  <p class="vignette_lieu">'+event.ville+'</p>';
    h += '              </div>';
    h += '          </div>';
    h += ' </a></div>';
    $('#listeEvenements').append(h);

}

/**
 * Ecriture de la liste d'événements dans la page evenements
 * @param {type} event
 * @returns {undefined}
 */
function appendOrganisateurs(org) {

    var img = org.image;
    if(img === '' || !img){img = 'default_lieux.png'; }

    var h= "<div class='row vignette'><a href='index.php?page=organisateur&id="+org.id+"'>";
    h += '      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 " >';
    h += '          <img src="imgData/Lieu/'+img+'" class="img-responsive"/>';
    h += '      </div>';

    h += '           <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 vignette_caption_small">';
    h += '              <div class="vignette_titre row">'+org.nom.toUpperCase()+'</div>';
    h += '              <div class="vignette_description row">';
    h += '                  <p class="vignette_lieu">'+org.ville+'</p>';
    h += '              </div>';
    h += '          </div>';
    h += ' </a></div>';
    $('#listeItems').append(h);
}

/**
 * Créer une liste de vignette en fonction des themes passées en parametres
 * @param {String} idUl
 * @param {String} classUl
 * @param {String} classLi
 * @param {array} liste (valeur,href)
 * @returns {html}
 */
function createListThemes(idUl, classUl, classLi, liste){
    
    var listeTheme = getThemesEvenement(liste);
    console.log("createListThemes- "+listeTheme);
    var h = "";
    h += "<ul class='list-inline list-unstyled "+classUl+"' id='"+idUl+"'>";
    
    for(var cle in listeTheme){
        h += "<li class='label "+classLi+"'><a href='"+cle+"'>"+listeTheme[cle]+"</a></li>";
    }
    h += "</ul>";
    return h;
}

