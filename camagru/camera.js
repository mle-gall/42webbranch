(function() {

    var streaming = false,
    video        = document.querySelector('#video'),
    cover        = document.querySelector('#cover'),
    canvas       = document.querySelector('#canvas'),
    photo        = document.querySelector('#photo'),
    startbutton  = document.querySelector('#startbutton'),
    width = 320,
    height = 0;

    navigator.getMedia = ( navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia);

        navigator.getMedia(
            {
                video: true,
                audio: false
            },
            function(stream) {
                if (navigator.mozGetUserMedia) {
                    video.mozSrcObject = stream;
                } else {
                    var vendorURL = window.URL || window.webkitURL;
                    video.src = vendorURL.createObjectURL(stream);
                }
                video.play();
            },
            function(err) {
                console.log("An error occured! " + err);
            }
        );

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
            window.fetch('pic_save.php', {
                method: 'POST',
                headers: {"Content-Type": "image/png"},
                body: canvasData
            }).then(res => res.text().then(json => console.log(json))).catch((err, status) => {
                console.log(err, status);
            });
            var Video = document.getElementById("videostream");

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
