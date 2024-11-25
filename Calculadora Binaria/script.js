"use strict"

const numberInput = document.getElementById("number-input");
const convertBtn = document.getElementById("convert-btn");
const result = document.getElementById("result");

const decimalToBinary = (input) => {

//OPCION LARGA:
    /*const inputs = [];
const quotients = [];
const remainders = [];

if (input === 0) {
    result.innerText = "0";
    return;
  }

while (input > 0) {
  const quotient = Math.floor(input / 2);
  const remainder = input % 2;
  
  inputs.push(input);
  quotients.push(quotient);
  remainders.push(remainder);
  input = quotient;
}

console.log("Inputs: ", inputs);
console.log("Quotients: ", quotients);
console.log("Remainders: ", remainders);

result.innerText = remainders.reverse().join("");
}
*/

//OPCION CORTA:
let binary = "";
if (input === 0) {
    binary="0";
    return;
  }
while (input > 0) {
    binary = (input % 2) + binary;
    input = Math.floor(input / 2);
  }
  result.innerText = binary;
};


const checkUserInput = () => {
    if (
      !numberInput.value ||
      isNaN(parseInt(numberInput.value)) ||
      parseInt(numberInput.value) < 0
    ){
        alert("Por favor ingrese un valor mayor o igual a 0");
        return;
    }
    decimalToBinary(parseInt(numberInput.value));
    numberInput.value="";
}

convertBtn.addEventListener('click', checkUserInput);
