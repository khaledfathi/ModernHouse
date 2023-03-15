const deleteButton = document.getElementsByName('deleteButton'); 

//delete button 'sweatalert' before delete 
for (let i of deleteButton){
  i.addEventListener('click' , ()=>{
    let deleteLink = i.parentElement.parentElement.childNodes[9].innerHTML; 
    Swal.fire({
        title: 'حذف الصنف ',
        text: "سيتم نقل المنتجات تحت هذا الصنف الى غير مصنف",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'الغاء',
        confirmButtonText: 'موافق'
      }).then((result) => {
        if (result.isConfirmed) {
            window.location = deleteLink;
        }
      })
  }); 
}


