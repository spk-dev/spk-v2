/**
 * API - USERVOICE
 * 
 */


(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/DTbQzQuxhieQjAGWkTrAw.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})()

UserVoice = window.UserVoice || [];
UserVoice.push(['showTab', 'classic_widget', {
    mode: 'full',
    primary_color: '#1b6b74',
    link_color: '#393c42',
    default_mode: 'support',
    forum_id: 259025,
    tab_label: 'Suggestions',
    tab_color: '#1b6b74',
    tab_position: 'middle-right',
    tab_inverted: true
}]);



/**
 * API COVOITURAGE
 */

/**
 * Génère les blocs de covoiturage blablacar
 * @param {string} type : "passager" pour la recherche de covoit, "conducteur" pour la proposition de covoit
 * @param {string} ville
 * @returns {Html}
 */
function widgetCovoiturage(type,ville){
    
    var h = "";          
                  
    if(type === "passager"){
        h = '<iframe src="http://www.covoiturage.fr/widget/FR_WIDGET_PSGR?to='+ville+'" height="270px" style="border:0px; padding:0px;"  frameborder="0" scrolling="no" class="twelve"></iframe>';
    }else if(type === "conducteur"){
        h = '<iframe src="http://www.covoiturage.fr/widget-conducteur/FR_WIDGET_DRVR?to='+ville+'" style="border:0px; padding:0px;" height="270px" frameborder="0" scrolling="no" class="twelve"></iframe>';
    }else{
        h = 'erreur';
    }
    
    return h;
}