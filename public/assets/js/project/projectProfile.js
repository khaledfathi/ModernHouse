const amount = document.querySelector('#amount'); 
const remaining = document.querySelector('#remaining'); 
const deleteButton = document.querySelector('#deleteButton'); 
const deleteLink= document.querySelector('#deleteLink');  
const projectReportButton = document.querySelector('#projectReportButton');
const projectReportLink = document.querySelector('#projectReportLink');

var paid = amount.value - remaining.value; 
amount.addEventListener('input' , ()=>{
    
    remaining.value= amount.value - paid; 
})

deleteButton.addEventListener('click' , ()=>{
    Swal.fire({
        title: 'حذف المشروع',
        text: "سيتم حذف كل الحسابات المتعلقة بهذا المشروع",
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

projectReportButton.addEventListener('click', ()=>{
  window.location= projectReportLink.value; 
});