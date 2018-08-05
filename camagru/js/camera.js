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
    // navigator.getMedia = ( navigator.getUserMedia ||
    //     navigator.webkitGetUserMedia ||
    //     navigator.mozGetUserMedia ||
    //     navigator.msGetUserMedia);
    //
    //     navigator.getMedia(
    //         {
    //             video: true,
    //             audio: false
    //         },
    //         function(stream) {
    //             if (navigator.mozGetUserMedia) {
    //                 video.mozSrcObject = stream;
    //             } else {
    //                 video.srcObject = stream;
    //             }
    //             video.play();
    //         },
    //         function(err) {
    //             console.log("An error occured! " + err);
    //         }
    //     );

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
            dragElement(stickers[i]);
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

    function dragElement(elmnt) {
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        elmnt.onmousedown = dragMouseDown;
        function dragMouseDown(e) {
            e = e || window.event;
            e.preventDefault();
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }

        function closeDragElement() {
            /* stop moving when mouse button is released:*/
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }
})();
