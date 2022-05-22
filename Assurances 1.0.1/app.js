const express = require('express');
const app     = express();
const port    = 10000;
const index       = require("./routes/index");
const scrapper    = require("./routes/scrapper");
const fetcher    = require("./routes/fetcher");
app.use(express.static(__dirname + "/public"));
app.set("view engine", "ejs");

app.use("/", index);
app.use("/scrapper", scrapper);
app.use("/fetcher", fetcher);

app.listen(port, ()=>
{
    console.log(`server start on port ${port}`);
})