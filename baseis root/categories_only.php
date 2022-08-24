<?php include "header.php";
    $query = "SELECT * FROM all_categories;";
    $result = mysqli_query($connection,$query);
    $counter = mysqli_num_rows($result);
    if($counter<=0){
        echo "<center> <div class='alert alert-danger' role='alert'>
                    Oops no categories
                </div> </center>";
    }
    else{
        echo '<center><h1>Our categories</h1>
                <center><table style="width:100%">
                    <tr>
                        <th><center><h2 style="color:blue;">category name</h2></center></th>
                    </tr>';
            while($row=mysqli_fetch_assoc($result))
            { 
                echo '          <tr>
                                        <td><center><h3>' . $row['categoryName'] .'</h3></center></td>
                                </tr>';
            }    
            echo '</center>'; 
    }
?>
