const links = document.querySelectorAll('.links');
const elements = 
{
    application: document.querySelector('#application'),
    team: document.querySelector('#team'),
    assurance: document.querySelector('#assurance'),
    api: document.querySelector('#api'),
    start: document.querySelector('#start')
}
      links.forEach(link=>
        {
            link.addEventListener('click',()=>
            {
                let href = link.getAttribute('href');
                console.log(href);
                if(href === '#application')
                {
                    
                    elements.application.classList.remove('hide');
                    elements.team.classList.add('hide');
                    elements.assurance.classList.add('hide');
                    elements.api.classList.add('hide');
                    elements.start.classList.add('hide');

                }else if(href === '#team')
                {
                    elements.application.classList.add('hide');
                    elements.team.classList.remove('hide');
                    elements.assurance.classList.add('hide');
                    elements.api.classList.add('hide');
                    elements.start.classList.add('hide');

                }else if(href === '#assurance')
                {
                    elements.application.classList.add('hide');
                    elements.team.classList.add('hide');
                    elements.assurance.classList.remove('hide');
                    elements.api.classList.add('hide');
                    elements.start.classList.add('hide');

                }else
                {
                    elements.application.classList.add('hide');
                    elements.team.classList.add('hide');
                    elements.assurance.classList.add('hide');
                    elements.api.classList.remove('hide');
                    elements.start.classList.add('hide');
                }
            })
        })

const onlyDigits = /^[0-9]+$/; 
const input = document.querySelector('#input');
    
      input.addEventListener('input',(event)=>
      {
          if(!onlyDigits.test(event.target.value))
          {
              alert("Only digits are available on this field");
              event.target.value = '';
          }
      })


