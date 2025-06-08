let pantallaInferior = document.querySelector(".inferior");
let pantallaSuperior = document.querySelector(".superior");

let valor1 = undefined;
let valor2 = undefined;
let operacion = undefined;

// Funcion para calcular el factorial
function factorial(n) {
  if (n < 0) {
    return "Error"; // Factorial no está definido para números negativos
  }
  if (n === 0 || n === 1) {
    return 1;
  }
  let resultado = 1;
  for (let i = 2; i <= n; i++) {
    resultado *= i;
  }
  return resultado;
}

let teclasNumeros = document.querySelectorAll(".numero");

teclasNumeros.forEach((tecla) => {
  tecla.addEventListener("click", () => {
    pantallaInferior.innerHTML += tecla.innerHTML;
  });
});

let teclasOperaciones = document.querySelectorAll(".operacion");

teclasOperaciones.forEach((tecla) => {
  tecla.addEventListener("click", () => {
    pantallaSuperior.innerHTML = pantallaInferior.innerHTML;
    pantallaInferior.innerHTML = "";
    valor1 = parseFloat(pantallaSuperior.innerHTML);

    operacion = tecla.innerHTML;
  });
});

let teclaIgual = document.querySelector("#igual");
teclaIgual.addEventListener("click", () => {
  valor2 = parseFloat(pantallaInferior.innerHTML);

  if (operacion === "log") {
    pantallaSuperior.innerHTML = `log10(${valor1})`;
  } else if (operacion === "!") {
    pantallaSuperior.innerHTML = `${valor1}!`;
  } else {
    pantallaSuperior.innerHTML = `${valor1} ${operacion} ${valor2}`;
  }
  resultado = undefined;
  switch (operacion) {
    case "+":
      resultado = valor1 + valor2;
      break;
    case "-":
      resultado = valor1 - valor2;
      break;
    case "*":
      resultado = valor1 * valor2;
      break;
    case "/":
      resultado = valor1 / valor2;
      break;
    




    case "^":
      resultado = valor1 ** valor2;
      break;
    case "raiz":
      if (valor2 === 0) {
        resultado = "Error";
      } else {
        resultado = Math.pow(valor2, 1 / valor1);
      }
      break;
    case "log":
      if (valor1 <= 0) {
        resultado = "Error";
      } else {
        resultado = Math.log10(valor1);
      }
      break;
    case "!":
      resultado = factorial(valor1);
      break;
    default:
      resultado = "Operación no válida";
      break;
  }
  pantallaInferior.innerHTML = resultado;
  valor1 = resultado;
});

let allClearButton = document.querySelector("#all-clear");
let deleteButton = document.querySelector("#delete");

allClearButton.addEventListener("click", () => {
  valor1 = undefined;
  valor2 = undefined;
  operacion = undefined;
  pantallaInferior.innerHTML = "";
  pantallaSuperior.innerHTML = "";
});

deleteButton.addEventListener("click", () => {
  pantallaInferior.innerHTML = pantallaInferior.innerHTML.slice(0, -1);
});
