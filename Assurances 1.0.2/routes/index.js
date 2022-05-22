const express = require('express')
const router  = express.Router({mergeParams: true});



router.get('/', (req,res)=>
{
    res.send("i'm in the home page");
    
})

module.exports = router;