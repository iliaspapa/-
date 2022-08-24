<?php include "header.php";

?>

<h1 style ="color:purple;"><center>Delete book </h1></center><br>
<?php
    $query = "SELECT * FROM book;";
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
                    <th>ISBN</th>
                    <th>title</th>
                    <th>pubYear</th>
                    <th>numpages</th>
                    <th>pubName</th>
                </tr>';
        while($row=mysqli_fetch_assoc($result))
        {  
            echo '          <tr>
                                    <td><a href = deletebook.php?ISBN=' . $row['ISBN'] .'>'. $row['ISBN'].' </a></td>
                                    <td><a href = deletebook.php?ISBN=' . $row['ISBN'] .'>'. $row['title'].' </a></td>
                                    <td><a href = deletebook.php?ISBN=' . $row['ISBN'] .'>'. $row['pubYear'].' </a></td>
                                    <td><a href = deletebook.php?ISBN=' . $row['ISBN'] .'>'. $row['numpages'].'</a> </td>
                                    <td><a href = deletebook.php?ISBN=' . $row['ISBN'] .'>'. $row['pubName'].'</a> </td>
                            </tr>';
        }    
        echo '</center>';                       
    }
    ?>
    </body>
    </html>
