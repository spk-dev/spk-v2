<?php

$redfields['type']="";
$redfields['titre']="";
$redfields['datedebut']="";
$redfields['datefin']="";
$redfields['description']="";
$redfields['themes']="";

?>
<div class="row">    
    
    
    
   
    <div class="twelve columns">
        <?php
            $action="";
            if(isset($_GET['action'])){
               $action = $_GET['action'];
            }

        ?>
    </div>
    <div class="twelve columns">
        
        
        <?php
            if(isset($_GET['idLieu'])){
        ?>
        <form action="<?php echo $_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText("MenuAdminRetraitesLien");?>" method="POST" enctype="multipart/form-data">
            <input type='hidden' name='retraite-action' value='add'/>
            <div class="seven columns">
                <div class="twelve columns panel">
                    <h5><?php echo LieuAction::recupererUnLieu($_GET['idLieu'], true)->getNom(); ?></h5>
                    <input type="hidden" name="retraite-int-lieu" value="<?php echo $_GET['idLieu']; ?>"/>
                </div>
                <div class="twelve columns panel">
                    
                    
                    <h4>Informations générales</h4>
                    <label class='labelAdmin' for="retraite_list_types"><span class="has-tip tip-right" data-width="350" title="Vous pouvez sélectionner plusieurs types">Type d'événement *</span></label>
                    <?php echo HtmlFormComponents::SelectTypeEvenements("retraite_list_types", "listeType", 6, "contactItem twelve", 0, null, false); ?>
                    <label class='labelAdmin' for="retraite-text-nom"><span class="has-tip tip-right" data-width="350" title=" ** Conseil **<br/><br/>Privilégiez un titre court et clair.">Titre de l'événement *</label>
                    <input type="text" name="retraite-text-nom" id="nom" class="contactItem contactField"/>
                    <label class='labelAdmin' for="retraite-date-debut">Date de début *</label>
                    <input type="text" name="retraite-date-debut" id="date_deb" class="contactItem contactField"/>
                    <label class='labelAdmin' for="retraite-date-fin">Date de fin *</label>
                    <input type="text" name="retraite-date-fin" id="date_fin" class="contactItem contactField"/>
                    <label class='labelAdmin' for="retraite-number-prix"><span class="has-tip tip-right" data-width="350" title="<b>A savoir</b><br/><br/><br/>Si le prix est fixe, inscrivez le sans le symbole €<br/><br/>Vous pouvez également écrire un texte expliquant les différents prix possible, le cas échéant.<br/><br/>Ne rien inscrire ici si l'événement est gratuit.<br/><br/>">Prix</span></label>
                    <input type="text" name="retraite-number-prix" id="prix" class="contactItem contactField"/>
                </div>
                 <div class="twelve columns panel">
                    <span class="has-tip tip-right" data-width="350" title="A savoir<br/>La description est importante. Prenez le temps d'apporter le plus de détail possible. <br/><br/>">
                        <h4>Description </h4>
                        <label class='labelAdmin' for="retraite-html-description">Description *</label></span>
                    <div class='contentWysiwyg'>
                        <textarea name="retraite-html-description" id="description" class="contactItem contactTextArea"></textarea>
                    </div>
                </div>
            </div>
            <div class="five columns">
                <div class="twelve columns panel">
                    <h4>Informations particulières</h4>
                    <span class="has-tip tip-left" data-width="350" title="Si vous proposez une solution sur place, cocher cette case.<br/><br/>Vous pouvez apporter des informations complémentaires sur cette solution d'hébergement dans la description."><label class='labelAdmin' for="retraite-check-hebergement">H&eacute;bergement</label>
                        <input type="checkbox" name="retraite-check-hebergement" id="Hebergement"value="1" /></span>
                    <span class="has-tip tip-left" data-width="350" title="Votre événement peut intéresser des familles ? <br/><br/>Vous avez prévue une solution de garde d'enfant pour permettre à ces familles d'y participer, cochez cette case.">
                    <label class='labelAdmin' for="retraite-check-garderie">Garderie</label>
                    <input type="checkbox" name="retraite-check-garderie" id="Garderie"value="1" /></span>
                </div>
                <div class="twelve columns panel">
                    <h4>Contact</h4>
                    <span class="has-tip tip-left" data-width="350" title="Préciser ici la manière de vous contacter (Tel, mail)<br/><br/>S'il y a des coordonnées spécifiques pour cet événement, différentes de vos coordonnées 'organisateur', précisez les ici.">
                        <label class='labelAdmin' for="retraite-html-contact">Contact inscription</label></span>
                    <div class='contentWysiwyg'>
                        <textarea name="retraite-html-contact" id="contactInscription" class="contactItem "></textarea>
                    </div>
                    <span class="has-tip tip-left" data-width="350" title="Pour faciliter le contact, merci de rappeler ici l'email de contact pour cet événement">
                        <label class='labelAdmin' for="retraite-mail-mail">Mail</label></span>
                    <input type="text" name="retraite-mail-mail" id="mail" class="contactItem contactField" value=""/>
                </div>
                <div class="twelve columns panel">
                   
                       <h4>Themes & Intervenants</h4>
                        <span class="has-tip tip-left" data-width="350" title="Vous pouvez choisir plusieurs thèmes. Sélectionner tous les thèmes relatifs à votre événement">
                            <label class='labelAdmin' for="retraite-list-theme">Themes *</label>
                        </span>
                    <?php
                        echo HtmlFormComponents::SelectThemeWithSelectedValue("retraite-list-themes[]", "listeTheme", 7, "twelve", 1, null);
                    ?>
                    <br/>
                    <span class="has-tip tip-left" data-width="350" title="Si votre événement fait appel à une ou plusieurs personnes bien particulière, il vous est possible de les ajouter ici. Concernant les retraites, pèlerinage... les internautes pourraient être amenés à rechercher les interventions d'une personne en particulier.">
                        <label class='labelAdmin' for="retraite-list-intervenants">Intervenants *</label></span>
                    <div id='divlistIntervenants'>
<!--                        <select id="listeIntervenants" name="retraite-list-intervenants[]" class="twelve" multiple="multiple"></select>-->
                        <?php 
                            echo HtmlFormComponents::SelectIntervenantsWithSelectedValue("retraite-list-intervenants[]", "listeIntervenants", 7, "twelve", 1, null);
                        ?>
                    </div>
                    <a href="#" data-reveal-id="divAddIntervenant">L'intervenant que vous recherchez n'est pas dans la liste, ajoutez le. </a>

                    
                </div>
                <div class="twelve columns panel">
                    <h4>Image</h4>
                    <span class="has-tip tip-top" data-width="350" title="<br/>l'image est un élément essentiel pour la visibilité de votre événement<br/><br/><br/>Choisissez en une éloquente.<br/><br/>Pour des raisons de qualité, la taille de l'image ne doit pas être inférieure aux dimensions suivantes :<br/>520 px par 260 px"> 
                        <label class='labelAdmin' for="data-file-photo">Photo</label>
                        <input type="file" name="data-file-photo" id="mainPhoto" value="" />
                    </span>
                </div>
            </div>


            <div class="twelve columns">
                 <div class="twelve columns panel">
                    <h4>Validation</h4>
                     <input class='button' type="submit" value="ok" name="retraite-submit"/>
                    <input class='button' type="reset" value="reset"/>
                </div>  
            </div>


        </form>

    </div>
            

        <input type="text" name="addedIntervName" id="addedInterv" value=""/>
         
         
    </div>
    <!-- FIN MAIN CONTENT SECTION--> 
    
    <?php include('../page_admin/manageIntervenant.php'); ?>

    
        <script type="text/javascript" src="adminJavascripts/manageEvenement.js">
  
      //Fenetre modal ajout Intervenant  
//     $(document).ready(function() {
//        $("#addIntervenantLink").click(function() {
//          $("#addIntervenantForm").reveal();
//        });
//      });
    
//    
//    
//    /* TIMEPICKER */
//    
//    var startDateTextBox = $('#date_deb');
//    var endDateTextBox = $('#date_fin');
//
//    startDateTextBox.datetimepicker({ 
//        addSliderAccess: true,
//        sliderAccessArgs: { touchonly: false },
//        timeFormat: 'HH:mm:ss',
//        stepHour: 1,
//        stepMinute: 15,
//        dateFormat: "yy-mm-dd",
//        onClose: function(dateText, inst) {
//                if (endDateTextBox.val() != '') {
//                        var testStartDate = startDateTextBox.datetimepicker('getDate');
//                        var testEndDate = endDateTextBox.datetimepicker('getDate');
//                        if (testStartDate > testEndDate)
//                                endDateTextBox.datetimepicker('setDate', testStartDate);
//                }
//                else {
//                        endDateTextBox.val(dateText);
//                }
//        },
//        onSelect: function (selectedDateTime){
//                endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
//        }
//    });
//    endDateTextBox.datetimepicker({ 
//        addSliderAccess: true,
//        sliderAccessArgs: { touchonly: false },
//        timeFormat: 'HH:mm:ss',
//        stepHour: 1,
//        stepMinute: 15,
//        dateFormat: "yy-mm-dd",
//        onClose: function(dateText, inst) {
//                if (startDateTextBox.val() != '') {
//                        var testStartDate = startDateTextBox.datetimepicker('getDate');
//                        var testEndDate = endDateTextBox.datetimepicker('getDate');
//                        if (testStartDate > testEndDate)
//                                startDateTextBox.datetimepicker('setDate', testEndDate);
//                }
//                else {
//                        startDateTextBox.val(dateText);
//                }
//        },
//        onSelect: function (selectedDateTime){
//                startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
//        }
//    });
//
//
//    /* EDITEUR WYSIWYG */
//    bkLib.onDomLoaded(function() {
//            new nicEditor({buttonList : ['fontFormat','bold','italic','underline','left','center','right','justify','ol','ul','strikeThrough','indent','outdent','hr','removeformat','link','unlink','html'], maxHeight : 300}).panelInstance('description');
//            new nicEditor({buttonList : ['fontFormat','bold','italic','underline'], maxHeight : 100}).panelInstance('contactInscription');
//    });
//        
//      
//        $("#listeIntervenants").select2({
//           
//        });
//  
//        $("#listeTheme").select2({
//           
//        });
//        
//        
//        /**
//         * TEST JQUERY LISTE INTERVENANT
//         * @returns {undefined}
//         */
//       function populateIntervenantSelect(){
//            $.get('../services/AjaxAction.class.php?loadIntervenantListe=1', function(data) {
//
//                // On recupere du HTML donc on l'insere "as-is" dans la page
//                $('#divlistIntervenants').html('').html(data);
//
//              });
//        } 
//        
//        function remplirListeIntervenant(id){
//            alert("valeur id : "+id);
//            $.getJSON('ajaxManagement.php?loadIntervenantListe=1', function(data) {
//
//            // Construction d'une liste contenant les donnees JSON
//            var output = "";
//            var selected="";
////            var addedInterv = document.getElementById("currentInterv").value;
//            // On passe en revue les cles et valeurs une a une
//            $.each(data, function(key, value) {
//                if(id === key){
//                    selected = "selected";
//                }
//              output += "<option value=" + key + " " + selected + ">" + value +"</option>";
//              selected="";
//            }); 
//
//            // Enfin on insere la liste dans la page
//            
//            $('#listeIntervenants').html('').html(output);
//
//            });
//
//            }
//            
//  
    </script>
    
    <?php 
            }
    ?>