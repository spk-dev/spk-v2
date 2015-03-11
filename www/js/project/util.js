/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


///**
// * Fonction de pagination des listes
// * @param num
// * @returns {boolean}
// */
//function paginate(num){
//    var numPage = $('#currentPage').val();
//    var current = parseInt(numPage);
//
//    if(num !== current){
//        if(num === "prev"){
//            num = current - 1;
//        }else if(num === "next"){
//            num = current + 1;
//        }
//
//        if(num <= 1){
//            $('.prev').addClass('disabled');
//        }else{
//            $('.prev').removeClass('disabled');
//        }
//
//        var classInactive = ".page"+numPage;
//        var classActive = ".page"+num;
//
//        $('#currentPage').val(num);
//        $(classActive).addClass('active');
//        $(classInactive).removeClass('active');
//        pageEvenements(true,false);
//    }
//
//    return false;
//}


/**
 * Créer la liste de pagination
 * @param nbItems
 * @param nbItemsParPage
 * @param pageActive
 */
//function createPagination(nbItems, nbItemsParPage){
//    var i;
//    var j = parseInt(nbItems) / parseInt(nbItemsParPage);
//
//    var h = '<li class="prev"><span onclick="paginate(\'prev\');">&laquo;</span></li>';
//    for(i = 1 ; i <= j ; i++){
//        console.log("i"+i);
//        h += '<li class="page'+i+'"><span class="page" onclick="paginate('+i+');">'+i+'</span></li>';
//    }
//    h += '<li class="next"><span onclick="paginate(\'next\');">&raquo;</span></li>';
//    removePagination();
//    $('.pagination').append(h);
//}
//
///**
// * Retire la pagination quand le nb d'éléments à afficher est inférieur au nb d'item par page
// */
//function removePagination(){
//    $('.pagination li').remove();
//}


/**
 * Format la date jj/mm/aaaa
 * @param {dateTime} dateTime : AAAA-MM-JJ HH:MM:SS
 * @param {Str} format : text ou numerique
 * @returns {String}
 */
function formatDate(dateTime, format){
    var sep = "/";
    var A = dateTime.substr(0,4);
    var M = dateTime.substr(5,2);
    var J = dateTime.substr(8,2);
    
    var tab_mois = new Array("décembre","janvier", "février", "mars", "avril", "mai", "juin", "juillet","août","septembre","octobre","novembre");
        
    
    if(format==="text"){
        sep = " ";
        M = tab_mois[parseInt(M)];
    }
    
    return J+sep+M+sep+A;
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

