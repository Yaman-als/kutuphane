var ara = document.getElementById("arabutton");
var arr;
ara.onclick = function (){
    $.ajax({
        url: 'home.php',
        method: 'POST',
        dataType: 'json',
        data: {
            ara: 			$("input#ara").val(),
        },
        error: function()
        {
            alert("Bir hata oldu!");
        },
        success: function(response)
        {

            // From response you can fetch the data object returned
            // arr = response.resp;
            // if (response){
            //     var tablo = document.getElementById("anatablo");
            //     var tr = document.createElement("tr");
            //     //var i ;
            //     //for (i=0; i <10;i++){
            //     var td = document.createElement("td");
            //     td.innerHTML = response.resp[1];
            //     tablo.appendChild(tr);
            //     tr.appendChild(td);
            //
            //     //}
            //
            // }else{
            //     alert("No result");
            // }
                // var adi = response.resp[1],
                //     soyad = response.resp[2],
                //     telno = response.resp[3],
                //     tcno = response.resp[4],
                //     kullaniciadi = response.resp[5],
                //     email = response.resp[6],
                //     sifre = response.resp[7];
                // var tr = document.createElement("tr");
                // var td = document.createElement("td");
                // var txt = document.createTextNode(adi);
                // td.appendChild(txt);
                // tr.appendChild(td);
                // td.appendChild(txt);
                // tr.appendChild(td);
                // tablo.appendChild(tr);
        }
    });
}
var odunc = document.getElementById("odunc");

odunc.onclick = function (){
    $.ajax({
        url: 'odunc.php',
        method: 'POST',
        dataType: 'json',
        data: {
            odunc: 			$("input#tarih").val(),
            isbn:           bn
        },
        error: function()
        {
            alert("Bir hata oldu!");
        },
        success: function(response)
        {
            if(!alert("Ödünç Verildi.")) document.location = 'anasayfa.php';
        }
    });
}