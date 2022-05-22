const express = require('express')
const router  = express.Router({mergeParams: true});
const puppeteer = require('puppeteer');
const fs = require('fs');
let progress = 0;
let items = 0;
let Error;

function sleep(delay) {
    var start = new Date().getTime();
    while (new Date().getTime() < start + delay);
}

async function dataProgressScraper(page)
{
    //parsing all pages menu (next/previous)
    const elements = await page.$$('td');
    let counter    = 0; 
    if(elements && elements.length)
    {
        for(const el of elements)
        {
            counter++;   
        }
    }
    return counter - 2;
}

async function dataParser(page)
{
    let locations = [];
    let hasWebsite = [];
    let contexts = [];
    
    //parsing all names from google maps
    const elements = await page.$$('.dbg0pd span');
    if(elements && elements.length)
    {
        for(const el of elements)
        {
            const name = await el.evaluate(span => span.textContent);
            locations.push({name: name, website: true});   
        }
    }
    //check what if the location got a website or not
    const allLocations = await page.$$('.VkpGBb');
    if(allLocations && allLocations.length)
    {
        for(const location of allLocations)
        {
            const v = await location.evaluate(div => div.childElementCount);
            if(v === 3)
            {
                hasWebsite.push(true);
            }else
            {
                hasWebsite.push(false);
            }
        }
    }
    //correcting the information about our data object
    let iterator = 0;
    locations.forEach(location =>
        {
            location.website = hasWebsite[iterator];
            iterator++;
        })
    //parsing all relevant informations from google maps (address, phone)
    const nestedElements = await page.$$('.VkpGBb a.C8TUKc');
    if(nestedElements && nestedElements.length)
    {
        for(const Nel of nestedElements)
        {
            
            await Nel.click()
            sleep(2000);
            const grapEl = await page.$$('.LrzXr');
            if(grapEl && grapEl.length)
            {
                if(grapEl.length === 1)
                {
                    for(const graped of grapEl){
                        
                    console.log("Got only address:")
                    const context = await graped.evaluate(span => span.outerText);
                    console.log(context);
                    contexts.push({address: context, phone: undefined});
                        }
                }else
                {
                    console.log("Got both address and phone:");
                    const objectCollector = [];
                    for(const graped of grapEl){
                    const context = await graped.evaluate(span => span.outerText);
                    objectCollector.push(context);
                    console.log(context);
                    
                    }
                    let address = objectCollector[0];
                    let regEX   = /^['\+''\.''\-'' '0-9]+$/
                    let phone   = '';
                    objectCollector.forEach(item =>
                        {
                            if(regEX.test(item))
                            {
                                phone = item;
                            }
                        })
                        
                    contexts.push({address: address, phone: phone});
                }
                
            }
              
        }
    }

    
    iterator = 0;
    locations.forEach(location =>
        {
            location.information = contexts[iterator];
            iterator = iterator + 1;
        })

    //parsing locations in GPS
    const gps = await page.$$('.VkpGBb a.VByer');
    const directions = [];
    if(gps && gps.length)
    {
        for(const direction of gps)
        {
            const url = await direction.evaluate(obj => obj.getAttribute('data-url'));
            directions.push("https://www.google.com" + url);
        }
    }
    console.log(directions);
    //parsing is there are any website to contact
    const websites = await page.$$('.VkpGBb a.L48Cpd');
    const hostnames = [];
    if(websites && websites.length)
    {
        for(const website of websites)
        {
            const host = await website.evaluate(url=> url.href);
            hostnames.push(host);
        }
    }

    let counter = 0;
    for(const location of locations)
    {
        if(location.website)
        {
            location.website = hostnames[counter];
            counter++;
        }
    }

    counter = 0;
    for(const location of locations)
    {
        location.direction = directions[counter];
        counter++;
    }
    locations.forEach(location => console.log(location));
    //data.push({name});
    return locations
}

async function goToNextPage(page)
{
    await page.click('.d6cvqb a#pnnext');
    await page.waitForNetworkIdle();
}
/*
async function hasNextPage(page)
{
    const elements = await page.$$('.d6cvqb a span');
    console.log(elements);
    if(!elements)
    {
        throw new Error('next page element is not found.');
    }
    const context = [];
    for(const el of elements)
    {
        const objElement = await el.evaluate(span => span.textContent)
        context.push(objElement);
        
    }
    //you can also grap the google tr pages and do tr.length instead
    console.log(context);
    if((context.length === 2 && context[1] === "Next") || (context.length === 4 && context[3] === "Next"))
    {
        return true;
    }else
    {
        return false;
    }
}
*/
async function autoScroll(page){
    await page.evaluate(async () => {
        await new Promise((resolve, reject) => {
            var totalHeight = 0;
            var distance = 100;
            var timer = setInterval(() => {
                let element = document.querySelector('#center_col');
                var scrollHeight = element.scrollHeight;
                element.scrollBy(0, distance);
                totalHeight += distance;

                if(totalHeight >= scrollHeight - window.innerHeight){
                    clearInterval(timer);
                    resolve();
                }
            }, 100);
        });
    });

    return true
}

router.get('/', function (req,res)
{
Error = false;
(async () => {
    //
  const browser = await puppeteer.launch({headless: false});
  const page = await browser.newPage();
  await page.setViewport
  {
      width: 1300;
      heigth: 900
  }
  await page.goto('https://www.google.com/search?hl=en&tbs=lf:1,lf_ui:14&tbm=lcl&q=automobile+assurance');
  let data = [];
  let nbPage   = 0;
  //let continueParsing = true;
  let allpages = await dataProgressScraper(page);
  while(nbPage < allpages)
  {
    
    if(await autoScroll(page))
    {

        data = data.concat(await dataParser(page));
        nbPage++;
        let str1 = "page nb: " + nbPage + " of" + allpages + " parsed succesfully.";
        let str2 = "new " + data.length + " items parsed succesfully."
        console.log(str1);
        console.log(str2);
        progress = (nbPage * 100)/allpages;
        items    = data.length; 
        await goToNextPage(page);
        //continueParsing = await hasNextPage(page);
    };
    }
    let index = 0;
    data.forEach(d =>
    {
        d.id = index;
        index++;
    });

    const json = JSON.stringify(data);
      console.log(json);

      fs.writeFile('output.json', json, 'utf-8', ()=>
      {
          console.log('file is being saved succesfully');
      })

  await browser.close();
})().catch((error)=>
{
   console.log(error);
   console.log("Im in the error section.");
   Error = true;
});
    res.render("scrapper");
});

router.get('/json', function (req ,res)
{
     res.json({p: progress, items: items, err: Error});
});

router.get('/error', function(req, res)
{
    res.send("Error");
})
module.exports = router;