const amount = document.querySelector('#amount'); 
const projectAmount = document.querySelector('#projectAmount'); 
const remaining = document.querySelector('#remaining'); 
const remainingCalculated = document.querySelector('#remainingCalculated'); 

let alreadyPaid = Number(projectAmount.value) - Number(remaining.value); 
let newRemaining  = Number(projectAmount.value) - (alreadyPaid - Number(amount.value)) ;
remaining.value = newRemaining;
console.log(newRemaining)

amount.addEventListener('input' , ()=>{
    remainingCalculated.value = Number(remaining.value) - Number(amount.value); 
    
    if (!amount.value){
        remainingCalculated.value =remaining.value; 
    }
     if(isNaN(remainingCalculated.value)){
        remainingCalculated.value = 0; 
     }
}); 