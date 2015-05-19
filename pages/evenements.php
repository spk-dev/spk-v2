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

        <div class='row hidden-xs hidden-smcol-lg-3 col-md-3 col-sm-12 col-xs-12'>
            <div id="EventSearchColumn">
                <h5>Affiner votre recherche</h5>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Mots clés">
                 
                <h5>Vos événements tout le temps</h5>
                <ul class="list-group"  id="listeOrder">
                    <!-- LISTE DES MOIS -->
                </ul>
            </div>
        </div>
        <div class='col-lg-9 col-md-9 col-sm-12 col-xs-12' id="containerListeEvenements">
            <div class="row">
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
<!--                    <ol class="breadcrumb" style="v-align:center;">
                        <li>djf ms fdfdfdsfdfaz zadapf odkfj faofkjd pfjhdf  flskjfhdf dslkfjdhf kqjhdf lkjfh lfksjfs dmlfkj</li>
                        <li>djf msqdlfdd d s fdfd fdsqf dsqf dfdsf dsfdfdsfq df sdfslfkj</li>
                        <li>djf msqdlfd df d fs fd d fmlfkj</li>
                      </ol>-->
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

<section  class="hidden-xs hidden-sm hidden-print row" id="map-evenements">
    <a name='map'></a>
    <div class="container" >
        <div id="map-container" class="col-lg-12"></div>
    </div>
</section>