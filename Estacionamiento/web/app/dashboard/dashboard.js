var servidor="http://bpdda.esy.es/TP_BackEnd_Prog3_2017/Estacionamiento/backEnd/";

$(document).ready(function() {
    $("#usr").html(localStorage.getItem('usrEstacionamiento'));

    $(document).on("click", "#app__logout", function(e) {
        $.ajax({
            type: "get",
           url: servidor+"logout/"
              
       });		
     
       
        location.href = "http://bpdda.esy.es/TP_BackEnd_Prog3_2017/Estacionamiento/web/app/login/login.html";      
    });
});