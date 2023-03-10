const date_ = document.querySelector('#date'); 
const time_ = document.querySelector('#time'); 
const amount = document.querySelector('#amount'); 
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


amount.addEventListener('input' , ()=>{
    let calc = remaining.value - amount.value
    if (calc < 0 ){
        remainingCalculated.value =0 
    }else {
        (isNaN(calc)) ? remainingCalculated.value = 'غير معروف' : remainingCalculated.value = calc;
        if(amount.value > remaining.value) console.log('a'); 
    }
 }); 