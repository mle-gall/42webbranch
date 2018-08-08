<?php
$content = trim(file_get_contents("php://input"));

if (isset($content))
{
    $content = explode(',', $content);
    // $name = gmdate('Y-m-d h:i:s');
    // $fp = fopen( '../uploads/untreated/'.$name.'.png', 'wb' );
    // fwrite( $fp, $unencodedData);
    // fclose( $fp );
    if ($content[3] < 0 OR $content[3] > 320 OR $content[4] < 0 OR $content[4] > 240)
    {
        echo(0);
        return(0);
    }

    $unencodedData = base64_decode($content[1]);
    $name = gmdate('Y-m-d h:i:s');
    $fp = fopen( '../uploads/untreated/'.$name.'.png', 'wb' );
    fwrite( $fp, $unencodedData);
    fclose( $fp );
    $sourceImage = imagecreatefrompng('../uploads/stickers/'.$content[2]);
    $destImage = imagecreatefrompng('../uploads/untreated/'.$name.'.png');
    list($srcWidth, $srcHeight) = getimagesize($sourceImage);
    $src = imagecreatefrompng($sourceImage);
    $dest = imagecreatefrompng($destImage);
    $src_xPosition = intval($content[3]);
    $src_yPosition = intval($content[4]);
    imagecolortransparent($src,imagecolorat($src,0,0));
    imagecopymerge($dest,$src,$src_xPosition,$src_yPosition,0,0,$srcWidth,$srcHeight);
    imagepng($dest, '../uploads/treated/'.$name.'.png', 100);
    imagedestroy($src);
    imagedestroy($dest);
}
?>
