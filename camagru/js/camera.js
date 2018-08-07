//https://permadi.com/2010/10/html5-saving-canvas-image-data-using-php-and-ajax/

(function() {

    var streaming = false,
    video        = document.querySelector('#video'),
    cover        = document.querySelector('#cover'),
    canvas       = document.querySelector('#canvas'),
    photo        = document.querySelector('#photo'),
    startbutton  = document.querySelector('#startbutton'),
    width = 320,
    height = 240;
    video.setAttribute('autoplay', '');
    video.setAttribute('muted', '');
    video.setAttribute('playsinline', '');

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
        canvas.style.display = 'block';
        document.querySelectorAll('.stickerprev').forEach(sticker => {
            sticker.style.opacity = '1';
        	sticker.addEventListener('dragend', e => {
        		let coords = new Array(document.getElementById('canvas').getBoundingClientRect()).map(rect => {
                    return [(e.clientX - rect.left), (e.clientY - rect.top)].join();
        		});
                console.log(coords);
        console.log(`${e.target.alt},${coords}`);
        		window.fetch('php/create_pic.php', {
                    method: 'POST',
                    headers: {"Content-Type": "string"},
                    body: `${canvasData},${e.target.alt},${coords}`
                }).then(res => res.text().then(json => console.log(json))).catch((err, status) => {
                    console.log(err, status);
                });
        	});
        });
    }

    function takepicture() {
        canvas.getContext('2d').drawImage(video, 0, 0, 320, 240);
        var data = canvas.toDataURL('image/png');
        var dataURL = canvas.toDataURL();
        saveImage();
    }


    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
    }, false);

})();
