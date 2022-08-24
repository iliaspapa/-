<?php
    include_once "dbhandler.php";
    
    $ISBN = $_GET['ISBN'];
    $title = $_GET['title'] ;
    $pubYear = $_GET['pubYear'];
    $numPages = $_GET['numpages'];
    $pubName = $_GET['pubName'] ;
    $copyNr = $_GET['copyNr'];
    $shelf = $_GET['shelf'] ;
    $authorID = $_GET['authID'] ;
    $categoryName = $_GET['categoryName'] ;
    
    $query = " SELECT * FROM book WHERE ISBN = '$ISBN';";    //idio ISBN
    $result =  mysqli_query($connection,$query);
    $counter = mysqli_num_rows($result);
    
    $query = "SELECT * FROM publisher WHERE pubName = '$pubName';"; //den exoume to pubName sth bash
    $result =  mysqli_query($connection,$query);
    $pubcounter = mysqli_num_rows($result);

    $query = "SELECT * FROM author WHERE authID = '$authorID';"; //den exoume to authID sth bash
    $result =  mysqli_query($connection,$query);
    $authcounter = mysqli_num_rows($result);
    
    
    $query = "SELECT * FROM category WHERE categoryName = '$categoryName';"; //den exoume to category sth bash
    $result =  mysqli_query($connection,$query);
    $categorycounter = mysqli_num_rows($result);

    if($counter > 0){
        header ("Location: book_i_html.php?status=ISBN already exists"); 
    }
    else if(!is_numeric($ISBN)){
        header ("Location: book_i_html.php?status=ISBN is not a number");   //keno h oxi arithmos
    }
    else if($ISBN > 999999 || $ISBN < 100000){
        header ("Location: book_i_html.php?status=ISBN needs 6 digits"); //oxi 6 psifia
    }
    
    else if($title == ''){
        header ("Location: book_i_html.php?status=Give a title");   //keno title
    }
    
    else if(!is_numeric($pubYear)){
        header ("Location: book_i_html.php?status=Year is not a number");   //keno h oxi arithmos
    }
    else if($pubYear > date("Y") || $pubYear < 1901){
        header ("Location: book_i_html.php?status=Invalid Year");  //oxi sosto Year
    }
    
    else if(!is_numeric($numPages)){
        header ("Location: book_i_html.php?status=Pages are not a number");   //keno h oxi arithmos
    }

    else if($pubName == ''){
        header ("Location: book_i_html.php?status=Give a pubName"); //keno pubName
    }
    else if($pubcounter <= 0){
        header ("Location: book_i_html.php?status=You need to add the Publisher in the database first"); //den exoume puName sth bash 
    }
    else if(!is_numeric($copyNr)|| $copyNr<1){
        header ("Location: book_i_html.php?status=Number of copies needs to be grater than one");  
    }
    else if(!is_numeric($shelf)|| $shelf<1){
        header ("Location: book_i_html.php?status=The shelf number needs to be grater than one");  
    }
    else if($authcounter <= 0){
        header ("Location: book_i_html.php?status=You need to add the Author in the database first"); //den exoume authID sth bash 
    }
    else if($categorycounter <= 0){
        header ("Location: book_i_html.php?status=You need to add the Category in the database first"); //den exoume category sth bash 
    }
    else
    {
        $query  = " INSERT INTO book (ISBN,title,pubYear,numPages,pubName) VALUES ( '$ISBN', '$title', '$pubYear', '$numPages', '$pubName'); ";
        mysqli_query($connection,$query);

        for($i=1;$i<$copyNr+1;$i++){
            $query = "INSERT INTO copies (ISBN,copyNr,shelf) VALUES ('$ISBN', '$i', '$shelf');";
            mysqli_query($connection,$query);
        }

        $query  = " INSERT INTO belongs_to (ISBN, categoryName) VALUES ('$ISBN', '$categoryName'); ";
        mysqli_query($connection,$query);

        $query  = " INSERT INTO written_by (ISBN,authID) VALUES ( '$ISBN', '$authorID'); ";
        mysqli_query($connection,$query);

        header ("Location: book_i_html.php?status=successful");
    }