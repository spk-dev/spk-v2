<?php
$titre = "";
$dateDebut = "";
$dateFin = "";
$description = "";
$prix = "";
$hebergement = "";
$garderie = "";
$contact = "";
$mail = "";
$themes = array();
$intervenants = array();
$photo = "";

?>


<div class="row">    
    
   
    <div class="twelve columns">
        

        
        <?php
        if(isset($_GET['modifId'])){
            $idEvenement = $_GET['modifId'];
            
            $evenement = EvenementAction::getEvenement($idEvenement, true);
            $currentLieu =  LieuAction::recupererUnLieu($evenement->getLieu(), true);
            
           // ON VERIFIE SI L'ID SAISI DANS EN GET CORRESPOND BIEN A UNE RETRAITE / LIEU DONT LE CURRENTADMIN EST BIEN ADMINISTRATEUR 
           if(UtilSession::getSessionAdminId()==$currentLieu->getAdmin()){
//            
                $titre = $evenement->getNom();
                $dateDebut = $evenement->getDateDebut();
                $dateFin = $evenement->getDateFin();
                $prix = $evenement->getPrix();
                $description = $evenement->getDescription();
                $hebergement = $evenement->getHebergement();
                $garderie = $evenement->getGarderie();
                $contact = $evenement->getCoordInscription();
                $mail = $evenement->getMailInscription();   
                $themes = $evenement->getTheme();
                $intervenants = $evenement->getIntervenants();
                $photo = $evenement->getMainPhoto();
                $type = $evenement->getTypeEvenement();
                
            ?>
            <form action="<?php echo $_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText("MenuAdminRetraitesLien");?>" method="POST" enctype="multipart/form-data">
               
                
                <input type='hidden' name='retraite-action' value='modif'/>
                <input type="hidden" name="retraite-int-id" value="<?php echo $idEvenement; ?>"/>
                <input type="hidden" name="retraite-int-lieu" value="<?php echo $currentLieu->getId(); ?>"/>
                <div class="seven columns">
                    <div class="twelve columns panel">
                        <h3 class="subheader">
                            <?php echo $titre; ?>
                        </h3>
                    </div>
                    <div class="twelve columns panel">
                        <h4>Informations générales</h4>
                        <label class='labelAdmin' for="retraite_list_types"><span class="has-tip tip-right" data-width="350" title="Vous pouvez sélectionner plusieurs types">Type d'événement</span></label>
                        <?php echo HtmlFormComponents::SelectTypeEvenements("retraite_list_types", "listeType", 6, "contactItem twelve", 0, array($type), false); ?>
                        <label class='labelAdmin' for="retraite-text-nom">Titre de la retraite </label>
                        <input type="text" name="retraite-text-nom" id="nom" class="contactItem contactField" value="<?php echo $titre; ?>"/>
                        <label class='labelAdmin' for="retraite-date-debut">Date d&eacute;but </label>
                        <input type="text" name="retraite-date-debut" id="date_deb" class="contactItem contactField" value="<?php echo $dateDebut; ?>"/>
                        <label class='labelAdmin' for="retraite-date-fin">Date fin </label>
                        <input type="text" name="retraite-date-fin" id="date_fin" class="contactItem contactField" value="<?php echo $dateFin; ?>"/>
                        <label class='labelAdmin' for="retraite-number-prix">Prix</label>
                        <input type="text" name="retraite-number-prix" id="prix" class="contactItem contactField" value="<?php echo $prix; ?>"/>
                    </div>
                     <div class="twelve columns panel">
                        <h4>Description</h4>
                        <label class='labelAdmin' for="retraite-html-description">Description</label>
                        <div class='contentWysiwyg'>
                            <textarea name="retraite-html-description" id="description" class="contactItem contactTextArea">
                                <?php echo $description; ?>
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="five columns">
                    <div class="twelve columns panel">
                        <h4>Informations particulières</h4>
                        <label class='labelAdmin' for="retraite-check-hebergement">H&eacute;bergement</label>
                        <?php
                            $checked = "";
                            if($hebergement==1){
                                $checked = "checked";
                            }
                        ?>
                        <input type="checkbox" name="retraite-check-hebergement" id="Hebergement"value="1" <?php echo $checked; ?>/>
                        <label class='labelAdmin' for="retraite-check-garderie">Garderie</label>
                        <?php
                            $checked = "";
                            if($garderie==1){
                                $checked = "checked";
                            }
                        ?>
                        <input type="checkbox" name="retraite-check-garderie" id="Garderie"value="1" <?php echo $checked; ?>/>
                    </div>
                    <div class="twelve columns panel">
                        <h4>Contact</h4>
                        <label class='labelAdmin' for="retraite-html-contact">Contact inscription</label>
                        <div class='contentWysiwyg'>
                            <textarea name="retraite-html-contact" id="contactInscription" class="contactItem">
                                <?php echo $contact; ?>
                            </textarea>
                        </div>
                        <label class='labelAdmin' for="retraite-mail-mail">Mail</label>
                        <input type="text" name="retraite-mail-mail" id="mail" class="contactItem contactField" value="<?php echo $mail; ?>"/>
                    </div>
                    <div class="twelve columns panel">
                        <h4>Themes & Intervenants</h4>
                        <label class='labelAdmin' for="retraite-list-themes">Themes</label>

                        <?php
                            echo HtmlFormComponents::SelectThemeWithSelectedValue("retraite-list-themes[]", "listeTheme", 7, "twelve", 1, $themes);
                        ?>
                        <label class='labelAdmin' for="retraite-list-intervenants">Intervenants</label>
                        <?php 
                            echo HtmlFormComponents::SelectIntervenantsWithSelectedValue("retraite-list-intervenants[]", "listeIntervenants", 7, "twelve", 1, $intervenants);
                        ?>
                    </div>
                    <a href="#" data-reveal-id="divAddIntervenant">L'intervenant que vous recherchez n'est pas dans la liste, ajoutez le. </a>
                    <div class="twelve columns panel">
                        <h4>Image</h4>
                            <?php $img = HtmlUtilComponents::imageControl("evenements", $photo,0); ?>
                            <img src="<?php echo $img;?>" title='<?php echo $titre; ?>' alt='<?php echo $titre; ?>' class='right' />

                            <input type="file" name="data-file-photo" id="mainPhoto" value="" />
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





        </div>
        <!-- FIN MAIN CONTENT SECTION--> 

    <?php 
           }else{
               echo "<h1>ATTENTION, VOUS N'ETES PAS ADMINISTRATEUR DE LA RETRAITE IDENTIFIEE</h1>";
           }
                            } ?>

        
        <?php include('../page_admin/manageIntervenant.php'); ?>
        <script type="text/javascript" src="adminJavascripts/manageEvenement.js">
