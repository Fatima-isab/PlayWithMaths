function fillCell(cell) {
    console.log("Funciona");
    const value = prompt('Ingrese el número:');
            if (value !== null) {
                cell.innerText = value;
            }
        }

        function checkMatrix() {
            const correctMatrix = [['X', 1, 2, 3], [1, 1 ,2, 3], [2, 2, 4, 6], [3, 3, 6, 9]];
            let errors = 0;

            for (let i = 0; i < correctMatrix.length; i++) {
                for (let j = 0; j < correctMatrix[i].length; j++) {
                    const cell = document.getElementById(`cell-${i+1}-${j+1}`);
                    if (cell !== null && cell.innerText !== '') { // Verificar si la celda existe y no está vacía
                        const userValue = parseInt(cell.innerText);
                        const correctValue = correctMatrix[i][j];

                        if (userValue !== correctValue) {
                            cell.classList.add('incorrect');
                            errors++;
                        } else {
                            cell.classList.remove('incorrect');
                            cell.classList.add('correct');
                        }
                    }
                }
            }

            if (errors === 0) {
                alert('¡Felicidades!');
            } else {
                alert(`Hubo ${errors} error(es) en la tabla.`);
            }
        }

/////////////////////////////////////////////////
let touchX, touchY;

function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("text/plain", event.target.id);
}

function dragEnter(event) {
    event.target.classList.add("hover");
}

function dragLeave(event) {
    event.target.classList.remove("hover");
}

function drop(event) {
    event.preventDefault();
    event.target.classList.remove("hover");

    const droppedShapeId = event.dataTransfer.getData("text/plain");
    const dropzone = event.target;

    if (droppedShapeId === "correcto") {
        dropzone.style.fontSize = "24px";
        dropzone.style.color = "green";
        dropzone.innerHTML = "¡Correcto!";
    } else {
        dropzone.style.fontSize = "24px";
        dropzone.style.color = "green";
        dropzone.innerHTML = "¡Incorrecto!";
    }
}

function touchStart(event) {
    const touch = event.touches[0];
    touchX = touch.clientX;
    touchY = touch.clientY;
}

function touchMove(event) {
    event.preventDefault();
}

function touchEnd(event) {
    const dropzone = document.getElementById("dropzone");
    const touch = event.changedTouches[0];
    const deltaX = touch.clientX - touchX;
    const deltaY = touch.clientY - touchY;

    if (Math.abs(deltaX) < 10 && Math.abs(deltaY) < 10) {
        
        const targetShape = event.target.closest(".shape");
        if (targetShape) {
            const droppedShapeId = targetShape.id;
            if (droppedShapeId === "correcto") {
                dropzone.style.fontSize = "24px";
                dropzone.style.color = "green";
                dropzone.innerHTML = "¡Correcto!";
            } else {
                dropzone.style.fontSize = "24px";
                dropzone.style.color = "red";
                dropzone.innerHTML = "¡Incorrecto!";
            }
        }
    }
}