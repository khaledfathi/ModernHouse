const amount = document.querySelector('#amount'); 
const projectAmount = document.querySelector('#projectAmount'); 
const remaining = document.querySelector('#remaining'); 
const remainingCalculated = document.querySelector('#remainingCalculated'); 
const deleteButton = document.querySelector('#deleteButton')
const deleteLink = document.querySelector('#deleteLink')

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

deleteButton.addEventListener('click' , ()=>{
    Swal.fire({
        title: 'حذف معاملة مالية',
        text: "هل انت متأكد ؟",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'الغاء',
        confirmButtonText: 'موافق'
      }).then((result) => {
        if (result.isConfirmed) {
            window.location = deleteLink.value;
        }
      })
}); 
