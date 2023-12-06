document.getElementById("btn-iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn-registro").addEventListener("click", register);
window.addEventListener("resize", anchoPagina);


var contenedor_registro = document.querySelector(".contenedor_registro");
var formulario_login = document.querySelector(".formulario_login");
var formulario_sign = document.querySelector(".formulario_sign");
var traseraLogin = document.querySelector(".traseraLogin");
var traseraSign = document.querySelector(".traseraSign");

function anchoPagina(){
    if(window.innerWidth > 850){
        traseraLogin.style.display = "block";
        traseraSign.style.display = "block";
    }else{
        traseraSign.style.display = "block";
        traseraSign.style.opacity = "1";
        traseraLogin.style.display = "none";
        formulario_login.style.display = "block";
        formulario_sign.style.display = "none";
        contenedor_registro.style.left = "0px";
     
    }
}

anchoPagina();

function iniciarSesion(){
if(window.innerWidth > 850){
    formulario_sign.style.display = "none";
    contenedor_registro.style.left = "10px";
    formulario_login.style.display = "block";
    traseraSign.style.opacity = "1";
    traseraLogin.style.opacity = "0";
}else{
    formulario_sign.style.display = "none";
    contenedor_registro.style.left = "0px";
    formulario_login.style.display = "block";
    traseraSign.style.display = "block";
    traseraLogin.style.display = "none";
}
}

function register(){
    if(window.innerWidth > 850){
        formulario_sign.style.display = "block";
        contenedor_registro.style.left = "410px";
        formulario_login.style.display = "none";
        traseraSign.style.opacity = "0";
        traseraLogin.style.opacity = "1";
    }else{
        formulario_sign.style.display = "block";
        contenedor_registro.style.left = "0px";
        formulario_login.style.display = "none";
        traseraSign.style.display = "none";
        traseraLogin.style.display = "block";
        traseraLogin.style.opacity = "1";


    }

    
}