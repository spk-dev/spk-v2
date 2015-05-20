<?php
    $id = "";
    $nom = "";
    $adresse1 = "";
    $adresse2 = "";
    $cp = "";
    $ville = "";
    $pays = "";
    $description = "";
    $hebergement = "";
    $mainphoto = "";
    $accesVoiture = "";
    $lienSiteweb = "";
    $mail = "";
    $tel = "";
    $fax = "";
    $Type_typeId = "";
    $Communaute_communauteId = "";
    $Administrateur_administrateurId = "";
    $galerie = "";
    $dateEnregistrement = "";
    $accesAvion = "";
    $accesTrain = "";
    $validationAdmin = "";
    $lat = "";
    $long = "";
    $booResultActivation = null;
    $messageActivation= "";
    $currentAdmin = new Administrateur();
    $multi = true;
    $errorMessage = "";
    $err = array();
    $booValid = true;
    $redfields = array();
    $redfields['nom'] = "";
    $redfields['tel'] = "";
    $redfields['fax'] = "";
    $redfields['mail'] = "";
    
    if(UtilSession::isSessionLoaded()){
        
        $currentAdmin = AdministrateurAction::getAdministrateur(UtilSession::getSessionAdminId());
        $listeIdLieu = $currentAdmin->getLieux();
        
      if(count($listeIdLieu)<2){
            $multi = false;
            $idLieu = $listeIdLieu[0];
        }
       
        if(isset($_GET['msg'])){
            $errorMessage = $_GET['msg'];
        }
         
        
        if(isset($_POST['idLieu']) && isset($_POST['action'])){
            if(in_array($_POST['idLieu'], $listeIdLieu)){
                
                $action = $_POST['action'];
                $idLieu = $_POST['idLieu'];
                $lieu = LieuAction::recupererUnLieu($idLieu, true);
                switch ($action) {
                    case "description":
                        if(isset($_POST['nom'])){
                                $org['nom']                     = $_POST['nom'];
                        }
                        if(isset($_POST['description'])){
                            
                                $org['description']             = $_POST['description'];
                        
                        }
                        if(isset($_POST['hebergement'])){
                            
                                $org['hebergement']             = $_POST['hebergement'];
                            
                        }
                        if(isset($_POST['tel'])){
                            
                                $org['tel']                     = $_POST['tel'];
                            
                        }
                        if(isset($_POST['fax'])){
                            
                                $org['fax']                     = $_POST['fax'];
                            
                        }
                        if(isset($_POST['mail'])){
                            
                                $org['mail']                    = $_POST['mail'];
                            
                        }
                        if(isset($_POST['site'])){
                            
                                $org['site']                    = $_POST['site'];
                            
                        }
                        if(isset($_POST['type'])){
                            
                                $org['type']                     = $_POST['type'];
                            
                        }

                        
                        if(isset($_POST['no-communaute'])){
                            $org['communaute'] = 0;
                            Applog::ecrireLog("NO COMMUNAUTE COCHEE", "debug");
                        }else{
                            
                            Applog::ecrireLog("NO COMMUNAUTE NON COCHEE", "debug");
                            $org['communaute']                  = $_POST['communaute'];
                        }
                        
                        
                        if(isset($_POST['voiture'])){
                            
                                $org['voiture']                    = $_POST['voiture'];
                            
                        }
                        if(isset($_POST['train'])){
                                $org['train']                    = $_POST['train'];
                            
                        }
                        if(isset($_POST['avion'])){
                            
                                $org['avion']                    = $_POST['avion'];
                            
                        }
                        
                        
                        
//                        $org['voiture']         = $_POST['voiture'];
//                        $org['train']           = $_POST['train'];
//                        $org['avion']           = $_POST['avion'];
                        $org['mainPhoto']       = $_FILES['mainPhoto']; 
                        
                        
                        if($org['nom'] == ""){
                            $booValid = false;
                            $redfields['nom'] = "error";
                            array_push($err, "Le nom est obligatoire");
                            $org['nom'] = $lieu->getNom();
                        }
                        if($org['tel'] <> "" && !FormValidation::checkField($org['tel'],"phone")){
                            $booValid = false;
                            $redfields['tel'] = "error";
                            array_push($err, "Le format du téléphone est incorrect");
                            $org['tel'] = $lieu->getTel();
                        }
                        if($org['fax'] <> "" && !FormValidation::checkField($org['fax'],"phone")){
                            $booValid = false;
                            $redfields['fax'] = "error";
                            array_push($err, "Le format du fax est incorrect");
                            $org['fax'] = $lieu->getFax();
                        }
                        if($org['mail'] <> "" && !FormValidation::checkField($org['mail'],"mail")){
                            $booValid = false;
                            $redfields['mail'] = "error";
                            array_push($err, "Le format du mail est incorrect, format attendu : xxxxx@xxxx.xx");
                            $org['mail'] = $lieu->getMail();
                        }
                        
                        // Vérifie si champs en erreur et affichage du message d'erreur
                        
                        
                        if(!LieuAction::modifierLieu($lieu,$org)){
                            $errorMessage = "Une erreur a eu lieu, la fiche n'a pas été enregistrée.";
                            //HtmlUtilComponents::staticMapSupprimerToutesLesMapsLieu($lieu->getId());  
                        }
                        
                        if(!$booValid){
                            $str = "";
                            foreach ($err as $value) {
                                $str .= "<br/>".$value;
                            }
                            Redirect::toPage(Redirect::getCurrentUrl()."&msg=".urlencode($str));
                        }
                        
//                        Redirect::toPage("admin.php?page=lieu&idLieu=".$idLieu."#adresse");

                        break;
                    case "adresse":
                        $lieu = LieuAction::recupererUnLieu($idLieu, true);
                        $org['adresse1']        = $_POST['adresse1'];
                        $org['adresse2']        = $_POST['adresse2'];
                        $org['cp']              = $_POST['cp'];
                        $org['ville']           = $_POST['ville'];
                        $org['pays']            = $_POST['pays'];
                        
                        if($org['cp'] <> "" && !FormValidation::checkField($org['cp'],"cp")){
                            $booValid = false;
                            $redfields['cp'] = "error";
                            array_push($err, "Le format du code postal est incorrect, format attendu : 12345");
                            $org['cp'] = $lieu->getCp();
                        }
                        if($org['ville'] == ""){
                            $booValid = false;
                            $redfields['ville'] = "error";
                            array_push($err, "La ville est obligatoire");
                            $org['ville'] = $lieu->getVille();
                        }
                        
                        if(!$booValid){
                            $str = "";
                            foreach ($err as $value) {
                                $str .= "<br/>".$value;
                            }
                            Redirect::toPage(Redirect::getCurrentUrl()."&msg=".urlencode($str)."#adresse");
                        }
                        // MISE  A JOUR DU LIEU
                        if(!LieuAction::updatePlace($lieu,$org)){
                            $errorMessage = "L'adresse a été mise à jour";
                        }
                        break;
                    case "validation":
                        $booActivation = $_POST['validationAdmin'];
                        $mail = new UtilMail();
                        $booResultActivation = LieuAction::activate($idLieu,$booActivation);
                        $lieu = LieuAction::recupererUnLieu($idLieu,true);
                        
                        if($booResultActivation){
                            
                            if($booActivation==1){
                                
                                if($lieu->getValidationSuperAdmin()==1){   
                                    $classActivation = "success";
                                    $messageActivation = "Vous avez bien validé votre fiche organisateur. Elle est dorénavant visible sur Spibook : <br/><br/> <a target='_blank' href='index.php?page=organisateurDetail&id=".$idLieu."'>Voir la page</a>";   
                                    $isSpibookActivated = true;
                                }else{
                                    $classActivation = "success";
                                    $messageActivation = "Votre fiche organisateur a bien été validée. Elle sera mise en ligne après validation de l'équipe Spibook.";
                                    $isSpibookActivated = false;
                                }
                                $mail->mailConfirmationActivation($currentAdmin,$isSpibookActivated);
                                
                            }else {
                              
                                if($lieu->getValidationSuperAdmin()==1){
                                    $classActivation = "success";
                                    $messageActivation = "Vous avez désactivé votre fiche organisateur. Elle n'est donc plus visible sur Spibook pour l'instant.";   
                                    $isSpibookActivated = true;
                                    
                                }else{
                                    $classActivation = "success";
                                    $messageActivation = "Vous avez désactivé votre fiche organisateur. Elle sera mise en ligne après validation de votre part et de l'équipe Spibook.";
                                    $isSpibookActivated = false;
                                }
                                $mail->mailConfirmationDesactivation($currentAdmin,$isSpibookActivated);
                                
                            }
                            
                        }else{
                            $classActivation = "";
                            $messageActivation = "";
                        }
                        break;
                    default:
                        break;
                }
            }
        }

?>

<div class="row">
    <div class="twelve columns">
    <?php 

        if(isset($_POST['idLieu']) || isset($_GET['idLieu']) || !$multi ){
            if(isset($_POST['idLieu'])){
                $idLieu = $_POST['idLieu'];
            }else if(isset($_GET['idLieu'])){
                $idLieu = $_GET['idLieu'];
            }
            
            $listeIdLieu = $currentAdmin->getLieux();
            if(!in_array($idLieu, $listeIdLieu)){
                die("Erreur, vous n'etes pas administrateur de ce lieu");
            }
            
            $lieu = LieuAction::recupererUnLieu($idLieu, true);
            
            $id = $lieu->getId();
            $nom = $lieu->getNom();
            $adresse1 = $lieu->getAdresse1();
            $adresse2 = $lieu->getAdresse2();
            $cp = $lieu->getCp();
            $ville = $lieu->getVille();
            $pays = $lieu->getPays();
            $description = $lieu->getDescription();
            $hebergement = $lieu->getHebergement();
            $mainphoto = $lieu->getMainphoto();
            $accesVoiture = $lieu->getVoiture();
            $lienSiteweb = $lieu->getLienSiteweb();
            $mail = $lieu->getMail();
            $tel = $lieu->getTel();
            $fax = $lieu->getFax();
            $Type_typeId = $lieu->getTypeId();
            $Communaute_communauteId = $lieu->getCommunaute();
            
            if($Communaute_communauteId==0){
                $nocommunauteChecked = "checked";
            }else{
                $nocommunauteChecked = "";
            }
            $Administrateur_administrateurId = $lieu->getAdmin();
            $galerie = $lieu->getGalerie();
            $dateEnregistrement = $lieu->getDateEnregistrement();
            $lat = $lieu->getLat();
            $long = $lieu->getLong();
            $accesAvion = $lieu->getAvion();
            $accesTrain = $lieu->getTrain();
            $validationAdmin = $lieu->getValidationAdmin();
            Applog::ecrireLog("validation ADMIN : [".$validationAdmin."]", "debug");
            $img = HtmlUtilComponents::imageControl("lieux", $mainphoto, 1);

        ?>




        <div class="title">
            <h4>Ma fiche organisateur <small><br/><a href="admin.php?page=ajoutOrganisateur">Vous êtes responsable d'un autre lieu et vous souhaitez l'inscrire sur Spibook, cliquez ici.</a></small></h4>
        </div>
        <br/>
        <?php if($errorMessage<>""){ ?>
            <div class="ten columns centered alert-box alert">
            <?php echo $errorMessage; ?>

            <a href="" class="close">&times;</a>
            </div>
        <?php } ?>
        <hr/>
        <div class="content">

            <dl class="tabs three-up">
                <dd class="active"><a href="#description">Etape 1 - Description</a></dd>
                <dd><a href="#adresse">Etape 2 - Adresse</a></dd>
                <dd><a href="#activation">Etape 3 - Activation</a></dd>
            </dl>
            <ul class="tabs-content">
<!--                ONGLET DESCRIPTION-->
                <li class="active" id="descriptionTab">
                  <form action="admin.php?page=lieu&idLieu=<?php echo $id; ?>#adresse" class="custom" name="formSaveOrganisateur" method="POST" enctype="multipart/form-data">
                        
                        <div class="seven columns">
                            <div class="twelve columns panel ">
                                   <h4>Informations g&eacute;n&eacute;rales</h4>
                                <input type="hidden" name="idLieu" value="<?php echo $id; ?>"/>
                                <input type="hidden" name="action" value="description"/>
                                <input type="hidden" name="page" value="lieu"/>
                                
                                <label class='labelAdmin' for="nom">Intitul&eacute;</label>
                                <input type="text" name="nom" id="nom" class="contactItem contactField" value="<?php echo $nom; ?>"/>

                            </div>
                            <div class="twelve columns panel">
                                <h4>Contact</h4>
                                <label class='labelAdmin' for="tel">T&eacute;l&eacute;phone</label>
                                <input type="text" name="tel" id="tel" class="contactItem contactField" value="<?php echo $tel; ?>"/>
                                <label class='labelAdmin' for="fax">Fax</label>
                                <input type="text" name="fax" id="fax" class="contactItem contactField" value="<?php echo $fax; ?>"/>

                            </div>
                            <div class="twelve columns panel">
                                <h4>Internet</h4>
                                <label class='labelAdmin' for="mail">Mail</label>
                                <input type="text" name="mail" id="mail" class="contactItem contactField" value="<?php echo $mail; ?>"/>
                                <label class='labelAdmin' for="site">Site internet</label>
                                <input type="text" name="site" id="site" class="contactItem contactField" value="<?php echo $lienSiteweb; ?>"/>

                            </div>
                            <div class="twelve columns panel">
                               <h4>Cat&eacute;gorisation</h4>
                               <label class='labelAdmin' for="type">Type</label>
                               <?php echo HtmlFormComponents::selectType("type", "type", 1, "", 0, $Type_typeId); ?>
                               <label class='labelAdmin' for="communaute">Communauté/ordre</label>
                               <?php echo HtmlFormComponents::selectCommunaute("communaute", "communaute", 1, "", 0, array($Communaute_communauteId)); ?>
                               <input type="checkbox" name="no-communaute" id="no-communaute" value="1" <?php echo $nocommunauteChecked; ?>/>Non lié à une communauté
                            </div>
                            <div class="twelve columns panel">
                                <h4>Image<small> - 600px * 300px</small></h4>
                                <p>Modifier l'image en important un nouveau fichier : <br/></p>
                                <div class="twelve">
                                    <input type="file" value="" id="mainPhoto" class="custom" name="mainPhoto"/>
                                </div>
                                <div class="twelve" id="uploadPreview"></div>
                                <br/><br/>
                                <div class="twelve" id="currentImg">
                                    <img src="<?php echo $img; ?>"/>
                                </div>
                            </div>
                            
                        </div>
                        <div class="five columns">

                            
                            <div class="twelve columns panel">
                                <h4>Hébergement</h4>

                                    <label class='labelAdmin' for="hebergement">Hébergement</label>
                                    <div class='contentWysiwyg twelve'>
                                        <textarea name="hebergement" id="hebergement" class="contactItem" ><?php echo $hebergement; ?></textarea>
                                    </div>
                                    <p>&nbsp;</p>
                             </div>
                            <div class="twelve columns panel ">
                                <h4>Comment nous rejoindre</h4>
            <!--                    <div class="four columns">-->
                                    <label class='labelAdmin' for="voiture">Venir en voiture</label>
                                    <div class='contentWysiwyg'>
                                         <textarea name="voiture" id="voiture" class="contactItem "><?php echo $accesVoiture; ?></textarea>
                                    </div>
            <!--                    </div>
                                <div class="four columns">-->
                                    <label class='labelAdmin' for="train">Venir en train</label>
                                    <div class='contentWysiwyg'>
                                         <textarea name="train" id="train" class="contactItem "><?php echo $accesTrain; ?></textarea>
                                    </div>
            <!--                    </div>
                                <div class="four columns">-->
                                    <label class='labelAdmin' for="avion">Venir en avion</label>
                                    <div class='contentWysiwyg'>
                                         <textarea name="avion" id="avion" class="contactItem "><?php echo $accesAvion; ?></textarea>
                                    </div>
            <!--                    </div>-->

                            </div>

                        </div>
                        <div class="twelve columns">

                            <div class="twelve columns panel ">
                               <h4>Description</h4>
                                   <label class='labelAdmin' for="description">Description</label>
                                   <div class='contentWysiwyg'>
                                        <textarea name="description"  id="description" class=""><?php echo $description; ?></textarea>
                                   </div>
                                   
                            </div>
                        </div>
                        <div class="row">
                          <div class="six columns centered">
                              <input type="Submit" class="twelve button" name="modifierAdresse" value="Enregistrer et passer à l'étape suivante"/>
                          </div>
                        </div>

                        </form>
                    </li>
<!--                    ONGLET ADRESSE-->
                    <li id="adresseTab">
                        <div class="twelve">

                            <form action="admin.php?page=lieu&idLieu=<?php echo $id; ?>#activation" name="modifierAdresse" class="custom" method="POST"/>
                                 
                                  <div class="twelve columns panel">
                                      <label class='labelAdmin' for="adresse1">adresse1</label>
                                      <input type="text" name="adresse1" id="adresse1" class="contactItem contactField" value="<?php echo $adresse1; ?>"/>
                                      <label class='labelAdmin' for="adresse2">adresse2 </label>
                                      <input type="text" name="adresse2" id="adresse2" class="contactItem contactField" value="<?php echo $adresse2; ?>"/>
                                      <label class='labelAdmin' for="cp">Code postal</label>
                                      <input type="text" name="cp" id="cp" class="contactItem contactField" value="<?php echo $cp; ?>"/>
                                      <label class='labelAdmin' for="ville">Ville</label>
                                      <input type="text" name="ville" id="ville" class="contactItem contactField" value="<?php echo $ville; ?>"/>
                                      <label class='labelAdmin' for="pays">Pays</label>
                                      <input type="text" name="pays" id="pays" class="contactItem contactField" value="<?php echo $pays; ?>"/>
                                      <input type='hidden' name='lat' id='lat' class="contactItem contactField" readonly="readonly" value="<?php echo $lat; ?>"/>
                                      <input type='hidden' name='long' id='long' class="contactItem contactField" readonly="readonly" value="<?php echo $long; ?>"/>
                                  </div>
                                  <div class="six columns centered">
                                        <input type="hidden" name="idLieu" value="<?php echo $id; ?>"/>
                                        <input type="hidden" name="action" value="adresse"/>
                                        <input type="hidden" name="page" value="lieu"/>
                                        <input type="Submit" class="twelve button" name="modifierAdresse" value="Enregistrer passer à la dernière étape"/>
                                  </div>
                              </form>
                        </div>
                    </li>
<!--                    ONGLET ACTIVATION -->
                    <li id="activationTab">
                      <div class="twelve columns ">
                                    <?php if($messageActivation != ""){ ?>
                                        <div class="alert-box <?php echo $classActivation; ?>">
                                            <?php echo $messageActivation; ?>
                                            <a href="" class="close">&times;</a>
                                          </div>
                                    <?php } ?>
                                    
                          <form name="activerOrga" class="custom" method="POST"/>
                                
<!--                                  <div class="twelve columns">-->
                                    <h4>Validation de votre lieu d'accueil</h4>
                                    <div class="nine columns panel">                     
                                          <label class='labelAdmin' for="validationAdmin">Publier <?php echo $nom; ?>: </label>
                                          <input type="radio" name="validationAdmin" value="1" <?php if ($validationAdmin) echo "checked=\"checked\"" ?> /> Oui<br>
                                          <input type="radio" name="validationAdmin" value="0" <?php if (!$validationAdmin) echo "checked=\"checked\"" ?> /> Non<br>
                                    </div>
                                    
                                    <div class="three columns">
                                        <input type="hidden" name="idLieu" value="<?php echo $id; ?>"/>
                                        <input type="hidden" name="action" value="validation"/>
                                        <input type="hidden" name="page" value="lieu"/>
                                        <input type="Submit" class="twelve button" name="modifierAdresse" value="Valider"/>
                                    </div>
                                    <div class="twelve columns">                     
                                        <a href="admin.php?page=evenement&action=add&idOrga=<?php echo $id; ?>" class="button five columns secondary">Ajouter un événement</a>
                                        <a href="admin.php?page=evenement&idLieu=<?php echo $id; ?>" class="button five columns secondary">Consulter les événements</a>
                                    </div>
<!--                                  </div>-->
                                  <div class="twelve columns panel">
                                      <h4>Validation par SPIBOOK</h4>
                                      <?php if($lieu->getValidationSuperAdmin()==1){ ?>
                                            <span class="success label round ">Validé</span>
                                      <?php }else{ ?>
                                            <span class="alert label round ">En cours de validation</span>
                                      <?php } ?>
                                  </div>
                              </form>
                        </div>
                    </li>
                </ul>

          <!-- FIN MAIN CONTENT SECTION--> 

        <script>
            CKEDITOR.replace( 'description', {
                     removePlugins: 'bidi,div,font,forms,flash,horizontalrule,iframe,justify,table,tabletools,smiley',
                     removeButtons: 'Anchor,Underline,Strike,Subscript,Superscript,Image',
                     format_tags: 'p;h1;h2;h3;pre;address'
             } );
             
             CKEDITOR.replace( 'train', {
                     removePlugins: 'bidi,div,font,forms,flash,horizontalrule,iframe,justify,table,tabletools,smiley',
                     removeButtons: 'Anchor,Underline,Strike,Subscript,Superscript,Image',
                     format_tags: 'p;h1;h2;h3;pre;address'
             } );
             
             CKEDITOR.replace( 'avion', {
                     removePlugins: 'bidi,div,font,forms,flash,horizontalrule,iframe,justify,table,tabletools,smiley',
                     removeButtons: 'Anchor,Underline,Strike,Subscript,Superscript,Image',
                     format_tags: 'p;h1;h2;h3;pre;address'
             } );
             
             CKEDITOR.replace( 'voiture', {
                     removePlugins: 'bidi,div,font,forms,flash,horizontalrule,iframe,justify,table,tabletools,smiley',
                     removeButtons: 'Anchor,Underline,Strike,Subscript,Superscript,Image',
                     format_tags: 'p;h1;h2;h3;pre;address'
             } );
             CKEDITOR.replace( 'hebergement', {
                     removePlugins: 'bidi,div,font,forms,flash,horizontalrule,iframe,justify,table,tabletools,smiley',
                     removeButtons: 'Anchor,Underline,Strike,Subscript,Superscript,Image',
                     format_tags: 'p;h1;h2;h3;pre;address'
             } );
             
        </script>

            <?php }else{ ?>
                  <h4>Sélection de la fiche organisateur<small><br/><a href="admin.php?page=ajoutOrganisateur">Vous êtes responsable d'un autre lieu et vous souhaitez l'inscrire sur Spibook, cliquez ici.</a></small></h4>
                <form name="validLieu" id="validLieu" method="POST" action="" >
                <?php 
                    $filterLieu = new OrganisateurSearchCriteria();
                    
                    $filterLieu->setOrganisateurAdministrateur(array(UtilSession::getSessionAdminId()));
          
                    $selectedValue = null;
                    if(isset($_POST['idLieu'])){
                        $selectedValue = $_POST['idLieu'];
                    }
                   echo LieuAction::afficherGridLieuxAdmin($filterLieu, 5,1);
                ?>
                </form>
            <?php } ?>


        </div>

    </div>

</div>

<?php
}else{
    Redirect::toPage($_ENV['properties']['Page']['defaultAdmin']);
}

