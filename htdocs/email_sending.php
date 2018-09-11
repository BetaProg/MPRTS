<?php
 $to = "betaprogrammers@gmail.com";
 // $subject = "Hi!";
 // $body = "Hi,\n\nHow are you?";
 // $headers = "From: betaprogrammers@gmail.com";
 // if (mail($to, $subject, $body, $headers)) {
 //   echo("<p>Email successfully sent!</p>");
 //  } else {
 //   echo("<p>Email delivery failed…</p>");
 //  }
ini_set('SMTP','smtp.gmail.com');
ini_set('smtp_port','25');
$to = $email;
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers  .= "From: NO-REPLY<betaprogrammers@gmail.com>" . "\r\n";
$subject = "Confirmation For Request";
$message = '<html>
                <body>
                    <p>Hi</p>
                    <p>
                        We recieved below details from you. Please use given Request/Ticket ID for future follow up:
                    </p>
                    <p>
                        Your Request/Ticket ID: 
                    </p>
                    <p>
                    Thanks<br>
                    </p>
                </body>
            </html>';
mail( $to, $subject, $message, $headers ); 
 ?>