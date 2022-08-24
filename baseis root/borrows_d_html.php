<?php include "header.php";

?>

<h1 style ="color:purple;"><center>Delete borrowing </h1></center><br>
<?php
    $query = "SELECT * FROM borrows;";
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
                    <th>member ID</th>
                    <th>book ISBN</th>
                    <th>copy number</th>
                    <th>date of borrowing</th>
                    <th>date of return</th>
                </tr>';
        while($row=mysqli_fetch_assoc($result))
        {  
            echo '          <tr>
                                    <td><a href = deleteborrows.php?ISBN=' . $row['ISBN'] .
                                                                '&memberID='. $row['memberID'].
                                                                '&copyNr='.$row['copyNr'].
                                                                '&date_of_borrowing='. $row['date_of_borrowing']. 
                                                                    '>'. $row['memberID'].' </a></td>
                                    <td><a href = deleteborrows.php?ISBN=' . $row['ISBN'] .
                                                                '&memberID='. $row['memberID'].
                                                                '&copyNr='.$row['copyNr'].
                                                                '&date_of_borrowing='. $row['date_of_borrowing']. 
                                                                    '>'. $row['ISBN'].' </a></td>
                                    <td><a href = deleteborrows.php?ISBN=' . $row['ISBN'] .
                                                                '&memberID='. $row['memberID'].
                                                                '&copyNr='.$row['copyNr'].
                                                                '&date_of_borrowing='. $row['date_of_borrowing']. 
                                                                    '>'. $row['copyNr'].' </a></td>
                                    <td><a href = deleteborrows.php?ISBN=' . $row['ISBN'] .
                                                                '&memberID='. $row['memberID'].
                                                                '&copyNr='.$row['copyNr'].
                                                                '&date_of_borrowing='. $row['date_of_borrowing']. 
                                                                    '>'. $row['date_of_borrowing'].'</a> </td>
                                    <td><a href = deleteborrows.php?ISBN=' . $row['ISBN'] .
                                                                '&memberID='. $row['memberID'].
                                                                '&copyNr='.$row['copyNr'].
                                                                '&date_of_borrowing='. $row['date_of_borrowing']. 
                                                                    '>'. $row['date_of_return'].'</a></td>
                            </tr>';
        }    
        echo '</center>';                       
    }
    ?>
    </body>
    </html>
