<?php
if ($_SESSION['login'] == '' OR $_SESSION['connexion_status'] != 'connected' OR $_SESSION['admin'] == 'no')
{
    header('HTTP/1.0 401 Unauthorized');
    header('Location: index.php');
}
?>
<div class=sidebar>
    <ul class=ulside ><a class=lisidebar href=admin_home.php>Home</a></ul>
    <ul class=ulside ><a class=lisidebar href='article_panel.php'>Create Article</a></ul>
    <ul class=ulside ><a class=lisidebar href='modif_article.php'>Modify Article</a></ul>
    <ul class=ulside ><a class=lisidebar href='del_article.php'>Delete Article</a></ul>
    <ul class=ulside ><a class=lisidebar href='add_category.php'>Create Category</a></ul>
    <ul class=ulside ><a class=lisidebar href='del_category.php'>Delete Category</a></ul>
    <ul class=ulside ><a class=lisidebar href='upgr_user.php'>Upgrade User</a></ul>
    <ul class=ulside ><a class=lisidebar href='remove_user.php'>Remove User</a></ul>
</div>
