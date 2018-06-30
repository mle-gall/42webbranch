<?php
$title = "Take a Picture - Camagru";
Include("header.php");
if($stickers = scandir("uploads/stickers"))
{
    foreach($stickers as $key => $elem)
    {
        if(exif_imagetype("uploads/stickers/".$elem) != 3)
        {
            unset($stickers[$key]);
        }
    }
}
?>
<div class=cameradiv>
    <div class=leftdiv>
        <?php
        if(isset($stickers))
        {
            foreach($stickers as $key => $elem)
            {
                if(isset($stickers[$key]))
                echo(
                    "<div class=sticker draggable='true'>
                    <img class='stickerprev' src='uploads/stickers/".$elem."' alt='".$elem."'/>
                    </div>
                    "
                );
            }
        }
        ?>
</div>
<div class=middiv>
    <div class=picture>
        <video id="video"></video>
        <canvas id="canvas" ondrag='sendcoords(ev)'></canvas>
        <script type="text/javascript" src="camera.js"></script>

    </div>
    <div class=take></div>
</div>
<div class=shotshistory>
    <div class=picture>
    </div>
    <div class=take>

    </div>
</div>
</div>
