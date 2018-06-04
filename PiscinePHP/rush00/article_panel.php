<?php
include 'header.php';
if ($_SESSION['login'] == '' OR $_SESSION['connexion_status'] != 'connected' OR $_SESSION['admin'] == 'no')
{
    header('HTTP/1.0 401 Unauthorized');
    header('Location: index.php');
}
?>
<div class=pageback>
    <?php include'sidebar.php'?>
    <div class=backcontent>
        <form class="backdivbg" action="create_article.php" method="post">
            <p>
                <?php
                if(isset($_GET["action"]) && $_GET["action"] === "create")
                    echo("<div class=msgsucces><a>Your article has been created ! Yupi !</a></div>");
                else if(isset($_GET["action"]) && $_GET["action"] === "error")
                    echo("<div class=msgerror><a>ERROR : Image invalid ?</a></div>");
                ?>
                <h1>Create article</h1>
                <input class=forminput placeholder="Title" type="text" name="title" autofocus required />
                <br>
                <input class=forminput placeholder="URL Image" type="url" name="img" required />
                <br>
                <input class=forminput placeholder="Price" type="number" name="price" step="0.01" required />
                <br>
                <input class=forminput placeholder="Description" type="text" name="description" required />
                <br>
                <input class=forminput placeholder="Quantity" type="number" name="quantity" required />
                <br>
                <fieldset class=fdset>
                    <legend>Please select article's category</legend>
                    <?php if (file_exists('private/categories') == TRUE)
                    {
                        foreach ($categ as $value)
                        {
                            echo "<div>
                                <label class='container' for=". $value .">". $value ."
                                    <input type=checkbox id=". $value ." name=". $value .">
                                    <span class='checkmark'></span>
                                </label>
                                </div>";
                            }
                        }
                        ?>
                    </fieldset>
                    <input class=buttoninput type="submit" name="submit" value="OK" />
                </p>
            </form>
        </div>
</div>
<?php
include 'footer.php';
?>
