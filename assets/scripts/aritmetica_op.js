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