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

        <div class='row hidden-xs hidden-sm col-lg-3 col-md-3 col-sm-12 col-xs-12'>
            <div id="EventSearchColumn">
                <input type="text" id="search"/>
               <h5>Des événements pour tous</h5>
               <ul class="list-inline eventSearchInput" id="listeTypesEvenements">
<!--                     Liste des types-->
                </ul>
                <input type="hidden" class="eventSearchInput" id="types"/>   
                <h5>Affiner votre recherche</h5>
                <input type="text" class="form-control eventSearchInput" id="mots" placeholder="Mots clés">
                <input type="text" id="dep" class="form-control eventSearchInput" placeholder="departement"/>
                <select id="listePays" class="form-control"></select>
                <select id="listeArea1" class="form-control"></select>
                <select id="listeArea2" class="form-control"></select>
                
                <input type="date" id="datemin" class="form-control eventSearchInput" placeholder="date min"/>
                <input type="date" id="datemax" class="form-control eventSearchInput" placeholder="date max"/>
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