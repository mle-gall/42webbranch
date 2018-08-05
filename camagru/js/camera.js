//https://permadi.com/2010/10/html5-saving-canvas-image-data-using-php-and-ajax/

(function() {

    var streaming = false,
    video        = document.querySelector('#video'),
    cover        = document.querySelector('#cover'),
    canvas       = document.querySelector('#canvas'),
    photo        = document.querySelector('#photo'),
    startbutton  = document.querySelector('#startbutton'),
    width = 320,
    height = 0;

    navigator.mediaDevices.getUserMedia({audio: true, video: true}).then(function(stream){
        if (navigator.mozGetUserMedia) {
            video.mozSrcObject = stream;
        } else {
            video.srcObject = stream;
        }
        video.play();
    }).catch(function(err) {
        console.log("An error occured! " + err);
    });

    video.addEventListener('canplay', function(ev){
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth/width);
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
        }
    }, false);

    function saveImage() {
        var canvas = document.getElementById("canvas");
        var canvasData = canvas.toDataURL("image/png");
        window.fetch('php/pic_save.php', {
            method: 'POST',
            headers: {"Content-Type": "image/png"},
            body: canvasData
        }).then(res => res.text().then(json => console.log(json))).catch((err, status) => {
            console.log(err, status);
        });
        var video = document.getElementById("video");
        var tbutton = document.getElementById("startbutton");
        var rbutton = document.getElementById("retakebutton");
        var stickers = document.getElementsByClassName("stickerprev");
        video.style.display = 'none';
        canvas.style.display = 'block';
        tbutton.style.display = 'none';
        rbutton.style.display = 'block';
        for(var i = stickers.length - 1; i >= 0; --i)
        {
            stickers[i].style.opacity = '1';
        }
    }

    function takepicture() {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        var data = canvas.toDataURL('image/png');
        var dataURL = canvas.toDataURL();
        saveImage();
    }


    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
    }, false);
})();