<?php
$content = trim(file_get_contents("php://input"));

if (isset($content))
{
    if (!file_exists('../uploads/treated'))
    {
        mkdir('../uploads/treated');
    }
    $content = explode(',', $content);
    if ($content[3] < 0 OR $content[3] > 320 OR $content[4] < 0 OR $content[4] > 240)
    {
        echo(0);
        return(0);
    }
    $unencodedData = base64_decode($content[1]);
    $name = gmdate('Y-m-d h:i:s');
    $fp = fopen( '../uploads/treated/'.$name.'.png', 'wb' );
    fwrite( $fp, $unencodedData);
    fclose( $fp );
    $sticker = imagecreatefrompng('../uploads/stickers/'.$content[2]);
    $dest = imagecreatefrompng('../uploads/treated/'.$name.'.png');
    list($srcWidth, $srcHeight) = getimagesize('../uploads/stickers/'.$content[2]);
    $src = imagecreatetruecolor(50, 50);
    imagecopyresampled($src, $sticker, 0, 0, 0, 0, 50, 50, $srcWidth, $srcHeight);
    $src_xPosition = intval($content[3]) - 50;
    $src_yPosition = intval($content[4]);
    imagecolortransparent($src,imagecolorat($src,0,0));
    imagecopymerge($dest,$src,$src_xPosition,$src_yPosition,0,0,50,50, 100);
    $filepath = '../uploads/treated/'.$name.'.png';
    imagepng($dest, $filepath);
    imagedestroy($src);
    imagedestroy($dest);
    echo base64_encode(file_get_contents('../uploads/treated/'.$name.'.png'));
    unlink('../uploads/treated/'.$name.'.png');
}
?>
