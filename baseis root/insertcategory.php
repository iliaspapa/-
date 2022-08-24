<?php
    include_once "dbhandler.php";
    
    $categoryName = $_GET['categoryName'];
    
    $query = " SELECT * FROM category WHERE categoryName = '$categoryName';";    //idia kataxwrisi
    $result =  mysqli_query($connection,$query);
    $counter = mysqli_num_rows($result);

    if($counter > 0){
        header ("Location: category_i_html.php?status=category already exists"); //exoume xnakanei thn kataxorisi
    }   
    else if(empty($categoryName)){
        header ("Location: category_i_html.php?status=You need to write a new category"); //den grapsame tipota
    }
    else
    {   
        $query  = " INSERT INTO category (categoryName) VALUES ( '$categoryName'); ";
        mysqli_query($connection,$query);
        header ("Location: category_i_html.php?status=successful");
    }