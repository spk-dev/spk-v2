/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 * Format la date jj/mm/aaaa
 * @param {dateTime} dateTime : AAAA-MM-JJ HH:MM:SS
 * @param {Str} format : text ou numerique
 * @returns {String}
 */
function formatDate(dateTime, format){
    var d = "";
    var sep = "/";
    var A = dateTime.substr(0,4);
    var M = dateTime.substr(5,2);
    var J = dateTime.substr(8,2);
    
    
    var tab_mois = {
            1 : "janvier",
            2 : "février", 
            3 : "mars",
            4 : "avril",
            5 : "mai",
            6 : "juin",
            7 : "juillet",
            8 : "août",
            9 : "septembre",
            10: "octobre",
            11: "novembre",
            12: "décembre"};
    
    
    if(format==="text"){
        sep = " ";
        M = tab_mois[parseInt(M)];
        d = J+sep+M+sep+A;
    }else if(format === "numerique"){
        d = J+sep+M+sep+A;
    }else if(format === "moisAn"){
        sep = " ";
        M = tab_mois[parseInt(M)];
        d = M+sep+A;
    }
    
    
    return d;
}






function formatTime(dateTime,format){
    
    date = formatDate(dateTime,format);
    heure = dateTime.substr(11,5);
    var formattedTime = {
        date : date,
        time : heure
    };
//    var h = dateTime.getHour();
    return formattedTime;
}


/**
 * Gère le display ou le hide d'un onglet 
 * @param {string} idUl - id de la liste
 * @param {string} tabName - nom du tab concert
 * @param {string} action - show/hide
 * @returns {void}
 */
function manageTabs(idUl, tabName, action){
    if(action===1){
        action="show";
    }else{
        action="hide";
    }
    $('#'+idUl+' a[href="#'+tabName+'"]').tab('show'); // Select tab by name
}

/**
 * Trier les événements par mois
 * @returns {undefined}
 */
function sortListEvenement(){
    
}