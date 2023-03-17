const transactionType = document.querySelector('#transaction_type');
const transactionTypseDiv = document.querySelector('#transactionTypseDiv'); 
const deposit = document.querySelector('#deposit'); 
const withdraw = document.querySelector('#withdraw');
const uploadDocButton = document.querySelector('#uploadDocButton');
const browseFile = document.querySelector('#browseFile');
const documentImage = document.querySelector('#documentImage');


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



