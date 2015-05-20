<?php
    $id = "";
    $nom = "";
    $prenom = "";
    $tel = "";
    $mail = "";
    $err = array(); // Stock les messages d'erreur
    $redfields=array(); // Stock les champs en erreur pour les afficher en rouge.
    $redfields['nom']="";
    $redfields['prenom']="";
    $redfields['mail']="";
    $redfields['tel']="";
    $redfields['password']="";
    
    if(UtilSession::isSessionLoaded()){
        
        if(isset($_POST['Id'])){
            $var['Id'] = $_POST['Id'];
            $var['Nom'] = $_POST['nom'];
            $var['Prenom'] = $_POST['prenom'];
            $var['Tel'] = $_POST['tel'];
            $var['Mail'] = $_POST['mail'];
            $var['Password1'] = SecurityUtil::securPwd($_POST['pass1']);
            $var['Password2'] = SecurityUtil::securPwd($_POST['pass2']);
            
            $booVerif = true;
            
            if($var['Nom']==""){
                array_push($err, "Le nom est obligatoire");
                $redfields['nom']="error";
                $booVerif = false;
            }
            if($var['Prenom']==""){
                array_push($err, "Le prénom est obligatoire");
                $redfields['prenom']="error";
                $booVerif = false;
            }
            if($var['Tel'] <> "" && !FormValidation::checkField($var['Tel'],"phone")){
                array_push($err, "Format du numéro de téléphone incorrect");
                $redfields['tel']="error";
                $booVerif = false;
            }
            
            if($var['Mail']==""){
                array_push($err, "L'email est obligatoire");
                $redfields['mail']="error";
                $booVerif = false;
            }else if(!FormValidation::checkField ($var['Mail'], "mail")){
                array_push($err, "Format de l'email incorrect");
                $redfields['mail']="error";
                $booVerif = false;
            }
            
            
            if($var['Password1']!= ""){
                if(($var['Password1'] != $var['Password2'])){
                    array_push($err,"<br/>Attention : les 2 mots de passe ne sont pas identiques.");
                    $redfields['password'] = "error";
                    $booVerif = false;
                }
            }
            
            if($booVerif){
                if($var['Id']==UtilSession::getSessionAdminId()){

                    $admin = AdministrateurAction::getAdministrateur($var['Id']);
                    $booValid = AdministrateurAction::updateAdministrateur($var, $admin);


                }
            }else{
                $booValid = false;
            }
            
            $classAlert = "";
            $Message = "";
            
            if($booValid){
                $classAlert = "success";
                $Message = "La mise à jour a bien été effectuée.";
            }else{
                if(!$booVerif){
                    $classAlert = "alert";
                   $Message = "Modification impossible, les champs suivants sont obligatoires.";
                    
                    foreach ($err as $value) {
                      $Message .="<p>".$value."</p>";
                    }
                  
                }else{
                    $classAlert = "alert";
                    $Message = "Enregistrement impossible. <br/>Une erreur a eu lieu, merci de contacter l'administrateur.";
                }
            }            
            ?>
                <div class="row">
                    <div class="ten columns centered alert-box <?php echo $classAlert; ?>">
                          <?php echo $Message; ?>
                          <a href="" class="close">&times;</a>
                    </div>    
                </div>
        <?php
        }
        
        
        $currentAdmin = AdministrateurAction::getAdministrateur(UtilSession::getSessionAdminId());
        $id = $currentAdmin->getId();
        $nom = $currentAdmin->getNom();
        $prenom = $currentAdmin->getPrenom();
        $tel = $currentAdmin->getTel();
        $mail = $currentAdmin->getMail();?>
    <div class="row">    
        <div class="twelve columns">
            <br/>
            <?php
//                echo "<h1>".TextStatic::getText("TitreAdminSignalitique")."</h1>";
//                echo "<p class='justify'>".TextStatic::getText("DescriptionAdminSignalitique")."</p>";
             ?>
        </div>
        <div class="twelve columns">
            <div class="eight columns panel">
                
                     
                    
                  <dl class="tabs">
                    <dd class="active"><a href="#simple1">Informations</a></dd>
                    <dd><a href="#simple2">Modifier le mot de passe</a></dd>
                    
                  </dl>
                  <ul class="tabs-content ">
                    <li class="active" id="simple1Tab">
                        <form action="" method="POST" name="signal" id="signaletique">
                        <input type="hidden" name="Id" id="Id"  value="<?php echo $id; ?>"/>
                        <label class='labelAdmin' for="nom">Nom *</label>
                        <input type="text" name="nom" id="nom" class="contactItem contactField <?php echo $redfields['nom'];?>" value="<?php echo $nom; ?>"/>
                        <label class='labelAdmin' for="prenom">Prenom *</label>
                        <input type="text" name="prenom" id="prenom" class="contactItem contactField <?php echo $redfields['prenom'];?>" value="<?php echo $prenom; ?>"/>
                        <label class='labelAdmin' for="tel">Num&eacute;ro de t&eacute;l&eacute;phone </label>
                        <input type="text" name="tel" id="tel" class="contactItem  contactField <?php echo $redfields['tel'];?>" value="<?php echo $tel; ?>"/>
                        <label class='labelAdmin' for="mail">Mail *</label>
                        <input type="text" name="mail" id="mail" class="contactItem  contactField <?php echo $redfields['mail'];?>" value="<?php echo $mail; ?>"/>
                        <input class='button round twelve columns' type="Submit" value="Mettre à jour" name="contact"/>
                        </form>
                    </li>
                    <li id="simple2Tab">
                        <form action="" method="POST" name="signal" id="signaletique">
                        <input type="hidden" name="Id" id="Id"  value="<?php echo $id; ?>"/>
                        <input type="hidden" name="nom" id="nom" value="<?php echo $nom; ?>"/>
                        <input type="hidden" name="prenom" id="prenom" value="<?php echo $prenom; ?>"/>
                        <input type="hidden" name="tel" id="tel"  value="<?php echo $tel; ?>"/>
                        <input type="hidden" name="mail" id="mail" value="<?php echo $mail; ?>"/>
                       
                        <label class='labelAdmin' for="pass1">Mot de passe</label>
                        <input type="password" name="pass1" id="pass1" class="contactItem  contactField <?php echo $redfields['password'];?>" value=""/>
                        <label class='labelAdmin' for="pass2">V&eacute;rification du mot de passe</label>
                        <input type="password" name="pass2" id="pass2" class="contactItem  contactField <?php echo $redfields['password'];?>" value=""/>
                        <input class='button round twelve columns' type="Submit" value="Mettre à jour" name="contact"/>
                        </form>
                    </li>
                   
                  </ul>
                    
                    
                    
                    
                   
                  
                    

                    
                
            </div>
            <div class="one columns"></div>
            
            <div class="three columns panel">
                <a href="admin.php?page=contact">Contactez nous</a>
            </div>
        </div>





        </div>
<?php 
}else{
    Redirect::toPage($_ENV['properties']['Page']['defaultAdmin']);
}
?>