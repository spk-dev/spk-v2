

//liste des variables
var tableauMarqueurs = [];
var Marqueur;
var maCarte;
var zoneMarqueurs = new google.maps.LatLngBounds();

/**
 * Initialiser la carte
 * @returns {void}
 */
function initialisation() {
    console.log("dans initialisation");
        var optionsCarte = {
                zoom: 8,
                center: new google.maps.LatLng( 47.389982, 0.688877 ),
                mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        maCarte = new google.maps.Map( document.getElementById("map-container"), optionsCarte );
        
//         console.log("dans initialisation taille tableauMarqueurs "+tableauMarqueurs.length);
        if(tableauMarqueurs.length === 0){
            ajouteMarqueur( Marqueur );
        }else{
            for( var i = 0, I = tableauMarqueurs.length; i < I; i++ ) {
                ajouteMarqueur( tableauMarqueurs[i] );
            }
             maCarte.fitBounds( zoneMarqueurs );
        }
        
       
}


/**
 * Ajoute un marqueur sur la carte
 * @param {object} latlng
 * @returns {void}
 */
function ajouteMarqueur( event ) {
        
        var image       = urlMarqueur;
        var latitude    = event.lat;
        var longitude   = event.lng;
        var popup       = event.titre;
        var date        = event.date;
        var lieu        = event.titre;
        var id          = event.id;
        
                
                
//        console.log("dans ajouteMarqueur id : {"+id+"}");
//        console.log("dans ajouteMarqueur lat : {"+latitude+"}");
//        
        var optionsMarqueur = {
                map: maCarte,
                position: new google.maps.LatLng( latitude, longitude ),
                icon: image,
                title : popup
        };
        var html = "<div class='infowindowgmap'>";
        html    += "<h1>"+id+"  "+popup+"</h1>";
        html    += "<p class='date'>"+date+"</p>";
        html    += "<p class='lieu'>"+lieu+"</p>";
        html    += "</div>";
        var marqueur = new google.maps.Marker( optionsMarqueur );

        zoneMarqueurs.extend( marqueur.getPosition() );

        var infowindow = new google.maps.InfoWindow({
            content: html
        });

        google.maps.event.addListener(marqueur, 'mouseover', function() {
            infowindow.open(maCarte,marqueur);
          });
        google.maps.event.addListener(marqueur, 'mouseout', function() {
            infowindow.close();
        });
        google.maps.event.addListener(marqueur, 'click', function() {
            window.location.href='index.php?page=evenement&id='+id;
        });
}


/**
 * Load la MAP sur la page
 * @returns {undefined}
 */
function loadMap(){
    google.maps.event.addDomListener( window, 'load', initialisation );
}