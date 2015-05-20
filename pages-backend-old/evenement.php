


<?php     
$creationEvenement = false;
    
if(UtilSession::isSessionLoaded()){

    $currentAdmin = AdministrateurAction::getAdministrateur(UtilSession::getSessionAdminId());
    $listeIdLieu = $currentAdmin->getLieux();
    $multi = true;
    if(count($listeIdLieu)<2){
        $multi = false;
        $idLieu = $listeIdLieu[0];
    }
    $simple = "#simple1";
    $checked = "";
    $classAlert = "";
    $Message = "";
    $booControlFields = true;
    $err = array(); // Stock les messages d'erreur
    $redfields=array(); // Stock les champs en erreur pour les afficher en rouge.
    $redfields['type']="";
    $redfields['titre']="";
    $redfields['debut']="";
    $redfields['fin']="";
    $redfields['description']="";
    $redfields['themes']="";
    $redfields['fin'] = "";
    $redfields['cp'] = "";
    $redfields['pays'] = "";
    $redfields['ville'] = "";
    $redfields['adresse1'] = "";
    $redfields['adresse2'] = "";
    $pla['adresse1']    ="";
    $pla['adresse2']    ="";
    $pla['cp']          ="";
    $pla['ville']       ="";
    $pla['pays']        ="";    
    $status = null;
?>          





<?php

if(isset($_GET['action']) || isset($_POST['evenement-action'])){

// UNE FOIS LE LIEU CHOISI
if(isset($_GET['action'])){
    $action = $_GET['action'];
}else if(isset($_POST['evenement-action'])){
    $action = $_POST['evenement-action'];
}

if($action == "suppr"){
    // SUPPRESSION DE L'EVENEMENT
    if(isset($_GET['idEvent']) && $_GET['idEvent']!=""){
        // On récupère l'evenement et le lieu auquel il est rattaché 
        // et on vérifie que l'admin est autorisé à l'administrer
        $idEvenement = $_GET['idEvent'];


        if(!EvenementAction::exist($idEvenement)){
            Redirect::adminError(404);
        }

        $evenement = EvenementAction::getEvenement($idEvenement, true);
        $currentOrganisateur =  LieuAction::recupererUnLieu($evenement->getLieu(), true);
        
        if(in_array($currentOrganisateur->getId(), $listeIdLieu)){
           if(EvenementAction::supprimerEvenement($idEvenement)){
                $classAlert = "success";
                $Message = "L'événement a bien été supprimé";
           }else{
                $classAlert = "alert";
                $Message = "L'événement n'a pas été correctement supprimé";
           }
//                   echo "SUPPRESSION";
        }else{
            Redirect::adminError(403);
        }
    }
}else{
    // Test d'un formulaire submited.
    if(isset($_POST['evenement-submit'])){

        $eve['lieu']        = $_POST['evenement-int-lieu'];
        
        $eve['nom']         = TextStatic::setHtmlPropre(filter_input(INPUT_POST,'evenement-text-nom'));
        $eve['description'] = TextStatic::setHtmlPropre($_POST['evenement-html-description']);
        $eve['debut']       = $_POST['evenement-date-debut'];
        $eve['fin']         = $_POST['evenement-date-fin'];
        $eve['hebergement'] = $_POST['evenement-check-hebergement'];
        $eve['garderie']    = $_POST['evenement-check-garderie'];
        $eve['prix']        = TextStatic::setHtmlPropre($_POST['evenement-number-prix']);
        $eve['contact']     = TextStatic::setHtmlPropre($_POST['evenement-html-contact']);
        $eve['mail']        = TextStatic::setHtmlPropre($_POST['evenement-mail-mail']);
        $eve['type']        = $_POST['evenement_list_types'];
        
        $eve['themes']      = $_POST['evenement-list-themes'];
        Applog::ecrireLog("_POST['evenement-list-themes']", "debug");
        foreach ($_POST['evenement-list-themes'] as $value) {
            Applog::ecrireLog("_POST['evenement-list-themes'] - [".$value."]", "debug");
        }
        
        $eve['intervenants']= explode(",",$_POST['evenement-list-intervenants']);
//        $eve['intervenants']= explode(",",$_POST['evenement-list-intervenants']);
//        foreach ($eve['intervenants'] as $value) {
//            AppLog::ecrireLog("_POST['evenement-list-intervenants'] - [".$value."]", "debug");
//        }
//            $eve['intervenants'] = $_POST['evenement-list-intervenants'];
//            AppLog::ecrireLog("2 _POST['evenement-list-intervenants'] - [".$_POST['evenement-list-intervenants']."]", "debug");
//            AppLog::ecrireLog("3 - eve['intervenants'] - [".$eve['intervenants']."]", "debug");
//           
            foreach ($eve['intervenants'] as $value) {
                Applog::ecrireLog("eve['intervenants'] - [".$value."]", "debug");
            }
        $eve['placeId']     = $_POST['evenement-int-placeId'];
        $eve['photo']       = $_FILES['data-file-photo'];
        
        $pla['adresse1']    = TextStatic::setHtmlPropre($_POST['adresse1']);
        $pla['adresse2']    = TextStatic::setHtmlPropre($_POST['adresse2']);
        $pla['cp']          = $_POST['cp'];
        $pla['ville']       = TextStatic::setHtmlPropre($_POST['ville']);
        $pla['pays']        = TextStatic::setHtmlPropre($_POST['pays']);

        $booNewPlace = false;
        
        
        
        
//        if($pla['ville']!= "" && $pla['cp']!= "" && strlen($pla['cp'])==5){
//            AppLog::ecrireLog("Rentre dans booNewPlace", "debug");
//            $booNewPlace = true;
//            if(!FormValidation::checkField($pla['cp'], "cp")){
//                array_push($err, "Format de code postal incorrect, format attendu : 12345 ");
//                $redfields['cp']="error";
//                $booControlFields=false;
//            }
//            
//        }

        
        if($pla['ville']!= "" || $pla['cp']!= "" || $pla['adresse1']!= "" || $pla['pays']!= "" || $pla['adresse2']!= ""){
            $booNewPlace = true;
            $simple = "#simple2";
            Applog::ecrireLog("Rentre dans booNewPlace", "debug");
            
            if(!FormValidation::checkField($pla['cp'], "cp")){
                array_push($err, "Format de code postal incorrect, format attendu : 12345 ");
                $redfields['cp']="error";
                $booControlFields=false;
            }
            if($pla['adresse1']== ""){
                array_push($err, "Merci de remplir au moins le champ adresse1, le champ adresse 2 est optionnel.");
                $redfields['adresse1']="error";
                $booControlFields=false;
            }
            if($pla['ville']== ""){
                array_push($err, "Pour modifier la localisation de l'événement, merci de renseigner la ville");
                $redfields['ville']="error";
                $booControlFields=false;
            }
            
            
        }

        
        
        
        $idLieu = $eve['lieu'];
        $lieuNom = LieuAction::recupererUnLieu($idLieu, true)->getNom();
        $titre = $eve['nom'];
        $dateDebut = $eve['debut'];
        $dateFin = $eve['fin'];
        $prix = $eve['prix'];
        $description = $eve['description'];
        $hebergement = $eve['hebergement'];
        $garderie = $eve['garderie'];
        $contact = $eve['contact'];
        $mail = $eve['mail']; 
        $themes = $eve['themes'];
        $intervenants = $eve['intervenants'];
        $type = $eve['type'];
        

        if($eve['type']==""){
            array_push($err, "Merci de choisir un type d'événement");
            $redfields['type']="alert label";
            $booControlFields=false;
        }
        if($eve['nom']==""){
            array_push($err, "Merci de saisir un titre pour cet événement");
            $redfields['titre']="error";
            $booControlFields=false;
        }
        if($eve['debut']==""){
            array_push($err, "Merci de sélectionner une date de début");
            $redfields['debut']="error";
            $booControlFields=false;
        }
        if($eve['fin']==""){
            array_push($err, "Merci de sélectionner une date de fin");
            $redfields['fin']="error";
            $booControlFields=false;
        }
        if($eve['description']==""){
            array_push($err, "Merci de saisir une description pour cet événement");
            $redfields['description']="alert label";
            $booControlFields=false;
        }
        if($eve['themes']==""){
            array_push($err, "Au minimum 1 thème doit être sélectionné");
            $redfields['themes']="alert label";
            $booControlFields=false;
        }
        
        if($eve['mail'] == ""){
            array_push($err, "L'adresse email est obligatoire pour enregistrer un événement");
            $redfields['mail']="error";
            $booControlFields=false;
        }else if(!FormValidation::checkField($eve['mail'], "mail")){
            array_push($err, "Format de mail incorrect, format attendu : xxxxx@xxxx.xx");
            $redfields['mail']="alert label";
            $booControlFields=false;
        }
        
        
        

    }
    // Action d'ajout ou de modif, dans les 2 cas on affichera le formulaire.
    if($action=="add"){

        if(isset($_POST['evenement-submit'])){
            // champs obligatoires validés.
            if($booControlFields){
                if($booNewPlace){
                     $newplace = GeoLocalisation::setPlace($pla);
                     if($newplace[0]){
                         $eve['placeId'] = $newplace[1];
                     }
                     
                }

                $status = EvenementAction::creerEvenement($eve);



                if($status[0]){
                    $classAlert = "success";
                    $Message = "L'événement a bien été ajouté";
                    $creationEvenement = true;
                    

                    $evenement = EvenementAction::getEvenement($status[1], true);
                    $currentOrganisateur =  LieuAction::recupererUnLieu($evenement->getLieu(), true);

                    $idEvenement = $evenement->getId();
                    $idLieu = $currentOrganisateur->getId();
                    $lieuNom = $currentOrganisateur->getNom();
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
                    $idOrga = $idLieu;
                    $action = "modif";  

                }else{
                    $classAlert = "alert";
                    $Message = "Une erreur a eu lieu, l'événement n'a pas été créé.";
                }
//                        Redirect::header($_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText('MenuAdminRetraitesLien2')."&idLieu=".$eve['lieu']);
            }else{
                $currentOrganisateur = LieuAction::recupererUnLieu($idLieu, true);
                $idOrga = $currentOrganisateur->getId();
                $classAlert = "alert";
                $Message = "";
                foreach ($err as $value) {
                    $Message .= $value."<br/>";
                }

            }


        }else{

            if(isset($_GET['idOrga']) && $_GET['idOrga']!=""){
                $idOrga = $_GET['idOrga'];

                // Si l'id de l'organisation n'existe pas en base, on renvoi vers une 404
                if(!LieuAction::exist($idOrga,true)){
                    Redirect::adminError(404);
                }

                $currentOrganisateur = LieuAction::recupererUnLieu($idOrga, true);
                if(in_array($currentOrganisateur->getId(), $listeIdLieu)){
                    $idLieu = $currentOrganisateur->getId();
                    $lieuNom = $currentOrganisateur->getNom();
                    $idEvenement = "";
                    $titre = "";
                    $dateDebut = "";
                    $dateFin = "";
                    $description = "";
                    $prix = "";
                    $hebergement = "";
                    $garderie = "";
                    $contact = "";
                    $mail = $currentOrganisateur->getMail();
                    $themes = array();
                    $intervenants = array();
                    $photo = "";
                }else{
                    Redirect::adminError(403);
                }    
            }
        }   
    }else if($action == "modif"){

        if(isset($_POST['evenement-submit']) || $_GET['id']){
            if(isset($_GET['id'])){
                $eve['id'] = $_GET['id'];
            }else{
                $eve['id'] = $_POST['evenement-int-id'];
            }
            if($booControlFields){
                if($booNewPlace){
                     $newplace = GeoLocalisation::setPlace($pla);
                     if($newplace[0]){
                         $eve['placeId'] = $newplace[1];
                     }
                     
                }
                $evenement = EvenementAction::getEvenement($eve['id'], true);
                $status = EvenementAction::modifierEvenement($evenement,$eve);

                if($status){
                    $classAlert = "success";
                    $Message = "L'événement a bien été modifié";
                }else{
                    $classAlert = "alert";
                    $Message = "Une erreur a eu lieu, l'événement n'a pas été modifié.";
                }
//                        Redirect::header($_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText('MenuAdminRetraitesLien2')."&action=modif&idEvent=".$eve['id']);
            }else{
                $classAlert = "alert";
                $Message = "";
                foreach ($err as $value) {
                    $Message .= $value."<br/>";
                }

            }


                $evenement = EvenementAction::getEvenement($eve['id'], true);
                $currentOrganisateur =  LieuAction::recupererUnLieu($evenement->getLieu(), true);

                $idEvenement = $evenement->getId();
                $idLieu = $currentOrganisateur->getId();
                $lieuNom = $currentOrganisateur->getNom();
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
            }else{
                
                // Modification d'un event existant
                if(isset($_GET['idEvent']) && $_GET['idEvent']!=""){
                    $idEvenement = $_GET['idEvent'];

                    if(!EvenementAction::exist($idEvenement)){Redirect::adminError(404);}

                    $evenement = EvenementAction::getEvenement($idEvenement, true);
                    $currentOrganisateur =  LieuAction::recupererUnLieu($evenement->getLieu(), true);
                    if(in_array($currentOrganisateur->getId(), $listeIdLieu)){
                        $idLieu = $currentOrganisateur->getId();
                        $lieuNom = $currentOrganisateur->getNom();
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
                        $idPlace = $evenement->getPlace();
                    }else{
                        //echo "Attention vous n'etes pas admin de ce lieu";

                        Redirect::adminError(403);
                    }
                }else{
                    Redirect::adminError(403);
                }
        }
    }
 ?>
<div class="row">
<br/>
<?php if(!$booControlFields || !is_null($status)){ ?>
<div class="ten columns centered alert-box <?php echo $classAlert; ?>">
<?php echo $Message; ?>

<a href="" class="close">&times;</a>
</div>
<?php if($creationEvenement){ ?>
<div class="ten columns centered ">
    <ul>

        <li><a href="admin.php?page=evenement">Retour à la liste</a></li>
        <li><a href="admin.php">Retour à l'accueil</a></li>
        
        
      
    </ul>
</div>
  <?php }?>
<?php } ?>
<form action="admin.php?page=evenement&action=<?php echo $action.$simple; ?>" method="POST" enctype="multipart/form-data">


 <input type='hidden' name='evenement-action' value='<?php echo $action; ?>'/>
 <input type="hidden" name="evenement-int-id" value="<?php echo $idEvenement; ?>"/>
 <input type="hidden" name="evenement-int-lieu" value="<?php echo $idLieu; ?>"/>
 <div class="seven columns">
     <div class="twelve columns panel">
         <h5><?php echo $lieuNom; ?></h5>
     </div>
     <div class="twelve columns panel">
         <h4>Informations générales</h4>
         <label class='labelAdmin ' for="evenement_list_types"><span class="has-tip tip-right <?php echo $redfields['type']; ?>" data-width="350" title="Vous pouvez sélectionner plusieurs types">Type d'événement</span></label>
         <?php echo HtmlFormComponents::SelectTypeEvenements("evenement_list_types", "listeType", 6,"contactItem twelve", 0, array($type), false); ?>
         <label class='labelAdmin' for="evenement-text-nom">Titre de l'événement </label>
         <input type="text" name="evenement-text-nom" id="nom" class="<?php echo $redfields['titre'];?> contactItem contactField" value="<?php echo $titre; ?>"/>
         <label class='labelAdmin' for="evenement-date-debut">Date d&eacute;but </label>
         <input type="text" name="evenement-date-debut" id="date_deb" class="<?php echo $redfields['debut'];?> contactItem contactField" value="<?php echo $dateDebut; ?>"/>
         <label class='labelAdmin' for="evenement-date-fin">Date fin </label>
         <input type="text" name="evenement-date-fin" id="date_fin" class="<?php echo $redfields['fin'];?> contactItem contactField" value="<?php echo $dateFin; ?>"/>
         <label class='labelAdmin' for="evenement-number-prix">Prix</label>
         <input type="text" name="evenement-number-prix" id="prix" class="contactItem contactField" value="<?php echo $prix; ?>"/>
     </div>
      <div class="twelve columns panel">
         <h4>Description</h4>
         <label class='labelAdmin' for="evenement-html-description"><span class="<?php echo $redfields['description'];?>">Description</span></label>
         <div class='contentWysiwyg'>
             <textarea name="evenement-html-description" id="description" class="contactItem contactTextArea">
                 <?php echo $description; ?>
             </textarea>
         </div>
      </div>
     <div class="twelve columns panel">
            <h4>Adresse</h4>


            <dl class="tabs">
              <dd class="active"><a href="#simple1">Adresse</a></dd>
              <dd><a href="#simple2">Modifier l'adresse</a></dd>
            </dl>
            <ul class="tabs-content">
              <li class="active" id="simple1Tab">
                   <?php
                        $place = null;
                        
                        
                        if($action=="add"){
                           
                            $place = GeoLocalisation::getPlace($currentOrganisateur->getPlace());
                        }else if($action == "modif"){
                            
                            $place = GeoLocalisation::getPlace($evenement->getPlace());
                        }
                        echo $place->getAdresse1()."<br/>";
                        echo $place->getAdresse2()."<br/>";
                        echo $place->getCp()." ";
                        echo $place->getVille();
                        echo "<br/>".$place->getPays();

                     ?>
                  <input type="hidden" name="evenement-int-placeId" value="<?php echo $place->getId(); ?>"/>
              </li>
              <li id="simple2Tab">
                    <div class="content">
                        <label class='labelAdmin' for="adresse1">adresse1</label>
                        <input type="text" name="adresse1" id="adresse1" class="<?php echo $redfields['adresse1'];?> contactItem contactField" value="<?php echo $pla['adresse1'];?>"/>
                        <label class='labelAdmin' for="adresse2">adresse2 </label>
                        <input type="text" name="adresse2" id="adresse2" class="contactItem contactField" value="<?php echo $pla['adresse2'];?>"/>
                        <label class='labelAdmin' for="cp">Code postal</label>
                        <input type="text" name="cp" id="cp" class="<?php echo $redfields['cp'];?> contactItem contactField" value="<?php echo $pla['cp'];?>"/>
                        <label class='labelAdmin' for="ville">Ville</label>
                        <input type="text" name="ville" id="ville" class="<?php echo $redfields['ville'];?> contactItem contactField" value="<?php echo $pla['ville'];?>"/>
                        <label class='labelAdmin' for="pays">Pays</label>
                        <input type="text" name="pays" id="pays" class="contactItem contactField" value="<?php echo $pla['pays'];?>"/>
                    </div>
              </li>

            </ul>










     </div>
 </div>
 <div class="five columns">
     <div class="twelve columns panel">
         <h4>Informations particulières</h4>
         <label class='labelAdmin' for="evenement-check-hebergement">H&eacute;bergement</label>
         <?php
             $checked = "";
             if($hebergement==1){
                 $checked = "checked";
             }
         ?>
         <input type="checkbox" name="evenement-check-hebergement" id="Hebergement"value="1" <?php echo $checked; ?>/>
         <label class='labelAdmin' for="evenement-check-garderie">Garderie</label>
         <?php
             $checked = "";
             if($garderie==1){
                 $checked = "checked";
             }
         ?>
         <input type="checkbox" name="evenement-check-garderie" id="Garderie"value="1" <?php echo $checked; ?>/>
     </div>
     <div class="twelve columns panel">
         <h4>Contact</h4>
         <label class='labelAdmin' for="evenement-html-contact">Contact inscription</label>
         <div class='contentWysiwyg'>
             <textarea name="evenement-html-contact" id="contactInscription" class="contactItem">
                 <?php echo $contact; ?>
             </textarea>
         </div>
         <label class='labelAdmin' for="evenement-mail-mail">Mail</label>
         <input type="text" name="evenement-mail-mail" id="mail" class="<?php echo $redfields['mail'];?> contactItem contactField" value="<?php echo $mail; ?>"/>
     </div>
     <div class="twelve columns">
         
         
         
     </div>
     <div class="twelve columns panel">
         
        
         
         <h4>Themes & Intervenants</h4>
         <label class='labelAdmin' for="evenement-list-themes">
             <span class="<?php echo $redfields['themes']; ?>">Themes</span></label>
         <?php
             echo HtmlFormComponents::SelectThemeWithSelectedValue("evenement-list-themes[]", "listeTheme", 7, "twelve", 1, $themes);
         ?>
        
            <label for='evenement-list-intervenants' class='labelSearchField'>Intervenants</label>
                <div id='searchField'>
                    <?php
//                    $listeI= array();
//                    foreach($intervenants as $intervenant){
////                        echo $intervenant->getNom();
//                        array_push($listeI,array("id"=>$intervenant->getId(),"text"=>$intervenant->getNom()." ".$intervenant->getPrenom()));
//                    }
                    
                    ?>
                    <input type="hidden" name="evenement-list-intervenants" class="twelve" id="listeIntervenants" value="<?php echo Util::getListeAvecVirguleGetId($intervenants); ?>" />
               
                </div>
         <?php 
//            echo HtmlFormComponents::SelectIntervenantsWithSelectedValue("evenement-list-intervenants[]", "listeIntervenants", 7, "twelve", 1, $intervenants);
         ?>
         <a href="#" data-reveal-id="divAddIntervenant">L'intervenant que vous recherchez n'est pas dans la liste, ajoutez le. </a>
     </div>

     <div class="twelve columns panel">
         <h4>Image <small> - 520px * 260px</small></h4>

         <div class="twelve">
             <input type="file" name="data-file-photo" id="mainPhoto" value="" /><br/><br/><br/>
             <div class="twelve" id="uploadPreview"></div>
         </div>
         <div class="twelve" id="currentImg">
             <?php $img = HtmlUtilComponents::imageControl("evenements", $photo,1); ?>
             <img src="<?php echo $img;?>" title='<?php echo $titre; ?>' alt='<?php echo $titre; ?>' class='' />
         </div>
     </div>
 </div>


 <div class="twelve columns">
      <div class="twelve columns panel">
         <h4>Validation</h4>
         <dl class="tabs">
              <dd class="active"><a href="#validation1">Enregistrer</a></dd>
              <dd><a href="#suppression1">Suppression</a></dd>
            </dl>
         <ul class="tabs-content">
                <li class="active" id="validation1Tab">
                    <input class='five columns large success button' type="submit" value="Enregistrer" name="evenement-submit"/>

                </li>
                <li id="suppression1Tab">
                    <h5>Attention, la suppression d'un événement est définitive.</h5>
                <a href="admin.php?page=evenement&action=suppr&idEvent=<?php echo $idEvenement; ?>" class='nine columns large alert button'>Êtes-vous sur de vouloir supprimer cet événement</a>

                </li>

            </ul>





    </div>  

 </div>


</form>
        <script>
            CKEDITOR.replace( 'description', {
                     removePlugins: 'bidi,div,font,forms,flash,horizontalrule,iframe,justify,table,tabletools,smiley',
                     removeButtons: 'Anchor,Underline,Strike,Subscript,Superscript,Image',
                     format_tags: 'p;h1;h2;h3;pre;address'
             } );
             CKEDITOR.replace( 'evenement-html-contact', {
                     removePlugins: 'bidi,div,font,forms,flash,horizontalrule,iframe,justify,table,tabletools,smiley',
                     removeButtons: 'Anchor,Underline,Strike,Subscript,Superscript,Image',
                     format_tags: 'p;h1;h2;h3;pre;address'
             } );
        </script>
</div>

    <?php  } ?>
<?php if($action=="suppr"){ ?>
<div class="row">
    <div class="twelve columns">
        <div class="nine columns centered alert-box <?php echo $classAlert; ?>">
            <?php echo $Message; ?>
            <a href="" class="close">&times;</a>
        </div>
            <br/><br/>
        <div class="nine columns centered">
            <a href="admin.php?page=evenement"><h6>Continuer...</h6></a>
        </div>
            <br/><br/>
    </div>
</div>
<?php  } ?>
<?php    
}else{
 // AFFICHER LA LISTE DES LIEUX POUR SELECTIOn

?>     
<div class="row">
<div class="twelve columns">

        <?php 
        

            $filterLieu = new OrganisateurSearchCriteria();
            
            $filterLieu->setOrganisateurAdministrateur(array(UtilSession::getSessionAdminId()));
//            $selectedValue = null;
//
//            if(isset($_POST['idLieu'])){
//                $selectedValue = $_POST['idLieu'];
//            }
            if($multi){
                echo "<h4>Sélection du lieu</h4>";
                echo "<p>Vous êtes administrateur de plusieurs lieux, merci de sélectionner le lieu pour consulter ou ajouter les événements associés.</p>";
                echo LieuAction::afficherGridLieuxAdmin($filterLieu, 3,2);
            }
            ?>


    <?php
        if(isset($_GET['idLieu']) || !$multi ){
            if(isset($_GET['idLieu'])){$idLieu = $_GET['idLieu'];}

            // vérification qu'il s'agit bien d'un lieu dont le user connecté est admin.
            if(in_array($idLieu, $listeIdLieu)){
            ?>
            <a href="<?php echo $_ENV['properties']['Page']['defaultAdmin']."?page=evenement&action=add&idOrga=".$idLieu ?>" class="success button five columns"><?php echo TextStatic::getText("MenuAdminRetraitesAjout"); ?></a>
            <?php
                    $filter = new EvenementSearchCriteria();
                    $filter->setEvenementLieu(array($idLieu));

                    echo EvenementAction::afficherTableEvenementAdministration($filter, "tableEventId", true);
            ?>
            <?php 

            }else{         
                Redirect::adminError(403);
            }
        } 
        ?>

</div>

</div>


<?php

}
?>







<?php 
// POPUP D'AJOUT D'INTERVENANT
//include('../page_admin/manageIntervenant.php'); 
?>




<div id="divAddIntervenant" class="reveal-modal medium">
  <h2>Ajouter un intervenant</h2>
  <p>Seuls les champs pr&eacute;c&eacute;d&eacute;s d'une * sont obligatoires.</p>
  <form  action="ajaxManagement.php" method="POST" name='formAddIntervenant' id='formAddIntervenant'>
      <input type="hidden" name="idAdmin" value="<?php echo $currentAdmin->getId(); ?>"/>
        <label for='intervenant-text-nom'>Nom</label>
        <input type="text" name="intervenant-text-nom" id="intervenant-text-nom" class="contactItem contactField"/>
        <label for='intervenant-text-prenom'>Prenom</label>
        <input type="text" name="intervenant-text-prenom" id="intervenant-text-prenom" class="contactItem contactField"/>
        <label for='intervenant-mail-mail'>Mail</label>
        <input type="text" name="intervenant-mail-mail" id="mail" class="contactItem contactField"/>
        <label for='intervenant-text-titre'>Titre</label>
        <input type="text" name="intervenant-text-titre" id="titre" class="contactItem contactField"/>
        <label for='intervenant-select-genre'>Genre</label>
        <select name='intervenant-select-genre' id='intervenant-select-genre' class="contactItem contactField">
            <option val='H' disabled selected>Selectionner dans la liste ci-dessous</option>
            <option val='H'>Masculin</option>
            <option val='F'>Feminin</option>           
        </select>
        
        
        <label class='labelAdmin' for="intervenant-html-description">Description</label>
        <div class='contentWysiwyg' class='twelve columns'>
        <textarea name="intervenant-html-description" id="descriptionIntervenant" class="contactItem contactField"></textarea>
        </div>
<!--        <label class='labelAdmin' for="data-file-photo">Photo</label>
        <input type="file" name="data-file-photo" id="mainPhoto" value="" />-->
        <input class='button'  value="ok" name="intervenant-submit" id="intervenant-submit"/>
        <input class='button' type="reset" value="reset"/>
        
  </form>
  <input id="currentInterv" type="hidden" value=""/>
  <a class="close-reveal-modal">&#215; fermer la fenetre</a>
</div>



<?php }else{
   
    Redirect::adminError(403);
} 