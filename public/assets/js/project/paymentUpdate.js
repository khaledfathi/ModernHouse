const amount = document.querySelector('#amount'); 
const projectAmount = document.querySelector('#projectAmount'); 
const remaining = document.querySelector('#remaining'); 
const remainingCalculate = document.querySelector('#remainingCalculated'); 

let alreadyPaid = Number(projectAmount.value) - Number(remaining.value); 
let newRemaining  = Number(projectAmount.value) - (alreadyPaid - Number(amount.value)) ;
remaining.value = newRemaining;
console.log(newRemaining)

amount.addEventListener('input' , ()=>{
    remainingCalculate.value = Number(remaining.value) - Number(amount.value); 
    
    if (!amount.value){
        remainingCalculate.value =remaining.value; 
    }
    if (remainingCalculate.value < 0 ){
        remainingCalculate.value = 0 ; 
    }

}); 