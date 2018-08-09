window.fetch('php/giveuserprev.php', {
    method: 'POST',
    headers: {"Content-Type": "string"},
    credentials:"same-origin",
}).then(res => res.text().then(resp => {
    if(resp != 0)
    {
        console.log(resp);
    }
}));
