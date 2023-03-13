const image = document.querySelector('#image'); 
const imagePreview = document.querySelector('#imagePreview'); 
const uploadButton = document.querySelector('#uploadButton'); 


uploadButton.addEventListener('click' , ()=>{
    image.click();     
}); 


image.addEventListener('change' , (event)=>{
    const file = event.target.files[0];
    const imgSrc = URL.createObjectURL(file); 
    imagePreview.src= imgSrc;
}); 