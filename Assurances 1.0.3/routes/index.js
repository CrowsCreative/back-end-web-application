const express = require('express')
const router  = express.Router({mergeParams: true});
const fs = require('fs');


router.get('/', (req, res)=>
{
    let rawdata = fs.readFileSync('output.json');
    let data = JSON.parse(rawdata);
    res.render("index", {racord: data.length});
})

module.exports = router;