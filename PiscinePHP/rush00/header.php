<?php
session_start();
$categ = file_get_contents("private/categories");
$categ = unserialize($categ);
$articles = file_get_contents('private/articles');
$articles = unserialize($articles);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mini Shop</title>
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" href="style.css" media="all" />
</head>

<body>
	<header>
	<nav>

		<ul>
			<li>
				<a href="index.php"><img id="header_logo" src="ressources/img/minishop.svg" alt="logo" /></a>
			</li>
			<li class="nav">
				<a href="#">Shop</a>
				<ul class="submenu">
					<?php
					foreach ($categ as $elem)
					{
						echo("<li><a href='category.php?cat=".$elem."'>".$elem."</a><li>");
					}
					?>
				</ul>
			</li>

			<li class="nav" style="float:right;">
				<?php
					if ($_SESSION['connexion_status'] == 'disconnected')
						echo '<a href="connexion.php">Log In</a>';
					else
						echo '<a href="disconnexion.php">Log Out</a>';
				 ?>
			</li>

			<?php
				if(isset($_SESSION['admin']) && $_SESSION['admin'] == 'yes')
                	$adm = '<li> <a href="admin_home.php">Manage website</a></li>';
				else
					$adm = "";
				if ($_SESSION['connexion_status'] == 'connected')
				{
					echo '<li class="nav" style="float:right;">
					<a href="my_profile.php">'.$_SESSION['login'].'</a>
					<ul class="submenu">
						<li> <a href="cart.php">My shopping cart</a></li>
						<li> <a href="my_profile.php">My account</a></li>
						'.$adm.'
					</ul></li>';
				}
			?>

			<li class="nav" style="float:right;">
				<?php
					if ($_SESSION['connexion_status'] == 'disconnected')
						echo '<a href="inscription.php"> Sign In</a>';
				?>
			</li>
        </ul>
    </nav>

		</ul>
	</nav>
</header>
