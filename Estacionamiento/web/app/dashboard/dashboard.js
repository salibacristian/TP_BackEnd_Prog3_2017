var servidor="http://bpdda.esy.es/TP_BackEnd_Prog3_2017/Estacionamiento/backEnd/";

$(document).ready(function() {
    let user = JSON.parse(localStorage.getItem('usrEstacionamiento'));
    let folderEmployeeImgaes = "../../../backEnd/fotosEmpleados/";
     let img = user.foto != null? "<img class='porfileImg' src='" + folderEmployeeImgaes + user.foto + "'></img>" : "<span class='glyphicon glyphicon-user'></span>";
    $("#usr").html(img + ' ' + user.mail);

    $(document).on("click", "#app__logout", function(e) {
        $.ajax({
            type: "get",
           url: servidor+"logout/"
              
       });		
     
       
        location.href = "http://bpdda.esy.es/TP_BackEnd_Prog3_2017/Estacionamiento/web/app/login/login.html";      
    });
});