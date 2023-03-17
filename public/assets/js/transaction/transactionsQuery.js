const queryByIdDiv = document.querySelector('#queryByIdDiv');
const queryBydateDiv = document.querySelector('#queryByDateDiv');
const queryFor = document.querySelector('#queryFor');
const periodCheck = document.querySelector('#periodCheck'); 
const toDate = document.querySelector('#toDate');
const transactionTypeList = document.querySelector('#transactionTypeList'); 

queryFor.addEventListener('change' , ()=>{
    if(queryFor.value == 'byId'){
        queryByIdDiv.style.display='flex'; 
        queryBydateDiv.style.display='none';
        transactionTypeList.hidden=true ; 
    }else if(queryFor.value == 'byDate'){
        queryByIdDiv.style.display='none'; 
        queryBydateDiv.style.display='flex';
        transactionTypeList.hidden=false ; 
    }
    periodCheck.checked=false;
    toDate.hidden=true;  
}); 

periodCheck.addEventListener('click' , ()=>{
    (periodCheck.checked) ? toDate.hidden=false : toDate.hidden=true; 
}); 