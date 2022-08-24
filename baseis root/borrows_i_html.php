<?php include "header.php";

?>
<center><h1>INSERT BORROWING</h1></center><br>
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
<center>
    <form action = "insertborrows.php" method = "GET">
        <input type = "text" name = "ISBN" placeholder = "book's ISBN">
        <input type = "text" name = "copyNr" placeholder="copy number of the book">
        <button type = "submit" class="btn btn-success">
            submit
        </button>
        <?php 
            $query = "SELECT * FROM member;";
            $result = mysqli_query($connection,$query);
            $num = mysqli_num_rows($result);
            if($num<=0){
                echo "no members";
            }
            else{

                echo '<br><br><br><center><table style="width:40%">
                <tr>
                    <th>member ID</th>
                    <th>first name</th>
                    <th>last name</th>
                </tr>';
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr>
                            <td><input type='radio' name = 'memberID' value=".$row['memberID'].">".$row['memberID']."<br></td>
                            <td>".$row['MFirst']."<br></td>
                            <td>".$row['MLast']."<br></td>
                        </tr>";
                }
                echo "</table></center>";
            }
            $query = "SELECT DISTINCT c.ISBN, c.copyNr, b.title 
                        FROM book AS b,copies AS c
                        WHERE b.ISBN=c.ISBN 
                        ORDER BY c.ISBN;";
            $result = mysqli_query($connection,$query);
            $num = mysqli_num_rows($result);
            if($num<=0){
                echo "no categories";
            }
            else{
                echo "<br><h2 style='color:red;'><center>All Copies</center></h2>";
                echo '<br><center><table style="width:40%">
                <tr>
                    <th><center>ISBN</center></th>
                    <th><center>copy number</center></th>
                    <th><center>title</center></th>
                </tr>';
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr>
                            <td><center>".$row['ISBN']."</center></td>
                            <td><center>".$row['copyNr']."</center></td>
                            <td><center>".$row['title']."</center></td>
                        </tr>";
                }
                echo "</table></center>";
            }
            ?>
        <!--<input type = "text" name = "memberID" placeholder = "member's ID">  --> 
        <!--<input type = "date" name = "date_of_borrowing" placeholder = "date of borrowing">-->
       <!-- <input type = "date" name = "date_of_return" placeholder = "date of return"> den xeroume pote tha to epistrepsei -->
        <br><br><br><br>    
    </form> 
</center>

</body>
</html>