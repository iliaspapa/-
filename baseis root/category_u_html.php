<?php include "header.php";

?>
<?php
    if(isset($_GET['categoryName'])){
        echo '
                <center><h1>Update category '.$_GET['categoryName'].'</h1></center><br>
                <center>
                    <form action = "updatecategory.php" method = "GET">
                        <input type = "hidden" name = "oldcategoryName" value='.$_GET['categoryName'].'>
                        <input type = "text" name = "categoryName" placeholder = "category Name"><br><br>
                        <button type = "submit" class="btn btn-success">
                            submit
                        </button>
                    </form> 
                    <form action = "category_u_html.php" method= "POST">
                            <input type="hidden" name="cancel" >
                            <button type = "submit" class="btn btn-danger">
                                cancel
                            </button>
                    </form> 
                </center>';
    }
?>

<h1 style ="color:purple;"><center>Update category </h1></center><br>
<?php
    $query = "SELECT * FROM category;";
    $result = mysqli_query($connection,$query);
    $counter  = mysqli_num_rows($result);
    if($counter <= 0) {
        echo "<center> <div class='alert alert-danger' role='alert'>
                    There are no categories!!
                    </div> </center>";
    } 
    else{
        echo '<center><table style="width:70%">
                <tr>
                    <th><center>category Name</center></th>
                </tr>';
        while($row=mysqli_fetch_assoc($result))
        {  
            echo '          <tr>
                                    <td><a href = category_u_html.php?categoryName=' . $row['categoryName'] .'><center>'. $row['categoryName'].' </center></a></td>
                            </tr>';
        }    
        echo '</center>';                       
    }
    ?>
    <?php
    if(isset($_GET['status'])){
        $error = $_GET['status'];
        if($error == 'successful') $type = 'success';
        else $type = 'danger';
        echo "<center> <div class='alert alert-$type' role='alert'>
                    $error
                    </div> </center>";
    }
?>

    </body>
    </html>
