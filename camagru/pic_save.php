<?php
$content = trim(file_get_contents("php://input"));

if (isset($content))
{
    $filteredData = substr($content, strpos($content, ",")+1);
    $unencodedData = base64_decode($filteredData);
    $name = gmdate('Y-m-d h:i:s');
    $fp = fopen( 'uploads/untreated/'.$name.'.png', 'wb' );
    fwrite( $fp, $unencodedData);
    fclose( $fp );
}
?>
