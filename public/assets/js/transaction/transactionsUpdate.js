const transactionType = document.querySelector('#transaction_type');
const transactionTypseDiv = document.querySelector('#transactionTypseDiv'); 
const deposit = document.querySelector('#deposit'); 
const withdraw = document.querySelector('#withdraw');
const uploadDocButton = document.querySelector('#uploadDocButton');
const browseFile = document.querySelector('#browseFile');
const documentImage = document.querySelector('#documentImage');
const deleteButton = document.querySelector('#deleteButton');
const deleteLink = document.querySelector('#deleteLink');

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
