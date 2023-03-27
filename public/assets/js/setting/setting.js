const uploadButton = document.querySelector('#uploadButton'); 
const uploadInput = document.querySelector('#uploadInput');
const logoImage = document.querySelector('#logoImage');


/* Upload Logo Image to local page */ 
uploadButton.addEventListener('click', ()=>{
    uploadInput.click(); 
});

uploadInput.addEventListener('change' , (event)=>{
    const file = event.target.files[0]; 
    const imageSrc = URL.createObjectURL(file); 
    logoImage.src = imageSrc;
}); 
/*********************************/ 