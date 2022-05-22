
const DOC = 
{
    body: document.querySelector('main'),
    option: document.querySelector('#categorie'),
    mobile: document.querySelector('#mobile'),
    items: document.querySelectorAll('.item'),
    modal: document.querySelector('#purchaseModal'),

}

DOC.option.addEventListener('click', (e)=>
{
    if(e.target.value !== "choisir ....")
    {
        DOC.mobile.setAttribute('value',e.target.value);
    }
})



DOC.items.forEach(item=>
    {
        item.addEventListener('mouseover', ()=>
        {
            item.classList.add('shadow');
        });        
    });


    
DOC.items.forEach(item=>
    {
        item.addEventListener('mouseout', ()=>
        {
            item.classList.remove('shadow');
        });        
    });
