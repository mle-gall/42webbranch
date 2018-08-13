window.fetch('php/giveuserprev.php', {
    method: 'POST',
    headers: {"Content-Type": "string"},
    credentials:"same-origin",
}).then(res => res.text().then(resp => {
    var div = document.getElementById('rightdiv');
    if(resp != 0) {
        div.innerHTML += '<div class=sidepic><h3>Shot History</h3></div>' + resp;
        addbutton();
    }
    else {
        div.innerHTML += '<div class=sidepic><h3>Shot History</h3></div><div class=sidepic><a>Your pictures will be displayed here.</a></div>';
    }
}));

function addbutton() {
    document.querySelectorAll('.removebutton').forEach( button => {
        button.addEventListener('click', e => {
            name = button.id;
            window.fetch('php/del_pic.php', {
                method: 'POST',
                headers: {"Content-Type": "string"},
                credentials: "same-origin",
                body: name
            }).then(res => {
                if(res != 'error')
                {
                    window.location.href = "take_pic.php";
                }
            });
        });
    });
}
