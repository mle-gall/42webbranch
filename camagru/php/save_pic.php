<?php
$content = trim(file_get_contents("php://input"));
session_start();
if(isset($bdd) == 0)
{
    include('db_connect.php');
}
if (isset($content) && isset($_SESSION['id']) AND $_SESSION['connexion_status'] === 'connected')
{
    if(!file_exists('../uploads/images'))
    {
        mkdir('../uploads/images');
    }
    $filteredData = substr($content, strpos($content, ",")+1);
    $unencodedData = base64_decode($filteredData);
    $name = gmdate('Y-m-d.h:i:s');
    $fp = fopen( '../uploads/images/'.$name.'.png', 'wb' );
    fwrite( $fp, $unencodedData);
    fclose( $fp );
    $req = $bdd->prepare('INSERT INTO PICTURES(CreatorID, link) VALUES(:id, :link)');
    $req->execute(array(
        'id' => $_SESSION['id'],
        'link' => $name.'.png'
    ));
}
?>
