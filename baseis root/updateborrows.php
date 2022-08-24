<?php
    include_once "dbhandler.php";
    
    $button_flag = $_GET['button_flag'];
    $oldISBN = $_GET['oldISBN'];
    $oldcopyNr = $_GET['oldcopyNr'] ;
    $olddate_of_borrowing = $_GET['olddate_of_borrowing'];
    $oldmemberID = $_GET['oldmemberID'];
    $ISBN = $_GET['ISBN'];
    $copyNr = $_GET['copyNr'] ;
    $date_of_return = $_GET['date_of_return'];
    $date_of_borrowing = $_GET['date_of_borrowing'];
    $memberID = $_GET['memberID'];
    
    $query= "SELECT * FROM borrows WHERE ISBN='$oldISBN' AND memberID = '$oldmemberID' AND copyNr = '$oldcopyNr' AND date_of_borrowing = '$olddate_of_borrowing';";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($result);

    if(empty($ISBN)&&empty($memberID)&&empty($copyNr)&&empty($date_of_borrowing))$bool="true";
    else $bool="false";
    if(empty($ISBN))$ISBN = $row['ISBN'];
    if(empty($memberID))$memberID = $row['memberID'];
    if(empty($copyNr))$copyNr = $row['copyNr'];
    if(empty($date_of_borrowing))$date_of_borrowing = $row['date_of_borrowing'];
    if(empty($date_of_return))$date_of_return = $row['date_of_return'];
    
    $query = " SELECT * FROM borrows WHERE ISBN = '$ISBN' AND memberID = '$memberID' AND copyNr = '$copyNr' AND date_of_borrowing = '$date_of_borrowing';";    //idia kataxwrisi
    $result =  mysqli_query($connection,$query);
    $counter = mysqli_num_rows($result);
    
    $query = "SELECT * FROM book WHERE ISBN = '$ISBN';"; //den exoume to vivlio-ISBN
    $result =  mysqli_query($connection,$query);
    $bookcounter = mysqli_num_rows($result);
    
    $query = "SELECT * FROM copies WHERE ISBN = '$ISBN' AND copyNr='$copyNr';"; //den exoume to copy-ISBN,copyNr
    $result =  mysqli_query($connection,$query);
    $copycounter = mysqli_num_rows($result);

    $query = " SELECT * FROM borrows WHERE ISBN = '$ISBN' AND copyNr = '$copyNr' AND date_of_return IS NULL;";  //daneismeno copy 
    $result = mysqli_query($connection,$query);
    $borcounter = mysqli_num_rows($result);

    $query = " SELECT * FROM member WHERE memberID = '$memberID';";    //den uparxei melos
    $result =  mysqli_query($connection,$query);
    $memcounter = mysqli_num_rows($result);

    if($button_flag=="true"){
        $date_of_return=date("y-m-d");
        $query  = " UPDATE borrows  SET date_of_return='$date_of_return'
                                    WHERE ISBN='$oldISBN' AND memberID='$oldmemberID' AND copyNr='$oldcopyNr' AND date_of_borrowing='$olddate_of_borrowing';";
        mysqli_query($connection,$query);
    
        header ("Location: borrows_u_html.php?status=successful");
    }
    else if($counter > 0&&$bool=="false"){
        header ("Location: borrows_u_html.php?status=borrowing already exists"); //exoume xnakanei thn kataxorisi
    }


    else if(!(is_numeric($ISBN)||empty($ISBN))){
        header ("Location: borrows_u_html.php?status=ISBN is not a number");   //keno h oxi arithmos
    }
    else if(($ISBN > 999999 || $ISBN < 100000)&&!empty($ISBN)){
        header ("Location: borrows_u_html.php?status=ISBN needs 6 digits"); //oxi 6 psifia
    }
    else if($bookcounter <= 0&&!empty($ISBN)){
        header ("Location: borrows_u_html.php?status=Book doesn't exist"); //book doesnt exist (ISBN)
    }
    
    else if(empty($copyNr)&&!empty($ISBN)){
        header ("Location: borrows_u_html.php?status=entered new ISBN without new copy number!"); 
    }
    else if(!(is_numeric($copyNr)||empty($copyNr))){
        header ("Location: borrows_u_html.php?status=copyNr is not a number");   //keno h oxi arithmos
    }
    else if($copycounter <= 0&&(!empty($copyNr))){
        header ("Location: borrows_u_html.php?status=Copy doesn't exist"); //copy doesnt exist (ISBN,copyNr)
    }
    else if($borcounter > 0&&empty($copyNr)){
        header ("Location: borrows_u_html.php?status=Copy already borrowed"); //copy hasnt been returned
    }

    else if(date("Y-m-d")<$date_of_borrowing&&!empty($date_of_borrowing)){
        header ("Location: borrows_u_html.php?status=date of borrowing in the future");
    }
    else if(date("Y-m-d")<$date_of_return&&!empty($date_of_return)){
        header ("Location: borrows_u_html.php?status=date of return in the future");
    }
    else if(!(is_numeric($memberID)||empty($memberID))){
        header ("Location: borrows_u_html.php?status=MemberID is not a number");   //keno h oxi arithmos
    }
    else if($memcounter <= 0&&!empty($memberID)){
        header ("Location: borrows_u_html.php?status=member doesn't exist"); //member doesnt exist (memberID)
    }
    else if($date_of_borrowing>$date_of_return&&!empty($date_of_borrowing)&&!empty($date_of_return)){
        header ("Location: borrows_u_html.php?status=date of return after date of borrowing");
    }
    else{
        if(!empty($date_of_return)){
            $return_d = ",date_of_return='$date_of_return'";
        }
        else{
            $return_d = "";
        }
        $query  = " UPDATE borrows  SET ISBN='$ISBN',memberID='$memberID'".$return_d.",copyNr='$copyNr',date_of_borrowing='$date_of_borrowing'
                                    WHERE ISBN='$oldISBN' AND memberID='$oldmemberID' AND copyNr='$oldcopyNr' AND date_of_borrowing='$olddate_of_borrowing';";
        mysqli_query($connection,$query);
    
        header ("Location: borrows_u_html.php?status=successful");
    }