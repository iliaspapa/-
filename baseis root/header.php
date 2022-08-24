<?php 
    session_start();
    if($_SESSION['admin']!=TRUE)$_SESSION['admin']=FALSE;
    include_once "dbhandler.php";
?>
 
<html>
<head>
  <title>yolo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<header>                                             
    <a class="btn btn-primary" href="index.php">HOME</a>
    <a class="btn btn-info" href="funfacts.php">fun facts!</a> 
    <a class="btn btn-warning" href="our_books.php">our books</a> 
    <a class="btn btn-success" href="categories_only.php">our categories</a>
    <?php 
        if($_SESSION['admin']!=TRUE){
            echo '<a class="btn btn-secondary" href="login.php">login as employee</a>';
        }
        else{
          echo '<a class="btn btn-secondary" href="borrows_i_html.php">borrow book</a> 
                <a class="btn btn-danger" href="borrows_u_html.php">return book</a>   
                <a class="btn btn-secondary" href="leitqueria.php">utilities</a>                                 
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                  Edit database
                </button>
                <a class="btn btn-secondary" href="logout.php">logout</a>
            
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="insert.php">insert</a>
                  <a class="dropdown-item" href="delete.php">delete</a>
                  <a class="dropdown-item" href="update.php">update</a>
                </div>';
        }
        ?>
         <a class="btn btn-success" href="us.php">about us</a>

</header>