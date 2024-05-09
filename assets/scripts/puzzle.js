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
    const modal = document.getElementById("modal");
    const correctoModal = document.getElementById("correctoModal");
    const incorrectoModal = document.getElementById("incorrectoModal");
    const closeButton = document.getElementById("closeButton");

    if (droppedShapeId === "correcto") {
        correctoModal.style.display = "block";
        modal.style.display = "block"; // Mostrar el modal
        closeButton.style.display = "block";
    } else {
        incorrectoModal.style.display = "block";
        modal.style.display = "block"; // Mostrar el modal
        closeButton.style.display = "block";
    }
    closeButton.onclick = function() {
        modal.style.display = "none";
        correctoModal.style.display = "none";
        incorrectoModal.style.display = "none";
        closeButton.style.display = "none"; 
    }
}





   