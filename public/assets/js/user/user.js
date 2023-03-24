const deleteButtons = document.getElementsByName('deleteButton'); 
const deleteLinks = document.getElementsByName('deleteLink'); 

for (let i=0 ; i<deleteButtons.length; i++ ){
    console.log(i); 
    deleteButtons[i].addEventListener('click' , ()=>{
        Swal.fire({
            title: 'حذف مستخدم',
            text: "هل انت متأكد ؟",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'الغاء',
            confirmButtonText: 'موافق'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = deleteLinks[i].value; 
            }
        })
    }); 
}
