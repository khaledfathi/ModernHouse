const amount = document.querySelector('#amount');  
const total = document.querySelector('#total'); 
const remaining = document.querySelector('#remaining'); 

remaining.innerHTML = amount.innerHTML - total.innerHTML; 