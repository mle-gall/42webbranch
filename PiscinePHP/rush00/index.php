<?php
include 'header.php';
?>
<div class=content>
	<div class=featctnt>
		<img class=banner src="ressources/img/banner.png" />
	</div>
	<div class=latestarticles>
		<h2>Latest Articles</h2>
	</div>
	<div class="articles">
	<?PHP
	foreach ($articles as $key => $value)
	{
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
					<h2>". $value['price'] ."€</h2>
				</div>
			</div>
		</div>";
	}
	?>
	</div>
</div>
<?php
include 'footer.php';
?>
