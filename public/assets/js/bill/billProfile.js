const deleteButton = document.querySelector('#deleteButton'); 
const delteLink= document.querySelector('#deleteLink');  

deleteButton.addEventListener('click' , ()=>{
    Swal.fire({
        title: 'حذف فاتورة !',
        text: "سيتم حذف حساب الفاتورة من الماليات",
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
