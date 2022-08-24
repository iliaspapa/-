<?php include "header.php";
?>
<center>
    <h3 class = "alert alert-danger">Are you sure you want to delete this category?</h1> 
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
        header ("Location: category_d_html.php");
        exit(); 
    }
    if(isset($_POST['delete'])){
        $categoryName = $_GET['categoryName'];
        $query = "SELECT * FROM belongs_to WHERE categoryName='$categoryName';";
        $result = mysqli_query($connection,$query);
        $belongs_to_count = mysqli_num_rows($result);
        if($belongs_to_count>0){
            header ("Location: category_d_html.php?status=there are books in that category cant be deleted");
            exit();
        }
        $query = "DELETE FROM category WHERE categoryName='$categoryName';";
        mysqli_query($connection,$query);
        header ("Location: category_d_html.php");
    }