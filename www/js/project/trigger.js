/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#listeEvenements').jscroll({
    autoTriggerUntil: 3
});


$(function(){
    $('#save_value').click(function(){
        var valeurs = [];
        $('input:checked[name=types]').each(function() {
            valeurs.push($(this).val());
        });
        console.log(valeurs);
    });
    //shorthand document.ready function
    $('#formResearch').on('submit', function(e) { //use on if jQuery 1.7+

        e.preventDefault();  //prevent form from submitting
        pageEvenements(false,false);
        recupCheckbox('themes[]');
        alert(recupTextField('search-motscles'));
        
    });
    
    $('#resetSearchForm').on('click', function(e) { //use on if jQuery 1.7+
        e.preventDefault();  //prevent form from submitting
        $('#formResearch')[0].reset();
        pageEvenements(false,false);
    });
});
//
//$(function() {
//    $('#formResearch').submit(function() {
//        pageEvenements(true,false);
//    });
//});

$(window).load(function() {
  $('img').each(function() {
    if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
      // image was broken, replace with your new image
      this.src = 'img/12.jpg';
      //alert('error on image');
    }
  });
});
