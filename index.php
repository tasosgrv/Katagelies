<!DOCTYPE html>
<!--
    ARXIKH
-->

<?php
session_start();
include('db_connect.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hlektronikh yphresia katageliwn - Αρχική</title>
        <link rel="icon" type="image/ico" href="/Katagelies/img/favicon.ico"/>
        <link rel="stylesheet" href="/Katagelies/katstyle.css">
    </head>
    <body>
        <div id="base">
            <header id="header">
                <h1>ΗΛΕΚΤΡΟΝΙΚΗ ΥΠΗΡΕΣΙΑ ΚΑΤΑΓΓΕΛΙΩΝ</h1>
            </header>
            <?php 
                if(isset($_SESSION['login_user'])) //αν υπαρχει συνδεδεμενος χρηστης...
                {
                    if($_SESSION['login_user']=='admin'){?>
                        <nav id="menu">
                            <ul>
                                <li><a id="current" href="/Katagelies/index.html">Αρχική</a></li>
                                <li><a href="/Katagelies/form_report.php">Σύνταξη Καταγγελίας</a></li>
                                <li><a href="/Katagelies/create_subject.php">Διαχείρηση Θεμάτων</a></li>
                                <li><a href="/Katagelies/manage_users.php">Διαχείρηση Χρηστών</a></li>
                                <li><a href="/Katagelies/logout.php">Αποσύνδεση</a></li>
                            </ul>
                        </nav>
              <?php }else{?>    
                            <nav id="menu">
                            <ul>
                                <li><a id="current" href="/Katagelies/index.html">Αρχική</a></li> 
                                <li><a href="/Katagelies/form_report.php">Σύνταξη Καταγγελίας</a></li>
                                <li><a href="/Katagelies/logout.php">Αποσύνδεση</a></li>
                            </ul>
                            </nav>    
              <?php } ?>


            <?php
                }else{ // αν δεν υπαρχει συνδεδεμενος χρηστης σ.σ. ειναι guest
            ?>
            <nav id="menu">           
                <ul> 
                    <li><a id="current" href="/Katagelies/index.php">Αρχική</a></li>
                    <li><a href="/Katagelies/form_report.php">Σύνταξη Καταγγελίας</a></li>
                    <li><a href="/Katagelies/form_login.php">Σύνδεση</a></li>
                    <li><a href="/Katagelies/form_register.php">Εγγραφή</a></li>
                </ul>
            </nav>

            <?php } ?>
            <!-- POSTS -->
            <section id="main">
                
                    <?php
                    $connect = db_connect();
                    if(isset($_SESSION['login_user']) && $_SESSION['login_user']=='admin'){ //αν υπαρχει σεσσιον για τον admin
                        if(isset($_POST['delete'])){ //kai an exei patithei to delete
                            $id = $_POST['delete_rec_id'];  //vale sto id thn metavliti apo to kryfo pedio
                            mysqli_query($connect,"DELETE FROM reports WHERE report_id LIKE '$id'") or die('delete error' .  mysqli_connect_error());
                         }
                    }


                    $res = mysqli_query($connect, "SELECT * FROM reports ORDER BY date DESC") or die('query 1 error' .  mysqli_connect_error());
                    if(@mysqli_num_rows($res)==0){
                        echo '<b>Δεν υπάρχουν δημοσιεύσεις</b>';
                    }else{
                    while($posts = mysqli_fetch_array($res)){
                        $user = mysqli_query($connect, "SELECT user FROM users WHERE user_id LIKE '{$posts['user_id']}'") or die('query 2 error' .  mysqli_connect_error());
                        $user = mysqli_fetch_array($user);
                        $guest = mysqli_query($connect, "SELECT user FROM guests WHERE guest_id LIKE '{$posts['guest_id']}'") or die('query 2 error' .  mysqli_connect_error());
                        $guest = mysqli_fetch_array($guest);
                        if($posts['user_id']==0){ //αν ο χρηστης δεν ειναι εγγεγραμένος
                            $user['user']=$guest['user']; //vale ston user to onoma tou guest
                        }
                        $subject = mysqli_query($connect, "SELECT subject_name FROM subjects WHERE subject_id LIKE '{$posts['subject_id']}'") or die('query 3 error' .  mysqli_connect_error());
                        $subject = mysqli_fetch_array($subject);?>
                        <article id="article">
                        <?php echo "Username: <b>".$user['user']."</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "
                                . "Θέμα: <b>" .$subject['subject_name']. "</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                . "Date: ".$posts['date'];
                                ?>
                            
                            <p><?php echo "<br>".$posts['text']. "<br><br>"?></p>
                            
                        
                                <!--DELETE BUTTON START -->
                                <?php if(isset($_SESSION['login_user']) && $_SESSION['login_user']=='admin'){?>
                                <form id="delete" method="post" action="">
                                    <input type="hidden" name="delete_rec_id" value="<?php echo $posts['report_id']; ?>"/> <!-- ftiaxnw ena paidio hidden kai vazw to id tou report -->
                                    <button type="submit" name="delete">Διαγραφή</button>
                                </form>
                                <?php } ?>
                                <!--DELETE BUTTON ENDS -->
                        </article>

                    <?php } ?>

                <?php 

                } 
                mysqli_close($connect);
                ?>
                </article>
            </section>
            
            <aside id="aside">
                
                <h1>User</h1>
                
                <p>
                    <?php
                        if(isset($_SESSION['login_user'])){
                            echo "Καλώς ήλθατε ".$_SESSION['login_user'];
                        }else{
                            echo 'Καλώς ήλθατε Guests';
                        }
                    ?>
                </p>
                <br>
                <h1>Contact</h1>
                <ul id="contact">
                    <li><a href="https://www.facebook.com/tgrvv" target="_blank"><img src="/Katagelies/img/facebook.png" width="50" height="50" /></a></li>
                    <li><a href="https://twitter.com/tasosgrv" target="_blank"><img src="/Katagelies/img/twitter.png" width="50" height="50" /></a></li>
                    <li><a href="https://plus.google.com/u/0/113841478425453298169/posts" target="_blank"><img src="/Katagelies/img/googlepls.png" width="50" height="50" /></a></li>
                </ul>
            </aside>

            <footer id="footer">
                <h1>Thank you for visiting</h1>
                <p>Created by tasosg4</p>
            </footer>
        </div>
      
    </body>
</html>
