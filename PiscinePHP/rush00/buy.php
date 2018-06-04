<?php
session_start();
$articles = file_get_contents('private/articles');
$articles = unserialize($articles);
if (isset($_SESSION['list']))
{
    $list = $_SESSION['list'];
}
foreach($list as $key => $elem)
{
    $i = 0;
    foreach($articles as $keye => $eleme)
    {
        if($eleme['title'] === $key)
            $articles[$i]['quantity'] = ($articles[$i]['quantity'] - $elem);
        $i++;
    }
}
unset($_SESSION['cart']);
unset($_SESSION['artname']);
$articles = serialize($articles);
file_put_contents('private/articles', $articles);
?>
<meta http-equiv="refresh" content="0; URL=index.php">
