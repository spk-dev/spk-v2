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
            </div>
        </div>
        <div class='col-lg-9 col-md-9 col-sm-12 col-xs-12'>
            
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