//
//
//            var startDateTextBox = $('#date_deb');
//            var endDateTextBox = $('#date_fin');
//
//            startDateTextBox.datetimepicker({ 
//                    addSliderAccess: true,
//                    sliderAccessArgs: { touchonly: false },
//                    timeFormat: 'HH:mm:ss',
//                    stepHour: 1,
//                    stepMinute: 15,
//                    dateFormat: "yy-mm-dd",
//                    onClose: function(dateText, inst) {
//                            if (endDateTextBox.val() != '') {
//                                    var testStartDate = startDateTextBox.datetimepicker('getDate');
//                                    var testEndDate = endDateTextBox.datetimepicker('getDate');
//                                    if (testStartDate > testEndDate)
//                                            endDateTextBox.datetimepicker('setDate', testStartDate);
//                            }
//                            else {
//                                    endDateTextBox.val(dateText);
//                            }
//                    },
//                    onSelect: function (selectedDateTime){
//                            endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
//                    }
//            });
//            endDateTextBox.datetimepicker({ 
//                    addSliderAccess: true,
//                    sliderAccessArgs: { touchonly: false },
//                    timeFormat: 'HH:mm:ss',
//                    stepHour: 1,
//                    stepMinute: 15,
//                    dateFormat: "yy-mm-dd",
//                    onClose: function(dateText, inst) {
//                            if (startDateTextBox.val() != '') {
//                                    var testStartDate = startDateTextBox.datetimepicker('getDate');
//                                    var testEndDate = endDateTextBox.datetimepicker('getDate');
//                                    if (testStartDate > testEndDate)
//                                            startDateTextBox.datetimepicker('setDate', testEndDate);
//                            }
//                            else {
//                                    startDateTextBox.val(dateText);
//                            }
//                    },
//                    onSelect: function (selectedDateTime){
//                            startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
//                    }
//            });
//
//
//            bkLib.onDomLoaded(function() {
//                    new nicEditor({buttonList : ['fontFormat','bold','italic','underline','left','center','right','justify','ol','ul','strikeThrough','indent','outdent','hr','removeformat','link','unlink','html'], maxHeight : 300}).panelInstance('description');
//                    new nicEditor({buttonList : ['fontFormat','bold','italic','underline'], maxHeight : 100}).panelInstance('contactInscription');
//            });
//
//        $("#listeIntervenants").select2({
//           
//        });
//  
//        $("#listeTheme").select2({
//           
//        });


        </script>