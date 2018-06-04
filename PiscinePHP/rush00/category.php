<?php
if ($_GET["cat"] && isset($_GET["cat"]))
{
	include ("header.php");
	foreach($categ as $elem)
	{
		if ($elem === $_GET["cat"])
		{
			$catname = $_GET["cat"];
		}
	}
	if(!isset($catname))
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
?>
		<div class=catcontent>
			<div class=latestarticles>
				<h2><?php echo($catname);?></h2>
			</div>
		<div class=articles>
		<?php
			$i = 0;
			foreach ($articles as $key => $value)
			{
				if(strpos($value['category'], $catname) !== false)
				{
					$i = 1;
					echo "	<div class=article>
					<div class=artpic>
					<a href='article.php?article=".$value['title']."'><img src=\"". $value['img'] ."\" alt=\"". $value['title'] ."\"></a>
					</div>
					<div class=arttitle>
					<h2>". $value['title'] ."</h2>
					</div>
					<div class=downinfos>
					<div class=shortdes>
                    <a>". $value['description'] ."</a>
					</div>
					<div class=price>
					<a>". $value['price'] ."€</a>
					</div>
					</div>
					</div>";
				}
			}
			if ($i == 0)
			{
				echo("<a>Woops ! There is still no article in this category !</a>");
			}
	?>
		</div>
<?php
include 'footer.php';
?>