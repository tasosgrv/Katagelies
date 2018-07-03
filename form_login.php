<!-- 
    `FORMA SYNDESHS
-->

<?php
    include ('login.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Hlektronikh yphresia katageliwn - Σύνδεση</title>
        <link rel="stylesheet" href="/Katagelies/katstyle.css">
    </head>
    <body>
        <div id="base">
            <header id="header">
                    <h1>ΗΛΕΚΤΡΟΝΙΚΗ ΥΠΗΡΕΣΙΑ ΚΑΤΑΓΓΕΛΙΩΝ</h1>
            </header>

            <?php
                if(isset($_SESSION['login_user'])){
            ?>
                <nav id="menu">
                    <ul id="minitabs">    
                        <li><a href="/Katagelies/index.php">Αρχική</a></li> 
                        <li><a href="/Katagelies/form_report.php">Σύνταξη Καταγγελίας</a></li> 
                        <li><a href="/Katagelies/logout.php">Αποσύνδεση</a></li>
                    </ul>
                </nav>   
                
            <section id="main">
                <b><font color="red">Είστε συνδεδεμένος σαν </font> <?php  echo $_SESSION['login_user']; ?></b>
            </section>    
            <?php
                }else{
            ?>
                
                     
                    <nav id="menu">
                        <ul id="minitabs">
                            <li><a href="/Katagelies/index.php">Αρχική</a></li>
                            <li><a href="/Katagelies/form_report.php">Σύνταξη Καταγγελίας</a></li> 
                            <li><a id="current" href="/Katagelies.form_login.php">Σύνδεση</a></u></b></li>
                            <li><a href="/Katagelies/form_register.php">Εγγραφή</a></li><br>
                        </ul>
                    </nav>
                    <section id="main"> 
                        <fieldset>
                            Εισάγετε τα στοιχεία σας για να συνδεθείτε
                            <form action="" method="POST">
                                Username:<input type="text" name="username" maxlength="20"><br>
                                Password:<input type="password" name="passwd" maxlength="20"><br>
                                <button type="submit" name="submit">Αποστολή</button>
                                <button type="reset">Καθαρισμός</button><br><br>
                                <b><font color="red"><?php echo $error; ?></font></b>
                            </form>
                        </fieldset>
                    </section>
                    
            <aside id="aside">
                
                <h1>User</h1>
                
                <p>Καλώς ήλθατε guest user</p>
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
            <?php 
                }
            ?>
        </div>    
    </body>
</html>