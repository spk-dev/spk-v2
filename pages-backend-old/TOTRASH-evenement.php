
<?php
$status="";
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

if(UtilSession::isSessionLoaded()){
    
    $currentAdmin = AdministrateurAction::getAdministrateur(UtilSession::getSessionAdminId());
    $listeIdLieu = $currentAdmin->getLieux();
    
    if(isset($_POST['retraite-submit'])){

        if(isset($_POST['retraite-action'])){

            $ret['lieu']        = $_POST['retraite-int-lieu'];
            $ret['nom']         = $_POST['retraite-text-nom'];
            $ret['description'] = $_POST['retraite-html-description'];
            $ret['debut']       = $_POST['retraite-date-debut'];
            $ret['fin']         = $_POST['retraite-date-fin'];
            $ret['hebergement'] = $_POST['retraite-check-hebergement'];
            $ret['garderie']    = $_POST['retraite-check-garderie'];
            $ret['prix']        = $_POST['retraite-number-prix'];
            $ret['contact']     = $_POST['retraite-html-contact'];
            $ret['mail']        = $_POST['retraite-mail-mail'];
            $ret['type']        = $_POST['retraite_list_types'];
            $ret['themes']      = $_POST['retraite-list-themes'];
            $ret['intervenants']= $_POST['retraite-list-intervenants'];
            $action = $_POST['retraite-action'];
            
            if($ret['type']==""){
                array_push($err, "Type");
                $redfields['type']="error";
                $booControlFields=false;
            }
            if($ret['nom']==""){
                array_push($err, "Titre");
                $redfields['titre']="error";
                $booControlFields=false;
            }
            if($ret['debut']==""){
                array_push($err, "Date de début");
                $redfields['debut']="error";
                $booControlFields=false;
            }
            if($ret['fin']==""){
                array_push($err, "Date de fin");
                $redfields['fin']="error";
                $booControlFields=false;
            }
            if($ret['description']==""){
                array_push($err, "Description");
                $redfields['description']="error";
                $booControlFields=false;
            }
            if($ret['themes']==""){
                array_push($err, "Themes");
                $redfields['themes']="error";
                $booControlFields=false;
            }
            
            if(!$booControlFields){
                Redirect::header($url);
            }else{
                if(in_array($ret['lieu'], $listeIdLieu)){

                    switch ($action) {
                        case "add":
                            $status = EvenementAction::creerEvenement($ret);
                            if($status){
                                $classAlert = "success";
                                $Message = "L'événement a bien été ajouté";
                            }else{
                                $classAlert = "alert";
                                $Message = "Une erreur a eu lieu, l'événement n'a pas été créé.";
                            }

                            break;

                        case "modif":
                            $ret['id'] = $_POST['retraite-int-id'];
                            $evenement = EvenementAction::getEvenement($ret['id'], true);
                            $status = EvenementAction::modifierEvenement($evenement,$ret);

                            if($status){
                                $classAlert = "success";
                                $Message = "L'événement a bien été modifié";
                            }else{
                                $classAlert = "alert";
                                $Message = "Une erreur a eu lieu, l'événement n'a pas été modifié.";
                            }
                            break;

                        default:
                            break;
                    }
                }else{
                    $classAlert = "alert";
                    $Message = "ATTENTION, VOUS NE POUVEZ AJOUTER D'EVENEMENT QU'AU LIEU DONT VOUS ETES ADMINISTRATEUR ! ";
                }
            }
        }
        ?>
            <div class="row"><div class="twelve columns alert-box <?php echo $classAlert; ?>">
                <?php echo $Message; ?><a href="" class="close">&times;</a>
                </div>
            </div>
          <?php      
        $_GET['idLieu'] = $ret['lieu'];



    }
    
    
    if(isset($_GET['supprRetraite'])){
       
            $idEvenement = $_GET['supprRetraite'];
            if($idEvenement!="" && !is_null($idEvenement) && $idEvenement!=0){
              
                if(isset($_GET['supprValid'])){
                    $suppr = $_GET['supprValid'];
                    if($suppr==1){
                       
                     
                        
                        $booResult = EvenementAction::supprimerEvenement($idEvenement);
                        
                        if($booResult){
                            $classAlert = "success";
                            $Message = "L'événement a bien été supprimé";
                        }else{
                            $classAlert = "alert";
                            $Message = "Une erreur a eu lieu, l'événement n'a pas été supprimé. Merci de bien vouloir le signaler à l'administrateur.";
                        }
                        ?>
                        
                        <div class="row"><div class="twelve alert-box <?php echo $classAlert; ?>">
                            <?php echo $Message; ?><a href="" class="close">&times;</a>
                        </div>
                        </div>
                        <?php
                    }
                }else{
                $retraiteToDelete = EvenementAction::getEvenement($idEvenement, true);
   
                ?>
                    <div class='row'>
                        
                        <div class="six columns panel centered">
                            <h4>Etes vous sur de vouloir supprimer l'événement suivant : </h4>
                           <h3><?php echo $retraiteToDelete->getNom(); ?></h3>
                           <span class='alert label'>Attention, cette action est irreversible.</span>
                           
                        </div>
                    </div>
                    <div class='row'>
                        <div class="six columns centered">
                            <a href="<?php echo $_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText("MenuAdminRetraitesLien")."&supprRetraite=".$idEvenement."&supprValid=1" ?>" class="alert button twelve columns">Supprimer</a>
                        </div>
                    </div>
                
                <?php
                }
            }
 
            
        }


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
                    $filterLieu = new OrganisateurSearchCriteria();
                    $filterLieu->setOrganisateurAdministrateur(array(UtilSession::getSessionAdminId()));
                    $selectedValue = null;
                    if(isset($_POST['idLieu'])){
                        $selectedValue = $_POST['idLieu'];
                    }
                    echo LieuAction::afficherGridLieuxAdmin($filterLieu, 5,2);
                    ?>
            

            <?php
                if(isset($_POST['idLieu']) || isset($_GET['idLieu']) ){
                    if(isset($_POST['idLieu'])){
                        $idLieu = $_POST['idLieu'];
                    }else if(isset($_GET['idLieu'])){
                        $idLieu = $_GET['idLieu'];
                    }
                    if(in_array($idLieu, $listeIdLieu)){
                    
                            ?>
                           <a href="<?php echo $_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText("MenuAdminRetraitesAjoutLien")."&idLieu=".$idLieu ?>" class="success button five columns"><?php echo TextStatic::getText("MenuAdminRetraitesAjout"); ?></a>
                            <?php
                                    $filter = new EvenementSearchCriteria();
                                    $filter->setEvenementLieu(array($idLieu));

                                    echo EvenementAction::afficherTableEvenementAdministration($filter, "toto", true);
                            ?>
                    <?php 
                    
                    }else{         
                        $classAlert = "alert";
                        $Message = "ATTENTION, VOUS N'ETES PAS ADMINISTRATEUR DE CE LIEU! ";
                        ?>
                        <div class="row"><div class="twelve columns alert-box <?php echo $classAlert; ?>"><?php echo $Message; ?><a href="" class="close">&times;</a></div></div>
                        <?php
                    }
                } 
                ?>
                            
        </div>
<?php } ?>
</div>
    