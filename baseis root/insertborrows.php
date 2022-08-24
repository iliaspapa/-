<?php
    include_once "dbhandler.php";
    
    $ISBN = $_GET['ISBN'];
    $copyNr = $_GET['copyNr'] ;
    $date_of_borrowing = date("y-m-d");//current date
    $memberID = $_GET['memberID'];
    
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

    $query = " SELECT * FROM borrows WHERE memberID = '$memberID' AND date_of_return IS null;";  //daneismeno copy 
    $result = mysqli_query($connection,$query);
    $hasborbooks = mysqli_num_rows($result);

    if($counter > 0){
        header ("Location: borrows_i_html.php?status=borrowing already exists"); //exoume xnakanei thn kataxorisi
    }


    else if(!is_numeric($ISBN)){
        header ("Location: borrows_i_html.php?status=ISBN is not a number");   //keno h oxi arithmos
    }
    else if($ISBN > 999999 || $ISBN < 100000){
        header ("Location: borrows_i_html.php?status=ISBN needs 6 digits"); //oxi 6 psifia
    }
    else if($bookcounter <= 0){
        header ("Location: borrows_i_html.php?status=Book doesn't exist"); //book doesnt exist (ISBN)
    }
    

    else if(!is_numeric($copyNr)){
        header ("Location: borrows_i_html.php?status=copyNr is not a number");   //keno h oxi arithmos
    }
    else if($copycounter <= 0){
        header ("Location: borrows_i_html.php?status=Copy doesn't exist"); //copy doesnt exist (ISBN,copyNr)
    }
    else if($borcounter > 0){
        header ("Location: borrows_i_html.php?status=Copy already borrowed"); //copy hasnt been returned
    }


    else if(!is_numeric($memberID)){
        header ("Location: borrows_i_html.php?status=MemberID is not a number");   //keno h oxi arithmos
    }
    else if($memcounter <= 0){
        header ("Location: borrows_i_html.php?status=member doesn't exist"); //member doesnt exist (memberID)
    }
    
    else if($hasborbooks>4){
        header ("Location: borrows_i_html.php?status=member has borrowed  5 books"); //too many books borrowed
    }
    
    else
    {   
        if($hasborbooks>0){
            while($row=mysqli_fetch_assoc($result)){
                //echo date("Y-m-d",strtotime("1 month"));
                if($row['date_of_borrowing']<date("Y-m-d",strtotime("-1 month"))){
                    header ("Location: borrows_i_html.php?status=Member has not returned all books on time"); //eprothesmo
                    exit();
                }
            }
        }
        $query  = " INSERT INTO borrows (memberID,ISBN,copyNr,date_of_borrowing) VALUES ( '$memberID', '$ISBN', '$copyNr', '$date_of_borrowing'); ";
        mysqli_query($connection,$query);
        header ("Location: borrows_i_html.php?status=successful");
    }