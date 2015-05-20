<?php
$booResult = false;
$err = array(); // Stock les messages d'erreur

$idAdmin  = UtilSession::getSessionAdminId();

$redfields['intitule']="";
$redfields['adresse1']="";
$redfields['adresse2']="";
$redfields['cp']="";
$redfields['ville']="";
$redfields['mailorga']="";


$nomOrganisateur = "";
$adresse1 = "";
$adresse2 = "";
$cp = "";
$ville = "";
$tel = "";
$mailorga = "";

if(isset($_POST['affiliate'])){
       
    
    $nomOrganisateur = filter_input(INPUT_POST, "intitule");
    $adresse1 = filter_input(INPUT_POST, "adresse1");
    $adresse2 = filter_input(INPUT_POST, "adresse2");
    $cp = filter_input(INPUT_POST, "cp");
    $ville = filter_input(INPUT_POST, "ville");
    $tel = filter_input(INPUT_POST, "tel");
    $mailorga = filter_input(INPUT_POST, "mailorga");
    
    
    
    if($nomOrganisateur==""){
        array_push($err, "Nom organisateur");
        $redfields['intitule']="error";
    }      
    if($adresse1=="" && $adresse2==""){
        array_push($err, "Adresse (au moins un des 2 champs doit être complété)");
        $redfields['adresse1']="error";
        $redfields['adresse2']="error";
    }
    if($cp==""){
        array_push($err, "Code postal");
        $redfields['cp']="error";
    }
    if($ville==""){
        array_push($err, "Ville");
        $redfields['ville']="error";
    }
                        
    if($mailorga==""){
        array_push($err, "Adresse email Organisateur");
        $redfields['mailorga']="error";
    }
    
//    if($tel<>"" && !FormValidation::checkField($tel, "phone")){
//        array_push($err, "Code postal incorrect, format attendu : 12345 ");
//        $redfields['cp']="error";
//    }
    
    
    if($cp<>"" && !FormValidation::checkField($cp, "cp")){
        array_push($err, "Code postal incorrect, format attendu : 12345 ");
        $redfields['cp']="error";
    }
    if($mailorga<>"" && !FormValidation::checkField($mailorga,"mail")){
        array_push($err, "Adresse email incorrecte, format attendu : xxxxx@xxxx.xxx");
        $redfields['mailorga']="error";
    }

    if(count($err)==0){
   
        $admin = AdministrateurAction::getAdministrateur($idAdmin);
        if(!$admin){
            $classAlert = "alert";
            $messageResult = "Une erreur a eu lieu.";
        }else{      
            $lieu = new Lieu();
            $lieu->setAdmin($admin->getId());
            $lieu->setValidationAdmin(1);
            $lieu->setValidationSuperAdmin(0);
            $lieu->setNom($nomOrganisateur);
            $lieu->setAdresse1($adresse1);
            $lieu->setAdresse2($adresse2);
            $lieu->setCp($cp);
            $lieu->setVille($ville);
            $lieu->setMail($mailorga);
            $lieu->setTel($tel);

            $result = LieuAction::ajouterLieu($lieu);




            $booResult = $result[0];
            $messageResult = $result[1];
            $utilMail = new UtilMail();
            if($booResult){

                $classAlert = "success";
                $utilMail->mailConfirmationAjoutLieu($admin, $lieu);
            }else{

    //            $utilMail->mailInfoInscriptionWebmaster($admin, $result[2], false);
                $classAlert = "alert";
            }
        }
    }else{
        $classAlert = "alert";
         $messageResult = "<p>Attention, les champs suivants sont obligatoires :</p>";
        foreach ($err as $value){
            $messageResult .= "<br/>".$value;
        }
    }
}
?>
<div class="row">
    <div class="twelve columns">
        <h4>Ajout d'un lieu</h4>
    </div>
