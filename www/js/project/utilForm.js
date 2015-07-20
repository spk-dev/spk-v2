
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
 * Récupère tous les organisateurs d'événements et utilise la fonction 
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
        $(data.types).each(function (i, type) {
            appendSelectList('listeTypes',type.id,type.nom,'types');
        });
    });

}

///**
// * Récupère tous les organisateurs d'événements et utilise la fonction 
// * appendSelectList (Ihm.js) pour écrire
// * @returns {void}
// */
//function setListeOrganisateurs(){
//    //var url = "../rest/organisateurs";
//    $.getJSON(urlOrganisateurs, function (data) {
//        $(data.organisateurs).each(function (i, organisateur) {
//            appendSelectList('search-organisateurs',organisateur.id,organisateur.nom, 'organisateurs');
//        });
//    });
//
//}



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

});


/*When clicking on Full hide fail/success boxes */
$('#name').focus(function() {
    $('#success').html('');
});

function loadAreaListes(listType,arrParam){
    switch(listType){
        case "pays":
            $.getJSON(urlPays, function (data) {
                $(data.pays).each(function (i, pays) {
                    var pays = {
                        id          : pays.pla_var_pays,
                        libelle     : pays.pla_var_pays
                    }
                    if(pays.id !== ""){
                        h = "<option value='"+pays.id+"'>"+pays.libelle+"</option>";
                        $('#listePays').append(h);
                    }
                    
                });
            });
            break;
        case "area1":
            $('#listeArea1 option').remove();
            $('#listeArea1 optgroup').remove();
            if(typeof(arrParam['pays']) !== 'undefined' ){
                console.log('rentre dans area1');
                var pays = arrParam['pays'];
                h = "<option disabled='disabled' selected='selected'>Selectionner...</option><optgroup label='"+pays+"'>";
                $('#listeArea1').append(h);
                $.getJSON(urlArea1+pays, function (data) {
                    
                    $(data.area1).each(function (i, area1) {
                        var area1 = {
                            id          : area1.pla_var_area1,
                            libelle     : area1.pla_var_area1
                        }
                        if(area1.id !== ""){
                            h = "<option value='"+area1.id+"'>"+area1.libelle+"</option>";
                            $('#listeArea1').append(h);
                        }

                    });
                });
                h = "</optgroup>";
                $('#listePays').append(h);
            }else{
                console.log('rentre pas dans area1');
            }
            
            
            break;
        case "area2":
            $('#listeArea2 option').remove();
            $('#listeArea2 optgroup').remove();
            if(typeof(arrParam['area1']) !== 'undefined' ){
                console.log('rentre dans area2');
                var area1 = arrParam['area1'];
                h = "<option disabled='disabled' selected='selected'>Selectionner...</option><optgroup label='"+area1+"'>";
                $('#listeArea2').append(h);
                $.getJSON(urlArea2+area1, function (data) {
                    console.log(urlArea2+area1);
                    $(data.area2).each(function (i, area2) {
                        var area2= {
                            id          : area2.pla_var_area2,
                            libelle     : area2.pla_var_area2
                        }
                        if(area2.id !== ""){
                            h = "<option value='"+area2.id+"'>"+area2.libelle+"</option>";
                            $('#listeArea2').append(h);
                        }

                    });
                });
                h = "</optgroup>";
                $('#listePays').append(h);
            }else{
                console.log('rentre pas dans area1');
            }
            break;
    }
}


$( document ).ready(function() {
   
   loadAreaListes('pays',null);

});
