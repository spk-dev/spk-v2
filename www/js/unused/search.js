$(document).ready(function(){

    $('#search-themes').select2({

        multiple : true,
        minimumInputLength: 2,
        initSelection : function (element, callback) {
            var data = [];

//            $(element.val().split(",")).each(function () {
//                
//                 var pos = this.lastIndexOf(':'); // pos = 4 
//                 var len = this.length();
//                 var idval = substr(0, pos);
//                 var textval = substr(pos+1,len);
//                data.push({id: idval, text: textval});
//            });


            $(element.val().split(",")).each(function () {
                data.push({id: this, text: this});
            });

            callback(data);
        },
        ajax: {
            url: "rest/themes/",
            dataType: 'json',
            data: function (term, page) {
                return {
                    q: term
                };
            },
            results: function (data, page) {
                return { results: data };
            }
        }

    });
});  