<?php
session_start();
$articles = file_get_contents('private/articles');
$articles = unserialize($articles);
foreach($_POST as $key => $val)
    $name = preg_replace('/(_)/', " ", $key);
$i = 0;
$j = 0;
if(isset($_SESSION['cart']) && isset($name))
{
    foreach ($_SESSION['cart'] as $elem)
    {
        if($elem === $name)
        {
            $nb = $_SESSION['cart'][$name];
            if($nb > 0)
                $nb--;
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
?>
