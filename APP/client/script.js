var urlWS = "";
var palabra = "";
var cuentaError = 0;
var valor = 0;
$(document).ready(function(){
    urlWS = "http://localhost/FIELDGAME/server/";
    document.getElementById('cabeza').style.display = 'none';
    document.getElementById('tronco').style.display = 'none';
    document.getElementById('brazo-izquierdo').style.display = 'none';
    document.getElementById('brazo-derecho').style.display = 'none';
    document.getElementById('pie-izquierdo').style.display = 'none';
    document.getElementById('pie-derecho').style.display = 'none';
    cuentaError = 0;
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

function iniciar(){
    cuentaError = 0;
    document.getElementById('cabeza').style.display = 'none';
    document.getElementById('tronco').style.display = 'none';
    document.getElementById('brazo-izquierdo').style.display = 'none';
    document.getElementById('brazo-derecho').style.display = 'none';
    document.getElementById('pie-izquierdo').style.display = 'none';
    document.getElementById('pie-derecho').style.display = 'none';
    nivel = document.getElementById('nivel').value;
    urlToRequest = urlWS + 'juego/palabraToShow';
    $.ajax({
        type: "post",
        url: urlToRequest,
        data: JSON.stringify({nivel: nivel}),
        async:false,
        success: function(respuesta){
            datos = JSON.parse(respuesta);
            document.getElementById('palabraEstadoActual').value = datos.palabraEstadoActual;
            valor = datos.valor;
            palabra = datos.palabra;
        }
    });
}

function ingresar(letra) {
    urlToRequest = urlWS + 'juego/validar';
    palabraEstadoActual = document.getElementById('palabraEstadoActual').value;
    $.ajax({
        type: "post",
        url: urlToRequest,
        data: JSON.stringify({letra: letra, palabra: palabra, palabraEstadoActual: palabraEstadoActual}),
        async:false,
        success: function(respuesta){
            datos = JSON.parse(respuesta);
            if (datos==false){
                cuentaError++;
                if(cuentaError == 0){
                    document.getElementById('cabeza').style.display = 'none';
                    document.getElementById('tronco').style.display = 'none';
                    document.getElementById('brazo-izquierdo').style.display = 'none';
                    document.getElementById('brazo-derecho').style.display = 'none';
                    document.getElementById('pie-izquierdo').style.display = 'none';
                    document.getElementById('pie-derecho').style.display = 'none';
                }
                if(cuentaError == 1){
                    document.getElementById('cabeza').style.display = 'block';
                }
                if(cuentaError == 2){
                    document.getElementById('tronco').style.display = 'block';
                }
                if(cuentaError == 3){
                    document.getElementById('brazo-izquierdo').style.display = 'block';
                }
                if(cuentaError == 4){
                    document.getElementById('brazo-derecho').style.display = 'block';
                }
                if(cuentaError == 5){
                    document.getElementById('pie-izquierdo').style.display = 'block';
                }
                if(cuentaError == 6){
                    document.getElementById('pie-derecho').style.display = 'block';
                }
                if(cuentaError == 7){
                    alert("chao pescado");
                }
            }else{
                document.getElementById('palabraEstadoActual').value = datos;
                if(datos == palabra){
                    alert('ganaste');
                }
            }
        }
    });
}