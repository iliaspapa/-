<?php include "header.php";

?>

<h1 style ="color:purple;"><center>Delete category </h1></center><br>
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
                    <th><center>categoryName</center></th>
                </tr>';
        while($row=mysqli_fetch_assoc($result))
        {  
            echo '          <tr>
                                    <td><a href = deletecategory.php?categoryName=' . $row['categoryName'] .'><center>'. $row['categoryName'].' </center></a></td>
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
