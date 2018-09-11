<?php 
    session_start();
?>
<html>
    <head>
    </head>
    <body>
        <form method="post" action="send_mail.php">
        To : <input type="text" name="mail_to"> <br/>
        Subject :   <input type="text" name="mail_sub">
       <br/>
         Message   <input type="text" name="mail_msg">
        <br/>
            <input type="submit" value="Send Email">
        </form>
        <?php 
            $_SESSION['message'] = 'Hi SG';
            $_SESSION['user_email']   = 'srinivasgovindu1993@gmail.com';
        ?>
    </body>
</html>