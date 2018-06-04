<?php
if ($_GET["article"] && isset($_GET["article"]))
{
	include ("header.php");
	foreach($articles as $elem => $value)
	{
		if ($value['title'] === $_GET["article"])
		{
			$artname = $_GET["article"];
			$description = $value["description"];
			$price = $value["price"];
			$img = $value["img"];
			$quantity = $value["quantity"];
		}
	}
	if(!isset($artname))
	{
		header('HTTP/1.0 404 File Not Found');
    	header('Location: index.php');
	}
}
else
{
	header('HTTP/1.0 404 File Not Found');
    header('Location: index.php');
}
$_SESSION['artname'] = $artname;
?>
		<div class=artcontent>
			<div class=articlebg>
				<div class=topbox>
					<div class=artleftcol>
						<h2><?php echo($artname);?></h2>
						<div class=descr><a><?php echo($description);?></a></div>
					</div>
					<div class=artrightcol>
						<div class=articleimg><img src=<?php echo $img;?>></div>
						<div class=price><h1><?php echo($price);?> €</h1></div>
						<div class=qtt><a>Quantity : </a><h2><?php if($quantity == 0)echo("Out of stock"); else echo($quantity);?></h2>
						</div>
						<?php if($quantity<10 && $quantity != 0) echo("<a>Warning, we will run out of stock !</a>");?>
					</div>
				</div>
				<div class=botbox>
					<div class=tocart>
						<?php
						if($quantity == 0)
						echo('<input class=buttoncartgrey type="submit" name="" value="Out of stock" />');
						else
						echo('<form class="formbg" action="add_cart.php" method="post"> <input class=buttoncart type="submit" name="$artname" value="ADD TO CART" /></form>');
						?>
					</div>
				</div>
			</div>
		</div>
<?php
include 'footer.php';
?>
