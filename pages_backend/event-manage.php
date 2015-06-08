<?php

$etat_champs        = null;
$summernote_class   = null;
$visibility         = null;

$value_action_read = "r";
$value_action_write = "w";


if(isset($_GET['action'])){
    $act = $_GET['action'];
    switch ($act) {
        case $value_action_read:
            $etat_champs = "disabled";
            $summernote_class = "";
            $visibility = false;

            break;
        case $value_action_write:
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

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-plus-circle fa-fw"></i>Ajouter un évenement</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="well">
            <label for="type">Type d'évenement</label>
            <select name="type" id="type" class="form-control" <?php echo $etat_champs; ?>>
                <option>Org 1 - ville / dep</option>
                <option>Org 2 - ville / dep</option>
                <option>Org 3 - ville / dep</option>
            </select>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 hidden-xs">
        <div class="well">
            <h4>Avancement</h4>
            <p>
              <span class="pull-right text-muted">40%</span>
           </p>
           <div class="progress progress-striped active">
               <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                   <span class="sr-only">40%</span>
               </div>
           </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-xs-6 col-sm-6 ">
        <div class="well">
            <h4>Activation / validation</h4>
            <div class="btn-group-vertical" role="group" aria-label="...">
                
                <button type="button" class="btn btn-success" <?php echo $etat_champs; ?>><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>  Activé - cliquer pour desactiver</button>
                <button type="button" class="btn btn-danger" <?php echo $etat_champs; ?>><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>  Désactivé - cliquer pour activer</button>
                
            </div>
            &nbsp;
             
        </div>
    </div>
    <div class="col-lg-5 col-md-4 col-xs-6 col-sm-6">
          <div class="well">
            <h4>Sauvegarder</h4>
            <button type="submit" class="btn btn-default col-lg-12" <?php echo $etat_champs; ?>>Sauvegarder</button>
            &nbsp;
          </div>
    </div>
    
</div>







<div class="row">
    
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Informations générales
                </div>
                <div class="panel-body">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" >
                            <label for="titre">Titre de l'événement</label>
                            <input id="titre" class="form-control" type="text" placeholder="Titre de l'événement" <?php echo $etat_champs; ?>>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="type">Type d'évenement</label>
                            <select name="type" id="type" class="form-control" <?php echo $etat_champs; ?>>
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
                            <div id="description" class="<?php echo $summernote_class; ?> col-lg-12">Hello Summernote</div>
                            
                         </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!--                Contact -->
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Contact
            </div>
            <div class="panel-body">
                <div class="alert alert-success" role="alert">Par défaut, les informations sont celles de l'organisation</div>
                <div class="form-group col-lg-12">
                    <label for="Tel" class="hidden-sm hidden-xs"># Téléphone</label>
                    <input id="Tel" name="Tel" class="form-control" type="phone" placeholder="Numéro de téléphone" <?php echo $etat_champs; ?>>
                </div>
                <div class="form-group col-lg-12">
                    <label for="mail" class="hidden-sm hidden-xs">Adresse email</label>
                    <input id="mail" name="mail" class="form-control" type="email" placeholder="email de contact" <?php echo $etat_champs; ?>>
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
<!--            Fin Contact -->
<!--            Info complémentaires -->
    <div class="col-lg-8 col-md-6 col-xs-12 col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Informations complémentaires
            </div>
            <div class="panel-body">
                
                <div class="container-fluid">
                    <label for="tags" class="hidden-sm hidden-xs">Tags</label>
                    <input id="tags" name="tags" class="form-control" type="text" placeholder="Mots clés pour décrire l'événement" <?php echo $etat_champs; ?>>
<!--                    http://stackoverflow.com/questions/519107/jquery-autocomplete-tagging-plug-in-like-stackoverflows-input-tags-->
                   <label for="tags" class="hidden-sm hidden-xs">Prix</label>
                    <input id="prix" name="prix" class="form-control" type="text" placeholder="Informations concernant le prix" <?php echo $etat_champs; ?>>
                   <label for="hebergement">Hebergement</label>
                   <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" aria-label="..." <?php echo $etat_champs; ?>>
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
    <!--            Fin Infos complémentaires -->
    <!--    Medias-->
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
                                -  
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
                                -  
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
                                -  
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
    <!--    Fin Medias-->
    <!--                lOCALISATION-->
    <div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Localisation
            </div>
            <div class="panel-body">
                <div class="col-lg-7 col-md-8 col-xs-12 col-sm-12">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="address2">Saisissez votre adresse ici</label>
                            <input id="address2" class="form-control" type="text" placeholder="Commencer à saisir l'adresse ici..." <?php echo $etat_champs; ?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="address2">Vous pouvez déplacer le curseur sur la carte pour choisir un emplacement</label>
                        <div id="map" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>

                        </div>


                    </div>
                </div>
                <div class="col-lg-5 col-md-4 col-xs-12 col-sm-12">
<!--                        <pre class="response row" id="response2"></pre>-->
                    <div class="row" id="">
                        <div class="form-group col-lg-4">
                            <label for="street_number">Numéro</label>
                            <input type="text" name="street_number" id="street_number" class="form-control" placeholder="Numéro" <?php echo $etat_champs; ?>/>
                        </div>
                         <div class="form-group col-lg-8">
                            <label for="route">rue</label>
                            <input type="text" name="route" id="route" class="form-control" placeholder="Rue" <?php echo $etat_champs; ?>/>
                         </div>
                        <div class="form-group col-lg-4">
                            <label for="postal_code">CP</label>
                            <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Code postal" <?php echo $etat_champs; ?>/>
                        </div>
                        <div class="form-group col-lg-8">
                            <label for="locality">Ville</label>
                            <input type="text" name="locality" id="locality" class="form-control" placeholder="Ville" <?php echo $etat_champs; ?>/>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="administrative_area_level_2">Departement</label>
                            <input type="text" name="administrative_area_level_2" id="administrative_area_level_2" class="form-control" placeholder="Département" <?php echo $etat_champs; ?>/>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="administrative_area_level_1">Region</label>
                            <input type="text" name="administrative_area_level_1" id="administrative_area_level_1" class="form-control" placeholder="Région" <?php echo $etat_champs; ?>/>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="country">Pays</label>
                            <input type="text" name="country" id="country" class="form-control" placeholder="Pays" <?php echo $etat_champs; ?>/>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="locality">Longitude</label>
                            <input type="text" name="Longitude" id="Longitude" class="form-control" placeholder="longitude" <?php echo $etat_champs; ?>/>
                         </div>
                         <div class="form-group col-lg-5">
                            <label for="locality">Latitude</label>
                            <input type="text" name="Latitude" id="Latitude" class="form-control" placeholder="latitude" <?php echo $etat_champs; ?>/>
                         </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--            Fin Informations générales-->

    

<div class="row">
    
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
         <button type="submit" class="btn btn-default col-lg-12" <?php echo $etat_champs; ?>>Sauvegarder</button>
    </div>
    
</div>
<br/>
