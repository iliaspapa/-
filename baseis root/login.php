<?php 
    session_start();
?>
<form method = "POST">
    <input type="password" name="password" placeholder="password is 123">
    <button type="submit">submit</button>
</form>
<?php
    if(isset($_POST['password'])){
        if($_POST['password']=="123"){
            $_SESSION['admin']=TRUE;
            header("Location: index.php");
        }
        else{
            header("Location: index.php");
        }
    }
    
    
