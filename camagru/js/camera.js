//https://permadi.com/2010/10/html5-saving-canvas-image-data-using-php-and-ajax/

(function() {

    var streaming = false,
    video        = document.querySelector('#video'),
    canvas       = document.querySelector('#canvas'),
    startbutton  = document.querySelector('#startbutton'),
    width = 320,
    height = 240;
    video.setAttribute('autoplay', '');
    video.setAttribute('muted', '');
    video.setAttribute('playsinline', '');

    if (navigator.mediaDevices.getUserMedia)
    {
        navigator.mediaDevices.getUserMedia({audio: false, video: true}).then(function(stream){
            if (navigator.mozGetUserMedia) {
                video.mozSrcObject = stream;
            } else {
                video.srcObject = stream;
            }
            video.play();
        }).catch(function(err) {
            console.log("An error occured! " + err);
        });
    }
    else {
        document.getElementById("video").style.display = 'none';
        document.getElementById("startbutton").style.display = 'none';
        document.getElementById('or').style.display = 'none';
    }

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
        document.getElementById("video").style.display = 'none';
        document.getElementById("startbutton").style.display = 'none';
        document.getElementById("retakebutton").style.display = 'block';
        document.getElementById('lab').style.display = 'none';
        document.getElementById('or').style.display = 'none';
        video.srcObject.getTracks().forEach(track => track.stop())
        canvas.style.display = 'block';
        document.querySelectorAll('.stickerprev').forEach(sticker => {
            sticker.style.opacity = '1';
            sticker.addEventListener('dragend', e => {
                let coords = new Array(document.getElementById('canvas').getBoundingClientRect()).map(rect => {
                    console.log((e.clientX), (e.clientY));
                    return [(e.clientX - rect.left), (e.clientY - rect.top)].join();
                });

                window.fetch('php/create_pic.php', {
                    method: 'POST',
                    headers: {"Content-Type": "string"},
                    body: `${canvasData},${e.target.alt},${coords}`
                }).then(res => res.text().then(resp => {
                    if(resp != 0)
                    {
                        var image = 'data:image/png;base64,' + resp;
                        var img = new Image();
                        img.onload = function () {
                            canvas.getContext('2d').drawImage(img, 0, 0, 320, 240);
                        }
                        img.src = image;
                        var publishbutton = document.getElementById("publishbutton");
                        publishbutton.style.display = 'block';
                        publishbutton.addEventListener('click', function(ev){
                            sendpicture();
                            ev.preventDefault();
                        }, false);
                    }
                }));
            });
        });
    }

    function takepicture() {
        canvas.getContext('2d').drawImage(video, 0, 0, 320, 240);
        var data = canvas.toDataURL('image/png');
        var dataURL = canvas.toDataURL();
        saveImage();
    }

    function sendpicture() {
        var canvas = document.getElementById("canvas");
        var canvasData = canvas.toDataURL("image/png");
        window.fetch('php/save_pic.php', {
            method: 'POST',
            headers: {"Content-Type": "string"},
            credentials:"same-origin",
            body: `${canvasData}`
        })
        window.location.href = "/index.php";
    }

    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
    }, false);

    var inputFile = document.createElement('input');
    inputFile.type = 'file';
    inputFile.setAttribute("id", "imginput");
    inputFile.setAttribute("div", "input-file");
    inputFile.accept = 'image/png';
    inputFile.addEventListener('change', function (evt) {
        var file    = document.querySelector('input[type=file]').files[0];
        var reader  = new FileReader();

        reader.addEventListener("load", function () {
            var res = reader.result;
            var imgcanvas = new Image();
            imgcanvas.onload = function () {
                canvas.getContext('2d').drawImage(imgcanvas, 0, 0, 320, 240);
                saveImage();
            }
            imgcanvas.src = res;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    });
    document.getElementsByClassName("picture")[0].appendChild(inputFile);
})();
