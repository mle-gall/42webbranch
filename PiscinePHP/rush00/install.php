<?php
function create_admin_account()
{
    if (!(file_exists('private/users')))
    {
        $pass = hash('whirlpool', 'toto');
        $admin_account = array(array('login' => 'admin', 'passwd' => $pass, 'admin' => 'yes'));
        $admin_account = serialize($admin_account);
        mkdir('private/', 0777, true);
        file_put_contents('private/users', $admin_account);
    }
}

function create_categories()
{
        if(!(file_exists('private/categories')))
        {
            $categories = array();
            $categories[0] = "Peripherals";
            $categories[1] = "Computers";
            $serialized_array = serialize($categories);
            file_put_contents('private/categories', $serialized_array);
        }
}

function create_articles()
{
    if (!(file_exists('private/articles')))
    {
        $title = 'Corsair Gaming K55 RGB';
        $description = "Pour aligner les victoires et construire votre réputation,
        le clavier Corsair Gaming K55 RGB est le partenaire rêvé. Avec ses touches
        silencieuses et ses 6 touches macros, vous avez à votre disposition une surface
        de jeu idéale et performante.";
        $price = '59';
        $img = 'ressources/img/Corsair_Gaming_K55_RGB.jpg';
        $category = '0Peripherals0';
        $quantity = '8';
        $articles = array(array('title' => $title, 'description' => $description, 'price' => $price, 'img' => $img, 'category' => $category, 'quantity' => $quantity));
        $serialized_array = serialize($articles);
        file_put_contents('private/articles', $serialized_array);
    }
}
create_categories();
create_articles();
create_admin_account();
header('Location: index.php');
?>
