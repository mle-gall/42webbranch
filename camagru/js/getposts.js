window.fetch('php/give_posts.php', {
    method: 'POST',
    headers: {"Content-Type": "string"},
    credentials:"same-origin",
}).then(res => res.text().then(resp => {
    console.log(resp);
    var div = document.getElementById('content');
    if(resp != 0) {
        div.innerHTML += resp;
    }
    else {
        div.innerHTML += "<div class=sidepic><a>Pictures will be displayed here.</a></div>";
    }
}));
