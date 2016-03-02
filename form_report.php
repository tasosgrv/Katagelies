<!--
    FORMA EISAGWGHS KATAGELIWN
-->

<?php
    session_start();
    include('db_connect.php');
    include('user_report.php');
    include('guest_report.php');
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
    
        <?php
            if(isset($_SESSION['login_user'])){
                if($_SESSION['login_user']=='admin'){?>
                        
                        <nav id="menu">
                            <ul id="minitabs">
                                <li><a href="/Katagelies/index.php">Αρχική</a></li>
                                <li><a id="current" href="/Katagelies/form_report.php">Σύνταξη Καταγγελίας</a></li>
                                <li><a href="/Katagelies/create_subject.php">Διαχείρηση Θεμάτων</a></li>
                                <li><a href="/Katagelies/manage_users.php">Διαχείρηση Χρηστών</a></li>
                                <li><a href="/Katagelies/logout.php">Αποσύνδεση</a></li>
                            </ul>
                        </nav>
        <?php }else{?>

            <nav id="menu">
                <ul id="minitabs">
                    <li><a href="/Katagelies/index.php">Αρχική</a></li>
                    <li><a id="current" href="/Katagelies/form_report.php">Σύνταξη Καταγγελίας</a></li>
                    <li><a href="/Katagelies/logout.php">Αποσύνδεση</a></li>
                </ul>
            </nav>
        <?php } ?>
            <section id="main">        
                <fieldset>
                    <div align='left'>Συντάξτε την καταγγελία σας</div><br>
                    <form action="" method="POST">
                       Username: <b><?php  echo $_SESSION['login_user']; ?></b> | 
                       Θέμα: <select name="subjects">
                            <option value="0">Επιλέξτε θέμα</option> 
                            <?php
                            $connect = db_connect();
                            $res = mysqli_query($connect, "SELECT * FROM subjects") or die('query error' .  mysqli_connect_error());
                            while($subs = mysqli_fetch_array($res)){?>
                                <option value="<?php echo $subs['subject_id']?>"><?php echo $subs['subject_name']?></option>
                            <?php } mysqli_close($connect);?>
                        </select>
                        <p>
                        Καταγγελία:<br>
                        <textarea name="keimeno" rows="3" cols="70" maxlength="2500"></textarea><br>
                        <button type="submit" name="submit">Αποστολή</button>
                        <button type="reset">Καθαρισμός</button><br> 
                    </form>
                    <b><?php echo $message ?></b>
                </fieldset>
            </section>

            <?php }else{ ?>
 
            <nav id="menu">
                <ul id="minitabs">
                    <li><a href="/Katagelies/index.php">Αρχική</a></li> 
                    <li><a id="current" href="/Katagelies/form_report.php">Σύνταξη Καταγγελίας</a></li>
                    <li><a href="/Katagelies/form_login.php">Σύνδεση</a></li>
                    <li><a href="/Katagelies/form_register.php">Εγγραφή</a></li>
                </ul>
            </nav>

            <section id="main">
                <fieldset>
                    <div align='left'>Συντάξτε την καταγγελία σας</div><br>
                    <form action='' method='POST'>
                        Όνομα: <input type='text' name='firstname' maxlength="20">
                        Επώνυμο: <input type='text' name='surname' maxlength="40"><br>
                        E-mail: <input type="email" name="email" maxlength="40"><p>
                        Θέμα: <select name="subjects">
                            <option value="0">Επιλέξτε θέμα</option> 
                            <?php
                            $connect = db_connect();
                            $res = mysqli_query($connect, "SELECT * FROM subjects") or die('query error' .  mysqli_connect_error());
                            while($subs = mysqli_fetch_array($res)){?>
                                <option value="<?php echo $subs['subject_id']?>"><?php echo $subs['subject_name']?></option>
                            <?php } mysqli_close($connect);?>
                        </select>
                        <p>
                        Καταγγελία:<br>
                        <textarea name="keimeno" rows="3" cols="70" maxlength="2500"></textarea><br>
                        <button type="submit" name="submit">Αποστολή</button>
                        <button type="reset">Καθαρισμός</button><br>
                    </form>
                    <b><?php echo $mes ?></b>
                </fieldset>    
            </section>
            <?php } ?>
            
            <aside id="aside">
                
                <h1>User</h1>
                
                <p>
                    <?php
                        if(isset($_SESSION['login_user'])){
                            echo "Καλώς ήλθατε " .$_SESSION['login_user'];
                        }else{
                            echo 'Καλώς ήλθατε Guest';
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