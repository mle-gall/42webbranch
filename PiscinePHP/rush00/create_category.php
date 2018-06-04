<?PHP
if ($_SESSION['login'] == '' OR $_SESSION['connexion_status'] != 'connected' OR $_SESSION['admin'] == 'no')
{
	header('HTTP/1.0 401 Unauthorized');
	header('Location: index.php');
}

if ($_POST['category'] != NULL)
{
	$category = file_get_contents('private/categories');
	$category = unserialize($category);
	$category[] = $_POST['category'];
	$category = serialize($category);
	file_put_contents('private/categories', $category);
	header('Location: add_category.php?action=create');
}
else
{
	header('Location: add_category.php?action=error');
}

?>
