<?php include "header.php";

?>
<center><h1>INSERT NEW MEMBER</h1></center><br>
<center>
    <form action = "insertmember.php" method = "GET">
        <!--<input type = "text" name = "memberID" placeholder = "member's ID"> auxanetai mono tou -->
        <input type = "text" name = "MFirst" placeholder = "First Name">
        <input type = "text" name = "MLast" placeholder="Last Name">    
        <input type = "text" name = "Street" placeholder = "Street">
        <input type = "text" name = "number" placeholder = "number of the Street">
        <input type = "text" name = "postalCode" placeholder = "postalCode">
        <input type = "date" name = "Mbirthday" placeholder = "birthday">
        <button type = "submit" class="btn btn-success">
            submit
        </button>
    </form> 
</center>
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