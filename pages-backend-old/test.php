

<div class="row">    
    
    <?php
$date = new DateTime();
echo $date->getTimestamp();

if(isset($_FILES['fichier'])){
    echo "TEMP NAME : ".basename($_FILES['fichier']['tmp_name']);
    echo "<br/>";
    echo "NAME AVANT TRAITEMENT : ".basename($_FILES['fichier']['name']);
    echo "<br/>";
    echo "NAME APRES TRAITEMENT : ".$date->getTimestamp().-imageTreatment::renameImage("et alors on va où");

    $fichier=$date->getTimestamp().-imageTreatment::renameImage("et alors on va où").".jpg";
    
    imageTreatment::recupImageFromForm("retraite", "test/images/", $fichier, "test/images/mini/", "test/images/liste/","fichier");
    
    
}else{
    echo "wait";
}

?>
    
    
   <div class="twelve columns">
<form name="test" method="POST" enctype="multipart/form-data">
    <input type="file" name="fichier" value="" /><input type="submit" value="ok" name="valider" />
</form>`

   </div>
</div>