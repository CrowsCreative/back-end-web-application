

const colors = ["#42f590", "#3498db", "#fc426d", "#fae843", "#fa8039"];
const twins  = [-1, 1];
const cubesUI  = document.querySelector(".cubes");
const progress = document.querySelector('.progress');
let width = 0;
let processFinished = false;
const button = document.querySelector('button');
const h2     = document.querySelector('.print');
console.log(h2.textContent);
const myI = setInterval(()=>
{
    cubesUI.innerHTML = '';
    width += 10; 
    let cubes  = [];
    let nbCubes  = Math.floor(Math.random() * colors.length) + 1;
    for(let i = 1; i <= nbCubes; i++)
    {
        let index    = Math.floor(Math.random() * colors.length);
        let duration = index + 2;
        let color    = colors[index];
        let top      = (Math.floor(Math.random() * 100) + 90 ) * twins[Math.floor(Math.random() * twins.length)];
        let left     = (Math.floor(Math.random() * 100) + 40 ) * twins[Math.floor(Math.random() * twins.length)];
        const cube = `<svg version="1.1" class="scrapingCubes" style="fill: ${color};top:${top};left:${left};animation-duration: ${duration}s;"id="cube" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 490.452 490.452" style="enable-background:new 0 0 490.452 490.452;" xml:space="preserve">
                <path d="M245.226,0L43.836,126.814v236.823l201.39,126.814l201.39-126.814V126.814L245.226,0z M403.465,135.095l-158.239,99.643
                L86.987,135.095l158.239-99.643L403.465,135.095z M73.836,162.267l156.39,98.477v184.81l-156.39-98.478V162.267z M260.226,445.555
                v-184.81l156.39-98.478v184.81L260.226,445.555z"/>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                </svg>`;
        cubes.push(cube);
    }
    console.log(cubes);
    
    for(let i = 0; i < nbCubes; i++)
    {
        cubesUI.innerHTML += cubes[i];
    }
}, 5000)

const fetching = setInterval(async ()=>
    {
        let fetched = null;
        let data = null;
        try
        {
            fetched = await fetch('http://localhost:10000/scrapper/json', {method: 'GET'});
        }catch(e)
        {
            document.querySelector('#error').click();
        }
        try
        {
            data = await fetched.json();
        }catch(e)
        {
            document.querySelector('#error').click();
        }
        console.log(data.err);
        if(true === Boolean(data.err))
        {
            document.querySelector('#error').click();
        }

        width = data.p;
        progress.style.width = width +"%";
        console.log(data.p);
        if(width >= 100)
        {
            clearInterval(myI);
            cubesUI.innerHTML = '';
            h2.innerHTML = `Finished.&nbsp;<span style="font-family: 'Source Code Pro', monospace; color:#3498db;">&nbsp;[&nbsp;${data.items}&nbsp;]&nbsp;</span><span style='color:#3498db;'> items parsed successfully.</span>`;
            button.classList.remove('hide');
            button.classList.add('show');
            clearInterval(fetching); 
        }
    }, 10000);



