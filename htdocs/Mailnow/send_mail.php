<?php
session_start();
    //$mailto = $_POST['mail_to'];
    //$mailSub = $_POST['mail_sub'];
    //$mailMsg = $_POST['mail_msg'];
    //$mailSub = "Welcome to Maa Properties..!";
    // $data_to_pass = $_SESSION['message'];
    // $register_details_split = explode("##",$data_to_pass);

    $mailSub = $_SESSION['mail_sub'];
    $mailto = $_SESSION['user_email'];
    $mailMsg = $_SESSION['message'];

    // SMTP server
        //$mail->Host = "mail.maaproperties.com";

   require 'PHPMailer-master/PHPMailerAutoload.php';
   $mail = new PHPMailer();
   $mail ->IsSmtp();
   $mail ->SMTPDebug = 1;
   $mail ->SMTPAuth = true;
   $mail ->SMTPSecure = 'ssl';
   //$mail ->Host = "mail.maaproperties.com";
   $mail ->Host = "smtp.gmail.com";
   $mail ->Port = 465; // or 587
   //$mail ->Port = 25;
   $mail ->IsHTML(true);
   $mail ->Username = "betaprogrammers@gmail.com";
   //$mail ->Username = "support@maaproperties.com";
   $mail ->Password = "Iambp2310";
   //$mail ->Password = "Maa@123$%";
   $mail ->SetFrom("yourmail@gmail.com");
   $mail ->Subject = $mailSub;
   $mail ->Body = $mailMsg;
   $mail ->AddAddress($mailto);

   if(!$mail->Send())
   {
       echo "Mail Not Sent";
   }
   else
   {
       echo "Mail Sent";
       header('Location: ../login.php');
   }





   

