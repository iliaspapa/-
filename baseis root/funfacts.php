<?php include "header.php";

?>
<?php 
    if(isset($_GET["biblia_ekdotiko"])){
        $query="SELECT b.pubName, COUNT(*)
                FROM book AS b 
                GROUP BY pubName;";
        $result = mysqli_query($connection,$query);
        $count = mysqli_num_rows($result);
        if($count==0){
            echo "<center> <div class='alert alert-danger' role='alert'>
                        Oups no books in the database!
                    </div> </center>";
        }
        else{
            echo '<center><table style="width:40%">
                <tr>
                    <th><center><h2>Publisher Name</h2></center></th>
                    <th><center><h2>number of books</h2></center></th>
                </tr>';
        while($row=mysqli_fetch_assoc($result))
        {  
            echo '          <tr>
                                    <td><center><h3>' . $row['pubName'] .'</h3></center></td>
                                    <td><center><h3>' . $row['COUNT(*)'] .'</h3></center></td>
                            </tr>';
        }    
        echo '</center>'; 
        }
    }
    if(isset($_GET["palia_5_biblia"])){
        $query="SELECT ISBN, title, pubYear
                FROM book
                ORDER BY pubYear ASC
                LIMIT 5;";
        $result = mysqli_query($connection,$query);
        $count = mysqli_num_rows($result);
        if($count==0){
            echo "<center> <div class='alert alert-danger' role='alert'>
                        Oups no books in the database!
                    </div> </center>";
        }
        else{
            echo '<center><table style="width:40%">
                <tr>
                    <th><center><h2>ISBN</h2></center></th>
                    <th><center><h2>title</h2></center></th>
                    <th><center><h2>Year of publication</h2></center></th>
                </tr>';
        while($row=mysqli_fetch_assoc($result))
        {  
            echo '          <tr>
                                    <td><center><h3>' . $row['ISBN'] .'</h3></center></td>
                                    <td><center><h3>' . $row['title'] .'</h3></center></td>
                                    <td><center><h3>' . $row['pubYear'] .'</h3></center></td>
                            </tr>';
        }    
        echo '</center>'; 
        }
    }
    if(isset($_GET["siggrafeis_biblion"])){
        $query="SELECT authID, AFirst, ALast, COUNT(*)
                FROM author AS a NATURAL JOIN written_by AS wb
                GROUP BY wb.authID
                HAVING COUNT(*)>4;";
        $result = mysqli_query($connection,$query);
        $count = mysqli_num_rows($result);
        if($count==0){
            echo "<center> <div class='alert alert-danger' role='alert'>
                        No authors with more than 4 books!
                    </div> </center>";
        }
        else{
            echo '<center><table style="width:60%">
                <tr>
                    <th><center><h2>authID</h2></center></th>
                    <th><center><h2>AFirst</h2></center></th>
                    <th><center><h2>ALast</h2></center></th>
                    <th><center><h2>number of books</h2></center></th>
                </tr>';
        while($row=mysqli_fetch_assoc($result))
        {  
            echo '          <tr>
                                    <td><center><h3>' . $row['authID'] .'</h3></center></td>
                                    <td><center><h3>' . $row['AFirst'] .'</h3></center></td>
                                    <td><center><h3>' . $row['ALast'] .'</h3></center></td>
                                    <td><center><h3>' . $row['COUNT(*)'] .'</h3></center></td>
                            </tr>';
        }    
        echo '</center>'; 
        }
    }

?>

<br><br><br><br><br><br><br><br><br>
<center>
    <form method="GET">
        <input type="hidden" name="biblia_ekdotiko"> 
        <button type="submit" class="btn btn-secondary">
            <h2>How many books does each publisher have</h2>
        </button>
    </form>
</center>
<center>
    <form method="GET">
        <input type="hidden" name="palia_5_biblia"> 
        <button type="submit" class="btn btn-secondary">
            <h2>Five oldest books</h2>
        </button>
    </form>
</center>
<center>
    <form method="GET">
        <input type="hidden" name="siggrafeis_biblion"> 
        <button type="submit" class="btn btn-secondary">
            <h2>Authors with more than 4 books</h2>
        </button>
    </form>
</center>
</body>
</html>