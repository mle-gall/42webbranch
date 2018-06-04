<?php
include "header.php";
?>
	<div class=contentform>
			<form class="formbg" action="create_user.php" method="post">
			<h1>Sign-In</h1>
			<p>
				<?php
        		if(isset($_GET["action"]) && $_GET["action"] === "error")
            	echo('<div class=msgerror><a>ERROR : The two password don\'t match</a></div><input class=forminput placeholder="Login" type="text" name="login" value='.$_GET['login']." autofocus required />");
            	else if (isset($_GET["action"]) && $_GET["action"] === "error2")
            	echo('<div class=msgerror><a>ERROR : Login already in use</a></div><input class=forminput placeholder="Login" type="text" name="login" autofocus required />');
            	else
            		echo('<input class=forminput placeholder="Login" type="text" name="login" autofocus required />');
        		?>
				<br>
				<input class=forminput placeholder="Password" type="password" name="passwd1" required />
				<br>
				<input class=forminput placeholder="Repeat Password" type="password" name="passwd2" required />
				<br>
				<input class=buttoninput type="submit" name="submit" value="OK" />
			</p>
		</form>
	</div>

<?php
include "footer.php";
?>
