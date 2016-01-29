<?php
    session_start();
    include('db_connect.php');
    $mes='';
    if(isset($_SESSION['login_user']) && $_SESSION['login_user']=='admin'){     
?>

    <html>
        <head>
            <meta charset="UTF-8">
            <title>Hlektronikh yphresia katageliwn - Αρχική</title>
            <link rel="stylesheet" href="/Katagelies/katstyle.css">
        </head>
        <body>
            <div id="base">
                <header id="header">
                <h1>ΗΛΕΚΤΡΟΝΙΚΗ ΥΠΗΡΕΣΙΑ ΚΑΤΑΓΓΕΛΙΩΝ</h1>
                </header>
                <nav id="menu">
                    <ul id="minitabs">
                        <li><a href="/Katagelies/index.php">Αρχική</a></li>
                        <li><a href="/Katagelies/form_report.php">Σύνταξη Καταγγελίας</a></li>
                        <li><a id="current" href="/Katagelies/create_subject.php">Διαχείρηση Θεμάτων</a></li>
                        <li><a href="/Katagelies/manage_users.php">Διαχείρηση Χρηστών</a></li>
                        <li><a href="/Katagelies/logout.php">Αποσύνδεση</a></li>
                    </ul>    
                </nav>
                
                <section id="main">
                    <article id="article">
                        <b>Θεματικές ενότητες</b>
                        <table border="1">
                            <tr>
                                <td><b>Subject_id</b></td>
                                <td><b>Ονομα θεματικής ενότητας</b></td>
                                <td><b>Διαγραφή</b></td>
                            </tr>

                            <?php

                            $connect=  db_connect();

                            if(isset($_POST['delete'])){ //kai an exei patithei to delete
                                 $id = $_POST['delete_rec_id'];  //vale sto id thn metavliti apo to kryfo pedio
                                 mysqli_query($connect,"DELETE FROM subjects WHERE subject_id LIKE '$id'") or die('delete error' .  mysqli_connect_error());
                            }
                            $result=mysqli_query($connect, "SELECT * FROM subjects ORDER BY subject_name DESC") or die("sfalma stin query" .  mysqli_connect_error());

                            while($subs = mysqli_fetch_array($result)){?>
                                <tr>
                                        <td><?php echo $subs['subject_id'] ?></td>
                                        <td><?php echo $subs['subject_name'] ?></td>
                                        <td>         
                                            <form id="delete" method="post" action="">
                                                <input type="hidden" name="delete_rec_id" value="<?php echo $subs['subject_id']; ?>"/> 
                                                <button type="submit" name="delete">Διαγραφή</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php       
                            }  
                            ?>
                        </table>
                        <?php
                            if(isset($_POST['submit'])){
                                if(empty($_POST['subject'])){
                                    header("Location: /Katagelies/create_subject.php");
                                }else{
                                    $connect = db_connect();
                                    $subject = mysqli_real_escape_string($connect,$_POST['subject']);
                                    $res=mysqli_query($connect, "INSERT INTO subjects (subject_id, subject_name) VALUES(NULL, '{$subject}')") or die("subject input error" .mysqli_connect_error());
                                    if($res === FALSE) {
                                        $mes='error';
                                    }
                                    echo '<b>Το θέμα δημιουργήθηκε</b>';

                                    mysqli_close($connect);
                                }
                            }else{?>

                                    <form action="" method="POST">
                                        ΄Ονομα Θέματος: <input type="text" name="subject" maxlength="50">
                                        <button type="submit" name="submit">Δημιουργία</button>
                                        <button type="reset">Καθαρισμός</button>
                                    </form>
                                    <b><?php echo $mes; ?></b>

                      <?php }

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
    
<?php
    }else{
        header("Location: /Katagelies/index.php");
    }
?>
