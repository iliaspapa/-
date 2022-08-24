<?php 
    session_start();
    $_SESSION['admin']=FALSE;
    header("Location: index.php");
