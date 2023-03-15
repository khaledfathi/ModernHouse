const deleteButton = document.getElementsByClassName('deleteButton');  //select by class name
const categorySelect = document.querySelector('#category'); 
const product = document.getElementsByClassName('product'); //products

//for deletebutton action 
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


//for classified products depend on its category when change the category select item 
categorySelect.addEventListener('change' , ()=>{
    for (let i of product){
        if (categorySelect.value=='all'){
            i.hidden=false ; 
        }else{
            //get category_id
            productCategoryId = i.childNodes[3].childNodes[7].value; 
            (productCategoryId == categorySelect.value)? i.hidden=false : i.hidden=true ; 
        }
    }   
}); 
