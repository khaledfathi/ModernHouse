const searchFor = document.querySelector('#searchFor');
const searchBy = document.querySelector('#searchBy');


function selectedOptions(selected, itemCount) {
    //parameter [selected array , itemCount int]
    let bits = 0;
    let display = [];
    for (let i = 0; i < selected.length; i++) {
        bits |= 1 << (selected[i] - 1);
    }
    display = [];
    for (let i = 0; i < itemCount; i++) {
        (1 & (bits >> i)) ? display.push(true) : display.push(false);
    }
    return display;
}

searchFor.addEventListener('change', () => {
    //remove 'selected' from all searchBy options
    for (let i of searchBy.children) {
        // console.log (i) ; 
        i.removeAttribute('selected', '');
    }
    switch (searchFor.value) {
        
        case 'customer':
            action = selectedOptions([1,2,3], 11);
            for (let i=0; i<searchBy.children.length ; i++){
                (action[i]) ? searchBy.children[i].removeAttribute('hidden') : searchBy.children[i].setAttribute('hidden', '');
            }
            for (let i = 0; i <3 ; i++) {
                if (i == 0) { searchBy.children[i].setAttribute('selected', ''); }
            }
            break;
        case 'project':
            action = selectedOptions([4,5,6], 11);
            for (let i=0; i<searchBy.children.length ; i++){
                (action[i]) ? searchBy.children[i].removeAttribute('hidden') : searchBy.children[i].setAttribute('hidden', '');
            }
            for (let i = 3; i <6 ; i++) {
                if (i == 3) { searchBy.children[i].setAttribute('selected', ''); }
            }
            break;
        case 'bill':
            action = selectedOptions([7,8,9], 11);
            for (let i=0; i<searchBy.children.length ; i++){
                (action[i]) ? searchBy.children[i].removeAttribute('hidden') : searchBy.children[i].setAttribute('hidden', '');
            }
            for (let i = 6; i <9 ; i++) {
                if (i == 6) { searchBy.children[i].setAttribute('selected', ''); }
            }
            break;
        case 'product':
            action = selectedOptions([10,11], 11);
            for (let i=0; i<searchBy.children.length ; i++){
                (action[i]) ? searchBy.children[i].removeAttribute('hidden') : searchBy.children[i].setAttribute('hidden', '');
            }
            for (let i = 9; i <11 ; i++) {
                if (i == 9) { searchBy.children[i].setAttribute('selected', ''); }
            }
            break;
    }
})