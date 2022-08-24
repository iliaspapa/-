<?php include "header.php";

?>
<center><h1>INSERT BOOK</h1></center><br>
<center>
    <form action = "insertbook.php" method = "GET">
        <input type = "text" name = "ISBN" placeholder = "ISBN">
        <input type = "text" name = "title" placeholder = "title">
        <input type = "text" name = "pubYear" placeholder="Year of publication">    <!--na doume gia to year--> 
        <input type = "text" name = "numpages" placeholder = "numpages">
        <input type = "text" name = "pubName" placeholder = "pubName">
        <input type = "text" name = "copyNr" placeholder = "Number of copies">
        <input type = "text" name = "shelf" placeholder = "shelf of the copies">
        <?php 
            $query = "SELECT * FROM author;";
            $result = mysqli_query($connection,$query);
            $num = mysqli_num_rows($result);
            if($num<=0){
                echo "no authors";
            }
            else{
                echo '<br><br><br><center><table style="width:40%">
                <tr>
                    <th>author ID</th>
                    <th>first name</th>
                    <th>last name</th>
                    <th>birth date</th>
                </tr>';
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr>
                            <td><input type='radio' name = 'authID' value=".$row['authID'].">".$row['authID']."<br></td>
                            <td>".$row['AFirst']."<br></td>
                            <td>".$row['ALast']."<br></td>
                            <td>".$row['Abirthdate']."<br></td>
                        </tr>";
                }
                echo "</table></center>";
            }
            $query = "SELECT * FROM category;";
            $result = mysqli_query($connection,$query);
            $num = mysqli_num_rows($result);
            if($num<=0){
                echo "no categories";
            }
            else{
                echo '<br><br><br><center><table style="width:10%">
                <tr>
                    <th><center>category name</center></th>
                </tr>';
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr>
                            <td><center><input type='radio' name = 'categoryName' value=".$row['categoryName'].">".$row['categoryName']."</center></td>
                        </tr>";
                }
                echo "</table></center>";
            }
            ?>
       <!--<input type = "text" name = "categoryName" placeholder = "category of the book">-->
        <br><br><br><br><button type = "submit" class="btn btn-success">
            submit
        </button>
    </form> 
</center>
<center><h6>Additional data(number of copies,shelf,author,category)</h6></center><br>
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