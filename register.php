    <?php
    
    include ('db_connect.php');
    $error='';
    $epityxia='';
    
    if(isset($_POST['submit'])){    
       if(empty($_POST['firstname']) || empty($_POST['surname']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['passwd']))
       {
           $error='Παρακαλώ συμπληρώστε όλα τα υποχρεωτικά πεδία';
       }else{

           //mysql connect
           $connect = db_connect();
           
           //metafora se metavlites
           $fn = mysqli_real_escape_string($connect, $_POST['firstname']);
           $sn = mysqli_real_escape_string($connect, $_POST['surname']);
           $email = mysqli_real_escape_string($connect, $_POST['email']);
           $usr = mysqli_real_escape_string($connect, $_POST['username']);
           $pass = md5(mysqli_real_escape_string($connect, $_POST['passwd']));
           $ph = mysqli_real_escape_string($connect, $_POST['phone']);
           $ad = mysqli_real_escape_string($connect, $_POST['address']);
           
           //-------------------------------------------------------------------
           
           //check email dublicate
           $question="SELECT * FROM users WHERE email LIKE '{$email}' OR user LIKE '{$usr}'";
           //ektelesh erwthmatos
           $result = mysqli_query($connect, $question) or die(mysql_error());
           
           if(@mysqli_num_rows($result)==0){
                //eisagwgh sth vash
                $reg="INSERT INTO a3338802_kat.users (user_id, firstname, surname, email, user, pass, phone, address) VALUES (NULL, '$fn', '$sn', '$email', '$usr', '$pass', '$ph', '$ad')";
                mysqli_query($connect, $reg) or die(mysql_error());
                mysqli_close($connect);
                
                 $epityxia='Ευχαριστούμε '.$_POST['username']. ' για την εγγραφή σας';
    
           }else{
               $error = 'Το email η το username που επιλέξατε χρησιμοποιείται ήδη';
           }
  
           
         
            
           
       }
    }
    
?>
