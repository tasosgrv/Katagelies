<?php
    
    $mes='';
    
    if(isset($_POST['submit'])){
        if(empty($_POST['firstname']) || empty($_POST['surname']) || empty($_POST['email']) || empty($_POST['keimeno']) || $_POST['subjects']==0){
            $mes='Δεν έχετε συμπληρώσει κάποιο πεδίο';
        }else{
            
            $connect = db_connect();
            
            $fn = mysqli_real_escape_string($connect, $_POST['firstname']);
            $sn = mysqli_real_escape_string($connect, $_POST['surname']);
            $email = mysqli_real_escape_string($connect, $_POST['email']);
            $text = mysqli_real_escape_string($connect, $_POST['keimeno']);
            $sub_id = $_POST['subjects'];
			$guest_id=rand(1,10000);            
            $user='guest'.$guest_id; 
            $date=date(DATE_ISO8601);
            
            //eisagwgh guest
            $insert_quest = "INSERT INTO `guests` (`guest_id`, `firstname`, `surname`, `user`, `email`) VALUES ('$guest_id', '$fn', '$sn', '$user', '$email')";
            mysqli_query($connect, $insert_quest) or die('Error in query for insert user ' . mysqli_error($connect));       
            
            
           //eisagwgh report
            $insert_report = "INSERT INTO reports (report_id, text, user_id, guest_id, subject_id, date) VALUES(NULL, '$text', 'NULL', '$guest_id', '$sub_id', '$date')";
            mysqli_query($connect, $insert_report) or die('Error in query for insert report ' . mysqli_error($connect));
            
            $mes = 'Η καταγγελία σας υποβλήθηκε επιτυχώς, ευχαριστούμε!';
            
            mysqli_close($connect);            
        }
    }
?>

