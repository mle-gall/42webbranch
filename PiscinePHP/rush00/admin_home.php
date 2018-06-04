<?php
include 'header.php';
if ($_SESSION['login'] == '' OR $_SESSION['connexion_status'] != 'connected' OR $_SESSION['admin'] == 'no')
{
    header('HTTP/1.0 401 Unauthorized');
    header('Location: index.php');
}
?>
<div class=pageback>
    <?php include'sidebar.php'?>
    <div class=contentform>
                <h1>Welcome on your backoffice</h1>
                <a>Just follow the links on your left to administrate your website !</a>
                <a>Enjoy :)</a>
    </div>
</div>
<?php
include 'footer.php';
?>
