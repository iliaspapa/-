<?php
    include_once "dbhandler.php";
    
    $memberID = $_GET['memberID']; //auxanetai mono tou 
    $MFirst = $_GET['MFirst'] ;
    $MLast = $_GET['MLast'];
    $Street = $_GET['Street'];
    $number = $_GET['number'] ;
    $postalCode = $_GET['postalCode'];
    $Mbirthday = $_GET['Mbirthday'] ;

    $query= "SELECT * FROM member WHERE memberID='$memberID';";
    $result = mysqli_query($connection,$query);
    //$counter = mysqli_num_rows($result);

   
    if(!preg_match("/^[a-zA-Z]*$/",$MFirst)){
        header ("Location: member_u_html.php?status=First name should be only letters");   
    }
    else if(!preg_match("/^[a-zA-Z]*$/",$MLast)){
        header ("Location: member_u_html.php?status=Last name should be only letters");   
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/",$Street)){
        header ("Location: member_u_html.php?status=Street should be only letters and numbers");     //////////////
    }
    else if(!(is_numeric($number)||empty($number))){
        header ("Location: member_u_html.php?status=Number of the street should be a number");   
    }
    else if(!(is_numeric($postalCode)||empty($postalCode))){
        header ("Location: member_u_html.php?status=Postal Code should be a number");   
    }
    else if(($postalCode > 99999 || $postalCode < 10000)&&!empty($postalCode)){
        header ("Location: member_u_html.php?status=PostalCode needs 5 digits"); //oxi 5 psifia
    }  
    else
    {   
        $row = mysqli_fetch_assoc($result);
        if(empty($MFirst))$MFirst = $row['MFirst'];
        if(empty($MLast))$MLast = $row['MLast'];
        if(empty($Street))$Street = $row['Street'];
        if(empty($number))$number = $row['number'];
        if(empty($postalCode))$postalCode = $row['postalCode'];
        if(empty($Mbirthday))$Mbirthday = $row['Mbirthdate'];
        $query  = " UPDATE member SET MFirst='$MFirst',MLast='$MLast',Street='$Street',number='$number',postalCode='$postalCode',Mbirthdate='$Mbirthday' WHERE memberID='$memberID'; ";
        mysqli_query($connection,$query)or die('<center><h1><a class = "btn btn-danger" href="member_u_html.php?status='.mysqli_error($connection).'" >failed go back</a></h1></center>');;
        header ("Location: member_u_html.php?status=successful");   
    }