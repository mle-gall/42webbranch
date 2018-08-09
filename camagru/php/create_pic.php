<?php
$content = trim(file_get_contents("php://input"));

function resizePng($im, $dst_width, $dst_height)
{
    $width = imagesx($im);
    $height = imagesy($im);
    $newImg = imagecreatetruecolor($dst_width, $dst_height);

    imagealphablending($newImg, false);
    imagesavealpha($newImg, true);

    $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);

    imagefilledrectangle($newImg, 0, 0, $width, $height, $transparent);
    imagecopyresampled($newImg, $im, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);
    return $newImg;
}

if (isset($content))
{
    $content = explode(',', $content);

    if (!file_exists('../uploads/treated'))
    {
        mkdir('../uploads/treated');
    }

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

    $src = resizePng($sticker, 100, 100);
    $src_xPosition = intval($content[3])-50;
    $src_yPosition = intval($content[4])-50;

    imagealphablending($dest, true);
    imagesavealpha($dest, true);
    imagecopy($dest,$src,$src_xPosition,$src_yPosition,0,0,100,100);

    $filepath = '../uploads/treated/'.$name.'.png';

    imagepng($dest, $filepath);
    imagedestroy($src);
    imagedestroy($dest);
    echo base64_encode(file_get_contents('../uploads/treated/'.$name.'.png'));
    unlink('../uploads/treated/'.$name.'.png');
}
?>
