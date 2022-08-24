<?php
    include_once 'dbhandler';

    $Id = $_GET['Id'];
    $Fname = $_GET['Fname'];
    $Lname = $_GET['Lname'];
    $Faname = $_GET['Faname'];
    $street = $_GET['street'];
    $number = $_GET['number'];
    $city = $_GET['city'];
    $country = $_GET['country'];
    $hight = $_GET['hight'];
    $weight = $_GET['weight'];
    $ref = $_GET['ref'];
    $bdate = $_GET['bdate'];
    $shoe = $_GET['shoe'];
    $profetion = $_GET['profetion'];
    $email = $_GET['e-mail'];
    $amka = $_GET['amka'];
    $phone = $_GET['phone'];
    $phcountry = $_GET['phcountry'];
    $phtype = $_GET['phtype'];
    $history = $_GET['history'];
    $comments = $_GET['comments'];
    $examination = $_GET['examination'];
    $meds = $_GET['meds'];

    $query = " SELECT * FROM enc_patient WHERE id = '$Id';";    //idio ISBN
    $result =  mysqli_query($connection,$query);
    $counter = mysqli_num_rows($result);

    $query = "SELECT * FROM phone WHERE number = '$phone';"; //den exoume to pubName sth bash
    $result =  mysqli_query($connection,$query);
    $phcounter = mysqli_num_rows($result);
    
    $row = mysqli_fetch_assoc();
    $oldname = explode($row['nameenc'],'_');

    if($FName == '')$Fname = $oldname[0];
    if($LName == '')$Lname = $oldname[1];
    if($FaName == '')$FaName = $oldname[2];

    if($counter <= 0){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=Αυτός ο χρήστης δεν υπάρχει"); 
    }
    else if(!is_numeric($shoe)&&$shoe!=''){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=το νούμερο παπουτσιού πρέπει να είναι νούμερο"); 
    }
    else if(!is_numeric($number)&&$number!=''){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=το πεδίο αριθμός πρέπει να είναι νούμερο");   
    }
    else if(!is_numeric($hight)&&$hight!=''){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=το πεδίο υψος πρέπει να είναι νούμερο");  
    }
    else if($hight!=''&&($hight > 2.5 || $hight < 0.3)){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=ύψος εκτώς αποδεκτού εύρους"); 
    }
    else if(!is_numeric($weight)&&$weight!=''){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=το πεδίο Βάρος πρέπει να είναι νούμερο");  
    }
    else if($weight!=''&&($weight > 300 || $weight < 20)){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=Βάρος εκτώς αποδεκτού εύρους"); 
    }

    else if($Fname == ''){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=το πεδίο Όνομα δεν πρέπει να είναι κενό");  
    }
    else if($Lname == ''){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=το πεδίο Επώνυμο δεν πρέπει να είναι κενό");  
    }
    else if($Faname == ''){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=το πεδίο Πατρώνυμο δεν πρέπει να είναι κενό");  
    }

    else if(!is_numeric($phone)&&$phone!=''){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=το πεδίο Τηλέφωνο πρέπει να είναι αριθμός");  
    }
    else if($phone!=''&&($phone > 9999999999 || $phone < 1000000000)){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=το Πεδίο Τηλέφωνο πρέπει να έχει ακριβώς 10 ψηφεία");
    }

    else if($phcountry!=''&&!is_numeric($phcountry)){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=το πεδίο Κωδικός χώρας πρέπει να είναι αριθμός"); 
    }
    else if($phcountry!=''&&($phcountry > 300 || $phcountry < 1)){
        header ("Location: edditpat.php?Fname=$Fname&Lname=$Lname&Faname=$Faname&street=$street&number=$number&city=$city&hight=$hight&weight=$weight&ref=$ref&bdate=$bdate&shoe=$shoe&profetion=$profetion&e-mail=$email&amka=$amka&phone=$phone&country=$country&phtype=$phtype&history=$history&comments=$comments&phcountry=$phcountry&examination=$examination&meds=$meds&status=μη εγκυρη τιμή για το Πεδίο κωδικός χώρας"); 
    }
    else
    {
        if($street == '')$street=$row['street'];
        if($number == '')$number=$row['number'];
        if($city == '')$city=$row['city'];
        if($hight == '')$hight=$row['hight'];
        if($weight == '')$weight=$row['weight'];
        if($ref == '')$ref=$row['sourse'];
        if($bdate == '')$bdate=$row['date_of_birth'];
        if($comments == '')$comments=$row['comments'];
        if($shoe == '')$shoe=$row['foot_size'];
        if($history == '')$history=$row['history'];
        if($meds == '')$meds=$row['meds'];
        if($examination == '')$examination=$row['examination'];
        if($now == '')$now=$row['date_of_first_diagnwsis'];
        if($country == '')$country=$row['country'];
        if($profetion == '')$profetion=$row['profetion'];
        if($email == '')$email=$row['email'];
        if($amka == '')$amka=$row['amka'];
        $name = $FName.'_'.$LName.'_'.$FaName;
        $query  = " UPDATE enc_patients SET (ameenc='$name',street='$street',number='$number',city='$city',
                    hight='$hight',weight='$weight',sourse='$ref',date_of_birth='$bdate',comments='$comments',
                    foot_size='$shoe',history='$history',meds='$meds',examination='$examination',
                    date_of_first_diagnosis='$now',country='$country',profetion='$profetion',email='$email',amka='$amka'
                    WHERE id='$Id';";
        mysqli_query($connection,$query);
        if($phone!=''){
            $query  = "INSERT INTO phones (number, pid, country, type) VALUES ('$phone', '$Id','$phcountry','$phtype');";
            mysqli_query($connection,$query);
        }
        header ("Location: edditpat.php?status=successful");
    }