<?php include "header.php";

?>
<?php
    if(isset($_GET['ISBN'])){
        echo '
                <center><h1>Update title '.$_GET['title'].' that has ISBN '.$_GET['ISBN'].'</h1></center><br>
                <center>
                    <form action = "updatebook.php" method = "GET">
                        <input type = "hidden" name = "oldISBN" value='.$_GET['ISBN'].'>
                        <input type = "text" name = "ISBN" placeholder = "ISBN(optional)">
                        <input type = "text" name = "title" placeholder = "title(optional)">
                        <input type = "text" name = "pubYear" placeholder="Year of publication(optional)">    <!--na doume gia to year--> 
                        <input type = "text" name = "numpages" placeholder = "numpages(optional)">
                        <input type = "text" name = "pubName" placeholder = "pubName(optional)"><br><br>
                        <button type = "submit" class="btn btn-success">
                            submit
                        </button>
                    </form> 
                    <form action = "member_u_html.php" method= "POST">
                            <input type="hidden" name="cancel" >
                            <button type = "submit" class="btn btn-danger">
                                cancel
                            </button>
                    </form> 
                </center>';
    }
?>

<h1 style ="color:purple;"><center>Update book </h1></center><br>
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
                                    <td><a href = book_u_html.php?ISBN=' . $row['ISBN'] .'&title='.$row['title'].'>'. $row['ISBN'].' </a></td>
                                    <td><a href = book_u_html.php?ISBN=' . $row['ISBN'] .'&title='.$row['title'].'>'. $row['title'].' </a></td>
                                    <td><a href = book_u_html.php?ISBN=' . $row['ISBN'] .'&title='.$row['title'].'>'. $row['pubYear'].' </a></td>
                                    <td><a href = book_u_html.php?ISBN=' . $row['ISBN'] .'&title='.$row['title'].'>'. $row['numpages'].'</a> </td>
                                    <td><a href = book_u_html.php?ISBN=' . $row['ISBN'] .'&title='.$row['title'].'>'. $row['pubName'].'</a> </td>
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
