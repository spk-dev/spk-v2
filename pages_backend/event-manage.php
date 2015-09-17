<?php

$etat_champs        = null;
$summernote_class   = null;
$visibility         = null;

$decodeObj = unserialize(urldecode($_GET['obj']));
$codeObj = urlencode(serialize($decodeObj));
const K_actionRead = "r";
const K_actionWrite = "w";

if(isset($_GET['action'])){
    $act = $_GET['action'];
    switch ($act) {
        case K_actionRead:
            $etat_champs = "disabled";
            $summernote_class = "";
            $visibility = false;
            break;
        
        case K_actionWrite:
            $etat_champs = "";
            $summernote_class = "summernote";
            $visibility = true;    
            break;  

        default:
            // THROW EXCEPTION
            die("action incorrecte: autorisée R ou W");
            break;
        }
}
$idEvenement = $decodeObj->getEvenementId();

?>
<script>
var obj = undefined;    
function navOccurence(sens)
{
    if ( obj == undefined )
        obj = '<?php echo $codeObj ?>';
    $.ajax({
        url:'../ajax/EvenementAjax.php',
        method: 'POST',
        data: {sens: sens, objEncoded: obj, act: 'navOccurence'},
        dataType: 'json', 
        success: function(json) { 
            obj = json.encodedObjet;
            if (json.butee == false )
            {
                alert('json'+json.dateDebut);
                $("input#dateDebut").val(json.dateDebut);
                $("input#dateFin").val(json.dateFin);
                $("input#addresse").val(json.adresse);
                $("input#street_number").val(json.numeroRoute);
                $("input#route").val(json.route);
                $("input#postal_code").val(json.CodePostale);
                $("input#locality").val(json.Ville);
                $("input#administrative_area_level_2").val(json.area2);
                $("input#administrative_area_level_1").val(json.area1);
                $("input#country").val(json.pays);
                $("input#Longitude").val(json.coordLongitude);
                $("input#Latitude").val(json.coordLatitude);
            } else {
                alert('en butée');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Récupération des invités impossible : '+thrownError)
        }
    });
}

function saveFrm(idForm) 
{
    var FormEncoded = $( idForm ).serialize();
    var obj = '<?php echo $codeObj ?>';
    alert('test1');
    $.ajax({
        url:'../ajax/EvenementAjax.php',
        method: 'POST',
        data: {act: 'SaveEvenement',FormEncoded: FormEncoded,objEncoded:obj },
        dataType: 'text', 
        success: function(text) { 
            $("textarea#pla_invites").val(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Récupération des invités impossible : '+thrownError)
        }
    });
    return false;
}
</script>

    <input type="hidden" name="objEvenement" value="<?php echo $codeObj ?>">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-plus-circle fa-fw"></i><?php echo empty($idOccurence)?"Ajouter un évenement":"Modifier un évenement";?></h1>
    </div>
</div>
    
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#generale">Generale</a></li>
    <li><a data-toggle="tab" href="#iterations">Itérations</a></li>
    <li><a data-toggle="tab" href="#contact">contacts</a></li>
    <li><a data-toggle="tab" href="#complement">Compléments</a></li>
    <li><a data-toggle="tab" href="#media">Média</a></li>
</ul>

<div class="tab-content">
    <div id="generale" class="tab-pane fade in active">
        <!-- 
        Affichage des commandes
        -->
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                <label for="type">Type d'évenement</label>
                <select name="type" id="type" class="form-control" <?php echo $etat_champs; ?>>
                    <option>Org 1 - ville / dep</option>
                    <option>Org 2 - ville / dep</option>
                    <option>Org 3 - ville / dep</option>
                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                <h4>Avancement</h4>
                <p><span class="pull-right text-muted">40%</span></p>
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                        <span class="sr-only">40%</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                <div class="well">
                    <h4>Activation / validation</h4>
                    <div class="btn-group-vertical" role="group" aria-label="...">
                        <button type="button" class="btn btn-success" <?php echo $etat_champs; ?>><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>  Activé - cliquer pour desactiver</button>
                        <button type="button" class="btn btn-danger" <?php echo $etat_champs; ?>><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>  Désactivé - cliquer pour activer</button>
                    </div>
                    &nbsp;
                </div>
            </div>
        </div>
        <!-- 
        Affichage des évènements 
        -->
        <div class="row">
            <ul class="timeline">
            <?php
                /* récupération des itération de l'évènement sélectionné */
                $displayClassTimeLine = 'class="timeline-inverted"';
                for ( $i=0;$i<$decodeObj->getNbOccurence();$i++)
                {
                    $occurence = $decodeObj->getCurrentOccurence();
                    $decodeObj->setNextOccurence();
                    $place = $occurence->getPlace();
                    $displayClassTimeLine==""?$displayClassTimeLine='class="timeline-inverted"':$displayClassTimeLine="";
            ?>
                <li <?php echo $displayClassTimeLine;?> >
                    <div class="timeline-badge"><h6><?php echo $occurence->getAnneMoisDebut() ?></h6></div>
                    <div class="timeline-panel">
                <form onsubmit="return saveFrm('#frmOcc<?php $occurence->getIdOccurrence()?>')" name="frmOcc<?php $occurence->getIdOccurrence()?>">
                        <div class="timeline-heading">
                            <h5 class="timeline-title">Lieu de l'événement
                                <p align="right"><button type="submit" class="btn btn-default col-lg-12"><i class="fa fa-floppy-o"></i></button></p>
                            </h5>
                        </div>
                        <div class="timeline-body">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                    <input id="depot" name="depot">
                                    <textarea id="FRM_adresse" name="FRM_adresse" class="form-control">
                                        <?php echo $place->getAdresse(); ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" >
                                    <input id="FRM_codePostale" name="FRM_codePostale" class="form-control" type="text" placeholder="Code postale" value="<?php echo $place->getCodePostale(); ?>">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" >
                                    <input id="FRM_ville" name="FRM_ville" class="form-control" type="text" placeholder="Ville" value="<?php echo $place->getVille(); ?>">
                                </div>
                            </div>
                        </div>
                </form>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Informations générales</div>
                <div class="panel-body">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" >
                            <label for="titre">Titre de l'événement</label>
                            <input id="titre" name="titre" class="form-control" type="text" placeholder="Titre de l'événement" value="<?php echo $decodeObj->getLibelleEvenement(); ?>">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="type">Type d'évenement</label>
                            <select name="type" name="type" id="type" class="form-control" value="<?php echo $decodeObj->getTypeEvenement(); ?>">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="container-fluid">
                            <label for="description">Descrpition</label>
                            <div id="description" class="<?php echo $summernote_class; ?> col-lg-12">
                                <textarea rows="10" name="description" cols="50" class="form-control">
                                <?php echo $decodeObj->getDescriptionEvenement(); ?>
                                </textarea>
                            </div>                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- iterations -->
    <div id="iterations" class="tab-pane fade">
        <div class="row">
<!--
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-plus-circle fa-fw"></i>Ajouter une occurence</h3>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-2"> 
                <ul class="pager">
                    <li id="previous" class="previous"><a href="#" Onclick="navOccurence(<?php echo Occurence::K_precedent ?>)">Précédent</a></li>
                </ul>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-lg-6">
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" id="dateDebut" name="dateDebut" value="<?php echo $occurence->getDateDebut(); ?>"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" id="dateFin" name="dateFin" value="<?php echo $occurence->getDateFin(); ?>"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <ul class="pager">
                    <li id="next" class="next"><a href="#" onclick="navOccurence(<?php echo Occurence::K_suivant ?>)">Suivant</a></li>
                </ul>
            </div>
-->
        </div>
    </div>
    <!-- fin iterations -->
  
      
    <!-- Contact -->
    <div id="contact" class="tab-pane fade">
        <div class="row">&nbsp;</div>
        <?php $objOrganisateur = $decodeObj->getOrganisateur(); ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Contact
                </div>
                <div class="panel-body">
                    <div class="alert alert-success" role="alert">
                        Par défaut, les informations sont celles de l'organisation
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="Tel" class="hidden-sm hidden-xs"># Téléphone</label>
                        <input id="Tel" name="Tel" class="form-control" type="phone" placeholder="Numéro de téléphone" value="<?php echo $objOrganisateur->getTelephone(); ?>">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="mail" class="hidden-sm hidden-xs">Adresse email</label>
                        <input id="mail" name="mail" class="form-control" type="email" placeholder="email de contact" value="<?php echo $objOrganisateur->getMail(); ?>">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="web" class="hidden-sm hidden-xs">Site internet</label>
                        <input id="web" name="web" class="form-control" type="phone" placeholder="Site Web" <?php echo $etat_champs; ?>>
                    </div>
                    <div class="container-fluid">
                        <label for="contact">notes</label>
                        <textarea class="form-control" rows="3" <?php echo $etat_champs; ?>></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Contact -->
      
    <!-- Info complémentaires -->
    <div id="complement" class="tab-pane fade">
        <div class="row">&nbsp;</div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Informations complémentaires
                </div>
                <div class="panel-body">

                    <div class="container-fluid">
                        <label for="tags" class="hidden-sm hidden-xs">Tags</label>
                        <input id="tags" name="tags" class="form-control" type="text" placeholder="Mots clés pour décrire l'événement" value="<?php echo $decodeObj->getlistTags(); ?>">
                        <label for="tags" class="hidden-sm hidden-xs">Prix</label>
                        <input id="prix" name="prix" class="form-control" type="text" placeholder="Informations concernant le prix" <?php echo $etat_champs; ?>>
                        <label for="hebergement">Hebergement</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                            input type="checkbox" aria-label="..." <?php echo $etat_champs; ?>>
                            </span>
                            <input name="hebergement" type="text" class="form-control" aria-label="..." <?php echo $etat_champs; ?>>
                        </div><!-- Hebergement -->
                        <label for="gardeenfants">Garde d'enfant</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" aria-label="..." <?php echo $etat_champs; ?>>
                            </span>
                            <input name="gardeenfants" type="text" class="form-control" aria-label="..." <?php echo $etat_champs; ?>>
                        </div><!-- garde enfant -->
                        <label for="type">Themes</label>
                        <select name="type" id="type" class="form-control" multiple="true" <?php echo $etat_champs; ?>>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        <label for="Tel" class="hidden-sm hidden-xs">Intervenants</label>
                        <input id="Tel" name="Tel" class="form-control" type="phone" placeholder="Saisir les 1ères lettre de l'intervenant recherché" <?php echo $etat_champs; ?>>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Infos complémentaires -->
    
    <!-- Medias-->
    <div id="media" class="tab-pane fade">
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Ajouter des images
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <label for="exampleInputFile">image</label>
                            <input type="file" id="form-control exampleInputFile" <?php echo $etat_champs; ?>>
                            <p class="help-block">Dimension min 600 x 300.</p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <br/>
                            <button class="btn btn-default" <?php echo $etat_champs; ?>>Ajouter</button>
                        </div>
                        <div class="col-lg-12">
                            <p>Cliquer sur une image pour la supprimer : </p>
                            <ul class="list-inline">
                                <li class="">
                                    <a class="pointer-link" <?php if($visibility){ ?>onClick="alert('êtes vous sur de vouloir supprimer cette image');" <?php } ?>><img src="http://placehold.it/100x50" class="img-rounded img-responsive"/></a>
                                </li>
                                <li class="">
                                 <a class="pointer-link"  <?php if($visibility){ ?>onClick="alert('êtes vous sur de vouloir supprimer cette image');" <?php } ?>><img src="http://placehold.it/100x50" class="img-rounded img-responsive"/></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Ajouter des vidéos (Youtube, vimeo, dailymotion)
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-lg-12">
                            <label for="exampleInputFile">Adresse</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Coller le lien de la vidéo" <?php echo $etat_champs; ?>>
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" <?php echo $etat_champs; ?>>Go!</button>
                                </span>
                            </div><!-- /input-group -->
                            <br/>
                            <ul class="list-unstyled">
                                <li class="">
                                    <a href="linkVIDEO" target="_blank">
                                        <span class="fa fa-youtube youtube" aria-hidden="true"></span>  -  http://youtube.fr/dfdiuX78HJ
                                    </a>
                                    <?php if($visibility){ ?>
                                    <a class="pointer-link" onClick="alert('supprimer la vidéo ?')">
                                        <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                                    </a>  
                                    <?php } ?>
                                </li>
                                <li class="">
                                    <a href="linkVIDEO" target="_blank">
                                        <span class="fa fa-vimeo-square vimeo" aria-hidden="true"></span>  -  http://vimeo.com/dfdiuX78HJ
                                    </a>
                                    <?php if($visibility){ ?>
                                    <a class="pointer-link" onClick="alert('supprimer la vidéo ?')">
                                        <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                                    </a>  
                                    <?php } ?>
                                </li>
                                <li class="">
                                    <a href="linkVIDEO" target="_blank">
                                        <span class="fa fa-video-camera dailymotion" aria-hidden="true"></span>  -  http://dailymotion.fr/dfdiuX78HJ
                                    </a>

                                    <?php if($visibility){ ?>
                                    <a class="pointer-link" onClick="alert('supprimer la vidéo ?')">
                                        <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                                    </a>  
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Medias-->
</div>
  
<div class="row">
    
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
         <button type="submit" class="btn btn-default col-lg-12" <?php echo $etat_champs; ?>>Sauvegarder</button>
    </div>
    
</div>
<br/>