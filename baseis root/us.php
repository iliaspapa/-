<?php include "header.php";
?> 
<br><br>
<center>
<form method = "POST">
    <input type = 'hidden' name = "more_ethel" value = "true">
    <button type="submit"  class="btn btn-warning">
            <h2>Ethel Gouliamou 03116011</h2>
    </button>
</form>
<?php
    if(isset($_POST['more_ethel']))
    {
        echo '<img src="ethel.png" style="width:600px;height:303px;"><br><br>';
        echo '<form method = "POST">
                    <input type = "hidden" name = "less_ethel" value = "true">
                    <button type="submit"  class="btn btn-secondary">
                        <h4>show less</h4>
                    </button>
                </form>';
    }
?>
</center>
<br>
<center>
<form method = "POST">
    <input type = 'hidden' name = "more_ilias" value = "true">
    <button type="submit"  class="btn btn-danger">
            <h2>Ilias Papandreou 03116106</h2>
    </button>
</form>
<?php
    if(isset($_POST['more_ilias']))
    {
        echo '<img src="ilias.jpg" style="width:640px;height:360;"><br><br>';
        echo '<form method = "POST">
                    <input type = "hidden" name = "less_ilias" value = "true">
                    <button type="submit"  class="btn btn-secondary">
                        <h4>show less</h4>
                    </button>
                </form>';
    }
?>
</center>