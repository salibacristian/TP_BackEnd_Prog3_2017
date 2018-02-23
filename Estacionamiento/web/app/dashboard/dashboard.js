var servidor="http://bpdda.esy.es/TP_BackEnd_Prog3_2017/Estacionamiento/backEnd/";

function dibujarTabla(lista){
    var rows = '';
    lista.forEach(c => {
        let icon = c.esParaDiscapacitados == 1? "<i class='fa fa-wheelchair' id='wheelchairIcon'></i>" : '';
        rows += "<tr onclick='cargarCocheraModal(" + c.id + ")'>" +
        "<td>" + c.piso + "</td>" +
        "<td>" + c.numero + "</td>" +
        "<td>" + c.dominio + "</td>" +        
        "<td>" + icon + "</td>" +
       " </tr>";
    });
    
        $("#cocherasEnUso").html(rows);

}

function cargarCocheraModal(cocheraId){
var cocheras = JSON.parse(localStorage.getItem('cocheras'));
var cochera = cocheras.filter(function(c){
    return c.id == cocheraId;
})[0];
let icon = cochera.esParaDiscapacitados == 1? " <i class='fa fa-wheelchair' id='wheelchairIcon'></i>" : '';
$(".numeroCochera").html(cochera.numero + " Piso " + cochera.piso + icon);

$("#popUpCochera").modal();
}


function cargarCocheras(param){
    $.ajax({
        type: "get",
       url: servidor+"cocheras/",
       data: {
           libres: param
       }
          
   })
   .then(function(retorno){		
    console.log(retorno);
    localStorage.setItem("cocheras",JSON.stringify(retorno));
    if(retorno.length > 0){
        dibujarTabla(retorno);
    }
    else{
        swal('Ninguna cochera está en uso','','info');
    }
   },function(error){
       swal({
        title: "Error",
        text: "Hubo un error al obtener las cocheras",
        type: "error",
        showCancelButton: false,
        cancelButtonClass: "btn-info",
        cancelButtonText: "cerrar"
    });
   });
}

function buscarPorDominio(){
    let dominio = $('#lookup').val().toUpperCase();
    let tabla = $('.tableCochera').get( 0 );
    tr = tabla.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(dominio) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }       
    }

}

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

    cargarCocheras(0);
});