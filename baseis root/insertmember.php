<?php
    include_once "dbhandler.php";
    
    //$memberID = $_GET['memberID']; auxanetai mono tou 
    $MFirst = $_GET['MFirst'] ;
    $MLast = $_GET['MLast'];
    $Street = $_GET['Street'];
    $number = $_GET['number'] ;
    $postalCode = $_GET['postalCode'];
    $Mbirthday = $_GET['Mbirthday'] ;

    if(empty($MFirst)){
        header ("Location: member_i_html.php?status=Fill in the First Name");
    }  
    else if(!preg_match("/^[a-zA-Z]*$/",$MFirst)){
        header ("Location: member_i_html.php?status=First name should be only letters");   
    }
    else if(!preg_match("/^[a-zA-Z]*$/",$MLast)){
        header ("Location: member_i_html.php?status=Last name should be only letters");   
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/",$Street)){
        header ("Location: member_i_html.php?status=Street should be only letters and numbers");     //////////////
    }
    else if(empty($MLast)){
        header ("Location: member_i_html.php?status=Fill in the Last Name");
    }  
    else if(empty($Street)){
        header ("Location: member_i_html.php?status=Fill in the Street");
    }  
    else if(!is_numeric($number)){
        header ("Location: member_i_html.php?status=Number of the street should be a number");   
    }
    else if(!is_numeric($postalCode)){
        header ("Location: member_i_html.php?status=Postal Code should be a number");   
    }
    else if($postalCode > 99999 || $postalCode < 10000){
        header ("Location: member_i_html.php?status=PostalCode needs 5 digits"); //oxi 5 psifia
    }
    else if(empty($Mbirthday)){
        header ("Location: member_i_html.php?status=Fill in the Birthdate");
    }  
    else
    {
        $query  = " INSERT INTO member (MFirst,MLast,Street,number,postalCode,Mbirthdate) VALUES ( '$MFirst', '$MLast', '$Street', '$number', '$postalCode', '$Mbirthday'); ";
        mysqli_query($connection,$query) or die('<center><h1><a class = "btn btn-danger" href="member_i_html.php?status='.mysqli_error($connection).'" >failed go back</a></h1></center>');
    
        header ("Location: member_i_html.php?status=successful");
    }