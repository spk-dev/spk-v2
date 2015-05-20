<?php
$booValid = true;
$redfields = array();
$redfields['objet'] = "";
$redfields['message'] = "";
$err = array();
$msg = "";
$class = "";
$objet = "";
$message = "";


if(isset($_POST['contact'])){
    
    
    $objet = $_POST['objet'];
    $message = $_POST['message'];
    
    if($objet == ""){
        $booValid = false;
        $redfields['objet'] = "error";
        array_push($err, "Merci de bien vouloir saisir un objet");
    }
    if($message == ""){
        $booValid = false;
        $redfields['message'] = "error";
        array_push($err, "Envoi impossible, le message est vide");
    }
    
    if($booValid){
        Applog::ecrireLog("Dans CONTACT ADMIN - BOO VALID", "debug");
        $admin = AdministrateurAction::getAdministrateur(UtilSession::getSessionAdminId());
        Applog::ecrireLog("Dans CONTACT ADMIN - id admin = [".$admin->getId()."]", "debug");
        $mail = new UtilMail();
        $mail->mailFromAdmin($admin, $objet, $message);
        $class = "success";
        $msg = "Votre mail a bien été envoyé, nous vous répondrons dans les plus brefs délais.";
    }else{
        $class = "alert";
        $msg = "";
        foreach ($err as $value) {
            $msg .="<br/>".$value;
        }
    }
    
}





?>

<div class="row">    
    <div class="twelve columns">
        <br/>
    </div>
    
    <div class="twelve columns">

        <div class="eight columns">
            <?php if($msg != ""){ ?>
                <div class="twelve columns alert-box <?php echo $class; ?>">
                    <?php echo $msg; ?>
                    <a href="" class="close">&times;</a>
                </div>
            <?php } ?>
             <div class="twelve columns panel">
                <p>Vous souhaitez intégrer le projet et diffuser vos retraites sur SPIBOOK</p>
            </div>
             <div class="twelve columns panel">
                <form action="" method="POST">


                    <label class='labelAdmin' for="objet">Objet</label>
                    <input type="text" name="objet" id="objet" class="contactItem contactField" value ="<?php echo $objet; ?>"/>
                    <label class='labelAdmin' for="message">Message</label>
                    <textarea name="message" id="message" class="contactItem contactTextArea"><?php echo $message; ?></textarea>
                    <input class='button' type="submit" value="Envoyer" name="contact"/>
                   
                </form>
              </div>
        </div>
        <div class="four columns">

            <div class="twelve columns panel JustifyText">

                <ul class="pricing-table">
                  <li class="title">Mes informations</li>
                  <li class="price">07 82 12 71 48</li>
                  <li class="description">Pour toute question concernant</li>
                  <li class="bullet-item">la description de mon site d'accueil</li>
                  <li class="bullet-item">La description des retraites</li>
                  <li class="bullet-item">Un intervenant</li>
                  <li class="bullet-item">Un thème</li>
                </ul>


            </div>
            <div class="twelve columns panel JustifyText">

                <ul class="pricing-table">
                  <li class="title">Questions techniques</li>
                  <li class="price">06 89 90 57 31</li>
                  <li class="description">Pour toute question concernant</li>
                  <li class="bullet-item">Le fonctionnement du site</li>
                  <li class="bullet-item">Le fonctionnement de votre zone d'administration</li>
                  <li class="bullet-item">Un bug identifié</li>
                  <li class="bullet-item">Une suggestion d'évolution du site</li>
                </ul>


            </div>

        </div>
    </div>
    
</div>
    <!-- FIN MAIN CONTENT SECTION--> 
