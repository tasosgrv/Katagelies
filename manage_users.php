<?php
    session_start();
    include('db_connect.php');
    
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
                        <li><a href="/Katagelies/create_subject.php">Διαχείρηση Θεμάτων</a></li>
                        <li><a id="current" href="/Katagelies/manage_users.php">Διαχείρηση Χρηστών</a></li>
                        <li><a href="/Katagelies/logout.php">Αποσύνδεση</a></li>
                    </ul>
                </nav>   
                
<!----------------------------U S E R E S------------------------------------------------------------------------->
                <section id="main">
                    <b>Εγγεγραμένοι Χρήστες:</b>
                    <table border="1">
                                <tr>
                                    <td>User ID</td>
                                    <td>Όνομα</td>
                                    <td>Επώνυμο</td>
                                    <td>E-mail</td>
                                    <td>Username</td>
                                    <td>Password</td>
                                    <td>Τηλέφωνο</td>
                                    <td>Διεύθυνση</td>
                                    <td>DIAGRAFH</td>
                                </tr>
                    <?php
                        $connect=  db_connect();
                        
                        if(isset($_POST['delete'])){ //kai an exei patithei to delete
                             $id = $_POST['delete_rec_id'];  //vale sto id thn metavliti apo to kryfo pedio
                             mysqli_query($connect,"DELETE FROM users WHERE user_id LIKE '$id'") or die('delete error' .  mysqli_connect_error());
                        }
                        
                        $result=mysqli_query($connect, "SELECT * FROM users ORDER BY user_id DESC") or die("sfalma stin query" .  mysqli_connect_error());
                    
                        
                        
                        while($users = mysqli_fetch_array($result)){?>
                            
                                <tr>
                                    <td><?php echo $users['user_id'] ?></td>
                                    <td><?php echo $users['firstname'] ?></td>
                                    <td><?php echo $users['surname'] ?></td>
                                    <td><?php echo $users['email'] ?></td>
                                    <td><?php echo $users['user'] ?></td>
                                    <td><?php echo $users['pass'] ?></td>
                                    <td><?php echo $users['phone'] ?></td>
                                    <td><?php echo $users['address'] ?></td>
                                    <td>
                                        <?php 
                                            if($users['user']!='admin'){?>           
                                                <form id="delete" method="post" action="">
                                                    <input type="hidden" name="delete_rec_id" value="<?php echo $users['user_id']; ?>"/> 
                                                    <button type="submit" name="delete">Διαγραφή</button>
                                                </form>
                                        <?php 
                                            } ?>   
                                    </td>
                                </tr>
                            
                    <?php       
                        }  
                    ?>
                    </table>
                    
<!--------------------------------------------------------------G U E S T S--------------------------------------------------------------------------------->                    
                    <b>Επισκέπτες</b>
                    <table border="1">
                                <tr>
                                    <td>Guest ID</td>
                                    <td>Όνομα</td>
                                    <td>Επώνυμο</td>
                                    <td>E-mail</td>
                                    <td>DIAGRAFH</td>
                                </tr>
                    <?php
                        
                        if(isset($_POST['del'])){ //kai an exei patithei to delete
                             $id = $_POST['delete_id'];  //vale sto id thn metavliti apo to kryfo pedio
                             mysqli_query($connect,"DELETE FROM guests WHERE guest_id LIKE '$id'") or die('delete error' .  mysqli_connect_error());
                        }
                        
                        $res=mysqli_query($connect, "SELECT * FROM guests ORDER BY guest_id DESC") or die("sfalma stin query" .  mysqli_connect_error());
                    
                        
                        
                        while($guests = mysqli_fetch_array($res)){?>
                            
                                <tr>
                                    <td><?php echo $guests['guest_id'] ?></td>
                                    <td><?php echo $guests['firstname'] ?></td>
                                    <td><?php echo $guests['surname'] ?></td>
                                    <td><?php echo $guests['email'] ?></td>
                                    <td>         
                                        <form id="del" method="post" action="">
                                            <input type="hidden" name="delete_id" value="<?php echo $guests['guest_id']; ?>"/> 
                                            <button type="submit" name="del">Διαγραφή</button>
                                        </form>
  
                                    </td>
                                </tr>
                            
                    <?php       
                        }  
                        mysqli_close($connect);     
                    ?>
                    </table>
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