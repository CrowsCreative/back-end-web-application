const progress = document.querySelector('.progress');
let width = 0;
const button = document.querySelector('button');
const h2     = document.querySelector('.print');
const fetching = setInterval(async ()=>
    {
        let fetched = null;
        let data = null;
        try
        {
            fetched = await fetch('http://localhost:10000/scrapper/developer/json', {method: 'GET'});
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
       
        if(width >= 100)
        {
            
           h2.innerHTML = `Finished.&nbsp;<span style="font-family: 'Source Code Pro', monospace; color:#a8eb12;">&nbsp;[&nbsp;${data.items}&nbsp;]&nbsp;</span><span style='color:#a8eb12;'> items successfully created.</span>`;
                button.classList.remove('hide');
            button.classList.add('show');
            clearInterval(fetching); 
        }
    }, 10000);