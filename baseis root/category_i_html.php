<?php include "header.php";

?>
<center><h1>INSERT CATEGORY</h1></center><br>
<center>
    <form action = "insertcategory.php" method = "GET">
        <input type = "text" name = "categoryName" placeholder = "Category Name">
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