?>

<script type="text/javascript">


//function submitForm(){
//
//    geolocalise();
//    
//    document.getElementById('lat').value;
//    document.getElementById('long').value;
//    
//    
//    document.forms['formSaveOrganisateur'].submit();
//}


 /* Déclaration des variables globales */ 
// var geocoder = new google.maps.Geocoder();
// var addr, latitude, longitude;

 /* Fonction chargée de géolocaliser l'adresse */ 
// function geolocalise(){
//     
//  /* Récupération du champ "adresse" */ 
//  addr  = document.getElementById('adresse1').value;
//  addr  = addr +" "+document.getElementById('adresse2').value;
//  addr  = addr +" "+document.getElementById('cp').value;
//  addr  = addr +" "+document.getElementById('ville').value;
//  
//  /* Tentative de géocodage */ 
//  geocoder.geocode( { 'address': addr}, function(results, status) {
//   /* Si géolocalisation réussie */ 
//   if (status == google.maps.GeocoderStatus.OK) {
//    /* Récupération des coordonnées */ 
//    latitude = results[0].geometry.location.lat();
//    longitude = results[0].geometry.location.lng();
//    /* Insertion des coordonnées dans les input text */ 
//    document.getElementById('lat').value = latitude;
//    document.getElementById('long').value = longitude;
//    
//    document.forms['formSaveOrganisateur'].submit();
//
//   }else{
//       alert('Impossible de définir les coordonnées GDS');
//       document.forms['formSaveOrganisateur'].submit();
//   }
//  });
  
