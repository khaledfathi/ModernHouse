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
const saveButton = document.querySelector('#saveButton'); 
const collectedProducts = document.querySelector('#collectedProducts'); 
const productIdInput = document.querySelector('#productIdInput'); 
const quantity = document.querySelector('#quantity');
const invoiceValue = document.querySelector('#invoiceValue'); 
const productName = document.querySelector('#productName'); 

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
    if (existCustomerCheck.checked){
        newCustomerCheck.checked=false; 
        customerNameInput.readOnly=true;
        customerNameInput.value = null ; 
        customerPhoneInput.value = null ;
        phoneExistIcon.hidden=true;
    }else {
        customerNameInput.removeAttribute('readonly');
        customerNameInput.value = null ; 
        customerPhoneInput.value = null ;
    }
}); 

newCustomerCheck.addEventListener('click' , ()=>{
    if (newCustomerCheck.checked){
        existCustomerCheck.checked=false; 
        customerNameInput.readOnly=false;
        customerNameInput.value = null ; 
        customerPhoneInput.value = null ; 
    }else {
        phoneExistIcon.hidden=true;
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
        }else if (newCustomerCheck.checked) {
            (res.record.phone == customerPhoneInput.value)? phoneExistIcon.hidden=false : phoneExistIcon.hidden=true; 
        }
    });
});

/* ########## END - Customert Section ############ */ 


/* ############# Products Section ############ */

//delete Parent action  (event action)
function deleteParentEvent() {
    this.parentElement.remove();
}

function getInvoiceTotal (){
    let count = 0; 
    for (let i of productParentDiv.children){
        count+= Number(i.children[8].value);
    }
    invoiceValue.innerHTML= `اجمالى الفاتورة ${count} جنية`; 
}


//product id input (event action)
function setProductRecordDataEvent (event){
    let record = async()=>{
        response = await fetch ('bill/getproductbyid?productId='+event.target.value);
        return response.json();  
    }
    record().then((res)=>{
        event.target.parentElement.children[2].src=res.record.image;
        let price = res.record.price; 
        
        let priceField = event.target.parentElement.children[6]; 
        (price == undefined || isNaN(price)) ? priceField.value = 0 : priceField.value = price ;
        
        let totalValue = price * event.target.parentElement.children[4].value; 
        (isNaN(totalValue)) ? totalValue=0 : null; 
        event.target.parentElement.children[8].value= totalValue ;
        event.target.parentElement.children[9].value= res.record.name; 
        getInvoiceTotal(); 
    })
}

//quantity input (event action)
function changeTotalOnQuantityChangeEvent (event){
    let price =  event.target.parentElement.children[6].value
    let total = event.target.parentElement.children[8].value= price * event.target.value; 
    getInvoiceTotal(); 

}


//product id input event [for first product block] 
productIdInput.addEventListener('input' ,  setProductRecordDataEvent ); 
//product quantity input event [for first product block] 
quantity.addEventListener('input', changeTotalOnQuantityChangeEvent);

//add new product block 
addProductButton.addEventListener('click', () => {
    //copy product form 
    let newProductBlock = productBlock.cloneNode();
    newProductBlock.innerHTML = productBlock.innerHTML;
    newProductBlock.children[2].src=null;
    newProductBlock.hidden=false;
    //setting new product block 
    let removeProductButton = document.createElement('button');
    removeProductButton.setAttribute('type', 'button');
    removeProductButton.innerHTML = 'حذف';
    newProductBlock.appendChild(removeProductButton);
    
    //product id input event
    newProductBlock.children[1].addEventListener('input' , setProductRecordDataEvent);
    newProductBlock.children[4].addEventListener('input', changeTotalOnQuantityChangeEvent);

    productParentDiv.appendChild(newProductBlock);
    removeProductButton.addEventListener('click', deleteParentEvent);
});


//set collected products 
saveButton.addEventListener('click' , ()=>{
    products=[]; 
    let data={}; 
    for(let i of productParentDiv.children) {
        data['productId'] = i.children[1].value;
        data['quantity'] = i.children[4].value;
        data['price'] = i.children[6].value;
        data['total'] = i.children[8].value;
        data['productName'] = i.children[9].value; 
        products.push(data)
        data={}; 
    }
    products.shift(); 
    collectedProducts.value= JSON.stringify(products); 
}); 
/* ############# END - Products Section ############ */

