<?php
$content = trim(file_get_contents("php://input"));

if (isset($content))
{
    $content = explode(',', $content);
    $image_1 =  base64_decode($content[1]);
    // $name = gmdate('Y-m-d h:i:s');
    // $fp = fopen( '../uploads/untreated/'.$name.'.png', 'wb' );
    // fwrite( $fp, $unencodedData);
    // fclose( $fp );
    $image_2 = imagecreatefrompng('../uploads/stickers/'.$content[2]);
    imagecopymerge_alpha($image_1, $image_2, 0, 0, 0, 0, 100, 100, 100);
    $img = base64_encode($image_1);
    imagepng($image_1, '../uploads/untreated/'.gmdate('Y-m-d h:i:s').'.png');
}
?>
