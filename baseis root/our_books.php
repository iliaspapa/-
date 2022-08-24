<?php include "header.php";
    $query = "SELECT * FROM all_about_books;";
    $result = mysqli_query($connection,$query);
    $counter = mysqli_num_rows($result);
    if($counter<=0){
        echo "<center> <div class='alert alert-danger' role='alert'>
                    Oops no books
                </div> </center>";
    }
    else{
        echo '<center><h1>Our books</h1>
                <h4>(if a book has more than 1 author or more than 1 category it will apear more than one times)</h4></center>
                <center><table style="width:100%">
                    <tr>
                        <th><center><h2 style="color:blue;">ISBN</h2></center></th>
                        <th><center><h2 style="color:blue;">title</h2></center></th>
                        <th><center><h2 style="color:blue;">pubYear</h2></center></th>
                        <th><center><h2 style="color:blue;">numpages</h2></center></th>
                        <th><center><h2 style="color:blue;">pubName</h2></center></th>
                        <th><center><h2 style="color:blue;">category</h2></center></th>
                        <th><center><h2 style="color:blue;">author first</h2></center></th>
                        <th><center><h2 style="color:blue;">author last</h2></center></th>
                    </tr>';
            while($row=mysqli_fetch_assoc($result))
            { 
                echo '          <tr>
                                        <td><center><h3>' . $row['ISBN'] .'</h3></center></td>
                                        <td><center><h3>' . $row['title'] .'</h3></center></td>
                                        <td><center><h3>' . $row['pubYear'] .'</h3></center></td>
                                        <td><center><h3>' . $row['numpages'] .'</h3></center></td>
                                        <td><center><h3>' . $row['pubName'] .'</h3></center></td>
                                        <td><center><h3>' . $row['categoryName'] .'</h3></center></td>
                                        <td><center><h3>' . $row['AFirst'] .'</h3></center></td>
                                        <td><center><h3>' . $row['ALast'] .'</h3></center></td>
                                </tr>';
            }    
            echo '</center>'; 
    }
?>
