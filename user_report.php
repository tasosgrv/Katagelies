<?php

    
    $message='';
    
    if(isset($_POST['submit']) && isset($_SESSION['login_user'])){
        if(empty($_POST['keimeno']) || $_POST['subjects']==0){
            $message='Δεν έχετε συμπληρώσει κάποιο πεδίο';
        }else{
            
            
            $connect = db_connect();
            
            $text = mysqli_real_escape_string($connect, $_POST['keimeno']);
            $sub_id = $_POST['subjects'];
            $date=date(DATE_ISO8601);
            
            
            $question = "SELECT * FROM users WHERE user LIKE '{$_SESSION['login_user']}'";
            $result = mysqli_query($connect, $question) or die('Error in query' .  mysqli_error($connect));
            $p=@mysqli_fetch_array($result);
            
            $insert = "INSERT INTO reports (report_id, text, user_id, guest_id, subject_id, date) VALUES(NULL, '{$text}', '{$p['user_id']}', 0, '{$sub_id}', '{$date}')";
            $r=mysqli_query($connect, $insert) or die('Error in query' . mysqli_error($connect));
            $message = 'Η καταγγελία σας υποβλήθηκε επιτυχώς, ευχαριστούμε!';
            
            
            mysqli_close($connect);
            
            
            
        }
    }
?>

