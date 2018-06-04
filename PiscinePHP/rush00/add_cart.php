<?php
session_start();
$articles = file_get_contents('private/articles');
$articles = unserialize($articles);
foreach($articles as $eleme)
{
    if ($eleme['title'] === $_SESSION['artname'])
        $stock = $eleme['quantity'];
}
$i = 0;
$j = 0;
if (isset($_SESSION['artname']))
{
    $name = $_SESSION['artname'];
    if(isset($_SESSION['cart']))
    {
        foreach ($_SESSION['cart'] as $elem)
        {
            if($elem === $name)
            {
                $nb = $_SESSION['cart'][$name];
                if($nb < $stock)
                    $nb++;
                $_SESSION['cart'][$name] = $nb;
                $j = 1;
            }
            $i++;
        }
    }
    else
    {
        $_SESSION['cart'][] = $name;
        $_SESSION['cart'][$name] = '1';
        $j = 1;
    }
    if ($j == 0)
    {
        $_SESSION['cart'][] = $name;
        $_SESSION['cart'][$name] = '1';
    }
    header('Location: cart.php');
}
else
    header('Location: cart.php');
?>
