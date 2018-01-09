var urlWS = "";
$(document).ready(function(){
    urlWS = "http://localhost/FIELDGAME/server/";
});

function entrar(){
    nickname = document.getElementById("nickname").value;
    urlToRequest = urlWS + 'cuenta/login';
    $.ajax({
        type: "post",
        url: urlToRequest,
        data: JSON.stringify({nickname: nickname}),
        async:false,
        success: function(respuesta){
            if(JSON.parse(respuesta).jugador=='0'){
                swal ( "Oops", "Credenciales Incorrectos", "error" )
            }else{
                swal({
                    title: "Bienvenido!",
                    text: "Usted ha sido identificado como: " + JSON.parse(respuesta).jugador.nombre,
                    icon: "success",
                })
                .then((r)=>{
                    window.location = './main.html';
                });
            }            
        }
    });
}

function registrar(){
    nickname = document.getElementById("nickname").value;
    nombre = document.getElementById("nombre").value;
    urlToRequest = urlWS + 'cuenta/registrar';
    $.ajax({
        type: "post",
        url: urlToRequest,
        data: JSON.stringify({nickname: nickname, nombre:nombre}),
        async:false,
        success: function(respuesta){
            swal({
                title: "Bienvenido!",
                text: "Sus datos han sido registrados. Por favor inicie sesión.",
                icon: "success",
            })
            .then((r)=>{
                window.location = './login.html';
            });            
        }
    });
}