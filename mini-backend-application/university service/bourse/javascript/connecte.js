let imgFSET = document.querySelector('#FSET');
let imgFSEC = document.querySelector('#FSEC');
let form    = document.querySelector('form');
let shapes  = {
    s1: document.querySelector('#shape'),
    s2: document.querySelector('#shape2'),
    s3: document.querySelector('#shape3')};

form.addEventListener('mouseover', ()=>
{
    imgFSET.classList.add('hide');
    imgFSET.classList.remove('show');
    imgFSEC.classList.add('show');
    imgFSEC.classList.remove('hide');
    imgFSEC.style.display = 'unset';
    shapes.s1.classList.remove('hide-shape');
    shapes.s2.classList.remove('hide-shape');
    shapes.s3.classList.remove('hide-shape');
    shapes.s1.classList.add('show-shape');
    shapes.s2.classList.add('show-shape-special');
    shapes.s3.classList.add('show-shape');
});

form.addEventListener('mouseout', ()=>
{
    imgFSET.classList.add('show');
    imgFSET.classList.remove('hide');
    imgFSEC.classList.add('hide');
    imgFSEC.classList.remove('show');
    shapes.s1.classList.add('hide-shape');
    shapes.s2.classList.add('hide-shape');
    shapes.s3.classList.add('hide-shape');
    shapes.s1.classList.remove('show-shape');
    shapes.s2.classList.remove('show-shape-special');
    shapes.s3.classList.remove('show-shape');
});

