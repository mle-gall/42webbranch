window.fetch('php/giveuserprev.php', {
    method: 'POST',
    headers: {"Content-Type": "string"},
    credentials:"same-origin",
}).then(res => res.text().then(resp => {
    var div = document.getElementById('rightdiv');
    if(resp != 0) {
        div.innerHTML += resp;
    }
    else {
        div.innerHTML += "<div class=sidepic><a>Your pictures will be displayed here.</a></div>";
    }
}));
