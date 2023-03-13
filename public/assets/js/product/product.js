const deleteButton = document.getElementsByClassName('deleteButton');  //select by class name

for (let i of deleteButton) {
    i.addEventListener('click', () => {
        Swal.fire({
            title: 'حذف منتج',
            text: "هل انت متأكد ؟",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'الغاء',
            confirmButtonText: 'موافق'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = i.parentElement.childNodes[5].value; 
            }
        })

    });
}
