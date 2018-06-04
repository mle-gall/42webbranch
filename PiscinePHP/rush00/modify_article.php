<?PHP
session_start();
if ($_SESSION['login'] == '' OR $_SESSION['connexion_status'] != 'connected' OR $_SESSION['admin'] == 'no')
{
   header('HTTP/1.0 401 Unauthorized');
   header('Location: index.php');
}

function img_checker($img)
{
    $header = get_headers($img, 1);

    if (preg_match("#OK#i", $header[0]) AND preg_match("#image#i", $header['Content-Type']))
        return TRUE;
    else
        return FALSE;
}

function find_checked_box()
{
    $box = ' ';
    foreach ($_POST as $key => $value)
    {
        if ($value == 'on')
        {
            $box = $box . $key . " ";
        }
    }
    return ($box);
}

$articles = file_get_contents('private/articles');
$articles = unserialize($articles);
$checked_box = find_checked_box();
$checked_box = trim($checked_box);
if (strlen($checked_box) > 0)
    $checked_box = preg_split("/[\s]+/", $checked_box);
else
    $checked_box = [];

foreach ($articles as $value)
{
    if ($value['title'] == $_POST['old_title'])
    {
        $article = $value;
        break ;
    }
}

foreach ($_POST as $key => $value)
{
    if ($key === "new_title" && strlen($value) > 0)
        $article["title"] = $value;
    else if ($key === "img" && strlen($value) > 0 && img_checker($value) == TRUE)
        $article["img"] = $value;
    else if ($key === "price" && strlen($value) > 0)
        $article["price"] = $value;
    else if ($key === "description" && strlen($value) > 0)
        $article["description"] = $value;
    else if ($key === "quantity" && strlen($value) > 0)
        $article["quantity"] = $value;
}

$str = '';

foreach ($checked_box as $key => $value)
{
    $str .= '0';
    $str .= $value;
}

if (strlen($str) > 0 && count($checked_box) > 0)
{
    $str .= '0';
    $article["category"] = $str;
}

foreach ($articles as $key => $value)
{
    if ($value['title'] == $_POST['old_title'])
    {
        $articles[$key] = $article;
        break ;
    }
}

$articles = serialize($articles);
file_put_contents('private/articles', $articles);
header("Location: modif_article.php")
?>
