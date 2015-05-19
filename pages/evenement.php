<?php
/**
 * User: benjamin
 * Date: 13/11/14
 * Time: 21:33
 */

?>




<!--    Dynamique grid EVENEMENTS-->
<section id="evenement" class="">

    <div class="container" id="Item">
        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            
            <div class="row row-evenement" id="">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" id="" >
                    
                    <div class='row block block_gris' id='evenement-block-titre' >
                        <h1 id="evenement-titre"><!-- TITRE DE L'EVENEMENT --></h1>
                        <h3 id='evenement-type'> <!--TYPE DE L'EVENEMENT --> </h3>
                        <h2><small>du&nbsp;</small><span id='evenement-date-debut'><!--DATE DE DEBUT DE L'EVENEMENT --></span> <small>&nbsp;au&nbsp;</small><span id='evenement-date-fin'><!--DATE DE FIN DE L'EVENEMENT--></span></h2>
                        <h4><a href="#map" id='evenement-ville'><!--VILLE--></a></h4>
                    </div>
                    
                    <div class='row' id='evenement-block-share'>
                        <!-- AddThis Button BEGIN -->
                        <div class="addthis_toolbox addthis_default_style addthis_32x32_style text-center" >
                        <a class="addthis_button_preferred_1 text-right"></a>
                        <a class="addthis_button_preferred_2"></a>
                        <a class="addthis_button_preferred_3"></a>
                        <a class="addthis_button_preferred_4"></a>
                        <div class='hidden-sm hidden-md'>
                            <a class="addthis_button_preferred_5"></a>
                            <a class="addthis_button_preferred_6"></a>
                            <a class="addthis_button_preferred_7"></a>
                        </div>
                        <a class="addthis_button_compact"></a>
                        
                        </div>
                        <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-538f1cbb01e1612d"></script>
                        <!-- AddThis Button END -->
                    </div>
                    
                    
             
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    
                    <div id='evenement-image' class=""><!-- IMAGE DE L'EVENEMENT --></div>
                </div>


            </div>

            <div class="row row-evenement" id="">
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id="evenement-block-adresse">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 block text-center">
                        <h3><span class="glyphicon glyphicon-th" aria-hidden="true">&nbsp;</span>Thématiques</h3>
                        <div id="evenement-liste-themes">
                            <!-- LISTE DES THEMES -->
                        </div>
                        
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 block text-center">
                        <h3><span class="glyphicon glyphicon-map-marker" aria-hidden="true">&nbsp;</span>Adresse</h3>
                        <p id="evenement-adresse"><!-- te --></p>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 block text-center">
                            <h3><span class="glyphicon glyphicon-calendar" aria-hidden="true">&nbsp;</span>horaires</h3>
                            <p>
                                du <span id="evenement-time-debut"></span>
                                <br/>au <span id="evenement-time-fin"></span>
                            </p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 block text-center">
                            <h3><span class="glyphicon glyphicon-envelope" aria-hidden="true">&nbsp;</span>Contact</h3>
                            <p>
                                <span id="evenement-mail" class="evenement-mail"><!-- mail --></span>
                                <br/>
                                <span id="evenement-web"><!-- site --></span>
                            </p>
                            <p class="text-right">
                                <a href="#description" onclick="manageTabs('evenement-description-tabs','evenement-informations-complementaires',1);">En savoir plus</a></p>

