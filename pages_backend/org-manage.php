<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-plus-circle fa-fw"></i>Ajouter une organisation</h1>
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
                <button type="button" class="btn btn-default" data-toggle="popover" title="Info" data-content="50% requis pour activer la fiche"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Compléter le profil pour activer</button>
                <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>  Activé - cliquer pour desactiver</button>
                <button type="button" class="btn btn-danger" ><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>  Désactivé - cliquer pour activer</button>
                <button type="button" class="btn btn-danger" data-toggle="popover" title="Question" data-content="Contactez le support via la page contact"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true" ></span> Non validé par l'équipe Spibook</button>
                <button type="button" class="btn btn-success" disabled><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" ></span> Validé par l'équipe spibook</button>
            </div>
            &nbsp;
             
        </div>
    </div>
    <div class="col-lg-5 col-md-4 col-xs-6 col-sm-6">
          <div class="well">
            <h4>Sauvegarder</h4>
            <button type="submit" class="btn btn-default col-lg-12">Sauvegarder</button>
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
                        <div class="form-group col-lg-6 col-md-4 col-sm-12 col-xs-12" >
                            <label for="titre">Nom de l'organisation</label>
                            <input id="titre" class="form-control" type="text" placeholder="Nom de l'organisation">
                        </div>
                            <div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <label for="type">Type d'organisation</label>
                                <select name="type" id="type" class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <label for="communaute">Communauté</label>
                                <select name="communaute" id="communaute" class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                            </div>
                        </div>
                    <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                        <div class="form-group col-lg-12">
                            <label for="exampleInputFile">image</label>
                            <img src="http://placehold.it/350x150" class="img-responsive"/>
                            
                            <input type="file" id="form-control exampleInputFile">
                            <p class="help-block">Dimension min 600 x 300.</p>
                          </div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
                         <div class="container-fluid">
                             <label for="address2">Descrpition</label>
                            <div id="description" class="summernote col-lg-12">Hello Summernote</div>
                            
                         </div>
                    </div>
            </div>
        </div>
    </div>
    <!--                Contact -->
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Contact
            </div>
            <div class="panel-body">
                <div class="form-group col-lg-12">
                    <label for="Tel" class="hidden-sm hidden-xs"># Téléphone</label>
                    <input id="Tel" name="Tel" class="form-control" type="phone" placeholder="Numéro de téléphone">
                </div>
                <div class="form-group col-lg-12">
                    <label for="Fax" class="hidden-sm hidden-xs"># Fax</label>
                    <input id="fax" name="fax" class="form-control" type="phone" placeholder="Numéro de fax">
                </div>
                <div class="form-group col-lg-12">
                    <label for="mail" class="hidden-sm hidden-xs">Adresse email</label>
                    <input id="mail" name="mail" class="form-control" type="email" placeholder="email de contact">
                </div>
                <div class="form-group col-lg-12">
                    <label for="web" class="hidden-sm hidden-xs">Site internet</label>
                    <input id="web" name="web" class="form-control" type="phone" placeholder="Site Web">
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
                    <label for="hebergement">Hebergement</label>
                   <div id="hebergement" class="summernote col-lg-12">hebergement</div>

                </div>
                <div class="container-fluid">
                    <label for="deplacement">Deplacement</label>
                   <div id="deplacement" class="summernote col-lg-12">Deplacement</div>

                </div>
                
            </div>

        </div>
    </div>
<!--            Fin Infos complémentaires -->
    
    <!--                Informations générales-->
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
                                <input id="address2" class="form-control" type="text" placeholder="Commencer à saisir l'adresse ici...">
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
                                <input type="text" name="street_number" id="street_number" class="form-control" placeholder="Numéro"/>
                            </div>
                             <div class="form-group col-lg-8">
                                <label for="route">rue</label>
                                <input type="text" name="route" id="route" class="form-control" placeholder="Rue"/>
                             </div>
                            <div class="form-group col-lg-4">
                                <label for="postal_code">CP</label>
                                <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Code postal"/>
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="locality">Ville</label>
                                <input type="text" name="locality" id="locality" class="form-control" placeholder="Ville"/>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="administrative_area_level_2">Departement</label>
                                <input type="text" name="administrative_area_level_2" id="administrative_area_level_2" class="form-control" placeholder="Département"/>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="administrative_area_level_1">Region</label>
                                <input type="text" name="administrative_area_level_1" id="administrative_area_level_1" class="form-control" placeholder="Région"/>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="country">Pays</label>
                                <input type="text" name="country" id="country" class="form-control" placeholder="Pays"/>
                            </div>
                            <div class="form-group col-lg-5">
                                <label for="locality">Longitude</label>
                                <input type="text" name="Longitude" id="Longitude" class="form-control" placeholder="longitude"/>
                             </div>
                             <div class="form-group col-lg-5">
                                <label for="locality">Latitude</label>
                                <input type="text" name="Latitude" id="Latitude" class="form-control" placeholder="latitude"/>
                             </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--            Fin Informations générales-->

    
</div>
<div class="row">
    <div class="col-lg-8 col-md-7 col-xs-6 col-sm-6">
         <p>
            <strong>Task 1</strong>
            <span class="pull-right text-muted">40% Complete</span>
        </p>
        <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                <span class="sr-only">40% Complete (success)</span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-5 col-xs-6 col-sm-6">
         <button type="submit" class="btn btn-default col-lg-12">Sauvegarder</button>
    </div>
    
</div>  
