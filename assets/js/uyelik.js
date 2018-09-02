
function siltel (no){
    $.ajax({
        url: 'uyelikk.php',
        method: 'POST',
        dataType: 'json',
        data: {
            arac: "tel",
            no: no
        },
        error: function () {
            alert("Bir hata oldu!");
        },
        success: function (response) {
            if (response['resp'] == "tamam"){
                if(!alert("Telefon numarınız silindi.")) document.location = 'uyelik.php';
            }else if (response['resp']== "silinmedi"){
                if(!alert("En az bir tane telefon numarınız olması lazım, telefon numaranız " +
                        "silinmedi.")) document.location = 'uyelik.php';
            }
        }
    })
}

function sileposta(no){
    $.ajax({
        url: 'uyelikk.php',
        method: 'POST',
        dataType: 'json',
        data: {
            arac: "eposta",
            no: no
        },
        error: function () {
            alert("Bir hata oldu!");
        },
        success: function (response) {
            if (response['resp'] == "tamam"){
                if(!alert("E-postanız silindi.")) document.location = 'uyelik.php';
            }else if(response['resp'] == "silinmedi"){
                if(!alert("En az bir tane E-postanınız olması lazım, E-postanız silinmedi."))
                    document.location = 'uyelik.php';
            }
        }
    })
}

var telpost = document.getElementById("telpost");
telpost.onclick = function (){
    $.ajax({
        url: 'uyelikk.php',
        method: 'POST',
        dataType: 'json',
        data: {
            iletisim: 	$('#arac option:selected').text(),
            deger:      $("input#deger").val()
        },
        error: function()
        {
            alert("Bir hata oldu!");
        },
        success: function(response)
        {
            if (response['0'] == 1){
                if(!alert("Telefon numaranız kaydedildi")) document.location = 'uyelik.php';
            }else if (response['0'] == 2){
                if(!alert("E-postanız kaydedildi")) document.location = 'uyelik.php';
            }else {
                if(!alert("Bir hata oldu.")) document.location = 'uyelik.php';
            }
        }
    });
}

function sifredegistir(){
    if ($("input#sifre-1").val() == $("input#sifre-2").val()){
        $.ajax({
            url: 'uyelikk.php',
            method: 'POST',
            dataType: 'json',
            data: {
                sifre:      $("input#sifre-1").val()
            },
            error: function()
            {
                alert("Bir hata oldu!");
            },
            success: function(response)
            {
                if (response['0'] == 1){
                    if(!alert("Şifreniz değiştirildi.")) document.location = 'uyelik.php';
                }else {
                    if(!alert("Bir hata oldu.")) document.location = 'uyelik.php';
                }
            }
        });
    }else {
        if(!alert("Yeni Şifre ile yeni şifre tekrarı uyuşmuyor.")) document.location = 'uyelik.php';
    }
}