</div>
<?php 
if($booResult){
?>

<div class="row">
    
    <div class="ten centered columns panel">
        <p><span class="round label twelve <?php echo $classAlert; ?>">
            Résultat : 
        </span>
        <?php echo $messageResult; ?></p>
        <br/>
    <div class="twelve columns centered">
        <?php if($classAlert=="success"){ ?>
            Vous pouvez maintenant : 
            <ul>
                <li><a href="admin.php?page=lieu">compléter / modifier la fiche</a></li>
                <li><a href="admin.php?page=evenement">Ajouter un événement</a></li>
            </ul>
            
                <h3>Rappel</h3>
                <p>La validation de ce nouvel "organisateur" est nécessaire avant la publication des événements.</p>
            
        <?php }else{ ?>
                <p><a href="admin.php?page=contact">Vous pouvez nous signaler ce problème en cliquant ici</a></p>
            
        <?php } ?>
    </div>
    </div>
</div>

<?php }else{ ?>

<?php if($messageResult != ""){ ?>
<div class="row">
    <div class="ten columns  centered  alert-box <?php echo $classAlert; ?>">
        <?php echo $messageResult; ?>
        
        
        <a href="" class="close">&times;</a>
    </div>
</div>
<?php } ?>
<div class="row">    
    
<!--    <div class="twelve columns">-->
 
    <div class="eight columns">
        
        <form name="affiliation" id="affiliation" method="POST">
            
            <div class="twelve columns panel" id="organisateur">
                <h2 class="titrePage">Organisateur</h2>
                <div id="intitule"><label for="intitule">Intitulé *</label><input type="text" name="intitule" value="<?php echo $nomOrganisateur; ?>" class="<?php echo $redfields['intitule'];?>" placeholder="Saisir le nom de la structure organisatrice (nom de la communauté, de l'asso...)"/></div>
                <div id="adresse"><label for="adresse1">Adresse 1 *</label><input type="text" name="adresse1" value="<?php echo $adresse1; ?>" class="<?php echo $redfields['adresse1'];?>" placeholder="Cette adresse sera utilisée pour la géolocalisation."/>
                <label for="adresse2">Adresse 2</label><input type="text" name="adresse2" value="<?php echo $adresse2; ?>"  class="<?php echo $redfields['adresse2'];?>"/>            
                <label for="cp">Code postal *</label><input type="text" name="cp" value="<?php echo $cp; ?>" class="<?php echo $redfields['cp'];?>" /> 
                <label for="ville">Ville *</label><input type="text" name="ville" value="<?php echo $ville; ?>" class="<?php echo $redfields['ville'];?>"/>  </div>
                <div id="coordonnees"><label for="tel">Telephone</label><input type="text" name="tel" value="<?php echo $tel; ?>" class="<?php if (isset($redfields['tel'])) echo $redfields['tel'];?>"/> 
                <label for="mailorga">Adresse email *</label><input type="text" name="mailorga" value="<?php echo $mailorga; ?>"  class="<?php echo $redfields['mailorga'];?>" placeholder="Saisir le mail de la structure organisatrice."/></div>
<!--                <div><p>J'ai pris connaissance de la charte Spibook.</p><input type="Checkbox" name="accept"/></div>-->
            </div>
            
            <input type="Submit" name="affiliate" value="Ok" id="valid" class="button"/>
            
        </form>
    </div> 
    <div class="four columns">
        <div class="twelve ">
            <p>Spibook est le portail internet des événements catholiques de France.</p>
            <a href="http://blog.spibook.com/charte-dutilisation/" target="_blank"><p>Lire la charte Spibook.</p></a>
        </div>
        
<p>Le compte Spibook est la structure organisatrice des événements.  Seul le compte Spibook sera visible par l’internaute. </p>
<br/>
<p><a href="admin.php?page=contact">
Un problème, une question, n’hésitez pas à nous contacter.
</a></p> 

    </div>

</div>

<?php
}
?>