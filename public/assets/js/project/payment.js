const date_ = document.querySelector('#date'); 
const time_ = document.querySelector('#time'); 
const amount = document.querySelector('#amount'); 
const projectAmount = document.querySelector('#projectAmount'); 
const remaining = document.querySelector('#remaining'); 
const remainingCalculated = document.querySelector('#remainingCalculated'); 

//get current datee
function currentDate(){
    const now = new Date(); 
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    let year = now.getFullYear();
    return `${year}-${month}-${day}`; 
}
//get current time
function currentTime(){
    const now = new Date(); 
    var hour = ("0" + now.getHours()).slice(-2);
    var minute = ("0" + (now.getMinutes() + 1)).slice(-2);
    return `${hour}:${minute}`; 
}
//set current date and time in form field
 date_.value=currentDate(); 
 time_.value=currentTime(); 


/*######## CALCULATE REMAINING VALUE ######*/ 
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
/*##########################################*/ 