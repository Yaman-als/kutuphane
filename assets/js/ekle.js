function kitapekle(){
    $.ajax({
        url: 'ekle.php',
        method: 'POST',
        dataType: 'json',
        data: {
            isbn:          $("input#isbn").val(),
            kitapadi:      $("input#kitapadi").val(),
            yazaradi:      $("input#yazaradi").val(),
            yayinevi:      $("input#yayinevi").val(),
            basimyili:     $("input#basimyili").val(),
            salonno:       $("input#salonno").val(),
            rafno:         $("input#rafno").val(),
            dolapno:       $("input#dolapno").val(),
            demirbasno:    $("input#demirbasno").val(),
            kategori: 	$('#kategori option:selected').text()
        },
        error: function()
        {
            alert("Bir hata oldu!");
        },
        success: function(response)
        {
            if (response['0'] == 1){
                if(!alert("Kitap kaydı yapıldı.")) document.location = 'oduncver.php';
            }else {
                if(!alert("Bir hata oldu.")) document.location = 'oduncver.php';
            }
        }
    });
}