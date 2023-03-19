const date_ = document.querySelector('#date');
const time_ = document.querySelector('#time');
const productParentDiv = document.querySelector('#productParentDiv');
const productBlock = document.querySelector('#productBlock');
const addProductButton = document.querySelector('#addProductButton');
const customerPhoneInput = document.querySelector('#customerPhoneInput');
const customerNameInput = document.querySelector('#customerNameInput');
const existCustomerCheck = document.querySelector('#existCustomerCheck');
const newCustomerCheck = document.querySelector('#newCustomerCheck'); 
const phoneExistIcon = document.querySelector('#phoneExistIcon');

/* ########### Date time Section ############ */
//get current datee
function currentDate() {
    const now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    let year = now.getFullYear();
    return `${year}-${month}-${day}`;
}

//get current time
function currentTime() {
    const now = new Date();
    var hour = ("0" + now.getHours()).slice(-2);
    var minute = ("0" + (now.getMinutes() + 1)).slice(-2);
    return `${hour}:${minute}`;
}
//set current date and time in form field
date_.value = currentDate();
time_.value = currentTime();

/* ########### END - Date time Section ############ */


/* ########## Customert Section ############ */ 
existCustomerCheck.addEventListener('click', ()=>{
    if (existCustomerCheck){
        newCustomerCheck.checked=false; 
        customerNameInput.readOnly=true;
        customerNameInput.value = null ; 
        customerPhoneInput.value = null ; 
    }
}); 
newCustomerCheck.addEventListener('click' , ()=>{
    if (newCustomerCheck){
        existCustomerCheck.checked=false; 
        customerNameInput.readOnly=false;
        customerNameInput.value = null ; 
        customerPhoneInput.value = null ; 
    }
}); 


//get customer record by phone from server side 
customerPhoneInput.addEventListener('input', () => {
    const record = async () => {
        response = await fetch('/bill/getcustomerbyphone?customerPhone=' + customerPhoneInput.value );
        return response.json();
    }
    record().then((res) => {
        console.log(res.isExist); 
        if (existCustomerCheck.checked){
            if (res.record.phone == customerPhoneInput.value) {
                customerNameInput.value = res.record.name;
            } else {
                customerNameInput.value = null;
            }
        }else {
            (res.record.phone == customerPhoneInput.value)? phoneExistIcon.hidden=false : phoneExistIcon.hidden=true; 
        }
    });
});

/* ########## END - Customert Section ############ */ 


/* ############# Products Section ############ */

//delete Parent action  (event action)
function deleteParent() {
    this.parentElement.remove();
}
//add new product block 
addProductButton.addEventListener('click', () => {
    let newProductBlock = productBlock.cloneNode();
    newProductBlock.innerHTML = productBlock.innerHTML;

    let removeProductButton = document.createElement('button');
    removeProductButton.setAttribute('type', 'button');
    removeProductButton.innerHTML = 'حذف';
    newProductBlock.appendChild(removeProductButton);

    productParentDiv.appendChild(newProductBlock);
    removeProductButton.addEventListener('click', deleteParent);
});

/* ############# END - Products Section ############ */