<!--                        </div>-->
                    </div>
                </div>
                
            </div>
            <a name="description"></a>
            <div class="row">


            </div>
                <!--                Onglet d'informations -->
            <div class="row" id="tabs-evenement">

                <div role="tabpanel" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="evenement-description-tabs">
                      <li role="presentation" class="active"><a href="#evenement-description" aria-controls="evenement-description" role="tab" data-toggle="tab">Description</a></li>
                      <li role="presentation"><a href="#evenement-informations-complementaires" aria-controls="evenement-informations-complementaires" role="tab" data-toggle="tab">Informations</a></li>
                      <li role="presentation"><a href="#evenement-informations-contact" aria-controls="evenement-informations-contact" role="tab" data-toggle="tab">Contact<span class="hidden-sm hidden-xs">er l'organisateur</span></a></li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="block tab-pane active text-justify" id="evenement-description">
                            <!--    DESCRIPITON DE L'EVENEMENT                  -->
                        </div>
                        <div role="tabpanel" class="block tab-pane block" id="evenement-informations-complementaires">
                            <!--    INFORMATIONS COMPLEMENTAIRES DE L'EVENEMENT -->
                            <h3>Les informations pratiques</h3>
                            <p id="evenement-hebergement"></p>
                            <p id="evenement-prix"></p>
                            <h3>Inscription</h3>
                            <p id="evenement-inscription"></p>
                            <p id="evenement-mail2" class="evenement-mail"></p>
                            <p id="evenement-contact"></p>
                            <h3>Intervenants</h3>
                            <p id="evenement-intervenants"></p>
                        </div>
                        <div role="tabpanel" class=" block tab-pane" id="evenement-informations-contact">
                            <h3>Contacter l'organisateur de l'événement</h3>
                            <form role="form">
                                <div id="evenement-hidden-form-infos">
                                    
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="control-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label class="control-label" for="contact-email">Votre nom</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" id="contact-nom" placeholder="Votre nom ici" required >
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="control-group col-lg-4 col-md-4 col-sm-7 col-xs-12">
                                        <label class="control-label" for="contact-email">Votre email</label>
                                        <div class="controls">
                                            <input type="email" class="form-control" id="contact-email" placeholder="Votre email ici" required >
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="control-group col-lg-4 col-md-4 col-sm-5 col-xs-12">
                                        <label class="control-label" for="contact-phone">Votre numéro de téléphone (optionnel)</label>
                                        <div class="controls">
                                            <input type="tel" class="form-control" id="contact-phone" placeholder="Votre numéro de téléphone" pattern="^[0-9]*"  data-validation-pattern-message="Merci de ne saisir que des chiffres">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label for="">Objet</label>
                                        <div class="checkbox">
                                            <label>
                                             <input type="checkbox"
                                                name="objet"
                                                value="informations"
                                                minchecked="1"
                                                data-validation-minchecked-message="Merci de saisir au moins 1 objet"
                                             />Demande d'informations
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                              <input type="checkbox"
                                                    name="objet"
                                                    value="inscription"
                                                    minchecked="1"
                                                    data-validation-minchecked-message="Merci de saisir au moins 1 objet"
                                                 />Demande d'inscription
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                              <input type="checkbox"
                                                    name="objet"
                                                    value="autre"
                                                    minchecked="1"
                                                    data-validation-minchecked-message="Merci de saisir au moins 1 objet"
                                                 />Autre
                                            </label>
                                        </div>
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="contact-message">Message</label>
                                        <textarea class="form-control" rows="3" id="contact-message" placeholder="Votre message ici" required ></textarea>
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="control-group">
                                        <div class="checkbox">
                                            <label>
                                              <input type="checkbox"
                                                    name="newsletter-spibook"
                                                    value="1"
                                                    checked
                                                 />Je souhaite être informé des nouveautés sur Spibook
                                            </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="checkbox">
                                            <label>
                                              <input type="checkbox"
                                                    name="newsletter-partenaires"
                                                    value="1"
                                                    checked
                                                 />Je souhaite recevoir les informations des partenaires de Spibook.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" id="sendmessagetoorganisateur">envoyer</button>
                            </form>
                        </div>
                    </div>

                  </div>

                
            </div>
            <div class="row" id="map-event">
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="map-container">
                    <a name='map'></a>
<!--                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d92428.70440188362!2d1.4194514125976454!3d43.61909514909934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12aebb6fec7552ff%3A0x406f69c2f411030!2sToulouse!5e0!3m2!1sfr!2sfr!4v1417008586684" width="100%" height="520" frameborder="0" style="border:0"></iframe>-->
                    
                </div> 
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="evenement-covoiturage">
              
                </div> 
                 <br/>
            </div>
            
            
<!--            <div class="row" id="comment-event">
                <br/>
                 Comments Form 
                <div class="well">
                    <h4>Laisser un commentaire</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">envoyer</button>
                    </form>
                </div>

                <hr>

                 Posted Comments 

                 Comment 
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Commentaire 1
                            <small>24/11/2014 - 11h46</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Commentaire 2
                            <small>16/11/2014 - 13h46</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>
                 Comment 
                

            </div>-->
               
        </div>
    </div>
           
</section>
<section>
     <div class="container">
        <div id="listeEvenements" >
              <!-- LISTE AJAX EVENEMENTS-->
          </div>

      </div>
</section>
