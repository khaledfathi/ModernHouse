const searchFor = document.querySelector('#searchFor');
const searchBy = [
    document.querySelector('#customerSearchBy'),
    document.querySelector('#projectSearchBy'),
    document.querySelector('#billSearchBy'),
    document.querySelector('#productSearchBy')
    ];
    
function showOnlyOne(selected  ) {
    //parameter [selected array , itemCount int]
    bits = 1 << (selected - 1);
    list=[]; 
    for (let i=0 ; i<4 ; i++){
        (1 & (bits >> i)) ? list.push(false) : list.push(true);
    }
    return list ; 
}

function selector (name){
    let show ; 
    switch (name){
        case 'customer':
            show = showOnlyOne(1); 
            searchBy[0].children[0].selected=true;
            for (let i in searchBy ){
                searchBy[i].hidden= show[i]; 
            }
            break
        case 'project':
            show = showOnlyOne(2); 
            searchBy[1].children[0].selected=true;
            for (let i in searchBy ){
                searchBy[i].hidden= show[i]; 
            }
            break
        case 'bill':
            show = showOnlyOne(3); 
            searchBy[2].children[0].selected=true;
            for (let i in searchBy ){
                searchBy[i].hidden= show[i]; 
            }
            break
        case 'product':
            show = showOnlyOne(4); 
            searchBy[3].children[0].selected=true;
            for (let i in searchBy ){
                searchBy[i].hidden= show[i]; 
            }
            break
    }
}

searchFor.addEventListener('change', ()=>{
    switch (searchFor.value){
        case 'customer' : 
            selector('customer')
            break; 
        case 'project' : 
            selector('project'); 
            break; 
        case 'bill' : 
            selector('bill'); 
            break; 
        case 'product' : 
            selector('product'); 
            break; 
    }
}); 