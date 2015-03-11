<?php
/**
 * User: benjamin
 * Date: 13/11/14
 * Time: 21:33
 */

?>




<!--    Dynamique grid EVENEMENTS-->
<section id="evenements" class="">

    <div class="container">

        <div class='col-lg-3 col-md-3 col-sm-12 col-xs-12'>
            <div class='row hidden-xs hidden-sm hidden-md'>
                <a href='#map'>
                    <img src='img/flaticon-map.png' alt='Voir la carte' class='img-responsive'/>
                </a>
            </div>
            <div class='row'>
                <form role="form" name="formResearch" id="formResearch">

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOrganisateurs">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOrganisateurs" aria-expanded="true" aria-controls="collapseOrganisateurs">
                                            Organisateurs
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOrganisateurs" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOrganisateurs">
                                    <div class="panel-body" id="listeOrganisateurs">

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThemes">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThemes" aria-expanded="true" aria-controls="collapseThemes">
                                            Thèmes
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThemes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThemes">
                                    <div class="panel-body" id="listeThemes">

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTypes">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTypes" aria-expanded="false" aria-controls="collapseTypes">
                                            Types
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTypes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTypes">
                                    <div class="panel-body" id="listeTypes">

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingDates">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseDates" aria-expanded="false" aria-controls="collapseDates">
                                            Dates
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseDates" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingDates">
                                    <div class="panel-body">

                                            <label for="start">Date d'événement</label>
                                            <input type="text" class="form-control" name="start" id='start' placeholder="date minimum"/>
                                            <input type="text" class="form-control" name="end" id='end' placeholder="date maximum"/>

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingMotsCles">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseMotsCles" aria-expanded="true" aria-controls="collapseMotsCles">
                                            Mots clés
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseMotsCles" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingMotsCles">
                                    <div class="panel-body">
                                        <input type="text" name="search-motscles" class="form-control" id="search-motscles" placeholder="Mots clés"/>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="reset" class="btn btn-default" id="resetSearchForm">Reset</button>
                        <button type="submit" class="btn btn-default">Rechercher</button>


                    </div>



                </form>
            </div>
        </div>
        <div class='col-lg-9 col-md-9 col-sm-12 col-xs-12'>
            <div class="row">
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <ol class="breadcrumb" style="v-align:center;">
                        <li>djf ms fdfdfdsfdfaz zadapf odkfj faofkjd pfjhdf  flskjfhdf dslkfjdhf kqjhdf lkjfh lfksjfs dmlfkj</li>
                        <li>djf msqdlfdd d s fdfd fdsqf dsqf dfdsf dsfdfdsfq df sdfslfkj</li>
                        <li>djf msqdlfd df d fs fd d fmlfkj</li>
                      </ol>
                </div> 
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panel panel-default">
                        <span id="nbItems"></span> événement<span id="plural"></span> correspondant à votre recherche
                    </div>
                    
                </div>
            </div>
            
            <div class="col-lg-12" id="loading">
                <img src="../www/img/ajax_loader.gif" width="5%" height="5%"/>
            </div>
            <div id="listeEvenements" >

                <!-- LISTE AJAX EVENEMENTS-->
            </div>
        </div>
    </div>
</section>

<section  class="hidden-xs hidden-sm hidden-print row">
    <a name='map'></a>
    <div class="container" >
        <div id="map-container" class="col-lg-12"></div>
    </div>
</section>