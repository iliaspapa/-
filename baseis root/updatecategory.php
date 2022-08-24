<?php
    include_once "dbhandler.php";
    
    $oldcategoryName = $_GET['oldcategoryName'];
    $categoryName = $_GET['categoryName'] ;
    
    $query = " SELECT * FROM category WHERE categoryName = '$categoryName';";    //idia kataxwrisi
    $result =  mysqli_query($connection,$query);
    $counter = mysqli_num_rows($result);

    if(empty($categoryName)){
        $categoryName = $oldcategoryName;   //den pliktrologise
    }
   
    if($counter > 0){
        header ("Location: category_u_html.php?status=Category already exists"); //exoume xnakanei thn kataxorisi
    }

    else{
        $query  = " UPDATE category  SET categoryName='$categoryName' WHERE categoryName='$oldcategoryName';";
        mysqli_query($connection,$query);
    
         header ("Location: category_u_html.php?status=successful");
    }