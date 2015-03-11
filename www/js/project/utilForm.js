
// SET LES ELEMENTS DE FORMULAIRE
//var urlThemes = "../rest/themes/*";
//var urlTypes = "../rest/types/*";
/**
 * Ajoute un datePicker aux champs de date
 * @returns {void}
 */
function setDateField(){
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var checkin = $('#start').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
        }
        checkin.hide();
        $('#end')[0].focus();
    }).data('datepicker');
    var checkout = $('#end').datepicker({
        onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkout.hide();
    }).data('datepicker');

}


/**
 * Récupère tous les themes d'événements et utilise la fonction 
 * appendSelectList (Ihm.js) pour écrire
 * @returns {void}
 */
function setListeOrganisateurs(){
    var url = urlOrganisateursResume;
    $.getJSON(url, function (data) {
        $(data.organisateurs).each(function (i, organisateur) {
            appendSelectList('listeOrganisateurs',organisateur.id,organisateur.nom,'organisateurs');
        });
    });

}

/**
 * Récupère tous les themes d'événements et utilise la fonction 
 * appendSelectList (Ihm.js) pour écrire
 * @returns {void}
 */
function setListeThemes(){
    var url = urlThemes + "*";
    $.getJSON(url, function (data) {
        $(data.themes).each(function (i, theme) {
            appendSelectList('listeThemes',theme.id,theme.nom,'themes');
        });
    });

}


/**
 * Récupère tous les types d'événements et utilise la fonction 
 * appendSelectList (Ihm.js) pour écrire
 * @returns {void}
 */
function setListeTypes(){
    var url = urlTypesEvenement + "*";
    
    $.getJSON(url, function (data) { 
        var arr;
        $(data.types).each(function (i, type) {
            arr[type.id] = type.nom;
        });
        html = createListe("types","types", arr);
        appendSelect('listeTypes',html);
    });
    

}

/**
 * Creation d'une liste Select
 * @param {string} id
 * @param {string} name
 * @param {array} arr
 * @returns {html}
 */
function createListe(id,name,arr){
    var html = openSelect(id,name);
    for(var i=0; i < arr.length(); i++){
        html += optionSelect(arr[i][0], arr[i][1]);
    }
    html += closeSelect();
    return html;
}


function openSelect(id,name){
    return "<select name='"+name+"' id='"+id+"'>";
}

function closeSelect(){
    return "</select>";
}

function optionSelect(val,label){
    return "<option value='"+val+"'>"+label+"</option>";
}

/**
 * Fonction générique de génération de select
 * @param {type} data
 * @returns {select|String}
 */
function createSelect(id, name, options){
    console.log(options);
    select = "<select>";
    
    for(var i=0; i < options.length; i++){
        select += "<option value='"+options[i][0]+"'>"+options[i][1]+"</option>";
    }
//    $(options).each(function (i, option) {
//       select += "<option value='"+option[0]+"'>"+option[1]+"</option>";
//    });
    select += "</select>";
    console.log('dans createSelect');
    console.log(select);
    return select;
}

///**
// * Récupère tous les organisateurs d'événements et utilise la fonction 
// * appendSelectList (Ihm.js) pour écrire
// * @returns {void}
// */
function setListeOrganisateurs(){
    //var url = "../rest/organisateurs";
    $.getJSON(urlOrganisateurs, function (data) {
        $(data.organisateurs).each(function (i, organisateur) {
            appendSelectList('search-organisateurs',organisateur.id,organisateur.nom, 'organisateurs');
        });
    });

}



//GET LES ELEMENTS DE FORM


/**
 * Récupère la liste des éléments sélectionnés d'une liste
 * @param {string} cssId
 * @returns {alert}
 */
function recupSelect(cssId){
    var myStr = "";
    $("#"+cssId+" option:selected").each(function () {
        myStr += $(this).val();
    });
    return myStr;
}

/**
 * Récupère la liste des éléments sélectionnés d'une liste
 * @param {string} name
 * @returns {alert}
 */
function recupCheckbox(formName){
    var valeurs = [];
    $('input:checked[name='+formName+']').each(function() {
      valeurs.push($(this).val());
      
    });
    alert(valeurs);
    return valeurs;
}


/**
 * Récupère les informations d'input text
 * @param type (date, mail, text...)
 * @param cssId (Id css de l'input)
 * @returns {*|jQuery}
 */
function recupTextField(cssId){
    return $("#"+cssId).val();
}



/**
 * Récupère les informations du formulaire
 * @returns {void}
 */
function collectForm(){
    var listOrganisateurs = recupSelect('search-organisateurs');
    var listTypes = recupSelect('search-types');
    var listThemes = recupSelect('search-themes');
    var dateDebut = recupTextField('date', 'start');
    var dateDebut = recupTextField('date', 'end');
    var motsCles = recupTextField('text', 'search-motscles');
}


// CONTROLE
$(function() {

//    $("input,textarea").jqBootstrapValidation({
//
//        preventSubmit: true,
//        submitError: function($form, event, errors) {
//            // additional error messages or events
//        },
//        submitSuccess: function($form, event) {
//            event.preventDefault(); // prevent default submit behaviour
//            // get values from FORM
//            
//            var idEvenement, nom, email, tel, objets, objet, msg, optInNewsletter, optInPartenaires = "";
//            nom                 = recupTextField("contact-nom");
//            email               = recupTextField("contact-email");
//            tel                 = recupTextField("contact-phone");
//            objets              = recupCheckbox("objet");
//            msg                 = recupTextField("contact-message");
//            optInNewsletter     = recupCheckbox("newsletter-spibook");
//            optInPartenaires    = recupCheckbox("newsletter-partenaires");
//            idEvenement         = recupCheckbox("organisateur-evenement-id");
//            
//            
//            $(objets).each(function (i, obj) {
//                objet += obj;
//            });
//
//            $.ajax({
//                url: urlAjax,
//                type: "POST",
//                data: {
//                    nom             : nom,
//                    phone           : tel,
//                    objet           : objet,
//                    email           : email,
//                    message         : msg,
//                    optinnewsletter : optInNewsletter,
//                    optinpartenaires: optInPartenaires,
//                    idEvenement     : idEvenement
//                    
//                },
//                cache: false,
//                success: function() {
//                    // Success message
//                    $('#success').html("<div class='alert alert-success'>");
//                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
//                        .append("</button>");
//                    $('#success > .alert-success')
//                        .append("<strong>Your message has been sent. </strong>");
//                    $('#success > .alert-success')
//                        .append('</div>');
//
//                    //clear all fields
//                    $('#contactForm').trigger("reset");
//                },
//                error: function() {
//                    // Fail message
//                    $('#success').html("<div class='alert alert-danger'>");
//                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
//                        .append("</button>");
//                    $('#success > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");
//                    $('#success > .alert-danger').append('</div>');
//                    //clear all fields
//                    $('#contactForm').trigger("reset");
//                }
//            })
//        },
//        filter: function() {
//            return $(this).is(":visible");
//        }
//    });
//
//    $("a[data-toggle=\"tab\"]").click(function(e) {
//        e.preventDefault();
//        $(this).tab("show");
//    });
});


/*When clicking on Full hide fail/success boxes */
$('#name').focus(function() {
    $('#success').html('');
});


function multiselect(idlist){
   $(idlist).multiselect(); 
}