let btnConvert=document.querySelector('#convert-btn');
btnConvert.addEventListener('click',convert);
let result=document.querySelector('#output');

function convert(event){
    event.preventDefault();
    let number=document.getElementById('number');
    let numberValue=number.value;
    
    if(!numberValue){
    result.innerHTML="Please enter a valid number";
    
    }
    else if(numberValue<=-1){
      result.innerHTML="Please enter a number greater than or equal to 1";
      console.log(result);
    }
    else if(numberValue>=4000){
      result.innerHTML="Please enter a number less than or equal to 3999"
    }
    else {let romanResult=giveNumber(numberValue);
    result.innerHTML=romanResult;}
    }
    
function giveNumber(numberValue){
    const romanValue = [  
        { value: 1000, simbol: 'M' },  
        { value: 900, simbol: 'CM' },  
        { value: 500, simbol: 'D' },  
        { value: 400, simbol: 'CD' },  
        { value: 100, simbol: 'C' },  
        { value: 90, simbol: 'XC' },  
        { value: 50, simbol: 'L' },  
        { value: 40, simbol: 'XL' },  
        { value: 10, simbol: 'X' },  
        { value: 9, simbol: 'IX' },  
        { value: 5, simbol: 'V' },  
        { value: 4, simbol: 'IV' },  
        { value: 1, simbol: 'I' }  
    ];  

    let romanResult = '';  
    for (let i = 0; i < romanValue.length; i++) {  
        while (numberValue >= romanValue[i].value) {  
            romanResult += romanValue[i].simbol;  
            console.log("romanResult= "+ romanResult);
            numberValue -= romanValue[i].value;
            console.log("value = "+ numberValue);  
        }  
    }  
    return romanResult;  
}  


    