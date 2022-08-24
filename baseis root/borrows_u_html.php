<?php include "header.php";

?>
<?php
    if(isset($_GET['ISBN'])){
        echo '  <center>
                    <form action = "updateborrows.php" method = "GET">
                        <input type = "hidden" name = "oldmemberID" value='.$_GET['memberID'].' placeholder = "member\'s ID">
                        <input type = "hidden" name = "oldISBN" value='.$_GET['ISBN'].' placeholder = "book\'s ISBN">
                        <input type = "hidden" name = "oldcopyNr" value='.$_GET['copyNr'].' placeholder="copy number of the book">    
                        <input type = "hidden" name = "olddate_of_borrowing" value='.$_GET['date_of_borrowing'].' placeholder = "date of borrowing">
                        <input type = "hidden" name = "memberID" placeholder = "member\'s ID">
                        <input type = "hidden" name = "ISBN" placeholder = "book\'s ISBN">
                        <input type = "hidden" name = "copyNr" placeholder="copy number of the book">    
                        <input type = "hidden" name = "date_of_borrowing" placeholder = "date of borrowing">
                        <input type = "hidden" name = "date_of_return" placeholder = "date of return">
                        <input type = "hidden" name = "button_flag" value = "true" placeholder = "date of return"> <br><br>
                        <button type = "book returned today" class="btn btn-warning">
                            <h4>book returned today</h4>
                        </button>
                    </form> 
                </center><br>
                <center><h1><b>OR</b><h1></center><br>
                <center><h1>Update borrowing</h1></center><br>
                <center><h3>(WARNING check for number of copies and delayed books isn\'t performed here only on insert)</h3></center>
                <center><h5>(εξήγηση στην αναφορά (ιι) παράγραφος περιορισμοί)</h5></center>
                <center><form action = "updateborrows.php" method = "GET">
                    <table>
                        <tr>
                            <th>memberID</th>
                            <th>ISBN</th>
                            <th>copy number</th>
                            <th>borrowing date</th>
                            <th>return date</th>
                        </tr>
                        <tr>
                            <td><input type = "text" name = "memberID" placeholder = "member\'s ID"></td>
                            <td><input type = "text" name = "ISBN" placeholder = "book\'s ISBN"></td>
                            <td><input type = "text" name = "copyNr" placeholder="copy number of the book"></td>    
                            <td><input type = "date" name = "date_of_borrowing" placeholder = "date of borrowing"></td>
                            <td><input type = "date" name = "date_of_return" placeholder = "date of return"> </td>
                            <td><input type = "hidden" name = "button_flag" placeholder = "date of return"> </td>
                        </tr>
                    </table>
                            <input type = "hidden" name = "oldmemberID" value='.$_GET['memberID'].' placeholder = "member\'s ID">
                            <input type = "hidden" name = "oldISBN" value='.$_GET['ISBN'].' placeholder = "book\'s ISBN">
                            <input type = "hidden" name = "oldcopyNr" value='.$_GET['copyNr'].' placeholder="copy number of the book">    
                            <input type = "hidden" name = "olddate_of_borrowing" value='.$_GET['date_of_borrowing'].' placeholder = "date of borrowing">
                            
                        <br><br>
                        <button type = "submit" class="btn btn-success">
                            submit
                        </button>
                    </form> 
                    <form action = "borrows_u_html.php" method= "POST">
                            <input type="hidden" name="cancel" >
                            <button type = "submit" class="btn btn-danger">
                                cancel
                            </button>
                    </form>
                </center>';
    }
?>

<h1 style ="color:purple;"><center>Update borrowing </center></h1>
<center><h3>(WARNING check for number of copies and delayed books isn't performed here only on insert)</h3></center>
<center><h5>(εξήγηση στην αναφορά (ιι) παράγραφος περιορισμοί)</h5></center>

<br>
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
                                    <td><a href = borrows_u_html.php?ISBN=' . $row['ISBN'] .
                                                                '&memberID='. $row['memberID'].
                                                                '&copyNr='.$row['copyNr'].
                                                                '&date_of_borrowing='. $row['date_of_borrowing']. 
                                                                    '>'. $row['memberID'].' </a></td>
                                    <td><a href = borrows_u_html.php?ISBN=' . $row['ISBN'] .
                                                                '&memberID='. $row['memberID'].
                                                                '&copyNr='.$row['copyNr'].
                                                                '&date_of_borrowing='. $row['date_of_borrowing']. 
                                                                    '>'. $row['ISBN'].' </a></td>
                                    <td><a href = borrows_u_html.php?ISBN=' . $row['ISBN'] .
                                                                '&memberID='. $row['memberID'].
                                                                '&copyNr='.$row['copyNr'].
                                                                '&date_of_borrowing='. $row['date_of_borrowing']. 
                                                                    '>'. $row['copyNr'].' </a></td>
                                    <td><a href = borrows_u_html.php?ISBN=' . $row['ISBN'] .
                                                                '&memberID='. $row['memberID'].
                                                                '&copyNr='.$row['copyNr'].
                                                                '&date_of_borrowing='. $row['date_of_borrowing']. 
                                                                    '>'. $row['date_of_borrowing'].'</a> </td>
                                    <td><a href = borrows_u_html.php?ISBN=' . $row['ISBN'] .
                                                                '&memberID='. $row['memberID'].
                                                                '&copyNr='.$row['copyNr'].
                                                                '&date_of_borrowing='. $row['date_of_borrowing']. 
                                                                    '>'. $row['date_of_return'].'</a></td>
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
