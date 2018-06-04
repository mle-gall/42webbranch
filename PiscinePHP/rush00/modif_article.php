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
        <form class="backdivbg" action="modify_article.php" method="post">
        <p>
            <h1>Modify article</h1>
            <strong>if you let a empty line the old value will stay</strong>
            <br>
            <input class=forminput placeholder="Old Title" type="text" name="old_title" autofocus required />
            <br>
            <input class=forminput placeholder="New Title" type="text" name="new_title" />
            <br>
            <input class=forminput placeholder="URL Image" type="url" name="img"  />
            <br>
            <input class=forminput placeholder="Price" type="number" name="price" step="0.01"  />
            <br>
            <input class=forminput placeholder="Description" type="text" name="description" />
            <br>
            <input class=forminput placeholder="Quantity" type="number" name="quantity"  />
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
