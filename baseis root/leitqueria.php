<?php include "header.php";

?>
<?php 
    if(isset($_GET["daneismoi"])){
        $query="SELECT date_of_return, MFirst, MLast, memberID, ISBN
                FROM borrows NATURAL JOIN member
                ORDER BY date_of_return;";
        $result = mysqli_query($connection,$query);
        $count = mysqli_num_rows($result);
        if($count==0){
            echo "<center> <div class='alert alert-danger' role='alert'>
                        Oups no borrowing has occured!
                    </div> </center>";
        }
        else{
            echo '<center><table style="width:70%">
                <tr>
                    <th><center><h2>first name</h2></center></th>
                    <th><center><h2>last name</h2></center></th>
                    <th><center><h2>book ISBN</h2></center></th>
                    <th><center><h2>date of return</h2></center></th>
                </tr>';
            while($row=mysqli_fetch_assoc($result))
            { 
                if($row['date_of_return']==NULL){
                    $row['date_of_return']='Not returned yet';
                } 
                echo '          <tr>
                                        <td><center><h3>' . $row['MFirst'] .'</h3></center></td>
                                        <td><center><h3>' . $row['MLast'] .'</h3></center></td>
                                        <td><center><h3>' . $row['ISBN'] .'</h3></center></td>
                                        <td><center><h3>' . $row['date_of_return'] .'</h3></center></td>
                                </tr>';
            }    
            echo '</center>'; 
        }
    }
    if(isset($_GET["borrowed_copies"])){
        $query="SELECT COUNT(*)
                FROM borrows AS b
                WHERE b.date_of_return IS NULL;";
        $result = mysqli_query($connection,$query);
        $count = mysqli_num_rows($result);
        if($count==0){
            echo "<center> <div class='alert alert-danger' role='alert'>
                        Something really weird happened
                    </div> </center>";
        }
        else{
            $row=mysqli_fetch_assoc($result);
            echo '<center><h2>There are '.$row['COUNT(*)'].' copies borrowed</h2></center>';
        }
    }
    if(isset($_GET["salary"])){
        $query = "SELECT * FROM employee;";
        $result = mysqli_query($connection,$query);
        $counter  = mysqli_num_rows($result);
        if($counter <= 0) {
            echo "<center> <div class='alert alert-danger' role='alert'>
                        Oops no employees
                        </div> </center>";
        } 
        else{
            echo '<center><table style="width:50%">
                    <tr>
                        <th><center><h2>employee ID<h2></center></th>
                        <th><center><h2>First name</h2></center></th>
                        <th><center><h2>Last name</h2></center></th>
                    </tr>';
            while($row=mysqli_fetch_assoc($result))
            {  
                echo '          <tr>
                                        <td><a href = leitqueria.php?empID=' . $row['empID'] .'><center><h3>'. $row['empID'].' </h3></center></a></td>
                                        <td><a href = leitqueria.php?empID=' . $row['empID'] .'><h3><center>'. $row['EFirst'].'</center></h3> </a></td>
                                        <td><a href = leitqueria.php?empID=' . $row['empID'] .'><h3><center>'. $row['ELast'].' </center></h3></a></td>
                                </tr>';
            }    
            echo '</center>';
        }
    }
    if(isset($_GET["empID"])){
        $Eid = $_GET["empID"];
        $query="SELECT e.EFirst, e.ELast, e.empID, e.salary
                FROM employee AS e
                WHERE e.salary>(SELECT e2.salary
                                FROM employee AS e2
                                WHERE e2.empID = '$Eid');";
        $result = mysqli_query($connection,$query);
        $count = mysqli_num_rows($result);
        if($count==0){
            echo "<center> <div class='alert alert-danger' role='alert'>
                        No employees with higher salaries
                    </div> </center>";
        }
        else{
            echo '<center><table style="width:60%">
                <tr>
                    <th><center><h2>employee ID</h2></center></th>
                    <th><center><h2>First name</h2></center></th>
                    <th><center><h2>Last name</h2></center></th>
                    <th><center><h2>salary</h2></center></th>
                </tr>';
            while($row=mysqli_fetch_assoc($result))
            {  
                echo '          <tr>
                                        <td><center><h3>' . $row['empID'] .'</h3></center></td>
                                        <td><center><h3>' . $row['EFirst'] .'</h3></center></td>
                                        <td><center><h3>' . $row['ELast'] .'</h3></center></td>
                                        <td><center><h3>' . $row['salary'] .'</h3></center></td>
                                </tr>';
            }    
            echo '</center>'; 
        }
    }
    if(isset($_GET["reminder"])){
        $query="SELECT e.empID, e.EFirst,e.ELast ,r.date_of_reminder
                FROM employee AS e LEFT JOIN reminder AS r ON e.empID=r.empID ;";
        $result = mysqli_query($connection,$query);
        $count = mysqli_num_rows($result);
        if($count==0){
            echo "<center> <div class='alert alert-danger' role='alert'>
                        No employees
                    </div> </center>";
        }
        else{
            echo '<center><table style="width:60%">
                <tr>
                    <th><center><h2>empID</h2></center></th>
                    <th><center><h2>EFirst</h2></center></th>
                    <th><center><h2>ELast</h2></center></th>
                    <th><center><h2>reminder</h2></center></th>
                </tr>';
        while($row=mysqli_fetch_assoc($result))
        {  
            if($row["date_of_reminder"]==NULL){
                $row["date_of_reminder"]="no reminder set";
            }
            echo '          <tr>
                                    <td><center><h3>' . $row['empID'] .'</h3></center></td>
                                    <td><center><h3>' . $row['EFirst'] .'</h3></center></td>
                                    <td><center><h3>' . $row['ELast'] .'</h3></center></td>
                                    <td><center><h3>' . $row['date_of_reminder'] .'</h3></center></td>
                            </tr>';
        }    
        echo '</center>'; 
        }
    }

?>

<br><br><br><br><br><br><br>
<center>
    <form method="GET">
        <input type="hidden" name="daneismoi"> 
        <button type="submit" class="btn btn-secondary">
            <h2>Borrowing catalog(members,date_of _return)</h2>
        </button>
    </form>
</center>
<center>
    <form method="GET">
        <input type="hidden" name="reminder"> 
        <button type="submit" class="btn btn-secondary">
            <h2>    Employees and reminders</h2>
        </button>
    </form>
</center>
<center>
    <form method="GET">
        <input type="hidden" name="borrowed_copies"> 
        <button type="submit" class="btn btn-secondary">
            <h2>Number of borrowed copies</h2>
        </button>
    </form>
</center>
<center>
    <form method="GET">
        <input type="hidden" name="salary"> 
        <button type="submit" class="btn btn-secondary">
            <h2>Compare salaries</h2>
        </button>
    </form>
</center>
</body>
</html>