//  document.forms['formSaveOrganisateur'].submit();
// }
 
 
 // var url = window.URL || window.webkitURL; // alternate use

//function readImage(file) {
//
//    var reader = new FileReader();
//    var image  = new Image();
//
//    reader.readAsDataURL(file);  
//    reader.onload = function(_file) {
//        image.src    = _file.target.result;              // url.createObjectURL(file);
//        
//        image.onload = function() {
//            
//            var w = this.width,
//                h = this.height,
//                t = file.type,                           // ext only: // file.type.split('/')[1],
//                n = file.name,
//                s = ~~(file.size/1024) +'KB';
//            if(w >= 600 && h>=300){
//                $('#uploadPreview').html("");
//                $('#uploadPreview').append('<img src="'+ this.src +'"> '+w+'x'+h+' '+s+' '+n+'<br>');
//                document.getElementById('currentImg').innerHTML = "";
//            }else{
//                $('#uploadPreview').append("L'image est trop petite : dimension minimum 600 x 300");
//                $("#mainPhoto").val("");
//            }
//            
//        };
//        image.onerror= function() {
//            $("#mainPhoto").val("");
//            alert('Format d\'image incorrect: '+ file.type);
//        };      
//    };
//
//}
//$("#mainPhoto").change(function (e) {
//    if(this.disabled) return alert('Le fichier envoyé n\'est pas accepté!');
//    var F = this.files;
//    if(F && F[0]) for(var i=0; i<F.length; i++) readImage( F[i] );
//});

</script>