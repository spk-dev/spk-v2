
<?php

if(UtilSession::isSessionLoaded()){
    Redirect::toPage("admin.php");
    
}else{
   
    
$status = "";
$errDisplay = "";
$labelClass = "";
if(isset($_GET['connexionResult'])){
    $status = $_GET['connexionResult'];
    if($status=="ko"){
        $errDisplay = "Impossible de se connecter";
        $labelClass="alert";
    }
}else if(isset($_GET['msg'])){
    $errDisplay = $_GET['msg'];
    $labelClass = $_GET['alert'];
}


?>
<div class="row">    
    <div class="twelve columns">
        

        <div class="eight columns centered">
            <?php if($errDisplay != ""){ ?>
            <div class="alert-box <?php echo $labelClass; ?>">
                <?php echo $errDisplay; ?>
                <a href="" class="close">&times;</a>
              </div>
            <?php } ?>
        </div>
            
        
            <div class='six columns centered '>
                <ul class="tabs-content contained">
                  <li class="active" id="simpleContained1Tab">
                      <p>Connectez-vous à votre zone d'administration SPIBOOK.</p>
                      <form action='' method='POST'>
                            <label class='labelAdmin' for="id">Adresse email </label>
                            <input type="text" name="mail" id="mail" class="contactItem contactField" value=""/>
                            <label class='labelAdmin' for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" class="contactItem contactField" value=""/>
                            <input class='button' type="submit" value="ok" name="connexion"/>
                            <input class='button' type="reset" value="reset"/>
                        </form>
                      <br/><br/><br/>
                  </li>
                  <li id="simpleContained2Tab">
                      <p>Vous avez perdu votre mot de passe.</p>
                      <p>Saisir ici l'adresse email pour recevoir le mot de passe.</p>
                      <form action='admin.php' method='POST'>
                          
                            <label class='labelAdmin' for="id">Adresse email </label>
                             <input type="text" name="mail" id="mail" class="contactItem contactField" value=""/>
<!--                            <input class='button' type="submit" value="Envoyer le mot de passe par mail." name="connexion"/>-->
                            <input type="submit" class="button ten columns round" name="sendPwd" value="Envoyer le mot de passe par mail."/>
                             <br/><br/><br/>
                        </form>
                      
                  </li>

                </ul>

                <dl class="tabs pill">
                  <dd class="active secondary"><a href="#simpleContained1">connexion</a></dd>
                  <dd class=""><a href="#simpleContained2">Mot de passe perdu.</a></dd>
                </dl>
            </div>


        <br/><br/>
    </div>
    
</div>

<?php  } ?>