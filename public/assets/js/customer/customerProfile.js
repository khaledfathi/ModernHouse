const deleteButton = document.querySelector('#deleteButton'); 
const deleteLink = document.querySelector('#deleteLink'); 

deleteButton.addEventListener('click' , ()=>{
    Swal.fire({
        title: 'حذف العميل',
        text: "سيتم حذف كل المشاريع والحسابات المتعلقة بهذا العميل",
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

