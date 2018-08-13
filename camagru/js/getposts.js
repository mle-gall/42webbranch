window.fetch('php/give_posts.php', {
    method: 'POST',
    headers: {"Content-Type": "string"},
    credentials:"same-origin"
}).then(res => res.text().then(resp => {
    var div = document.getElementById('content');
    if(resp != 0) {
        div.innerHTML += resp;
    }
    else {
        div.innerHTML += "<div class=sidepic><a>Pictures will be displayed here.</a></div>";
    }
    addlistener();
    document.querySelectorAll('.likebtn').forEach(btn =>{
        getLikesNb(btn.id, (response) => {
            if (response == 1)
                var name = ' like';
            else
                var name = ' likes';
            document.getElementById(btn.id + 'likes').innerHTML = response + name;
        });
    })
}));

function addlistener()
{
    document.querySelectorAll('.likebtn').forEach(btn => {
        btn.addEventListener('click', e => {
            window.fetch('php/like.php', {
                method: 'POST',
                headers: {"Content-Type": "string"},
                credentials:"same-origin",
                body: btn.id
            }).then(res => res.text().then(resp => {
                getLikesNb(btn.id, (response) => {
                    if (response == 1)
                        var name = ' like';
                    else
                        var name = ' likes';
                    if (resp == 'adding')
                        btn.src='uploads/icons/liked.svg';
                    else if(resp == 'removing')
                        btn.src='uploads/icons/like.svg';
                    document.getElementById(btn.id + 'likes').innerHTML = response + name;
                });
            }));
        });
    });
}

function getLikesNb(id, next)
{
    window.fetch('php/likecount.php', {
        method: 'POST',
        headers: {"Content-Type": "string"},
        credentials:"same-origin",
        body: id
    }).then(res => res.text().then(resp => {
        return next(resp);
    }));
}
