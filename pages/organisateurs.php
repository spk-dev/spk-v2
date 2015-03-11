<?php
/**
 * User: benjamin
 * Date: 13/11/14
 * Time: 21:33
 */

?>

<section  class="hidden-xs hidden-sm hidden-print row">
    <a name='map'></a>
    <div class="container" >
        <div id="map-container" class="col-lg-12"></div>
    </div>
</section>


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
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Thèmes
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body" id="listeThemes">

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Types
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body" id="listeTypes">

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Dates
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">

                                            <label for="start">Date d'événement</label>
                                            <input type="text" class="form-control" name="start" id='start' placeholder="date minimum"/>
                                            <input type="text" class="form-control" name="end" id='end' placeholder="date maximum"/>

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFive">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                            Mots clés
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFive">
                                    <div class="panel-body">
                                        <input type="text" name="search-motscles" class="form-control" id="search-motscles" placeholder="Mots clés">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-default">Rechercher</button>


                    </div>



                </form>
            </div>
        </div>
        <div class='col-lg-9 col-md-9 col-sm-12 col-xs-12'>
            <div class="row">
                <div class='col-lg-2 col-md-2 col-sm-3 col-xs-4'>
                    <select class='form-control nbItemParPage' id="nbItemParPage" onChange="modifyNbItemParPage();">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3" selected>3</option>
                        <option value="10">10</option>
                        <option value="30">30</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class='col-lg-10 col-md-10 col-sm-9 col-xs-8'>
                    <span id="nbItems"></span> événement<span id="plural"></span> correspondant à votre recherche
                </div>
            </div>
            <div class='row'>
                <nav>
                    <input type="hidden" id="currentPage" value="1"/>

                    <ul class="pagination pagination-sm" id="pagination"></ul>

                </nav>
            </div>
            <div class="col-lg-12" id="loading">
                <img src="../www/img/ajax_loader.gif" width="5%" height="5%"/>
            </div>
            <div id="listeItems" >

                <!-- LISTE AJAX EVENEMENTS-->
            </div>
            <div class='row'>
                <nav>

                    <ul class="pagination pagination-sm" id="pagination2"></ul>

                </nav>
            </div>
        </div>
    </div>
</section>

