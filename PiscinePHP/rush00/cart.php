<?php
include 'header.php';
include 'iseven.php';
if ($_SESSION['connexion_status'] == 'disconnected')
	header("Location: connexion.php");
?>
<div class=cartcontent>
	<div class=cart>
		<div class=title>
			<h1>Shopping Cart</h1>
		</div>
		<div class=lines>
			<?php
				$totprice = 0;
				$list = array();
				if(isset($_SESSION['cart']) && $_SESSION['cart'])
				{
					$i = 1;
					foreach($_SESSION['cart'] as $elem => $value)
					{
						if (ftiseven($i))
						{
							foreach($articles as $eleme)
							{
								if ($eleme['title'] === $elem)
								{
									$price = $eleme['price'];
								}
							}
							if ($value != 0)
							{
								$list[$elem] = $value;
								echo('<div class=line>
								<div class=name>
									<a>'.$elem.'</a>
								</div>
								<div  class=space1></div>
								<div class=quantity>
									<a> Quantity : '.$value.'</a>
								</div>
								<div class=buttons>
								<div class=but1>
								<form class="frm" action="rem_cart.php" method="post">
									<input class=cartbutton type="submit" action="remove" name="'.$elem.'" value="-" title="-"/>
								</form>
								</div>
								<div class=but1>
								<form class="frm" action="add_cart_two.php" method="post">
									<input class=cartbutton type="submit" action="add" name="'.$elem.'" value="+" title="-"/>
								</form>
								</div>
								</div>
								<div  class=sapce></div>
								<div class=price>
									<a> Price : '.$price.' €</a>
								</div>
								</div>');
							}
							$totprice = $totprice + ($price * $value);
						}
						$i++;
					}
				}
				$_SESSION['list'] = $list;
			?>
		</div>
		<div class=bottom>
			<div class=totalprice>
				<a>Total price :  </a> <h2><?php echo $totprice; ?> €</h2>
			</div>
			<div class=orderbutton>
				<form class="frm" action="buy.php" method="post">
					<input class=buttoninput type="submit" action="send" name="buy" name="submit" value="Acheter"/>
				</form>
			</div>
			</div>
		</div>
	</div>
</div>
<?php
include 'footer.php';
?>
