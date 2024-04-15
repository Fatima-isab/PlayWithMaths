var instruccionActual = 0;
var inst = document.querySelectorAll('.inst');
var btnAnt = document.getElementById('btnAnt')
var btnSig = document.getElementById('btnSig');

btnAnt.style.display = 'none';

function mostrarInstruccion(indice) {
    for (var i = 0; i < inst.length; i++) {
        inst[i].classList.remove('visible');
    }
    inst[indice].classList.add('visible');


    if (indice === inst.length - 1) {
        btnSig.style.display = 'none';
    } else {
        btnSig.style.display = 'inline-block';
    }

    if (indice === 0) {
        btnAnt.style.display = 'none';
    } else {
        btnAnt.style.display = 'inline-block';
    }
}

function siguiente() {
    if (instruccionActual < inst.length - 1) {
        instruccionActual++;
        mostrarInstruccion(instruccionActual);
    }
}

function anterior() {
    if (instruccionActual > 0) {
        instruccionActual--;
        mostrarInstruccion(instruccionActual);
    }
}

var imagenes = [
    "../../../assets/img/tabla5.png",
    "../../../assets/img/tabla1.png",
    "../../../assets/img/tabla2.png",
    "../../../assets/img/tabla3.png",
    "../../../assets/img/tabla4.png",
    
   
   
];

var index = 0;

function cambiarImagen() {
    console.log("Ejecuntando cambiarImagen()");
    var imgL = document.getElementById("imgLecc");
    index = (index +1) %imagenes.length;
    imgL.src = imagenes[index];
    
}

var imagenesDos = [
    "../../../assets/img/tabla10.png",
    "../../../assets/img/tabla6.png",
    "../../../assets/img/tabla7.png",
    "../../../assets/img/tabla8.png",
    "../../../assets/img/tabla9.png",
    
   
   
];

var index2 = 0;

function cambiarImagenDos() {
    console.log("Ejecuntando cambiarImagenDos()");
    var imgLdos = document.getElementById("imgLecc2");
    index2 = (index2 +1) %imagenesDos.length;
    imgLdos.src = imagenesDos[index2];
    
}

