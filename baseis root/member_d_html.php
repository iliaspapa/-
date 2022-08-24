<?php include "header.php";

?>

<h1 style ="color:purple;"><center>Delete member </h1></center><br>
<?php
    $query = "SELECT * FROM member;";
    $result = mysqli_query($connection,$query);
    $counter  = mysqli_num_rows($result);
    if($counter <= 0) {
        echo "<center> <div class='alert alert-danger' role='alert'>
                    Database is empty!!
                    </div> </center>";
    } 
    else{
        echo '<center><table style="width:70%">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Street</th>
                    <th>Number</th>
                    <th>Postal Code</th>
                    <th>Dirtdate</th>
                </tr>';
        while($row=mysqli_fetch_assoc($result))
        {  
            echo '          <tr>
                                    <td><a href = deletemember.php?ID=' . $row['memberID'] .'>'. $row['memberID'].' </a></td>
                                    <td><a href = deletemember.php?ID=' . $row['memberID'] .'>'. $row['MFirst'].' </a></td>
                                    <td><a href = deletemember.php?ID=' . $row['memberID'] .'>'. $row['MLast'].' </a></td>
                                    <td><a href = deletemember.php?ID=' . $row['memberID'] .'>'. $row['Street'].'</a> </td>
                                    <td><a href = deletemember.php?ID=' . $row['memberID'] .'>'. $row['number'].'</a> </td>
                                    <td><a href = deletemember.php?ID=' . $row['memberID'] .'>'. $row['postalCode'].'</a> </td>
                                    <td><a href = deletemember.php?ID=' . $row['memberID'] .'>'. $row['Mbirthdate'].'</a> </td>
                            </tr>';
        }    
        echo '</center>';                       
    }
    ?>
    </body>
    </html>
