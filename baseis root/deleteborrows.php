<?php include "header.php";
?>
<center>
    <h3 class = "alert alert-danger">Are you sure you want to delete all information about this borrowing and its relations?</h1> 
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
        header ("Location: borrows_d_html.php");
        exit(); 
    }
    if(isset($_POST['delete'])){
        $memberID =$_GET['memberID'];
        $ISBN = $_GET['ISBN'];
        $copyNr = $_GET['copyNr'];  
        $date_of_borrowing = $_GET['date_of_borrowing'];
        $query = "DELETE FROM borrows WHERE memberID='$memberID' AND ISBN='$ISBN' AND copyNr='$copyNr' AND date_of_borrowing='$date_of_borrowing';";
        mysqli_query($connection,$query) or die ('error'.mysqli_error($connection));
        header ("Location: borrows_d_html.php");
    }