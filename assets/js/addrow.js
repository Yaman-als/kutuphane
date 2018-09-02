//var adrowform = document.getElementById("modal-6");

/*
document.getElementById("savech").addEventListener('click', makeRequest);

function makeRequest() {
    var veri = $("#veriler").serialize();
    alert(veri);
}

(function() {
    var httpRequest;
    document.getElementById("savech").addEventListener('click', makeRequest);

    function makeRequest() {
        httpRequest = new XMLHttpRequest();

        if (!httpRequest) {
            alert('Giving up :( Cannot create an XMLHTTP instance');
            return false;
        }

        var veri = JSON.stringify($("#veriler").serialize());

        httpRequest.onreadystatechange = alertContents;
        httpRequest.open('POST','data/database.php');
        httpRequest.send(veri);
    }

    function alertContents() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                alert(httpRequest.responseText);
            } else {
                alert('There was a problem with the request.');
            }
        }
    }
})();


var veri = JSON.stringify($("#veriler").serialize());

ekle.onclick = function() {
    var lisansadi = $("input#field-1").val();
    alert(lisansadi);
}

*/
var ekle = document.getElementById("savech");
ekle.onclick = function (){

    var listipi ;
    if (document.getElementById("rd-2").checked) {
        listipi = 2;
    } else if (document.getElementById("rd-3").checked){
        listipi = 3;
    } else {
        listipi = 1;
    }

    $.ajax({
        url: 'data/database.php',
        method: 'POST',
        dataType: 'json',
        data: {
            lisansadi:   $('input#field-1').val(),
            firmaadi:    $('input#field-2').val(),
            baslatarihi: $('input#field-3').val(),
            bitistarihi: $('input#field-4').val(),
            lisanstipi:   listipi,
            uyarisuresi: $('input#field-5').val(),
            notee:       $('textarea#field-7').val()
        }
        ,
        error: function()
        {
            alert("An error occoured!");
        },
        success: function(response)
        {
            alert(response);
                /*
             From response you can fetch the data object returned
            var lisansadi = response.submitted_data.field-1,
                firmaadi = response.submitted_data.field-2,
                baslatarihi = response.submitted_data.field-3,
                bitistarihi = response.submitted_data.field-4,
                uyarsuresi = response.submitted_data.field-5,
                notee = response.submitted_data.field-7;
                */

        }
    });
};
