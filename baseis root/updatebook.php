<?php
    include_once "dbhandler.php";
    $oldISBN = $_GET['oldISBN'];
    $ISBN = $_GET['ISBN'];
    $title = $_GET['title'] ;
    $pubYear = $_GET['pubYear'];
    $numPages = $_GET['numpages'];
    $pubName = $_GET['pubName'] ;
    
    $query = " SELECT * FROM book WHERE ISBN = '$ISBN';";    //idio ISBN
    $result =  mysqli_query($connection,$query);
    $counter = mysqli_num_rows($result);

    $query = "SELECT * FROM publisher WHERE pubName = '$pubName';"; //den exoume to pubName sth bash
    $result =  mysqli_query($connection,$query);
    $pubcounter = mysqli_num_rows($result);
    
    $query= "SELECT * FROM book WHERE ISBN='$oldISBN';";
    $result = mysqli_query($connection,$query);

    if($counter > 0){
        header ("Location: book_u_html.php?status=ISBN already exists"); 
    }
    else if(!(is_numeric($ISBN)||empty($ISBN))){
        header ("Location: book_u_html.php?status=ISBN is not a number");   //keno h oxi arithmos
    }
    else if(($ISBN > 999999 || $ISBN < 100000)&&!empty($ISBN)){
        header ("Location: book_u_html.php?status=ISBN needs 6 digits"); //oxi 6 psifia
    }
    else if(!(is_numeric($pubYear)||empty($pubYear))){
        header ("Location: book_u_html.php?status=Year is not a number");   //keno h oxi arithmos
    }
    else if(($pubYear > date("Y") || $pubYear < 1901)&&!empty($pubYear)){
        header ("Location: book_u_html.php?status=Invalid Year");  //oxi sosto Year
    }
    
    else if(!(is_numeric($numPages)||empty($numPages))){
        header ("Location: book_u_html.php?status=Pages are not a number");   //keno h oxi arithmos
    }

    else if($pubcounter <= 0&&!empty($pubName)){
        header ("Location: book_u_html.php?status=You need to add the Publisher in the database first"); //den exoume puName sth bash 
    }
    else
    {
        $row = mysqli_fetch_assoc($result);
        if(empty($ISBN))$ISBN = $row['ISBN'];
        if(empty($title))$title = $row['title'];
        if(empty($pubYear))$pubYear = $row['pubYear'];
        if(empty($numPages))$numPages = $row['numpages'];
        if(empty($pubName))$pubName = $row['pubName'];
        $query  = " UPDATE book SET ISBN = '$ISBN',title = '$title', pubYear='$pubYear',numpages='$numPages',pubName='$pubName' WHERE ISBN='$oldISBN'; ";
        mysqli_query($connection,$query) or die(mysqli_error($connection));
    
        header ("Location: book_u_html.php?status=successful");
    }