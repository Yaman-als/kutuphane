function iade (no){
    $.ajax({
        url: 'odunciade.php',
        method: 'POST',
        dataType: 'json',
        data: {
            no: no,
        },
        error: function () {
            alert("Bir hata oldu!");
        },
        success: function (response) {
            if (response['resp'] == "tamam"){
                if(!alert("Kitap iade edildi.")) document.location = 'aldiginodunc.php';
            }
        }
    })
}