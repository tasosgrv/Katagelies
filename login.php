
<?php
    session_start();
    include('db_connect.php');
    $error='';
    
    if(isset($_POST['submit'])){  //Αν έχει υποβληθει η φορμα
        if(empty($_POST['username']) || empty($_POST['passwd'])){ //Αν τα πεδίa username Η password einai αδεια
            $error='To username η το password είναι λάθος'; //εμφανισε λαθος
        }else{
         
            //συνδεση με τη mysql
            $connect = db_connect();
            
            // οι τιμες απ τη φορμα μπαινουν σε μεταβλητες
            $username = mysqli_real_escape_string($connect, $_POST['username']);
            $password = md5(mysqli_real_escape_string($connect, $_POST['passwd']));
            
            //δημιουργεια ερωτήματος
            $question="SELECT * FROM users WHERE user LIKE '$username' AND pass LIKE '$password'";
            
            //εκτελεση ερωτήματος
            $result = mysqli_query($connect, $question) or die('Error to query' .mysqli_connect_error());
            
            //ελεγχος για λαθος
            if($result === FALSE) {
                die(mysqli_connect_error()); // TODO: better error handling
            }
            
           
            
            if(@mysqli_num_rows($result)==1){ //Αν ο αριθμος των στηλών που βρέθηκάν ειναι ένας
                $_SESSION['login_user']=$username; //θετουμε το username στη session
                header("Location: /Katagelies/index.php"); //Ανακατευθυνση στην αρχικη
            }else{
                if($username=='admin' && $password=='56d6515522efaaf7b5d7fe223bc22427'){
                    $_SESSION['login_user']=$username;
                    header("Location: /Katagelies/index.php"); //Ανακατευθυνση στην σελίδα του admin
                }else{
                    $error='To username η το password είναι λάθος'; //αλλίως εμφανισε λαθος
                }
            }
            mysqli_close($connect); //τερματισμος mysql syndeshs 
        }
    }

    ?>