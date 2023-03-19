const date_ = document.querySelector('#date'); 
const time_ = document.querySelector('#time');
const transactionType = document.querySelector('#transaction_type');
const transactionTypseDiv = document.querySelector('#transactionTypseDiv'); 
const deposit = document.querySelector('#deposit'); 
const withdraw = document.querySelector('#withdraw');
const uploadDocButton = document.querySelector('#uploadDocButton');
const browseFile = document.querySelector('#browseFile');
const documentImage = document.querySelector('#documentImage');

//get current date
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

 
 //change in transaction type [show or hide transaction types radio button]
 transactionType.addEventListener('change', ()=>{
    //transaction value '1' means 'unclassified'
    (transactionType.value == 1) ? transactionTypseDiv.hidden=false : transactionTypseDiv.hidden=true;  
 })


uploadDocButton.addEventListener('click', ()=>{
    browseFile.click(); 
});

browseFile.addEventListener('change' , (event)=>{
    const file = event.target.files[0]; 
    const imgSrc = URL.createObjectURL(file);
    documentImage.src = imgSrc;
});



