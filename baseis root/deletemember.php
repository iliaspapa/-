<?php include "header.php";
?>
<center>
    <h3 class = "alert alert-danger">Are you sure you want to delete all information about this member?</h1> 
    <br><br><br><br><br><br><br><br>
    <form method = "POST">
        <input type = 'hidden' name = "cancel">
        <button type="submit"  class="btn btn-success">
                <h2>Cancel</h2>
        </button>
    </form>
    <form method = "POST">
        <input type = 'hidden' name = "delete">
        <button type="submit"  class="btn btn-danger">
                <h2>Delete</h2>
        </button>
    </form>
</center>
<?php
    if(isset($_POST['cancel'])){
        header ("Location: member_d_html.php");
        exit(); 
    }
    if(isset($_POST['delete'])){
        $memberID = $_GET['ID'];
        $query = 'DELETE FROM member WHERE memberID='.$memberID.';';
        mysqli_query($connection,$query);
        header ("Location: member_d_html.php");
    }