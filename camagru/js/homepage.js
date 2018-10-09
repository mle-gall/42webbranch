getcontent();
listenForScroll();

function getcontent(lastelem) {
    window.fetch('php/give_posts.php', {
        method: 'POST',
        headers: {"Content-Type": "string"},
        credentials:"same-origin",
        body: lastelem
    }).then(res => res.text().then(resp => {
        var div = document.getElementById('content');
        if(resp != 0) {
            div.innerHTML += resp;
        }
        else {
            if (lastelem == null) {
                div.innerHTML += "<div class=sidepic><p>Pictures will be displayed here.</p></div>";
            }
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
        document.querySelectorAll('.likebtn').forEach(btn =>{
            getComments(btn.id);
        })
        document.querySelectorAll('.addcomment').forEach(adder =>{
            adder.querySelector("#form").addEventListener("submit", e => {
                var content = adder.querySelector("#field").value;
                if(content !== "")
                {
                    var obj = new Object();
                    obj.picid = adder.id;
                    obj.content = content;
                    var jsonString = JSON.stringify(obj);
                    window.fetch("php/addcomment.php",{
                        method: 'POST',
                        credentials:"same-origin",
                        body: jsonString
                    })
                    adder.querySelector("#field").value = "";
                }
            });
        })
    }));
};

function addlistener()
{
    document.querySelectorAll('.likebtn').forEach(btn => {
        btn.alt = '1';
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

function getComments(id)
{
    window.fetch('php/getcomments.php', {
        method: 'POST',
        headers: {"Content-Type": "string"},
        credentials:"same-origin",
        body: id
    }).then(res => res.text().then(resp => {
        resp = JSON.parse(resp);
        resp.forEach(function(k){
            if (document.getElementById(id + "com")) {
                document.getElementById(id + "com").innerHTML +=
                "<div class=comment><div class=username><b>" + k['CreatorName'] +
                "</b></div><div class=text><p>" + k[3] +
                "</p></div></div>";
            }
        });
        if (document.getElementById(id + "com")) {
            document.getElementById(id + "com").id += 'done';
        }
    }));
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

function listenForScroll()
{
    localStorage.setItem("visibility", "");
    document.addEventListener('scroll', e => {
        if(isVisible(document.querySelector('#toggle')))
        {
            visibility = localStorage.getItem("visibility");
            if (visibility == 'unvisible')
            {
                localStorage.setItem("visibility", "visible");
                fetchmore();
            }
        }
        else {
            localStorage.setItem("visibility", "unvisible");
        }
    });
}

function isVisible(el) {
    var rect = el.getBoundingClientRect();
    var elemTop = rect.top;
    var elemBottom = rect.bottom;
    var isVisible = (elemTop >= 0) && (elemBottom <= window.innerHeight);
    return isVisible;
}

function fetchmore() {
    var posts = document.querySelectorAll('.imgdiv');
    var last = posts[posts.length - 1];
    getcontent(last.id);
}
