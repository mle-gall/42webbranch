<?php
$title = "Take a Picture - Camagru";
Include("php/header.php");
if ($_SESSION['login'] == '' OR $_SESSION['connexion_status'] != 'connected')
{
   header('HTTP/1.0 401 Unauthorized');
   header('Location: index.php');
}
if($stickers = scandir("uploads/stickers"))
{
    foreach($stickers as $key => $elem)
    {
        if(file_exists("uploads/stickers/".$elem))
        {
            if(mime_content_type('uploads/stickers/'.$elem) != "image/png")
            {
                unset($stickers[$key]);
            }
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
        <button id="startbutton">Prendre une photo</button>
        <canvas id="canvas" width=320 height=240></canvas>
        <script type="text/javascript" src="js/camera.js"></script>
        <form action="take_pic.php" method="get">
            <button id="retakebutton" onclick="redirect()"> Reprendre la photo</button>
        </form>
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
