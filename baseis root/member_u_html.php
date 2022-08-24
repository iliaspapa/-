<?php include "header.php";

?>
<?php
    if(isset($_GET['ID'])){
        echo '<center><h1>UPDATE '.$_GET['name'].' with ID '.$_GET['ID'].'</h1></center><br>
                    <center>
                        <form action = "updatemember.php" method = "GET">
                            <!--<input type = "text" name = "memberID" placeholder = "member\'s ID"> auxanetai mono tou -->
                            <input type = "hidden" name = "memberID" value = '.$_GET['ID'].'>
                            <input type = "text" name = "MFirst" placeholder = "First Name">
                            <input type = "text" name = "MLast" placeholder="Last Name">    
                            <input type = "text" name = "Street" placeholder = "Street">
                            <input type = "text" name = "number" placeholder = "number of the Street">
                            <input type = "text" name = "postalCode" placeholder = "postalCode">
                            <input type = "date" name = "Mbirthday" placeholder = "birthday"><br><br>
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
<h1 style ="color:purple;"><center>Update member </center></h1><br>
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
                                    <td><a href = member_u_html.php?ID=' . $row['memberID'] .'&name='.$row['MFirst'].'>'. $row['memberID'].' </a></td>
                                    <td><a href = member_u_html.php?ID=' . $row['memberID'] .'&name='.$row['MFirst'].'>'. $row['MFirst'].' </a></td>
                                    <td><a href = member_u_html.php?ID=' . $row['memberID'] .'&name='.$row['MFirst'].'>'. $row['MLast'].' </a></td>
                                    <td><a href = member_u_html.php?ID=' . $row['memberID'] .'&name='.$row['MFirst'].'>'. $row['Street'].'</a> </td>
                                    <td><a href = member_u_html.php?ID=' . $row['memberID'] .'&name='.$row['MFirst'].'>'. $row['number'].'</a> </td>
                                    <td><a href = member_u_html.php?ID=' . $row['memberID'] .'&name='.$row['MFirst'].'>'. $row['postalCode'].'</a> </td>
                                    <td><a href = member_u_html.php?ID=' . $row['memberID'] .'&name='.$row['MFirst'].'>'. $row['Mbirthdate'].'</a> </td>
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
